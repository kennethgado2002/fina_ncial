<?php
session_start();
include "../PANEL/panel.php";
include "../CONFIG/config_ap.php";

// Function to get all invoices with vendor details
function getInvoices($conn, $statusFilter = null) {
    $sql = "SELECT i.*, v.vendor_name 
            FROM invoices i 
            JOIN vendors v ON i.vendor_id = v.id";
    
    if ($statusFilter) {
        $sql .= " WHERE i.status = ?";
    }
    $sql .= " ORDER BY i.invoice_date DESC";
    
    $stmt = $conn->prepare($sql);
    if ($statusFilter) {
        $stmt->bind_param("s", $statusFilter);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    $invoices = [];
    while ($row = $result->fetch_assoc()) {
        $invoices[] = $row;
    }
    return $invoices;
}

// Function to get tolerance settings
function getToleranceSettings($conn) {
    $sql = "SELECT * FROM tolerance_settings ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Function to get invoice details with line items
function getInvoiceDetails($conn, $invoiceNumber) {
    $sql = "SELECT i.*, v.vendor_name, v.contact_person, v.email, v.phone 
            FROM invoices i 
            JOIN vendors v ON i.vendor_id = v.id 
            WHERE i.invoice_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $invoiceNumber);
    $stmt->execute();
    $invoice = $stmt->get_result()->fetch_assoc();
    
    if ($invoice) {
        // Get invoice line items
        $sqlItems = "SELECT * FROM invoice_line_items WHERE invoice_id = ? ORDER BY is_tax ASC, id ASC";
        $stmtItems = $conn->prepare($sqlItems);
        $stmtItems->bind_param("i", $invoice['id']);
        $stmtItems->execute();
        $invoice['line_items'] = $stmtItems->get_result()->fetch_all(MYSQLI_ASSOC);
        
        // Get PO details if exists
        if ($invoice['po_reference']) {
            $sqlPO = "SELECT po.*, v.vendor_name 
                     FROM purchase_orders po 
                     JOIN vendors v ON po.vendor_id = v.id 
                     WHERE po.po_number = ?";
            $stmtPO = $conn->prepare($sqlPO);
            $stmtPO->bind_param("s", $invoice['po_reference']);
            $stmtPO->execute();
            $invoice['po_details'] = $stmtPO->get_result()->fetch_assoc();
            
            if ($invoice['po_details']) {
                // Get PO line items
                $sqlPOLine = "SELECT * FROM po_line_items WHERE po_id = ? ORDER BY is_tax ASC, id ASC";
                $stmtPOLine = $conn->prepare($sqlPOLine);
                $stmtPOLine->bind_param("i", $invoice['po_details']['id']);
                $stmtPOLine->execute();
                $invoice['po_details']['line_items'] = $stmtPOLine->get_result()->fetch_all(MYSQLI_ASSOC);
            }
        }
        
        // Get GRN details if exists
        if ($invoice['grn_reference']) {
            $sqlGRN = "SELECT * FROM grn WHERE grn_number = ?";
            $stmtGRN = $conn->prepare($sqlGRN);
            $stmtGRN->bind_param("s", $invoice['grn_reference']);
            $stmtGRN->execute();
            $invoice['grn_details'] = $stmtGRN->get_result()->fetch_assoc();
            
            if ($invoice['grn_details']) {
                // Get GRN line items
                $sqlGRNLine = "SELECT * FROM grn_line_items WHERE grn_id = ?";
                $stmtGRNLine = $conn->prepare($sqlGRNLine);
                $stmtGRNLine->bind_param("i", $invoice['grn_details']['id']);
                $stmtGRNLine->execute();
                $invoice['grn_details']['line_items'] = $stmtGRNLine->get_result()->fetch_all(MYSQLI_ASSOC);
            }
        }
    }
    
    return $invoice;
}

// Function to update invoice status
function updateInvoiceStatus($conn, $invoiceNumber, $newStatus) {
    $sql = "UPDATE invoices SET status = ?, updated_at = NOW() WHERE invoice_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newStatus, $invoiceNumber);
    return $stmt->execute();
}

// Function to save tolerance settings
function saveToleranceSettings($conn, $settings) {
    $sql = "INSERT INTO tolerance_settings 
            (price_tolerance_percent, price_tolerance_unit, qty_tolerance_percent, 
             qty_tolerance_unit, tax_tolerance_percent, tax_tolerance_unit, 
             escalation_threshold, auto_approve) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ddididid", 
        $settings['priceTolerancePercent'],
        $settings['priceToleranceUnit'],
        $settings['qtyTolerancePercent'],
        $settings['qtyToleranceUnit'],
        $settings['taxTolerancePercent'],
        $settings['taxToleranceUnit'],
        $settings['escalationThreshold'],
        $settings['autoApprove']
    );
    return $stmt->execute();
}

// Function to calculate matching results with enhanced calculations
function calculateMatchingResults($invoice, $toleranceSettings) {
    $results = [
        'invoice_net' => 0,
        'invoice_tax' => 0,
        'invoice_total' => 0,
        'po_net' => 0,
        'po_tax' => 0,
        'po_total' => 0,
        'price_variance' => 0,
        'price_variance_percent' => 0,
        'tax_variance' => 0,
        'tax_variance_percent' => 0,
        'total_variance' => 0,
        'total_variance_percent' => 0,
        'items' => [],
        'alerts' => []
    ];
    
    if (!$invoice) {
        return $results;
    }
    
    // Calculate invoice totals
    $results['invoice_total'] = $invoice['invoice_amount'];
    $results['invoice_net'] = $invoice['net_amount'] ?? 0;
    $results['invoice_tax'] = $invoice['tax_amount'] ?? 0;
    
    // Calculate PO totals if available
    if (isset($invoice['po_details'])) {
        $results['po_total'] = $invoice['po_details']['total_amount'];
        $results['po_net'] = $invoice['po_details']['net_amount'] ?? 0;
        $results['po_tax'] = $invoice['po_details']['tax_amount'] ?? 0;
        
        // Calculate variances
        $results['price_variance'] = $results['invoice_net'] - $results['po_net'];
        $results['tax_variance'] = $results['invoice_tax'] - $results['po_tax'];
        $results['total_variance'] = $results['invoice_total'] - $results['po_total'];
        
        $results['price_variance_percent'] = $results['po_net'] > 0 ? 
            ($results['price_variance'] / $results['po_net']) * 100 : 0;
        $results['tax_variance_percent'] = $results['po_tax'] > 0 ? 
            ($results['tax_variance'] / $results['po_tax']) * 100 : 0;
        $results['total_variance_percent'] = $results['po_total'] > 0 ? 
            ($results['total_variance'] / $results['po_total']) * 100 : 0;
    }
    
    // Compare line items if PO and GRN exist
    if (isset($invoice['po_details']) && isset($invoice['grn_details'])) {
        foreach ($invoice['line_items'] as $invItem) {
            if ($invItem['is_tax']) continue; // Skip tax items for line-by-line comparison
            
            $itemResult = [
                'description' => $invItem['item_description'],
                'invoice_qty' => $invItem['quantity_billed'],
                'invoice_price' => $invItem['unit_price'],
                'invoice_subtotal' => $invItem['subtotal'],
                'po_qty' => 0,
                'po_price' => 0,
                'po_subtotal' => 0,
                'grn_qty' => 0,
                'qty_variance' => 0,
                'price_variance' => 0,
                'line_variance' => 0
            ];
            
            // Find matching PO item
            foreach ($invoice['po_details']['line_items'] as $poItem) {
                if ($poItem['is_tax']) continue;
                if (strpos(strtolower($poItem['item_description']), strtolower($invItem['item_description'])) !== false) {
                    $itemResult['po_qty'] = $poItem['quantity_ordered'];
                    $itemResult['po_price'] = $poItem['agreed_price'];
                    $itemResult['po_subtotal'] = $poItem['subtotal'];
                    break;
                }
            }
            
            // Find matching GRN item
            foreach ($invoice['grn_details']['line_items'] as $grnItem) {
                if (strpos(strtolower($grnItem['item_description']), strtolower($invItem['item_description'])) !== false) {
                    $itemResult['grn_qty'] = $grnItem['quantity_received'];
                    break;
                }
            }
            
            // Calculate variances
            $itemResult['qty_variance'] = $itemResult['invoice_qty'] - $itemResult['grn_qty'];
            $itemResult['price_variance'] = $itemResult['invoice_price'] - $itemResult['po_price'];
            $itemResult['line_variance'] = $itemResult['invoice_subtotal'] - $itemResult['po_subtotal'];
            
            $results['items'][] = $itemResult;
        }
    }
    
    // Generate alerts based on tolerance
    $priceExceeds = false;
    $taxExceeds = false;
    $qtyExceeds = false;
    
    if (abs($results['price_variance_percent']) > $toleranceSettings['price_tolerance_percent'] && 
        abs($results['price_variance']) > $toleranceSettings['price_tolerance_unit']) {
        $results['alerts'][] = "Price variance exceeds tolerance limits!";
        $priceExceeds = true;
    }
    
    if (abs($results['tax_variance_percent']) > $toleranceSettings['tax_tolerance_percent'] && 
        abs($results['tax_variance']) > $toleranceSettings['tax_tolerance_unit']) {
        $results['alerts'][] = "Tax variance exceeds tolerance limits!";
        $taxExceeds = true;
    }
    
    // Check quantity variances for each line item
    foreach ($results['items'] as $item) {
        if (abs($item['qty_variance']) > $toleranceSettings['qty_tolerance_unit']) {
            $qtyExceeds = true;
            break;
        }
    }
    
    if ($qtyExceeds) {
        $results['alerts'][] = "Quantity variance exceeds tolerance limits!";
    }
    
    return $results;
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update_status':
                if (isset($_POST['invoice_number']) && isset($_POST['status'])) {
                    if (updateInvoiceStatus($conn, $_POST['invoice_number'], $_POST['status'])) {
                        $_SESSION['message'] = "Invoice status updated successfully!";
                    } else {
                        $_SESSION['error'] = "Error updating invoice status!";
                    }
                }
                break;
                
            case 'save_tolerance':
                $settings = [
                    'priceTolerancePercent' => floatval($_POST['priceTolerancePercent']),
                    'priceToleranceUnit' => floatval($_POST['priceToleranceUnit']),
                    'qtyTolerancePercent' => floatval($_POST['qtyTolerancePercent']),
                    'qtyToleranceUnit' => intval($_POST['qtyToleranceUnit']),
                    'taxTolerancePercent' => floatval($_POST['taxTolerancePercent']),
                    'taxToleranceUnit' => floatval($_POST['taxToleranceUnit']),
                    'escalationThreshold' => floatval($_POST['escalationThreshold']),
                    'autoApprove' => isset($_POST['autoApprove']) ? 1 : 0
                ];
                
                if (saveToleranceSettings($conn, $settings)) {
                    $_SESSION['message'] = "Tolerance settings saved successfully!";
                } else {
                    $_SESSION['error'] = "Error saving tolerance settings!";
                }
                break;
        }
        header("Location: vendor_m.php");
        exit();
    }
}

// Get data from database
$invoices = getInvoices($conn);
$exceptionInvoices = array_filter($invoices, function($invoice) {
    return in_array($invoice['status'], ['partial-matched', 'mismatched']);
});
$regularInvoices = array_filter($invoices, function($invoice) {
    return in_array($invoice['status'], ['pending', 'matching', 'matched']);
});
$toleranceSettings = getToleranceSettings($conn);

?>

<!-- CSS styles remain the same as your original file -->
<style>
    :root {
        --primary: #2c3e50;
        --secondary: #3498db;
        --accent: #e74c3c;
        --success: #2ecc71;
        --warning: #f39c12;
        --info: #17a2b8;
        --light: #ecf0f1;
        --dark: #2c3e50;
        --header-height: 70px;
        --transition: all 0.3s ease;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Lato', sans-serif;
        background-color: #f5f7fa;
        color: #333;
        line-height: 1.6;
        overflow-x: hidden;
    }

    /* Layout */
    .container {
        display: flex;
        min-height: 100vh;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        transition: var(--transition);
    }

    /* Header */
    .header {
        height: var(--header-height);
        background: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 30px;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    /* Content Area */
    .content {
        padding: 30px;
    }

    .page-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 20px;
        color: var(--dark);
    }

    /* Tabs */
    .tabs {
        display: flex;
        margin-bottom: 20px;
        border-bottom: 2px solid #e0e0e0;
    }

    .tab {
        padding: 12px 24px;
        background: none;
        border: none;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        font-size: 1rem;
        color: #666;
        cursor: pointer;
        transition: var(--transition);
        border-bottom: 3px solid transparent;
    }

    .tab.active {
        color: var(--secondary);
        border-bottom-color: var(--secondary);
    }

    .tab:hover:not(.active) {
        color: var(--dark);
        background-color: #f8f9fa;
    }

    .tab-content {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Card */
    .card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .card-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        font-size: 1.2rem;
        color: var(--dark);
    }

    .card-body {
        padding: 20px;
    }

    /* Search Box */
    .search-box {
        position: relative;
        margin-bottom: 20px;
    }

    .search-box input {
        width: 100%;
        padding: 12px 20px;
        padding-left: 45px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-family: 'Lato', sans-serif;
        font-size: 1rem;
        transition: var(--transition);
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--secondary);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #777;
    }

    /* Table */
    .table-responsive {
        overflow-x: auto;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
        transition: var(--transition);
    }

    th {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        background-color: #f8f9fa;
        color: var(--dark);
        position: sticky;
        top: 0;
    }

    tr {
        transition: var(--transition);
    }

    tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
    }

    /* Status Badges */
    .status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-block;
        transition: var(--transition);
    }

    .status-pending {
        background-color: #ffeaa7;
        color: #d35400;
    }

    .status-matching {
        background-color: #81ecec;
        color: #00b894;
    }

    .status-matched {
        background-color: #55efc4;
        color: #00b894;
    }

    .status-partial-matched {
        background-color: #fdcb6e;
        color: #e17055;
    }

    .status-mismatched {
        background-color: #ff7675;
        color: #d63031;
    }

    /* Buttons */
    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        font-family: 'Lato', sans-serif;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        font-size: 0.9rem;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .btn i {
        font-size: 0.9rem;
    }

    .btn-view {
        background-color: #95a5a6;
        color: white;
    }

    .btn-view:hover {
        background-color: #7f8c8d;
    }

    .btn-match {
        background-color: var(--secondary);
        color: white;
    }

    .btn-match:hover {
        background-color: #2980b9;
    }

    .btn-approve {
        background-color: var(--success);
        color: white;
    }

    .btn-approve:hover {
        background-color: #27ae60;
    }

    .btn-partial {
        background-color: var(--warning);
        color: white;
    }

    .btn-partial:hover {
        background-color: #e67e22;
    }

    .btn-reject {
        background-color: var(--accent);
        color: white;
    }

    .btn-reject:hover {
        background-color: #c0392b;
    }

    .btn-notify {
        background-color: #9b59b6;
        color: white;
    }

    .btn-notify:hover {
        background-color: #8e44ad;
    }

    .btn-escalate {
        background-color: #34495e;
        color: white;
    }

    .btn-escalate:hover {
        background-color: #2c3e50;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 0.8rem;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        transition: var(--transition);
    }

    .modal-content {
        background-color: white;
        margin: 2% auto;
        padding: 0;
        border-radius: 10px;
        width: 95%;
        max-width: 1200px;
        max-height: 90vh;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        animation: modalFade 0.3s;
        display: flex;
        flex-direction: column;
    }

    @keyframes modalFade {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
    }

    .modal-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        font-size: 1.3rem;
        color: var(--dark);
    }

    .close {
        color: #aaa;
        font-size: 1.5rem;
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition);
    }

    .close:hover {
        color: var(--dark);
    }

    .modal-body {
        padding: 20px;
        overflow-y: auto;
        flex: 1;
    }

    .modal-footer {
        padding: 15px 20px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        background: #f8f9fa;
    }

    /* Matching Sections */
    .matching-section {
        margin-bottom: 30px;
        padding: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background: #fafafa;
    }

    .matching-section h4 {
        font-family: 'Montserrat', sans-serif;
        margin-bottom: 15px;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .matching-section h4 i {
        color: var(--secondary);
    }

    .comparison-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .comparison-table th {
        background: var(--secondary);
        color: white;
        padding: 12px;
        text-align: center;
    }

    .comparison-table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #e0e0e0;
    }

    .variance {
        font-weight: 600;
    }

    .variance.positive {
        color: var(--success);
    }

    .variance.negative {
        color: var(--accent);
    }

    .variance.within-tolerance {
        color: var(--success);
    }

    .variance.exceeds-tolerance {
        color: var(--accent);
    }

    .alert-box {
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid;
    }

    .alert-warning {
        background-color: #fff3cd;
        border-color: var(--warning);
        color: #856404;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: var(--accent);
        color: #721c24;
    }

    .alert-success {
        background-color: #d1edff;
        border-color: var(--success);
        color: #155724;
    }

    /* Tolerance Settings */
    .tolerance-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        color: var(--dark);
    }

    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-family: 'Lato', sans-serif;
        font-size: 1rem;
        transition: var(--transition);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--secondary);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-col {
        flex: 1;
    }

    /* Attachment Preview */
    .attachment-preview {
        margin-top: 10px;
        padding: 15px;
        border: 1px dashed #ddd;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .attachment-preview:hover {
        border-color: var(--secondary);
        background-color: #f8f9fa;
    }

    .attachment-preview i {
        font-size: 2rem;
        color: #7f8c8d;
        margin-bottom: 10px;
    }

    /* Footer */
    .footer {
        text-align: center;
        padding: 20px;
        background: var(--dark);
        color: white;
        margin-top: 40px;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .modal-content {
            width: 98%;
            margin: 1% auto;
        }
    }

    @media (max-width: 992px) {
        .content {
            padding: 15px;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .action-buttons {
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .header {
            padding: 0 15px;
        }
        
        .tabs {
            flex-wrap: wrap;
        }
        
        .tab {
            flex: 1;
            min-width: 120px;
            text-align: center;
        }
        
        .modal-body {
            padding: 15px;
        }
        
        .matching-section {
            padding: 15px;
        }
        
        .btn {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .page-title {
            font-size: 1.5rem;
        }
        
        .modal-header {
            padding: 15px;
        }
        
        .modal-title {
            font-size: 1.1rem;
        }
        
        .tolerance-form {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- DASHBOARD MAIN CONTENT -->
<div class="home-section">
  <div class="text">Dashboard</div>
        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <!-- Content Area -->
            <div class="content">
                <h1 class="page-title">Vendor Management</h1>

                <!-- Display messages -->
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert-box alert-success" style="margin-bottom: 20px;">
                        <i class="fas fa-check-circle"></i> <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert-box alert-danger" style="margin-bottom: 20px;">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <!-- Tabs -->
                <div class="tabs">
                    <button class="tab active" onclick="openTab('invoices')">Invoice Records</button>
                    <button class="tab" onclick="openTab('exception')">Exception Queue</button>
                    <button class="tab" onclick="openTab('tolerance')">Tolerance Settings</button>
                </div>

                <!-- Invoice Records Tab -->
                <div id="invoices" class="tab-content active">
                    <!-- Invoice Table Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Invoice Records</h2>
                            <div>
                                <button class="btn btn-match" id="downloadCSV"><i class="fas fa-download"></i> Export CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="invoiceSearch" placeholder="Search Invoice No, Vendor, Amount...">
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Invoice No.</th>
                                            <th>Vendor</th>
                                            <th>Invoice Date</th>
                                            <th>Due Date</th>
                                            <th>Invoice Amount</th>
                                            <th>Status</th>
                                            <th>PO Reference</th>
                                            <th>GRN Reference</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($regularInvoices as $invoice): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($invoice['invoice_number']); ?></td>
                                            <td><?php echo htmlspecialchars($invoice['vendor_name']); ?></td>
                                            <td><?php echo htmlspecialchars($invoice['invoice_date']); ?></td>
                                            <td><?php echo htmlspecialchars($invoice['due_date']); ?></td>
                                            <td>P<?php echo number_format($invoice['invoice_amount'], 2); ?></td>
                                            <td>
                                                <span class="status status-<?php echo $invoice['status']; ?>">
                                                    <?php echo ucfirst(str_replace('-', ' ', $invoice['status'])); ?>
                                                </span>
                                            </td>
                                            <td><?php echo htmlspecialchars($invoice['po_reference']); ?></td>
                                            <td><?php echo htmlspecialchars($invoice['grn_reference']); ?></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-view btn-sm" onclick="openModal('viewModal', '<?php echo $invoice['invoice_number']; ?>')">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>
                                                    <?php if ($invoice['status'] == 'pending'): ?>
                                                    <button class="btn btn-match btn-sm" onclick="updateStatus('<?php echo $invoice['invoice_number']; ?>', 'matching')">
                                                        <i class="fas fa-check-double"></i> Match
                                                    </button>
                                                    <?php elseif ($invoice['status'] == 'matching'): ?>
                                                    <button class="btn btn-approve btn-sm" onclick="updateStatus('<?php echo $invoice['invoice_number']; ?>', 'matched')">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                    <button class="btn btn-partial btn-sm" onclick="updateStatus('<?php echo $invoice['invoice_number']; ?>', 'partial-matched')">
                                                        <i class="fas fa-adjust"></i> Partial
                                                    </button>
                                                    <button class="btn btn-reject btn-sm" onclick="updateStatus('<?php echo $invoice['invoice_number']; ?>', 'mismatched')">
                                                        <i class="fas fa-times"></i> Reject
                                                    </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exception Queue Tab -->
                <div id="exception" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Exception Queue</h2>
                            <span class="status status-warning"><?php echo count($exceptionInvoices); ?> Items Requiring Attention</span>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="exceptionSearch" placeholder="Search exception items...">
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Invoice No.</th>
                                            <th>Vendor</th>
                                            <th>Invoice Amount</th>
                                            <th>Status</th>
                                            <th>Discrepancy Type</th>
                                            <th>Price Variance</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($exceptionInvoices as $invoice): 
                                            $invoiceDetails = getInvoiceDetails($conn, $invoice['invoice_number']);
                                            $matchingResults = calculateMatchingResults($invoiceDetails, $toleranceSettings);
                                            
                                            // Determine discrepancy type based on actual variances
                                            $discrepancyType = 'Price Variance';
                                            if ($invoice['status'] == 'partial-matched') {
                                                $discrepancyType = 'Quantity Variance';
                                            } elseif (count($matchingResults['alerts']) > 0) {
                                                if (in_array("Tax variance exceeds tolerance limits!", $matchingResults['alerts'])) {
                                                    $discrepancyType = 'Tax Variance';
                                                }
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($invoice['invoice_number']); ?></td>
                                            <td><?php echo htmlspecialchars($invoice['vendor_name']); ?></td>
                                            <td>P<?php echo number_format($invoice['invoice_amount'], 2); ?></td>
                                            <td>
                                                <span class="status status-<?php echo $invoice['status']; ?>">
                                                    <?php echo ucfirst(str_replace('-', ' ', $invoice['status'])); ?>
                                                </span>
                                            </td>
                                            <td><?php echo $discrepancyType; ?></td>
                                            <td class="variance <?php echo $matchingResults['price_variance'] < 0 ? 'negative' : 'positive'; ?>">
                                                <?php echo ($matchingResults['price_variance'] >= 0 ? '+' : '') . 'P' . number_format($matchingResults['price_variance'], 2); ?>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-view btn-sm" onclick="openModal('viewModal', '<?php echo $invoice['invoice_number']; ?>')">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>
                                                    <button class="btn btn-approve btn-sm" onclick="approveException('<?php echo $invoice['invoice_number']; ?>')">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                    <button class="btn btn-notify btn-sm" onclick="notifyProcurement('<?php echo $invoice['invoice_number']; ?>')">
                                                        <i class="fas fa-bell"></i> Notify Procurement
                                                    </button>
                                                    <button class="btn btn-escalate btn-sm" onclick="escalateCFO('<?php echo $invoice['invoice_number']; ?>')">
                                                        <i class="fas fa-exclamation-triangle"></i> Escalate to CFO
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tolerance Settings Tab -->
                <div id="tolerance" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Tolerance Settings</h2>
                            <button class="btn btn-match" onclick="saveToleranceSettings()"><i class="fas fa-save"></i> Save Settings</button>
                        </div>
                        <div class="card-body">
                            <div class="alert-box alert-info">
                                <i class="fas fa-info-circle"></i> Set tolerance thresholds for automatic invoice matching approval.
                            </div>
                            
                            <form id="toleranceForm" method="POST">
                                <input type="hidden" name="action" value="save_tolerance">
                                <div class="tolerance-form">
                                    <div class="form-group">
                                        <label class="form-label">Price Variance Tolerance</label>
                                        <div class="form-row">
                                            <div class="form-col">
                                                <input type="number" class="form-control" name="priceTolerancePercent" 
                                                       value="<?php echo $toleranceSettings['price_tolerance_percent']; ?>" 
                                                       step="0.1" min="0" max="100" required>
                                                <small>Percentage (%)</small>
                                            </div>
                                            <div class="form-col">
                                                <input type="number" class="form-control" name="priceToleranceUnit" 
                                                       value="<?php echo $toleranceSettings['price_tolerance_unit']; ?>" 
                                                       step="1" min="0" required>
                                                <small>Fixed Amount (P)</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Quantity Variance Tolerance</label>
                                        <div class="form-row">
                                            <div class="form-col">
                                                <input type="number" class="form-control" name="qtyTolerancePercent" 
                                                       value="<?php echo $toleranceSettings['qty_tolerance_percent']; ?>" 
                                                       step="0.1" min="0" max="100" required>
                                                <small>Percentage (%)</small>
                                            </div>
                                            <div class="form-col">
                                                <input type="number" class="form-control" name="qtyToleranceUnit" 
                                                       value="<?php echo $toleranceSettings['qty_tolerance_unit']; ?>" 
                                                       step="1" min="0" required>
                                                <small>Fixed Quantity</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Tax Variance Tolerance</label>
                                        <div class="form-row">
                                            <div class="form-col">
                                                <input type="number" class="form-control" name="taxTolerancePercent" 
                                                       value="<?php echo $toleranceSettings['tax_tolerance_percent']; ?>" 
                                                       step="0.1" min="0" max="100" required>
                                                <small>Percentage (%)</small>
                                            </div>
                                            <div class="form-col">
                                                <input type="number" class="form-control" name="taxToleranceUnit" 
                                                       value="<?php echo $toleranceSettings['tax_tolerance_unit']; ?>" 
                                                       step="1" min="0" required>
                                                <small>Fixed Amount (P)</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Escalation Threshold</label>
                                        <input type="number" class="form-control" name="escalationThreshold" 
                                               value="<?php echo $toleranceSettings['escalation_threshold']; ?>" 
                                               step="100" min="0" required>
                                        <small>Amount (P) requiring CFO/Finance Director approval</small>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Auto-Approval</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="autoApprove" id="autoApprove" 
                                                   <?php echo $toleranceSettings['auto_approve'] ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="autoApprove">Auto-approve invoices within tolerance limits</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Vendor Invoice Management</p>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Invoice Details</h2>
                <span class="close" onclick="closeModal('viewModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div id="modalContent">
                    <!-- Content will be dynamically loaded via AJAX -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-view" onclick="closeModal('viewModal')"><i class="fas fa-times"></i> Close</button>
                <button type="button" class="btn btn-match" id="printBtn"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
    </div>

    <!-- Status Update Form -->
    <form id="statusForm" method="POST" style="display: none;">
        <input type="hidden" name="action" value="update_status">
        <input type="hidden" name="invoice_number" id="invoiceNumber">
        <input type="hidden" name="status" id="newStatus">
    </form>

    <script>
        // Tab functionality
        function openTab(tabName) {
            const tabs = document.querySelectorAll('.tab-content');
            const tabButtons = document.querySelectorAll('.tab');
            
            tabs.forEach(tab => tab.classList.remove('active'));
            tabButtons.forEach(button => button.classList.remove('active'));
            
            document.getElementById(tabName).classList.add('active');
            event.currentTarget.classList.add('active');
        }

        // Modal functionality with AJAX
        function openModal(modalId, invoiceNumber) {
            // Load invoice details via AJAX
            fetch('get_invoice_details.php?invoice_number=' + invoiceNumber)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('modalContent').innerHTML = data;
                    document.getElementById(modalId).style.display = 'block';
                })
                .catch(error => {
                    console.error('Error loading invoice details:', error);
                    document.getElementById('modalContent').innerHTML = '<p>Error loading invoice details.</p>';
                    document.getElementById(modalId).style.display = 'block';
                });
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Status update function
        function updateStatus(invoiceNumber, newStatus) {
            if (confirm(`Are you sure you want to update ${invoiceNumber} to ${newStatus.replace('-', ' ')}?`)) {
                document.getElementById('invoiceNumber').value = invoiceNumber;
                document.getElementById('newStatus').value = newStatus;
                document.getElementById('statusForm').submit();
            }
        }

        function approveException(invoiceNumber) {
            if (confirm(`Approve exception for ${invoiceNumber}? This will move it back to invoice records as Matched.`)) {
                document.getElementById('invoiceNumber').value = invoiceNumber;
                document.getElementById('newStatus').value = 'matched';
                document.getElementById('statusForm').submit();
            }
        }

        function notifyProcurement(invoiceNumber) {
            alert(`Procurement team notified about ${invoiceNumber}`);
        }

        function escalateCFO(invoiceNumber) {
            if (confirm(`Escalate ${invoiceNumber} to CFO for approval?`)) {
                alert(`Invoice ${invoiceNumber} escalated to CFO.`);
            }
        }

        function saveToleranceSettings() {
            document.getElementById('toleranceForm').submit();
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });

        // Search functionality
        document.getElementById('invoiceSearch')?.addEventListener('input', function() {
            filterTable(this.value, 'invoices');
        });

        document.getElementById('exceptionSearch')?.addEventListener('input', function() {
            filterTable(this.value, 'exception');
        });

        function filterTable(searchText, tableType) {
            const searchTerm = searchText.toLowerCase();
            const rows = document.querySelectorAll(`#${tableType} tbody tr`);
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let found = false;
                
                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchTerm)) {
                        found = true;
                    }
                });
                
                row.style.display = found ? '' : 'none';
            });
        }

        // Print functionality
        document.getElementById('printBtn')?.addEventListener('click', function() {
            window.print();
        });
    </script>

</div>

  <script src="../PANEL/ASSETS/js/script-p.js"></script>
</body>
</html>
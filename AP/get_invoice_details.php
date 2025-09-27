<?php
session_start();
include "../CONFIG/config_ap.php";

if (isset($_GET['invoice_number'])) {
    $invoiceNumber = $_GET['invoice_number'];
    
    // Function to get invoice details (same as in vendor_m.php)
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
                    'line_variance' => 0,
                    'qty_variance_percent' => 0,
                    'price_variance_percent' => 0
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
                $itemResult['qty_variance_percent'] = $itemResult['grn_qty'] > 0 ? 
                    ($itemResult['qty_variance'] / $itemResult['grn_qty']) * 100 : 0;
                $itemResult['price_variance_percent'] = $itemResult['po_price'] > 0 ? 
                    ($itemResult['price_variance'] / $itemResult['po_price']) * 100 : 0;
                
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
    
    $invoice = getInvoiceDetails($conn, $invoiceNumber);
    $toleranceSettings = $conn->query("SELECT * FROM tolerance_settings ORDER BY id DESC LIMIT 1")->fetch_assoc();
    $matchingResults = calculateMatchingResults($invoice, $toleranceSettings);
    
    if ($invoice) {
        if (in_array($invoice['status'], ['pending'])) {
            // Basic invoice view for pending and matched statuses
            echo '
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Invoice No.</label>
                        <p>'.$invoice['invoice_number'].'</p>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Vendor</label>
                        <p>'.$invoice['vendor_name'].'</p>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Invoice Date</label>
                        <p>'.$invoice['invoice_date'].'</p>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Due Date</label>
                        <p>'.$invoice['due_date'].'</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Invoice Amount</label>
                <p style="font-size: 1.2rem; font-weight: bold; color: var(--dark);">P'.number_format($invoice['invoice_amount'], 2).'</p>
            </div>

            <h3 class="form-label">Invoice Line Items</h3>
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Item Description</th>
                        <th>Qty Billed</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>';
            
            $netTotal = 0;
            $taxTotal = 0;
            
            foreach ($invoice['line_items'] as $item) {
                $type = $item['is_tax'] ? 'Tax' : 'Product';
                if ($item['is_tax']) {
                    $taxTotal += $item['subtotal'];
                } else {
                    $netTotal += $item['subtotal'];
                }
                
                echo '<tr>
                    <td>'.htmlspecialchars($item['item_description']).'</td>
                    <td>'.($item['is_tax'] ? '-' : $item['quantity_billed']).'</td>
                    <td>P'.number_format($item['unit_price'], 2).'</td>
                    <td>P'.number_format($item['subtotal'], 2).'</td>
                    <td>'.$type.'</td>
                </tr>';
            }
            
            // Add summary row
            echo '<tr style="font-weight: bold; background-color: #f8f9fa;">
                    <td colspan="3" style="text-align: right;">Net Total:</td>
                    <td>P'.number_format($netTotal, 2).'</td>
                    <td></td>
                </tr>
                <tr style="font-weight: bold; background-color: #f8f9fa;">
                    <td colspan="3" style="text-align: right;">Tax Total:</td>
                    <td>P'.number_format($taxTotal, 2).'</td>
                    <td></td>
                </tr>
                <tr style="font-weight: bold; background-color: #e8f4fd;">
                    <td colspan="3" style="text-align: right;">Grand Total:</td>
                    <td>P'.number_format($invoice['invoice_amount'], 2).'</td>
                    <td></td>
                </tr>';
            
            echo '</tbody>
            </table>';

            if ($invoice['attachment_path']) {
                echo '
                <div class="form-group">
                    <label class="form-label">Invoice Attachment</label>
                    <div class="attachment-preview" onclick="viewAttachment(\''.basename($invoice['attachment_path']).'\')">
                        <i class="fas fa-file-pdf"></i>
                        <p>'.basename($invoice['attachment_path']).' (Click to view)</p>
                    </div>
                </div>';
            }
        } else {
            // Enhanced view with matching for matching, partial-matched, mismatched statuses
            echo '
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Invoice No.</label>
                        <p>'.$invoice['invoice_number'].'</p>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Vendor</label>
                        <p>'.$invoice['vendor_name'].'</p>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Invoice Date</label>
                        <p>'.$invoice['invoice_date'].'</p>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Due Date</label>
                        <p>'.$invoice['due_date'].'</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Invoice Amount</label>
                <p style="font-size: 1.2rem; font-weight: bold; color: var(--dark);">P'.number_format($invoice['invoice_amount'], 2).'</p>
            </div>

            <!-- Invoice Section -->
            <div class="matching-section">
                <h4><i class="fas fa-file-invoice"></i> Invoice Details</h4>
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Item Description</th>
                            <th>Qty Billed</th>
                            <th>Unit Price</th>
                            <th>Subtotal</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            $invoiceNet = 0;
            $invoiceTax = 0;
            
            foreach ($invoice['line_items'] as $item) {
                $type = $item['is_tax'] ? 'Tax' : 'Product';
                if ($item['is_tax']) {
                    $invoiceTax += $item['subtotal'];
                } else {
                    $invoiceNet += $item['subtotal'];
                }
                
                echo '<tr>
                    <td>'.htmlspecialchars($item['item_description']).'</td>
                    <td>'.($item['is_tax'] ? '-' : $item['quantity_billed']).'</td>
                    <td>P'.number_format($item['unit_price'], 2).'</td>
                    <td>P'.number_format($item['subtotal'], 2).'</td>
                    <td>'.$type.'</td>
                </tr>';
            }
            
            echo '<tr style="font-weight: bold; background-color: #f8f9fa;">
                    <td colspan="3" style="text-align: right;">Net Total:</td>
                    <td>P'.number_format($invoiceNet, 2).'</td>
                    <td></td>
                </tr>
                <tr style="font-weight: bold; background-color: #f8f9fa;">
                    <td colspan="3" style="text-align: right;">Tax Total:</td>
                    <td>P'.number_format($invoiceTax, 2).'</td>
                    <td></td>
                </tr>
                <tr style="font-weight: bold; background-color: #e8f4fd;">
                    <td colspan="3" style="text-align: right;">Grand Total:</td>
                    <td>P'.number_format($invoice['invoice_amount'], 2).'</td>
                    <td></td>
                </tr>';
            
            echo '</tbody>
                </table>';
            
            if ($invoice['attachment_path']) {
                echo '<div class="attachment-preview" onclick="viewAttachment(\''.basename($invoice['attachment_path']).'\')">
                    <i class="fas fa-file-pdf"></i>
                    <p>'.basename($invoice['attachment_path']).'</p>
                </div>';
            }
            
            echo '</div>';

            // PO Section
            if ($invoice['po_details']) {
                echo '
                <div class="matching-section">
                    <h4><i class="fas fa-shopping-cart"></i> Purchase Order Reference</h4>
                    <div class="form-group">
                        <label class="form-label">PO Number: </label>'.$invoice['po_details']['po_number'].'
                    </div>
                    <div class="form-group">
                        <label class="form-label">Order Date: </label>'.$invoice['po_details']['order_date'].'
                    </div>
                    <table class="comparison-table">
                        <thead>
                            <tr>
                                <th>Item Description</th>
                                <th>Qty Ordered</th>
                                <th>Agreed Price</th>
                                <th>Subtotal</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>';
                
                $poNet = 0;
                $poTax = 0;
                
                foreach ($invoice['po_details']['line_items'] as $item) {
                    $type = $item['is_tax'] ? 'Tax' : 'Product';
                    if ($item['is_tax']) {
                        $poTax += $item['subtotal'];
                    } else {
                        $poNet += $item['subtotal'];
                    }
                    
                    echo '<tr>
                        <td>'.htmlspecialchars($item['item_description']).'</td>
                        <td>'.($item['is_tax'] ? '-' : $item['quantity_ordered']).'</td>
                        <td>P'.number_format($item['agreed_price'], 2).'</td>
                        <td>P'.number_format($item['subtotal'], 2).'</td>
                        <td>'.$type.'</td>
                    </tr>';
                }
                
                echo '<tr style="font-weight: bold; background-color: #f8f9fa;">
                        <td colspan="3" style="text-align: right;">Net Total:</td>
                        <td>P'.number_format($poNet, 2).'</td>
                        <td></td>
                    </tr>
                    <tr style="font-weight: bold; background-color: #f8f9fa;">
                        <td colspan="3" style="text-align: right;">Tax Total:</td>
                        <td>P'.number_format($poTax, 2).'</td>
                        <td></td>
                    </tr>
                    <tr style="font-weight: bold; background-color: #e8f4fd;">
                        <td colspan="3" style="text-align: right;">Grand Total:</td>
                        <td>P'.number_format($invoice['po_details']['total_amount'], 2).'</td>
                        <td></td>
                    </tr>';
                
                echo '</tbody>
                    </table>';
                
                if ($invoice['po_details']['attachment_path']) {
                    echo '<div class="attachment-preview" onclick="viewAttachment(\''.basename($invoice['po_details']['attachment_path']).'\')">
                        <i class="fas fa-file-pdf"></i>
                        <p>'.basename($invoice['po_details']['attachment_path']).'</p>
                    </div>';
                }
                
                echo '</div>';
            }

            // GRN Section
            if ($invoice['grn_details']) {
                echo '
                <div class="matching-section">
                    <h4><i class="fas fa-truck-loading"></i> Goods Received Note</h4>
                    <div class="form-group">
                        <label class="form-label">GRN Number: </label>'.$invoice['grn_details']['grn_number'].'
                    </div>
                    <div class="form-group">
                        <label class="form-label">Received Date: </label>'.$invoice['grn_details']['received_date'].'
                    </div>
                    <table class="comparison-table">
                        <thead>
                            <tr>
                                <th>Item Description</th>
                                <th>Qty Received</th>
                            </tr>
                        </thead>
                        <tbody>';
                
                foreach ($invoice['grn_details']['line_items'] as $item) {
                    echo '<tr>
                        <td>'.htmlspecialchars($item['item_description']).'</td>
                        <td>'.$item['quantity_received'].'</td>
                    </tr>';
                }
                
                echo '</tbody>
                    </table>';
                
                if ($invoice['grn_details']['attachment_path']) {
                    echo '<div class="attachment-preview" onclick="viewAttachment(\''.basename($invoice['grn_details']['attachment_path']).'\')">
                        <i class="fas fa-file-pdf"></i>
                        <p>'.basename($invoice['grn_details']['attachment_path']).'</p>
                    </div>';
                }
                
                echo '</div>';
            }

            // Matching Results
            if ($invoice['po_details'] && $invoice['grn_details']) {
                echo '
                <div class="matching-section">
                    <h4><i class="fas fa-check-double"></i> 3-Way Matching Results</h4>
                    
                    <!-- Variance Dashboard -->
                    <div class="form-row" style="margin-bottom: 20px;">
                        <div class="form-col">
                            <div class="form-group" style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                <label class="form-label">Invoice Net</label>
                                <p style="font-size: 1.5rem; font-weight: bold; color: var(--dark);">P'.number_format($matchingResults['invoice_net'], 2).'</p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group" style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                <label class="form-label">PO Net</label>
                                <p style="font-size: 1.5rem; font-weight: bold; color: var(--dark);">P'.number_format($matchingResults['po_net'], 2).'</p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group" style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                <label class="form-label">Price Variance</label>
                                <p style="font-size: 1.5rem; font-weight: bold; color: '.($matchingResults['price_variance'] >= 0 ? 'var(--success)' : 'var(--accent)').';">'
                                .($matchingResults['price_variance'] >= 0 ? '+' : '').'P'.number_format($matchingResults['price_variance'], 2).'<br>
                                <small>('.number_format($matchingResults['price_variance_percent'], 2).'%)</small></p>
                            </div>
                        </div>
                    </div>

                    <div class="form-row" style="margin-bottom: 20px;">
                        <div class="form-col">
                            <div class="form-group" style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                <label class="form-label">Invoice Tax</label>
                                <p style="font-size: 1.5rem; font-weight: bold; color: var(--dark);">P'.number_format($matchingResults['invoice_tax'], 2).'</p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group" style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                <label class="form-label">PO Tax</label>
                                <p style="font-size: 1.5rem; font-weight: bold; color: var(--dark);">P'.number_format($matchingResults['po_tax'], 2).'</p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group" style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                <label class="form-label">Tax Variance</label>
                                <p style="font-size: 1.5rem; font-weight: bold; color: '.($matchingResults['tax_variance'] >= 0 ? 'var(--success)' : 'var(--accent)').';">'
                                .($matchingResults['tax_variance'] >= 0 ? '+' : '').'P'.number_format($matchingResults['tax_variance'], 2).'<br>
                                <small>('.number_format($matchingResults['tax_variance_percent'], 2).'%)</small></p>
                            </div>
                        </div>
                    </div>

                    <table class="comparison-table">
                        <thead>
                            <tr>
                                <th>Item Description</th>
                                <th>Invoice Qty</th>
                                <th>PO Qty</th>
                                <th>GRN Qty</th>
                                <th>Qty Variance</th>
                                <th>Invoice Price</th>
                                <th>PO Price</th>
                                <th>Price Variance</th>
                                <th>Line Variance</th>
                            </tr>
                        </thead>
                        <tbody>';
                
                foreach ($matchingResults['items'] as $item) {
                    echo '<tr>
                        <td>'.htmlspecialchars($item['description']).'</td>
                        <td>'.$item['invoice_qty'].'</td>
                        <td>'.$item['po_qty'].'</td>
                        <td>'.$item['grn_qty'].'</td>
                        <td class="variance '.($item['qty_variance'] == 0 ? 'within-tolerance' : ($item['qty_variance'] > 0 ? 'positive' : 'negative')).'">
                            '.($item['qty_variance'] > 0 ? '+' : '').$item['qty_variance'].'
                            <br><small>('.number_format($item['qty_variance_percent'], 2).'%)</small>
                        </td>
                        <td>P'.number_format($item['invoice_price'], 2).'</td>
                        <td>P'.number_format($item['po_price'], 2).'</td>
                        <td class="variance '.($item['price_variance'] == 0 ? 'within-tolerance' : ($item['price_variance'] > 0 ? 'positive' : 'negative')).'">
                            '.($item['price_variance'] > 0 ? '+' : '').'P'.number_format($item['price_variance'], 2).'
                            <br><small>('.number_format($item['price_variance_percent'], 2).'%)</small>
                        </td>
                        <td class="variance '.($item['line_variance'] == 0 ? 'within-tolerance' : ($item['line_variance'] > 0 ? 'positive' : 'negative')).'">
                            '.($item['line_variance'] > 0 ? '+' : '').'P'.number_format($item['line_variance'], 2).'
                        </td>
                    </tr>';
                }
                
                echo '</tbody>
                    </table>';

                // Alerts based on status and tolerance violations
                if ($invoice['status'] == 'matching') {
                    if (count($matchingResults['alerts']) === 0) {
                        echo '<div class="alert-box alert-success">
                            <i class="fas fa-check-circle"></i> All items matched within tolerance limits. Ready for approval.
                        </div>';
                    } else {
                        echo '<div class="alert-box alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Some variances detected but within review limits.
                        </div>';
                    }
                } elseif ($invoice['status'] == 'partial-matched') {
                    echo '<div class="alert-box alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Partial match detected. Quantity variance requires attention.
                    </div>';
                } elseif ($invoice['status'] == 'mismatched') {
                    echo '<div class="alert-box alert-danger">
                        <i class="fas fa-times-circle"></i> Mismatch detected. Significant variances exceed tolerance limits.
                    </div>';
                }

                // Show specific tolerance violation alerts
                foreach ($matchingResults['alerts'] as $alert) {
                    $alertClass = strpos($alert, 'exceeds') !== false ? 'alert-danger' : 'alert-warning';
                    echo '<div class="alert-box '.$alertClass.'">
                        <i class="fas fa-exclamation-circle"></i> '.$alert.'
                    </div>';
                }
                
                echo '</div>';
            }
        }
    } else {
        echo '<p>Invoice not found.</p>';
    }
} else {
    echo '<p>Invalid request.</p>';
}
?>
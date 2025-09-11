<?php
include '../CONFIG/config_ap.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vendorId = $_POST['vendorId'];
    $invoiceNumber = $_POST['invoiceNumber'];
    $invoiceDate = $_POST['invoiceDate'];
    $dueDate = $_POST['dueDate'];
    $poRef = $_POST['poRef'];
    $grnRef = $_POST['grnRef'];

    // Totals from JS frontend
    $subtotal = $_POST['subtotal'];
    $taxTotal = $_POST['taxTotal'];
    $grandTotal = $_POST['grandTotal'];

    // Insert invoice header
    $stmt = $conn->prepare("INSERT INTO invoices 
        (vendor_id, invoice_number, invoice_date, due_date, po_ref, grn_ref, subtotal, tax_total, grand_total, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $status = "Draft"; // default for save draft
    $stmt->bind_param("ssssssddds", $vendorId, $invoiceNumber, $invoiceDate, $dueDate, $poRef, $grnRef, $subtotal, $taxTotal, $grandTotal, $status);
    $stmt->execute();
    $invoiceId = $stmt->insert_id;
    $stmt->close();

    // Insert line items
    if (!empty($_POST['line_desc'])) {
        foreach ($_POST['line_desc'] as $index => $desc) {
            $qty = $_POST['line_qty'][$index];
            $unitPrice = $_POST['line_price'][$index];
            $tax = $_POST['line_tax'][$index];
            $lineSubtotal = $_POST['line_subtotal'][$index];

            $stmt = $conn->prepare("INSERT INTO invoice_lines (invoice_id, description, qty, unit_price, tax, subtotal) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isiddd", $invoiceId, $desc, $qty, $unitPrice, $tax, $lineSubtotal);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Handle attachment
    if (isset($_FILES['attachments']) && $_FILES['attachments']['error'] == 0) {
        $uploadDir = "upload/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES["attachments"]["name"]);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES["attachments"]["tmp_name"], $targetFile)) {
            $stmt = $conn->prepare("INSERT INTO invoice_attachments (invoice_id, file_path) VALUES (?, ?)");
            $stmt->bind_param("is", $invoiceId, $targetFile);
            $stmt->execute();
            $stmt->close();
        }
    }

    echo "Invoice saved successfully!";
    $conn->close();
}
?>

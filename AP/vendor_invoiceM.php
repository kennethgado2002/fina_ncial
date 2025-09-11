<?php
session_start();
include "../PANEL/panel.php";
?>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --success: #2ecc71;
            --warning: #f39c12;
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

        .menu-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            transition: var(--transition);
            border-left: 4px solid transparent;
            white-space: nowrap;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--secondary);
            cursor: pointer;
        }

        .menu-item i {
            margin-right: 15px;
            font-size: 1.2rem;
            transition: var(--transition);
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

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
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

        /* Form Styles */
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
            padding: 12px 15px;
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

        /* Line Items Table */
        .line-items {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .line-items th, .line-items td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .line-items th {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .line-items input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-family: 'Lato', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-primary {
            background-color: var(--secondary);
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-success {
            background-color: var(--success);
            color: white;
        }

        .btn-success:hover {
            background-color: #27ae60;
        }

        .btn-danger {
            background-color: var(--accent);
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.9rem;
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            background-color: #f8f9fa;
        }

        tr {
            transition: var(--transition);
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-draft {
            background-color: #ffeaa7;
            color: #d35400;
        }

        .status-pending {
            background-color: #81ecec;
            color: #00b894;
        }

        .status-approved {
            background-color: #55efc4;
            color: #00b894;
        }

        .status-rejected {
            background-color: #ff7675;
            color: #d63031;
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
            margin: 5% auto;
            padding: 0;
            border-radius: 10px;
            width: 80%;
            max-width: 700px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            animation: modalFade 0.3s;
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
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
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
            max-height: 70vh;
            overflow-y: auto;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Attachment Preview */
        .attachment-preview {
            margin-top: 20px;
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
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
            }
            
            .table-responsive {
                overflow-x: auto;
            }
            
            th, td {
                white-space: nowrap;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 0 15px;
            }
            
            .content {
                padding: 15px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
            
            .modal-content {
                width: 95%;
                margin: 10% auto;
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
                <h1 class="page-title">Vendor Invoice Management</h1>

                <!-- Invoice Form Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">New Invoice</h2>
                    </div>
                    <div class="card-body">
                        <form id="invoiceForm">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label" for="vendorId">Vendor ID</label>
                                        <input type="text" class="form-control" id="vendorId" placeholder="Enter Vendor ID">
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label" for="invoiceNo">Invoice No.</label>
                                        <input type="text" class="form-control" id="invoiceNo" value="INV-2025-0001" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label" for="invoiceDate">Invoice Date</label>
                                        <input type="date" class="form-control" id="invoiceDate">
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label" for="dueDate">Due Date</label>
                                        <input type="date" class="form-control" id="dueDate">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label" for="poRef">PO Reference</label>
                                        <input type="text" class="form-control" id="poRef" placeholder="Enter PO Reference">
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label" for="grnRef">GRN Reference</label>
                                        <input type="text" class="form-control" id="grnRef" placeholder="Enter GRN Reference">
                                    </div>
                                </div>
                            </div>

                            <h3 class="form-label">Line Items</h3>
                            <table class="line-items">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th width="100">Qty</th>
                                        <th width="120">Unit Price</th>
                                        <th width="100">Tax (%)</th>
                                        <th width="120">Subtotal</th>
                                        <th width="50">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="lineItems">
                                    <tr>
                                        <td><input type="text" class="form-control" placeholder="Item description"></td>
                                        <td><input type="number" class="form-control qty" value="1" min="1"></td>
                                        <td><input type="number" class="form-control unit-price" value="0.00" step="0.01" min="0"></td>
                                        <td><input type="number" class="form-control tax" value="0.0" step="0.1" min="0"></td>
                                        <td><input type="text" class="form-control subtotal" value="0.00" readonly></td>
                                        <td><button type="button" class="btn btn-danger btn-sm remove-line"><i class="fas fa-times"></i></button></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" style="text-align: right;">
                                            <button type="button" class="btn btn-primary" id="addLineItem"><i class="fas fa-plus"></i> Add Item</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: right; font-weight: bold;">Total:</td>
                                        <td><input type="text" class="form-control" id="totalAmount" value="0.00" readonly></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="form-group">
                                <label class="form-label">Invoice Attachment</label>
                                <div class="attachment-preview" id="attachmentArea">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Click to upload invoice (PDF or Image)</p>
                                    <input type="file" id="invoiceAttachment" style="display: none;" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div>

                            <div class="action-buttons">
                                <button type="button" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</button>
                                <button type="button" class="btn btn-primary"><i class="fas fa-save"></i> Save Draft</button>
                                <button type="button" class="btn btn-success"><i class="fas fa-paper-plane"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Invoice Table Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Invoice Records</h2>
                        <div>
                            <button class="btn btn-primary" id="downloadCSV"><i class="fas fa-download"></i> CSV</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="invoiceSearch" placeholder="Search Invoice No, Vendor ID, Date, Due Date, Subtotal...">
                        </div>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Invoice No.</th>
                                        <th>Vendor ID</th>
                                        <th>Date</th>
                                        <th>Due Date</th>
                                        <th>Subtotal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>INV-2025-0001</td>
                                        <td>VEND-001</td>
                                        <td>2025-09-01</td>
                                        <td>2025-09-15</td>
                                        <td>P12,500.00</td>
                                        <td><span class="status status-draft">Draft</span></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-primary btn-sm" onclick="openModal('editModal')"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-danger btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>INV-2025-0002</td>
                                        <td>VEND-002</td>
                                        <td>2025-09-02</td>
                                        <td>2025-09-16</td>
                                        <td>P8,750.00</td>
                                        <td><span class="status status-pending">Pending</span></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-primary btn-sm" onclick="openModal('editModal')"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-danger btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>INV-2025-0003</td>
                                        <td>VEND-003</td>
                                        <td>2025-09-03</td>
                                        <td>2025-09-17</td>
                                        <td>P15,200.00</td>
                                        <td><span class="status status-approved">Approved</span></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-primary btn-sm" onclick="openModal('editModal')"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-danger btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>INV-2025-0004</td>
                                        <td>VEND-001</td>
                                        <td>2025-09-04</td>
                                        <td>2025-09-18</td>
                                        <td>P9,800.00</td>
                                        <td><span class="status status-rejected">Rejected</span></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-primary btn-sm" onclick="openModal('editModal')"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-danger btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Invoice No.</label>
                            <p>INV-2025-0001</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Vendor ID</label>
                            <p>VEND-001</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Invoice Date</label>
                            <p>2025-09-01</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Due Date</label>
                            <p>2025-09-15</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">PO Reference</label>
                            <p>PO-2025-0085</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">GRN Reference</label>
                            <p>GRN-2025-0092</p>
                        </div>
                    </div>
                </div>

                <h3 class="form-label">Line Items</h3>
                <table class="line-items">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Tax (%)</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Office Supplies</td>
                            <td>5</td>
                            <td>P1,500.00</td>
                            <td>12.0</td>
                            <td>P8,400.00</td>
                        </tr>
                        <tr>
                            <td>Software License</td>
                            <td>2</td>
                            <td>P2,000.00</td>
                            <td>0.0</td>
                            <td>P4,000.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: right; font-weight: bold;">Total:</td>
                            <td>P12,400.00</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="form-group">
                    <label class="form-label">Invoice Attachment</label>
                    <div class="attachment-preview" onclick="openModal('attachmentModal')">
                        <i class="fas fa-file-pdf"></i>
                        <p>invoice_20250001.pdf (Click to view)</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('viewModal')">Close</button>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Reject Invoice</h2>
                <span class="close" onclick="closeModal('rejectModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Invoice No.</label>
                    <p>INV-2025-0001</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="rejectReason">Reason for Rejection</label>
                    <textarea class="form-control" id="rejectReason" rows="4" placeholder="Please provide a reason for rejecting this invoice"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('rejectModal')">Cancel</button>
                <button type="button" class="btn btn-danger">Submit Rejection</button>
            </div>
        </div>
    </div>

    <!-- Attachment Modal -->
    <div id="attachmentModal" class="modal">
        <div class="modal-content" style="max-width: 800px;">
            <div class="modal-header">
                <h2 class="modal-title">Invoice Attachment</h2>
                <span class="close" onclick="closeModal('attachmentModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div style="text-align: center; padding: 20px;">
                    <i class="fas fa-file-pdf" style="font-size: 4rem; color: #e74c3c;"></i>
                    <h3 style="margin: 20px 0;">invoice_20250001.pdf</h3>
                    <embed src="#" width="100%" height="500px" style="border: 1px solid #ddd; border-radius: 8px;" />
                    <div style="margin-top: 20px;">
                        <button class="btn btn-primary"><i class="fas fa-download"></i> Download</button>
                        <button class="btn btn-secondary"><i class="fas fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add line item functionality
        document.getElementById('addLineItem').addEventListener('click', function() {
            const lineItems = document.getElementById('lineItems');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" class="form-control" placeholder="Item description"></td>
                <td><input type="number" class="form-control qty" value="1" min="1"></td>
                <td><input type="number" class="form-control unit-price" value="0.00" step="0.01" min="0"></td>
                <td><input type="number" class="form-control tax" value="0.0" step="0.1" min="0"></td>
                <td><input type="text" class="form-control subtotal" value="0.00" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-line"><i class="fas fa-times"></i></button></td>
            `;
            lineItems.appendChild(newRow);
            
            // Add event listeners to new inputs
            const inputs = newRow.querySelectorAll('input');
            inputs.forEach(input => {
                if (!input.classList.contains('subtotal')) {
                    input.addEventListener('input', calculateSubtotal);
                }
            });
            
            // Add event listener to remove button
            newRow.querySelector('.remove-line').addEventListener('click', function() {
                this.closest('tr').remove();
                calculateTotal();
            });
        });

        // Calculate subtotal for a line item
        function calculateSubtotal() {
            const row = this.closest('tr');
            const qty = parseFloat(row.querySelector('.qty').value) || 0;
            const unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
            const tax = parseFloat(row.querySelector('.tax').value) || 0;
            
            const subtotal = qty * unitPrice * (1 + (tax / 100));
            row.querySelector('.subtotal').value = subtotal.toFixed(2);
            
            calculateTotal();
        }

        // Calculate total for all line items
        function calculateTotal() {
            const subtotals = document.querySelectorAll('.subtotal');
            let total = 0;
            
            subtotals.forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            
            document.getElementById('totalAmount').value = total.toFixed(2);
        }

        // Add event listeners to existing inputs
        document.querySelectorAll('.qty, .unit-price, .tax').forEach(input => {
            input.addEventListener('input', calculateSubtotal);
        });

        // Add event listeners to remove buttons
        document.querySelectorAll('.remove-line').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('tr').remove();
                calculateTotal();
            });
        });

        // Attachment upload functionality
        document.getElementById('attachmentArea').addEventListener('click', function() {
            document.getElementById('invoiceAttachment').click();
        });

        document.getElementById('invoiceAttachment').addEventListener('change', function() {
            if (this.files.length > 0) {
                const fileName = this.files[0].name;
                const fileExtension = fileName.split('.').pop().toLowerCase();
                
                let iconClass = 'fas fa-file';
                if (fileExtension === 'pdf') {
                    iconClass = 'fas fa-file-pdf';
                } else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                    iconClass = 'fas fa-file-image';
                }
                
                document.querySelector('#attachmentArea i').className = iconClass;
                document.querySelector('#attachmentArea p').textContent = fileName;
            }
        });

        // Modal functionality
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.addEventListener('click', function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });

        // Search functionality
        document.getElementById('invoiceSearch').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let found = false;
                
                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchText)) {
                        found = true;
                    }
                });
                
                row.style.display = found ? '' : 'none';
            });
        });

        // Initialize calculations
        calculateSubtotal.call(document.querySelector('.qty'));
    </script>

</div>

  <script>
    /* ===== Search Filter ===== */
    function filterTable() {
      let input = document.getElementById("searchInput").value.toLowerCase();
      let rows = document.querySelectorAll("#invoiceTable tbody tr");
      rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
      });
    }

        /* ===== Line Item Calculations ===== */
    function calculateRow(el) {
      let row = el.closest("tr");
      let qty = parseFloat(row.cells[1].children[0].value) || 0;
      let unitPrice = parseFloat(row.cells[2].children[0].value) || 0;
      let tax = parseFloat(row.cells[3].children[0].value) || 0;
      let subtotal = qty * unitPrice;
      let taxAmount = subtotal * (tax / 100);
      row.cells[4].children[0].value = (subtotal + taxAmount).toFixed(2);
      calculateTotals();
    }
    function calculateTotals() {
      let rows = document.querySelectorAll("#lineItemsTable tbody tr");
      let subtotal = 0, taxTotal = 0, grandTotal = 0;
      rows.forEach(row => {
        let qty = parseFloat(row.cells[1].children[0].value) || 0;
        let unitPrice = parseFloat(row.cells[2].children[0].value) || 0;
        let tax = parseFloat(row.cells[3].children[0].value) || 0;
        let sub = qty * unitPrice;
        let taxAmt = sub * (tax / 100);
        subtotal += sub; taxTotal += taxAmt; grandTotal += sub + taxAmt;
      });
      document.getElementById("subtotalDisplay").innerText = "₱" + subtotal.toFixed(2);
      document.getElementById("taxDisplay").innerText = "₱" + taxTotal.toFixed(2);
      document.getElementById("grandTotalDisplay").innerText = "₱" + grandTotal.toFixed(2);
    }
    function addRow() {
      let table = document.getElementById("lineItemsTable").getElementsByTagName("tbody")[0];
      let newRow = table.rows[0].cloneNode(true);
      newRow.querySelectorAll("input").forEach((input, i) => { input.value = (i === 1) ? "1" : ""; });
      table.appendChild(newRow);
    }
    function removeRow(btn) {
      let row = btn.closest("tr");
      let table = document.getElementById("lineItemsTable").getElementsByTagName("tbody")[0];
      if (table.rows.length > 1) { row.remove(); calculateTotals(); }
    }

    /* ===== Modals ===== */
    function openModal(id) { document.getElementById(id).style.display = "flex"; }
    function closeModal(id) { document.getElementById(id).style.display = "none"; }

    /* ===== Approve Action ===== */
    function approveInvoice(btn) {
      let row = btn.closest("tr");
      row.querySelector(".status").innerText = "Approved";
      row.querySelector(".status").className = "status Approved";
    }
  </script>
  <script src="../PANEL/ASSETS/js/script-p.js"></script>
</body>
</html>

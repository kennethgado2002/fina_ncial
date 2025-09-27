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
            --refund-pending: #f39c12;
            --refund-approved: #3498db;
            --refund-processed: #2ecc71;
            --refund-rejected: #e74c3c;
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

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .dashboard-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .card-icon.blue {
            background-color: rgba(52, 152, 219, 0.2);
            color: #2980b9;
        }

        .card-icon.green {
            background-color: rgba(46, 204, 113, 0.2);
            color: #27ae60;
        }

        .card-icon.orange {
            background-color: rgba(243, 156, 18, 0.2);
            color: #d35400;
        }

        .card-icon.red {
            background-color: rgba(231, 76, 60, 0.2);
            color: #c0392b;
        }

        .dashboard-card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .dashboard-card p {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
        }

        .dashboard-card small {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        /* Tabs */
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .tab {
            padding: 12px 24px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border-bottom: 3px solid transparent;
        }

        .tab.active {
            border-bottom: 3px solid var(--secondary);
            color: var(--secondary);
        }

        .tab:hover {
            background-color: #f8f9fa;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
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

        /* Search Box */
        .search-box {
            position: relative;
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }

        .search-box input {
            flex: 1;
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

        .status-pending {
            background-color: var(--refund-pending);
            color: white;
        }

        .status-approved {
            background-color: var(--refund-approved);
            color: white;
        }

        .status-processed {
            background-color: var(--refund-processed);
            color: white;
        }

        .status-rejected {
            background-color: var(--refund-rejected);
            color: white;
        }

        /* Buttons */
        .btn {
            padding: 8px 15px;
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

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.9rem;
        }

        .btn-view {
            background-color: #dfe6e9;
            color: #636e72;
        }

        .btn-view:hover {
            background-color: #b2bec3;
        }

        .btn-approve {
            background-color: #00b894;
            color: white;
        }

        .btn-approve:hover {
            background-color: #00a382;
        }

        .btn-reject {
            background-color: #d63031;
            color: white;
        }

        .btn-reject:hover {
            background-color: #c23616;
        }

        .btn-process {
            background-color: #6c5ce7;
            color: white;
        }

        .btn-process:hover {
            background-color: #5649c0;
        }

        .btn-add {
            background-color: #00b894;
            color: white;
        }

        .btn-add:hover {
            background-color: #00a382;
        }

        .btn-download {
            background-color: #9b59b6;
            color: white;
        }

        .btn-download:hover {
            background-color: #8e44ad;
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
            width: 90%;
            max-width: 800px;
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

        /* Form Elements */
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-col {
            flex: 1;
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

        /* Workflow Steps */
        .workflow-steps {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            position: relative;
        }

        .workflow-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #ddd;
            z-index: 1;
        }

        .step {
            text-align: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }

        .step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 2px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            transition: var(--transition);
        }

        .step.active .step-icon {
            background: var(--secondary);
            border-color: var(--secondary);
            color: white;
        }

        .step.completed .step-icon {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        .step-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .step-desc {
            font-size: 0.8rem;
            color: #7f8c8d;
            margin-top: 5px;
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px;
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

            .workflow-steps {
                flex-direction: column;
                gap: 20px;
            }

            .workflow-steps::before {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 0 15px;
            }
            
            .content {
                padding: 15px;
            }
            
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
            
            .modal-content {
                width: 95%;
                margin: 10% auto;
            }
            
            .tabs {
                flex-wrap: wrap;
            }
            
            .tab {
                flex: 1;
                text-align: center;
                padding: 10px;
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
                <h1 class="page-title">Refunds & Credit Memos</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Pending Refunds</h3>
                        <p>15</p>
                        <small>Awaiting approval</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Approved</h3>
                        <p>8</p>
                        <small>Ready for processing</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <h3>Processing</h3>
                        <p>12</p>
                        <small>Being disbursed</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>Rejected</h3>
                        <p>5</p>
                        <small>Not approved</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="dashboard">Dashboard</div>
                    <div class="tab" data-tab="request">Request Refund</div>
                    <div class="tab" data-tab="credit">Credit Memo</div>
                    <div class="tab" data-tab="workflow">Approval Workflow</div>
                </div>

                <!-- Dashboard Tab -->
                <div class="tab-content active" id="dashboard-tab">
                    <!-- Refund Status Chart -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Refund Status Overview</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Time Period</span>
                                    <select class="filter-select" id="periodFilter">
                                        <option value="week">This Week</option>
                                        <option value="month" selected>This Month</option>
                                        <option value="quarter">This Quarter</option>
                                        <option value="year">This Year</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Department</span>
                                    <select class="filter-select" id="deptFilter">
                                        <option value="">All Departments</option>
                                        <option value="sales">Sales</option>
                                        <option value="service">Customer Service</option>
                                        <option value="returns">Returns Department</option>
                                    </select>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="refundStatusChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Refund Tracking Table -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Refund Tracking</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="refundSearch" placeholder="Search Customer, Invoice, or Refund ID...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Refund ID</th>
                                            <th>Customer</th>
                                            <th>Invoice #</th>
                                            <th>Amount</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>REF-2025-001</td>
                                            <td>John Smith</td>
                                            <td>INV-2025-085</td>
                                            <td>₱5,250.00</td>
                                            <td>2025-09-05</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('refundDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-002</td>
                                            <td>Maria Garcia</td>
                                            <td>INV-2025-092</td>
                                            <td>₱3,800.00</td>
                                            <td>2025-09-04</td>
                                            <td><span class="status status-approved">Approved</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('refundDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-paper-plane"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-003</td>
                                            <td>Robert Johnson</td>
                                            <td>INV-2025-078</td>
                                            <td>₱12,500.00</td>
                                            <td>2025-09-03</td>
                                            <td><span class="status status-processed">Processed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('refundDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-004</td>
                                            <td>Sarah Williams</td>
                                            <td>INV-2025-101</td>
                                            <td>₱2,300.00</td>
                                            <td>2025-09-02</td>
                                            <td><span class="status status-rejected">Rejected</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('refundDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-comment"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-005</td>
                                            <td>James Brown</td>
                                            <td>INV-2025-095</td>
                                            <td>₱7,600.00</td>
                                            <td>2025-09-01</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('refundDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Request Refund Tab -->
                <div class="tab-content" id="request-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Refund Request Form</h2>
                        </div>
                        <div class="card-body">
                            <form id="refundForm">
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Customer ID/Name</label>
                                            <input type="text" class="form-control" id="customerId" placeholder="Enter customer ID or name">
                                            <small>Start typing to search customers</small>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Invoice Reference #</label>
                                            <input type="text" class="form-control" id="invoiceRef" placeholder="Enter invoice number">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Reason for Refund</label>
                                            <select class="form-control" id="refundReason">
                                                <option value="">Select a reason</option>
                                                <option value="return">Product Return</option>
                                                <option value="damaged">Damaged Product</option>
                                                <option value="incorrect">Incorrect Product</option>
                                                <option value="duplicate">Duplicate Payment</option>
                                                <option value="discount">Price Adjustment</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Refund Amount (₱)</label>
                                            <input type="number" class="form-control" id="refundAmount" placeholder="Enter refund amount">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Detailed Explanation</label>
                                    <textarea class="form-control" id="refundExplanation" rows="3" placeholder="Provide detailed explanation for the refund request"></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Mode of Refund</label>
                                    <select class="form-control" id="refundMode">
                                        <option value="">Select refund method</option>
                                        <option value="credit">Credit to Account</option>
                                        <option value="bank">Bank Transfer</option>
                                        <option value="card">Credit Card Refund</option>
                                        <option value="check">Check</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Attachments (Optional)</label>
                                    <input type="file" class="form-control" id="refundAttachment">
                                    <small>Upload supporting documents (max 5MB)</small>
                                </div>

                                <div style="text-align: center; margin-top: 20px;">
                                    <button type="button" class="btn btn-primary">Submit Request</button>
                                    <button type="reset" class="btn btn-secondary">Clear Form</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Credit Memo Tab -->
                <div class="tab-content" id="credit-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Credit Memo Generator</h2>
                        </div>
                        <div class="card-body">
                            <form id="creditMemoForm">
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Customer Account</label>
                                            <input type="text" class="form-control" id="creditCustomer" placeholder="Enter customer ID or name">
                                            <small>Start typing to search customers</small>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Related Invoice #</label>
                                            <input type="text" class="form-control" id="creditInvoice" placeholder="Enter invoice number">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Credit Amount (₱)</label>
                                            <input type="number" class="form-control" id="creditAmount" placeholder="Enter credit amount">
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Credit Date</label>
                                            <input type="date" class="form-control" id="creditDate">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Reason for Credit</label>
                                    <select class="form-control" id="creditReason">
                                        <option value="">Select a reason</option>
                                        <option value="return">Product Return</option>
                                        <option value="discount">Price Adjustment/Discount</option>
                                        <option value="promo">Promotional Credit</option>
                                        <option value="service">Service Issue</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Memo Details</label>
                                    <textarea class="form-control" id="memoDetails" rows="3" placeholder="Provide details for this credit memo"></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Apply to</label>
                                    <div style="display: flex; gap: 15px;">
                                        <label style="display: flex; align-items: center;">
                                            <input type="radio" name="applyTo" value="invoice" checked> Specific Invoice
                                        </label>
                                        <label style="display: flex; align-items: center;">
                                            <input type="radio" name="applyTo" value="account"> Customer Account
                                        </label>
                                    </div>
                                </div>

                                <div style="text-align: center; margin-top: 20px;">
                                    <button type="button" class="btn btn-primary">Generate Credit Memo</button>
                                    <button type="button" class="btn btn-secondary">Preview</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Recent Credit Memos -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Recent Credit Memos</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Memo ID</th>
                                            <th>Customer</th>
                                            <th>Invoice #</th>
                                            <th>Amount</th>
                                            <th>Issue Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>CM-2025-001</td>
                                            <td>John Smith</td>
                                            <td>INV-2025-085</td>
                                            <td>₱5,250.00</td>
                                            <td>2025-09-05</td>
                                            <td><span class="status status-processed">Applied</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>CM-2025-002</td>
                                            <td>Maria Garcia</td>
                                            <td>INV-2025-092</td>
                                            <td>₱3,800.00</td>
                                            <td>2025-09-04</td>
                                            <td><span class="status status-processed">Applied</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>CM-2025-003</td>
                                            <td>Robert Johnson</td>
                                            <td>INV-2025-078</td>
                                            <td>₱12,500.00</td>
                                            <td>2025-09-03</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approval Workflow Tab -->
                <div class="tab-content" id="workflow-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Refund Approval Workflow</h2>
                        </div>
                        <div class="card-body">
                            <div class="workflow-steps">
                                <div class="step completed">
                                    <div class="step-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="step-title">Request</div>
                                    <div class="step-desc">Refund requested by customer or staff</div>
                                </div>
                                <div class="step completed">
                                    <div class="step-icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="step-title">Validation</div>
                                    <div class="step-desc">Verify eligibility and documentation</div>
                                </div>
                                <div class="step active">
                                    <div class="step-icon">
                                        <i class="fas fa-thumbs-up"></i>
                                    </div>
                                    <div class="step-title">Approval</div>
                                    <div class="step-desc">Manager approval required</div>
                                </div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="fas fa-paper-plane"></i>
                                    </div>
                                    <div class="step-title">Execution</div>
                                    <div class="step-desc">Process refund payment</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Select Refund Request</label>
                                <select class="form-control" id="workflowRefund">
                                    <option value="">Select a refund to view workflow</option>
                                    <option value="ref-001">REF-2025-001 - John Smith - ₱5,250.00</option>
                                    <option value="ref-002">REF-2025-002 - Maria Garcia - ₱3,800.00</option>
                                    <option value="ref-003">REF-2025-003 - Robert Johnson - ₱12,500.00</option>
                                    <option value="ref-004">REF-2025-004 - Sarah Williams - ₱2,300.00</option>
                                    <option value="ref-005">REF-2025-005 - James Brown - ₱7,600.00</option>
                                </select>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Workflow Details for REF-2025-001</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="form-label">Requested By</label>
                                                <p>Sarah Williams (Customer Service)</p>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="form-label">Request Date</label>
                                                <p>2025-09-05 14:30</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="form-label">Validated By</label>
                                                <p>Michael Chen (Finance)</p>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="form-label">Validation Date</label>
                                                <p>2025-09-06 09:15</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Validation Notes</label>
                                        <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                            <p>Verified original invoice and return documentation. Customer returned product on 2025-09-03. All documentation is in order.</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Approval Decision</label>
                                        <div style="display: flex; gap: 15px;">
                                            <button class="btn btn-approve"><i class="fas fa-check"></i> Approve Refund</button>
                                            <button class="btn btn-reject"><i class="fas fa-times"></i> Reject Refund</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Approval Notes</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter approval notes or comments"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Refunds & Credit Memos</p>
            </div>
        </div>
    </div>

    <!-- Refund Details Modal -->
    <div id="refundDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Refund Details: REF-2025-001</h2>
                <span class="close" onclick="closeModal('refundDetailsModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Customer</label>
                            <p>John Smith (CUST-00285)</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Invoice Reference</label>
                            <p>INV-2025-085</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Request Date</label>
                            <p>2025-09-05</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Refund Amount</label>
                            <p>₱5,250.00</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Reason</label>
                            <p>Product Return</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Mode of Refund</label>
                            <p>Credit Card Refund</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <p><span class="status status-pending">Pending Approval</span></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p>Customer returned defective product (Order #28592, Product: Wireless Headphones XP-400). Product received on 2025-09-03 and inspected on 2025-09-04. Verified as defective and eligible for full refund.</p>
                    </div>
                </div>

                <h3 class="form-label">Workflow History</h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Step</th>
                                <th>Action By</th>
                                <th>Date & Time</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Request Submitted</td>
                                <td>Sarah Williams (Customer Service)</td>
                                <td>2025-09-05 14:30</td>
                                <td>Initiated refund request</td>
                            </tr>
                            <tr>
                                <td>Validation</td>
                                <td>Michael Chen (Finance)</td>
                                <td>2025-09-06 09:15</td>
                                <td>Verified documentation and eligibility</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="form-label">Attachments</h3>
                <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                    <button class="btn btn-view"><i class="fas fa-file-pdf"></i> Return Form</button>
                    <button class="btn btn-view"><i class="fas fa-file-image"></i> Product Photos</button>
                    <button class="btn btn-view"><i class="fas fa-file-invoice"></i> Original Invoice</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('refundDetailsModal')">Close</button>
                <button type="button" class="btn btn-primary">Print Details</button>
            </div>
        </div>
    </div>

</div>

<script src="../PANEL/ASSETS/js/script-p.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Hide all tab content
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                
                // Show the selected tab content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(`${tabId}-tab`).classList.add('active');
            });
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
        document.getElementById('refundSearch').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('#dashboard-tab tbody tr');
            
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

        // Add hover animations to buttons
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Add animation to table rows
        const tableRows = document.querySelectorAll('tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.boxShadow = 'none';
            });
        });

        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // Refund Status Chart
            const refundStatusCtx = document.getElementById('refundStatusChart').getContext('2d');
            new Chart(refundStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Approved', 'Processing', 'Rejected'],
                    datasets: [{
                        data: [15, 8, 12, 5],
                        backgroundColor: [
                            'rgba(243, 156, 18, 0.7)',
                            'rgba(52, 152, 219, 0.7)',
                            'rgba(46, 204, 113, 0.7)',
                            'rgba(231, 76, 60, 0.7)'
                        ],
                        borderColor: [
                            'rgba(243, 156, 18, 1)',
                            'rgba(52, 152, 219, 1)',
                            'rgba(46, 204, 113, 1)',
                            'rgba(231, 76, 60, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Refund Requests by Status'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>

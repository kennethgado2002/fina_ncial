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
            --payment-pending: #f39c12;
            --payment-scheduled: #3498db;
            --payment-processed: #2ecc71;
            --payment-failed: #e74c3c;
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
            background-color: var(--payment-pending);
            color: white;
        }

        .status-scheduled {
            background-color: var(--payment-scheduled);
            color: white;
        }

        .status-processed {
            background-color: var(--payment-processed);
            color: white;
        }

        .status-failed {
            background-color: var(--payment-failed);
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

        .btn-process {
            background-color: #00b894;
            color: white;
        }

        .btn-process:hover {
            background-color: #00a382;
        }

        .btn-schedule {
            background-color: #74b9ff;
            color: white;
        }

        .btn-schedule:hover {
            background-color: #0984e3;
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
            max-width: 1000px;
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

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px;
        }

        /* Payment Methods */
        .payment-methods {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .payment-method {
            flex: 1;
            padding: 15px;
            border-radius: 8px;
            background: white;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: var(--transition);
            cursor: pointer;
        }

        .payment-method:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .payment-method.active {
            border: 2px solid var(--secondary);
        }

        .payment-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--secondary);
        }

        .payment-label {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }

        /* Batch Selection */
        .batch-selection {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .batch-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .batch-actions {
            display: flex;
            gap: 10px;
        }

        .invoice-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .invoice-item:last-child {
            border-bottom: none;
        }

        .invoice-check {
            margin-right: 15px;
        }

        .invoice-details {
            flex: 1;
        }

        .invoice-amount {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            color: var(--dark);
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

            .payment-methods {
                flex-wrap: wrap;
            }
            
            .payment-method {
                flex: 1 0 calc(50% - 15px);
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
            
            .payment-method {
                flex: 1 0 100%;
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
                <h1 class="page-title">Vendor Payments</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Pending Payments</h3>
                        <p>28</p>
                        <small>Awaiting processing</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3>Scheduled</h3>
                        <p>15</p>
                        <small>For upcoming dates</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>Due This Week</h3>
                        <p>₱1.25M</p>
                        <small>Total amount due</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>Failed Payments</h3>
                        <p>3</p>
                        <small>Requiring attention</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="dashboard">Payment Dashboard</div>
                    <div class="tab" data-tab="batch">Batch Processing</div>
                    <div class="tab" data-tab="confirmation">Payment Confirmation</div>
                    <div class="tab" data-tab="ledger">Vendor Ledger</div>
                </div>

                <!-- Payment Dashboard Tab -->
                <div class="tab-content active" id="dashboard-tab">
                    <!-- Payment Methods Summary -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Payment Methods Summary</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="paymentMethodsChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Payments Table -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Pending Payments</h2>
                            <div>
                                <button class="btn btn-process"><i class="fas fa-play"></i> Process Selected</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="paymentSearch" placeholder="Search Vendor, Invoice, or Payment ID...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAll"></th>
                                            <th>Vendor</th>
                                            <th>Invoice #</th>
                                            <th>Due Date</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="payment-checkbox"></td>
                                            <td>Global Equipment Inc.</td>
                                            <td>INV-2025-105</td>
                                            <td>2025-09-15</td>
                                            <td>₱125,000.00</td>
                                            <td>Bank Transfer</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('paymentDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-schedule btn-sm"><i class="fas fa-calendar"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="payment-checkbox"></td>
                                            <td>Tech Solutions Ltd.</td>
                                            <td>INV-2025-098</td>
                                            <td>2025-09-12</td>
                                            <td>₱85,000.00</td>
                                            <td>Check</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('paymentDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-schedule btn-sm"><i class="fas fa-calendar"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="payment-checkbox"></td>
                                            <td>Office Supplies Co.</td>
                                            <td>INV-2025-112</td>
                                            <td>2025-09-18</td>
                                            <td>₱45,000.00</td>
                                            <td>E-wallet</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('paymentDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-schedule btn-sm"><i class="fas fa-calendar"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="payment-checkbox"></td>
                                            <td>XYZ Technologies</td>
                                            <td>INV-2025-095</td>
                                            <td>2025-09-10</td>
                                            <td>₱225,000.00</td>
                                            <td>Bank Transfer</td>
                                            <td><span class="status status-scheduled">Scheduled</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('paymentDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-play"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="payment-checkbox"></td>
                                            <td>ABC Suppliers</td>
                                            <td>INV-2025-101</td>
                                            <td>2025-09-14</td>
                                            <td>₱75,000.00</td>
                                            <td>Check</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('paymentDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-schedule btn-sm"><i class="fas fa-calendar"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Batch Processing Tab -->
                <div class="tab-content" id="batch-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Payment Batch Processing</h2>
                        </div>
                        <div class="card-body">
                            <div class="batch-selection">
                                <div class="batch-header">
                                    <h3>Select Invoices for Batch Payment</h3>
                                    <div class="batch-actions">
                                        <button class="btn btn-view"><i class="fas fa-filter"></i> Filter</button>
                                        <button class="btn btn-process"><i class="fas fa-plus"></i> Add Manual</button>
                                    </div>
                                </div>
                                <div class="invoice-item">
                                    <div class="invoice-check">
                                        <input type="checkbox" class="batch-checkbox" checked>
                                    </div>
                                    <div class="invoice-details">
                                        <strong>Global Equipment Inc.</strong> - INV-2025-105
                                        <div>Due: 2025-09-15</div>
                                    </div>
                                    <div class="invoice-amount">₱125,000.00</div>
                                </div>
                                <div class="invoice-item">
                                    <div class="invoice-check">
                                        <input type="checkbox" class="batch-checkbox" checked>
                                    </div>
                                    <div class="invoice-details">
                                        <strong>Tech Solutions Ltd.</strong> - INV-2025-098
                                        <div>Due: 2025-09-12</div>
                                    </div>
                                    <div class="invoice-amount">₱85,000.00</div>
                                </div>
                                <div class="invoice-item">
                                    <div class="invoice-check">
                                        <input type="checkbox" class="batch-checkbox">
                                    </div>
                                    <div class="invoice-details">
                                        <strong>Office Supplies Co.</strong> - INV-2025-112
                                        <div>Due: 2025-09-18</div>
                                    </div>
                                    <div class="invoice-amount">₱45,000.00</div>
                                </div>
                                <div class="invoice-item">
                                    <div class="invoice-check">
                                        <input type="checkbox" class="batch-checkbox" checked>
                                    </div>
                                    <div class="invoice-details">
                                        <strong>XYZ Technologies</strong> - INV-2025-095
                                        <div>Due: 2025-09-10</div>
                                    </div>
                                    <div class="invoice-amount">₱225,000.00</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Batch Payment Date</label>
                                        <input type="date" class="form-control" id="batchDate" value="2025-09-10">
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Payment Method</label>
                                        <select class="form-control" id="batchMethod">
                                            <option value="bank">Bank Transfer</option>
                                            <option value="check">Check</option>
                                            <option value="ewallet">E-wallet</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Batch Reference</label>
                                <input type="text" class="form-control" id="batchReference" placeholder="Enter batch reference (e.g., BATCH-SEP-001)">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Total Batch Amount</label>
                                <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                    <h3>₱435,000.00</h3>
                                    <small>Total of 3 selected invoices</small>
                                </div>
                            </div>

                            <div style="text-align: center; margin-top: 20px;">
                                <button class="btn btn-process"><i class="fas fa-play"></i> Process Batch Payment</button>
                                <button class="btn btn-schedule"><i class="fas fa-calendar"></i> Schedule Batch</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Confirmation Tab -->
                <div class="tab-content" id="confirmation-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Payment Confirmation & Upload</h2>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="confirmationSearch" placeholder="Search Payment ID, Vendor, or Invoice...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Payment ID</th>
                                            <th>Vendor</th>
                                            <th>Invoice #</th>
                                            <th>Amount</th>
                                            <th>Payment Date</th>
                                            <th>Method</th>
                                            <th>Confirmation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>PAY-2025-001</td>
                                            <td>Global Equipment Inc.</td>
                                            <td>INV-2025-092</td>
                                            <td>₱150,000.00</td>
                                            <td>2025-09-05</td>
                                            <td>Bank Transfer</td>
                                            <td><span class="status status-processed">Confirmed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PAY-2025-002</td>
                                            <td>Tech Solutions Ltd.</td>
                                            <td>INV-2025-085</td>
                                            <td>₱95,000.00</td>
                                            <td>2025-09-04</td>
                                            <td>Check</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm" onclick="openModal('uploadModal')"><i class="fas fa-upload"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PAY-2025-003</td>
                                            <td>Office Supplies Co.</td>
                                            <td>INV-2025-078</td>
                                            <td>₱55,000.00</td>
                                            <td>2025-09-03</td>
                                            <td>E-wallet</td>
                                            <td><span class="status status-processed">Confirmed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PAY-2025-004</td>
                                            <td>XYZ Technologies</td>
                                            <td>INV-2025-101</td>
                                            <td>₱225,000.00</td>
                                            <td>2025-09-02</td>
                                            <td>Bank Transfer</td>
                                            <td><span class="status status-failed">Failed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm" onclick="openModal('uploadModal')"><i class="fas fa-upload"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vendor Ledger Tab -->
                <div class="tab-content" id="ledger-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Vendor Ledger View</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Select Vendor</label>
                                        <select class="form-control" id="ledgerVendor">
                                            <option value="">Select a Vendor</option>
                                            <option value="global">Global Equipment Inc.</option>
                                            <option value="tech">Tech Solutions Ltd.</option>
                                            <option value="office">Office Supplies Co.</option>
                                            <option value="xyz">XYZ Technologies</option>
                                            <option value="abc">ABC Suppliers</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Date Range</label>
                                        <select class="form-control" id="ledgerRange">
                                            <option value="month">Current Month</option>
                                            <option value="quarter">Current Quarter</option>
                                            <option value="year">Current Year</option>
                                            <option value="custom">Custom Range</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Vendor: Global Equipment Inc.</h3>
                                    <div>
                                        <span style="font-family: 'Montserrat', sans-serif; font-weight: 600; color: var(--dark);">Current Balance: ₱425,000.00</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Type</th>
                                                    <th>Reference</th>
                                                    <th>Description</th>
                                                    <th>Debit</th>
                                                    <th>Credit</th>
                                                    <th>Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>2025-09-01</td>
                                                    <td>Invoice</td>
                                                    <td>INV-2025-105</td>
                                                    <td>Equipment Purchase</td>
                                                    <td>₱125,000.00</td>
                                                    <td>-</td>
                                                    <td>₱125,000.00</td>
                                                </tr>
                                                <tr>
                                                    <td>2025-08-25</td>
                                                    <td>Payment</td>
                                                    <td>PAY-2025-092</td>
                                                    <td>Bank Transfer</td>
                                                    <td>-</td>
                                                    <td>₱150,000.00</td>
                                                    <td>₱0.00</td>
                                                </tr>
                                                <tr>
                                                    <td>2025-08-15</td>
                                                    <td>Invoice</td>
                                                    <td>INV-2025-092</td>
                                                    <td>Maintenance Services</td>
                                                    <td>₱150,000.00</td>
                                                    <td>-</td>
                                                    <td>₱150,000.00</td>
                                                </tr>
                                                <tr>
                                                    <td>2025-08-10</td>
                                                    <td>Invoice</td>
                                                    <td>INV-2025-085</td>
                                                    <td>Spare Parts</td>
                                                    <td>₱75,000.00</td>
                                                    <td>-</td>
                                                    <td>₱225,000.00</td>
                                                </tr>
                                                <tr>
                                                    <td>2025-08-05</td>
                                                    <td>Payment</td>
                                                    <td>PAY-2025-078</td>
                                                    <td>Check Payment</td>
                                                    <td>-</td>
                                                    <td>₱200,000.00</td>
                                                    <td>₱25,000.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Vendor Payments</p>
            </div>
        </div>
    </div>

    <!-- Payment Details Modal -->
    <div id="paymentDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Payment Details: INV-2025-105</h2>
                <span class="close" onclick="closeModal('paymentDetailsModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Vendor</label>
                            <p>Global Equipment Inc. (VEND-00285)</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Invoice Date</label>
                            <p>2025-08-15</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Due Date</label>
                            <p>2025-09-15</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Invoice Amount</label>
                            <p>₱125,000.00</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Payment Method</label>
                            <p>Bank Transfer</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <p><span class="status status-pending">Pending</span></p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Vendor Bank Details</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>Bank:</strong> Philippine National Bank</p>
                        <p><strong>Account Name:</strong> Global Equipment Inc.</p>
                        <p><strong>Account Number:</strong> 1234-5678-9012-3456</p>
                        <p><strong>SWIFT Code:</strong> PNBMPHMM</p>
                    </div>
                </div>

                <h3 class="form-label">Invoice Details</h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Industrial Pump XP-500</td>
                                <td>2</td>
                                <td>₱35,000.00</td>
                                <td>₱70,000.00</td>
                            </tr>
                            <tr>
                                <td>Control Panel Module</td>
                                <td>1</td>
                                <td>₱25,000.00</td>
                                <td>₱25,000.00</td>
                            </tr>
                            <tr>
                                <td>Installation Services</td>
                                <td>10 hours</td>
                                <td>₱3,000.00</td>
                                <td>₱30,000.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label class="form-label">Approval Workflow</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>3-Way Matching:</strong> <span style="color: #2ecc71;">Completed</span></p>
                        <p><strong>Manager Approval:</strong> <span style="color: #2ecc71;">Approved (Sarah Johnson)</span></p>
                        <p><strong>Finance Approval:</strong> <span style="color: #f39c12;">Pending</span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('paymentDetailsModal')">Close</button>
                <button type="button" class="btn btn-approve">Approve Payment</button>
                <button type="button" class="btn btn-process">Process Payment</button>
            </div>
        </div>
    </div>

    <!-- Upload Confirmation Modal -->
    <div id="uploadModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Upload Payment Confirmation</h2>
                <span class="close" onclick="closeModal('uploadModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Payment Reference</label>
                    <p>PAY-2025-002 - Tech Solutions Ltd. - ₱95,000.00</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirmation Type</label>
                    <select class="form-control" id="confirmationType">
                        <option value="bank">Bank Transfer Slip</option>
                        <option value="check">Check Copy</option>
                        <option value="remittance">Remittance Proof</option>
                        <option value="other">Other Document</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Upload File</label>
                    <input type="file" class="form-control" id="confirmationFile">
                    <small>Supported formats: PDF, JPG, PNG (Max 5MB)</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Transaction Reference</label>
                    <input type="text" class="form-control" id="transactionRef" placeholder="Enter bank reference or transaction ID">
                </div>

                <div class="form-group">
                    <label class="form-label">Payment Date</label>
                    <input type="date" class="form-control" id="actualPaymentDate">
                </div>

                <div class="form-group">
                    <label class="form-label">Notes (Optional)</label>
                    <textarea class="form-control" id="confirmationNotes" rows="3" placeholder="Add any additional notes"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('uploadModal')">Cancel</button>
                <button type="button" class="btn btn-primary">Upload Confirmation</button>
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
        document.getElementById('paymentSearch').addEventListener('input', function() {
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

        // Select all functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.payment-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
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
            // Payment Methods Chart
            const paymentMethodsCtx = document.getElementById('paymentMethodsChart').getContext('2d');
            new Chart(paymentMethodsCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Bank Transfer', 'Check', 'E-wallet', 'Other'],
                    datasets: [{
                        data: [65, 20, 10, 5],
                        backgroundColor: [
                            'rgba(52, 152, 219, 0.7)',
                            'rgba(46, 204, 113, 0.7)',
                            'rgba(155, 89, 182, 0.7)',
                            'rgba(241, 196, 15, 0.7)'
                        ],
                        borderColor: [
                            'rgba(52, 152, 219, 1)',
                            'rgba(46, 204, 113, 1)',
                            'rgba(155, 89, 182, 1)',
                            'rgba(241, 196, 15, 1)'
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
                            text: 'Payment Methods Distribution'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>

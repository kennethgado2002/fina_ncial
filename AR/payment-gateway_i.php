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
            --paid: #2ecc71;
            --pending: #f39c12;
            --failed: #e74c3c;
            --refunded: #9b59b6;
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
            cursor: pointer;
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

        .card-icon.purple {
            background-color: rgba(155, 89, 182, 0.2);
            color: #8e44ad;
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
            flex-wrap: wrap;
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

        .status-paid {
            background-color: var(--paid);
            color: white;
        }

        .status-pending {
            background-color: var(--pending);
            color: white;
        }

        .status-failed {
            background-color: var(--failed);
            color: white;
        }

        .status-refunded {
            background-color: var(--refunded);
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

        .btn-warning {
            background-color: var(--warning);
            color: white;
        }

        .btn-warning:hover {
            background-color: #d35400;
        }

        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
        }

        .btn-view {
            background-color: #dfe6e9;
            color: #636e72;
        }

        .btn-view:hover {
            background-color: #b2bec3;
        }

        .btn-retry {
            background-color: #f39c12;
            color: white;
        }

        .btn-retry:hover {
            background-color: #e67e22;
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

        /* Form Styles */
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .form-col {
            flex: 1;
            min-width: 250px;
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

        /* Filter Section */
        .filter-section {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-item {
            display: flex;
            flex-direction: column;
        }

        .filter-label {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Lato', sans-serif;
            font-size: 1rem;
            background: white;
            min-width: 180px;
        }

        /* Payment Method Icons */
        .payment-method {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .payment-icon {
            width: 30px;
            height: 20px;
            background: #f8f9fa;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: #7f8c8d;
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
            
            .filter-section {
                flex-direction: column;
            }
            
            .filter-select {
                width: 100%;
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
                <h1 class="page-title">Payment Gateway Integration</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card" onclick="setActiveTab('transactions-tab', 'paid')">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Paid Transactions</h3>
                        <p>1,842</p>
                        <small>₱2,456,789.00</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('transactions-tab', 'pending')">
                        <div class="card-icon orange">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Pending</h3>
                        <p>127</p>
                        <small>₱189,560.00</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('transactions-tab', 'failed')">
                        <div class="card-icon red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>Failed</h3>
                        <p>43</p>
                        <small>₱67,890.00</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('transactions-tab', 'refunded')">
                        <div class="card-icon purple">
                            <i class="fas fa-undo"></i>
                        </div>
                        <h3>Refunded</h3>
                        <p>28</p>
                        <small>₱42,150.00</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="transactions">Transactions</div>
                    <div class="tab" data-tab="reconciliation">Reconciliation</div>
                    <div class="tab" data-tab="settings">Gateway Settings</div>
                </div>

                <!-- Transactions Tab -->
                <div class="tab-content active" id="transactions-tab">
                    <!-- Transaction Table Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Payment Transactions</h2>
                            <div>
                                <button class="btn btn-primary"><i class="fas fa-sync"></i> Refresh</button>
                                <button class="btn btn-secondary"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="transactionSearch" placeholder="Search Gateway Ref, Customer, Invoice, or Amount...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="statusFilter">
                                        <option value="">All Statuses</option>
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                        <option value="failed">Failed</option>
                                        <option value="refunded">Refunded</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Payment Method</span>
                                    <select class="filter-select" id="methodFilter">
                                        <option value="">All Methods</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="debit_card">Debit Card</option>
                                        <option value="gcash">GCash</option>
                                        <option value="paymaya">PayMaya</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <select class="filter-select" id="dateFilter">
                                        <option value="">All Dates</option>
                                        <option value="today">Today</option>
                                        <option value="week">This Week</option>
                                        <option value="month">This Month</option>
                                        <option value="quarter">This Quarter</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Gateway Ref No.</th>
                                            <th>Customer</th>
                                            <th>Invoice</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>PGW-2025-1001</td>
                                            <td>John Smith</td>
                                            <td>INV-2025-085</td>
                                            <td>
                                                <div class="payment-method">
                                                    <div class="payment-icon">VC</div>
                                                    <span>Visa Credit</span>
                                                </div>
                                            </td>
                                            <td>₱12,500.00</td>
                                            <td><span class="status status-paid">Paid</span></td>
                                            <td>2025-09-05 14:32</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PGW-2025-1002</td>
                                            <td>Maria Garcia</td>
                                            <td>INV-2025-086</td>
                                            <td>
                                                <div class="payment-method">
                                                    <div class="payment-icon" style="background: #0d6efd; color: white">GC</div>
                                                    <span>GCash</span>
                                                </div>
                                            </td>
                                            <td>₱8,750.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>2025-09-05 13:15</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-retry btn-sm"><i class="fas fa-redo"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PGW-2025-1003</td>
                                            <td>Robert Johnson</td>
                                            <td>INV-2025-087</td>
                                            <td>
                                                <div class="payment-method">
                                                    <div class="payment-icon">MC</div>
                                                    <span>Mastercard</span>
                                                </div>
                                            </td>
                                            <td>₱15,200.00</td>
                                            <td><span class="status status-failed">Failed</span></td>
                                            <td>2025-09-05 11:42</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-retry btn-sm"><i class="fas fa-redo"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PGW-2025-1004</td>
                                            <td>Sarah Williams</td>
                                            <td>INV-2025-088</td>
                                            <td>
                                                <div class="payment-method">
                                                    <div class="payment-icon" style="background: #6f42c1; color: white">PM</div>
                                                    <span>PayMaya</span>
                                                </div>
                                            </td>
                                            <td>₱9,800.00</td>
                                            <td><span class="status status-refunded">Refunded</span></td>
                                            <td>2025-09-04 16:20</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PGW-2025-1005</td>
                                            <td>Michael Brown</td>
                                            <td>INV-2025-089</td>
                                            <td>
                                                <div class="payment-method">
                                                    <div class="payment-icon">BT</div>
                                                    <span>Bank Transfer</span>
                                                </div>
                                            </td>
                                            <td>₱22,500.00</td>
                                            <td><span class="status status-paid">Paid</span></td>
                                            <td>2025-09-04 10:08</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reconciliation Tab -->
                <div class="tab-content" id="reconciliation-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Reconciliation Tool</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">From Date</label>
                                        <input type="date" class="form-control" value="2025-09-01">
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">To Date</label>
                                        <input type="date" class="form-control" value="2025-09-05">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Payment Gateway</label>
                                <select class="form-control">
                                    <option value="all">All Gateways</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="stripe">Stripe</option>
                                    <option value="paymongo">PayMongo</option>
                                    <option value="xendit">Xendit</option>
                                </select>
                            </div>

                            <div style="margin-bottom: 20px;">
                                <button class="btn btn-primary"><i class="fas fa-calculator"></i> Run Reconciliation</button>
                                <button class="btn btn-secondary"><i class="fas fa-download"></i> Download Report</button>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Gateway Ref No.</th>
                                            <th>Invoice No.</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>Gateway Status</th>
                                            <th>AR Status</th>
                                            <th>Match</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>PGW-2025-1001</td>
                                            <td>INV-2025-085</td>
                                            <td>John Smith</td>
                                            <td>₱12,500.00</td>
                                            <td><span class="status status-paid">Completed</span></td>
                                            <td><span class="status status-paid">Paid</span></td>
                                            <td><i class="fas fa-check-circle" style="color: #2ecc71;"></i></td>
                                            <td><button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>PGW-2025-1002</td>
                                            <td>INV-2025-086</td>
                                            <td>Maria Garcia</td>
                                            <td>₱8,750.00</td>
                                            <td><span class="status status-pending">Processing</span></td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td><i class="fas fa-check-circle" style="color: #2ecc71;"></i></td>
                                            <td><button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>PGW-2025-1003</td>
                                            <td>INV-2025-087</td>
                                            <td>Robert Johnson</td>
                                            <td>₱15,200.00</td>
                                            <td><span class="status status-failed">Failed</span></td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td><i class="fas fa-exclamation-circle" style="color: #e74c3c;"></i></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-link"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PGW-2025-1021</td>
                                            <td>-</td>
                                            <td>Unknown</td>
                                            <td>₱5,400.00</td>
                                            <td><span class="status status-paid">Completed</span></td>
                                            <td><span class="status status-failed">Unmatched</span></td>
                                            <td><i class="fas fa-exclamation-circle" style="color: #e74c3c;"></i></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-link"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Tab -->
                <div class="tab-content" id="settings-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Gateway Settings</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Primary Payment Gateway</label>
                                <select class="form-control">
                                    <option value="paypal">PayPal</option>
                                    <option value="stripe" selected>Stripe</option>
                                    <option value="paymongo">PayMongo</option>
                                    <option value="xendit">Xendit</option>
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">API Key</label>
                                        <input type="password" class="form-control" value="sk_test_51MZ...">
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Webhook Secret</label>
                                        <input type="password" class="form-control" value="whsec_5D9...">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Accepted Payment Methods</label>
                                <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-top: 10px;">
                                    <label style="display: flex; align-items: center; gap: 5px;">
                                        <input type="checkbox" checked> Credit/Debit Cards
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 5px;">
                                        <input type="checkbox" checked> GCash
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 5px;">
                                        <input type="checkbox" checked> PayMaya
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 5px;">
                                        <input type="checkbox" checked> Bank Transfer
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 5px;">
                                        <input type="checkbox"> PayPal
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 5px;">
                                        <input type="checkbox"> Cryptocurrency
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Auto-Reconciliation</label>
                                <select class="form-control">
                                    <option value="disabled">Disabled</option>
                                    <option value="hourly">Hourly</option>
                                    <option value="daily" selected>Daily</option>
                                    <option value="weekly">Weekly</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Failed Payment Retry</label>
                                <select class="form-control">
                                    <option value="0">No Retry</option>
                                    <option value="1">1 Retry</option>
                                    <option value="2">2 Retries</option>
                                    <option value="3" selected>3 Retries</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Default Refund Policy</label>
                                <textarea class="form-control" rows="3">Full refunds are available within 30 days of purchase. Processing may take 5-10 business days.</textarea>
                            </div>

                            <div style="margin-top: 20px; text-align: right;">
                                <button class="btn btn-secondary">Test Connection</button>
                                <button class="btn btn-primary">Save Settings</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Payment Gateway Integration</p>
            </div>
        </div>
    </div>

    <!-- View Transaction Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content" style="max-width: 800px;">
            <div class="modal-header">
                <h2 class="modal-title">Transaction Details</h2>
                <span class="close" onclick="closeModal('viewModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Gateway Reference No.</label>
                            <p>PGW-2025-1002</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Bank Reference No.</label>
                            <p>BREF-782946</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Customer</label>
                            <p>Maria Garcia</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Invoice Linked</label>
                            <p>INV-2025-086</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Payment Method</label>
                            <p>GCash (**** **** **** 1234)</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Amount</label>
                            <p>₱8,750.00</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <p><span class="status status-pending">Pending</span></p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Transaction Date</label>
                            <p>2025-09-05 13:15:22</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Transaction Timeline</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <div style="width: 20px; height: 20px; border-radius: 50%; background: #2ecc71; margin-right: 10px;"></div>
                            <div>
                                <strong>Initiated</strong> - 2025-09-05 13:15:22
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <div style="width: 20px; height: 20px; border-radius: 50%; background: #f39c12; margin-right: 10px;"></div>
                            <div>
                                <strong>Processing</strong> - Waiting for confirmation from GCash
                            </div>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 2px solid #ddd; margin-right: 10px;"></div>
                            <div>
                                <strong>Completed</strong> - Pending
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Actions</label>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button class="btn btn-retry"><i class="fas fa-redo"></i> Retry Payment</button>
                        <button class="btn btn-success"><i class="fas fa-check"></i> Mark as Paid</button>
                        <button class="btn btn-danger"><i class="fas fa-times"></i> Cancel Payment</button>
                        <button class="btn btn-secondary" onclick="openModal('refundModal')"><i class="fas fa-undo"></i> Process Refund</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="closeModal('viewModal')">Close</button>
            </div>
        </div>
    </div>

    <!-- Refund Modal -->
    <div id="refundModal" class="modal">
        <div class="modal-content" style="max-width: 600px;">
            <div class="modal-header">
                <h2 class="modal-title">Process Refund</h2>
                <span class="close" onclick="closeModal('refundModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Transaction</label>
                    <p>PGW-2025-1002 - Maria Garcia - ₱8,750.00</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Refund Amount</label>
                    <div class="form-row">
                        <div class="form-col">
                            <label class="form-label">Full Refund</label>
                            <input type="radio" name="refundType" checked> ₱8,750.00
                        </div>
                        <div class="form-col">
                            <label class="form-label">Partial Refund</label>
                            <input type="radio" name="refundType"> 
                            <input type="number" class="form-control" placeholder="0.00" style="margin-top: 5px;">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Reason for Refund</label>
                    <select class="form-control">
                        <option value="">Select a reason</option>
                        <option value="duplicate">Duplicate transaction</option>
                        <option value="fraud">Fraudulent transaction</option>
                        <option value="customer">Customer request</option>
                        <option value="product">Product not received</option>
                        <option value="defective">Defective product</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea class="form-control" rows="3" placeholder="Additional notes about this refund..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Refund Method</label>
                    <select class="form-control">
                        <option value="original">Original payment method</option>
                        <option value="store_credit">Store credit</option>
                        <option value="bank_transfer">Bank transfer</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('refundModal')">Cancel</button>
                <button class="btn btn-primary">Process Refund</button>
            </div>
        </div>
    </div>

</div>

<script src="../PANEL/ASSETS/js/script-p.js"></script>
<script>

        // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabName = tab.getAttribute('data-tab');
                setActiveTab(tabName + '-tab');
            });
        });

        function setActiveTab(tabId, filter) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected tab content
            document.getElementById(tabId).classList.add('active');
            
            // Update active tab
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            const correspondingTab = document.querySelector(`.tab[data-tab="${tabId.replace('-tab', '')}"]`);
            if (correspondingTab) {
                correspondingTab.classList.add('active');
            }
            
            // Apply filter if specified
            if (filter) {
                document.getElementById('statusFilter').value = filter;
            }
        }

        // Modal functionality
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
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

        // Dashboard card click to navigate to transactions tab
        document.querySelectorAll('.dashboard-card').forEach(card => {
            card.addEventListener('click', function() {
                setActiveTab('transactions-tab');
            });
        });
    </script>
</body>
</html>

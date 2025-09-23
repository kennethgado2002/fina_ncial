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
            --debit: #e74c3c;
            --credit: #2ecc71;
            --balanced: #3498db;
            --error: #e74c3c;
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

        .card-icon.red {
            background-color: rgba(231, 76, 60, 0.2);
            color: #c0392b;
        }

        .card-icon.orange {
            background-color: rgba(243, 156, 18, 0.2);
            color: #d35400;
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

        .status-balanced {
            background-color: var(--balanced);
            color: white;
        }

        .status-error {
            background-color: var(--error);
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

        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
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

        .btn-view {
            background-color: #dfe6e9;
            color: #636e72;
        }

        .btn-view:hover {
            background-color: #b2bec3;
        }

        .btn-drill {
            background-color: #74b9ff;
            color: white;
        }

        .btn-drill:hover {
            background-color: #0984e3;
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
            max-width: 1200px;
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

        /* Forms */
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

        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Lato', sans-serif;
            font-size: 1rem;
            background: white;
        }

        /* Trial Balance Summary */
        .trial-balance-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            text-align: center;
        }

        .summary-card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .summary-card p {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .summary-card.debit p {
            color: var(--debit);
        }

        .summary-card.credit p {
            color: var(--credit);
        }

        .summary-card.balance p {
            color: var(--balanced);
        }

        /* Error Panel */
        .error-panel {
            background: #ffeaa7;
            border-left: 4px solid var(--warning);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 0 8px 8px 0;
        }

        .error-panel h4 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .error-list {
            list-style-type: none;
        }

        .error-list li {
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .error-list li:last-child {
            border-bottom: none;
        }

        .error-list li i {
            color: var(--error);
            margin-right: 10px;
        }

        /* Drill Down Table */
        .drill-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .drill-table th, .drill-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #eee;
        }

        .drill-table th {
            background-color: #f8f9fa;
            font-family: 'Montserrat', sans-serif;
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
            
            .trial-balance-summary {
                grid-template-columns: 1fr;
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
                <h1 class="page-title">Trial Balance</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h3>Total Journal Entries</h3>
                        <p>1,248</p>
                        <small>This period</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Approved Entries</h3>
                        <p>1,230</p>
                        <small>98.6% of total</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>Pending Approval</h3>
                        <p>18</p>
                        <small>1.4% of total</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>Unposted Entries</h3>
                        <p>5</p>
                        <small>Require attention</small>
                    </div>
                </div>

                <!-- Trial Balance Summary -->
                <div class="trial-balance-summary">
                    <div class="summary-card debit">
                        <h3>Total Debits</h3>
                        <p>₱2,845,670.50</p>
                        <small>Sum of all debit balances</small>
                    </div>
                    <div class="summary-card credit">
                        <h3>Total Credits</h3>
                        <p>₱2,845,670.50</p>
                        <small>Sum of all credit balances</small>
                    </div>
                    <div class="summary-card balance">
                        <h3>Balance Status</h3>
                        <p>Balanced</p>
                        <small>Debits = Credits</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="trial-balance">Trial Balance</div>
                    <div class="tab" data-tab="error-detection">Error Detection</div>
                    <div class="tab" data-tab="drill-down">Drill Down</div>
                </div>

                <!-- Trial Balance Tab -->
                <div class="tab-content active" id="trial-balance-tab">
                    <!-- Filters and Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Trial Balance as of September 30, 2025</h2>
                            <div>
                                <button class="btn btn-primary" id="exportReport"><i class="fas fa-download"></i> Export Report</button>
                                <button class="btn btn-success" id="refreshData"><i class="fas fa-sync-alt"></i> Refresh</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="accountSearch" placeholder="Search account code or name...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Account Code</th>
                                            <th>Account Name</th>
                                            <th>Debit Balance</th>
                                            <th>Credit Balance</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1001</td>
                                            <td>Cash and Cash Equivalents</td>
                                            <td>₱450,250.00</td>
                                            <td>₱0.00</td>
                                            <td><span class="status status-balanced">Balanced</span></td>
                                            <td>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillModal', '1001')"><i class="fas fa-search"></i> Drill Down</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1101</td>
                                            <td>Accounts Receivable</td>
                                            <td>₱785,420.75</td>
                                            <td>₱0.00</td>
                                            <td><span class="status status-balanced">Balanced</span></td>
                                            <td>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillModal', '1101')"><i class="fas fa-search"></i> Drill Down</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1201</td>
                                            <td>Inventory</td>
                                            <td>₱620,150.00</td>
                                            <td>₱0.00</td>
                                            <td><span class="status status-balanced">Balanced</span></td>
                                            <td>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillModal', '1201')"><i class="fas fa-search"></i> Drill Down</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2001</td>
                                            <td>Accounts Payable</td>
                                            <td>₱0.00</td>
                                            <td>₱425,680.25</td>
                                            <td><span class="status status-balanced">Balanced</span></td>
                                            <td>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillModal', '2001')"><i class="fas fa-search"></i> Drill Down</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3001</td>
                                            <td>Common Stock</td>
                                            <td>₱0.00</td>
                                            <td>₱1,000,000.00</td>
                                            <td><span class="status status-balanced">Balanced</span></td>
                                            <td>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillModal', '3001')"><i class="fas fa-search"></i> Drill Down</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4001</td>
                                            <td>Sales Revenue</td>
                                            <td>₱0.00</td>
                                            <td>₱1,250,320.00</td>
                                            <td><span class="status status-balanced">Balanced</span></td>
                                            <td>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillModal', '4001')"><i class="fas fa-search"></i> Drill Down</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5101</td>
                                            <td>Cost of Goods Sold</td>
                                            <td>₱789,320.75</td>
                                            <td>₱0.00</td>
                                            <td><span class="status status-error">Imbalanced</span></td>
                                            <td>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillModal', '5101')"><i class="fas fa-search"></i> Drill Down</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6001</td>
                                            <td>Operating Expenses</td>
                                            <td>₱200,529.00</td>
                                            <td>₱0.00</td>
                                            <td><span class="status status-balanced">Balanced</span></td>
                                            <td>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillModal', '6001')"><i class="fas fa-search"></i> Drill Down</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr style="font-weight: bold; background-color: #f8f9fa;">
                                            <td colspan="2">TOTAL</td>
                                            <td>₱2,845,670.50</td>
                                            <td>₱2,845,670.50</td>
                                            <td><span class="status status-balanced">Balanced</span></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Error Detection Tab -->
                <div class="tab-content" id="error-detection-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Error Detection Panel</h2>
                        </div>
                        <div class="card-body">
                            <div class="error-panel">
                                <h4><i class="fas fa-exclamation-triangle"></i> System Detected Issues</h4>
                                <ul class="error-list">
                                    <li><i class="fas fa-times-circle"></i> Account 5101 (Cost of Goods Sold) has an imbalance of ₱1,250.75</li>
                                    <li><i class="fas fa-clock"></i> 5 journal entries are pending approval</li>
                                    <li><i class="fas fa-ban"></i> 3 journal entries failed to post to the general ledger</li>
                                    <li><i class="fas fa-calendar-times"></i> 2 transactions have dates outside the current period</li>
                                </ul>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Error Type</th>
                                            <th>Account/Entry</th>
                                            <th>Description</th>
                                            <th>Severity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Account Imbalance</td>
                                            <td>5101 - Cost of Goods Sold</td>
                                            <td>Debit and credit totals don't match</td>
                                            <td><span class="status status-error">High</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('errorDetailModal')"><i class="fas fa-eye"></i> Details</button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-wrench"></i> Fix</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Unposted Journal Entry</td>
                                            <td>JE-2025-0876</td>
                                            <td>Entry not posted to general ledger</td>
                                            <td><span class="status status-error">High</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('errorDetailModal')"><i class="fas fa-eye"></i> Details</button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-wrench"></i> Fix</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pending Approval</td>
                                            <td>JE-2025-0901 to JE-2025-0905</td>
                                            <td>5 entries awaiting manager approval</td>
                                            <td><span class="status" style="background-color: #f39c12; color: white;">Medium</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('errorDetailModal')"><i class="fas fa-eye"></i> Details</button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-forward"></i> Escalate</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Date Mismatch</td>
                                            <td>JE-2025-0854</td>
                                            <td>Transaction date outside current period</td>
                                            <td><span class="status" style="background-color: #f39c12; color: white;">Medium</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('errorDetailModal')"><i class="fas fa-eye"></i> Details</button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-wrench"></i> Fix</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Drill Down Tab -->
                <div class="tab-content" id="drill-down-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Drill Down to Transaction Details</h2>
                            <div>
                                <select class="form-select" style="width: auto; display: inline-block;">
                                    <option>All Modules</option>
                                    <option>Accounts Payable</option>
                                    <option>Accounts Receivable</option>
                                    <option>Disbursements</option>
                                    <option>Inventory</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Account Code</label>
                                        <input type="text" class="form-control" placeholder="Enter account code" value="1101">
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Date Range</label>
                                        <div style="display: flex; gap: 10px;">
                                            <input type="date" class="form-control" value="2025-09-01">
                                            <input type="date" class="form-control" value="2025-09-30">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="drill-table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Journal Entry #</th>
                                            <th>Description</th>
                                            <th>Reference</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Module</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2025-09-05</td>
                                            <td>JE-2025-0876</td>
                                            <td>Sale to ABC Company</td>
                                            <td>INV-2025-1001</td>
                                            <td>₱125,000.00</td>
                                            <td>₱0.00</td>
                                            <td>Accounts Receivable</td>
                                            <td><span class="status status-balanced">Posted</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-12</td>
                                            <td>JE-2025-0892</td>
                                            <td>Sale to XYZ Corp</td>
                                            <td>INV-2025-1015</td>
                                            <td>₱85,420.75</td>
                                            <td>₱0.00</td>
                                            <td>Accounts Receivable</td>
                                            <td><span class="status status-balanced">Posted</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-18</td>
                                            <td>JE-2025-0908</td>
                                            <td>Payment received - ABC Company</td>
                                            <td>PMT-2025-0456</td>
                                            <td>₱0.00</td>
                                            <td>₱75,000.00</td>
                                            <td>Accounts Receivable</td>
                                            <td><span class="status status-balanced">Posted</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-25</td>
                                            <td>JE-2025-0923</td>
                                            <td>Sale to Global Enterprises</td>
                                            <td>INV-2025-1042</td>
                                            <td>₱225,000.00</td>
                                            <td>₱0.00</td>
                                            <td>Accounts Receivable</td>
                                            <td><span class="status status-balanced">Posted</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-28</td>
                                            <td>JE-2025-0935</td>
                                            <td>Sale to Tech Solutions Inc.</td>
                                            <td>INV-2025-1058</td>
                                            <td>₱350,000.00</td>
                                            <td>₱0.00</td>
                                            <td>Accounts Receivable</td>
                                            <td><span class="status status-balanced">Posted</span></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr style="font-weight: bold; background-color: #f8f9fa;">
                                            <td colspan="4">TOTAL for Account 1101</td>
                                            <td>₱785,420.75</td>
                                            <td>₱75,000.00</td>
                                            <td colspan="2">Net: ₱710,420.75 Debit</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Trial Balance</p>
            </div>
        </div>
    </div>

    <!-- Drill Down Modal -->
    <div id="drillModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Account Drill Down - <span id="modalAccountCode"></span></h2>
                <span class="close" onclick="closeModal('drillModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div id="drillContent">
                    <!-- Content will be dynamically loaded based on account -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="closeModal('drillModal')">Close</button>
            </div>
        </div>
    </div>

    <!-- Error Detail Modal -->
    <div id="errorDetailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Error Details</h2>
                <span class="close" onclick="closeModal('errorDetailModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Error Type</label>
                    <p>Account Imbalance</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Account</label>
                    <p>5101 - Cost of Goods Sold</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <p>The debit and credit totals for this account do not match. There is a discrepancy of ₱1,250.75.</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Possible Causes</label>
                    <ul>
                        <li>Journal entry posted incorrectly</li>
                        <li>Transaction missing from the account</li>
                        <li>Data entry error</li>
                    </ul>
                </div>
                <div class="form-group">
                    <label class="form-label">Recommended Action</label>
                    <p>Review all journal entries posted to this account during the period and verify the amounts.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary"><i class="fas fa-wrench"></i> Fix Automatically</button>
                <button class="btn btn-view"><i class="fas fa-search"></i> Review Entries</button>
                <button class="btn btn-secondary" onclick="closeModal('errorDetailModal')">Close</button>
            </div>
        </div>
    </div>

</div>

<script src="../PANEL/ASSETS/js/script-p.js"></script>
    <script>

        // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                
                // Show the corresponding tab content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(`${tabId}-tab`).classList.add('active');
            });
        });

        // Modal functionality
        function openModal(modalId, accountCode = '') {
            document.getElementById(modalId).style.display = 'block';
            
            if (modalId === 'drillModal' && accountCode) {
                document.getElementById('modalAccountCode').textContent = accountCode;
                loadDrillDownContent(accountCode);
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }

        // Load drill down content based on account code
        function loadDrillDownContent(accountCode) {
            const contentDiv = document.getElementById('drillContent');
            let content = '';
            
            switch(accountCode) {
                case '1001':
                    content = `
                        <h3>Cash and Cash Equivalents - Transaction Details</h3>
                        <p>Account Code: 1001</p>
                        <div class="table-responsive">
                            <table class="drill-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Reference</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2025-09-01</td>
                                        <td>Beginning Balance</td>
                                        <td>-</td>
                                        <td>₱400,000.00</td>
                                        <td>₱0.00</td>
                                        <td>₱400,000.00</td>
                                    </tr>
                                    <tr>
                                        <td>2025-09-05</td>
                                        <td>Payment from ABC Company</td>
                                        <td>PMT-2025-0456</td>
                                        <td>₱75,000.00</td>
                                        <td>₱0.00</td>
                                        <td>₱475,000.00</td>
                                    </tr>
                                    <tr>
                                        <td>2025-09-15</td>
                                        <td>Supplier Payment</td>
                                        <td>CHK-2025-0789</td>
                                        <td>₱0.00</td>
                                        <td>₱24,750.00</td>
                                        <td>₱450,250.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    `;
                    break;
                case '5101':
                    content = `
                        <h3>Cost of Goods Sold - Imbalance Detected</h3>
                        <div class="error-panel">
                            <h4><i class="fas fa-exclamation-triangle"></i> Account Imbalance</h4>
                            <p>This account has a discrepancy of ₱1,250.75 between debit and credit totals.</p>
                            <p><strong>Debit Total:</strong> ₱789,320.75</p>
                            <p><strong>Credit Total:</strong> ₱788,070.00</p>
                        </div>
                        <div class="table-responsive">
                            <table class="drill-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Reference</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2025-09-03</td>
                                        <td>Inventory Purchase</td>
                                        <td>PO-2025-0456</td>
                                        <td>₱125,000.00</td>
                                        <td>₱0.00</td>
                                    </tr>
                                    <tr>
                                        <td>2025-09-10</td>
                                        <td>Inventory Purchase</td>
                                        <td>PO-2025-0489</td>
                                        <td>₱85,420.75</td>
                                        <td>₱0.00</td>
                                    </tr>
                                    <tr style="background-color: #ffebee;">
                                        <td>2025-09-15</td>
                                        <td>Inventory Return</td>
                                        <td>RTN-2025-0012</td>
                                        <td>₱0.00</td>
                                        <td>₱1,250.75</td>
                                    </tr>
                                    <tr>
                                        <td>2025-09-22</td>
                                        <td>Inventory Purchase</td>
                                        <td>PO-2025-0523</td>
                                        <td>₱225,000.00</td>
                                        <td>₱0.00</td>
                                    </tr>
                                    <tr>
                                        <td>2025-09-28</td>
                                        <td>Inventory Purchase</td>
                                        <td>PO-2025-0558</td>
                                        <td>₱354,000.00</td>
                                        <td>₱0.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p><em>The highlighted transaction may be the source of the imbalance.</em></p>
                    `;
                    break;
                default:
                    content = `<p>Loading transaction details for account ${accountCode}...</p>`;
            }
            
            contentDiv.innerHTML = content;
        }

        // Refresh data function
        document.getElementById('refreshData').addEventListener('click', function() {
            // Show loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Refreshing...';
            
            // Simulate API call
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh';
                alert('Trial Balance data has been refreshed!');
            }, 1500);
        });

        // Export report function
        document.getElementById('exportReport').addEventListener('click', function() {
            // Simulate export process
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Exporting...';
            
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-download"></i> Export Report';
                alert('Trial Balance report exported successfully!');
            }, 1000);
        });
    </script>
</body>
</html>

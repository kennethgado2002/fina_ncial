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
            --reconciled: #2ecc71;
            --pending: #f39c12;
            --variance: #e74c3c;
            --in-progress: #3498db;
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

        .status-reconciled {
            background-color: var(--reconciled);
            color: white;
        }

        .status-pending {
            background-color: var(--pending);
            color: white;
        }

        .status-variance {
            background-color: var(--variance);
            color: white;
        }

        .status-in-progress {
            background-color: var(--in-progress);
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

        /* Reconciliation Comparison */
        .reconciliation-comparison {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 20px;
            margin: 30px 0;
            align-items: center;
        }

        .comparison-box {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }

        .comparison-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .comparison-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
        }

        .comparison-variance {
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            margin-top: 5px;
        }

        .variance-positive {
            color: var(--success);
        }

        .variance-negative {
            color: var(--accent);
        }

        .comparison-arrow {
            font-size: 2rem;
            color: #7f8c8d;
        }

        /* Progress Bars */
        .progress-container {
            margin: 20px 0;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .progress-bar {
            height: 10px;
            background: #ecf0f1;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--success);
            transition: width 0.3s ease;
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

        .workflow-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
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
            margin-bottom: 10px;
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .step-active .step-icon {
            background: var(--secondary);
            border-color: var(--secondary);
            color: white;
        }

        .step-completed .step-icon {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        .step-label {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Variance Chart */
        .variance-chart {
            height: 200px;
            display: flex;
            align-items: flex-end;
            gap: 10px;
            margin: 30px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .variance-bar {
            flex: 1;
            background: var(--secondary);
            border-radius: 4px 4px 0 0;
            position: relative;
            transition: height 0.3s ease;
        }

        .variance-bar.negative {
            background: var(--accent);
        }

        .variance-label {
            position: absolute;
            bottom: -25px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.8rem;
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
            
            .reconciliation-comparison {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            
            .comparison-arrow {
                transform: rotate(90deg);
            }
            
            .workflow-steps {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .workflow-steps::before {
                display: none;
            }
            
            .workflow-step {
                flex-direction: row;
                gap: 15px;
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
                <h1 class="page-title">Reconciliation Management</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card" onclick="setActiveTab('dashboard-tab')">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Reconciled</h3>
                        <p>24</p>
                        <small>Accounts balanced</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('unreconciled-tab')">
                        <div class="card-icon orange">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>Pending</h3>
                        <p>8</p>
                        <small>Require attention</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('unreconciled-tab')">
                        <div class="card-icon red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>Variances</h3>
                        <p>5</p>
                        <small>Significant differences</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('escalation-tab')">
                        <div class="card-icon blue">
                            <i class="fas fa-flag"></i>
                        </div>
                        <h3>Escalated</h3>
                        <p>3</p>
                        <small>Need resolution</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="dashboard">Reconciliation Dashboard</div>
                    <div class="tab" data-tab="unreconciled">Unreconciled Items</div>
                    <div class="tab" data-tab="automatch">Auto-Matching Tool</div>
                    <div class="tab" data-tab="escalation">Escalation Workflow</div>
                </div>

                <!-- Reconciliation Dashboard Tab -->
                <div class="tab-content active" id="dashboard-tab">
                    <!-- Reconciliation Status Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Reconciliation Status</h2>
                            <div>
                                <button class="btn btn-primary"><i class="fas fa-sync"></i> Refresh</button>
                                <button class="btn btn-secondary"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="progress-container">
                                <div class="progress-label">
                                    <span>Overall Reconciliation Progress</span>
                                    <span>75%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 75%"></div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Account Type</th>
                                            <th>Subsystem</th>
                                            <th>GL Balance</th>
                                            <th>Subsystem Balance</th>
                                            <th>Variance</th>
                                            <th>Status</th>
                                            <th>Last Reconciled</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Cash</td>
                                            <td>Bank Accounts</td>
                                            <td>₱2,450,000.00</td>
                                            <td>₱2,450,000.00</td>
                                            <td>₱0.00</td>
                                            <td><span class="status status-reconciled">Reconciled</span></td>
                                            <td>2025-09-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewReconciliationModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Accounts Receivable</td>
                                            <td>AR Subledger</td>
                                            <td>₱567,800.00</td>
                                            <td>₱567,800.00</td>
                                            <td>₱0.00</td>
                                            <td><span class="status status-reconciled">Reconciled</span></td>
                                            <td>2025-09-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewReconciliationModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Accounts Payable</td>
                                            <td>AP Subledger</td>
                                            <td>₱389,500.00</td>
                                            <td>₱392,150.00</td>
                                            <td>₱2,650.00</td>
                                            <td><span class="status status-variance">Variance</span></td>
                                            <td>2025-09-04</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewReconciliationModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-warning btn-sm"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Revenue</td>
                                            <td>Sales System</td>
                                            <td>₱8,750,000.00</td>
                                            <td>₱8,745,200.00</td>
                                            <td>₱4,800.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>2025-09-04</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewReconciliationModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-warning btn-sm"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Expenses</td>
                                            <td>Budget System</td>
                                            <td>₱6,400,000.00</td>
                                            <td>₱6,395,500.00</td>
                                            <td>₱4,500.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>2025-09-03</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewReconciliationModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-warning btn-sm"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Inventory</td>
                                            <td>Warehouse System</td>
                                            <td>₱1,250,000.00</td>
                                            <td>₱1,245,000.00</td>
                                            <td>₱5,000.00</td>
                                            <td><span class="status status-variance">Variance</span></td>
                                            <td>2025-09-02</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewReconciliationModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-warning btn-sm"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h3 class="form-label" style="margin-top: 30px;">Variance Analysis</h3>
                            <div class="variance-chart">
                                <div class="variance-bar" style="height: 80%">
                                    <div class="variance-label">AP</div>
                                </div>
                                <div class="variance-bar" style="height: 60%">
                                    <div class="variance-label">Revenue</div>
                                </div>
                                <div class="variance-bar" style="height: 70%">
                                    <div class="variance-label">Expenses</div>
                                </div>
                                <div class="variance-bar" style="height: 90%">
                                    <div class="variance-label">Inventory</div>
                                </div>
                                <div class="variance-bar negative" style="height: 40%">
                                    <div class="variance-label">Payroll</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Unreconciled Items Tab -->
                <div class="tab-content" id="unreconciled-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Unreconciled Items</h2>
                            <div>
                                <button class="btn btn-primary" onclick="openModal('autoMatchModal')"><i class="fas fa-magic"></i> Auto-Match</button>
                                <button class="btn btn-secondary"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="unreconciledSearch" placeholder="Search by account, reference, or amount...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Account Type</span>
                                    <select class="filter-select" id="accountTypeFilter">
                                        <option value="">All Types</option>
                                        <option value="cash">Cash</option>
                                        <option value="ar">Accounts Receivable</option>
                                        <option value="ap">Accounts Payable</option>
                                        <option value="revenue">Revenue</option>
                                        <option value="expenses">Expenses</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Variance Amount</span>
                                    <select class="filter-select" id="varianceFilter">
                                        <option value="">All Variances</option>
                                        <option value="small">Small (&lt; ₱1,000)</option>
                                        <option value="medium">Medium (₱1,000 - ₱10,000)</option>
                                        <option value="large">Large (&gt; ₱10,000)</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Age</span>
                                    <select class="filter-select" id="ageFilter">
                                        <option value="">All Ages</option>
                                        <option value="today">Today</option>
                                        <option value="week">This Week</option>
                                        <option value="month">This Month</option>
                                        <option value="older">Older</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Reference</th>
                                            <th>Account</th>
                                            <th>Description</th>
                                            <th>GL Amount</th>
                                            <th>Subsystem Amount</th>
                                            <th>Variance</th>
                                            <th>Age (Days)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>AP-INV-085</td>
                                            <td>2000 - Accounts Payable</td>
                                            <td>Vendor invoice not recorded in AP</td>
                                            <td>₱0.00</td>
                                            <td>₱12,500.00</td>
                                            <td>₱12,500.00</td>
                                            <td>5</td>
                                            <td><span class="status status-variance">High Variance</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewItemModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-link"></i></button>
                                                <button class="btn btn-warning btn-sm" onclick="openModal('escalateModal')"><i class="fas fa-flag"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>AR-PMT-042</td>
                                            <td>1200 - Accounts Receivable</td>
                                            <td>Customer payment timing difference</td>
                                            <td>₱8,750.00</td>
                                            <td>₱0.00</td>
                                            <td>₱8,750.00</td>
                                            <td>3</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewItemModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-link"></i></button>
                                                <button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BUD-COMM-015</td>
                                            <td>5100 - Operating Expenses</td>
                                            <td>Budget commitment not yet incurred</td>
                                            <td>₱0.00</td>
                                            <td>₱150,000.00</td>
                                            <td>₱150,000.00</td>
                                            <td>7</td>
                                            <td><span class="status status-variance">Expected</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewItemModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-clock"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BANK-092</td>
                                            <td>1100 - Bank Accounts</td>
                                            <td>Bank fee not recorded in GL</td>
                                            <td>₱0.00</td>
                                            <td>₱250.00</td>
                                            <td>₱250.00</td>
                                            <td>2</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewItemModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-link"></i></button>
                                                <button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>INV-ADJ-007</td>
                                            <td>1300 - Inventory</td>
                                            <td>Inventory adjustment discrepancy</td>
                                            <td>₱5,000.00</td>
                                            <td>₱0.00</td>
                                            <td>₱5,000.00</td>
                                            <td>10</td>
                                            <td><span class="status status-variance">Needs Review</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewItemModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-link"></i></button>
                                                <button class="btn btn-warning btn-sm" onclick="openModal('escalateModal')"><i class="fas fa-flag"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Auto-Matching Tool Tab -->
                <div class="tab-content" id="automatch-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Auto-Matching Tool</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Account Type</label>
                                        <select class="form-control">
                                            <option value="">Select Account Type</option>
                                            <option value="cash">Cash/Bank Accounts</option>
                                            <option value="ar">Accounts Receivable</option>
                                            <option value="ap">Accounts Payable</option>
                                            <option value="revenue">Revenue</option>
                                            <option value="expenses">Expenses</option>
                                            <option value="all">All Accounts</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Date Range</label>
                                        <div class="form-row" style="margin-bottom: 0; gap: 10px;">
                                            <input type="date" class="form-control" value="2025-09-01">
                                            <span>to</span>
                                            <input type="date" class="form-control" value="2025-09-05">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Matching Tolerance</label>
                                <div class="form-row">
                                    <div class="form-col">
                                        <label class="form-label">Amount Tolerance</label>
                                        <input type="number" class="form-control" value="100" step="1" min="0">
                                        <small>Maximum amount difference to consider a match</small>
                                    </div>
                                    <div class="form-col">
                                        <label class="form-label">Date Tolerance</label>
                                        <input type="number" class="form-control" value="2" step="1" min="0">
                                        <small>Maximum days difference to consider a match</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Matching Rules</label>
                                <div>
                                    <label style="display: flex; align-items: center; margin-bottom: 10px;">
                                        <input type="checkbox" checked style="margin-right: 10px;"> Match by reference number
                                    </label>
                                    <label style="display: flex; align-items: center; margin-bottom: 10px;">
                                        <input type="checkbox" checked style="margin-right: 10px;"> Match by amount
                                    </label>
                                    <label style="display: flex; align-items: center; margin-bottom: 10px;">
                                        <input type="checkbox" style="margin-right: 10px;"> Match by date
                                    </label>
                                    <label style="display: flex; align-items: center;">
                                        <input type="checkbox" style="margin-right: 10px;"> Match by description keywords
                                    </label>
                                </div>
                            </div>

                            <div style="text-align: center; margin: 30px 0;">
                                <button class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">
                                    <i class="fas fa-play-circle"></i> Run Auto-Matching
                                </button>
                            </div>

                            <div class="reconciliation-comparison">
                                <div class="comparison-box">
                                    <div class="comparison-title">GL Transactions</div>
                                    <div class="comparison-value">142</div>
                                    <div class="comparison-variance">Unmatched: 24</div>
                                </div>
                                <div class="comparison-arrow">
                                    <i class="fas fa-arrows-alt-h"></i>
                                </div>
                                <div class="comparison-box">
                                    <div class="comparison-title">Subsystem Transactions</div>
                                    <div class="comparison-value">138</div>
                                    <div class="comparison-variance">Unmatched: 20</div>
                                </div>
                            </div>

                            <div class="progress-container">
                                <div class="progress-label">
                                    <span>Potential Matches Found</span>
                                    <span>18/24</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 75%"></div>
                                </div>
                            </div>

                            <div style="margin-top: 30px; text-align: center;">
                                <button class="btn btn-success" disabled>
                                    <i class="fas fa-check-double"></i> Apply All Matches (18)
                                </button>
                                <button class="btn btn-secondary">
                                    <i class="fas fa-eye"></i> Review Matches
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Escalation Workflow Tab -->
                <div class="tab-content" id="escalation-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Escalation Workflow</h2>
                            <div>
                                <button class="btn btn-primary"><i class="fas fa-plus"></i> New Escalation</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="escalationSearch" placeholder="Search by issue, assignee, or status...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="escalationStatusFilter">
                                        <option value="">All Statuses</option>
                                        <option value="open">Open</option>
                                        <option value="in-progress">In Progress</option>
                                        <option value="resolved">Resolved</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Priority</span>
                                    <select class="filter-select" id="priorityFilter">
                                        <option value="">All Priorities</option>
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                        <option value="critical">Critical</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Assignee</span>
                                    <select class="filter-select" id="assigneeFilter">
                                        <option value="">All Assignees</option>
                                        <option value="john">John Dela Cruz</option>
                                        <option value="maria">Maria Santos</option>
                                        <option value="carlos">Carlos Reyes</option>
                                        <option value="unassigned">Unassigned</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Issue ID</th>
                                            <th>Description</th>
                                            <th>Account</th>
                                            <th>Variance</th>
                                            <th>Priority</th>
                                            <th>Assignee</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ESC-2025-1001</td>
                                            <td>AP subledger missing vendor invoices</td>
                                            <td>2000 - Accounts Payable</td>
                                            <td>₱12,500.00</td>
                                            <td><span class="status" style="background: #e74c3c;">High</span></td>
                                            <td>John Dela Cruz</td>
                                            <td><span class="status status-in-progress">In Progress</span></td>
                                            <td>2025-09-03</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewEscalationModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ESC-2025-1002</td>
                                            <td>Inventory valuation discrepancy</td>
                                            <td>1300 - Inventory</td>
                                            <td>₱5,000.00</td>
                                            <td><span class="status" style="background: #f39c12;">Medium</span></td>
                                            <td>Maria Santos</td>
                                            <td><span class="status status-pending">Open</span></td>
                                            <td>2025-09-04</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewEscalationModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ESC-2025-1003</td>
                                            <td>Revenue recognition timing difference</td>
                                            <td>4000 - Sales Revenue</td>
                                            <td>₱4,800.00</td>
                                            <td><span class="status" style="background: #f39c12;">Medium</span></td>
                                            <td>Unassigned</td>
                                            <td><span class="status status-pending">Open</span></td>
                                            <td>2025-09-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewEscalationModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-user-plus"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ESC-2025-0998</td>
                                            <td>Bank reconciliation outstanding item</td>
                                            <td>1100 - Bank Accounts</td>
                                            <td>₱250.00</td>
                                            <td><span class="status" style="background: #2ecc71;">Low</span></td>
                                            <td>Carlos Reyes</td>
                                            <td><span class="status status-reconciled">Resolved</span></td>
                                            <td>2025-09-01</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewEscalationModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h3 class="form-label" style="margin-top: 30px;">Workflow Status</h3>
                            <div class="workflow-steps">
                                <div class="workflow-step step-completed">
                                    <div class="step-icon">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <div class="step-label">Issue Identified</div>
                                </div>
                                <div class="workflow-step step-completed">
                                    <div class="step-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="step-label">Assigned</div>
                                </div>
                                <div class="workflow-step step-active">
                                    <div class="step-icon">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <div class="step-label">Investigation</div>
                                </div>
                                <div class="workflow-step">
                                    <div class="step-icon">
                                        <i class="fas fa-wrench"></i>
                                    </div>
                                    <div class="step-label">Resolution</div>
                                </div>
                                <div class="workflow-step">
                                    <div class="step-icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="step-label">Closed</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Reconciliation Management</p>
            </div>
        </div>
    </div>

    <!-- View Reconciliation Modal -->
    <div id="viewReconciliationModal" class="modal">
        <div class="modal-content" style="max-width: 900px;">
            <div class="modal-header">
                <h2 class="modal-title">Reconciliation Details</h2>
                <span class="close" onclick="closeModal('viewReconciliationModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Account</label>
                            <p>2000 - Accounts Payable</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Subsystem</label>
                            <p>AP Subledger</p>
                        </div>
                    </div>
                </div>

                <div class="reconciliation-comparison">
                    <div class="comparison-box">
                        <div class="comparison-title">GL Balance</div>
                        <div class="comparison-value">₱389,500.00</div>
                        <div class="comparison-variance">As of Sep 5, 2025</div>
                    </div>
                    <div class="comparison-arrow">
                        <i class="fas fa-arrows-alt-h"></i>
                    </div>
                    <div class="comparison-box">
                        <div class="comparison-title">Subsystem Balance</div>
                        <div class="comparison-value">₱392,150.00</div>
                        <div class="comparison-variance">As of Sep 5, 2025</div>
                    </div>
                </div>

                <div class="comparison-box" style="grid-column: 1 / -1; text-align: center; background: #fff3cd;">
                    <div class="comparison-title">Variance</div>
                    <div class="comparison-value variance-negative">₱2,650.00</div>
                    <div class="comparison-variance">0.68% difference</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Unreconciled Items</label>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Reference</th>
                                    <th>Description</th>
                                    <th>GL Amount</th>
                                    <th>Subsystem Amount</th>
                                    <th>Variance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2025-09-01</td>
                                    <td>AP-INV-085</td>
                                    <td>Vendor invoice not recorded in AP</td>
                                    <td>₱0.00</td>
                                    <td>₱12,500.00</td>
                                    <td>₱12,500.00</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm"><i class="fas fa-link"></i></button>
                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2025-08-28</td>
                                    <td>AP-CR-042</td>
                                    <td>Credit memo not applied in GL</td>
                                    <td>₱9,850.00</td>
                                    <td>₱0.00</td>
                                    <td>₱9,850.00</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm"><i class="fas fa-link"></i></button>
                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Reconciliation History</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <div style="width: 20px; height: 20px; border-radius: 50%; background: #2ecc71; margin-right: 10px;"></div>
                            <div>
                                <strong>Reconciled</strong> - John Dela Cruz - 2025-08-31
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <div style="width: 20px; height: 20px; border-radius: 50%; background: #2ecc71; margin-right: 10px;"></div>
                            <div>
                                <strong>Reconciled</strong> - Maria Santos - 2025-08-24
                            </div>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <div style="width: 20px; height: 20px; border-radius: 50%; background: #f39c12; margin-right: 10px;"></div>
                            <div>
                                <strong>Variance Identified</strong> - System - 2025-09-05
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('viewReconciliationModal')">Close</button>
                <button class="btn btn-primary">Generate Variance Report</button>
                <button class="btn btn-success">Mark as Reconciled</button>
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

        // Dashboard card click to navigate to tabs
        document.querySelectorAll('.dashboard-card').forEach(card => {
            card.addEventListener('click', function() {
                // Simple logic to determine which tab to open based on card content
                if (this.querySelector('h3').textContent.includes('Reconciled')) {
                    setActiveTab('dashboard-tab');
                } else if (this.querySelector('h3').textContent.includes('Pending') || 
                          this.querySelector('h3').textContent.includes('Variances')) {
                    setActiveTab('unreconciled-tab');
                } else if (this.querySelector('h3').textContent.includes('Escalated')) {
                    setActiveTab('escalation-tab');
                }
            });
        });

        // Auto-match button functionality
        document.querySelector('.btn-primary[onclick="openModal(\'autoMatchModal\')"]').addEventListener('click', function() {
            setActiveTab('automatch-tab');
        });
    </script>
</body>
</html>

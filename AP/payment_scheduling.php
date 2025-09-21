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
            --pending: #f39c12;
            --disbursed: #2ecc71;
            --ongoing: #3498db;
            --urgent: #e74c3c;
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

        .card-icon.teal {
            background-color: rgba(0, 150, 136, 0.2);
            color: #00897b;
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

        .sub-tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            flex-wrap: wrap;
        }

        .sub-tab {
            padding: 10px 20px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border-bottom: 2px solid transparent;
        }

        .sub-tab.active {
            border-bottom: 2px solid var(--secondary);
            color: var(--secondary);
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
            max-height: 500px;
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
            position: sticky;
            top: 0;
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
            background-color: var(--pending);
            color: white;
        }

        .status-ongoing {
            background-color: var(--ongoing);
            color: white;
        }

        .status-ready {
            background-color: var(--success);
            color: white;
        }

        .status-urgent {
            background-color: var(--urgent);
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
            background-color: rgba(0, 0, 0, 0.7);
            transition: var(--transition);
        }

        .modal-content {
            background-color: white;
            margin: 2% auto;
            padding: 0;
            border-radius: 10px;
            width: 95%;
            max-width: 1000px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            animation: modalFade 0.3s;
            max-height: 96vh;
            display: flex;
            flex-direction: column;
        }

        @keyframes modalFade {
            from {
                opacity: 0;
                transform: translateY(-30px);
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
            background: var(--primary);
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .modal-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .close {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition);
        }

        .close:hover {
            color: #ecf0f1;
            transform: scale(1.1);
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

        /* Batch Creation */
        .batch-summary {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .batch-summary h4 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 15px;
            color: var(--dark);
        }

        .batch-items {
            margin-top: 20px;
        }

        .batch-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        /* Checkbox */
        .checkbox-container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 16px;
            user-select: none;
        }

        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 5px;
            transition: var(--transition);
        }

        .checkbox-container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        .checkbox-container input:checked ~ .checkmark {
            background-color: var(--secondary);
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-container input:checked ~ .checkmark:after {
            display: block;
        }

        .checkbox-container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }

        /* General Batch Form */
        .batch-form {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .batch-form h3 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 20px;
            color: var(--dark);
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
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
                width: 98%;
                margin: 1% auto;
            }
            
            .tabs {
                flex-wrap: wrap;
            }
            
            .tab {
                flex: 1;
                text-align: center;
                padding: 10px;
            }
            
            .card-header {
                flex-direction: column;
                align-items: flex-start;
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
                <h1 class="page-title">Payment Scheduling</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card" onclick="switchTab('payments', 'pending')">
                        <div class="card-icon orange">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Pending Payments</h3>
                        <p>56</p>
                        <small>Awaiting approval</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('general-batch')">
                        <div class="card-icon blue">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Ongoing Payments</h3>
                        <p>142</p>
                        <small>This month</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('invoice-queue')">
                        <div class="card-icon blue">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h3>Invoice Queue</h3>
                        <p>18</p>
                        <small>Ready for processing</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('payroll-queue')">
                        <div class="card-icon purple">
                            <i class="fas fa-money-check"></i>
                        </div>
                        <h3>Payroll Queue</h3>
                        <p>45</p>
                        <small>Scheduled payments</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('reimbursements')">
                        <div class="card-icon teal">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <h3>Reimbursements</h3>
                        <p>32</p>
                        <small>Pending requests</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('invoice-queue')">
                        <div class="card-icon red">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>Urgent Payments</h3>
                        <p>8</p>
                        <small>Require immediate action</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="payments">Pending Payments</div>
                    <div class="tab" data-tab="invoice-queue">Invoice Queue</div>
                    <div class="tab" data-tab="payroll-queue">Payroll Queue</div>
                    <div class="tab" data-tab="reimbursements">Reimbursements</div>
                    <div class="tab" data-tab="general-batch">General Payment Batch</div>
                </div>

                <!-- Payments Tab -->
                <div class="tab-content active" id="payments-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Pending Payments</h2>
                            <div>
                                <button class="btn btn-download" id="downloadPendingCSV"><i class="fas fa-download"></i> CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="pendingSearch" placeholder="Search Vendor, Employee, Invoice #, or Amount..." oninput="filterTable('pendingSearch', 'pendingTable')">
                            </div>
                            <div class="table-responsive">
                                <table id="pendingTable">
                                    <thead>
                                        <tr>
                                            <th>Vendor/Employee</th>
                                            <th>Type</th>
                                            <th>Reference #</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ABC Suppliers</td>
                                            <td>Invoice</td>
                                            <td>INV-2025-001</td>
                                            <td>₱12,500.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'invoice')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EMP-001 (Juan Dela Cruz)</td>
                                            <td>Payroll</td>
                                            <td>PR-2025-008</td>
                                            <td>₱28,300.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'payroll')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Maria Santos</td>
                                            <td>Reimbursement</td>
                                            <td>REIMB-2025-015</td>
                                            <td>₱5,800.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'reimbursement')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>XYZ Technologies</td>
                                            <td>Invoice</td>
                                            <td>INV-2025-002</td>
                                            <td>₱8,750.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'invoice')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EMP-003 (Pedro Reyes)</td>
                                            <td>Payroll</td>
                                            <td>PR-2025-009</td>
                                            <td>₱28,900.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'payroll')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Global Equipment</td>
                                            <td>Invoice</td>
                                            <td>INV-2025-003</td>
                                            <td>₱15,200.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'invoice')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EMP-005 (Carlos Garcia)</td>
                                            <td>Reimbursement</td>
                                            <td>REIMB-2025-016</td>
                                            <td>₱5,800.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'reimbursement')"><i class="fas fa-eye"></i></button>
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

                <!-- Invoice Queue Tab -->
                <div class="tab-content" id="invoice-queue-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Invoice Queue</h2>
                            <div>
                                <button class="btn btn-primary" onclick="openModal('createBatchModal', 'invoice')"><i class="fas fa-plus"></i> Create Invoice Batch</button>
                                <button class="btn btn-download"><i class="fas fa-download"></i> CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="invoiceQueueSearch" placeholder="Search Vendor ID, Invoice #, or Amount..." oninput="filterTable('invoiceQueueSearch', 'invoiceQueueTable')">
                            </div>
                            <div class="table-responsive">
                                <table id="invoiceQueueTable">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="selectAllInvoices">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </th>
                                            <th>Vendor ID</th>
                                            <th>Invoice #</th>
                                            <th>Due Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="invoice-checkbox" data-due-date="2025-09-15" data-amount="12500" data-vendor="ABC Suppliers" data-invoice="INV-2025-001">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>VEND-001</td>
                                            <td>INV-2025-001</td>
                                            <td>2025-09-15</td>
                                            <td>₱12,500.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'invoice')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="invoice-checkbox" data-due-date="2025-09-15" data-amount="8750" data-vendor="XYZ Technologies" data-invoice="INV-2025-002">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>VEND-002</td>
                                            <td>INV-2025-002</td>
                                            <td>2025-09-15</td>
                                            <td>₱8,750.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'invoice')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="invoice-checkbox" data-due-date="2025-09-18" data-amount="15200" data-vendor="Global Equipment" data-invoice="INV-2025-003">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>VEND-003</td>
                                            <td>INV-2025-003</td>
                                            <td>2025-09-18</td>
                                            <td>₱15,200.00</td>
                                            <td><span class="status status-urgent">Urgent</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'invoice')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="invoice-checkbox" data-due-date="2025-09-20" data-amount="9800" data-vendor="Office Supplies Co." data-invoice="INV-2025-004">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>VEND-004</td>
                                            <td>INV-2025-004</td>
                                            <td>2025-09-20</td>
                                            <td>₱9,800.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'invoice')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="invoice-checkbox" data-due-date="2025-09-15" data-amount="22500" data-vendor="Tech Solutions Inc." data-invoice="INV-2025-005">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>VEND-005</td>
                                            <td>INV-2025-005</td>
                                            <td>2025-09-15</td>
                                            <td>₱22,500.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'invoice')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="invoice-checkbox" data-due-date="2025-09-22" data-amount="18500" data-vendor="Logistics Partners" data-invoice="INV-2025-006">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>VEND-006</td>
                                            <td>INV-2025-006</td>
                                            <td>2025-09-22</td>
                                            <td>₱18,500.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'invoice')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payroll Queue Tab -->
                <div class="tab-content" id="payroll-queue-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Payroll Queue</h2>
                            <div>
                                <button class="btn btn-primary" onclick="openModal('createBatchModal', 'payroll')"><i class="fas fa-plus"></i> Create Payroll Batch</button>
                                <button class="btn btn-download"><i class="fas fa-download"></i> CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="payrollQueueSearch" placeholder="Search Employee ID, Name, or Net Pay..." oninput="filterTable('payrollQueueSearch', 'payrollQueueTable')">
                            </div>
                            <div class="table-responsive">
                                <table id="payrollQueueTable">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="selectAllPayroll">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </th>
                                            <th>Employee ID</th>
                                            <th>Employee Name</th>
                                            <th>Pay Date</th>
                                            <th>Net Pay</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="payroll-checkbox" data-pay-date="2025-09-15" data-amount="28300" data-employee="EMP-001 (Juan Dela Cruz)">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>EMP-001</td>
                                            <td>Juan Dela Cruz</td>
                                            <td>2025-09-15</td>
                                            <td>₱28,300.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'payroll')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="payroll-checkbox" data-pay-date="2025-09-15" data-amount="42300" data-employee="EMP-002 (Maria Santos)">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>EMP-002</td>
                                            <td>Maria Santos</td>
                                            <td>2025-09-15</td>
                                            <td>₱42,300.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'payroll')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="payroll-checkbox" data-pay-date="2025-09-20" data-amount="28900" data-employee="EMP-003 (Pedro Reyes)">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>EMP-003</td>
                                            <td>Pedro Reyes</td>
                                            <td>2025-09-20</td>
                                            <td>₱28,900.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'payroll')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="payroll-checkbox" data-pay-date="2025-09-15" data-amount="23800" data-employee="EMP-004 (Ana Lopez)">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>EMP-004</td>
                                            <td>Ana Lopez</td>
                                            <td>2025-09-15</td>
                                            <td>₱23,800.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'payroll')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="payroll-checkbox" data-pay-date="2025-09-15" data-amount="32500" data-employee="EMP-009 (Robert Lim)">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>EMP-009</td>
                                            <td>Robert Lim</td>
                                            <td>2025-09-15</td>
                                            <td>₱32,500.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'payroll')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="payroll-checkbox" data-pay-date="2025-09-20" data-amount="27500" data-employee="EMP-010 (Susan Tan)">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>EMP-010</td>
                                            <td>Susan Tan</td>
                                            <td>2025-09-20</td>
                                            <td>₱27,500.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'payroll')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reimbursements Tab -->
                <div class="tab-content" id="reimbursements-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Reimbursements Queue</h2>
                            <div>
                                <button class="btn btn-primary" onclick="openModal('createBatchModal', 'reimbursement')"><i class="fas fa-plus"></i> Create Reimbursement Batch</button>
                                <button class="btn btn-download"><i class="fas fa-download"></i> CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="reimbursementQueueSearch" placeholder="Search Employee ID, Name, or Amount..." oninput="filterTable('reimbursementQueueSearch', 'reimbursementQueueTable')">
                            </div>
                            <div class="table-responsive">
                                <table id="reimbursementQueueTable">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="selectAllReimbursements">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </th>
                                            <th>Employee ID</th>
                                            <th>Employee Name</th>
                                            <th>Request Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="reimbursement-checkbox" data-request-date="2025-09-10" data-amount="5800" data-employee="EMP-005 (Carlos Garcia)">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>EMP-005</td>
                                            <td>Carlos Garcia</td>
                                            <td>2025-09-10</td>
                                            <td>₱5,800.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'reimbursement')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="reimbursement-checkbox" data-request-date="2025-09-12" data-amount="12000" data-employee="EMP-006 (Elena Rodriguez)">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>EMP-006</td>
                                            <td>Elena Rodriguez</td>
                                            <td>2025-09-12</td>
                                            <td>₱12,000.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'reimbursement')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="reimbursement-checkbox" data-request-date="2025-09-15" data-amount="7500" data-employee="EMP-007 (Miguel Torres)">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>EMP-007</td>
                                            <td>Miguel Torres</td>
                                            <td>2025-09-15</td>
                                            <td>₱7,500.00</td>
                                            <td><span class="status status-urgent">Urgent</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'reimbursement')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="reimbursement-checkbox" data-request-date="2025-09-08" data-amount="3200" data-employee="EMP-008 (Sofia Martinez)">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>EMP-008</td>
                                            <td>Sofia Martinez</td>
                                            <td>2025-09-08</td>
                                            <td>₱3,200.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'reimbursement')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="reimbursement-checkbox" data-request-date="2025-09-14" data-amount="9500" data-employee="EMP-011 (James Wilson)">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>EMP-011</td>
                                            <td>James Wilson</td>
                                            <td>2025-09-14</td>
                                            <td>₱9,500.00</td>
                                            <td><span class="status status-ready">Ready</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'reimbursement')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkbox-container">
                                                    <input type="checkbox" class="reimbursement-checkbox" data-request-date="2025-09-16" data-amount="6200" data-employee="EMP-012 (Lisa Garcia)">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>EMP-012</td>
                                            <td>Lisa Garcia</td>
                                            <td>2025-09-16</td>
                                            <td>₱6,200.00</td>
                                            <td><span class="status status-urgent">Urgent</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'reimbursement')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- General Payment Batch Tab -->
                <div class="tab-content" id="general-batch-tab">
                    <!-- Ongoing Payments Table -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Ongoing Payments</h2>
                            <div>
                                <button class="btn btn-download" id="downloadOngoingCSV"><i class="fas fa-download"></i> CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="ongoingSearch" placeholder="Search Batch ID, Type, or Amount..." oninput="filterTable('ongoingSearch', 'ongoingTable')">
                            </div>
                            <div class="table-responsive">
                                <table id="ongoingTable">
                                    <thead>
                                        <tr>
                                            <th>Batch ID</th>
                                            <th>Type</th>
                                            <th>Payment Date</th>
                                            <th>Items Count</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>BATCH-2025-001</td>
                                            <td>Invoice</td>
                                            <td>2025-09-05</td>
                                            <td>5</td>
                                            <td>₱65,200.00</td>
                                            <td><span class="status status-ongoing">Ongoing</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'batch')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BATCH-2025-002</td>
                                            <td>Payroll</td>
                                            <td>2025-09-05</td>
                                            <td>23</td>
                                            <td>₱652,150.00</td>
                                            <td><span class="status status-ongoing">Ongoing</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'batch')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BATCH-2025-003</td>
                                            <td>Reimbursement</td>
                                            <td>2025-09-06</td>
                                            <td>12</td>
                                            <td>₱48,750.00</td>
                                            <td><span class="status status-ongoing">Ongoing</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'batch')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BATCH-2025-004</td>
                                            <td>Invoice</td>
                                            <td>2025-09-08</td>
                                            <td>3</td>
                                            <td>₱28,400.00</td>
                                            <td><span class="status status-ongoing">Ongoing</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'batch')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BATCH-2025-005</td>
                                            <td>Payroll</td>
                                            <td>2025-09-12</td>
                                            <td>18</td>
                                            <td>₱512,800.00</td>
                                            <td><span class="status status-ongoing">Ongoing</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'batch')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BATCH-2025-006</td>
                                            <td>Reimbursement</td>
                                            <td>2025-09-14</td>
                                            <td>8</td>
                                            <td>₱42,300.00</td>
                                            <td><span class="status status-ongoing">Ongoing</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewDetailsModal', 'batch')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- General Batch Form -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">General Payment Batch</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="generalBatchSearch" placeholder="Search across all queues..." oninput="filterTable('generalBatchSearch', 'generalBatchTable')">
                            </div>
                            <p>Select items from any queue to include in a general payment batch. The system will automatically determine the optimal payment date based on your selections.</p>
                            
                            <div class="batch-summary">
                                <h4>Batch Summary</h4>
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Selected Invoices</label>
                                            <p id="selectedInvoicesCount">0 items</p>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Selected Payroll</label>
                                            <p id="selectedPayrollCount">0 items</p>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Selected Reimbursements</label>
                                            <p id="selectedReimbursementsCount">0 items</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Estimated Total Amount</label>
                                    <p id="estimatedTotalAmount">₱0.00</p>
                                </div>
                            </div>

                            <!-- General Batch Form -->
                            <div class="batch-form">
                                <h3>Create General Payment Batch</h3>
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Batch Name</label>
                                            <input type="text" class="form-control" placeholder="e.g., September General Batch">
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Payment Date</label>
                                            <input type="date" class="form-control" id="generalPaymentDate">
                                            <small>Based on the most frequent date from selected items</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Payment Method</label>
                                    <select class="form-control" id="generalPaymentMethod">
                                        <option value="">Select Payment Method</option>
                                        <option value="bank">Bank Transfer</option>
                                        <option value="gcash">GCash</option>
                                        <option value="paymaya">PayMaya</option>
                                        <option value="paypal">PayPal</option>
                                    </select>
                                </div>

                                <div id="generalPaymentDetails" style="display: none;">
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="form-label">Account Name</label>
                                                <input type="text" class="form-control" placeholder="Account Name">
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="form-label">Account Number</label>
                                                <input type="text" class="form-control" placeholder="Account Number">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Selected Items</label>
                                    <div class="batch-items" id="generalBatchItems">
                                        <div class="batch-item" style="font-style: italic; color: #777;">
                                            No items selected yet
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Notes</label>
                                    <textarea class="form-control" rows="3" placeholder="Add any notes for this payment batch"></textarea>
                                </div>

                                <div class="form-row">
                                    <div class="form-col" style="display: flex; gap: 10px; justify-content: flex-end;">
                                        <button type="button" class="btn btn-secondary">Cancel</button>
                                        <button type="button" class="btn btn-primary">Create Batch</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Payment Scheduling</p>
            </div>
        </div>
    </div>

    <!-- View Details Modal -->
    <div id="viewDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="detailsModalTitle">Details</h2>
                <span class="close" onclick="closeModal('viewDetailsModal')">&times;</span>
            </div>
            <div class="modal-body" id="detailsModalBody">
                <!-- Content will be dynamically inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('viewDetailsModal')">Close</button>
                <button type="button" class="btn btn-primary">Print</button>
            </div>
        </div>
    </div>

    <!-- Create Batch Modal -->
    <div id="createBatchModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="createBatchModalTitle">Create Payment Batch</h2>
                <span class="close" onclick="closeModal('createBatchModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Batch Name</label>
                            <input type="text" class="form-control" placeholder="e.g., September Payments Week 1">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Payment Date</label>
                            <input type="date" class="form-control" id="batchPaymentDate">
                            <small id="batchDateNote">Based on the most frequent date</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Payment Method</label>
                    <select class="form-control" id="batchPaymentMethod">
                        <option value="">Select Payment Method</option>
                        <option value="bank">Bank Transfer</option>
                        <option value="gcash">GCash</option>
                        <option value="paymaya">PayMaya</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>

                <div id="batchPaymentDetails" style="display: none;">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Account Name</label>
                                <input type="text" class="form-control" placeholder="Account Name">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Account Number</label>
                                <input type="text" class="form-control" placeholder="Account Number">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="batch-summary">
                    <h4>Selected Items</h4>
                    <div class="batch-items" id="batchItemsList">
                        <!-- Items will be dynamically inserted here -->
                    </div>
                    <div class="batch-item" style="font-weight: bold;">
                        <div>Total</div>
                        <div id="batchTotalAmount">₱0.00</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea class="form-control" rows="3" placeholder="Add any notes for this payment batch"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('createBatchModal')">Cancel</button>
                <button type="button" class="btn btn-primary">Create Batch</button>
            </div>
        </div>
    </div>

</div>

<script src="../PANEL/ASSETS/js/script-p.js"></script>
<script>
        // Sample data for modals
        const modalData = {
            invoice: {
                title: "Invoice Details",
                content: `
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Vendor</label>
                                <p>ABC Suppliers</p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Invoice #</label>
                                <p>INV-2025-001</p>
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
                                <p>₱12,500.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <p>Office supplies purchase for Q3 2025</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Items</label>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Paper (Ream)</td>
                                        <td>10</td>
                                        <td>₱250.00</td>
                                        <td>₱2,500.00</td>
                                    </tr>
                                    <tr>
                                        <td>Pens (Box)</td>
                                        <td>5</td>
                                        <td>₱350.00</td>
                                        <td>₱1,750.00</td>
                                    </tr>
                                    <tr>
                                        <td>Printer Ink</td>
                                        <td>3</td>
                                        <td>₱2,750.00</td>
                                        <td>₱8,250.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                `
            },
            payroll: {
                title: "Payroll Details",
                content: `
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Employee ID</label>
                                <p>EMP-001</p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Employee Name</label>
                                <p>Juan Dela Cruz</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Pay Date</label>
                                <p>2025-09-15</p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Net Pay</label>
                                <p>₱28,300.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Pay Period</label>
                                <p>2025-08-16 to 2025-08-31</p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <p><span class="status status-ready">Ready</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Earnings</label>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Basic Salary</td>
                                        <td>₱25,000.00</td>
                                    </tr>
                                    <tr>
                                        <td>Overtime Pay</td>
                                        <td>₱3,500.00</td>
                                    </tr>
                                    <tr>
                                        <td>Allowance</td>
                                        <td>₱2,000.00</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Gross Pay</strong></td>
                                        <td><strong>₱30,500.00</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                `
            },
            reimbursement: {
                title: "Reimbursement Details",
                content: `
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Employee ID</label>
                                <p>EMP-005</p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Employee Name</label>
                                <p>Carlos Garcia</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Request Date</label>
                                <p>2025-09-10</p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Amount</label>
                                <p>₱5,800.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Purpose</label>
                        <p>Business travel expenses for client meeting</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Expense Details</label>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Receipt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2025-09-05</td>
                                        <td>Transportation (Grab)</td>
                                        <td>₱850.00</td>
                                        <td><a href="#">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>2025-09-05</td>
                                        <td>Meals</td>
                                        <td>₱1,200.00</td>
                                        <td><a href="#">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>2025-09-06</td>
                                        <td>Hotel Accommodation</td>
                                        <td>₱3,500.00</td>
                                        <td><a href="#">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                `
            },
            batch: {
                title: "Batch Details",
                content: `
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Batch ID</label>
                                <p>BATCH-2025-001</p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Batch Type</label>
                                <p>Invoice Payments</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Payment Date</label>
                                <p>2025-09-05</p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Total Amount</label>
                                <p>₱65,200.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Payment Method</label>
                        <p>Bank Transfer</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Included Items</label>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Vendor</th>
                                        <th>Invoice #</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ABC Suppliers</td>
                                        <td>INV-2025-001</td>
                                        <td>₱12,500.00</td>
                                        <td>Paid</td>
                                    </tr>
                                    <tr>
                                        <td>XYZ Technologies</td>
                                        <td>INV-2025-002</td>
                                        <td>₱8,750.00</td>
                                        <td>Paid</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                `
            }
        };

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

        // Switch to a specific tab from dashboard cards
        function switchTab(tabName, subtabName = '') {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));
            
            // Add active class to specified tab
            document.querySelector(`.tab[data-tab="${tabName}"]`).classList.add('active');
            
            // Hide all tab content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Show the selected tab content
            document.getElementById(`${tabName}-tab`).classList.add('active');
        }

        // Modal functionality
        function openModal(modalId, dataType = '') {
            if (modalId === 'viewDetailsModal' && dataType) {
                // Set modal title and content based on data type
                document.getElementById('detailsModalTitle').textContent = modalData[dataType].title;
                document.getElementById('detailsModalBody').innerHTML = modalData[dataType].content;
            } else if (modalId === 'createBatchModal' && dataType) {
                // Set modal title based on batch type
                let title = 'Create Payment Batch';
                if (dataType === 'invoice') title = 'Create Invoice Batch';
                else if (dataType === 'payroll') title = 'Create Payroll Batch';
                else if (dataType === 'reimbursement') title = 'Create Reimbursement Batch';
                
                document.getElementById('createBatchModalTitle').textContent = title;
                
                // Update the batch items list based on selected checkboxes
                updateBatchItems(dataType);
            }
            
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

        // Show payment details when payment method is selected
        document.getElementById('batchPaymentMethod').addEventListener('change', function() {
            const paymentDetails = document.getElementById('batchPaymentDetails');
            if (this.value) {
                paymentDetails.style.display = 'block';
            } else {
                paymentDetails.style.display = 'none';
            }
        });

        document.getElementById('generalPaymentMethod').addEventListener('change', function() {
            const paymentDetails = document.getElementById('generalPaymentDetails');
            if (this.value) {
                paymentDetails.style.display = 'block';
            } else {
                paymentDetails.style.display = 'none';
            }
        });

        // Select all checkboxes functionality
        document.getElementById('selectAllInvoices').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.invoice-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateGeneralBatchSummary();
        });

        document.getElementById('selectAllPayroll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.payroll-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateGeneralBatchSummary();
        });

        document.getElementById('selectAllReimbursements').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.reimbursement-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateGeneralBatchSummary();
        });

        // Individual checkbox change events
        document.querySelectorAll('.invoice-checkbox, .payroll-checkbox, .reimbursement-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateGeneralBatchSummary);
        });

        // Update batch items for create batch modal
        function updateBatchItems(type) {
            const batchItemsList = document.getElementById('batchItemsList');
            const batchTotalAmount = document.getElementById('batchTotalAmount');
            let itemsHTML = '';
            let totalAmount = 0;
            
            // Get selected checkboxes based on type
            const checkboxes = document.querySelectorAll(`.${type}-checkbox:checked`);
            
            checkboxes.forEach(checkbox => {
                const amount = parseFloat(checkbox.getAttribute('data-amount'));
                totalAmount += amount;
                
                if (type === 'invoice') {
                    const vendor = checkbox.getAttribute('data-vendor');
                    const invoice = checkbox.getAttribute('data-invoice');
                    itemsHTML += `<div class="batch-item"><div>${vendor} - ${invoice}</div><div>₱${amount.toLocaleString()}.00</div></div>`;
                } else if (type === 'payroll' || type === 'reimbursement') {
                    const employee = checkbox.getAttribute('data-employee');
                    itemsHTML += `<div class="batch-item"><div>${employee}</div><div>₱${amount.toLocaleString()}.00</div></div>`;
                }
            });
            
            batchItemsList.innerHTML = itemsHTML;
            batchTotalAmount.textContent = `₱${totalAmount.toLocaleString()}.00`;
            
            // Set payment date based on the most frequent date
            if (checkboxes.length > 0) {
                const dates = Array.from(checkboxes).map(cb => {
                    if (type === 'invoice') return cb.getAttribute('data-due-date');
                    if (type === 'payroll') return cb.getAttribute('data-pay-date');
                    if (type === 'reimbursement') return cb.getAttribute('data-request-date');
                });
                
                // Find the most frequent date
                const dateCounts = {};
                let maxCount = 0;
                let mostFrequentDate = dates[0];
                
                dates.forEach(date => {
                    dateCounts[date] = (dateCounts[date] || 0) + 1;
                    if (dateCounts[date] > maxCount) {
                        maxCount = dateCounts[date];
                        mostFrequentDate = date;
                    }
                });
                
                document.getElementById('batchPaymentDate').value = mostFrequentDate;
            }
        }

        // Update general batch summary
        function updateGeneralBatchSummary() {
            const invoiceCheckboxes = document.querySelectorAll('.invoice-checkbox:checked');
            const payrollCheckboxes = document.querySelectorAll('.payroll-checkbox:checked');
            const reimbursementCheckboxes = document.querySelectorAll('.reimbursement-checkbox:checked');
            
            document.getElementById('selectedInvoicesCount').textContent = `${invoiceCheckboxes.length} items`;
            document.getElementById('selectedPayrollCount').textContent = `${payrollCheckboxes.length} items`;
            document.getElementById('selectedReimbursementsCount').textContent = `${reimbursementCheckboxes.length} items`;
            
            let totalAmount = 0;
            let itemsHTML = '';
            
            invoiceCheckboxes.forEach(checkbox => {
                const amount = parseFloat(checkbox.getAttribute('data-amount'));
                totalAmount += amount;
                const vendor = checkbox.getAttribute('data-vendor');
                const invoice = checkbox.getAttribute('data-invoice');
                itemsHTML += `<div class="batch-item"><div>${vendor} - ${invoice}</div><div>₱${amount.toLocaleString()}.00</div></div>`;
            });
            
            payrollCheckboxes.forEach(checkbox => {
                const amount = parseFloat(checkbox.getAttribute('data-amount'));
                totalAmount += amount;
                const employee = checkbox.getAttribute('data-employee');
                itemsHTML += `<div class="batch-item"><div>${employee} (Payroll)</div><div>₱${amount.toLocaleString()}.00</div></div>`;
            });
            
            reimbursementCheckboxes.forEach(checkbox => {
                const amount = parseFloat(checkbox.getAttribute('data-amount'));
                totalAmount += amount;
                const employee = checkbox.getAttribute('data-employee');
                itemsHTML += `<div class="batch-item"><div>${employee} (Reimbursement)</div><div>₱${amount.toLocaleString()}.00</div></div>`;
            });
            
            document.getElementById('estimatedTotalAmount').textContent = `₱${totalAmount.toLocaleString()}.00`;
            
            // Update the general batch items list
            const generalBatchItems = document.getElementById('generalBatchItems');
            if (itemsHTML) {
                generalBatchItems.innerHTML = itemsHTML;
            } else {
                generalBatchItems.innerHTML = '<div class="batch-item" style="font-style: italic; color: #777;">No items selected yet</div>';
            }
            
            // Set payment date based on the most frequent date
            if (invoiceCheckboxes.length > 0 || payrollCheckboxes.length > 0 || reimbursementCheckboxes.length > 0) {
                const dates = [];
                
                invoiceCheckboxes.forEach(checkbox => {
                    dates.push(checkbox.getAttribute('data-due-date'));
                });
                
                payrollCheckboxes.forEach(checkbox => {
                    dates.push(checkbox.getAttribute('data-pay-date'));
                });
                
                reimbursementCheckboxes.forEach(checkbox => {
                    dates.push(checkbox.getAttribute('data-request-date'));
                });
                
                // Find the most frequent date
                const dateCounts = {};
                let maxCount = 0;
                let mostFrequentDate = dates[0];
                
                dates.forEach(date => {
                    dateCounts[date] = (dateCounts[date] || 0) + 1;
                    if (dateCounts[date] > maxCount) {
                        maxCount = dateCounts[date];
                        mostFrequentDate = date;
                    }
                });
                
                document.getElementById('generalPaymentDate').value = mostFrequentDate;
            }
        }

        // Search functionality
        function filterTable(inputId, tableId) {
            const input = document.getElementById(inputId);
            const filter = input.value.toLowerCase();
            const table = document.getElementById(tableId);
            const rows = table.getElementsByTagName('tr');
            
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;
                
                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell) {
                        if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                
                rows[i].style.display = found ? '' : 'none';
            }
        }

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
    </script>
</body>
</html>

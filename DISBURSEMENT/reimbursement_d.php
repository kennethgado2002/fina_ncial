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
            --reimbursement-pending: #f39c12;
            --reimbursement-approved: #3498db;
            --reimbursement-paid: #2ecc71;
            --reimbursement-rejected: #e74c3c;
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
            background-color: var(--reimbursement-pending);
            color: white;
        }

        .status-approved {
            background-color: var(--reimbursement-approved);
            color: white;
        }

        .status-paid {
            background-color: var(--reimbursement-paid);
            color: white;
        }

        .status-rejected {
            background-color: var(--reimbursement-rejected);
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
            background-color: #74b9ff;
            color: white;
        }

        .btn-process:hover {
            background-color: #0984e3;
        }

        .btn-upload {
            background-color: #9b59b6;
            color: white;
        }

        .btn-upload:hover {
            background-color: #8e44ad;
        }

        .btn-download {
            background-color: #2ecc71;
            color: white;
        }

        .btn-download:hover {
            background-color: #27ae60;
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

        /* Upload Area */
        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            margin-bottom: 20px;
            transition: var(--transition);
            cursor: pointer;
        }

        .upload-area:hover {
            border-color: var(--secondary);
            background-color: #f8f9fa;
        }

        .upload-icon {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 15px;
        }

        .upload-text {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .upload-hint {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px;
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

        .reimbursement-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .reimbursement-item:last-child {
            border-bottom: none;
        }

        .reimbursement-check {
            margin-right: 15px;
        }

        .reimbursement-details {
            flex: 1;
        }

        .reimbursement-amount {
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
                <h1 class="page-title">Employee Reimbursement Disbursement</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Pending Requests</h3>
                        <p>18</p>
                        <small>Awaiting approval</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Approved</h3>
                        <p>12</p>
                        <small>Ready for payment</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3>Total Amount</h3>
                        <p>₱85,500.00</p>
                        <small>This month</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>Rejected</h3>
                        <p>3</p>
                        <small>Not approved</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="dashboard">Request Dashboard</div>
                    <div class="tab" data-tab="upload">Receipt Upload</div>
                    <div class="tab" data-tab="batch">Batch Processor</div>
                    <div class="tab" data-tab="workflow">Approval Workflow</div>
                </div>

                <!-- Request Dashboard Tab -->
                <div class="tab-content active" id="dashboard-tab">
                    <!-- Reimbursement Status Chart -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Reimbursement Status Overview</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Time Period</span>
                                    <select class="filter-select" id="periodFilter">
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
                                        <option value="marketing">Marketing</option>
                                        <option value="it">IT</option>
                                        <option value="operations">Operations</option>
                                    </select>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="reimbursementStatusChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Reimbursement Requests Table -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Reimbursement Requests</h2>
                            <div>
                                <button class="btn btn-process"><i class="fas fa-play"></i> Process Selected</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="reimbursementSearch" placeholder="Search Employee, Expense Type, or Request ID...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAll"></th>
                                            <th>Request ID</th>
                                            <th>Employee</th>
                                            <th>Expense Type</th>
                                            <th>Amount</th>
                                            <th>Submission Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="request-checkbox"></td>
                                            <td>REIM-2025-001</td>
                                            <td>John Smith</td>
                                            <td>Business Travel</td>
                                            <td>₱12,500.00</td>
                                            <td>2025-09-05</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('requestDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="request-checkbox"></td>
                                            <td>REIM-2025-002</td>
                                            <td>Maria Garcia</td>
                                            <td>Client Entertainment</td>
                                            <td>₱8,750.00</td>
                                            <td>2025-09-04</td>
                                            <td><span class="status status-approved">Approved</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('requestDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-play"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="request-checkbox"></td>
                                            <td>REIM-2025-003</td>
                                            <td>Robert Johnson</td>
                                            <td>Office Supplies</td>
                                            <td>₱5,200.00</td>
                                            <td>2025-09-03</td>
                                            <td><span class="status status-paid">Paid</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('requestDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="request-checkbox"></td>
                                            <td>REIM-2025-004</td>
                                            <td>Sarah Williams</td>
                                            <td>Business Travel</td>
                                            <td>₱15,800.00</td>
                                            <td>2025-09-02</td>
                                            <td><span class="status status-rejected">Rejected</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('requestDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-comment"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="request-checkbox"></td>
                                            <td>REIM-2025-005</td>
                                            <td>James Brown</td>
                                            <td>Client Entertainment</td>
                                            <td>₱6,500.00</td>
                                            <td>2025-09-01</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('requestDetailsModal')"><i class="fas fa-eye"></i></button>
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

                <!-- Receipt Upload Tab -->
                <div class="tab-content" id="upload-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Expense Receipt Upload</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Employee</label>
                                        <select class="form-control" id="uploadEmployee">
                                            <option value="">Select Employee</option>
                                            <option value="john">John Smith</option>
                                            <option value="maria">Maria Garcia</option>
                                            <option value="robert">Robert Johnson</option>
                                            <option value="sarah">Sarah Williams</option>
                                            <option value="james">James Brown</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Expense Type</label>
                                        <select class="form-control" id="expenseType">
                                            <option value="">Select Expense Type</option>
                                            <option value="travel">Business Travel</option>
                                            <option value="entertainment">Client Entertainment</option>
                                            <option value="supplies">Office Supplies</option>
                                            <option value="meals">Business Meals</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Expense Date</label>
                                        <input type="date" class="form-control" id="expenseDate">
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Amount (₱)</label>
                                        <input type="number" class="form-control" id="expenseAmount" placeholder="Enter amount">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" id="expenseDescription" rows="3" placeholder="Describe the expense purpose"></textarea>
                            </div>

                            <div class="upload-area" id="receiptUploadArea">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="upload-text">Upload Receipts</div>
                                <div class="upload-hint">Drag & drop receipt images or click to browse (JPG, PNG, PDF)</div>
                                <input type="file" id="receiptInput" style="display: none;" accept=".jpg,.jpeg,.png,.pdf" multiple>
                            </div>

                            <div id="uploadedFiles" style="margin-top: 20px;">
                                <!-- Uploaded files will appear here -->
                            </div>

                            <div style="text-align: center; margin-top: 20px;">
                                <button class="btn btn-upload"><i class="fas fa-upload"></i> Submit Reimbursement</button>
                                <button class="btn btn-view"><i class="fas fa-save"></i> Save as Draft</button>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Uploads -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">My Recent Reimbursements</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Request ID</th>
                                            <th>Expense Type</th>
                                            <th>Amount</th>
                                            <th>Submission Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>REIM-2025-001</td>
                                            <td>Business Travel</td>
                                            <td>₱12,500.00</td>
                                            <td>2025-09-05</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REIM-2025-002</td>
                                            <td>Client Entertainment</td>
                                            <td>₱8,750.00</td>
                                            <td>2025-08-28</td>
                                            <td><span class="status status-paid">Paid</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REIM-2025-003</td>
                                            <td>Office Supplies</td>
                                            <td>₱5,200.00</td>
                                            <td>2025-08-15</td>
                                            <td><span class="status status-paid">Paid</span></td>
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

                <!-- Batch Processor Tab -->
                <div class="tab-content" id="batch-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Reimbursement Batch Processor</h2>
                        </div>
                        <div class="card-body">
                            <div class="batch-selection">
                                <div class="batch-header">
                                    <h3>Select Reimbursements for Batch Payment</h3>
                                    <div class="batch-actions">
                                        <button class="btn btn-view"><i class="fas fa-filter"></i> Filter</button>
                                        <button class="btn btn-process"><i class="fas fa-plus"></i> Add Manual</button>
                                    </div>
                                </div>
                                <div class="reimbursement-item">
                                    <div class="reimbursement-check">
                                        <input type="checkbox" class="batch-checkbox" checked>
                                    </div>
                                    <div class="reimbursement-details">
                                        <strong>Maria Garcia</strong> - Client Entertainment
                                        <div>Submitted: 2025-09-04</div>
                                    </div>
                                    <div class="reimbursement-amount">₱8,750.00</div>
                                </div>
                                <div class="reimbursement-item">
                                    <div class="reimbursement-check">
                                        <input type="checkbox" class="batch-checkbox" checked>
                                    </div>
                                    <div class="reimbursement-details">
                                        <strong>Robert Johnson</strong> - Office Supplies
                                        <div>Submitted: 2025-09-03</div>
                                    </div>
                                    <div class="reimbursement-amount">₱5,200.00</div>
                                </div>
                                <div class="reimbursement-item">
                                    <div class="reimbursement-check">
                                        <input type="checkbox" class="batch-checkbox">
                                    </div>
                                    <div class="reimbursement-details">
                                        <strong>Sarah Williams</strong> - Business Travel
                                        <div>Submitted: 2025-09-02</div>
                                    </div>
                                    <div class="reimbursement-amount">₱15,800.00</div>
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
                                        <select class="form-control" id="paymentMethod">
                                            <option value="payroll">Payroll Bank</option>
                                            <option value="ewallet">E-wallet</option>
                                            <option value="check">Check</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Batch Reference</label>
                                <input type="text" class="form-control" id="batchReference" placeholder="Enter batch reference" value="REIM-BATCH-2025-09">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Budget Availability Check</label>
                                <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                    <p><strong>Available Budget:</strong> ₱150,000.00</p>
                                    <p><strong>Batch Total:</strong> ₱13,950.00</p>
                                    <p><strong>Status:</strong> <span style="color: #2ecc71;">Sufficient Budget Available</span></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Total Batch Amount</label>
                                <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                    <h3>₱13,950.00</h3>
                                    <small>Total of 2 selected reimbursements</small>
                                </div>
                            </div>

                            <div style="text-align: center; margin-top: 20px;">
                                <button class="btn btn-process"><i class="fas fa-play"></i> Process Batch Payment</button>
                                <button class="btn btn-download"><i class="fas fa-file-export"></i> Export Bank File</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approval Workflow Tab -->
                <div class="tab-content" id="workflow-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Approval Workflow Tracker</h2>
                        </div>
                        <div class="card-body">
                            <div class="workflow-steps">
                                <div class="step completed">
                                    <div class="step-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="step-title">Submission</div>
                                    <div class="step-desc">Employee submits reimbursement request</div>
                                </div>
                                <div class="step completed">
                                    <div class="step-icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="step-title">Manager Review</div>
                                    <div class="step-desc">Direct manager approves or rejects</div>
                                </div>
                                <div class="step active">
                                    <div class="step-icon">
                                        <i class="fas fa-thumbs-up"></i>
                                    </div>
                                    <div class="step-title">Finance Approval</div>
                                    <div class="step-desc">Finance department verification</div>
                                </div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="fas fa-paper-plane"></i>
                                    </div>
                                    <div class="step-title">Payment Processing</div>
                                    <div class="step-desc">Payment disbursement to employee</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Select Reimbursement Request</label>
                                <select class="form-control" id="workflowRequest">
                                    <option value="">Select a reimbursement to view workflow</option>
                                    <option value="reim-001">REIM-2025-001 - John Smith - ₱12,500.00</option>
                                    <option value="reim-002">REIM-2025-002 - Maria Garcia - ₱8,750.00</option>
                                    <option value="reim-003">REIM-2025-003 - Robert Johnson - ₱5,200.00</option>
                                </select>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Workflow Details for REIM-2025-001</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="form-label">Submitted By</label>
                                                <p>John Smith (Sales Department)</p>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="form-label">Submission Date</label>
                                                <p>2025-09-05 14:30</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="form-label">Manager Approval</label>
                                                <p>Sarah Johnson (Sales Manager)</p>
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="form-label">Approval Date</label>
                                                <p>2025-09-06 09:15</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Manager Notes</label>
                                        <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                            <p>Approved business travel expenses for client meeting in Cebu. All receipts are in order and within policy limits.</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Finance Approval Decision</label>
                                        <div style="display: flex; gap: 15px;">
                                            <button class="btn btn-approve"><i class="fas fa-check"></i> Approve Reimbursement</button>
                                            <button class="btn btn-reject"><i class="fas fa-times"></i> Reject Reimbursement</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Finance Approval Notes</label>
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
                <p>&copy; 2025 Financial System - Employee Reimbursement</p>
            </div>
        </div>
    </div>

    <!-- Request Details Modal -->
    <div id="requestDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Reimbursement Details: REIM-2025-001</h2>
                <span class="close" onclick="closeModal('requestDetailsModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Employee</label>
                            <p>John Smith (EMP-001)</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Department</label>
                            <p>Sales</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Expense Type</label>
                            <p>Business Travel</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Submission Date</label>
                            <p>2025-09-05</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Amount</label>
                            <p>₱12,500.00</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <p><span class="status status-pending">Pending Approval</span></p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Expense Description</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p>Business travel to Cebu for client meeting with ABC Corporation. Expenses include airfare, hotel accommodation, and local transportation.</p>
                    </div>
                </div>

                <h3 class="form-label">Expense Breakdown</h3>
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
                                <td>2025-09-01</td>
                                <td>Manila to Cebu Airfare</td>
                                <td>₱5,800.00</td>
                                <td><button class="btn btn-view btn-sm"><i class="fas fa-eye"></i> View</button></td>
                            </tr>
                            <tr>
                                <td>2025-09-02</td>
                                <td>Hotel Accommodation (2 nights)</td>
                                <td>₱4,200.00</td>
                                <td><button class="btn btn-view btn-sm"><i class="fas fa-eye"></i> View</button></td>
                            </tr>
                            <tr>
                                <td>2025-09-03</td>
                                <td>Local Transportation</td>
                                <td>₱1,500.00</td>
                                <td><button class="btn btn-view btn-sm"><i class="fas fa-eye"></i> View</button></td>
                            </tr>
                            <tr>
                                <td>2025-09-03</td>
                                <td>Client Lunch Meeting</td>
                                <td>₱1,000.00</td>
                                <td><button class="btn btn-view btn-sm"><i class="fas fa-eye"></i> View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="form-label">Approval Workflow</h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Step</th>
                                <th>Approver</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Submission</td>
                                <td>John Smith</td>
                                <td>2025-09-05 14:30</td>
                                <td><span class="status status-completed">Completed</span></td>
                                <td>Request submitted with all receipts</td>
                            </tr>
                            <tr>
                                <td>Manager Review</td>
                                <td>Sarah Johnson</td>
                                <td>2025-09-06 09:15</td>
                                <td><span class="status status-completed">Approved</span></td>
                                <td>All expenses within policy limits</td>
                            </tr>
                            <tr>
                                <td>Finance Approval</td>
                                <td>Pending</td>
                                <td>-</td>
                                <td><span class="status status-pending">Pending</span></td>
                                <td>Awaiting finance department review</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label class="form-label">GL Posting Details</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>Expense Account:</strong> Travel & Entertainment (Debit: ₱12,500.00)</p>
                        <p><strong>Cash Account:</strong> Petty Cash / Bank Account (Credit: ₱12,500.00)</p>
                        <p><strong>Status:</strong> <span style="color: #f39c12;">Pending - Will post upon approval</span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('requestDetailsModal')">Close</button>
                <button type="button" class="btn btn-approve">Approve</button>
                <button type="button" class="btn btn-reject">Reject</button>
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

        // File upload functionality
        const receiptUploadArea = document.getElementById('receiptUploadArea');
        const receiptInput = document.getElementById('receiptInput');
        const uploadedFiles = document.getElementById('uploadedFiles');
        
        receiptUploadArea.addEventListener('click', function() {
            receiptInput.click();
        });
        
        receiptUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = 'var(--secondary)';
            this.style.backgroundColor = '#f8f9fa';
        });
        
        receiptUploadArea.addEventListener('dragleave', function() {
            this.style.borderColor = '#ddd';
            this.style.backgroundColor = 'transparent';
        });
        
        receiptUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#ddd';
            this.style.backgroundColor = 'transparent';
            
            if (e.dataTransfer.files.length) {
                handleFileUpload(e.dataTransfer.files);
            }
        });
        
        receiptInput.addEventListener('change', function() {
            if (this.files.length) {
                handleFileUpload(this.files);
            }
        });
        
        function handleFileUpload(files) {
            uploadedFiles.innerHTML = '';
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileElement = document.createElement('div');
                fileElement.style.display = 'flex';
                fileElement.style.alignItems = 'center';
                fileElement.style.padding = '10px';
                fileElement.style.borderBottom = '1px solid #eee';
                
                fileElement.innerHTML = `
                    <i class="fas fa-file" style="margin-right: 10px; color: #3498db;"></i>
                    <div style="flex: 1;">
                        <div>${file.name}</div>
                        <small>${(file.size / 1024).toFixed(2)} KB</small>
                    </div>
                    <button class="btn btn-view btn-sm" onclick="removeFile(this)"><i class="fas fa-times"></i></button>
                `;
                
                uploadedFiles.appendChild(fileElement);
            }
        }
        
        function removeFile(button) {
            button.parentElement.remove();
        }

        // Select all functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.request-checkbox');
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
            // Reimbursement Status Chart
            const reimbursementStatusCtx = document.getElementById('reimbursementStatusChart').getContext('2d');
            new Chart(reimbursementStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Approved', 'Paid', 'Rejected'],
                    datasets: [{
                        data: [18, 12, 25, 3],
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
                            text: 'Reimbursement Requests by Status'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>

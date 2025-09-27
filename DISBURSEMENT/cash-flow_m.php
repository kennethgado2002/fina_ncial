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
            --vendor: #3498db;
            --payroll: #9b59b6;
            --refund: #e74c3c;
            --reimbursement: #f39c12;
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

        .menu-item.active {
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--secondary);
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
            background-color: var(--warning);
            color: white;
        }

        .status-approved {
            background-color: var(--success);
            color: white;
        }

        .status-rejected {
            background-color: var(--accent);
            color: white;
        }

        .status-warning {
            background-color: var(--warning);
            color: white;
        }

        .status-critical {
            background-color: var(--accent);
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

        .btn-download {
            background-color: #9b59b6;
            color: white;
        }

        .btn-download:hover {
            background-color: #8e44ad;
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

        /* Form Elements */
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

        /* Charts */
        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px;
        }

        /* Cash Position Cards */
        .cash-position-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .cash-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: var(--transition);
        }

        .cash-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .cash-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .cash-card-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .cash-card-amount {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .cash-card-details {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        .cash-card-positive {
            border-left: 4px solid var(--success);
        }

        .cash-card-warning {
            border-left: 4px solid var(--warning);
        }

        .cash-card-critical {
            border-left: 4px solid var(--accent);
        }

        /* Forecast Timeline */
        .forecast-timeline {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .timeline-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .timeline-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .timeline-date {
            min-width: 100px;
            text-align: center;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 6px;
            margin-right: 15px;
        }

        .timeline-day {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .timeline-month {
            font-size: 0.8rem;
            color: #7f8c8d;
        }

        .timeline-content {
            flex: 1;
        }

        .timeline-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .timeline-amount {
            font-weight: 600;
            color: var(--dark);
        }

        .timeline-vendor {
            background-color: rgba(52, 152, 219, 0.1);
            border-left: 4px solid var(--vendor);
        }

        .timeline-payroll {
            background-color: rgba(155, 89, 182, 0.1);
            border-left: 4px solid var(--payroll);
        }

        .timeline-refund {
            background-color: rgba(231, 76, 60, 0.1);
            border-left: 4px solid var(--refund);
        }

        .timeline-reimbursement {
            background-color: rgba(243, 156, 18, 0.1);
            border-left: 4px solid var(--reimbursement);
        }

        /* Liquidity Alert */
        .liquidity-alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        .alert-warning {
            background-color: rgba(243, 156, 18, 0.2);
            border-left: 4px solid var(--warning);
        }

        .alert-critical {
            background-color: rgba(231, 76, 60, 0.2);
            border-left: 4px solid var(--accent);
        }

        .alert-icon {
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .alert-content h4 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 5px;
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
            
            .cash-position-cards {
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
            
            .timeline-item {
                flex-direction: column;
                text-align: center;
            }
            
            .timeline-date {
                margin-right: 0;
                margin-bottom: 10px;
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
                <h1 class="page-title">Cash Flow Monitoring</h1>

                <!-- Liquidity Alert -->
                <div class="liquidity-alert alert-warning" id="liquidityAlert">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="alert-content">
                        <h4>Liquidity Warning</h4>
                        <p>Projected cash balance may fall below minimum threshold in 7 days. Consider delaying non-critical disbursements.</p>
                    </div>
                </div>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card" onclick="switchTab('outflow')">
                        <div class="card-icon blue">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3>Today's Outflow</h3>
                        <p>₱425,750</p>
                        <small>Total disbursements today</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('position')">
                        <div class="card-icon green">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <h3>Available Cash</h3>
                        <p>₱2.85M</p>
                        <small>Across all bank accounts</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('forecast')">
                        <div class="card-icon orange">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3>Weekly Forecast</h3>
                        <p>₱1.2M</p>
                        <small>Expected disbursements</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('outflow')">
                        <div class="card-icon red">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>Variance</h3>
                        <p>-₱45,200</p>
                        <small>Actual vs Budget</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="outflow">Daily Outflow</div>
                    <div class="tab" data-tab="position">Cash Position</div>
                    <div class="tab" data-tab="forecast">Disbursement Forecast</div>
                </div>

                <!-- Daily Outflow Tab -->
                <div class="tab-content active" id="outflow-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Today's Disbursements</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                                <button class="btn btn-primary" id="refreshData"><i class="fas fa-sync-alt"></i> Refresh</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="outflowChart"></canvas>
                            </div>
                            
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <input type="date" class="filter-select" id="outflowStartDate" value="2025-09-01">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">&nbsp;</span>
                                    <input type="date" class="filter-select" id="outflowEndDate" value="2025-09-09">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Disbursement Type</span>
                                    <select class="filter-select" id="outflowTypeFilter">
                                        <option value="">All Types</option>
                                        <option value="vendor">Vendor Payments</option>
                                        <option value="payroll">Payroll</option>
                                        <option value="refund">Refunds</option>
                                        <option value="reimbursement">Reimbursements</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Disbursement ID</th>
                                            <th>Type</th>
                                            <th>Payee</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>DIS-2025-001</td>
                                            <td>Vendor Payment</td>
                                            <td>ABC Suppliers</td>
                                            <td>₱125,000.00</td>
                                            <td>Bank Transfer</td>
                                            <td><span class="status status-approved">Completed</span></td>
                                            <td>2025-09-09</td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DIS-2025-002</td>
                                            <td>Payroll</td>
                                            <td>Employee Batch</td>
                                            <td>₱285,500.00</td>
                                            <td>Multiple Methods</td>
                                            <td><span class="status status-approved">Completed</span></td>
                                            <td>2025-09-09</td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DIS-2025-003</td>
                                            <td>Refund</td>
                                            <td>Maria Santos</td>
                                            <td>₱2,500.00</td>
                                            <td>Wallet Credit</td>
                                            <td><span class="status status-pending">Processing</span></td>
                                            <td>2025-09-09</td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DIS-2025-004</td>
                                            <td>Reimbursement</td>
                                            <td>Juan Dela Cruz</td>
                                            <td>₱8,500.00</td>
                                            <td>Bank Transfer</td>
                                            <td><span class="status status-approved">Completed</span></td>
                                            <td>2025-09-09</td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DIS-2025-005</td>
                                            <td>Vendor Payment</td>
                                            <td>XYZ Technologies</td>
                                            <td>₱75,000.00</td>
                                            <td>Bank Transfer</td>
                                            <td><span class="status status-approved">Completed</span></td>
                                            <td>2025-09-09</td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cash Position Tab -->
                <div class="tab-content" id="position-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Cash Position vs Forecast</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Report</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="cashPositionChart"></canvas>
                            </div>
                            
                            <div class="cash-position-cards">
                                <div class="cash-card cash-card-positive">
                                    <div class="cash-card-header">
                                        <div class="cash-card-title">BDO Main Account</div>
                                        <i class="fas fa-university" style="color: #3498db;"></i>
                                    </div>
                                    <div class="cash-card-amount">₱1,850,000</div>
                                    <div class="cash-card-details">
                                        <p>Available Balance: ₱1,850,000</p>
                                        <p>Forecast Balance (7 days): ₱1,250,000</p>
                                        <p>Status: <span style="color: #27ae60;">Healthy</span></p>
                                    </div>
                                </div>
                                
                                <div class="cash-card cash-card-warning">
                                    <div class="cash-card-header">
                                        <div class="cash-card-title">BPI Operations</div>
                                        <i class="fas fa-university" style="color: #d35400;"></i>
                                    </div>
                                    <div class="cash-card-amount">₱750,000</div>
                                    <div class="cash-card-details">
                                        <p>Available Balance: ₱750,000</p>
                                        <p>Forecast Balance (7 days): ₱150,000</p>
                                        <p>Status: <span style="color: #f39c12;">Watch</span></p>
                                    </div>
                                </div>
                                
                                <div class="cash-card cash-card-critical">
                                    <div class="cash-card-header">
                                        <div class="cash-card-title">MetroBank Payroll</div>
                                        <i class="fas fa-university" style="color: #c0392b;"></i>
                                    </div>
                                    <div class="cash-card-amount">₱250,000</div>
                                    <div class="cash-card-details">
                                        <p>Available Balance: ₱250,000</p>
                                        <p>Forecast Balance (3 days): -₱85,000</p>
                                        <p>Status: <span style="color: #e74c3c;">Critical</span></p>
                                    </div>
                                </div>
                            </div>
                            
                            <h3 style="margin: 30px 0 15px; font-family: 'Montserrat', sans-serif;">Budget vs Actual</h3>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Budget</th>
                                            <th>Actual</th>
                                            <th>Variance</th>
                                            <th>Variance %</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Vendor Payments</td>
                                            <td>₱450,000</td>
                                            <td>₱425,000</td>
                                            <td>₱25,000</td>
                                            <td>5.6%</td>
                                            <td><span class="status status-approved">Under Budget</span></td>
                                        </tr>
                                        <tr>
                                            <td>Payroll</td>
                                            <td>₱280,000</td>
                                            <td>₱285,500</td>
                                            <td>-₱5,500</td>
                                            <td>-2.0%</td>
                                            <td><span class="status status-warning">Slightly Over</span></td>
                                        </tr>
                                        <tr>
                                            <td>Refunds</td>
                                            <td>₱15,000</td>
                                            <td>₱12,500</td>
                                            <td>₱2,500</td>
                                            <td>16.7%</td>
                                            <td><span class="status status-approved">Under Budget</span></td>
                                        </tr>
                                        <tr>
                                            <td>Reimbursements</td>
                                            <td>₱20,000</td>
                                            <td>₱18,500</td>
                                            <td>₱1,500</td>
                                            <td>7.5%</td>
                                            <td><span class="status status-approved">Under Budget</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total</strong></td>
                                            <td><strong>₱765,000</strong></td>
                                            <td><strong>₱741,500</strong></td>
                                            <td><strong>₱23,500</strong></td>
                                            <td><strong>3.1%</strong></td>
                                            <td><span class="status status-approved">Under Budget</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Disbursement Forecast Tab -->
                <div class="tab-content" id="forecast-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Disbursement Forecast</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Forecast</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="forecastChart"></canvas>
                            </div>
                            
                            <h3 style="margin: 30px 0 15px; font-family: 'Montserrat', sans-serif;">Upcoming Disbursements</h3>
                            <div class="forecast-timeline">
                                <div class="timeline-item timeline-vendor">
                                    <div class="timeline-date">
                                        <div class="timeline-day">10</div>
                                        <div class="timeline-month">SEP</div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-title">Vendor Payment - Global Equipment</div>
                                        <div class="timeline-amount">₱85,000.00</div>
                                        <div>Due in 1 day</div>
                                    </div>
                                    <div>
                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                
                                <div class="timeline-item timeline-payroll">
                                    <div class="timeline-date">
                                        <div class="timeline-day">15</div>
                                        <div class="timeline-month">SEP</div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-title">Payroll - Mid-Month</div>
                                        <div class="timeline-amount">₱285,000.00</div>
                                        <div>Due in 6 days</div>
                                    </div>
                                    <div>
                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                
                                <div class="timeline-item timeline-vendor">
                                    <div class="timeline-date">
                                        <div class="timeline-day">18</div>
                                        <div class="timeline-month">SEP</div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-title">Vendor Payment - Office Supplies Co.</div>
                                        <div class="timeline-amount">₱45,000.00</div>
                                        <div>Due in 9 days</div>
                                    </div>
                                    <div>
                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                
                                <div class="timeline-item timeline-reimbursement">
                                    <div class="timeline-date">
                                        <div class="timeline-day">20</div>
                                        <div class="timeline-month">SEP</div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-title">Reimbursement Batch</div>
                                        <div class="timeline-amount">₱22,500.00</div>
                                        <div>Due in 11 days</div>
                                    </div>
                                    <div>
                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                
                                <div class="timeline-item timeline-refund">
                                    <div class="timeline-date">
                                        <div class="timeline-day">25</div>
                                        <div class="timeline-month">SEP</div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-title">Refund Batch Processing</div>
                                        <div class="timeline-amount">₱35,000.00</div>
                                        <div>Due in 16 days</div>
                                    </div>
                                    <div>
                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            
                            <h3 style="margin: 30px 0 15px; font-family: 'Montserrat', sans-serif;">Forecast Summary</h3>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Time Period</th>
                                            <th>Vendor Payments</th>
                                            <th>Payroll</th>
                                            <th>Refunds</th>
                                            <th>Reimbursements</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>This Week</td>
                                            <td>₱125,000</td>
                                            <td>₱285,500</td>
                                            <td>₱12,500</td>
                                            <td>₱18,500</td>
                                            <td>₱441,500</td>
                                        </tr>
                                        <tr>
                                            <td>Next Week</td>
                                            <td>₱185,000</td>
                                            <td>₱0</td>
                                            <td>₱15,000</td>
                                            <td>₱22,500</td>
                                            <td>₱222,500</td>
                                        </tr>
                                        <tr>
                                            <td>Following Week</td>
                                            <td>₱95,000</td>
                                            <td>₱285,000</td>
                                            <td>₱20,000</td>
                                            <td>₱15,000</td>
                                            <td>₱415,000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Monthly Total</strong></td>
                                            <td><strong>₱405,000</strong></td>
                                            <td><strong>₱570,500</strong></td>
                                            <td><strong>₱47,500</strong></td>
                                            <td><strong>₱56,000</strong></td>
                                            <td><strong>₱1,079,000</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Cash Flow Monitoring</p>
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
                
                // Update charts when switching tabs
                if (tabId === 'outflow') updateOutflowChart();
                if (tabId === 'position') updateCashPositionChart();
                if (tabId === 'forecast') updateForecastChart();
            });
        });

        // Switch tab function for dashboard cards
        function switchTab(tabName) {
            tabs.forEach(t => t.classList.remove('active'));
            document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
            
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(`${tabName}-tab`).classList.add('active');
            
            // Update charts when switching tabs
            if (tabName === 'outflow') updateOutflowChart();
            if (tabName === 'position') updateCashPositionChart();
            if (tabName === 'forecast') updateForecastChart();
        }

        // Chart variables
        let outflowChart, cashPositionChart, forecastChart;

        // Initialize Outflow Chart
        function initOutflowChart() {
            const ctx = document.getElementById('outflowChart').getContext('2d');
            outflowChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Sep 1', 'Sep 2', 'Sep 3', 'Sep 4', 'Sep 5', 'Sep 6', 'Sep 7', 'Sep 8', 'Today'],
                    datasets: [
                        {
                            label: 'Vendor Payments',
                            data: [120000, 95000, 110000, 135000, 125000, 140000, 115000, 130000, 125000],
                            backgroundColor: 'rgba(52, 152, 219, 0.7)',
                            borderColor: 'rgba(52, 152, 219, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Payroll',
                            data: [280000, 0, 0, 0, 285000, 0, 0, 0, 285500],
                            backgroundColor: 'rgba(155, 89, 182, 0.7)',
                            borderColor: 'rgba(155, 89, 182, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Refunds',
                            data: [8500, 12000, 9500, 11000, 10500, 12500, 9800, 11500, 12500],
                            backgroundColor: 'rgba(231, 76, 60, 0.7)',
                            borderColor: 'rgba(231, 76, 60, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Reimbursements',
                            data: [12500, 9800, 15200, 11800, 13200, 10500, 14200, 12800, 18500],
                            backgroundColor: 'rgba(243, 156, 18, 0.7)',
                            borderColor: 'rgba(243, 156, 18, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₱' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += '₱' + context.parsed.y.toLocaleString();
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }

        // Initialize Cash Position Chart
        function initCashPositionChart() {
            const ctx = document.getElementById('cashPositionChart').getContext('2d');
            cashPositionChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Sep 1', 'Sep 2', 'Sep 3', 'Sep 4', 'Sep 5', 'Sep 6', 'Sep 7', 'Sep 8', 'Today', 'Sep 10', 'Sep 11', 'Sep 12', 'Sep 13', 'Sep 14'],
                    datasets: [
                        {
                            label: 'Actual Cash Balance',
                            data: [2850000, 2720000, 2650000, 2580000, 2450000, 2400000, 2350000, 2300000, 2850000, null, null, null, null, null],
                            borderColor: 'rgba(46, 204, 113, 1)',
                            backgroundColor: 'rgba(46, 204, 113, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: 'Forecasted Balance',
                            data: [2850000, 2720000, 2650000, 2580000, 2450000, 2400000, 2350000, 2300000, 2850000, 2650000, 2500000, 2350000, 2200000, 2050000],
                            borderColor: 'rgba(52, 152, 219, 1)',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            fill: false,
                            tension: 0.4
                        },
                        {
                            label: 'Minimum Threshold',
                            data: [2000000, 2000000, 2000000, 2000000, 2000000, 2000000, 2000000, 2000000, 2000000, 2000000, 2000000, 2000000, 2000000, 2000000],
                            borderColor: 'rgba(231, 76, 60, 1)',
                            borderWidth: 1,
                            borderDash: [3, 3],
                            fill: false,
                            pointRadius: 0
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: false,
                            ticks: {
                                callback: function(value) {
                                    return '₱' + (value/1000).toFixed(0) + 'K';
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += '₱' + context.parsed.y.toLocaleString();
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }

        // Initialize Forecast Chart
        function initForecastChart() {
            const ctx = document.getElementById('forecastChart').getContext('2d');
            forecastChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['This Week', 'Next Week', 'Following Week', 'Week 4'],
                    datasets: [
                        {
                            label: 'Vendor Payments',
                            data: [125000, 185000, 95000, 120000],
                            backgroundColor: 'rgba(52, 152, 219, 0.7)',
                            borderColor: 'rgba(52, 152, 219, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Payroll',
                            data: [285500, 0, 285000, 0],
                            backgroundColor: 'rgba(155, 89, 182, 0.7)',
                            borderColor: 'rgba(155, 89, 182, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Refunds',
                            data: [12500, 15000, 20000, 18000],
                            backgroundColor: 'rgba(231, 76, 60, 0.7)',
                            borderColor: 'rgba(231, 76, 60, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Reimbursements',
                            data: [18500, 22500, 15000, 20000],
                            backgroundColor: 'rgba(243, 156, 18, 0.7)',
                            borderColor: 'rgba(243, 156, 18, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₱' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += '₱' + context.parsed.y.toLocaleString();
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }

        // Update charts with new data (simulated real-time updates)
        function updateOutflowChart() {
            // In a real application, this would fetch new data from an API
            console.log('Updating outflow chart data...');
        }

        function updateCashPositionChart() {
            // In a real application, this would fetch new data from an API
            console.log('Updating cash position chart data...');
        }

        function updateForecastChart() {
            // In a real application, this would fetch new data from an API
            console.log('Updating forecast chart data...');
        }

        // Refresh data button
        document.getElementById('refreshData').addEventListener('click', function() {
            // Simulate data refresh
            this.querySelector('i').classList.add('fa-spin');
            setTimeout(() => {
                this.querySelector('i').classList.remove('fa-spin');
                alert('Data refreshed successfully!');
                
                // Update all charts
                updateOutflowChart();
                updateCashPositionChart();
                updateForecastChart();
            }, 1000);
        });

        // Initialize all charts when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initOutflowChart();
            initCashPositionChart();
            initForecastChart();
        });

        // Simulate real-time updates every 30 seconds
        setInterval(function() {
            // In a real application, this would check for new data
            console.log('Checking for real-time updates...');
        }, 30000);

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

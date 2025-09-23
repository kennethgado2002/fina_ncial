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
            --under-budget: #2ecc71;
            --over-budget: #e74c3c;
            --minor-variance: #f39c12;
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

        .status-under {
            background-color: var(--under-budget);
            color: white;
        }

        .status-over {
            background-color: var(--over-budget);
            color: white;
        }

        .status-minor {
            background-color: var(--minor-variance);
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

        .btn-escalate {
            background-color: #6c5ce7;
            color: white;
        }

        .btn-escalate:hover {
            background-color: #5649c0;
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

        /* Variance Table */
        .variance-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .variance-table th, .variance-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #eee;
        }

        .variance-table th {
            background-color: #f8f9fa;
            font-family: 'Montserrat', sans-serif;
        }

        .variance-positive {
            background-color: rgba(46, 204, 113, 0.1);
            color: #27ae60;
            font-weight: 600;
        }

        .variance-negative {
            background-color: rgba(231, 76, 60, 0.1);
            color: #c0392b;
            font-weight: 600;
        }

        .variance-neutral {
            background-color: rgba(243, 156, 18, 0.1);
            color: #d35400;
            font-weight: 600;
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px;
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
        .tolerance-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
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

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-col {
            flex: 1;
        }

        /* Alert Cards */
        .alert-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            border-left: 5px solid var(--over-budget);
            transition: var(--transition);
        }

        .alert-card:hover {
            transform: translateX(5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .alert-card.warning {
            border-left-color: var(--warning);
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--over-budget);
        }

        .alert-card.warning .alert-icon {
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--warning);
        }

        .alert-content {
            flex: 1;
        }

        .alert-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .alert-desc {
            font-size: 0.9rem;
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
                <h1 class="page-title">Variance Analysis</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3>Total Budget</h3>
                        <p>₱2.5M</p>
                        <small>This quarter</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Within Budget</h3>
                        <p>72%</p>
                        <small>Of cost centers</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>Minor Variances</h3>
                        <p>18%</p>
                        <small>Of cost centers</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>Over Budget</h3>
                        <p>10%</p>
                        <small>Of cost centers</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="overview">Overview</div>
                    <div class="tab" data-tab="detailed">Detailed Analysis</div>
                    <div class="tab" data-tab="thresholds">Threshold Settings</div>
                </div>

                <!-- Overview Tab -->
                <div class="tab-content active" id="overview-tab">
                    <!-- Budget vs Actual Chart -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Budget vs Actual Performance</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Period</span>
                                    <select class="filter-select" id="periodFilter">
                                        <option value="q3">Q3 2025</option>
                                        <option value="q2">Q2 2025</option>
                                        <option value="q1">Q1 2025</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Department</span>
                                    <select class="filter-select" id="deptFilter">
                                        <option value="">All Departments</option>
                                        <option value="marketing">Marketing</option>
                                        <option value="sales">Sales</option>
                                        <option value="operations">Operations</option>
                                        <option value="hr">Human Resources</option>
                                        <option value="it">IT</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Cost Type</span>
                                    <select class="filter-select" id="costFilter">
                                        <option value="">All Costs</option>
                                        <option value="payroll">Payroll</option>
                                        <option value="vendor">Vendor Payments</option>
                                        <option value="reimbursement">Reimbursements</option>
                                        <option value="other">Other Expenses</option>
                                    </select>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="budgetVsActualChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Variance Alerts -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Variance Alerts</h2>
                        </div>
                        <div class="card-body">
                            <div class="alert-card">
                                <div class="alert-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="alert-content">
                                    <h3 class="alert-title">Marketing Campaign Budget Exceeded</h3>
                                    <p class="alert-desc">Q3 Marketing campaign spend is 23% over budget (₱125,000 overage)</p>
                                </div>
                                <button class="btn btn-view">View Details</button>
                            </div>
                            <div class="alert-card warning">
                                <div class="alert-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="alert-content">
                                    <h3 class="alert-title">IT Department Approaching Budget Limit</h3>
                                    <p class="alert-desc">IT infrastructure spend is at 92% of allocated budget with 4 weeks remaining</p>
                                </div>
                                <button class="btn btn-view">View Details</button>
                            </div>
                            <div class="alert-card">
                                <div class="alert-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="alert-content">
                                    <h3 class="alert-title">Vendor Payment Variance Detected</h3>
                                    <p class="alert-desc">Tech Solutions Inc. invoice is 18% higher than PO amount</p>
                                </div>
                                <button class="btn btn-view">View Details</button>
                            </div>
                        </div>
                    </div>

                    <!-- Top Variances Table -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Significant Variances</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="varianceSearch" placeholder="Search Department, Cost Center, or Vendor...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Department</th>
                                            <th>Cost Center</th>
                                            <th>Budget</th>
                                            <th>Actual</th>
                                            <th>Variance</th>
                                            <th>Variance %</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Marketing</td>
                                            <td>Q3 Campaign</td>
                                            <td>₱550,000.00</td>
                                            <td>₱675,000.00</td>
                                            <td class="variance-negative">-₱125,000.00</td>
                                            <td class="variance-negative">-22.7%</td>
                                            <td><span class="status status-over">Over Budget</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('detailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>IT</td>
                                            <td>Infrastructure</td>
                                            <td>₱325,000.00</td>
                                            <td>₱300,150.00</td>
                                            <td class="variance-positive">+₱24,850.00</td>
                                            <td class="variance-positive">+7.6%</td>
                                            <td><span class="status status-under">Under Budget</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('detailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Operations</td>
                                            <td>Logistics</td>
                                            <td>₱420,000.00</td>
                                            <td>₱435,200.00</td>
                                            <td class="variance-negative">-₱15,200.00</td>
                                            <td class="variance-negative">-3.6%</td>
                                            <td><span class="status status-minor">Minor Variance</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('detailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales</td>
                                            <td>Commissions</td>
                                            <td>₱275,000.00</td>
                                            <td>₱310,500.00</td>
                                            <td class="variance-negative">-₱35,500.00</td>
                                            <td class="variance-negative">-12.9%</td>
                                            <td><span class="status status-over">Over Budget</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('detailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>HR</td>
                                            <td>Training & Development</td>
                                            <td>₱180,000.00</td>
                                            <td>₱165,400.00</td>
                                            <td class="variance-positive">+₱14,600.00</td>
                                            <td class="variance-positive">+8.1%</td>
                                            <td><span class="status status-under">Under Budget</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('detailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Analysis Tab -->
                <div class="tab-content" id="detailed-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Drill-Down Analysis</h2>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Department</span>
                                    <select class="filter-select" id="detailDeptFilter">
                                        <option value="">All Departments</option>
                                        <option value="marketing">Marketing</option>
                                        <option value="sales">Sales</option>
                                        <option value="operations">Operations</option>
                                        <option value="hr">Human Resources</option>
                                        <option value="it">IT</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Vendor</span>
                                    <select class="filter-select" id="vendorFilter">
                                        <option value="">All Vendors</option>
                                        <option value="abc">ABC Suppliers</option>
                                        <option value="xyz">XYZ Technologies</option>
                                        <option value="global">Global Equipment</option>
                                        <option value="office">Office Supplies Co.</option>
                                        <option value="tech">Tech Solutions Inc.</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Variance Status</span>
                                    <select class="filter-select" id="statusFilter">
                                        <option value="">All Status</option>
                                        <option value="over">Over Budget</option>
                                        <option value="under">Under Budget</option>
                                        <option value="minor">Minor Variance</option>
                                    </select>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="departmentVarianceChart"></canvas>
                            </div>
                            <div class="table-responsive">
                                <table class="variance-table">
                                    <thead>
                                        <tr>
                                            <th>Cost Center</th>
                                            <th>Vendor/Campaign</th>
                                            <th>Budget</th>
                                            <th>Actual</th>
                                            <th>Variance</th>
                                            <th>Variance %</th>
                                            <th>Last Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Marketing > Q3 Campaign</td>
                                            <td>Digital Ads - Facebook</td>
                                            <td>₱150,000.00</td>
                                            <td>₱185,000.00</td>
                                            <td class="variance-negative">-₱35,000.00</td>
                                            <td class="variance-negative">-23.3%</td>
                                            <td>2025-09-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('detailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Marketing > Q3 Campaign</td>
                                            <td>Google Ads</td>
                                            <td>₱200,000.00</td>
                                            <td>₱245,000.00</td>
                                            <td class="variance-negative">-₱45,000.00</td>
                                            <td class="variance-negative">-22.5%</td>
                                            <td>2025-09-03</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('detailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>IT > Infrastructure</td>
                                            <td>Tech Solutions Inc.</td>
                                            <td>₱125,000.00</td>
                                            <td>₱110,500.00</td>
                                            <td class="variance-positive">+₱14,500.00</td>
                                            <td class="variance-positive">+11.6%</td>
                                            <td>2025-09-01</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('detailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Operations > Logistics</td>
                                            <td>Global Equipment</td>
                                            <td>₱220,000.00</td>
                                            <td>₱235,000.00</td>
                                            <td class="variance-negative">-₱15,000.00</td>
                                            <td class="variance-negative">-6.8%</td>
                                            <td>2025-09-02</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('detailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales > Commissions</td>
                                            <td>Sales Team Incentives</td>
                                            <td>₱275,000.00</td>
                                            <td>₱310,500.00</td>
                                            <td class="variance-negative">-₱35,500.00</td>
                                            <td class="variance-negative">-12.9%</td>
                                            <td>2025-09-06</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('detailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Threshold Settings Tab -->
                <div class="tab-content" id="thresholds-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Variance Threshold Settings</h2>
                        </div>
                        <div class="card-body">
                            <div class="tolerance-form">
                                <div class="form-group">
                                    <label class="form-label">General Variance Tolerance (%)</label>
                                    <input type="number" class="form-control" value="5" step="0.1" min="0" max="100">
                                    <small>Allowable percentage variance before alert is triggered</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Critical Variance Threshold (%)</label>
                                    <input type="number" class="form-control" value="15" step="0.1" min="0" max="100">
                                    <small>Variance percentage that requires immediate attention</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Payroll Variance Tolerance (%)</label>
                                    <input type="number" class="form-control" value="3" step="0.1" min="0" max="100">
                                    <small>Allowable variance for payroll expenses</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Vendor Payment Tolerance (%)</label>
                                    <input type="number" class="form-control" value="7" step="0.1" min="0" max="100">
                                    <small>Allowable variance for vendor payments</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Marketing Campaign Tolerance (%)</label>
                                    <input type="number" class="form-control" value="10" step="0.1" min="0" max="100">
                                    <small>Allowable variance for marketing campaigns</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Auto-generate Reports</label>
                                    <select class="form-control">
                                        <option value="daily">Daily</option>
                                        <option value="weekly" selected>Weekly</option>
                                        <option value="monthly">Monthly</option>
                                    </select>
                                    <small>Frequency for automatic variance reports</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Alert Recipients</label>
                                <textarea class="form-control" rows="3" placeholder="Enter email addresses separated by commas">finance@company.com, operations@company.com</textarea>
                                <small>Who should receive variance alerts</small>
                            </div>
                            <div style="margin-top: 20px; text-align: right;">
                                <button class="btn btn-secondary">Reset to Defaults</button>
                                <button class="btn btn-primary">Save Settings</button>
                            </div>
                        </div>
                    </div>

                    <!-- Corrective Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Corrective Actions</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Budget Reallocation Rules</label>
                                <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                    <p><strong>Current Rules:</strong></p>
                                    <ul>
                                        <li>Allow reallocation from under-budget departments to over-budget departments with CFO approval</li>
                                        <li>Maximum 15% of original department budget can be reallocated</li>
                                        <li>Marketing campaign budgets cannot be reallocated to other departments</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Cost Cutting Initiatives</label>
                                <select class="form-control" multiple style="height: 120px;">
                                    <option selected>Freeze non-essential hiring</option>
                                    <option selected>Reduce discretionary spending</option>
                                    <option>Delay non-critical projects</option>
                                    <option>Renegotiate vendor contracts</option>
                                    <option>Optimize cloud infrastructure costs</option>
                                </select>
                                <small>Initiatives to activate when overall variance exceeds 5%</small>
                            </div>
                            <div style="margin-top: 20px; text-align: right;">
                                <button class="btn btn-primary">Update Corrective Actions</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Variance Analysis</p>
            </div>
        </div>
    </div>

    <!-- Variance Details Modal -->
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Variance Analysis Details</h2>
                <span class="close" onclick="closeModal('detailsModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Department</label>
                            <p>Marketing</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Cost Center</label>
                            <p>Q3 Campaign</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Budget</label>
                            <p>₱550,000.00</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Actual Spend</label>
                            <p>₱675,000.00</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Variance</label>
                            <p class="variance-negative">-₱125,000.00</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Variance Percentage</label>
                            <p class="variance-negative">-22.7%</p>
                        </div>
                    </div>
                </div>

                <h3 class="form-label">Spend Breakdown</h3>
                <div class="chart-container">
                    <canvas id="breakdownChart"></canvas>
                </div>

                <div class="table-responsive">
                    <table class="variance-table">
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
                                <td>Digital Advertising</td>
                                <td>₱350,000.00</td>
                                <td>₱430,000.00</td>
                                <td class="variance-negative">-₱80,000.00</td>
                                <td class="variance-negative">-22.9%</td>
                                <td><span class="status status-over">Over Budget</span></td>
                            </tr>
                            <tr>
                                <td>Content Production</td>
                                <td>₱120,000.00</td>
                                <td>₱165,000.00</td>
                                <td class="variance-negative">-₱45,000.00</td>
                                <td class="variance-negative">-37.5%</td>
                                <td><span class="status status-over">Over Budget</span></td>
                            </tr>
                            <tr>
                                <td>Events & Sponsorships</td>
                                <td>₱80,000.00</td>
                                <td>₱80,000.00</td>
                                <td class="variance-neutral">₱0.00</td>
                                <td class="variance-neutral">0.0%</td>
                                <td><span class="status status-under">On Budget</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label class="form-label">Root Cause Analysis</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>Primary Factors:</strong></p>
                        <ul>
                            <li>Higher-than-expected CPM rates on social media platforms</li>
                            <li>Additional content production needed for successful A/B tests</li>
                            <li>Extended campaign duration due to competitive market activity</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Recommended Actions</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>Immediate Actions:</strong></p>
                        <ul>
                            <li>Reallocate ₱50,000 from underutilized travel budget</li>
                            <li>Optimize ad targeting to reduce CPM by 15%</li>
                            <li>Delay Q4 campaign planning by two weeks to offset budget overage</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('detailsModal')">Close</button>
                <button type="button" class="btn btn-primary">Create Corrective Action Plan</button>
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
        document.getElementById('varianceSearch').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('#overview-tab tbody tr');
            
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

        // Filter functionality for detailed analysis
        const filters = document.querySelectorAll('.filter-select');
        filters.forEach(filter => {
            filter.addEventListener('change', filterDetailedAnalysis);
        });

        function filterDetailedAnalysis() {
            const deptFilter = document.getElementById('detailDeptFilter').value;
            const vendorFilter = document.getElementById('vendorFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            
            const rows = document.querySelectorAll('#detailed-tab tbody tr');
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const department = cells[0].textContent.toLowerCase();
                const vendor = cells[1].textContent.toLowerCase();
                const status = cells[7].querySelector('.status').textContent.toLowerCase();
                
                let showRow = true;
                
                // Check department filter
                if (deptFilter && !department.includes(deptFilter)) {
                    showRow = false;
                }
                
                // Check vendor filter
                if (vendorFilter && !vendor.includes(vendorFilter)) {
                    showRow = false;
                }
                
                // Check status filter
                if (statusFilter && !status.includes(statusFilter)) {
                    showRow = false;
                }
                
                row.style.display = showRow ? '' : 'none';
            });
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

        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // Budget vs Actual Chart
            const budgetVsActualCtx = document.getElementById('budgetVsActualChart').getContext('2d');
            new Chart(budgetVsActualCtx, {
                type: 'bar',
                data: {
                    labels: ['Marketing', 'IT', 'Operations', 'Sales', 'HR'],
                    datasets: [
                        {
                            label: 'Budget',
                            data: [550, 325, 420, 275, 180],
                            backgroundColor: 'rgba(52, 152, 219, 0.5)',
                            borderColor: 'rgba(52, 152, 219, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Actual',
                            data: [675, 300, 435, 310, 165],
                            backgroundColor: 'rgba(46, 204, 113, 0.5)',
                            borderColor: 'rgba(46, 204, 113, 1)',
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
                            title: {
                                display: true,
                                text: 'Amount (₱ thousands)'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Budget vs Actual by Department (Q3 2025)'
                        }
                    }
                }
            });

            // Department Variance Chart
            const departmentVarianceCtx = document.getElementById('departmentVarianceChart').getContext('2d');
            new Chart(departmentVarianceCtx, {
                type: 'bar',
                data: {
                    labels: ['Marketing', 'IT', 'Operations', 'Sales', 'HR'],
                    datasets: [{
                        label: 'Variance Percentage',
                        data: [-22.7, 7.6, -3.6, -12.9, 8.1],
                        backgroundColor: function(context) {
                            const value = context.dataset.data[context.dataIndex];
                            if (value < -5) return 'rgba(231, 76, 60, 0.7)';
                            if (value > 5) return 'rgba(46, 204, 113, 0.7)';
                            return 'rgba(243, 156, 18, 0.7)';
                        },
                        borderColor: function(context) {
                            const value = context.dataset.data[context.dataIndex];
                            if (value < -5) return 'rgba(231, 76, 60, 1)';
                            if (value > 5) return 'rgba(46, 204, 113, 1)';
                            return 'rgba(243, 156, 18, 1)';
                        },
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: 'Variance (%)'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Budget Variance by Department (%)'
                        }
                    }
                }
            });

            // Breakdown Chart for Modal
            const breakdownCtx = document.getElementById('breakdownChart').getContext('2d');
            new Chart(breakdownCtx, {
                type: 'pie',
                data: {
                    labels: ['Digital Advertising', 'Content Production', 'Events & Sponsorships'],
                    datasets: [{
                        data: [430, 165, 80],
                        backgroundColor: [
                            'rgba(52, 152, 219, 0.7)',
                            'rgba(155, 89, 182, 0.7)',
                            'rgba(46, 204, 113, 0.7)'
                        ],
                        borderColor: [
                            'rgba(52, 152, 219, 1)',
                            'rgba(155, 89, 182, 1)',
                            'rgba(46, 204, 113, 1)'
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
                            text: 'Marketing Q3 Campaign Spend Breakdown'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>

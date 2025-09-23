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
            --approved: #2ecc71;
            --rejected: #e74c3c;
            --draft: #95a5a6;
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
            background-color: var(--pending);
            color: white;
        }

        .status-approved {
            background-color: var(--approved);
            color: white;
        }

        .status-rejected {
            background-color: var(--rejected);
            color: white;
        }

        .status-draft {
            background-color: var(--draft);
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

        /* Budget Allocation Dashboard */
        .allocation-charts {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .allocation-chart {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .chart-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            color: var(--dark);
        }

        .chart-container {
            height: 200px;
            position: relative;
        }

        /* Progress bars */
        .progress-container {
            margin-bottom: 15px;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
        }

        .progress-bar {
            height: 10px;
            background-color: #ecf0f1;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 5px;
            transition: width 0.5s ease;
        }

        .progress-fill.allocated {
            background-color: var(--success);
        }

        .progress-fill.unallocated {
            background-color: var(--warning);
        }

        /* Scenario Planning */
        .scenario-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .scenario-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .scenario-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .scenario-card.active {
            border: 2px solid var(--secondary);
        }

        .scenario-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .scenario-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            color: var(--dark);
        }

        .scenario-details {
            margin-top: 15px;
        }

        .scenario-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        /* Approval Workflow */
        .approval-steps {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        .approval-step {
            display: flex;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            background: var(--secondary);
            color: white;
        }

        .step-details {
            flex: 1;
        }

        .step-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .step-status {
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .step-date {
            font-size: 0.85rem;
            color: #7f8c8d;
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
            margin: 5% auto;
            padding: 0;
            border-radius: 10px;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            animation: modalFade 0.3s;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
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
            
            .allocation-charts, .scenario-cards {
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
                <h1 class="page-title">Budget Planning</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3>Total Budget</h3>
                        <p>₱12.5M</p>
                        <small>Fiscal Year 2025</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Allocated</h3>
                        <p>₱9.2M</p>
                        <small>74% of total budget</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Pending Approval</h3>
                        <p>₱1.8M</p>
                        <small>3 budgets awaiting review</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon purple">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <h3>Active Projects</h3>
                        <p>12</p>
                        <small>With allocated budgets</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="budget-entry">Budget Entry</div>
                    <div class="tab" data-tab="allocation-dashboard">Allocation Dashboard</div>
                    <div class="tab" data-tab="scenario-planning">Scenario Planning</div>
                    <div class="tab" data-tab="approval-workflow">Approval Workflow</div>
                </div>

                <!-- Budget Entry Tab -->
                <div class="tab-content active" id="budget-entry-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Create New Budget</h2>
                        </div>
                        <div class="card-body">
                            <form id="budgetForm">
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Department</label>
                                            <select class="form-control" id="department">
                                                <option value="">Select Department</option>
                                                <option value="finance">Finance</option>
                                                <option value="hr">Human Resources</option>
                                                <option value="it">Information Technology</option>
                                                <option value="marketing">Marketing</option>
                                                <option value="operations">Operations</option>
                                                <option value="sales">Sales</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Expense Type</label>
                                            <select class="form-control" id="expenseType">
                                                <option value="">Select Expense Type</option>
                                                <option value="revenues">Revenues</option>
                                                <option value="payroll">Payroll</option>
                                                <option value="reimbursement">Reimbursement</option>
                                                <option value="procurement">Procurement</option>
                                                <option value="projects">Projects</option>
                                                <option value="operations">Operations</option>
                                                <option value="marketing">Marketing</option>
                                                <option value="rd">Research & Development</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Period</label>
                                            <select class="form-control" id="period">
                                                <option value="">Select Period</option>
                                                <option value="annual">Annual (2025)</option>
                                                <option value="q1">Q1 (Jan - Mar 2025)</option>
                                                <option value="q2">Q2 (Apr - Jun 2025)</option>
                                                <option value="q3">Q3 (Jul - Sep 2025)</option>
                                                <option value="q4">Q4 (Oct - Dec 2025)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Amount (₱)</label>
                                            <input type="number" class="form-control" id="amount" placeholder="Enter amount">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Notes</label>
                                    <textarea class="form-control" id="notes" rows="3" placeholder="Add budget details and justification"></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Allocation Breakdown</label>
                                    <div class="table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Amount (₱)</th>
                                                    <th>Percentage</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="allocationTable">
                                                <tr>
                                                    <td>Vendor Payments (AP)</td>
                                                    <td><input type="number" class="form-control" placeholder="0.00"></td>
                                                    <td>0%</td>
                                                    <td><button type="button" class="btn btn-view btn-sm">Auto Calculate</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Payroll</td>
                                                    <td><input type="number" class="form-control" placeholder="0.00"></td>
                                                    <td>0%</td>
                                                    <td><button type="button" class="btn btn-view btn-sm">Auto Calculate</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Sales Targets (AR)</td>
                                                    <td><input type="number" class="form-control" placeholder="0.00"></td>
                                                    <td>0%</td>
                                                    <td><button type="button" class="btn btn-view btn-sm">Auto Calculate</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Disbursements</td>
                                                    <td><input type="number" class="form-control" placeholder="0.00"></td>
                                                    <td>0%</td>
                                                    <td><button type="button" class="btn btn-view btn-sm">Auto Calculate</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Collections</td>
                                                    <td><input type="number" class="form-control" placeholder="0.00"></td>
                                                    <td>0%</td>
                                                    <td><button type="button" class="btn btn-view btn-sm">Auto Calculate</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-col" style="display: flex; gap: 10px; justify-content: flex-end;">
                                        <button type="button" class="btn btn-secondary">Save as Draft</button>
                                        <button type="button" class="btn btn-primary">Submit for Approval</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Recent Budgets</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search budgets by department, type, or period...">
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Department</th>
                                            <th>Expense Type</th>
                                            <th>Period</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Marketing</td>
                                            <td>Projects</td>
                                            <td>Q3 2025</td>
                                            <td>₱850,000.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Information Technology</td>
                                            <td>Procurement</td>
                                            <td>Annual 2025</td>
                                            <td>₱2,500,000.00</td>
                                            <td><span class="status status-approved">Approved</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Operations</td>
                                            <td>Reimbursement</td>
                                            <td>Q2 2025</td>
                                            <td>₱350,000.00</td>
                                            <td><span class="status status-rejected">Rejected</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Human Resources</td>
                                            <td>Payroll</td>
                                            <td>Q4 2025</td>
                                            <td>₱1,200,000.00</td>
                                            <td><span class="status status-draft">Draft</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-primary btn-sm">Submit</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Allocation Dashboard Tab -->
                <div class="tab-content" id="allocation-dashboard-tab">
                    <div class="allocation-charts">
                        <div class="allocation-chart">
                            <div class="chart-header">
                                <h3 class="chart-title">Department Budget Allocation</h3>
                                <select class="form-control" style="width: auto;">
                                    <option>2025 Annual</option>
                                    <option>Q1 2025</option>
                                    <option>Q2 2025</option>
                                    <option>Q3 2025</option>
                                    <option>Q4 2025</option>
                                </select>
                            </div>
                            <div class="chart-container" id="departmentChart">
                                                <div class="progress-container">
                                                    <div class="progress-label">
                                                        <span>Finance</span>
                                                        <span>₱1.2M / ₱1.5M</span>
                                                    </div>
                                                    <div class="progress-bar">
                                                        <div class="progress-fill allocated" style="width: 80%;"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-container">
                                                    <div class="progress-label">
                                                        <span>Human Resources</span>
                                                        <span>₱2.1M / ₱2.5M</span>
                                                    </div>
                                                    <div class="progress-bar">
                                                        <div class="progress-fill allocated" style="width: 84%;"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-container">
                                                    <div class="progress-label">
                                                        <span>Information Technology</span>
                                                        <span>₱2.5M / ₱3.0M</span>
                                                    </div>
                                                    <div class="progress-bar">
                                                        <div class="progress-fill allocated" style="width: 83%;"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-container">
                                                    <div class="progress-label">
                                                        <span>Marketing</span>
                                                        <span>₱1.8M / ₱2.2M</span>
                                                    </div>
                                                    <div class="progress-bar">
                                                        <div class="progress-fill allocated" style="width: 82%;"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-container">
                                                    <div class="progress-label">
                                                        <span>Operations</span>
                                                        <span>₱1.6M / ₱2.0M</span>
                                                    </div>
                                                    <div class="progress-bar">
                                                        <div class="progress-fill allocated" style="width: 80%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                        </div>
                        <div class="allocation-chart">
                            <div class="chart-header">
                                <h3 class="chart-title">Expense Type Allocation</h3>
                                <select class="form-control" style="width: auto;">
                                    <option>2025 Annual</option>
                                    <option>Q1 2025</option>
                                    <option>Q2 2025</option>
                                    <option>Q3 2025</option>
                                    <option>Q4 2025</option>
                                </select>
                            </div>
                            <div class="chart-container" id="expenseChart">
                                                <div class="progress-container">
                                                    <div class="progress-label">
                                                        <span>Payroll</span>
                                                        <span>₱4.2M / ₱5.0M</span>
                                                    </div>
                                                    <div class="progress-bar">
                                                        <div class="progress-fill allocated" style="width: 84%;"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-container">
                                                    <div class="progress-label">
                                                        <span>Procurement</span>
                                                        <span>₱2.5M / ₱3.0M</span>
                                                    </div>
                                                    <div class="progress-bar">
                                                        <div class="progress-fill allocated" style="width: 83%;"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-container">
                                                    <div class="progress-label">
                                                        <span>Projects</span>
                                                        <span>₱1.8M / ₱2.5M</span>
                                                    </div>
                                                    <div class="progress-bar">
                                                        <div class="progress-fill allocated" style="width: 72%;"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-container">
                                                    <div class="progress-label">
                                                        <span>Operations</span>
                                                        <span>₱1.2M / ₱1.5M</span>
                                                    </div>
                                                    <div class="progress-bar">
                                                        <div class="progress-fill allocated" style="width: 80%;"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-container">
                                                    <div class="progress-label">
                                                        <span>Reimbursement</span>
                                                        <span>₱0.5M / ₱0.8M</span>
                                                    </div>
                                                    <div class="progress-bar">
                                                        <div class="progress-fill allocated" style="width: 63%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Budget Allocation Summary</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search allocations...">
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Department</th>
                                            <th>Expense Type</th>
                                            <th>Period</th>
                                            <th>Allocated</th>
                                            <th>Spent</th>
                                            <th>Remaining</th>
                                            <th>Utilization</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Finance</td>
                                            <td>Operations</td>
                                            <td>Q3 2025</td>
                                            <td>₱350,000.00</td>
                                            <td>₱210,000.00</td>
                                            <td>₱140,000.00</td>
                                            <td>
                                                <div class="progress-bar">
                                                    <div class="progress-fill allocated" style="width: 60%;"></div>
                                                </div>
                                                <small>60%</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Human Resources</td>
                                            <td>Payroll</td>
                                            <td>Q3 2025</td>
                                            <td>₱1,200,000.00</td>
                                            <td>₱1,050,000.00</td>
                                            <td>₱150,000.00</td>
                                            <td>
                                                <div class="progress-bar">
                                                    <div class="progress-fill allocated" style="width: 88%;"></div>
                                                </div>
                                                <small>88%</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Information Technology</td>
                                            <td>Procurement</td>
                                            <td>Q3 2025</td>
                                            <td>₱800,000.00</td>
                                            <td>₱520,000.00</td>
                                            <td>₱280,000.00</td>
                                            <td>
                                                <div class="progress-bar">
                                                    <div class="progress-fill allocated" style="width: 65%;"></div>
                                                </div>
                                                <small>65%</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Marketing</td>
                                            <td>Projects</td>
                                            <td>Q3 2025</td>
                                            <td>₱850,000.00</td>
                                            <td>₱340,000.00</td>
                                            <td>₱510,000.00</td>
                                            <td>
                                                <div class="progress-bar">
                                                    <div class="progress-fill allocated" style="width: 40%;"></div>
                                                </div>
                                                <small>40%</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Operations</td>
                                            <td>Reimbursement</td>
                                            <td>Q3 2025</td>
                                            <td>₱250,000.00</td>
                                            <td>₱180,000.00</td>
                                            <td>₱70,000.00</td>
                                            <td>
                                                <div class="progress-bar">
                                                    <div class="progress-fill allocated" style="width: 72%;"></div>
                                                </div>
                                                <small>72%</small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Scenario Planning Tab -->
                <div class="tab-content" id="scenario-planning-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Budget Scenarios</h2>
                            <div>
                                <button class="btn btn-primary"><i class="fas fa-plus"></i> Create New Scenario</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="scenario-cards">
                                <div class="scenario-card active">
                                    <div class="scenario-header">
                                        <h3 class="scenario-title">Base Scenario</h3>
                                        <span class="status status-approved">Active</span>
                                    </div>
                                    <p>Current approved budget with expected revenue and expense projections.</p>
                                    <div class="scenario-details">
                                        <div class="scenario-detail">
                                            <span>Total Budget:</span>
                                            <span>₱12.5M</span>
                                        </div>
                                        <div class="scenario-detail">
                                            <span>Projected Revenue:</span>
                                            <span>₱15.2M</span>
                                        </div>
                                        <div class="scenario-detail">
                                            <span>Projected Profit:</span>
                                            <span>₱2.7M</span>
                                        </div>
                                        <div class="scenario-detail">
                                            <span>Last Updated:</span>
                                            <span>Sept 12, 2025</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="scenario-card">
                                    <div class="scenario-header">
                                        <h3 class="scenario-title">Optimistic Scenario</h3>
                                        <span class="status status-pending">Draft</span>
                                    </div>
                                    <p>Increased marketing budget with higher revenue projections.</p>
                                    <div class="scenario-details">
                                        <div class="scenario-detail">
                                            <span>Total Budget:</span>
                                            <span>₱13.8M</span>
                                        </div>
                                        <div class="scenario-detail">
                                            <span>Projected Revenue:</span>
                                            <span>₱18.5M</span>
                                        </div>
                                        <div class="scenario-detail">
                                            <span>Projected Profit:</span>
                                            <span>₱4.7M</span>
                                        </div>
                                        <div class="scenario-detail">
                                            <span>Last Updated:</span>
                                            <span>Sept 5, 2025</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="scenario-card">
                                    <div class="scenario-header">
                                        <h3 class="scenario-title">Conservative Scenario</h3>
                                        <span class="status status-pending">Draft</span>
                                    </div>
                                    <p>Reduced expenses with conservative revenue estimates.</p>
                                    <div class="scenario-details">
                                        <div class="scenario-detail">
                                            <span>Total Budget:</span>
                                            <span>₱10.2M</span>
                                        </div>
                                        <div class="scenario-detail">
                                            <span>Projected Revenue:</span>
                                            <span>₱13.1M</span>
                                        </div>
                                        <div class="scenario-detail">
                                            <span>Projected Profit:</span>
                                            <span>₱2.9M</span>
                                        </div>
                                        <div class="scenario-detail">
                                            <span>Last Updated:</span>
                                            <span>Aug 28, 2025</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card" style="margin-top: 30px;">
                                <div class="card-header">
                                    <h2 class="card-title">Scenario Comparison</h2>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Metric</th>
                                                    <th>Base Scenario</th>
                                                    <th>Optimistic Scenario</th>
                                                    <th>Conservative Scenario</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Total Budget</td>
                                                    <td>₱12.5M</td>
                                                    <td>₱13.8M</td>
                                                    <td>₱10.2M</td>
                                                </tr>
                                                <tr>
                                                    <td>Payroll Allocation</td>
                                                    <td>₱5.0M</td>
                                                    <td>₱5.5M</td>
                                                    <td>₱4.5M</td>
                                                </tr>
                                                <tr>
                                                    <td>Procurement Allocation</td>
                                                    <td>₱3.0M</td>
                                                    <td>₱3.5M</td>
                                                    <td>₱2.2M</td>
                                                </tr>
                                                <tr>
                                                    <td>Projects Allocation</td>
                                                    <td>₱2.5M</td>
                                                    <td>₱3.0M</td>
                                                    <td>₱1.8M</td>
                                                </tr>
                                                <tr>
                                                    <td>Projected Revenue</td>
                                                    <td>₱15.2M</td>
                                                    <td>₱18.5M</td>
                                                    <td>₱13.1M</td>
                                                </tr>
                                                <tr>
                                                    <td>Projected Profit</td>
                                                    <td>₱2.7M</td>
                                                    <td>₱4.7M</td>
                                                    <td>₱2.9M</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approval Workflow Tab -->
                <div class="tab-content" id="approval-workflow-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Budget Approval Workflow</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Report</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search budgets by department, status, or approver...">
                            </div>

                            <div class="approval-steps">
                                <div class="approval-step">
                                    <div class="step-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="step-details">
                                        <div class="step-title">Budget Creation</div>
                                        <div class="step-status">Created by Finance Manager</div>
                                        <div class="step-date">Sept 10, 2025</div>
                                    </div>
                                    <span class="status status-approved">Completed</span>
                                </div>
                                <div class="approval-step">
                                    <div class="step-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="step-details">
                                        <div class="step-title">Department Review</div>
                                        <div class="step-status">Reviewed by Department Head</div>
                                        <div class="step-date">Sept 12, 2025</div>
                                    </div>
                                    <span class="status status-approved">Completed</span>
                                </div>
                                <div class="approval-step">
                                    <div class="step-icon">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                    <div class="step-details">
                                        <div class="step-title">Finance Committee Review</div>
                                        <div class="step-status">Pending review by Finance Committee</div>
                                        <div class="step-date">Due: Sept 18, 2025</div>
                                    </div>
                                    <span class="status status-pending">In Progress</span>
                                </div>
                                <div class="approval-step">
                                    <div class="step-icon">
                                        <i class="fas fa-gavel"></i>
                                    </div>
                                    <div class="step-details">
                                        <div class="step-title">Executive Approval</div>
                                        <div class="step-status">Awaiting CEO approval</div>
                                        <div class="step-date">Due: Sept 22, 2025</div>
                                    </div>
                                    <span class="status status-pending">Pending</span>
                                </div>
                                <div class="approval-step">
                                    <div class="step-icon">
                                        <i class="fas fa-rocket"></i>
                                    </div>
                                    <div class="step-details">
                                        <div class="step-title">Implementation</div>
                                        <div class="step-status">Scheduled for implementation</div>
                                        <div class="step-date">Starts: Oct 1, 2025</div>
                                    </div>
                                    <span class="status status-pending">Pending</span>
                                </div>
                            </div>

                            <div class="card" style="margin-top: 30px;">
                                <div class="card-header">
                                    <h2 class="card-title">Pending Approvals</h2>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Budget</th>
                                                    <th>Department</th>
                                                    <th>Amount</th>
                                                    <th>Current Stage</th>
                                                    <th>Waiting For</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>2025 Marketing Campaign</td>
                                                    <td>Marketing</td>
                                                    <td>₱850,000.00</td>
                                                    <td>Finance Committee Review</td>
                                                    <td>Finance Committee</td>
                                                    <td>
                                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                        <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Q4 IT Infrastructure</td>
                                                    <td>Information Technology</td>
                                                    <td>₱1,200,000.00</td>
                                                    <td>Department Review</td>
                                                    <td>IT Director</td>
                                                    <td>
                                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                        <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2026 Annual Budget</td>
                                                    <td>Finance</td>
                                                    <td>₱15,500,000.00</td>
                                                    <td>Executive Approval</td>
                                                    <td>CEO</td>
                                                    <td>
                                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-view btn-sm"><i class="fas fa-edit"></i></button>
                                                    </td>
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
                <p>&copy; 2025 Financial System - Budget Planning</p>
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
                
                // Hide all tab content
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                
                // Show the selected tab content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(`${tabId}-tab`).classList.add('active');
            });
        });

        // Scenario card selection
        const scenarioCards = document.querySelectorAll('.scenario-card');
        scenarioCards.forEach(card => {
            card.addEventListener('click', function() {
                scenarioCards.forEach(c => c.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Allocation auto-calculate buttons
        const autoCalculateButtons = document.querySelectorAll('.btn-view.btn-sm');
        autoCalculateButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const amountInput = row.querySelector('input');
                const totalBudget = document.getElementById('amount').value;
                
                if (totalBudget) {
                    // Simple auto-calculation logic (20% of total budget for demonstration)
                    const calculatedAmount = totalBudget * 0.2;
                    amountInput.value = calculatedAmount.toFixed(2);
                    
                    // Update percentage
                    const percentageCell = row.querySelector('td:nth-child(3)');
                    percentageCell.textContent = Math.round((calculatedAmount / totalBudget) * 100) + '%';
                } else {
                    alert('Please enter a total budget amount first.');
                }
            });
        });

        // Form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Budget submitted for approval!');
            // Here you would typically send the data to a server
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
    </script>
</body>
</html>

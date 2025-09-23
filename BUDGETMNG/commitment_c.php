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
            --encumbered: #9b59b6;
            --available: #2ecc71;
            --overspent: #e74c3c;
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

        .status-encumbered {
            background-color: var(--encumbered);
            color: white;
        }

        .status-available {
            background-color: var(--available);
            color: white;
        }

        .status-overspent {
            background-color: var(--overspent);
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

        /* Budget Check Screen */
        .budget-check {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 30px;
        }

        .budget-check-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .budget-check-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--dark);
        }

        .budget-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .budget-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }

        .budget-item-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 5px;
        }

        .budget-item-value {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--dark);
        }

        .budget-item-value.positive {
            color: var(--success);
        }

        .budget-item-value.negative {
            color: var(--accent);
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

        .progress-fill.encumbered {
            background-color: var(--encumbered);
        }

        .progress-fill.available {
            background-color: var(--available);
        }

        .progress-fill.overspent {
            background-color: var(--overspent);
        }

        /* Transaction Details */
        .transaction-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .transaction-details h4 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 15px;
            color: var(--dark);
        }

        /* Override Request */
        .override-request {
            background: #fff3e0;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            border-left: 4px solid var(--warning);
        }

        .override-request h4 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 15px;
            color: var(--dark);
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
            
            .budget-summary {
                grid-template-columns: 1fr 1fr;
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
            
            .budget-summary {
                grid-template-columns: 1fr;
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
                <h1 class="page-title">Commitment Control</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3>Encumbered Funds</h3>
                        <p>₱4.2M</p>
                        <small>Commitments not yet disbursed</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Available Balance</h3>
                        <p>₱5.1M</p>
                        <small>For new commitments</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3>Over-Budget Requests</h3>
                        <p>12</p>
                        <small>Awaiting approval</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon purple">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h3>Pending AP</h3>
                        <p>₱2.8M</p>
                        <small>Awaiting commitment check</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="pre-encumbrance">Pre-Encumbrance Check</div>
                    <div class="tab" data-tab="encumbrance-tracker">Encumbrance Tracker</div>
                    <div class="tab" data-tab="override-workflow">Override Workflow</div>
                </div>

                <!-- Pre-Encumbrance Check Tab -->
                <div class="tab-content active" id="pre-encumbrance-tab">
                    <div class="budget-check">
                        <div class="budget-check-header">
                            <h2 class="budget-check-title">Budget Availability Check</h2>
                            <span class="status status-available">Available: ₱5,100,000.00</span>
                        </div>

                        <div class="transaction-details">
                            <h4>Transaction Details</h4>
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Transaction Type</label>
                                        <select class="form-control" id="transactionType">
                                            <option value="ap">Accounts Payable (Invoice)</option>
                                            <option value="po">Purchase Order</option>
                                            <option value="payroll">Payroll</option>
                                            <option value="reimbursement">Reimbursement</option>
                                            <option value="disbursement">Disbursement</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Department</label>
                                        <select class="form-control" id="department">
                                            <option value="finance">Finance</option>
                                            <option value="hr">Human Resources</option>
                                            <option value="it">Information Technology</option>
                                            <option value="marketing">Marketing</option>
                                            <option value="operations">Operations</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Budget Category</label>
                                        <select class="form-control" id="budgetCategory">
                                            <option value="payroll">Payroll</option>
                                            <option value="procurement">Procurement</option>
                                            <option value="operations">Operations</option>
                                            <option value="marketing">Marketing</option>
                                            <option value="training">Training & Development</option>
                                            <option value="travel">Travel & Entertainment</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Amount (₱)</label>
                                        <input type="number" class="form-control" id="transactionAmount" placeholder="Enter amount" value="125000">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="transactionDescription" placeholder="Enter transaction description" value="Q3 Marketing Campaign - Digital Ads">
                            </div>
                        </div>

                        <div class="budget-summary">
                            <div class="budget-item">
                                <div class="budget-item-label">Total Budget</div>
                                <div class="budget-item-value">₱9,300,000.00</div>
                            </div>
                            <div class="budget-item">
                                <div class="budget-item-label">Encumbered</div>
                                <div class="budget-item-value">₱4,200,000.00</div>
                            </div>
                            <div class="budget-item">
                                <div class="budget-item-label">Available</div>
                                <div class="budget-item-value positive">₱5,100,000.00</div>
                            </div>
                            <div class="budget-item">
                                <div class="budget-item-label">Requested</div>
                                <div class="budget-item-value">₱125,000.00</div>
                            </div>
                        </div>

                        <div class="progress-container">
                            <div class="progress-label">
                                <span>Budget Utilization</span>
                                <span>45%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill encumbered" style="width: 45%;"></div>
                            </div>
                        </div>

                        <div id="budgetCheckResult">
                            <div class="form-group">
                                <div class="budget-check-result positive">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Sufficient budget available for this transaction.</span>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-col" style="display: flex; gap: 10px; justify-content: flex-end;">
                                    <button type="button" class="btn btn-secondary">Cancel</button>
                                    <button type="button" class="btn btn-primary">Encumber Funds & Proceed</button>
                                </div>
                            </div>
                        </div>

                        <div id="overBudgetWarning" style="display: none;">
                            <div class="override-request">
                                <h4><i class="fas fa-exclamation-triangle"></i> Over Budget Warning</h4>
                                <p>This transaction exceeds the available budget by <strong>₱75,000.00</strong>. You must request an override to proceed.</p>
                                
                                <div class="form-group">
                                    <label class="form-label">Justification for Override</label>
                                    <textarea class="form-control" rows="3" placeholder="Explain why this over-budget transaction is necessary"></textarea>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-col" style="display: flex; gap: 10px; justify-content: flex-end;">
                                        <button type="button" class="btn btn-secondary">Cancel</button>
                                        <button type="button" class="btn btn-primary">Request Override Approval</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Recent Commitment Checks</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search transactions...">
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Department</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2025-09-15</td>
                                            <td>Invoice</td>
                                            <td>Office Supplies Purchase</td>
                                            <td>Operations</td>
                                            <td>₱85,000.00</td>
                                            <td><span class="status status-encumbered">Encumbered</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-14</td>
                                            <td>Purchase Order</td>
                                            <td>Software Licenses Renewal</td>
                                            <td>IT</td>
                                            <td>₱120,000.00</td>
                                            <td><span class="status status-encumbered">Encumbered</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-13</td>
                                            <td>Payroll</td>
                                            <td>September Salary Run</td>
                                            <td>HR</td>
                                            <td>₱2,500,000.00</td>
                                            <td><span class="status status-available">Disbursed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-12</td>
                                            <td>Reimbursement</td>
                                            <td>Business Travel Expenses</td>
                                            <td>Sales</td>
                                            <td>₱45,000.00</td>
                                            <td><span class="status status-available">Disbursed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-10</td>
                                            <td>Invoice</td>
                                            <td>Marketing Campaign Services</td>
                                            <td>Marketing</td>
                                            <td>₱250,000.00</td>
                                            <td><span class="status status-overspent">Override Approved</span></td>
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

                <!-- Encumbrance Tracker Tab -->
                <div class="tab-content" id="encumbrance-tracker-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Encumbrance Tracking Dashboard</h2>
                            <div>
                                <select class="form-control" style="width: auto;">
                                    <option>Q3 2025</option>
                                    <option>Q2 2025</option>
                                    <option>Q1 2025</option>
                                    <option>2025 Annual</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="budget-summary">
                                <div class="budget-item">
                                    <div class="budget-item-label">Total Budget</div>
                                    <div class="budget-item-value">₱9,300,000.00</div>
                                </div>
                                <div class="budget-item">
                                    <div class="budget-item-label">Encumbered</div>
                                    <div class="budget-item-value">₱4,200,000.00</div>
                                </div>
                                <div class="budget-item">
                                    <div class="budget-item-label">Disbursed</div>
                                    <div class="budget-item-value">₱2,800,000.00</div>
                                </div>
                                <div class="budget-item">
                                    <div class="budget-item-label">Available</div>
                                    <div class="budget-item-value positive">₱5,100,000.00</div>
                                </div>
                            </div>

                            <div class="progress-container">
                                <div class="progress-label">
                                    <span>Budget Utilization</span>
                                    <span>75% (₱7,000,000.00 of ₱9,300,000.00)</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill encumbered" style="width: 45%;"></div>
                                    <div class="progress-fill available" style="width: 30%;"></div>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-top: 5px;">
                                    <span>Encumbered: ₱4,200,000.00</span>
                                    <span>Disbursed: ₱2,800,000.00</span>
                                    <span>Available: ₱5,100,000.00</span>
                                </div>
                            </div>

                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search encumbrances...">
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Encumbrance ID</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Department</th>
                                            <th>Encumbered Date</th>
                                            <th>Encumbered Amount</th>
                                            <th>Disbursed Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ENC-2025-001</td>
                                            <td>Purchase Order</td>
                                            <td>Laptop Computers (25 units)</td>
                                            <td>IT</td>
                                            <td>2025-09-01</td>
                                            <td>₱1,250,000.00</td>
                                            <td>₱1,250,000.00</td>
                                            <td><span class="status status-available">Fully Disbursed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ENC-2025-002</td>
                                            <td>Invoice</td>
                                            <td>Office Furniture</td>
                                            <td>Operations</td>
                                            <td>2025-09-05</td>
                                            <td>₱850,000.00</td>
                                            <td>₱425,000.00</td>
                                            <td><span class="status status-encumbered">Partially Disbursed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ENC-2025-003</td>
                                            <td>Payroll</td>
                                            <td>September Salaries</td>
                                            <td>HR</td>
                                            <td>2025-09-10</td>
                                            <td>₱2,500,000.00</td>
                                            <td>₱2,500,000.00</td>
                                            <td><span class="status status-available">Fully Disbursed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ENC-2025-004</td>
                                            <td>Invoice</td>
                                            <td>Marketing Campaign</td>
                                            <td>Marketing</td>
                                            <td>2025-09-12</td>
                                            <td>₱250,000.00</td>
                                            <td>₱0.00</td>
                                            <td><span class="status status-encumbered">Fully Encumbered</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ENC-2025-005</td>
                                            <td>Reimbursement</td>
                                            <td>Business Travel</td>
                                            <td>Sales</td>
                                            <td>2025-09-14</td>
                                            <td>₱45,000.00</td>
                                            <td>₱45,000.00</td>
                                            <td><span class="status status-available">Fully Disbursed</span></td>
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

                <!-- Override Workflow Tab -->
                <div class="tab-content" id="override-workflow-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Override Requests</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Report</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search override requests...">
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Request ID</th>
                                            <th>Requester</th>
                                            <th>Department</th>
                                            <th>Transaction</th>
                                            <th>Amount</th>
                                            <th>Over Budget By</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>OVR-2025-001</td>
                                            <td>Maria Santos</td>
                                            <td>Marketing</td>
                                            <td>Q4 Campaign Launch</td>
                                            <td>₱350,000.00</td>
                                            <td>₱75,000.00</td>
                                            <td>2025-09-10</td>
                                            <td><span class="status status-approved">Approved</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>OVR-2025-002</td>
                                            <td>Juan Dela Cruz</td>
                                            <td>IT</td>
                                            <td>Server Upgrade</td>
                                            <td>₱500,000.00</td>
                                            <td>₱150,000.00</td>
                                            <td>2025-09-12</td>
                                            <td><span class="status status-pending">Under Review</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>OVR-2025-003</td>
                                            <td>Pedro Reyes</td>
                                            <td>Operations</td>
                                            <td>Warehouse Renovation</td>
                                            <td>₱750,000.00</td>
                                            <td>₱200,000.00</td>
                                            <td>2025-09-14</td>
                                            <td><span class="status status-pending">Under Review</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>OVR-2025-004</td>
                                            <td>Ana Lopez</td>
                                            <td>HR</td>
                                            <td>Training Program</td>
                                            <td>₱120,000.00</td>
                                            <td>₱35,000.00</td>
                                            <td>2025-09-15</td>
                                            <td><span class="status status-rejected">Rejected</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Override Approval Workflow</h2>
                        </div>
                        <div class="card-body">
                            <div class="approval-steps">
                                <div class="approval-step">
                                    <div class="step-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="step-details">
                                        <div class="step-title">Override Request Submitted</div>
                                        <div class="step-status">Submitted by Department Manager</div>
                                        <div class="step-date">Sept 12, 2025</div>
                                    </div>
                                    <span class="status status-approved">Completed</span>
                                </div>
                                <div class="approval-step">
                                    <div class="step-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="step-details">
                                        <div class="step-title">Budget Office Review</div>
                                        <div class="step-status">Reviewed by Budget Analyst</div>
                                        <div class="step-date">Sept 13, 2025</div>
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
                                        <div class="step-title">CFO Approval</div>
                                        <div class="step-status">Awaiting CFO approval</div>
                                        <div class="step-date">Due: Sept 20, 2025</div>
                                    </div>
                                    <span class="status status-pending">Pending</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Commitment Control</p>
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

        // Budget check functionality
        const transactionAmount = document.getElementById('transactionAmount');
        const budgetCheckResult = document.getElementById('budgetCheckResult');
        const overBudgetWarning = document.getElementById('overBudgetWarning');
        
        transactionAmount.addEventListener('input', function() {
            const amount = parseFloat(this.value) || 0;
            const availableBudget = 5100000;
            
            if (amount > availableBudget) {
                budgetCheckResult.style.display = 'none';
                overBudgetWarning.style.display = 'block';
                
                const overAmount = amount - availableBudget;
                overBudgetWarning.querySelector('p').innerHTML = 
                    `This transaction exceeds the available budget by <strong>₱${overAmount.toLocaleString()}.00</strong>. You must request an override to proceed.`;
            } else {
                budgetCheckResult.style.display = 'block';
                overBudgetWarning.style.display = 'none';
            }
        });

        // Simulate budget check on page load
        transactionAmount.dispatchEvent(new Event('input'));

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

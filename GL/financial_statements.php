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
            --income: #2ecc71;
            --balance: #3498db;
            --cashflow: #9b59b6;
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

        .card-icon.income {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--income);
        }

        .card-icon.balance {
            background-color: rgba(52, 152, 219, 0.2);
            color: var(--balance);
        }

        .card-icon.cashflow {
            background-color: rgba(155, 89, 182, 0.2);
            color: var(--cashflow);
        }

        .card-icon.report {
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

        /* Financial Statement Tables */
        .statement-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .statement-table th, .statement-table td {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
        }

        .statement-table th {
            background-color: #f5f7fa;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }

        .statement-table .account-name {
            font-weight: 500;
            padding-left: 20px;
        }

        .statement-table .account-total {
            font-weight: 600;
            background-color: #f0f7ff;
        }

        .statement-table .section-header {
            font-weight: 700;
            background-color: #e3f2fd;
            font-family: 'Montserrat', sans-serif;
        }

        .statement-table .final-total {
            font-weight: 700;
            background-color: #bbdefb;
            font-size: 1.1rem;
            font-family: 'Montserrat', sans-serif;
        }

        .amount {
            text-align: right;
            font-family: 'Lato', sans-serif;
        }

        .positive {
            color: #2e7d32;
        }

        .negative {
            color: #c62828;
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

        .btn-pdf {
            background-color: #e74c3c;
            color: white;
        }

        .btn-pdf:hover {
            background-color: #c0392b;
        }

        .btn-excel {
            background-color: #2ecc71;
            color: white;
        }

        .btn-excel:hover {
            background-color: #27ae60;
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

        /* Customization Panel */
        .customization-panel {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .customization-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .option-group {
            margin-bottom: 15px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .checkbox-group input {
            margin-right: 10px;
        }

        /* Export Tools */
        .export-tools {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
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
            
            .customization-options {
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
            
            .export-tools {
                flex-direction: column;
            }
            
            .export-tools .btn {
                width: 100%;
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
                <h1 class="page-title">Financial Statements</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon income">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Net Income</h3>
                        <p class="positive">₱2,845,670</p>
                        <small>Year to Date</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon balance">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <h3>Total Assets</h3>
                        <p>₱15,230,450</p>
                        <small>As of September 30, 2025</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon cashflow">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3>Operating Cash Flow</h3>
                        <p class="positive">₱3,125,800</p>
                        <small>Year to Date</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon report">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3>Generated Reports</h3>
                        <p>24</p>
                        <small>This quarter</small>
                    </div>
                </div>

                <!-- Report Customization Panel -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Report Customization</h2>
                    </div>
                    <div class="card-body">
                        <div class="customization-panel">
                            <div class="customization-options">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Date Range</label>
                                        <div class="form-row">
                                            <div class="form-col">
                                                <input type="date" class="form-control" id="startDate" value="2025-01-01">
                                            </div>
                                            <div class="form-col">
                                                <input type="date" class="form-control" id="endDate" value="2025-09-30">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Reporting Frequency</label>
                                        <select class="form-select" id="frequency">
                                            <option value="monthly">Monthly</option>
                                            <option value="quarterly" selected>Quarterly</option>
                                            <option value="yearly">Yearly</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Segment By</label>
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="segmentProduct" checked>
                                            <label for="segmentProduct">Product Line</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="segmentRegion">
                                            <label for="segmentRegion">Region</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="segmentCampaign" checked>
                                            <label for="segmentCampaign">E-commerce Campaign</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="segmentDepartment">
                                            <label for="segmentDepartment">Business Unit</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Report Format</label>
                                        <select class="form-select" id="reportFormat">
                                            <option value="standard">Standard Format</option>
                                            <option value="statutory">Statutory Compliant</option>
                                            <option value="management">Management Reporting</option>
                                            <option value="tax">Tax Reporting</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Currency</label>
                                        <select class="form-select" id="currency">
                                            <option value="php" selected>Philippine Peso (₱)</option>
                                            <option value="usd">US Dollar ($)</option>
                                            <option value="eur">Euro (€)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="text-align: right; margin-top: 20px;">
                                <button class="btn btn-secondary">Reset to Defaults</button>
                                <button class="btn btn-primary" id="generateReports"><i class="fas fa-cogs"></i> Generate Statements</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="income-statement">Income Statement</div>
                    <div class="tab" data-tab="balance-sheet">Balance Sheet</div>
                    <div class="tab" data-tab="cash-flow">Cash Flow Statement</div>
                    <div class="tab" data-tab="export">Export Tools</div>
                </div>

                <!-- Income Statement Tab -->
                <div class="tab-content active" id="income-statement-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Income Statement - Q3 2025 (Jan 1 - Sep 30, 2025)</h2>
                            <div>
                                <button class="btn btn-drill btn-sm" onclick="openModal('drillModal', 'income')"><i class="fas fa-search"></i> Drill Down</button>
                                <button class="btn btn-pdf btn-sm"><i class="fas fa-file-pdf"></i> PDF</button>
                                <button class="btn btn-excel btn-sm"><i class="fas fa-file-excel"></i> Excel</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="statement-table">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Amount (₱)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="section-header">
                                            <td colspan="2">REVENUE</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Product Sales</td>
                                            <td class="amount">12,450,680.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Service Revenue</td>
                                            <td class="amount">3,785,420.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Other Income</td>
                                            <td class="amount">245,800.00</td>
                                        </tr>
                                        <tr class="account-total">
                                            <td><strong>Total Revenue</strong></td>
                                            <td class="amount"><strong>16,481,900.00</strong></td>
                                        </tr>
                                        
                                        <tr class="section-header">
                                            <td colspan="2">COST OF GOODS SOLD</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Cost of Products</td>
                                            <td class="amount">7,845,670.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Cost of Services</td>
                                            <td class="amount">1,245,800.00</td>
                                        </tr>
                                        <tr class="account-total">
                                            <td><strong>Total Cost of Goods Sold</strong></td>
                                            <td class="amount"><strong>9,091,470.00</strong></td>
                                        </tr>
                                        
                                        <tr class="account-total">
                                            <td><strong>GROSS PROFIT</strong></td>
                                            <td class="amount"><strong>7,390,430.00</strong></td>
                                        </tr>
                                        
                                        <tr class="section-header">
                                            <td colspan="2">OPERATING EXPENSES</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Salaries and Wages</td>
                                            <td class="amount">2,145,680.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Marketing and Advertising</td>
                                            <td class="amount">785,420.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Rent and Utilities</td>
                                            <td class="amount">645,800.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Depreciation and Amortization</td>
                                            <td class="amount">425,670.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Other Operating Expenses</td>
                                            <td class="amount">321,450.00</td>
                                        </tr>
                                        <tr class="account-total">
                                            <td><strong>Total Operating Expenses</strong></td>
                                            <td class="amount"><strong>4,324,020.00</strong></td>
                                        </tr>
                                        
                                        <tr class="account-total">
                                            <td><strong>OPERATING INCOME</strong></td>
                                            <td class="amount"><strong>3,066,410.00</strong></td>
                                        </tr>
                                        
                                        <tr class="section-header">
                                            <td colspan="2">NON-OPERATING ITEMS</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Interest Income</td>
                                            <td class="amount positive">145,800.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Interest Expense</td>
                                            <td class="amount negative">(125,420.00)</td>
                                        </tr>
                                        <tr class="account-total">
                                            <td><strong>Total Non-Operating Items</strong></td>
                                            <td class="amount positive"><strong>20,380.00</strong></td>
                                        </tr>
                                        
                                        <tr class="final-total">
                                            <td><strong>NET INCOME BEFORE TAXES</strong></td>
                                            <td class="amount"><strong>3,086,790.00</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Income Tax Expense</td>
                                            <td class="amount negative">(241,120.00)</td>
                                        </tr>
                                        <tr class="final-total">
                                            <td><strong>NET INCOME AFTER TAXES</strong></td>
                                            <td class="amount positive"><strong>2,845,670.00</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Balance Sheet Tab -->
                <div class="tab-content" id="balance-sheet-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Balance Sheet - As of September 30, 2025</h2>
                            <div>
                                <button class="btn btn-drill btn-sm" onclick="openModal('drillModal', 'balance')"><i class="fas fa-search"></i> Drill Down</button>
                                <button class="btn btn-pdf btn-sm"><i class="fas fa-file-pdf"></i> PDF</button>
                                <button class="btn btn-excel btn-sm"><i class="fas fa-file-excel"></i> Excel</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="statement-table">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Amount (₱)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="section-header">
                                            <td colspan="2">ASSETS</td>
                                        </tr>
                                        <tr class="section-header">
                                            <td>Current Assets</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Cash and Cash Equivalents</td>
                                            <td class="amount">4,250,680.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Accounts Receivable</td>
                                            <td class="amount">3,785,420.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Inventory</td>
                                            <td class="amount">2,645,800.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Prepaid Expenses</td>
                                            <td class="amount">545,670.00</td>
                                        </tr>
                                        <tr class="account-total">
                                            <td><strong>Total Current Assets</strong></td>
                                            <td class="amount"><strong>11,227,570.00</strong></td>
                                        </tr>
                                        
                                        <tr class="section-header">
                                            <td>Non-Current Assets</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Property, Plant & Equipment</td>
                                            <td class="amount">3,245,800.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Intangible Assets</td>
                                            <td class="amount">745,670.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Long-term Investments</td>
                                            <td class="amount">1,245,800.00</td>
                                        </tr>
                                        <tr class="account-total">
                                            <td><strong>Total Non-Current Assets</strong></td>
                                            <td class="amount"><strong>5,237,270.00</strong></td>
                                        </tr>
                                        
                                        <tr class="final-total">
                                            <td><strong>TOTAL ASSETS</strong></td>
                                            <td class="amount"><strong>16,464,840.00</strong></td>
                                        </tr>
                                        
                                        <tr class="section-header">
                                            <td colspan="2">LIABILITIES AND EQUITY</td>
                                        </tr>
                                        <tr class="section-header">
                                            <td>Current Liabilities</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Accounts Payable</td>
                                            <td class="amount">2,145,680.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Short-term Debt</td>
                                            <td class="amount">1,245,800.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Accrued Expenses</td>
                                            <td class="amount">785,420.00</td>
                                        </tr>
                                        <tr class="account-total">
                                            <td><strong>Total Current Liabilities</strong></td>
                                            <td class="amount"><strong>4,176,900.00</strong></td>
                                        </tr>
                                        
                                        <tr class="section-header">
                                            <td>Non-Current Liabilities</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Long-term Debt</td>
                                            <td class="amount">3,245,800.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Deferred Tax Liability</td>
                                            <td class="amount">545,670.00</td>
                                        </tr>
                                        <tr class="account-total">
                                            <td><strong>Total Non-Current Liabilities</strong></td>
                                            <td class="amount"><strong>3,791,470.00</strong></td>
                                        </tr>
                                        
                                        <tr class="account-total">
                                            <td><strong>TOTAL LIABILITIES</strong></td>
                                            <td class="amount"><strong>7,968,370.00</strong></td>
                                        </tr>
                                        
                                        <tr class="section-header">
                                            <td>Equity</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Common Stock</td>
                                            <td class="amount">5,000,000.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Retained Earnings</td>
                                            <td class="amount">3,496,470.00</td>
                                        </tr>
                                        <tr class="account-total">
                                            <td><strong>Total Equity</strong></td>
                                            <td class="amount"><strong>8,496,470.00</strong></td>
                                        </tr>
                                        
                                        <tr class="final-total">
                                            <td><strong>TOTAL LIABILITIES AND EQUITY</strong></td>
                                            <td class="amount"><strong>16,464,840.00</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cash Flow Statement Tab -->
                <div class="tab-content" id="cash-flow-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Cash Flow Statement - Q3 2025 (Jan 1 - Sep 30, 2025)</h2>
                            <div>
                                <button class="btn btn-drill btn-sm" onclick="openModal('drillModal', 'cashflow')"><i class="fas fa-search"></i> Drill Down</button>
                                <button class="btn btn-pdf btn-sm"><i class="fas fa-file-pdf"></i> PDF</button>
                                <button class="btn btn-excel btn-sm"><i class="fas fa-file-excel"></i> Excel</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="statement-table">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Amount (₱)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="section-header">
                                            <td colspan="2">CASH FLOWS FROM OPERATING ACTIVITIES</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Net Income</td>
                                            <td class="amount positive">2,845,670.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Adjustments for:</td>
                                            <td class="amount"></td>
                                        </tr>
                                        <tr>
                                            <td class="account-name" style="padding-left: 30px;">Depreciation and Amortization</td>
                                            <td class="amount positive">425,670.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name" style="padding-left: 30px;">Changes in Working Capital</td>
                                            <td class="amount"></td>
                                        </tr>
                                        <tr>
                                            <td class="account-name" style="padding-left: 50px;">Increase in Accounts Receivable</td>
                                            <td class="amount negative">(785,420.00)</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name" style="padding-left: 50px;">Increase in Inventory</td>
                                            <td class="amount negative">(645,800.00)</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name" style="padding-left: 50px;">Increase in Accounts Payable</td>
                                            <td class="amount positive">545,670.00</td>
                                        </tr>
                                        <tr class="account-total">
                                            <td><strong>Net Cash from Operating Activities</strong></td>
                                            <td class="amount positive"><strong>2,385,790.00</strong></td>
                                        </tr>
                                        
                                        <tr class="section-header">
                                            <td colspan="2">CASH FLOWS FROM INVESTING ACTIVITIES</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Purchase of Property and Equipment</td>
                                            <td class="amount negative">(1,245,800.00)</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Proceeds from Sale of Investments</td>
                                            <td class="amount positive">545,670.00</td>
                                        </tr>
                                        <tr class="account-total">
                                            <td><strong>Net Cash used in Investing Activities</strong></td>
                                            <td class="amount negative"><strong>(700,130.00)</strong></td>
                                        </tr>
                                        
                                        <tr class="section-header">
                                            <td colspan="2">CASH FLOWS FROM FINANCING ACTIVITIES</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Proceeds from Long-term Debt</td>
                                            <td class="amount positive">2,000,000.00</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Repayment of Short-term Debt</td>
                                            <td class="amount negative">(785,420.00)</td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Dividends Paid</td>
                                            <td class="amount negative">(545,670.00)</td>
                                        </tr>
                                        <tr class="account-total">
                                            <td><strong>Net Cash from Financing Activities</strong></td>
                                            <td class="amount positive"><strong>668,910.00</strong></td>
                                        </tr>
                                        
                                        <tr class="account-total">
                                            <td><strong>Net Increase in Cash and Cash Equivalents</strong></td>
                                            <td class="amount positive"><strong>2,354,570.00</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="account-name">Cash and Cash Equivalents at Beginning of Period</td>
                                            <td class="amount">1,896,110.00</td>
                                        </tr>
                                        <tr class="final-total">
                                            <td><strong>Cash and Cash Equivalents at End of Period</strong></td>
                                            <td class="amount"><strong>4,250,680.00</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Export Tools Tab -->
                <div class="tab-content" id="export-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Export Financial Statements</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Select Statements to Export</label>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="exportIncome" checked>
                                    <label for="exportIncome">Income Statement</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="exportBalance" checked>
                                    <label for="exportBalance">Balance Sheet</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="exportCashflow" checked>
                                    <label for="exportCashflow">Cash Flow Statement</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Export Format</label>
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="checkbox-group">
                                            <input type="radio" id="formatPDF" name="exportFormat" checked>
                                            <label for="formatPDF">PDF Document</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input type="radio" id="formatExcel" name="exportFormat">
                                            <label for="formatExcel">Excel Spreadsheet</label>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="checkbox-group">
                                            <input type="radio" id="formatRegulatory" name="exportFormat">
                                            <label for="formatRegulatory">Regulatory Format (BIR)</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input type="radio" id="formatCSV" name="exportFormat">
                                            <label for="formatCSV">CSV Data</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Additional Options</label>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="includeNotes">
                                    <label for="includeNotes">Include Notes to Financial Statements</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="includeCharts">
                                    <label for="includeCharts">Include Charts and Graphs</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="passwordProtect">
                                    <label for="passwordProtect">Password Protect Document</label>
                                </div>
                            </div>
                            
                            <div class="export-tools">
                                <button class="btn btn-pdf"><i class="fas fa-file-pdf"></i> Export to PDF</button>
                                <button class="btn btn-excel"><i class="fas fa-file-excel"></i> Export to Excel</button>
                                <button class="btn btn-primary"><i class="fas fa-download"></i> Download All</button>
                                <button class="btn btn-secondary"><i class="fas fa-envelope"></i> Email Reports</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Financial Statements</p>
            </div>
        </div>
    </div>

    <!-- Drill Down Modal -->
    <div id="drillModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="drillModalTitle">Drill Down Details</h2>
                <span class="close" onclick="closeModal('drillModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div id="drillContent">
                    <!-- Content will be dynamically loaded -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="closeModal('drillModal')">Close</button>
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
        function openModal(modalId, statementType = '') {
            document.getElementById(modalId).style.display = 'block';
            
            if (modalId === 'drillModal' && statementType) {
                loadDrillDownContent(statementType);
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

        // Load drill down content based on statement type
        function loadDrillDownContent(statementType) {
            const contentDiv = document.getElementById('drillContent');
            const titleDiv = document.getElementById('drillModalTitle');
            let content = '';
            
            switch(statementType) {
                case 'income':
                    titleDiv.textContent = 'Income Statement Drill Down';
                    content = `
                        <h3>Revenue Breakdown by Product Line</h3>
                        <div class="table-responsive">
                            <table class="statement-table">
                                <thead>
                                    <tr>
                                        <th>Product Line</th>
                                        <th>Q1 2025</th>
                                        <th>Q2 2025</th>
                                        <th>Q3 2025</th>
                                        <th>YTD Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Electronics</td>
                                        <td class="amount">₱2,450,680</td>
                                        <td class="amount">₱2,785,420</td>
                                        <td class="amount">₱3,145,800</td>
                                        <td class="amount">₱8,381,900</td>
                                    </tr>
                                    <tr>
                                        <td>Home Appliances</td>
                                        <td class="amount">₱1,245,800</td>
                                        <td class="amount">₱1,545,670</td>
                                        <td class="amount">₱1,845,800</td>
                                        <td class="amount">₱4,637,270</td>
                                    </tr>
                                    <tr>
                                        <td>Fashion</td>
                                        <td class="amount">₱785,420</td>
                                        <td class="amount">₱945,670</td>
                                        <td class="amount">₱1,145,800</td>
                                        <td class="amount">₱2,876,890</td>
                                    </tr>
                                    <tr class="account-total">
                                        <td><strong>Total Revenue</strong></td>
                                        <td class="amount"><strong>₱4,481,900</strong></td>
                                        <td class="amount"><strong>₱5,276,760</strong></td>
                                        <td class="amount"><strong>₱6,137,400</strong></td>
                                        <td class="amount"><strong>₱15,896,060</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <h3>Operating Expenses by Department</h3>
                        <div class="table-responsive">
                            <table class="statement-table">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Amount</th>
                                        <th>% of Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sales & Marketing</td>
                                        <td class="amount">₱1,845,680</td>
                                        <td class="amount">11.2%</td>
                                    </tr>
                                    <tr>
                                        <td>Research & Development</td>
                                        <td class="amount">₱985,420</td>
                                        <td class="amount">6.0%</td>
                                    </tr>
                                    <tr>
                                        <td>General & Administrative</td>
                                        <td class="amount">₱1,245,800</td>
                                        <td class="amount">7.6%</td>
                                    </tr>
                                    <tr class="account-total">
                                        <td><strong>Total Operating Expenses</strong></td>
                                        <td class="amount"><strong>₱4,076,900</strong></td>
                                        <td class="amount"><strong>24.8%</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    `;
                    break;
                case 'balance':
                    titleDiv.textContent = 'Balance Sheet Drill Down';
                    content = `
                        <h3>Accounts Receivable Aging</h3>
                        <div class="table-responsive">
                            <table class="statement-table">
                                <thead>
                                    <tr>
                                        <th>Aging Category</th>
                                        <th>Amount</th>
                                        <th>% of Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Current (0-30 days)</td>
                                        <td class="amount">₱2,145,680</td>
                                        <td class="amount">56.7%</td>
                                    </tr>
                                    <tr>
                                        <td>31-60 days</td>
                                        <td class="amount">₱985,420</td>
                                        <td class="amount">26.0%</td>
                                    </tr>
                                    <tr>
                                        <td>61-90 days</td>
                                        <td class="amount">₱445,800</td>
                                        <td class="amount">11.8%</td>
                                    </tr>
                                    <tr>
                                        <td>Over 90 days</td>
                                        <td class="amount">₱208,520</td>
                                        <td class="amount">5.5%</td>
                                    </tr>
                                    <tr class="account-total">
                                        <td><strong>Total Accounts Receivable</strong></td>
                                        <td class="amount"><strong>₱3,785,420</strong></td>
                                        <td class="amount"><strong>100.0%</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <h3>Fixed Assets Detail</h3>
                        <div class="table-responsive">
                            <table class="statement-table">
                                <thead>
                                    <tr>
                                        <th>Asset Category</th>
                                        <th>Cost</th>
                                        <th>Accumulated Depreciation</th>
                                        <th>Net Book Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Land</td>
                                        <td class="amount">₱1,245,800</td>
                                        <td class="amount">₱0</td>
                                        <td class="amount">₱1,245,800</td>
                                    </tr>
                                    <tr>
                                        <td>Buildings</td>
                                        <td class="amount">₱2,785,420</td>
                                        <td class="amount">₱645,800</td>
                                        <td class="amount">₱2,139,620</td>
                                    </tr>
                                    <tr>
                                        <td>Equipment</td>
                                        <td class="amount">₱1,845,680</td>
                                        <td class="amount">₱985,420</td>
                                        <td class="amount">₱860,260</td>
                                    </tr>
                                    <tr class="account-total">
                                        <td><strong>Total Fixed Assets</strong></td>
                                        <td class="amount"><strong>₱5,876,900</strong></td>
                                        <td class="amount"><strong>₱1,631,220</strong></td>
                                        <td class="amount"><strong>₱4,245,680</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    `;
                    break;
                case 'cashflow':
                    titleDiv.textContent = 'Cash Flow Statement Drill Down';
                    content = `
                        <h3>Cash Flow from Operations - Detailed</h3>
                        <div class="table-responsive">
                            <table class="statement-table">
                                <thead>
                                    <tr>
                                        <th>Component</th>
                                        <th>Q1 2025</th>
                                        <th>Q2 2025</th>
                                        <th>Q3 2025</th>
                                        <th>YTD Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Collections from Customers</td>
                                        <td class="amount positive">₱3,845,680</td>
                                        <td class="amount positive">₱4,245,800</td>
                                        <td class="amount positive">₱4,785,420</td>
                                        <td class="amount positive">₱12,876,900</td>
                                    </tr>
                                    <tr>
                                        <td>Payments to Suppliers</td>
                                        <td class="amount negative">(₱2,145,680)</td>
                                        <td class="amount negative">(₱2,445,800)</td>
                                        <td class="amount negative">(₱2,785,420)</td>
                                        <td class="amount negative">(₱7,376,900)</td>
                                    </tr>
                                    <tr>
                                        <td>Payments to Employees</td>
                                        <td class="amount negative">(₱645,800)</td>
                                        <td class="amount negative">(₱745,670)</td>
                                        <td class="amount negative">(₱845,800)</td>
                                        <td class="amount negative">(₱2,237,270)</td>
                                    </tr>
                                    <tr>
                                        <td>Interest Received</td>
                                        <td class="amount positive">₱45,680</td>
                                        <td class="amount positive">₱55,800</td>
                                        <td class="amount positive">₱65,420</td>
                                        <td class="amount positive">₱166,900</td>
                                    </tr>
                                    <tr class="account-total">
                                        <td><strong>Net Cash from Operations</strong></td>
                                        <td class="amount positive"><strong>₱1,145,680</strong></td>
                                        <td class="amount positive"><strong>₱1,245,800</strong></td>
                                        <td class="amount positive"><strong>₱1,385,420</strong></td>
                                        <td class="amount positive"><strong>₱3,776,900</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    `;
                    break;
                default:
                    content = `<p>Loading detailed information...</p>`;
            }
            
            contentDiv.innerHTML = content;
        }

        // Generate reports function
        document.getElementById('generateReports').addEventListener('click', function() {
            // Show loading state
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...';
            this.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
                alert('Financial statements have been generated successfully!');
            }, 2000);
        });

        // Set current date as default end date
        document.getElementById('endDate').valueAsDate = new Date();
    </script>
</body>
</html>

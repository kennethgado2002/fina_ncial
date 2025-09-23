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
            --draft: #95a5a6;
            --pending: #f39c12;
            --approved: #3498db;
            --posted: #2ecc71;
            --rejected: #e74c3c;
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

        .status-draft {
            background-color: var(--draft);
            color: white;
        }

        .status-pending {
            background-color: var(--pending);
            color: white;
        }

        .status-approved {
            background-color: var(--approved);
            color: white;
        }

        .status-posted {
            background-color: var(--posted);
            color: white;
        }

        .status-rejected {
            background-color: var(--rejected);
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

        /* Journal Entry Lines */
        .je-lines {
            margin: 20px 0;
        }

        .je-line {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            align-items: center;
        }

        .je-line-delete {
            color: var(--accent);
            cursor: pointer;
            font-size: 1.2rem;
        }

        .je-line-account {
            flex: 2;
        }

        .je-line-debit, .je-line-credit {
            flex: 1;
        }

        .je-line-description {
            flex: 3;
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

        /* Import Queue */
        .import-queue {
            margin: 20px 0;
        }

        .import-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: var(--transition);
        }

        .import-item:hover {
            background: #f8f9fa;
        }

        .import-source {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .source-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
        }

        .source-ap {
            background: var(--accent);
        }

        .source-ar {
            background: var(--success);
        }

        .source-payroll {
            background: var(--warning);
        }

        .source-budget {
            background: var(--secondary);
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
            
            .je-line {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .je-line > div {
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
                <h1 class="page-title">Journal Entry Management</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card" onclick="setActiveTab('manual-tab')">
                        <div class="card-icon blue">
                            <i class="fas fa-pen"></i>
                        </div>
                        <h3>Manual Entries</h3>
                        <p>24</p>
                        <small>Pending approval</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('import-tab')">
                        <div class="card-icon orange">
                            <i class="fas fa-sync"></i>
                        </div>
                        <h3>Import Queue</h3>
                        <p>142</p>
                        <small>From submodules</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('approval-tab')">
                        <div class="card-icon red">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Approval Needed</h3>
                        <p>18</p>
                        <small>Above threshold</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('audit-tab')">
                        <div class="card-icon green">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Posted Today</h3>
                        <p>67</p>
                        <small>To trial balance</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="manual">Manual Entry</div>
                    <div class="tab" data-tab="import">Import Queue</div>
                    <div class="tab" data-tab="approval">Approval Workflow</div>
                    <div class="tab" data-tab="audit">JE Audit</div>
                </div>

                <!-- Manual Entry Tab -->
                <div class="tab-content active" id="manual-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Create Journal Entry</h2>
                        </div>
                        <div class="card-body">
                            <form id="journalEntryForm">
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Entry Date</label>
                                            <input type="date" class="form-control" value="2025-09-05">
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Reference Number</label>
                                            <input type="text" class="form-control" value="JE-2025-1001" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" rows="2" placeholder="Enter journal entry description...">Monthly accrual for utilities</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Entry Type</label>
                                    <select class="form-control">
                                        <option value="adjustment">Adjustment</option>
                                        <option value="accrual">Accrual</option>
                                        <option value="provision">Provision</option>
                                        <option value="reversal">Reversal</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <h3 class="form-label">Journal Entry Lines</h3>
                                <div class="je-lines">
                                    <div class="je-line">
                                        <div class="je-line-delete">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <div class="je-line-account">
                                            <label class="form-label">Account</label>
                                            <select class="form-control">
                                                <option value="">Select Account</option>
                                                <option value="5100" selected>Utilities Expense (5100)</option>
                                                <option value="2100">Accounts Payable (2100)</option>
                                                <option value="1100">Cash (1100)</option>
                                            </select>
                                        </div>
                                        <div class="je-line-debit">
                                            <label class="form-label">Debit</label>
                                            <input type="number" class="form-control" placeholder="0.00" step="0.01" value="12500.00">
                                        </div>
                                        <div class="je-line-credit">
                                            <label class="form-label">Credit</label>
                                            <input type="number" class="form-control" placeholder="0.00" step="0.01" value="0">
                                        </div>
                                        <div class="je-line-description">
                                            <label class="form-label">Line Description</label>
                                            <input type="text" class="form-control" placeholder="Description" value="Electricity bill for August">
                                        </div>
                                    </div>
                                    <div class="je-line">
                                        <div class="je-line-delete">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <div class="je-line-account">
                                            <label class="form-label">Account</label>
                                            <select class="form-control">
                                                <option value="">Select Account</option>
                                                <option value="5100">Utilities Expense (5100)</option>
                                                <option value="2100" selected>Accounts Payable (2100)</option>
                                                <option value="1100">Cash (1100)</option>
                                            </select>
                                        </div>
                                        <div class="je-line-debit">
                                            <label class="form-label">Debit</label>
                                            <input type="number" class="form-control" placeholder="0.00" step="0.01" value="0">
                                        </div>
                                        <div class="je-line-credit">
                                            <label class="form-label">Credit</label>
                                            <input type="number" class="form-control" placeholder="0.00" step="0.01" value="12500.00">
                                        </div>
                                        <div class="je-line-description">
                                            <label class="form-label">Line Description</label>
                                            <input type="text" class="form-control" placeholder="Description" value="Accrued utilities payable">
                                        </div>
                                    </div>
                                </div>

                                <div style="text-align: center; margin: 20px 0;">
                                    <button type="button" class="btn btn-secondary">
                                        <i class="fas fa-plus"></i> Add Another Line
                                    </button>
                                </div>

                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Total Debits</label>
                                            <input type="text" class="form-control" value="₱12,500.00" readonly>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Total Credits</label>
                                            <input type="text" class="form-control" value="₱12,500.00" readonly>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Balance</label>
                                            <input type="text" class="form-control" value="₱0.00" readonly style="background: #e8f5e9;">
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top: 20px; text-align: right;">
                                    <button type="button" class="btn btn-secondary">Save as Draft</button>
                                    <button type="button" class="btn btn-primary">Submit for Approval</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Import Queue Tab -->
                <div class="tab-content" id="import-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Automated JE Import Queue</h2>
                            <div>
                                <button class="btn btn-primary"><i class="fas fa-sync"></i> Refresh</button>
                                <button class="btn btn-success"><i class="fas fa-check-double"></i> Process All</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="importSearch" placeholder="Search by source, reference, or amount...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Source Module</span>
                                    <select class="filter-select" id="sourceFilter">
                                        <option value="">All Sources</option>
                                        <option value="ap">Accounts Payable</option>
                                        <option value="ar">Accounts Receivable</option>
                                        <option value="payroll">Payroll</option>
                                        <option value="budget">Budget</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="importStatusFilter">
                                        <option value="">All Statuses</option>
                                        <option value="pending">Pending</option>
                                        <option value="processed">Processed</option>
                                        <option value="error">Error</option>
                                    </select>
                                </div>
                            </div>

                            <div class="import-queue">
                                <div class="import-item">
                                    <div class="import-source">
                                        <div class="source-icon source-ap">AP</div>
                                        <div>
                                            <strong>Vendor Invoice</strong>
                                            <div>INV-2025-085 • ₱12,500.00</div>
                                            <small>ABC Suppliers • 2025-09-05</small>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-view btn-sm" onclick="openModal('viewImportModal')">View</button>
                                        <button class="btn btn-success btn-sm">Process</button>
                                    </div>
                                </div>
                                <div class="import-item">
                                    <div class="import-source">
                                        <div class="source-icon source-ar">AR</div>
                                        <div>
                                            <strong>Customer Payment</strong>
                                            <div>PMT-2025-042 • ₱8,750.00</div>
                                            <small>Maria Garcia • 2025-09-05</small>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-view btn-sm" onclick="openModal('viewImportModal')">View</button>
                                        <button class="btn btn-success btn-sm">Process</button>
                                    </div>
                                </div>
                                <div class="import-item">
                                    <div class="import-source">
                                        <div class="source-icon source-payroll">PR</div>
                                        <div>
                                            <strong>Payroll Disbursement</strong>
                                            <div>PAY-2025-009 • ₱289,400.00</div>
                                            <small>September 2025 Payroll • 2025-09-05</small>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-view btn-sm" onclick="openModal('viewImportModal')">View</button>
                                        <button class="btn btn-success btn-sm">Process</button>
                                    </div>
                                </div>
                                <div class="import-item">
                                    <div class="import-source">
                                        <div class="source-icon source-budget">BG</div>
                                        <div>
                                            <strong>Budget Commitment</strong>
                                            <div>BUD-2025-015 • ₱150,000.00</div>
                                            <small>Marketing Campaign • 2025-09-04</small>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-view btn-sm" onclick="openModal('viewImportModal')">View</button>
                                        <button class="btn btn-success btn-sm">Process</button>
                                    </div>
                                </div>
                                <div class="import-item" style="background: #fff3cd; border-color: #ffeaa7;">
                                    <div class="import-source">
                                        <div class="source-icon source-ar" style="background: #f39c12;">AR</div>
                                        <div>
                                            <strong>Refund Processing</strong>
                                            <div>REF-2025-1002 • ₱8,750.00</div>
                                            <small>Maria Garcia • 2025-09-04</small>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="status status-pending">Validation Error</span>
                                        <button class="btn btn-view btn-sm" onclick="openModal('viewImportModal')">View</button>
                                        <button class="btn btn-warning btn-sm">Fix & Retry</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approval Workflow Tab -->
                <div class="tab-content" id="approval-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Approval Workflow</h2>
                            <div>
                                <button class="btn btn-primary"><i class="fas fa-sync"></i> Refresh</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="approvalSearch" placeholder="Search JE number, creator, or amount...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Approval Level</span>
                                    <select class="filter-select" id="approvalLevelFilter">
                                        <option value="">All Levels</option>
                                        <option value="supervisor">Supervisor (₱0 - ₱10,000)</option>
                                        <option value="manager">Manager (₱10,001 - ₱50,000)</option>
                                        <option value="director">Director (₱50,001 - ₱200,000)</option>
                                        <option value="cfo">CFO (₱200,001+)</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="approvalStatusFilter">
                                        <option value="">All Statuses</option>
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>JE Number</th>
                                            <th>Description</th>
                                            <th>Creator</th>
                                            <th>Amount</th>
                                            <th>Approval Level</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>JE-2025-1001</td>
                                            <td>Monthly accrual for utilities</td>
                                            <td>John Dela Cruz</td>
                                            <td>₱12,500.00</td>
                                            <td>Manager</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>2025-09-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewJEModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JE-2025-1002</td>
                                            <td>Depreciation for August</td>
                                            <td>Maria Santos</td>
                                            <td>₱45,800.00</td>
                                            <td>Director</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>2025-09-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewJEModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JE-2025-1003</td>
                                            <td>Bad debt provision</td>
                                            <td>Carlos Reyes</td>
                                            <td>₱125,000.00</td>
                                            <td>CFO</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>2025-09-04</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewJEModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JE-2025-0998</td>
                                            <td>Office supplies adjustment</td>
                                            <td>John Dela Cruz</td>
                                            <td>₱8,500.00</td>
                                            <td>Supervisor</td>
                                            <td><span class="status status-approved">Approved</span></td>
                                            <td>2025-09-04</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewJEModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-arrow-right"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JE-2025-0995</td>
                                            <td>Prepaid expense amortization</td>
                                            <td>Maria Santos</td>
                                            <td>₱32,000.00</td>
                                            <td>Manager</td>
                                            <td><span class="status status-rejected">Rejected</span></td>
                                            <td>2025-09-03</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewJEModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-warning btn-sm"><i class="fas fa-redo"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- JE Audit Tab -->
                <div class="tab-content" id="audit-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">JE Audit Trail</h2>
                            <div>
                                <button class="btn btn-primary"><i class="fas fa-sync"></i> Refresh</button>
                                <button class="btn btn-secondary"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="auditSearch" placeholder="Search JE number, source, or creator...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <select class="filter-select" id="auditDateFilter">
                                        <option value="">All Dates</option>
                                        <option value="today">Today</option>
                                        <option value="week">This Week</option>
                                        <option value="month">This Month</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Source Module</span>
                                    <select class="filter-select" id="auditSourceFilter">
                                        <option value="">All Sources</option>
                                        <option value="manual">Manual</option>
                                        <option value="ap">Accounts Payable</option>
                                        <option value="ar">Accounts Receivable</option>
                                        <option value="payroll">Payroll</option>
                                        <option value="budget">Budget</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="auditStatusFilter">
                                        <option value="">All Statuses</option>
                                        <option value="draft">Draft</option>
                                        <option value="posted">Posted</option>
                                        <option value="reversed">Reversed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>JE Number</th>
                                            <th>Description</th>
                                            <th>Source</th>
                                            <th>Reference</th>
                                            <th>Amount</th>
                                            <th>Creator</th>
                                            <th>Approver</th>
                                            <th>Status</th>
                                            <th>Posted Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>JE-2025-1001</td>
                                            <td>Monthly accrual for utilities</td>
                                            <td>Manual</td>
                                            <td>-</td>
                                            <td>₱12,500.00</td>
                                            <td>John Dela Cruz</td>
                                            <td>-</td>
                                            <td><span class="status status-draft">Draft</span></td>
                                            <td>-</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewJEModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JE-2025-0998</td>
                                            <td>Office supplies adjustment</td>
                                            <td>Manual</td>
                                            <td>-</td>
                                            <td>₱8,500.00</td>
                                            <td>John Dela Cruz</td>
                                            <td>Maria Santos</td>
                                            <td><span class="status status-posted">Posted</span></td>
                                            <td>2025-09-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewJEModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JE-2025-0997</td>
                                            <td>Vendor invoice payment</td>
                                            <td>Accounts Payable</td>
                                            <td>INV-2025-084</td>
                                            <td>₱15,200.00</td>
                                            <td>System</td>
                                            <td>Auto-Approved</td>
                                            <td><span class="status status-posted">Posted</span></td>
                                            <td>2025-09-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewJEModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JE-2025-0996</td>
                                            <td>Customer payment receipt</td>
                                            <td>Accounts Receivable</td>
                                            <td>PMT-2025-041</td>
                                            <td>₱22,500.00</td>
                                            <td>System</td>
                                            <td>Auto-Approved</td>
                                            <td><span class="status status-posted">Posted</span></td>
                                            <td>2025-09-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewJEModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JE-2025-0995</td>
                                            <td>Payroll disbursement</td>
                                            <td>Payroll</td>
                                            <td>PAY-2025-008</td>
                                            <td>₱289,400.00</td>
                                            <td>System</td>
                                            <td>Carlos Reyes</td>
                                            <td><span class="status status-posted">Posted</span></td>
                                            <td>2025-09-04</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewJEModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
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
                <p>&copy; 2025 Financial System - Journal Entry Management</p>
            </div>
        </div>
    </div>

    <!-- View JE Modal -->
    <div id="viewJEModal" class="modal">
        <div class="modal-content" style="max-width: 900px;">
            <div class="modal-header">
                <h2 class="modal-title">Journal Entry Details</h2>
                <span class="close" onclick="closeModal('viewJEModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">JE Number</label>
                            <p>JE-2025-1001</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Entry Date</label>
                            <p>September 5, 2025</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <p>Monthly accrual for utilities</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Entry Type</label>
                            <p>Accrual</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Creator</label>
                            <p>John Dela Cruz</p>
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
                    <label class="form-label">Journal Entry Lines</label>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Account</th>
                                    <th>Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Utilities Expense (5100)</td>
                                    <td>Electricity bill for August</td>
                                    <td>₱12,500.00</td>
                                    <td>₱0.00</td>
                                </tr>
                                <tr>
                                    <td>Accounts Payable (2100)</td>
                                    <td>Accrued utilities payable</td>
                                    <td>₱0.00</td>
                                    <td>₱12,500.00</td>
                                </tr>
                                <tr style="font-weight: bold;">
                                    <td colspan="2" style="text-align: right;">Total</td>
                                    <td>₱12,500.00</td>
                                    <td>₱12,500.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="workflow-steps">
                    <div class="workflow-step step-completed">
                        <div class="step-icon">
                            <i class="fas fa-pen"></i>
                        </div>
                        <div class="step-label">Created</div>
                    </div>
                    <div class="workflow-step step-active">
                        <div class="step-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="step-label">Validation</div>
                    </div>
                    <div class="workflow-step">
                        <div class="step-icon">
                            <i class="fas fa-thumbs-up"></i>
                        </div>
                        <div class="step-label">Approval</div>
                    </div>
                    <div class="workflow-step">
                        <div class="step-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="step-label">Posted</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Audit Trail</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <div style="width: 20px; height: 20px; border-radius: 50%; background: #2ecc71; margin-right: 10px;"></div>
                            <div>
                                <strong>Created</strong> - John Dela Cruz - 2025-09-05 10:30 AM
                            </div>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 2px solid #ddd; margin-right: 10px;"></div>
                            <div>
                                <strong>Approved</strong> - Pending
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('viewJEModal')">Close</button>
                <button class="btn btn-success">Approve</button>
                <button class="btn btn-danger">Reject</button>
                <button class="btn btn-primary">Post to Trial Balance</button>
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

        // Dashboard card click to navigate to tabs
        document.querySelectorAll('.dashboard-card').forEach(card => {
            card.addEventListener('click', function() {
                // Simple logic to determine which tab to open based on card content
                if (this.querySelector('h3').textContent.includes('Manual')) {
                    setActiveTab('manual-tab');
                } else if (this.querySelector('h3').textContent.includes('Import')) {
                    setActiveTab('import-tab');
                } else if (this.querySelector('h3').textContent.includes('Approval')) {
                    setActiveTab('approval-tab');
                } else if (this.querySelector('h3').textContent.includes('Posted')) {
                    setActiveTab('audit-tab');
                }
            });
        });

        // Delete JE line functionality
        document.querySelectorAll('.je-line-delete').forEach(deleteBtn => {
            deleteBtn.addEventListener('click', function() {
                this.closest('.je-line').remove();
                updateJETotals();
            });
        });

        // Update JE totals when values change
        function updateJETotals() {
            let totalDebit = 0;
            let totalCredit = 0;
            
            document.querySelectorAll('.je-line').forEach(line => {
                const debit = parseFloat(line.querySelector('.je-line-debit input').value) || 0;
                const credit = parseFloat(line.querySelector('.je-line-credit input').value) || 0;
                
                totalDebit += debit;
                totalCredit += credit;
            });
            
            document.querySelector('input[placeholder="0.00"][readonly]').value = `₱${totalDebit.toLocaleString('en-PH', {minimumFractionDigits: 2})}`;
            document.querySelectorAll('input[placeholder="0.00"][readonly]')[1].value = `₱${totalCredit.toLocaleString('en-PH', {minimumFractionDigits: 2})}`;
            
            const balance = totalDebit - totalCredit;
            const balanceInput = document.querySelectorAll('input[placeholder="0.00"][readonly]')[2];
            balanceInput.value = `₱${Math.abs(balance).toLocaleString('en-PH', {minimumFractionDigits: 2})}`;
            
            if (balance === 0) {
                balanceInput.style.background = '#e8f5e9';
            } else {
                balanceInput.style.background = '#ffebee';
            }
        }

        // Add event listeners to debit/credit inputs
        document.querySelectorAll('.je-line-debit input, .je-line-credit input').forEach(input => {
            input.addEventListener('input', updateJETotals);
        });

        // Initialize totals
        updateJETotals();
    </script>
</body>
</html>

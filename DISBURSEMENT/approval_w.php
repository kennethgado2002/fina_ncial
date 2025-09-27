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
            --escalated: #9b59b6;
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

        .status-escalated {
            background-color: var(--escalated);
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

        /* Approval Flow */
        .approval-flow {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            position: relative;
        }

        .approval-step {
            text-align: center;
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .approval-step::before {
            content: '';
            position: absolute;
            top: 20px;
            left: -50%;
            width: 100%;
            height: 3px;
            background: #ddd;
            z-index: 1;
        }

        .approval-step:first-child::before {
            display: none;
        }

        .step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            background: #ecf0f1;
            color: #7f8c8d;
            position: relative;
            z-index: 2;
        }

        .step-active .step-icon {
            background: var(--secondary);
            color: white;
        }

        .step-completed .step-icon {
            background: var(--success);
            color: white;
        }

        .step-rejected .step-icon {
            background: var(--rejected);
            color: white;
        }

        .step-label {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .step-date {
            font-size: 0.8rem;
            color: #7f8c8d;
        }

        /* Signature Panel */
        .signature-panel {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .signature-pad {
            width: 100%;
            height: 150px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 15px 0;
            cursor: crosshair;
        }

        .signature-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        /* Audit Trail */
        .audit-trail {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 15px;
        }

        .audit-item {
            padding: 15px;
            border-left: 4px solid #ddd;
            margin-bottom: 15px;
            background: #f8f9fa;
        }

        .audit-item.approved {
            border-left-color: var(--success);
        }

        .audit-item.rejected {
            border-left-color: var(--rejected);
        }

        .audit-item.escalated {
            border-left-color: var(--escalated);
        }

        .audit-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .audit-action {
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
        }

        .audit-date {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .audit-details {
            font-size: 0.9rem;
            color: #555;
        }

        .audit-user {
            font-weight: 600;
            color: var(--dark);
        }

        /* Escalation Dashboard */
        .escalation-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .metric-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .metric-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .metric-label {
            color: #7f8c8d;
            font-size: 0.9rem;
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
            
            .approval-flow {
                flex-direction: column;
                gap: 20px;
            }
            
            .approval-step::before {
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
            
            .escalation-metrics {
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
                <h1 class="page-title">Approval Workflow</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card" onclick="switchTab('queue')">
                        <div class="card-icon blue">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3>Pending Approvals</h3>
                        <p>18</p>
                        <small>Require your action</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('escalation')">
                        <div class="card-icon orange">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3>Overdue</h3>
                        <p>7</p>
                        <small>Past due date</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('queue')">
                        <div class="card-icon purple">
                            <i class="fas fa-level-up-alt"></i>
                        </div>
                        <h3>Escalated</h3>
                        <p>5</p>
                        <small>Require higher approval</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('audit')">
                        <div class="card-icon green">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h3>Processed Today</h3>
                        <p>24</p>
                        <small>Approvals completed</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="queue">Approval Queue</div>
                    <div class="tab" data-tab="escalation">Escalation Dashboard</div>
                    <div class="tab" data-tab="audit">Audit Trail</div>
                </div>

                <!-- Approval Queue Tab -->
                <div class="tab-content active" id="queue-tab">
                    <!-- Approval Queue Table Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Pending Approval Requests</h2>
                            <div>
                                <button class="btn btn-download" id="downloadQueue"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Disbursement Type</span>
                                    <select class="filter-select" id="typeFilter">
                                        <option value="">All Types</option>
                                        <option value="vendor">Vendor Payment</option>
                                        <option value="payroll">Payroll</option>
                                        <option value="reimbursement">Reimbursement</option>
                                        <option value="refund">Refund</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Amount Range</span>
                                    <select class="filter-select" id="amountFilter">
                                        <option value="">All Amounts</option>
                                        <option value="low">Under ₱10,000</option>
                                        <option value="medium">₱10,000 - ₱50,000</option>
                                        <option value="high">Over ₱50,000</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Priority</span>
                                    <select class="filter-select" id="priorityFilter">
                                        <option value="">All Priorities</option>
                                        <option value="high">High</option>
                                        <option value="normal">Normal</option>
                                        <option value="low">Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="approvalSearch" placeholder="Search Request ID, Requester, or Vendor...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Request ID</th>
                                            <th>Type</th>
                                            <th>Requester</th>
                                            <th>Vendor/Employee</th>
                                            <th>Amount</th>
                                            <th>Submitted</th>
                                            <th>Due Date</th>
                                            <th>Priority</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>REQ-2025-001</td>
                                            <td>Vendor Payment</td>
                                            <td>Procurement Dept</td>
                                            <td>ABC Suppliers</td>
                                            <td>₱125,000.00</td>
                                            <td>2025-09-01</td>
                                            <td>2025-09-05</td>
                                            <td><span class="status status-pending">High</span></td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-times"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REQ-2025-002</td>
                                            <td>Payroll</td>
                                            <td>HR Department</td>
                                            <td>Employee Batch</td>
                                            <td>₱485,000.00</td>
                                            <td>2025-09-02</td>
                                            <td>2025-09-06</td>
                                            <td><span class="status status-pending">High</span></td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-times"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REQ-2025-003</td>
                                            <td>Reimbursement</td>
                                            <td>Maria Santos</td>
                                            <td>Maria Santos</td>
                                            <td>₱8,500.00</td>
                                            <td>2025-09-03</td>
                                            <td>2025-09-10</td>
                                            <td><span class="status" style="background:#bdc3c7; color:white">Normal</span></td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-times"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REQ-2025-004</td>
                                            <td>Refund</td>
                                            <td>Customer Service</td>
                                            <td>Juan Dela Cruz</td>
                                            <td>₱2,500.00</td>
                                            <td>2025-09-04</td>
                                            <td>2025-09-08</td>
                                            <td><span class="status" style="background:#bdc3c7; color:white">Normal</span></td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-times"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REQ-2025-005</td>
                                            <td>Vendor Payment</td>
                                            <td>Operations Dept</td>
                                            <td>XYZ Technologies</td>
                                            <td>₱75,000.00</td>
                                            <td>2025-09-05</td>
                                            <td>2025-09-12</td>
                                            <td><span class="status" style="background:#bdc3c7; color:white">Normal</span></td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-times"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Escalation Dashboard Tab -->
                <div class="tab-content" id="escalation-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Escalation Dashboard</h2>
                        </div>
                        <div class="card-body">
                            <div class="escalation-metrics">
                                <div class="metric-card">
                                    <div class="metric-value">7</div>
                                    <div class="metric-label">Overdue Approvals</div>
                                </div>
                                <div class="metric-card">
                                    <div class="metric-value">₱425,000</div>
                                    <div class="metric-label">Total Overdue Amount</div>
                                </div>
                                <div class="metric-card">
                                    <div class="metric-value">5</div>
                                    <div class="metric-label">Policy Exceptions</div>
                                </div>
                                <div class="metric-card">
                                    <div class="metric-value">12</div>
                                    <div class="metric-label">Avg. Hours Overdue</div>
                                </div>
                            </div>

                            <h3 style="margin-bottom: 15px; font-family: 'Montserrat', sans-serif;">Overdue Approval Requests</h3>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Request ID</th>
                                            <th>Type</th>
                                            <th>Requester</th>
                                            <th>Amount</th>
                                            <th>Due Date</th>
                                            <th>Days Overdue</th>
                                            <th>Escalation Reason</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>REQ-2025-015</td>
                                            <td>Vendor Payment</td>
                                            <td>Procurement Dept</td>
                                            <td>₱85,000.00</td>
                                            <td>2025-08-28</td>
                                            <td>5</td>
                                            <td>Threshold exceeded</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i> CFO</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REQ-2025-014</td>
                                            <td>Payroll</td>
                                            <td>HR Department</td>
                                            <td>₱225,000.00</td>
                                            <td>2025-08-29</td>
                                            <td>4</td>
                                            <td>Approver unavailable</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i> Director</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REQ-2025-013</td>
                                            <td>Reimbursement</td>
                                            <td>John Smith</td>
                                            <td>₱15,000.00</td>
                                            <td>2025-08-30</td>
                                            <td>3</td>
                                            <td>Missing documentation</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i> Manager</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h3 style="margin: 30px 0 15px; font-family: 'Montserrat', sans-serif;">Policy Exceptions</h3>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Request ID</th>
                                            <th>Type</th>
                                            <th>Requester</th>
                                            <th>Amount</th>
                                            <th>Policy Rule</th>
                                            <th>Exception Reason</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>REQ-2025-012</td>
                                            <td>Vendor Payment</td>
                                            <td>Operations Dept</td>
                                            <td>₱65,000.00</td>
                                            <td>Single vendor limit: ₱50,000</td>
                                            <td>Emergency procurement</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i> Director</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REQ-2025-011</td>
                                            <td>Reimbursement</td>
                                            <td>Maria Santos</td>
                                            <td>₱12,500.00</td>
                                            <td>Travel limit: ₱10,000</td>
                                            <td>Extended conference</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approvalModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i> Manager</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Audit Trail Tab -->
                <div class="tab-content" id="audit-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Approval Audit Trail</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <input type="date" class="filter-select" id="auditStartDate">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">&nbsp;</span>
                                    <input type="date" class="filter-select" id="auditEndDate">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Approver</span>
                                    <select class="filter-select" id="approverFilter">
                                        <option value="">All Approvers</option>
                                        <option value="finance">Finance Manager</option>
                                        <option value="director">Finance Director</option>
                                        <option value="cfo">CFO</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Action</span>
                                    <select class="filter-select" id="actionFilter">
                                        <option value="">All Actions</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="escalated">Escalated</option>
                                    </select>
                                </div>
                            </div>

                            <div class="audit-trail">
                                <div class="audit-item approved">
                                    <div class="audit-header">
                                        <span class="audit-action">Approved</span>
                                        <span class="audit-date">2025-09-05 14:30</span>
                                    </div>
                                    <div class="audit-details">
                                        <span class="audit-user">Finance Manager</span> approved <strong>REQ-2025-010</strong> (Vendor Payment - ₱45,000.00)
                                    </div>
                                    <div class="audit-details" style="margin-top: 5px;">
                                        <i>Comment: Within approval limits, all documents verified.</i>
                                    </div>
                                </div>

                                <div class="audit-item rejected">
                                    <div class="audit-header">
                                        <span class="audit-action">Rejected</span>
                                        <span class="audit-date">2025-09-05 11:15</span>
                                    </div>
                                    <div class="audit-details">
                                        <span class="audit-user">Finance Director</span> rejected <strong>REQ-2025-009</strong> (Reimbursement - ₱8,500.00)
                                    </div>
                                    <div class="audit-details" style="margin-top: 5px;">
                                        <i>Comment: Missing receipts for hotel expense.</i>
                                    </div>
                                </div>

                                <div class="audit-item escalated">
                                    <div class="audit-header">
                                        <span class="audit-action">Escalated</span>
                                        <span class="audit-date">2025-09-04 16:45</span>
                                    </div>
                                    <div class="audit-details">
                                        <span class="audit-user">Finance Manager</span> escalated <strong>REQ-2025-008</strong> (Vendor Payment - ₱125,000.00) to CFO
                                    </div>
                                    <div class="audit-details" style="margin-top: 5px;">
                                        <i>Comment: Amount exceeds department approval limit.</i>
                                    </div>
                                </div>

                                <div class="audit-item approved">
                                    <div class="audit-header">
                                        <span class="audit-action">Approved</span>
                                        <span class="audit-date">2025-09-04 10:20</span>
                                    </div>
                                    <div class="audit-details">
                                        <span class="audit-user">CFO</span> approved <strong>REQ-2025-007</strong> (Payroll - ₱485,000.00)
                                    </div>
                                    <div class="audit-details" style="margin-top: 5px;">
                                        <i>Comment: Regular payroll cycle, all calculations verified.</i>
                                    </div>
                                </div>

                                <div class="audit-item approved">
                                    <div class="audit-header">
                                        <span class="audit-action">Approved</span>
                                        <span class="audit-date">2025-09-03 15:10</span>
                                    </div>
                                    <div class="audit-details">
                                        <span class="audit-user">Finance Manager</span> approved <strong>REQ-2025-006</strong> (Refund - ₱2,500.00)
                                    </div>
                                    <div class="audit-details" style="margin-top: 5px;">
                                        <i>Comment: Customer return processed, refund authorized.</i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Approval Workflow</p>
            </div>
        </div>
    </div>

    <!-- Approval Modal -->
    <div id="approvalModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Approval Request Details</h2>
                <span class="close" onclick="closeModal('approvalModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Request ID</label>
                            <p>REQ-2025-001</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Disbursement Type</label>
                            <p>Vendor Payment</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Requester</label>
                            <p>Procurement Department</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Vendor</label>
                            <p>ABC Suppliers</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Amount</label>
                            <p>₱125,000.00</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Due Date</label>
                            <p>2025-09-05</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <p>Payment for office equipment procurement - Q3 2025</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Approval Flow</label>
                    <div class="approval-flow">
                        <div class="approval-step step-completed">
                            <div class="step-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="step-label">Requester</div>
                            <div class="step-date">2025-09-01</div>
                        </div>
                        <div class="approval-step step-completed">
                            <div class="step-icon">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div class="step-label">Dept. Head</div>
                            <div class="step-date">2025-09-02</div>
                        </div>
                        <div class="approval-step step-active">
                            <div class="step-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="step-label">Finance Manager</div>
                            <div class="step-date">Pending</div>
                        </div>
                        <div class="approval-step">
                            <div class="step-icon">
                                <i class="fas fa-crown"></i>
                            </div>
                            <div class="step-label">CFO</div>
                            <div class="step-date">-</div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Supporting Documents</label>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button class="btn btn-view btn-sm"><i class="fas fa-file-invoice"></i> Invoice</button>
                        <button class="btn btn-view btn-sm"><i class="fas fa-file-contract"></i> Purchase Order</button>
                        <button class="btn btn-view btn-sm"><i class="fas fa-receipt"></i> Delivery Receipt</button>
                        <button class="btn btn-view btn-sm"><i class="fas fa-file-alt"></i> Approval Form</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Digital Signature</label>
                    <div class="signature-panel">
                        <p>Provide your digital signature to approve or reject this request</p>
                        <div class="signature-pad" id="signaturePad">
                            <canvas id="signatureCanvas" width="500" height="150" style="border: 1px solid #ddd; border-radius: 4px;"></canvas>
                        </div>
                        <div class="signature-actions">
                            <button class="btn btn-secondary btn-sm" id="clearSignature">Clear</button>
                            <button class="btn btn-primary btn-sm" id="saveSignature">Save Signature</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="approvalComments">Comments</label>
                    <textarea class="form-control" id="approvalComments" rows="3" placeholder="Add any comments for this approval decision"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('approvalModal')">Cancel</button>
                <button type="button" class="btn btn-reject">Reject Request</button>
                <button type="button" class="btn btn-approve">Approve Request</button>
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

        // Switch tab function for dashboard cards
        function switchTab(tabName) {
            tabs.forEach(t => t.classList.remove('active'));
            document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
            
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(`${tabName}-tab`).classList.add('active');
        }

        // Modal functionality
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
            initializeSignaturePad();
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

        // Signature Pad functionality
        function initializeSignaturePad() {
            const canvas = document.getElementById('signatureCanvas');
            const ctx = canvas.getContext('2d');
            let isDrawing = false;
            let lastX = 0;
            let lastY = 0;
            
            // Set canvas background to white
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Set drawing style
            ctx.strokeStyle = '#000';
            ctx.lineWidth = 2;
            ctx.lineJoin = 'round';
            ctx.lineCap = 'round';
            
            // Drawing functions
            function startDrawing(e) {
                isDrawing = true;
                [lastX, lastY] = [e.offsetX, e.offsetY];
            }
            
            function draw(e) {
                if (!isDrawing) return;
                
                ctx.beginPath();
                ctx.moveTo(lastX, lastY);
                ctx.lineTo(e.offsetX, e.offsetY);
                ctx.stroke();
                [lastX, lastY] = [e.offsetX, e.offsetY];
            }
            
            function stopDrawing() {
                isDrawing = false;
            }
            
            // Event listeners for drawing
            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseout', stopDrawing);
            
            // Clear signature button
            document.getElementById('clearSignature').addEventListener('click', function() {
                ctx.fillStyle = 'white';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
            });
            
            // Save signature button
            document.getElementById('saveSignature').addEventListener('click', function() {
                alert('Signature saved successfully!');
            });
        }

        // Search functionality
        document.getElementById('approvalSearch').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('#queue-tab tbody tr');
            
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

        // Filter functionality for approval queue
        const filters = document.querySelectorAll('.filter-select');
        filters.forEach(filter => {
            filter.addEventListener('change', filterApprovalQueue);
        });

        function filterApprovalQueue() {
            const typeFilter = document.getElementById('typeFilter').value;
            const amountFilter = document.getElementById('amountFilter').value;
            const priorityFilter = document.getElementById('priorityFilter').value;
            
            const rows = document.querySelectorAll('#queue-tab tbody tr');
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const type = cells[1].textContent.toLowerCase();
                const amountText = cells[4].textContent;
                const amount = parseFloat(amountText.replace(/[^\d.]/g, ''));
                const priority = cells[7].textContent.toLowerCase();
                
                let showRow = true;
                
                // Check type filter
                if (typeFilter && !type.includes(typeFilter)) {
                    showRow = false;
                }
                
                // Check amount filter
                if (amountFilter) {
                    if (amountFilter === 'low' && amount >= 10000) showRow = false;
                    if (amountFilter === 'medium' && (amount < 10000 || amount > 50000)) showRow = false;
                    if (amountFilter === 'high' && amount <= 50000) showRow = false;
                }
                
                // Check priority filter
                if (priorityFilter && !priority.includes(priorityFilter)) {
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

        // Approve/Reject button functionality
        document.querySelectorAll('.btn-approve, .btn-reject').forEach(button => {
            button.addEventListener('click', function() {
                const action = this.classList.contains('btn-approve') ? 'approve' : 'reject';
                if (confirm(`Are you sure you want to ${action} this request?`)) {
                    // In a real application, this would submit the approval decision
                    alert(`Request has been ${action}d successfully.`);
                    closeModal('approvalModal');
                }
            });
        });
    </script>
</body>
</html>

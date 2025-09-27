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
            --create: #2ecc71;
            --update: #3498db;
            --delete: #e74c3c;
            --approve: #9b59b6;
            --view: #f39c12;
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

        /* Filter Section */
        .filter-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
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

        .filter-select, .filter-input {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Lato', sans-serif;
            font-size: 1rem;
            background: white;
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

        .action-type {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
        }

        .action-create {
            background-color: var(--create);
            color: white;
        }

        .action-update {
            background-color: var(--update);
            color: white;
        }

        .action-delete {
            background-color: var(--delete);
            color: white;
        }

        .action-approve {
            background-color: var(--approve);
            color: white;
        }

        .action-view {
            background-color: var(--view);
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

        .btn-danger {
            background-color: var(--accent);
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
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

        /* Audit Details */
        .audit-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .detail-row {
            display: flex;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .detail-label {
            font-weight: 600;
            min-width: 150px;
            font-family: 'Montserrat', sans-serif;
        }

        .detail-value {
            flex: 1;
        }

        /* Digital Signature */
        .signature-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background: #f8f9fa;
            margin-top: 20px;
        }

        .signature-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .signature-icon {
            font-size: 1.5rem;
            margin-right: 10px;
            color: var(--secondary);
        }

        /* Transaction Trail */
        .transaction-trail {
            margin-top: 20px;
        }

        .trail-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .trail-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 0.9rem;
            background: #f0f0f0;
        }

        .trail-content {
            flex: 1;
        }

        .trail-arrow {
            margin: 0 10px;
            color: #ccc;
        }

        /* Compliance Report Options */
        .report-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
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
            
            .filter-section {
                grid-template-columns: 1fr;
            }
            
            .detail-row {
                flex-direction: column;
            }
            
            .detail-label {
                min-width: auto;
                margin-bottom: 5px;
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
            
            .report-options {
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
                <h1 class="page-title">Audit Trail</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-history"></i>
                        </div>
                        <h3>Total Audit Events</h3>
                        <p>24,568</p>
                        <small>Last 30 days</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <h3>Active Users</h3>
                        <p>42</p>
                        <small>With system access</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon red">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3>Suspicious Activities</h3>
                        <p>18</p>
                        <small>Require investigation</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon purple">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <h3>Compliance Reports</h3>
                        <p>12</p>
                        <small>Generated this month</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="audit-log">Audit Log</div>
                    <div class="tab" data-tab="transaction-drill">Transaction Drill-Down</div>
                    <div class="tab" data-tab="compliance">Compliance Reports</div>
                </div>

                <!-- Audit Log Tab -->
                <div class="tab-content active" id="audit-log-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Audit Log Dashboard</h2>
                            <div>
                                <button class="btn btn-primary" id="refreshAuditLog"><i class="fas fa-sync-alt"></i> Refresh</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <div style="display: flex; gap: 10px;">
                                        <input type="date" class="filter-input" id="startDate" value="2025-09-01">
                                        <input type="date" class="filter-input" id="endDate" value="2025-09-30">
                                    </div>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Action Type</span>
                                    <select class="filter-select" id="actionType">
                                        <option value="">All Actions</option>
                                        <option value="create">Create</option>
                                        <option value="update">Update</option>
                                        <option value="delete">Delete</option>
                                        <option value="approve">Approve</option>
                                        <option value="view">View</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">User</span>
                                    <select class="filter-select" id="userFilter">
                                        <option value="">All Users</option>
                                        <option value="user1">John Smith</option>
                                        <option value="user2">Maria Garcia</option>
                                        <option value="user3">Robert Johnson</option>
                                        <option value="user4">Sarah Williams</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Module</span>
                                    <select class="filter-select" id="moduleFilter">
                                        <option value="">All Modules</option>
                                        <option value="ap">Accounts Payable</option>
                                        <option value="ar">Accounts Receivable</option>
                                        <option value="gl">General Ledger</option>
                                        <option value="payroll">Payroll</option>
                                        <option value="inventory">Inventory</option>
                                    </select>
                                </div>
                            </div>

                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="auditSearch" placeholder="Search by record ID, description, or IP address...">
                                <button class="btn btn-primary">Search</button>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Timestamp</th>
                                            <th>User</th>
                                            <th>Action</th>
                                            <th>Module</th>
                                            <th>Record ID</th>
                                            <th>Description</th>
                                            <th>IP Address</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2025-09-28 14:32:15</td>
                                            <td>John Smith</td>
                                            <td><span class="action-type action-approve">Approve</span></td>
                                            <td>Accounts Payable</td>
                                            <td>INV-2025-1001</td>
                                            <td>Approved vendor invoice payment</td>
                                            <td>192.168.1.105</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('auditDetailModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillDownModal')"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-28 13:45:22</td>
                                            <td>Maria Garcia</td>
                                            <td><span class="action-type action-update">Update</span></td>
                                            <td>General Ledger</td>
                                            <td>JE-2025-0876</td>
                                            <td>Updated journal entry description</td>
                                            <td>192.168.1.112</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('auditDetailModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillDownModal')"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-28 11:20:05</td>
                                            <td>Robert Johnson</td>
                                            <td><span class="action-type action-create">Create</span></td>
                                            <td>Accounts Receivable</td>
                                            <td>INV-2025-1058</td>
                                            <td>Created customer invoice</td>
                                            <td>192.168.1.108</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('auditDetailModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillDownModal')"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-27 16:55:43</td>
                                            <td>Sarah Williams</td>
                                            <td><span class="action-type action-delete">Delete</span></td>
                                            <td>Inventory</td>
                                            <td>ITEM-04567</td>
                                            <td>Deleted obsolete inventory item</td>
                                            <td>192.168.1.115</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('auditDetailModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillDownModal')"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-27 10:15:30</td>
                                            <td>John Smith</td>
                                            <td><span class="action-type action-view">View</span></td>
                                            <td>Financial Statements</td>
                                            <td>FS-Q3-2025</td>
                                            <td>Viewed Q3 2025 Income Statement</td>
                                            <td>192.168.1.105</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('auditDetailModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillDownModal')"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-26 09:42:18</td>
                                            <td>Maria Garcia</td>
                                            <td><span class="action-type action-update">Update</span></td>
                                            <td>Payroll</td>
                                            <td>PAY-2025-0928</td>
                                            <td>Updated employee tax information</td>
                                            <td>192.168.1.112</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('auditDetailModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-drill btn-sm" onclick="openModal('drillDownModal')"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction Drill-Down Tab -->
                <div class="tab-content" id="transaction-drill-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Transaction Drill-Down</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Transaction ID</label>
                                        <input type="text" class="form-control" placeholder="Enter transaction ID (e.g., JE-2025-0876)" value="JE-2025-0876">
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Date Range</label>
                                        <div style="display: flex; gap: 10px;">
                                            <input type="date" class="form-control" value="2025-09-01">
                                            <input type="date" class="form-control" value="2025-09-30">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="transaction-trail">
                                <h3>Transaction Trail: JE-2025-0876</h3>
                                
                                <div class="trail-item">
                                    <div class="trail-icon">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </div>
                                    <div class="trail-content">
                                        <strong>AP Invoice Created</strong>
                                        <div>INV-2025-0923 by Vendor: ABC Suppliers</div>
                                        <small>2025-09-15 10:30:22 by John Smith</small>
                                    </div>
                                    <div class="trail-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                                
                                <div class="trail-item">
                                    <div class="trail-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="trail-content">
                                        <strong>3-Way Matching</strong>
                                        <div>Invoice matched with PO-2025-0456 and GRN-2025-0523</div>
                                        <small>2025-09-16 14:15:40 by System</small>
                                    </div>
                                    <div class="trail-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                                
                                <div class="trail-item">
                                    <div class="trail-icon">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <div class="trail-content">
                                        <strong>Approval</strong>
                                        <div>Invoice approved for payment by Finance Manager</div>
                                        <small>2025-09-17 09:45:15 by Maria Garcia</small>
                                    </div>
                                    <div class="trail-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                                
                                <div class="trail-item">
                                    <div class="trail-icon">
                                        <i class="fas fa-receipt"></i>
                                    </div>
                                    <div class="trail-content">
                                        <strong>Journal Entry Created</strong>
                                        <div>JE-2025-0876 posted to Accounts Payable and Cash</div>
                                        <small>2025-09-18 11:20:05 by Robert Johnson</small>
                                    </div>
                                    <div class="trail-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                                
                                <div class="trail-item">
                                    <div class="trail-icon">
                                        <i class="fas fa-money-check"></i>
                                    </div>
                                    <div class="trail-content">
                                        <strong>Payment Processed</strong>
                                        <div>Check #10234 issued to ABC Suppliers</div>
                                        <small>2025-09-19 13:30:50 by System</small>
                                    </div>
                                    <div class="trail-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                                
                                <div class="trail-item">
                                    <div class="trail-icon">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <div class="trail-content">
                                        <strong>Reconciled</strong>
                                        <div>Payment reconciled in bank statement</div>
                                        <small>2025-09-28 14:32:15 by Sarah Williams</small>
                                    </div>
                                </div>
                            </div>

                            <div class="audit-details">
                                <h4>Digital Signatures</h4>
                                <div class="signature-box">
                                    <div class="signature-info">
                                        <div class="signature-icon">
                                            <i class="fas fa-signature"></i>
                                        </div>
                                        <div>
                                            <strong>John Smith</strong> - AP Specialist
                                            <div>Signed: 2025-09-15 10:30:22 | IP: 192.168.1.105</div>
                                            <div>Digital Signature: 7a8f3b2c1d5e9a4f6b0c8e2d...</div>
                                        </div>
                                    </div>
                                    <div class="signature-info">
                                        <div class="signature-icon">
                                            <i class="fas fa-signature"></i>
                                        </div>
                                        <div>
                                            <strong>Maria Garcia</strong> - Finance Manager
                                            <div>Signed: 2025-09-17 09:45:15 | IP: 192.168.1.112</div>
                                            <div>Digital Signature: 9b4f6c8e2d7a1f3b5c0e8d2...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Compliance Reports Tab -->
                <div class="tab-content" id="compliance-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Compliance Report Generator</h2>
                        </div>
                        <div class="card-body">
                            <div class="report-options">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Report Type</label>
                                        <select class="form-select" id="reportType">
                                            <option value="sox">SOX Compliance Report</option>
                                            <option value="pci">PCI DSS Audit Report</option>
                                            <option value="gdpr">GDPR Compliance Report</option>
                                            <option value="internal">Internal Audit Report</option>
                                            <option value="custom">Custom Report</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Date Range</label>
                                        <div class="form-row">
                                            <div class="form-col">
                                                <input type="date" class="form-control" id="reportStartDate" value="2025-07-01">
                                            </div>
                                            <div class="form-col">
                                                <input type="date" class="form-control" id="reportEndDate" value="2025-09-30">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Include Data</label>
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="includeUsers" checked>
                                            <label for="includeUsers">User Activity</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="includeTransactions" checked>
                                            <label for="includeTransactions">Financial Transactions</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="includeSystem">
                                            <label for="includeSystem">System Changes</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="includeAccess">
                                            <label for="includeAccess">Access Control Changes</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Report Format</label>
                                        <div class="checkbox-group">
                                            <input type="radio" id="formatPDF" name="reportFormat" checked>
                                            <label for="formatPDF">PDF Document</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input type="radio" id="formatExcel" name="reportFormat">
                                            <label for="formatExcel">Excel Spreadsheet</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input type="radio" id="formatCSV" name="reportFormat">
                                            <label for="formatCSV">CSV Data</label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Additional Options</label>
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="watermark">
                                            <label for="watermark">Add Confidential Watermark</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="encrypt">
                                            <label for="encrypt">Encrypt Report</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="text-align: center; margin-top: 30px;">
                                <button class="btn btn-pdf"><i class="fas fa-file-pdf"></i> Generate PDF Report</button>
                                <button class="btn btn-excel"><i class="fas fa-file-excel"></i> Generate Excel Report</button>
                                <button class="btn btn-primary"><i class="fas fa-download"></i> Download All Formats</button>
                            </div>
                            
                            <div class="audit-details" style="margin-top: 30px;">
                                <h4>Recently Generated Reports</h4>
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Report Name</th>
                                                <th>Generated Date</th>
                                                <th>Period Covered</th>
                                                <th>Generated By</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>SOX Compliance Report Q3 2025</td>
                                                <td>2025-09-30</td>
                                                <td>Jul 1 - Sep 30, 2025</td>
                                                <td>John Smith</td>
                                                <td>
                                                    <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-pdf btn-sm"><i class="fas fa-download"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Internal Audit Trail Report</td>
                                                <td>2025-09-28</td>
                                                <td>Sep 1 - Sep 28, 2025</td>
                                                <td>Maria Garcia</td>
                                                <td>
                                                    <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-pdf btn-sm"><i class="fas fa-download"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>User Access Review Report</td>
                                                <td>2025-09-25</td>
                                                <td>Jan 1 - Sep 25, 2025</td>
                                                <td>Robert Johnson</td>
                                                <td>
                                                    <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-pdf btn-sm"><i class="fas fa-download"></i></button>
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

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Audit Trail</p>
            </div>
        </div>
    </div>

    <!-- Audit Detail Modal -->
    <div id="auditDetailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Audit Event Details</h2>
                <span class="close" onclick="closeModal('auditDetailModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="audit-details">
                    <div class="detail-row">
                        <div class="detail-label">Event ID</div>
                        <div class="detail-value">AUD-2025-0928-001</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Timestamp</div>
                        <div class="detail-value">2025-09-28 14:32:15</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">User</div>
                        <div class="detail-value">John Smith (jsmith@company.com)</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Action</div>
                        <div class="detail-value"><span class="action-type action-approve">Approve</span></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Module</div>
                        <div class="detail-value">Accounts Payable</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Record ID</div>
                        <div class="detail-value">INV-2025-1001</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Description</div>
                        <div class="detail-value">Approved vendor invoice payment to ABC Suppliers for office supplies</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">IP Address</div>
                        <div class="detail-value">192.168.1.105</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">User Agent</div>
                        <div class="detail-value">Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Session ID</div>
                        <div class="detail-value">SESS-7a8f3b2c1d5e9a4f6b0c8e2d</div>
                    </div>
                </div>

                <div class="signature-box">
                    <h4>Digital Signature</h4>
                    <div class="signature-info">
                        <div class="signature-icon">
                            <i class="fas fa-fingerprint"></i>
                        </div>
                        <div>
                            <strong>Digital Signature Verified</strong>
                            <div>Hash: 7a8f3b2c1d5e9a4f6b0c8e2d7a1f3b5c0e8d2f9b4a6c7e1d3f5a8b9c0d2e4f6</div>
                            <div>Signed with RSA-2048 private key</div>
                            <div>Timestamp: 2025-09-28 14:32:15</div>
                        </div>
                    </div>
                </div>

                <div class="audit-details" style="margin-top: 20px;">
                    <h4>Before & After Values (if applicable)</h4>
                    <div class="detail-row">
                        <div class="detail-label">Previous Status</div>
                        <div class="detail-value">Pending Approval</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">New Status</div>
                        <div class="detail-value">Approved</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="closeModal('auditDetailModal')">Close</button>
            </div>
        </div>
    </div>

    <!-- Drill Down Modal -->
    <div id="drillDownModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Transaction Drill-Down</h2>
                <span class="close" onclick="closeModal('drillDownModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="transaction-trail">
                    <h3>Related Transactions for INV-2025-1001</h3>
                    
                    <div class="trail-item">
                        <div class="trail-icon" style="background-color: #e3f2fd;">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="trail-content">
                            <strong>Purchase Order Created</strong>
                            <div>PO-2025-0456 for office supplies</div>
                            <small>2025-09-10 09:15:30 by Robert Johnson</small>
                        </div>
                    </div>
                    
                    <div class="trail-item">
                        <div class="trail-icon" style="background-color: #e8f5e9;">
                            <i class="fas fa-truck-loading"></i>
                        </div>
                        <div class="trail-content">
                            <strong>Goods Received</strong>
                            <div>GRN-2025-0523 created upon delivery</div>
                            <small>2025-09-12 14:20:45 by System</small>
                        </div>
                    </div>
                    
                    <div class="trail-item">
                        <div class="trail-icon" style="background-color: #fff3e0;">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="trail-content">
                            <strong>Invoice Received</strong>
                            <div>INV-2025-1001 from ABC Suppliers</div>
                            <small>2025-09-15 11:05:20 by John Smith</small>
                        </div>
                    </div>
                    
                    <div class="trail-item">
                        <div class="trail-icon" style="background-color: #f3e5f5;">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <div class="trail-content">
                            <strong>3-Way Matching</strong>
                            <div>Invoice matched with PO and GRN</div>
                            <small>2025-09-16 10:30:15 by System</small>
                        </div>
                    </div>
                    
                    <div class="trail-item">
                        <div class="trail-icon" style="background-color: #e8eaf6;">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="trail-content">
                            <strong>Approval</strong>
                            <div>Invoice approved for payment</div>
                            <small>2025-09-28 14:32:15 by John Smith</small>
                        </div>
                    </div>
                    
                    <div class="trail-item">
                        <div class="trail-icon" style="background-color: #e0f2f1;">
                            <i class="fas fa-money-check"></i>
                        </div>
                        <div class="trail-content">
                            <strong>Payment Processed</strong>
                            <div>Check #10234 issued</div>
                            <small>2025-09-29 09:45:30 by System</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="closeModal('drillDownModal')">Close</button>
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
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
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

        // Refresh audit log function
        document.getElementById('refreshAuditLog').addEventListener('click', function() {
            // Show loading state
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Refreshing...';
            this.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
                alert('Audit log has been refreshed!');
            }, 1500);
        });

        // Set current date as default end date
        document.getElementById('endDate').valueAsDate = new Date();
        document.getElementById('reportEndDate').valueAsDate = new Date();
    </script>
</body>
</html>

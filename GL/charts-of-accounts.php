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
            --assets: #3498db;
            --liabilities: #e74c3c;
            --equity: #9b59b6;
            --revenue: #2ecc71;
            --expenses: #f39c12;
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

        .account-code {
            font-family: 'Montserrat', monospace;
            font-weight: 600;
        }

        .account-type {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .type-assets {
            background-color: var(--assets);
            color: white;
        }

        .type-liabilities {
            background-color: var(--liabilities);
            color: white;
        }

        .type-equity {
            background-color: var(--equity);
            color: white;
        }

        .type-revenue {
            background-color: var(--revenue);
            color: white;
        }

        .type-expenses {
            background-color: var(--expenses);
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
            max-width: 800px;
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

        /* Hierarchy Tree */
        .hierarchy-tree {
            margin: 20px 0;
        }

        .tree-node {
            margin-left: 20px;
            margin-bottom: 10px;
        }

        .tree-header {
            display: flex;
            align-items: center;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
            cursor: pointer;
            transition: var(--transition);
        }

        .tree-header:hover {
            background: #e9ecef;
        }

        .tree-toggle {
            margin-right: 10px;
            font-size: 0.8rem;
            transition: var(--transition);
        }

        .tree-toggle.rotated {
            transform: rotate(90deg);
        }

        .tree-content {
            margin-left: 30px;
            display: none;
        }

        .tree-content.expanded {
            display: block;
        }

        .tree-account {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            border-left: 2px solid #ddd;
            margin-bottom: 5px;
        }

        .tree-account-code {
            font-family: 'Montserrat', monospace;
            font-weight: 600;
            min-width: 80px;
        }

        .tree-account-name {
            flex: 1;
        }

        /* Mapping Visualization */
        .mapping-visualization {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin: 30px 0;
        }

        .mapping-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .mapping-source {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
        }

        .mapping-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .mapping-arrow {
            flex: 0 0 40px;
            text-align: center;
            font-size: 1.5rem;
            color: #7f8c8d;
        }

        .mapping-target {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            justify-content: flex-end;
        }

        .mapping-account {
            background: white;
            padding: 10px 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
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
            
            .mapping-row {
                flex-direction: column;
                gap: 15px;
            }
            
            .mapping-arrow {
                transform: rotate(90deg);
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
                <h1 class="page-title">Chart of Accounts Management</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card" onclick="setActiveTab('maintenance-tab')">
                        <div class="card-icon blue">
                            <i class="fas fa-list"></i>
                        </div>
                        <h3>Total Accounts</h3>
                        <p>142</p>
                        <small>Active in system</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('mapping-tab')">
                        <div class="card-icon green">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <h3>Mapped Modules</h3>
                        <p>5/5</p>
                        <small>All modules connected</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('hierarchy-tab')">
                        <div class="card-icon orange">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <h3>Account Categories</h3>
                        <p>5</p>
                        <small>Assets, Liabilities, Equity, Revenue, Expenses</small>
                    </div>
                    <div class="dashboard-card" onclick="openModal('addAccountModal')">
                        <div class="card-icon purple">
                            <i class="fas fa-plus"></i>
                        </div>
                        <h3>Add New Account</h3>
                        <p><i class="fas fa-arrow-right"></i></p>
                        <small>Create new GL account</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="maintenance">CoA Maintenance</div>
                    <div class="tab" data-tab="mapping">Account Mapping</div>
                    <div class="tab" data-tab="hierarchy">CoA Hierarchy</div>
                </div>

                <!-- CoA Maintenance Tab -->
                <div class="tab-content active" id="maintenance-tab">
                    <!-- Accounts Table Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Chart of Accounts</h2>
                            <div>
                                <button class="btn btn-primary" onclick="openModal('addAccountModal')"><i class="fas fa-plus"></i> Add Account</button>
                                <button class="btn btn-secondary"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="accountSearch" placeholder="Search account code, name, or type...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Account Type</span>
                                    <select class="filter-select" id="typeFilter">
                                        <option value="">All Types</option>
                                        <option value="assets">Assets</option>
                                        <option value="liabilities">Liabilities</option>
                                        <option value="equity">Equity</option>
                                        <option value="revenue">Revenue</option>
                                        <option value="expenses">Expenses</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="statusFilter">
                                        <option value="">All Statuses</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Account Code</th>
                                            <th>Account Name</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Balance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="account-code">1000</td>
                                            <td>Cash on Hand</td>
                                            <td><span class="account-type type-assets">Assets</span></td>
                                            <td>Physical currency and coins</td>
                                            <td><span class="status status-posted">Active</span></td>
                                            <td>₱125,000.00</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewAccountModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm" onclick="openModal('editAccountModal')"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="account-code">1100</td>
                                            <td>Bank Accounts</td>
                                            <td><span class="account-type type-assets">Assets</span></td>
                                            <td>Checking and savings accounts</td>
                                            <td><span class="status status-posted">Active</span></td>
                                            <td>₱2,450,000.00</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewAccountModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm" onclick="openModal('editAccountModal')"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="account-code">1200</td>
                                            <td>Accounts Receivable</td>
                                            <td><span class="account-type type-assets">Assets</span></td>
                                            <td>Amounts owed by customers</td>
                                            <td><span class="status status-posted">Active</span></td>
                                            <td>₱567,800.00</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewAccountModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm" onclick="openModal('editAccountModal')"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="account-code">2000</td>
                                            <td>Accounts Payable</td>
                                            <td><span class="account-type type-liabilities">Liabilities</span></td>
                                            <td>Amounts owed to vendors</td>
                                            <td><span class="status status-posted">Active</span></td>
                                            <td>₱389,500.00</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewAccountModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm" onclick="openModal('editAccountModal')"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="account-code">3000</td>
                                            <td>Owner's Equity</td>
                                            <td><span class="account-type type-equity">Equity</span></td>
                                            <td>Owner's investment in the business</td>
                                            <td><span class="status status-posted">Active</span></td>
                                            <td>₱5,000,000.00</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewAccountModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm" onclick="openModal('editAccountModal')"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="account-code">4000</td>
                                            <td>Sales Revenue</td>
                                            <td><span class="account-type type-revenue">Revenue</span></td>
                                            <td>Income from product sales</td>
                                            <td><span class="status status-posted">Active</span></td>
                                            <td>₱8,750,000.00</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewAccountModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm" onclick="openModal('editAccountModal')"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="account-code">5000</td>
                                            <td>Cost of Goods Sold</td>
                                            <td><span class="account-type type-expenses">Expenses</span></td>
                                            <td>Direct costs attributable to goods sold</td>
                                            <td><span class="status status-posted">Active</span></td>
                                            <td>₱4,250,000.00</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewAccountModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm" onclick="openModal('editAccountModal')"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="account-code">5100</td>
                                            <td>Operating Expenses</td>
                                            <td><span class="account-type type-expenses">Expenses</span></td>
                                            <td>General business operating costs</td>
                                            <td><span class="status status-posted">Active</span></td>
                                            <td>₱2,150,000.00</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewAccountModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm" onclick="openModal('editAccountModal')"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Mapping Tab -->
                <div class="tab-content" id="mapping-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Account Mapping Dashboard</h2>
                            <div>
                                <button class="btn btn-primary" onclick="openModal('addMappingModal')"><i class="fas fa-link"></i> Add Mapping</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mapping-visualization">
                                <div class="mapping-row">
                                    <div class="mapping-source">
                                        <div class="mapping-icon" style="background: var(--accent);">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </div>
                                        <div>
                                            <strong>Accounts Payable</strong>
                                            <div>Vendor Invoices</div>
                                        </div>
                                    </div>
                                    <div class="mapping-arrow">
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </div>
                                    <div class="mapping-target">
                                        <div class="mapping-account">
                                            <span class="account-code">2000</span> Accounts Payable
                                        </div>
                                        <button class="btn btn-primary btn-sm" onclick="openModal('editMappingModal')"><i class="fas fa-edit"></i></button>
                                    </div>
                                </div>

                                <div class="mapping-row">
                                    <div class="mapping-source">
                                        <div class="mapping-icon" style="background: var(--success);">
                                            <i class="fas fa-receipt"></i>
                                        </div>
                                        <div>
                                            <strong>Accounts Receivable</strong>
                                            <div>Customer Invoices</div>
                                        </div>
                                    </div>
                                    <div class="mapping-arrow">
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </div>
                                    <div class="mapping-target">
                                        <div class="mapping-account">
                                            <span class="account-code">1200</span> Accounts Receivable
                                        </div>
                                        <button class="btn btn-primary btn-sm" onclick="openModal('editMappingModal')"><i class="fas fa-edit"></i></button>
                                    </div>
                                </div>

                                <div class="mapping-row">
                                    <div class="mapping-source">
                                        <div class="mapping-icon" style="background: var(--warning);">
                                            <i class="fas fa-money-check"></i>
                                        </div>
                                        <div>
                                            <strong>Payroll</strong>
                                            <div>Salary Disbursements</div>
                                        </div>
                                    </div>
                                    <div class="mapping-arrow">
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </div>
                                    <div class="mapping-target">
                                        <div class="mapping-account">
                                            <span class="account-code">5100</span> Operating Expenses
                                        </div>
                                        <button class="btn btn-primary btn-sm" onclick="openModal('editMappingModal')"><i class="fas fa-edit"></i></button>
                                    </div>
                                </div>

                                <div class="mapping-row">
                                    <div class="mapping-source">
                                        <div class="mapping-icon" style="background: var(--secondary);">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                        <div>
                                            <strong>Payment Gateway</strong>
                                            <div>Customer Payments</div>
                                        </div>
                                    </div>
                                    <div class="mapping-arrow">
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </div>
                                    <div class="mapping-target">
                                        <div class="mapping-account">
                                            <span class="account-code">1100</span> Bank Accounts
                                        </div>
                                        <button class="btn btn-primary btn-sm" onclick="openModal('editMappingModal')"><i class="fas fa-edit"></i></button>
                                    </div>
                                </div>

                                <div class="mapping-row">
                                    <div class="mapping-source">
                                        <div class="mapping-icon" style="background: var(--purple);">
                                            <i class="fas fa-undo"></i>
                                        </div>
                                        <div>
                                            <strong>Refunds</strong>
                                            <div>Customer Refunds</div>
                                        </div>
                                    </div>
                                    <div class="mapping-arrow">
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </div>
                                    <div class="mapping-target">
                                        <div class="mapping-account">
                                            <span class="account-code">2000</span> Accounts Payable
                                        </div>
                                        <button class="btn btn-primary btn-sm" onclick="openModal('editMappingModal')"><i class="fas fa-edit"></i></button>
                                    </div>
                                </div>
                            </div>

                            <h3 class="form-label" style="margin-top: 30px;">Mapping Rules</h3>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Module</th>
                                            <th>Transaction Type</th>
                                            <th>Default Account</th>
                                            <th>Condition</th>
                                            <th>Override Account</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Accounts Payable</td>
                                            <td>Vendor Invoice</td>
                                            <td>2000 - Accounts Payable</td>
                                            <td>All invoices</td>
                                            <td>-</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Accounts Receivable</td>
                                            <td>Customer Invoice</td>
                                            <td>1200 - Accounts Receivable</td>
                                            <td>All invoices</td>
                                            <td>-</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Accounts Receivable</td>
                                            <td>Customer Payment</td>
                                            <td>1100 - Bank Accounts</td>
                                            <td>Payment method = Credit Card</td>
                                            <td>1000 - Cash on Hand</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Payroll</td>
                                            <td>Salary Disbursement</td>
                                            <td>5100 - Operating Expenses</td>
                                            <td>Employee type = Regular</td>
                                            <td>5200 - Contract Labor</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CoA Hierarchy Tab -->
                <div class="tab-content" id="hierarchy-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Chart of Accounts Hierarchy</h2>
                            <div>
                                <button class="btn btn-primary"><i class="fas fa-expand"></i> Expand All</button>
                                <button class="btn btn-secondary"><i class="fas fa-compress"></i> Collapse All</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="hierarchy-tree">
                                <!-- Assets -->
                                <div class="tree-node">
                                    <div class="tree-header" onclick="toggleTree('assets')">
                                        <span class="tree-toggle"><i class="fas fa-chevron-right"></i></span>
                                        <span class="account-type type-assets">Assets</span>
                                        <span style="margin-left: 10px;">(1000-1999)</span>
                                    </div>
                                    <div class="tree-content" id="assets">
                                        <div class="tree-account">
                                            <span class="tree-account-code">1000</span>
                                            <span class="tree-account-name">Cash on Hand</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">1100</span>
                                            <span class="tree-account-name">Bank Accounts</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">1200</span>
                                            <span class="tree-account-name">Accounts Receivable</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">1300</span>
                                            <span class="tree-account-name">Inventory</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">1400</span>
                                            <span class="tree-account-name">Prepaid Expenses</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">1500</span>
                                            <span class="tree-account-name">Property, Plant & Equipment</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Liabilities -->
                                <div class="tree-node">
                                    <div class="tree-header" onclick="toggleTree('liabilities')">
                                        <span class="tree-toggle"><i class="fas fa-chevron-right"></i></span>
                                        <span class="account-type type-liabilities">Liabilities</span>
                                        <span style="margin-left: 10px;">(2000-2999)</span>
                                    </div>
                                    <div class="tree-content" id="liabilities">
                                        <div class="tree-account">
                                            <span class="tree-account-code">2000</span>
                                            <span class="tree-account-name">Accounts Payable</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">2100</span>
                                            <span class="tree-account-name">Accrued Expenses</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">2200</span>
                                            <span class="tree-account-name">Short-term Loans</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">2300</span>
                                            <span class="tree-account-name">Long-term Debt</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Equity -->
                                <div class="tree-node">
                                    <div class="tree-header" onclick="toggleTree('equity')">
                                        <span class="tree-toggle"><i class="fas fa-chevron-right"></i></span>
                                        <span class="account-type type-equity">Equity</span>
                                        <span style="margin-left: 10px;">(3000-3999)</span>
                                    </div>
                                    <div class="tree-content" id="equity">
                                        <div class="tree-account">
                                            <span class="tree-account-code">3000</span>
                                            <span class="tree-account-name">Owner's Equity</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">3100</span>
                                            <span class="tree-account-name">Retained Earnings</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Revenue -->
                                <div class="tree-node">
                                    <div class="tree-header" onclick="toggleTree('revenue')">
                                        <span class="tree-toggle"><i class="fas fa-chevron-right"></i></span>
                                        <span class="account-type type-revenue">Revenue</span>
                                        <span style="margin-left: 10px;">(4000-4999)</span>
                                    </div>
                                    <div class="tree-content" id="revenue">
                                        <div class="tree-account">
                                            <span class="tree-account-code">4000</span>
                                            <span class="tree-account-name">Sales Revenue</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">4100</span>
                                            <span class="tree-account-name">Service Revenue</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">4200</span>
                                            <span class="tree-account-name">Interest Income</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Expenses -->
                                <div class="tree-node">
                                    <div class="tree-header" onclick="toggleTree('expenses')">
                                        <span class="tree-toggle"><i class="fas fa-chevron-right"></i></span>
                                        <span class="account-type type-expenses">Expenses</span>
                                        <span style="margin-left: 10px;">(5000-5999)</span>
                                    </div>
                                    <div class="tree-content" id="expenses">
                                        <div class="tree-account">
                                            <span class="tree-account-code">5000</span>
                                            <span class="tree-account-name">Cost of Goods Sold</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">5100</span>
                                            <span class="tree-account-name">Operating Expenses</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">5200</span>
                                            <span class="tree-account-name">Contract Labor</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">5300</span>
                                            <span class="tree-account-name">Depreciation</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                        <div class="tree-account">
                                            <span class="tree-account-code">5400</span>
                                            <span class="tree-account-name">Interest Expense</span>
                                            <span class="status status-posted" style="margin-left: auto;">Active</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Chart of Accounts Management</p>
            </div>
        </div>
    </div>

    <!-- Add Account Modal -->
    <div id="addAccountModal" class="modal">
        <div class="modal-content" style="max-width: 700px;">
            <div class="modal-header">
                <h2 class="modal-title">Add New Account</h2>
                <span class="close" onclick="closeModal('addAccountModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="addAccountForm">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Account Code</label>
                                <input type="text" class="form-control" placeholder="e.g., 1100">
                                <small>Must be unique and follow numbering convention</small>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Account Name</label>
                                <input type="text" class="form-control" placeholder="e.g., Bank Accounts">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Account Type</label>
                                <select class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="assets">Assets</option>
                                    <option value="liabilities">Liabilities</option>
                                    <option value="equity">Equity</option>
                                    <option value="revenue">Revenue</option>
                                    <option value="expenses">Expenses</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Parent Account</label>
                                <select class="form-control">
                                    <option value="">No Parent (Top Level)</option>
                                    <option value="1000">1000 - Cash on Hand</option>
                                    <option value="1100">1100 - Bank Accounts</option>
                                    <option value="1200">1200 - Accounts Receivable</option>
                                    <option value="2000">2000 - Accounts Payable</option>
                                    <option value="5100">5100 - Operating Expenses</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" placeholder="Detailed description of this account..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Normal Balance</label>
                        <div>
                            <label style="display: inline-flex; align-items: center; margin-right: 20px;">
                                <input type="radio" name="balance" value="debit" checked> Debit
                            </label>
                            <label style="display: inline-flex; align-items: center;">
                                <input type="radio" name="balance" value="credit"> Credit
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div>
                            <label style="display: inline-flex; align-items: center; margin-right: 20px;">
                                <input type="radio" name="status" value="active" checked> Active
                            </label>
                            <label style="display: inline-flex; align-items: center;">
                                <input type="radio" name="status" value="inactive"> Inactive
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Restrictions</label>
                        <div>
                            <label style="display: flex; align-items: center; margin-bottom: 10px;">
                                <input type="checkbox" style="margin-right: 10px;"> Require approval for journal entries
                            </label>
                            <label style="display: flex; align-items: center; margin-bottom: 10px;">
                                <input type="checkbox" style="margin-right: 10px;"> Cannot be used for manual entries
                            </label>
                            <label style="display: flex; align-items: center;">
                                <input type="checkbox" style="margin-right: 10px;"> System-managed only
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('addAccountModal')">Cancel</button>
                <button class="btn btn-primary">Create Account</button>
            </div>
        </div>
    </div>

    <!-- View Account Modal -->
    <div id="viewAccountModal" class="modal">
        <div class="modal-content" style="max-width: 700px;">
            <div class="modal-header">
                <h2 class="modal-title">Account Details</h2>
                <span class="close" onclick="closeModal('viewAccountModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Account Code</label>
                            <p class="account-code">1100</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Account Name</label>
                            <p>Bank Accounts</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Account Type</label>
                            <p><span class="account-type type-assets">Assets</span></p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Normal Balance</label>
                            <p>Debit</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <p>Checking and savings accounts held at financial institutions</p>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Current Balance</label>
                            <p>₱2,450,000.00</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <p><span class="status status-posted">Active</span></p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Mapped Modules</label>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <span class="status" style="background: var(--accent);">Accounts Payable</span>
                        <span class="status" style="background: var(--success);">Accounts Receivable</span>
                        <span class="status" style="background: var(--secondary);">Payment Gateway</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Transaction History (Last 30 days)</label>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2025-09-05</td>
                                    <td>Customer payment - INV-2025-086</td>
                                    <td>₱8,750.00</td>
                                    <td>-</td>
                                    <td>₱2,450,000.00</td>
                                </tr>
                                <tr>
                                    <td>2025-09-04</td>
                                    <td>Vendor payment - INV-2025-084</td>
                                    <td>-</td>
                                    <td>₱15,200.00</td>
                                    <td>₱2,441,250.00</td>
                                </tr>
                                <tr>
                                    <td>2025-09-03</td>
                                    <td>Payroll disbursement</td>
                                    <td>-</td>
                                    <td>₱289,400.00</td>
                                    <td>₱2,456,450.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('viewAccountModal')">Close</button>
                <button class="btn btn-primary" onclick="openModal('editAccountModal'); closeModal('viewAccountModal');">Edit Account</button>
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
                if (this.querySelector('h3').textContent.includes('Total')) {
                    setActiveTab('maintenance-tab');
                } else if (this.querySelector('h3').textContent.includes('Mapped')) {
                    setActiveTab('mapping-tab');
                } else if (this.querySelector('h3').textContent.includes('Account')) {
                    setActiveTab('hierarchy-tab');
                }
            });
        });

        // Tree toggle functionality
        function toggleTree(treeId) {
            const treeContent = document.getElementById(treeId);
            const treeToggle = treeContent.previousElementSibling.querySelector('.tree-toggle');
            
            treeContent.classList.toggle('expanded');
            treeToggle.classList.toggle('rotated');
        }

        // Expand all trees
        document.querySelector('.btn-primary').addEventListener('click', function() {
            if (this.querySelector('i').classList.contains('fa-expand')) {
                document.querySelectorAll('.tree-content').forEach(content => {
                    content.classList.add('expanded');
                    content.previousElementSibling.querySelector('.tree-toggle').classList.add('rotated');
                });
            }
        });

        // Collapse all trees
        document.querySelector('.btn-secondary').addEventListener('click', function() {
            if (this.querySelector('i').classList.contains('fa-compress')) {
                document.querySelectorAll('.tree-content').forEach(content => {
                    content.classList.remove('expanded');
                    content.previousElementSibling.querySelector('.tree-toggle').classList.remove('rotated');
                });
            }
        });

        // Initialize with first tree expanded
        document.addEventListener('DOMContentLoaded', function() {
            toggleTree('assets');
        });
    </script>
</body>
</html>

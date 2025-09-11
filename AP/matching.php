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
            --matched: #2ecc71;
            --partial: #f39c12;
            --mismatched: #e74c3c;
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
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            min-width: 120px;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .status-matched {
            background-color: var(--success);
            color: white;
        }

        .status-partial {
            background-color: var(--warning);
            color: white;
        }

        .status-mismatched {
            background-color: var(--accent);
            color: white;
        }

        .status-pending {
            background-color: #ffeaa7;
            color: #d35400;
        }

        .status-escalated {
            background-color: #6c5ce7;
            color: white;
        }

        /* Buttons */
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            font-family: 'Lato', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        .btn i {
            margin-right: 6px;
            font-size: 0.9rem;
        }

        .btn-sm {
            padding: 6px 10px;
            font-size: 0.85rem;
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

        /* Action buttons container */
        .action-buttons {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
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
            margin: 2% auto;
            padding: 0;
            border-radius: 10px;
            width: 95%;
            max-width: 1200px;
            max-height: 90vh;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            animation: modalFade 0.3s;
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
            flex-shrink: 0;
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
            overflow-y: auto;
            flex-grow: 1;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-shrink: 0;
        }

        /* Comparison Table */
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 0.9rem;
        }

        .comparison-table th, .comparison-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #eee;
        }

        .comparison-table th {
            background-color: #f8f9fa;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }

        .match-exact {
            background-color: rgba(46, 204, 113, 0.1);
        }

        .match-partial {
            background-color: rgba(243, 156, 18, 0.1);
        }

        .match-none {
            background-color: rgba(231, 76, 60, 0.1);
        }

        /* Exception Queue Filters */
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

        /* Tolerance Settings */
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
                width: 98%;
                margin: 1% auto;
            }
            
            .tabs {
                flex-wrap: wrap;
            }
            
            .tab {
                flex: 1;
                text-align: center;
                padding: 10px;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 4px;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
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
                <h1 class="page-title">3-Way Matching System</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h3>Total Invoices</h3>
                        <p>142</p>
                        <small>This month</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Matched</h3>
                        <p>98</p>
                        <small>69% of invoices</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>Partially Matched</h3>
                        <p>24</p>
                        <small>17% of invoices</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>Mismatched</h3>
                        <p>20</p>
                        <small>14% of invoices</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="invoices">Invoice Matching</div>
                    <div class="tab" data-tab="exceptions">Exception Queue</div>
                    <div class="tab" data-tab="settings">Tolerance Settings</div>
                </div>

                <!-- Invoice Matching Tab -->
                <div class="tab-content active" id="invoices-tab">
                    <!-- Invoice Table Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Invoice Matching</h2>
                            <div>
                                <button class="btn btn-download" id="downloadCSV"><i class="fas fa-download"></i> CSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="invoiceSearch" placeholder="Search Vendor, Invoice #, PO #, GRN, or Status...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Vendor</th>
                                            <th>Invoice #</th>
                                            <th>PO #</th>
                                            <th>GRN #</th>
                                            <th>Invoice Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ABC Suppliers</td>
                                            <td>INV-2025-001</td>
                                            <td>PO-2025-085</td>
                                            <td>GRN-2025-092</td>
                                            <td>2025-09-01</td>
                                            <td>₱12,500.00</td>
                                            <td><span class="status status-matched">Matched</span></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                    <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                                    <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>XYZ Technologies</td>
                                            <td>INV-2025-002</td>
                                            <td>PO-2025-086</td>
                                            <td>GRN-2025-093</td>
                                            <td>2025-09-02</td>
                                            <td>₱8,750.00</td>
                                            <td><span class="status status-partial">Partially Matched</span></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                    <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                                    <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Global Equipment</td>
                                            <td>INV-2025-003</td>
                                            <td>PO-2025-087</td>
                                            <td>GRN-2025-094</td>
                                            <td>2025-09-03</td>
                                            <td>₱15,200.00</td>
                                            <td><span class="status status-mismatched">Mismatched</span></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                    <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                                    <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Office Supplies Co.</td>
                                            <td>INV-2025-004</td>
                                            <td>PO-2025-088</td>
                                            <td>GRN-2025-095</td>
                                            <td>2025-09-04</td>
                                            <td>₱9,800.00</td>
                                            <td><span class="status status-pending">Pending Review</span></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                    <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                                    <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tech Solutions Inc.</td>
                                            <td>INV-2025-005</td>
                                            <td>PO-2025-089</td>
                                            <td>GRN-2025-096</td>
                                            <td>2025-09-05</td>
                                            <td>₱22,500.00</td>
                                            <td><span class="status status-escalated">Escalated to CFO</span></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                                    <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i></button>
                                                    <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exception Queue Tab -->
                <div class="tab-content" id="exceptions-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Exception Queue</h2>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Mismatch Reason</span>
                                    <select class="filter-select" id="reasonFilter">
                                        <option value="">All Reasons</option>
                                        <option value="price">Price Variance</option>
                                        <option value="quantity">Quantity Variance</option>
                                        <option value="missing">Missing GRN</option>
                                        <option value="tax">Tax Mismatch</option>
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
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="statusFilter">
                                        <option value="">All Status</option>
                                        <option value="pending">Pending Review</option>
                                        <option value="escalated">Escalated</option>
                                        <option value="returned">Returned to Vendor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Vendor</th>
                                            <th>Invoice #</th>
                                            <th>PO #</th>
                                            <th>GRN #</th>
                                            <th>Issue Type</th>
                                            <th>Amount</th>
                                            <th>Variance</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>XYZ Technologies</td>
                                            <td>INV-2025-002</td>
                                            <td>PO-2025-086</td>
                                            <td>GRN-2025-093</td>
                                            <td>Price Variance</td>
                                            <td>₱8,750.00</td>
                                            <td>₱350.00 (4%)</td>
                                            <td><span class="status status-pending">Pending Review</span></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i> Director</button>
                                                    <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i> CFO</button>
                                                    <button class="btn btn-reject btn-sm"><i class="fas fa-undo"></i> Vendor</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Global Equipment</td>
                                            <td>INV-2025-003</td>
                                            <td>PO-2025-087</td>
                                            <td>GRN-2025-094</td>
                                            <td>Quantity Variance</td>
                                            <td>₱15,200.00</td>
                                            <td>3 units (15%)</td>
                                            <td><span class="status status-escalated">Escalated to Director</span></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i> Director</button>
                                                    <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i> CFO</button>
                                                    <button class="btn btn-reject btn-sm"><i class="fas fa-undo"></i> Vendor</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tech Solutions Inc.</td>
                                            <td>INV-2025-005</td>
                                            <td>PO-2025-089</td>
                                            <td>GRN-2025-096</td>
                                            <td>Tax Mismatch</td>
                                            <td>₱22,500.00</td>
                                            <td>₱1,125.00 (5%)</td>
                                            <td><span class="status status-pending">Pending Review</span></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i> Director</button>
                                                    <button class="btn btn-escalate btn-sm"><i class="fas fa-level-up-alt"></i> CFO</button>
                                                    <button class="btn btn-reject btn-sm"><i class="fas fa-undo"></i> Vendor</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tolerance Settings Tab -->
                <div class="tab-content" id="settings-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Tolerance Settings</h2>
                        </div>
                        <div class="card-body">
                            <div class="tolerance-form">
                                <div class="form-group">
                                    <label class="form-label">Price Variance Tolerance (%)</label>
                                    <input type="number" class="form-control" value="2" step="0.1" min="0" max="100">
                                    <small>Allowable percentage difference between invoice price and PO price</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Quantity Variance Tolerance (Units)</label>
                                    <input type="number" class="form-control" value="1" step="1" min="0" max="100">
                                    <small>Allowable unit difference between received quantity and invoiced quantity</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tax Variance Tolerance (%)</label>
                                    <input type="number" class="form-control" value="1" step="0.1" min="0" max="100">
                                    <small>Allowable percentage difference in tax calculations</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Auto-approve Matched Invoices</label>
                                    <select class="form-control">
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    <small>Automatically approve invoices that match within tolerance limits</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Escalation Threshold (Amount)</label>
                                    <input type="number" class="form-control" value="10000" step="100" min="0">
                                    <small>Amount threshold for automatic escalation to manager</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">CFO Escalation Threshold (Amount)</label>
                                    <input type="number" class="form-control" value="50000" step="100" min="0">
                                    <small>Amount threshold for automatic escalation to CFO</small>
                                </div>
                            </div>
                            <div style="margin-top: 20px; text-align: right;">
                                <button class="btn btn-secondary">Reset to Defaults</button>
                                <button class="btn btn-primary">Save Settings</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - 3-Way Matching</p>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">3-Way Matching Details</h2>
                <span class="close" onclick="closeModal('viewModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Vendor</label>
                            <p>XYZ Technologies</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Invoice #</label>
                            <p>INV-2025-002</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">PO #</label>
                            <p>PO-2025-086</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">GRN #</label>
                            <p>GRN-2025-093</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Invoice Date</label>
                            <p>2025-09-02</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Invoice Amount</label>
                            <p>₱8,750.00</p>
                        </div>
                    </div>
                </div>

                <h3 class="form-label">3-Way Comparison</h3>
                <div class="table-responsive">
                    <table class="comparison-table">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Invoice Qty</th>
                                <th>Invoice Price</th>
                                <th>Invoice Tax</th>
                                <th>Invoice Total</th>
                                <th>PO Qty</th>
                                <th>PO Price</th>
                                <th>PO Tax</th>
                                <th>GRN Qty</th>
                                <th>GRN Date</th>
                                <th>Variance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="match-exact">
                                <td>Laptop Computer</td>
                                <td>5</td>
                                <td>₱25,000.00</td>
                                <td>12%</td>
                                <td>₱140,000.00</td>
                                <td>5</td>
                                <td>₱25,000.00</td>
                                <td>12%</td>
                                <td>5</td>
                                <td>2025-08-25</td>
                                <td>None</td>
                            </tr>
                            <tr class="match-partial">
                                <td>Wireless Mouse</td>
                                <td>10</td>
                                <td>₱1,200.00</td>
                                <td>12%</td>
                                <td>₱13,440.00</td>
                                <td>10</td>
                                <td>₱1,150.00</td>
                                <td>12%</td>
                                <td>10</td>
                                <td>2025-08-25</td>
                                <td>Price: ₱50.00 (4.3%)</td>
                            </tr>
                            <tr class="match-none">
                                <td>Keyboard</td>
                                <td>8</td>
                                <td>₱850.00</td>
                                <td>12%</td>
                                <td>₱7,616.00</td>
                                <td>10</td>
                                <td>₱850.00</td>
                                <td>12%</td>
                                <td>8</td>
                                <td>2025-08-25</td>
                                <td>Qty: 2 units (20%)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label class="form-label">Matching Summary</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>Status:</strong> <span class="status status-partial">Partially Matched</span></p>
                        <p><strong>Issues Found:</strong> Price variance on Wireless Mouse (4.3% vs 2% tolerance), Quantity variance on Keyboard (20% vs 10% tolerance)</p>
                        <p><strong>Recommendation:</strong> Approve with adjustments or return to vendor for correction</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('viewModal')">Close</button>
                <button type="button" class="btn btn-primary">Print Report</button>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Reject Invoice Matching</h2>
                <span class="close" onclick="closeModal('rejectModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Vendor</label>
                    <p>XYZ Technologies</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Invoice #</label>
                    <p>INV-2025-002</p>
                </div>
                <div class="form-group">
                    <label class="form-label">PO #</label>
                    <p>PO-2025-086</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="rejectReason">Reason for Rejection</label>
                    <select class="form-control" id="rejectReason">
                        <option value="">Select a reason</option>
                        <option value="price">Price Variance Exceeds Tolerance</option>
                        <option value="quantity">Quantity Variance Exceeds Tolerance</option>
                        <option value="tax">Tax Calculation Error</option>
                        <option value="missing">Missing GRN Reference</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="rejectDetails">Additional Details</label>
                    <textarea class="form-control" id="rejectDetails" rows="4" placeholder="Please provide additional details for the rejection"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Action</label>
                    <div style="display: flex; gap: 10px;">
                        <button class="btn btn-reject"><i class="fas fa-undo"></i> Return to Vendor</button>
                        <button class="btn btn-escalate"><i class="fas fa-level-up-alt"></i> Escalate to Manager</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('rejectModal')">Cancel</button>
                <button type="button" class="btn btn-danger">Confirm Rejection</button>
            </div>
        </div>
    </div>

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
        document.getElementById('invoiceSearch').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('#invoices-tab tbody tr');
            
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

        // Filter functionality for exception queue
        const filters = document.querySelectorAll('.filter-select');
        filters.forEach(filter => {
            filter.addEventListener('change', filterExceptionQueue);
        });

        function filterExceptionQueue() {
            const reasonFilter = document.getElementById('reasonFilter').value;
            const vendorFilter = document.getElementById('vendorFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            
            const rows = document.querySelectorAll('#exceptions-tab tbody tr');
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const issueType = cells[4].textContent.toLowerCase();
                const vendor = cells[0].textContent.toLowerCase();
                const status = cells[7].querySelector('.status').textContent.toLowerCase();
                
                let showRow = true;
                
                // Check reason filter
                if (reasonFilter && !issueType.includes(reasonFilter)) {
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
    </script>

</div>

<script src="../PANEL/ASSETS/js/script-p.js"></script>
</body>
</html>

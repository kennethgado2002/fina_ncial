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
            --sent: #3498db;
            --paid: #2ecc71;
            --overdue: #e74c3c;
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

        .card-icon.gray {
            background-color: rgba(149, 165, 166, 0.2);
            color: #7f8c8d;
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

        .status-sent {
            background-color: var(--sent);
            color: white;
        }

        .status-paid {
            background-color: var(--paid);
            color: white;
        }

        .status-overdue {
            background-color: var(--overdue);
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

        /* Product Table */
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .product-table th, .product-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #eee;
        }

        .product-table th {
            background-color: #f8f9fa;
            font-family: 'Montserrat', sans-serif;
        }

        .product-table input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        /* Summary Section */
        .summary-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .summary-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
        }

        .summary-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .summary-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
        }

        /* Invoice Template */
        .invoice-template {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .invoice-logo {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary);
        }

        .invoice-details {
            text-align: right;
        }

        .invoice-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .invoice-number {
            font-family: 'Lato', sans-serif;
            color: #7f8c8d;
        }

        .invoice-to-from {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .invoice-address {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .invoice-address-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .invoice-items {
            margin: 30px 0;
        }

        .invoice-totals {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 30px;
        }

        .invoice-total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .invoice-total-label {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }

        .invoice-total-amount {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }

        .invoice-grand-total {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            margin-top: 15px;
            border-top: 2px solid var(--dark);
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--dark);
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
            
            .invoice-header {
                flex-direction: column;
                gap: 20px;
            }
            
            .invoice-details {
                text-align: left;
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
                <h1 class="page-title">Customer Invoicing</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card" onclick="setActiveTab('invoices-tab')">
                        <div class="card-icon blue">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h3>Total Invoices</h3>
                        <p>247</p>
                        <small>This month</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('invoices-tab', 'paid')">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Paid</h3>
                        <p>184</p>
                        <small>74% of invoices</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('invoices-tab', 'pending')">
                        <div class="card-icon orange">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Pending</h3>
                        <p>42</p>
                        <small>17% of invoices</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('invoices-tab', 'overdue')">
                        <div class="card-icon red">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>Overdue</h3>
                        <p>21</p>
                        <small>9% of invoices</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="invoices">Invoice Dashboard</div>
                    <div class="tab" data-tab="create">Create Invoice</div>
                    <div class="tab" data-tab="batch">Batch Generator</div>
                    <div class="tab" data-tab="templates">Templates</div>
                </div>

                <!-- Invoice Dashboard Tab -->
                <div class="tab-content active" id="invoices-tab">
                    <!-- Invoice Table Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Invoice List</h2>
                            <div>
                                <button class="btn btn-primary" onclick="openModal('createModal')"><i class="fas fa-plus"></i> New Invoice</button>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="invoiceSearch" placeholder="Search Customer ID, Invoice #, Order No., or Status...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="statusFilter">
                                        <option value="">All Statuses</option>
                                        <option value="draft">Draft</option>
                                        <option value="pending">Pending Approval</option>
                                        <option value="sent">Sent</option>
                                        <option value="paid">Paid</option>
                                        <option value="overdue">Overdue</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <select class="filter-select" id="dateFilter">
                                        <option value="">All Dates</option>
                                        <option value="today">Today</option>
                                        <option value="week">This Week</option>
                                        <option value="month">This Month</option>
                                        <option value="quarter">This Quarter</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Invoice #</th>
                                            <th>Customer</th>
                                            <th>Order #</th>
                                            <th>Invoice Date</th>
                                            <th>Due Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>INV-2025-1001</td>
                                            <td>John Smith</td>
                                            <td>ORD-2025-085</td>
                                            <td>2025-09-01</td>
                                            <td>2025-09-15</td>
                                            <td>₱12,500.00</td>
                                            <td><span class="status status-paid">Paid</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-envelope"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>INV-2025-1002</td>
                                            <td>Maria Garcia</td>
                                            <td>ORD-2025-086</td>
                                            <td>2025-09-02</td>
                                            <td>2025-09-16</td>
                                            <td>₱8,750.00</td>
                                            <td><span class="status status-sent">Sent</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-envelope"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>INV-2025-1003</td>
                                            <td>Robert Johnson</td>
                                            <td>ORD-2025-087</td>
                                            <td>2025-09-03</td>
                                            <td>2025-09-17</td>
                                            <td>₱15,200.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-envelope"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>INV-2025-1004</td>
                                            <td>Sarah Williams</td>
                                            <td>ORD-2025-088</td>
                                            <td>2025-09-04</td>
                                            <td>2025-09-18</td>
                                            <td>₱9,800.00</td>
                                            <td><span class="status status-overdue">Overdue</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-envelope"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>INV-2025-1005</td>
                                            <td>Michael Brown</td>
                                            <td>ORD-2025-089</td>
                                            <td>2025-09-05</td>
                                            <td>2025-09-19</td>
                                            <td>₱22,500.00</td>
                                            <td><span class="status status-draft">Draft</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                                <button class="btn btn-secondary btn-sm"><i class="fas fa-envelope"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create Invoice Tab -->
                <div class="tab-content" id="create-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Create New Invoice</h2>
                        </div>
                        <div class="card-body">
                            <form id="invoiceForm">
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Customer ID/Name</label>
                                            <input type="text" class="form-control" placeholder="Search customer...">
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Order Number</label>
                                            <input type="text" class="form-control" placeholder="Order reference...">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Invoice Date</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Due Date</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <h3 class="form-label" style="margin-bottom: 15px;">Products/Services</h3>
                                <div class="table-responsive">
                                    <table class="product-table">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Description</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Tax</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" placeholder="Item code"></td>
                                                <td><input type="text" placeholder="Item description"></td>
                                                <td><input type="number" placeholder="Qty" value="1"></td>
                                                <td><input type="number" placeholder="0.00" step="0.01"></td>
                                                <td>
                                                    <select class="form-control">
                                                        <option value="0">0%</option>
                                                        <option value="12" selected>12% VAT</option>
                                                        <option value="18">18% GST</option>
                                                    </select>
                                                </td>
                                                <td>₱0.00</td>
                                                <td><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7" style="text-align: center;">
                                                    <button type="button" class="btn btn-secondary"><i class="fas fa-plus"></i> Add Item</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Discount</label>
                                            <input type="number" class="form-control" placeholder="0.00" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Shipping/Delivery</label>
                                            <input type="number" class="form-control" placeholder="0.00" step="0.01">
                                        </div>
                                    </div>
                                </div>

                                <div class="summary-section">
                                    <div class="summary-card">
                                        <div class="summary-title">Subtotal</div>
                                        <div class="summary-value">₱0.00</div>
                                    </div>
                                    <div class="summary-card">
                                        <div class="summary-title">Tax</div>
                                        <div class="summary-value">₱0.00</div>
                                    </div>
                                    <div class="summary-card">
                                        <div class="summary-title">Discount</div>
                                        <div class="summary-value">-₱0.00</div>
                                    </div>
                                    <div class="summary-card">
                                        <div class="summary-title">Grand Total</div>
                                        <div class="summary-value">₱0.00</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Notes</label>
                                    <textarea class="form-control" rows="3" placeholder="Additional notes for the customer..."></textarea>
                                </div>

                                <div style="margin-top: 20px; text-align: right;">
                                    <button type="button" class="btn btn-secondary">Save as Draft</button>
                                    <button type="button" class="btn btn-primary">Preview</button>
                                    <button type="button" class="btn btn-success">Save & Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Batch Generator Tab -->
                <div class="tab-content" id="batch-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Batch Invoice Generator</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Select Orders for Invoicing</label>
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="selectAll"></th>
                                                <th>Order #</th>
                                                <th>Customer</th>
                                                <th>Order Date</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>ORD-2025-090</td>
                                                <td>James Wilson</td>
                                                <td>2025-09-01</td>
                                                <td>₱7,800.00</td>
                                                <td>Ready for Invoicing</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>ORD-2025-091</td>
                                                <td>Linda Martinez</td>
                                                <td>2025-09-02</td>
                                                <td>₱12,400.00</td>
                                                <td>Ready for Invoicing</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>ORD-2025-092</td>
                                                <td>William Taylor</td>
                                                <td>2025-09-02</td>
                                                <td>₱9,500.00</td>
                                                <td>Ready for Invoicing</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>ORD-2025-093</td>
                                                <td>Elizabeth Anderson</td>
                                                <td>2025-09-03</td>
                                                <td>₱15,300.00</td>
                                                <td>Ready for Invoicing</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Invoice Date</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Due Date</label>
                                        <select class="form-control">
                                            <option value="15">15 days</option>
                                            <option value="30" selected>30 days</option>
                                            <option value="45">45 days</option>
                                            <option value="60">60 days</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 20px; text-align: right;">
                                <button type="button" class="btn btn-secondary">Preview Selected</button>
                                <button type="button" class="btn btn-primary">Generate Invoices</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Templates Tab -->
                <div class="tab-content" id="templates-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Invoice Templates</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Select Template</label>
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="template-preview" style="border: 2px solid #ddd; border-radius: 8px; padding: 15px; text-align: center; cursor: pointer; transition: var(--transition);">
                                            <div style="font-size: 3rem; color: #3498db; margin-bottom: 10px;">
                                                <i class="fas fa-file-invoice"></i>
                                            </div>
                                            <h3 style="font-family: 'Montserrat', sans-serif;">Standard Template</h3>
                                            <p>Professional layout with company branding</p>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="template-preview" style="border: 2px solid #ddd; border-radius: 8px; padding: 15px; text-align: center; cursor: pointer; transition: var(--transition);">
                                            <div style="font-size: 3rem; color: #2ecc71; margin-bottom: 10px;">
                                                <i class="fas fa-receipt"></i>
                                            </div>
                                            <h3 style="font-family: 'Montserrat', sans-serif;">Simplified Template</h3>
                                            <p>Clean, minimal design for easy reading</p>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="template-preview" style="border: 2px solid #ddd; border-radius: 8px; padding: 15px; text-align: center; cursor: pointer; transition: var(--transition);">
                                            <div style="font-size: 3rem; color: #e74c3c; margin-bottom: 10px;">
                                                <i class="fas fa-file-alt"></i>
                                            </div>
                                            <h3 style="font-family: 'Montserrat', sans-serif;">Detailed Template</h3>
                                            <p>Comprehensive layout with full item details</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Customize Template</label>
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Logo</label>
                                            <input type="file" class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Color Scheme</label>
                                            <select class="form-control">
                                                <option value="blue">Blue (Default)</option>
                                                <option value="green">Green</option>
                                                <option value="red">Red</option>
                                                <option value="purple">Purple</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Payment Details</label>
                                    <textarea class="form-control" rows="3" placeholder="Bank account details, payment terms, etc."></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Footer Notes</label>
                                    <textarea class="form-control" rows="2" placeholder="Terms & conditions, thank you message, etc."></textarea>
                                </div>
                            </div>

                            <div style="margin-top: 20px; text-align: right;">
                                <button type="button" class="btn btn-secondary">Reset to Default</button>
                                <button type="button" class="btn btn-primary">Save Template</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Customer Invoicing</p>
            </div>
        </div>
    </div>

    <!-- View Invoice Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content" style="max-width: 1000px;">
            <div class="modal-header">
                <h2 class="modal-title">Invoice Details</h2>
                <span class="close" onclick="closeModal('viewModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="invoice-template">
                    <div class="invoice-header">
                        <div class="invoice-logo">YourCompany</div>
                        <div class="invoice-details">
                            <div class="invoice-title">INVOICE</div>
                            <div class="invoice-number">INV-2025-1002</div>
                        </div>
                    </div>

                    <div class="invoice-to-from">
                        <div class="invoice-address">
                            <div class="invoice-address-title">From:</div>
                            <p><strong>YourCompany Inc.</strong><br>
                                123 Business Avenue<br>
                                Metro Manila, Philippines 1000<br>
                                Phone: (02) 1234-5678<br>
                                Email: accounting@yourcompany.com
                            </p>
                        </div>

                        <div class="invoice-address">
                            <div class="invoice-address-title">To:</div>
                            <p><strong>Maria Garcia</strong><br>
                                456 Customer Street<br>
                                Cebu City, Philippines 6000<br>
                                Phone: (032) 987-6543<br>
                                Email: maria.garcia@example.com
                            </p>
                        </div>
                    </div>

                    <div class="invoice-details-row" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                        <div>
                            <strong>Invoice Date:</strong> September 2, 2025
                        </div>
                        <div>
                            <strong>Due Date:</strong> September 16, 2025
                        </div>
                        <div>
                            <strong>Order #:</strong> ORD-2025-086
                        </div>
                    </div>

                    <div class="invoice-items">
                        <table class="product-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Tax</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PROD-001</td>
                                    <td>Wireless Bluetooth Headphones</td>
                                    <td>2</td>
                                    <td>₱2,500.00</td>
                                    <td>12%</td>
                                    <td>₱5,600.00</td>
                                </tr>
                                <tr>
                                    <td>PROD-045</td>
                                    <td>Phone Case Premium</td>
                                    <td>1</td>
                                    <td>₱1,200.00</td>
                                    <td>12%</td>
                                    <td>₱1,344.00</td>
                                </tr>
                                <tr>
                                    <td>SVC-012</td>
                                    <td>Extended Warranty (2 years)</td>
                                    <td>1</td>
                                    <td>₱1,500.00</td>
                                    <td>12%</td>
                                    <td>₱1,680.00</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right;"><strong>Subtotal</strong></td>
                                    <td><strong>₱8,800.00</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right;"><strong>Tax (12%)</strong></td>
                                    <td><strong>₱1,056.00</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right;"><strong>Shipping</strong></td>
                                    <td><strong>₱150.00</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right;"><strong>Discount (5%)</strong></td>
                                    <td><strong>-₱440.00</strong></td>
                                </tr>
                                <tr style="font-size: 1.1rem;">
                                    <td colspan="5" style="text-align: right;"><strong>Grand Total</strong></td>
                                    <td><strong>₱9,566.00</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="payment-details" style="margin-top: 30px;">
                        <h3 class="form-label">Payment Details</h3>
                        <p>Please make payment within 15 days of invoice date. You can pay via bank transfer or credit card.</p>
                        <p><strong>Bank Account:</strong> YourBank Philippines<br>
                        <strong>Account #:</strong> 1234-5678-9012<br>
                        <strong>SWIFT Code:</strong> YOBKPHMM</p>
                    </div>

                    <div class="invoice-notes" style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                        <p><strong>Notes:</strong> Thank you for your business. Please reference the invoice number when making payment.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary"><i class="fas fa-print"></i> Print</button>
                <button class="btn btn-download"><i class="fas fa-download"></i> Download PDF</button>
                <button class="btn btn-primary"><i class="fas fa-envelope"></i> Email Invoice</button>
                <button class="btn btn-success"><i class="fas fa-credit-card"></i> Payment Link</button>
            </div>
        </div>
    </div>

    <!-- Create Invoice Modal -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Create New Invoice</h2>
                <span class="close" onclick="closeModal('createModal')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Would you like to create an invoice manually or from an existing order?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('createModal')">Cancel</button>
                <button class="btn btn-primary" onclick="setActiveTab('create-tab'); closeModal('createModal');">Manual Invoice</button>
                <button class="btn btn-success" onclick="setActiveTab('batch-tab'); closeModal('createModal');">From Existing Order</button>
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

        // Dashboard card click to navigate to invoices tab
        document.querySelectorAll('.dashboard-card').forEach(card => {
            card.addEventListener('click', function() {
                setActiveTab('invoices-tab');
            });
        });

        // Template preview hover effect
        document.querySelectorAll('.template-preview').forEach(preview => {
            preview.addEventListener('mouseenter', function() {
                this.style.borderColor = '#3498db';
                this.style.transform = 'translateY(-5px)';
            });
            
            preview.addEventListener('mouseleave', function() {
                this.style.borderColor = '#ddd';
                this.style.transform = 'translateY(0)';
            });
        });

        // Select all checkbox functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('#batch-tab tbody input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
</body>
</html>

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
            --processing: #3498db;
            --completed: #2ecc71;
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

        .status-processing {
            background-color: var(--processing);
            color: white;
        }

        .status-completed {
            background-color: var(--completed);
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

        .btn-process {
            background-color: #6c5ce7;
            color: white;
        }

        .btn-process:hover {
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

        /* Batch Processor */
        .batch-processor {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .batch-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: var(--transition);
            cursor: pointer;
        }

        .batch-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .batch-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .batch-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
            color: white;
        }

        .batch-icon.gateway {
            background-color: var(--secondary);
        }

        .batch-icon.cod {
            background-color: var(--warning);
        }

        .batch-info h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .batch-info p {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        .batch-amount {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 10px 0;
            color: var(--dark);
        }

        /* Refund Method Selection */
        .method-selection {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .method-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: var(--transition);
            cursor: pointer;
            text-align: center;
        }

        .method-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .method-card.selected {
            border: 2px solid var(--secondary);
        }

        .method-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 1.5rem;
            color: white;
        }

        .method-icon.bank {
            background-color: var(--secondary);
        }

        .method-icon.wallet {
            background-color: var(--success);
        }

        .method-icon.gateway {
            background-color: var(--warning);
        }

        .method-card h3 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 10px;
        }

        .method-card p {
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
            
            .batch-processor, .method-selection {
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
                <h1 class="page-title">Refund Processing</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card" onclick="switchTab('dashboard')">
                        <div class="card-icon blue">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Pending Refunds</h3>
                        <p>24</p>
                        <small>Require attention</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('dashboard')">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Processed Today</h3>
                        <p>18</p>
                        <small>Successfully refunded</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('dashboard')">
                        <div class="card-icon orange">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <h3>AR Refunds</h3>
                        <p>12</p>
                        <small>From accounting system</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('dashboard')">
                        <div class="card-icon red">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3>Order System</h3>
                        <p>16</p>
                        <small>From e-commerce platform</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="dashboard">Refund Dashboard</div>
                    <div class="tab" data-tab="batch">Batch Processor</div>
                    <div class="tab" data-tab="method">Refund Method</div>
                    <div class="tab" data-tab="audit">Audit Trail</div>
                </div>

                <!-- Refund Dashboard Tab -->
                <div class="tab-content active" id="dashboard-tab">
                    <!-- Refund Request Table Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Pending Refund Requests</h2>
                            <div>
                                <button class="btn btn-download" id="downloadCSV"><i class="fas fa-download"></i> CSV</button>
                                <button class="btn btn-primary" id="importRefunds"><i class="fas fa-file-import"></i> Import Requests</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Source</span>
                                    <select class="filter-select" id="sourceFilter">
                                        <option value="">All Sources</option>
                                        <option value="ar">AR Refunds</option>
                                        <option value="order">Order System</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="statusFilter">
                                        <option value="">All Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Payment Method</span>
                                    <select class="filter-select" id="paymentFilter">
                                        <option value="">All Methods</option>
                                        <option value="credit">Credit Card</option>
                                        <option value="debit">Debit Card</option>
                                        <option value="cod">Cash on Delivery</option>
                                        <option value="wallet">E-Wallet</option>
                                    </select>
                                </div>
                            </div>
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="refundSearch" placeholder="Search Customer, Order ID, or Refund ID...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Refund ID</th>
                                            <th>Customer</th>
                                            <th>Order ID</th>
                                            <th>Source</th>
                                            <th>Amount</th>
                                            <th>Reason</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>REF-2025-001</td>
                                            <td>Maria Santos</td>
                                            <td>ORD-2025-085</td>
                                            <td>Order System</td>
                                            <td>₱2,500.00</td>
                                            <td>Product Return</td>
                                            <td>2025-09-01</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approveModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-002</td>
                                            <td>Juan Dela Cruz</td>
                                            <td>ORD-2025-086</td>
                                            <td>AR Refunds</td>
                                            <td>₱1,750.00</td>
                                            <td>Overpayment</td>
                                            <td>2025-09-02</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approveModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-003</td>
                                            <td>Ana Reyes</td>
                                            <td>ORD-2025-087</td>
                                            <td>Order System</td>
                                            <td>₱5,200.00</td>
                                            <td>Order Cancellation</td>
                                            <td>2025-09-03</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approveModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-004</td>
                                            <td>Carlos Lim</td>
                                            <td>ORD-2025-088</td>
                                            <td>AR Refunds</td>
                                            <td>₱3,800.00</td>
                                            <td>Discount Adjustment</td>
                                            <td>2025-09-04</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approveModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-005</td>
                                            <td>Elena Torres</td>
                                            <td>ORD-2025-089</td>
                                            <td>Order System</td>
                                            <td>₱4,500.00</td>
                                            <td>Defective Product</td>
                                            <td>2025-09-05</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm" onclick="openModal('approveModal')"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Batch Processor Tab -->
                <div class="tab-content" id="batch-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Refund Batch Processor</h2>
                            <div>
                                <button class="btn btn-primary" id="createBatch"><i class="fas fa-plus"></i> Create Batch</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="batch-processor">
                                <div class="batch-card" onclick="openModal('gatewayBatchModal')">
                                    <div class="batch-header">
                                        <div class="batch-icon gateway">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                        <div class="batch-info">
                                            <h3>Gateway Refunds</h3>
                                            <p>Credit/Debit Card Payments</p>
                                        </div>
                                    </div>
                                    <div class="batch-amount">₱24,750.00</div>
                                    <p>12 refunds pending</p>
                                    <div style="margin-top: 15px;">
                                        <button class="btn btn-process btn-sm">Process Batch</button>
                                    </div>
                                </div>
                                <div class="batch-card" onclick="openModal('codBatchModal')">
                                    <div class="batch-header">
                                        <div class="batch-icon cod">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        <div class="batch-info">
                                            <h3>COD Refunds</h3>
                                            <p>Cash on Delivery Returns</p>
                                        </div>
                                    </div>
                                    <div class="batch-amount">₱18,200.00</div>
                                    <p>8 refunds pending</p>
                                    <div style="margin-top: 15px;">
                                        <button class="btn btn-process btn-sm">Process Batch</button>
                                    </div>
                                </div>
                            </div>
                            
                            <h3 style="margin: 30px 0 15px; font-family: 'Montserrat', sans-serif;">Recent Batches</h3>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Batch ID</th>
                                            <th>Payment Channel</th>
                                            <th>Refunds Count</th>
                                            <th>Total Amount</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>BATCH-2025-001</td>
                                            <td>Gateway</td>
                                            <td>15</td>
                                            <td>₱32,500.00</td>
                                            <td>2025-09-01</td>
                                            <td><span class="status status-completed">Completed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BATCH-2025-002</td>
                                            <td>COD</td>
                                            <td>10</td>
                                            <td>₱22,150.00</td>
                                            <td>2025-08-30</td>
                                            <td><span class="status status-completed">Completed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BATCH-2025-003</td>
                                            <td>Gateway</td>
                                            <td>8</td>
                                            <td>₱15,800.00</td>
                                            <td>2025-08-28</td>
                                            <td><span class="status status-completed">Completed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Refund Method Tab -->
                <div class="tab-content" id="method-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Refund Method Selection</h2>
                        </div>
                        <div class="card-body">
                            <div class="method-selection">
                                <div class="method-card" id="bankMethod" onclick="selectMethod('bank')">
                                    <div class="method-icon bank">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <h3>Bank Transfer</h3>
                                    <p>Direct transfer to customer's bank account</p>
                                    <div style="margin-top: 15px;">
                                        <span class="status status-processing">2-3 Business Days</span>
                                    </div>
                                </div>
                                <div class="method-card" id="walletMethod" onclick="selectMethod('wallet')">
                                    <div class="method-icon wallet">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                    <h3>Wallet Credit</h3>
                                    <p>Credit customer's e-wallet on your platform</p>
                                    <div style="margin-top: 15px;">
                                        <span class="status status-completed">Instant</span>
                                    </div>
                                </div>
                                <div class="method-card" id="gatewayMethod" onclick="selectMethod('gateway')">
                                    <div class="method-icon gateway">
                                        <i class="fas fa-undo"></i>
                                    </div>
                                    <h3>Gateway Reversal</h3>
                                    <p>Reverse transaction through payment gateway</p>
                                    <div style="margin-top: 15px;">
                                        <span class="status status-processing">3-5 Business Days</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="margin-top: 30px;">
                                <h3 style="margin-bottom: 15px; font-family: 'Montserrat', sans-serif;">Selected Refund Details</h3>
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Refund Amount</label>
                                            <input type="text" class="form-control" value="₱2,500.00" readonly>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Customer</label>
                                            <input type="text" class="form-control" value="Maria Santos" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Refund Reason</label>
                                    <input type="text" class="form-control" value="Product Return - Defective Item" readonly>
                                </div>
                                <div class="form-group" id="methodDetails">
                                    <label class="form-label">Method Details</label>
                                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px; text-align: center;">
                                        <p>Please select a refund method above</p>
                                    </div>
                                </div>
                                <div style="text-align: right; margin-top: 20px;">
                                    <button class="btn btn-secondary">Cancel</button>
                                    <button class="btn btn-primary" id="confirmRefund">Confirm Refund</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Audit Trail Tab -->
                <div class="tab-content" id="audit-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Refund Audit Trail</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <input type="date" class="filter-select" id="startDate">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">&nbsp;</span>
                                    <input type="date" class="filter-select" id="endDate">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Approver</span>
                                    <select class="filter-select" id="approverFilter">
                                        <option value="">All Approvers</option>
                                        <option value="admin">Admin User</option>
                                        <option value="manager">Finance Manager</option>
                                        <option value="supervisor">Refund Supervisor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Refund ID</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>Reason</th>
                                            <th>Method</th>
                                            <th>Approver</th>
                                            <th>Approval Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>REF-2025-015</td>
                                            <td>Robert Garcia</td>
                                            <td>₱3,200.00</td>
                                            <td>Order Cancellation</td>
                                            <td>Bank Transfer</td>
                                            <td>Admin User</td>
                                            <td>2025-08-28</td>
                                            <td><span class="status status-completed">Completed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-014</td>
                                            <td>Lisa Mendoza</td>
                                            <td>₱1,500.00</td>
                                            <td>Product Return</td>
                                            <td>Wallet Credit</td>
                                            <td>Finance Manager</td>
                                            <td>2025-08-27</td>
                                            <td><span class="status status-completed">Completed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-013</td>
                                            <td>Michael Tan</td>
                                            <td>₱4,800.00</td>
                                            <td>Overpayment</td>
                                            <td>Gateway Reversal</td>
                                            <td>Refund Supervisor</td>
                                            <td>2025-08-25</td>
                                            <td><span class="status status-completed">Completed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-012</td>
                                            <td>Sarah Johnson</td>
                                            <td>₱2,100.00</td>
                                            <td>Discount Adjustment</td>
                                            <td>Bank Transfer</td>
                                            <td>Admin User</td>
                                            <td>2025-08-24</td>
                                            <td><span class="status status-completed">Completed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-011</td>
                                            <td>David Lee</td>
                                            <td>₱3,750.00</td>
                                            <td>Defective Product</td>
                                            <td>Wallet Credit</td>
                                            <td>Finance Manager</td>
                                            <td>2025-08-23</td>
                                            <td><span class="status status-completed">Completed</span></td>
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
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Refund Processing</p>
            </div>
        </div>
    </div>

    <!-- View Refund Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Refund Request Details</h2>
                <span class="close" onclick="closeModal('viewModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Refund ID</label>
                            <p>REF-2025-001</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Customer</label>
                            <p>Maria Santos</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Order ID</label>
                            <p>ORD-2025-085</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Source</label>
                            <p>Order System</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Request Date</label>
                            <p>2025-09-01</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Refund Amount</label>
                            <p>₱2,500.00</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Reason for Refund</label>
                    <p>Product Return - Customer received defective item</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Original Payment Details</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>Payment Method:</strong> Credit Card (Visa)</p>
                        <p><strong>Transaction ID:</strong> TXN-2025-085-001</p>
                        <p><strong>Payment Date:</strong> 2025-08-25</p>
                        <p><strong>Original Amount:</strong> ₱12,500.00</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Supporting Documents</label>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button class="btn btn-view btn-sm"><i class="fas fa-file-image"></i> Return Image</button>
                        <button class="btn btn-view btn-sm"><i class="fas fa-file-alt"></i> Customer Message</button>
                        <button class="btn btn-view btn-sm"><i class="fas fa-receipt"></i> Original Invoice</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('viewModal')">Close</button>
                <button type="button" class="btn btn-primary">Print Details</button>
            </div>
        </div>
    </div>

    <!-- Approve Refund Modal -->
    <div id="approveModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Approve Refund Request</h2>
                <span class="close" onclick="closeModal('approveModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Refund ID</label>
                    <p>REF-2025-001</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Customer</label>
                    <p>Maria Santos</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Amount to Refund</label>
                    <p>₱2,500.00</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="refundMethod">Refund Method</label>
                    <select class="form-control" id="refundMethod">
                        <option value="">Select a method</option>
                        <option value="bank">Bank Transfer</option>
                        <option value="wallet">Wallet Credit</option>
                        <option value="gateway">Gateway Reversal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="approverNotes">Approver Notes</label>
                    <textarea class="form-control" id="approverNotes" rows="4" placeholder="Add any notes for the refund approval"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">GL Accounts</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>Debit:</strong> Refund Expense (Account #6010)</p>
                        <p><strong>Credit:</strong> Cash/Bank Account (Account #1010)</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('approveModal')">Cancel</button>
                <button type="button" class="btn btn-approve">Confirm Approval</button>
            </div>
        </div>
    </div>

    <!-- Reject Refund Modal -->
    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Reject Refund Request</h2>
                <span class="close" onclick="closeModal('rejectModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Refund ID</label>
                    <p>REF-2025-001</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Customer</label>
                    <p>Maria Santos</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Requested Amount</label>
                    <p>₱2,500.00</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="rejectReason">Reason for Rejection</label>
                    <select class="form-control" id="rejectReason">
                        <option value="">Select a reason</option>
                        <option value="policy">Outside Return Policy</option>
                        <option value="documentation">Insufficient Documentation</option>
                        <option value="amount">Refund Amount Incorrect</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="rejectDetails">Rejection Details</label>
                    <textarea class="form-control" id="rejectDetails" rows="4" placeholder="Please provide details for the rejection"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('rejectModal')">Cancel</button>
                <button type="button" class="btn btn-reject">Confirm Rejection</button>
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

        // Refund method selection
        function selectMethod(method) {
            // Remove selected class from all methods
            document.querySelectorAll('.method-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked method
            document.getElementById(`${method}Method`).classList.add('selected');
            
            // Update method details
            const methodDetails = document.getElementById('methodDetails');
            let detailsHtml = '';
            
            switch(method) {
                case 'bank':
                    detailsHtml = `
                        <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                            <p><strong>Bank Transfer Details</strong></p>
                            <p>Account Name: Maria Santos</p>
                            <p>Bank: BDO (Banco de Oro)</p>
                            <p>Account Number: ********1234</p>
                            <p>Estimated Processing: 2-3 business days</p>
                        </div>
                    `;
                    break;
                case 'wallet':
                    detailsHtml = `
                        <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                            <p><strong>Wallet Credit Details</strong></p>
                            <p>Wallet: MyShop Wallet</p>
                            <p>Customer: Maria Santos (user@example.com)</p>
                            <p>Current Balance: ₱1,250.00</p>
                            <p>New Balance after refund: ₱3,750.00</p>
                            <p>Processing: Instant</p>
                        </div>
                    `;
                    break;
                case 'gateway':
                    detailsHtml = `
                        <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                            <p><strong>Gateway Reversal Details</strong></p>
                            <p>Gateway: PayMongo</p>
                            <p>Transaction ID: TXN-2025-085-001</p>
                            <p>Original Amount: ₱12,500.00</p>
                            <p>Refund Amount: ₱2,500.00</p>
                            <p>Estimated Processing: 3-5 business days</p>
                        </div>
                    `;
                    break;
            }
            
            methodDetails.innerHTML = detailsHtml;
        }

        // Search functionality
        document.getElementById('refundSearch').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('#dashboard-tab tbody tr');
            
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

        // Filter functionality for refund dashboard
        const filters = document.querySelectorAll('.filter-select');
        filters.forEach(filter => {
            filter.addEventListener('change', filterRefundRequests);
        });

        function filterRefundRequests() {
            const sourceFilter = document.getElementById('sourceFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const paymentFilter = document.getElementById('paymentFilter').value;
            
            const rows = document.querySelectorAll('#dashboard-tab tbody tr');
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const source = cells[3].textContent.toLowerCase();
                const status = cells[7].querySelector('.status').textContent.toLowerCase();
                // For payment method, we would need to add this data to the table
                // For now, we'll just show all rows if payment filter is applied
                const payment = ''; // This would normally come from the table data
                
                let showRow = true;
                
                // Check source filter
                if (sourceFilter && !source.includes(sourceFilter)) {
                    showRow = false;
                }
                
                // Check status filter
                if (statusFilter && !status.includes(statusFilter)) {
                    showRow = false;
                }
                
                // Check payment filter (placeholder logic)
                if (paymentFilter) {
                    // In a real implementation, this would check the payment method column
                    showRow = true; // Placeholder
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

        // Confirm refund button functionality
        document.getElementById('confirmRefund').addEventListener('click', function() {
            const selectedMethod = document.querySelector('.method-card.selected');
            if (!selectedMethod) {
                alert('Please select a refund method first.');
                return;
            }
            
            if (confirm('Are you sure you want to process this refund?')) {
                // In a real application, this would submit the refund request
                alert('Refund has been queued for processing.');
                closeModal('approveModal');
            }
        });

        // Import refunds button functionality
        document.getElementById('importRefunds').addEventListener('click', function() {
            // In a real application, this would open a file upload dialog
            alert('Refund import feature would open here.');
        });
    </script>
</body>
</html>

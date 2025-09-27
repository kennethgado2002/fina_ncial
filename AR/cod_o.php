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
            --in-transit: #3498db;
            --delivered: #2ecc71;
            --paid: #2ecc71;
            --unpaid: #e74c3c;
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

        .status-pending {
            background-color: var(--pending);
            color: white;
        }

        .status-in-transit {
            background-color: var(--in-transit);
            color: white;
        }

        .status-delivered {
            background-color: var(--delivered);
            color: white;
        }

        .status-paid {
            background-color: var(--paid);
            color: white;
        }

        .status-unpaid {
            background-color: var(--unpaid);
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

        /* Map Visualization */
        .map-visualization {
            height: 300px;
            background: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .map-visualization::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(circle, #3498db 2px, transparent 2px);
            background-size: 30px 30px;
            opacity: 0.3;
        }

        .map-point {
            position: absolute;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--accent);
            transform: translate(-50%, -50%);
            box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.7);
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(231, 76, 60, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(231, 76, 60, 0);
            }
        }

        .map-point:nth-child(2) {
            top: 30%;
            left: 40%;
            background: var(--success);
            animation-delay: 0.5s;
        }

        .map-point:nth-child(3) {
            top: 60%;
            left: 70%;
            background: var(--warning);
            animation-delay: 1s;
        }

        .map-point:nth-child(4) {
            top: 45%;
            left: 25%;
            background: var(--secondary);
            animation-delay: 1.5s;
        }

        /* Receipt Upload */
        .receipt-upload {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            margin-bottom: 20px;
            transition: var(--transition);
            cursor: pointer;
        }

        .receipt-upload:hover {
            border-color: var(--secondary);
        }

        .receipt-upload i {
            font-size: 3rem;
            color: #7f8c8d;
            margin-bottom: 15px;
        }

        .receipt-preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 15px;
            display: none;
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
        }
    </style>
<!-- DASHBOARD MAIN CONTENT -->
<div class="home-section">
  <div class="text">Dashboard</div>
        <!-- Main Content -->
        <div class="main-content" id="main-content">

            <!-- Content Area -->
            <div class="content">
                <h1 class="page-title">COD Orders Management</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card" onclick="setActiveTab('tracker-tab')">
                        <div class="card-icon blue">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h3>Active COD Orders</h3>
                        <p>142</p>
                        <small>To be delivered</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('tracker-tab', 'unpaid')">
                        <div class="card-icon orange">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Pending Collection</h3>
                        <p>₱189,560.00</p>
                        <small>From 87 orders</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('outstanding-tab')">
                        <div class="card-icon red">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>Overdue</h3>
                        <p>23</p>
                        <small>Require follow-up</small>
                    </div>
                    <div class="dashboard-card" onclick="setActiveTab('tracker-tab', 'paid')">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Collected Today</h3>
                        <p>₱67,890.00</p>
                        <small>From 42 orders</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="tracker">COD Order Tracker</div>
                    <div class="tab" data-tab="outstanding">Outstanding Collections</div>
                    <div class="tab" data-tab="collectors">Collectors</div>
                </div>

                <!-- COD Order Tracker Tab -->
                <div class="tab-content active" id="tracker-tab">
                    <!-- Order Table Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">COD Orders</h2>
                            <div>
                                <button class="btn btn-primary"><i class="fas fa-sync"></i> Refresh</button>
                                <button class="btn btn-secondary"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="orderSearch" placeholder="Search Order No., Customer, or Collector...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Delivery Status</span>
                                    <select class="filter-select" id="statusFilter">
                                        <option value="">All Statuses</option>
                                        <option value="pending">Pending</option>
                                        <option value="in-transit">In Transit</option>
                                        <option value="delivered">Delivered</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Payment Status</span>
                                    <select class="filter-select" id="paymentFilter">
                                        <option value="">All Statuses</option>
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Collector</span>
                                    <select class="filter-select" id="collectorFilter">
                                        <option value="">All Collectors</option>
                                        <option value="john">John Dela Cruz</option>
                                        <option value="maria">Maria Santos</option>
                                        <option value="carlos">Carlos Reyes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Order No.</th>
                                            <th>Customer</th>
                                            <th>Delivery Address</th>
                                            <th>COD Amount</th>
                                            <th>Delivery Status</th>
                                            <th>Payment Status</th>
                                            <th>Collector</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ORD-2025-1001</td>
                                            <td>John Smith</td>
                                            <td>123 Main St, Manila</td>
                                            <td>₱12,500.00</td>
                                            <td><span class="status status-in-transit">In Transit</span></td>
                                            <td><span class="status status-unpaid">Unpaid</span></td>
                                            <td>John Dela Cruz</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm" onclick="openModal('updateModal')"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ORD-2025-1002</td>
                                            <td>Maria Garcia</td>
                                            <td>456 Oak St, Quezon City</td>
                                            <td>₱8,750.00</td>
                                            <td><span class="status status-delivered">Delivered</span></td>
                                            <td><span class="status status-paid">Paid</span></td>
                                            <td>Maria Santos</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm" onclick="openModal('updateModal')"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ORD-2025-1003</td>
                                            <td>Robert Johnson</td>
                                            <td>789 Pine St, Makati</td>
                                            <td>₱15,200.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td><span class="status status-unpaid">Unpaid</span></td>
                                            <td>Unassigned</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm" onclick="openModal('assignModal')"><i class="fas fa-user-plus"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ORD-2025-1004</td>
                                            <td>Sarah Williams</td>
                                            <td>321 Elm St, Pasig</td>
                                            <td>₱9,800.00</td>
                                            <td><span class="status status-delivered">Delivered</span></td>
                                            <td><span class="status status-unpaid">Unpaid</span></td>
                                            <td>Carlos Reyes</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-warning btn-sm" onclick="openModal('followupModal')"><i class="fas fa-phone"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ORD-2025-1005</td>
                                            <td>Michael Brown</td>
                                            <td>654 Maple St, Taguig</td>
                                            <td>₱22,500.00</td>
                                            <td><span class="status status-in-transit">In Transit</span></td>
                                            <td><span class="status status-unpaid">Unpaid</span></td>
                                            <td>John Dela Cruz</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-primary btn-sm" onclick="openModal('updateModal')"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Outstanding Collections Tab -->
                <div class="tab-content" id="outstanding-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Outstanding Collections</h2>
                        </div>
                        <div class="card-body">
                            <div class="map-visualization">
                                <div class="map-point" style="top: 25%; left: 30%;"></div>
                                <div class="map-point"></div>
                                <div class="map-point"></div>
                                <div class="map-point"></div>
                                <div style="z-index: 10; position: relative;">
                                    <h3>COD Collection Map</h3>
                                    <p>Visualization of outstanding collections by region</p>
                                </div>
                            </div>

                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Region</span>
                                    <select class="filter-select" id="regionFilter">
                                        <option value="">All Regions</option>
                                        <option value="ncr">National Capital Region</option>
                                        <option value="luzon">Luzon</option>
                                        <option value="visayas">Visayas</option>
                                        <option value="mindanao">Mindanao</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Days Outstanding</span>
                                    <select class="filter-select" id="daysFilter">
                                        <option value="">All</option>
                                        <option value="7">1-7 days</option>
                                        <option value="14">8-14 days</option>
                                        <option value="30">15-30 days</option>
                                        <option value="30+">Over 30 days</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Region</th>
                                            <th>Collector</th>
                                            <th>Orders</th>
                                            <th>Total Amount</th>
                                            <th>Avg. Days Outstanding</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>National Capital Region</td>
                                            <td>John Dela Cruz</td>
                                            <td>23</td>
                                            <td>₱167,800.00</td>
                                            <td>4.2</td>
                                            <td><button class="btn btn-view btn-sm">View Details</button></td>
                                        </tr>
                                        <tr>
                                            <td>Luzon</td>
                                            <td>Maria Santos</td>
                                            <td>18</td>
                                            <td>₱125,400.00</td>
                                            <td>5.7</td>
                                            <td><button class="btn btn-view btn-sm">View Details</button></td>
                                        </tr>
                                        <tr>
                                            <td>Visayas</td>
                                            <td>Carlos Reyes</td>
                                            <td>12</td>
                                            <td>₱89,500.00</td>
                                            <td>7.3</td>
                                            <td><button class="btn btn-view btn-sm">View Details</button></td>
                                        </tr>
                                        <tr>
                                            <td>Mindanao</td>
                                            <td>Unassigned</td>
                                            <td>8</td>
                                            <td>₱56,300.00</td>
                                            <td>10.5</td>
                                            <td><button class="btn btn-primary btn-sm">Assign Collector</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Collectors Tab -->
                <div class="tab-content" id="collectors-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Collectors Performance</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Collector</th>
                                            <th>Region</th>
                                            <th>Assigned Orders</th>
                                            <th>Completed</th>
                                            <th>Collection Rate</th>
                                            <th>Total Collected</th>
                                            <th>Performance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John Dela Cruz</td>
                                            <td>National Capital Region</td>
                                            <td>42</td>
                                            <td>38</td>
                                            <td>90.5%</td>
                                            <td>₱425,600.00</td>
                                            <td><span class="status status-paid">Excellent</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maria Santos</td>
                                            <td>Luzon</td>
                                            <td>35</td>
                                            <td>30</td>
                                            <td>85.7%</td>
                                            <td>₱289,400.00</td>
                                            <td><span class="status status-in-transit">Good</span></td>
                                        </tr>
                                        <tr>
                                            <td>Carlos Reyes</td>
                                            <td>Visayas</td>
                                            <td>28</td>
                                            <td>22</td>
                                            <td>78.6%</td>
                                            <td>₱187,500.00</td>
                                            <td><span class="status status-pending">Average</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div style="margin-top: 30px;">
                                <h3 class="form-label">Add New Collector</h3>
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" placeholder="Enter collector's name">
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Contact Number</label>
                                            <input type="tel" class="form-control" placeholder="+63 900 000 0000">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Assigned Region</label>
                                            <select class="form-control">
                                                <option value="">Select Region</option>
                                                <option value="ncr">National Capital Region</option>
                                                <option value="luzon">Luzon</option>
                                                <option value="visayas">Visayas</option>
                                                <option value="mindanao">Mindanao</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Vehicle Type</label>
                                            <select class="form-control">
                                                <option value="">Select Vehicle</option>
                                                <option value="motorcycle">Motorcycle</option>
                                                <option value="car">Car</option>
                                                <option value="van">Van</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <button class="btn btn-primary">Add Collector</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - COD Orders Management</p>
            </div>
        </div>
    </div>

    <!-- View Order Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content" style="max-width: 800px;">
            <div class="modal-header">
                <h2 class="modal-title">COD Order Details</h2>
                <span class="close" onclick="closeModal('viewModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Order Number</label>
                            <p>ORD-2025-1001</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Order Date</label>
                            <p>September 5, 2025</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Customer</label>
                            <p>John Smith</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Contact Number</label>
                            <p>+63 912 345 6789</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Delivery Address</label>
                    <p>123 Main Street, Barangay 123, Manila, Metro Manila 1000</p>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">COD Amount</label>
                            <p>₱12,500.00</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Assigned Collector</label>
                            <p>John Dela Cruz</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Delivery Status</label>
                            <p><span class="status status-in-transit">In Transit</span></p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Payment Status</label>
                            <p><span class="status status-unpaid">Unpaid</span></p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Order Items</label>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Wireless Bluetooth Headphones</td>
                                    <td>2</td>
                                    <td>₱2,500.00</td>
                                    <td>₱5,000.00</td>
                                </tr>
                                <tr>
                                    <td>Phone Case Premium</td>
                                    <td>1</td>
                                    <td>₱1,200.00</td>
                                    <td>₱1,200.00</td>
                                </tr>
                                <tr>
                                    <td>Extended Warranty (2 years)</td>
                                    <td>1</td>
                                    <td>₱1,500.00</td>
                                    <td>₱1,500.00</td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align: right;"><strong>Subtotal</strong></td>
                                    <td><strong>₱7,700.00</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align: right;"><strong>Shipping</strong></td>
                                    <td><strong>₱150.00</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align: right;"><strong>Tax (12%)</strong></td>
                                    <td><strong>₱924.00</strong></td>
                                </tr>
                                <tr style="font-size: 1.1rem;">
                                    <td colspan="3" style="text-align: right;"><strong>Total</strong></td>
                                    <td><strong>₱8,774.00</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Delivery Timeline</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <div style="width: 20px; height: 20px; border-radius: 50%; background: #2ecc71; margin-right: 10px;"></div>
                            <div>
                                <strong>Order Confirmed</strong> - September 5, 2025 10:30 AM
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <div style="width: 20px; height: 20px; border-radius: 50%; background: #2ecc71; margin-right: 10px;"></div>
                            <div>
                                <strong>Order Packed</strong> - September 5, 2025 11:45 AM
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <div style="width: 20px; height: 20px; border-radius: 50%; background: #3498db; margin-right: 10px;"></div>
                            <div>
                                <strong>Out for Delivery</strong> - September 5, 2025 1:15 PM
                            </div>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 2px solid #ddd; margin-right: 10px;"></div>
                            <div>
                                <strong>Delivered</strong> - Pending
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="closeModal('viewModal')">Close</button>
            </div>
        </div>
    </div>

    <!-- Update Status Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content" style="max-width: 600px;">
            <div class="modal-header">
                <h2 class="modal-title">Update Delivery Status</h2>
                <span class="close" onclick="closeModal('updateModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Order Number</label>
                    <p>ORD-2025-1001 - John Smith</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Delivery Status</label>
                    <select class="form-control">
                        <option value="pending">Pending</option>
                        <option value="in-transit" selected>In Transit</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Payment Status</label>
                    <select class="form-control">
                        <option value="unpaid" selected>Unpaid</option>
                        <option value="paid">Paid</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Collector Notes</label>
                    <textarea class="form-control" rows="3" placeholder="Add notes about the delivery..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Upload Receipt (if paid)</label>
                    <div class="receipt-upload" onclick="document.getElementById('receiptFile').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Click to upload receipt image</p>
                        <small>Supported formats: JPG, PNG, PDF (Max 5MB)</small>
                        <img id="receiptPreview" class="receipt-preview" alt="Receipt preview">
                        <input type="file" id="receiptFile" accept="image/*" style="display: none;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('updateModal')">Cancel</button>
                <button class="btn btn-primary">Update Status</button>
            </div>
        </div>
    </div>

    <!-- Assign Collector Modal -->
    <div id="assignModal" class="modal">
        <div class="modal-content" style="max-width: 500px;">
            <div class="modal-header">
                <h2 class="modal-title">Assign Collector</h2>
                <span class="close" onclick="closeModal('assignModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Order Number</label>
                    <p>ORD-2025-1003 - Robert Johnson</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Select Collector</label>
                    <select class="form-control">
                        <option value="">Select a collector</option>
                        <option value="john">John Dela Cruz (NCR)</option>
                        <option value="maria">Maria Santos (Luzon)</option>
                        <option value="carlos">Carlos Reyes (Visayas)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Estimated Delivery Date</label>
                    <input type="date" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('assignModal')">Cancel</button>
                <button class="btn btn-primary">Assign Collector</button>
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
                document.getElementById('paymentFilter').value = filter;
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

        // Dashboard card click to navigate to transactions tab
        document.querySelectorAll('.dashboard-card').forEach(card => {
            card.addEventListener('click', function() {
                setActiveTab('tracker-tab');
            });
        });

        // Receipt upload preview
        document.getElementById('receiptFile').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('receiptPreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>

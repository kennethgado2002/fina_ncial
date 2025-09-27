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
            --linked: #3498db;
            --offset: #2ecc71;
            --audit: #9b59b6;
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

        .card-icon.pending {
            background-color: rgba(243, 156, 18, 0.2);
            color: #d35400;
        }

        .card-icon.linked {
            background-color: rgba(52, 152, 219, 0.2);
            color: #2980b9;
        }

        .card-icon.offset {
            background-color: rgba(46, 204, 113, 0.2);
            color: #27ae60;
        }

        .card-icon.audit {
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

        .status-linked {
            background-color: var(--linked);
            color: white;
        }

        .status-offset {
            background-color: var(--offset);
            color: white;
        }

        .status-audit {
            background-color: var(--audit);
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

        .btn-link {
            background-color: #3498db;
            color: white;
        }

        .btn-link:hover {
            background-color: #2980b9;
        }

        .btn-offset {
            background-color: #2ecc71;
            color: white;
        }

        .btn-offset:hover {
            background-color: #27ae60;
        }

        .btn-import {
            background-color: #9b59b6;
            color: white;
        }

        .btn-import:hover {
            background-color: #8e44ad;
        }

        .btn-download {
            background-color: #34495e;
            color: white;
        }

        .btn-download:hover {
            background-color: #2c3e50;
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

        /* Chart Container */
        .chart-container {
            height: 300px;
            margin-bottom: 20px;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
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
        }
    </style>
<!-- DASHBOARD MAIN CONTENT -->
<div class="home-section">
  <div class="text">Dashboard</div>
            <!-- Main Content -->
        <div class="main-content" id="main-content">

            <!-- Content Area -->
            <div class="content">
                <h1 class="page-title">Refund Offsets</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon pending">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Pending Refunds</h3>
                        <p>₱124,500</p>
                        <small>12 refunds awaiting action</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon linked">
                            <i class="fas fa-link"></i>
                        </div>
                        <h3>Linked Refunds</h3>
                        <p>₱89,300</p>
                        <small>8 refunds linked to collections</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon offset">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <h3>Offset Amount</h3>
                        <p>₱67,800</p>
                        <small>Net revenue after offsets</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon audit">
                            <i class="fas fa-history"></i>
                        </div>
                        <h3>Audit Entries</h3>
                        <p>42</p>
                        <small>Refund adjustments this month</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="dashboard">Dashboard</div>
                    <div class="tab" data-tab="linking">Refund Linking</div>
                    <div class="tab" data-tab="adjustment">Adjustment Report</div>
                    <div class="tab" data-tab="audit">Audit Trail</div>
                </div>

                <!-- Dashboard Tab -->
                <div class="tab-content active" id="dashboard-tab">
                    <!-- Pending vs Collected Chart -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Pending Refunds vs Collected Amounts</h2>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <!-- Chart would be implemented with a library like Chart.js in a real application -->
                                <div style="display: flex; align-items: flex-end; height: 100%; gap: 20px; justify-content: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="background: #f39c12; width: 60px; height: 180px; border-radius: 5px;"></div>
                                        <span style="margin-top: 10px;">Pending Refunds</span>
                                        <span>₱124,500</span>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="background: #3498db; width: 60px; height: 220px; border-radius: 5px;"></div>
                                        <span style="margin-top: 10px;">Collected Amounts</span>
                                        <span>₱156,800</span>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="background: #2ecc71; width: 60px; height: 150px; border-radius: 5px;"></div>
                                        <span style="margin-top: 10px;">Net Revenue</span>
                                        <span>₱67,800</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Refund Activity -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Recent Refund Activity</h2>
                            <div>
                                <button class="btn btn-import"><i class="fas fa-file-import"></i> Import Refunds</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="refundSearch" placeholder="Search Refund ID, Customer, or Amount...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Refund ID</th>
                                            <th>Customer</th>
                                            <th>Original Payment</th>
                                            <th>Refund Amount</th>
                                            <th>Status</th>
                                            <th>Date Requested</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>REF-2025-001</td>
                                            <td>John Smith</td>
                                            <td>PYM-2025-085</td>
                                            <td>₱12,500.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>2025-09-01</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-link btn-sm"><i class="fas fa-link"></i></button>
                                                <button class="btn btn-offset btn-sm"><i class="fas fa-balance-scale"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-002</td>
                                            <td>Maria Garcia</td>
                                            <td>PYM-2025-086</td>
                                            <td>₱8,750.00</td>
                                            <td><span class="status status-linked">Linked</span></td>
                                            <td>2025-09-02</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-offset btn-sm"><i class="fas fa-balance-scale"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-003</td>
                                            <td>Robert Johnson</td>
                                            <td>PYM-2025-087</td>
                                            <td>₱15,200.00</td>
                                            <td><span class="status status-offset">Offset</span></td>
                                            <td>2025-09-03</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-file-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-004</td>
                                            <td>Sarah Williams</td>
                                            <td>PYM-2025-088</td>
                                            <td>₱9,800.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>2025-09-04</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-link btn-sm"><i class="fas fa-link"></i></button>
                                                <button class="btn btn-offset btn-sm"><i class="fas fa-balance-scale"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-005</td>
                                            <td>Michael Brown</td>
                                            <td>PYM-2025-089</td>
                                            <td>₱22,500.00</td>
                                            <td><span class="status status-linked">Linked</span></td>
                                            <td>2025-09-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-offset btn-sm"><i class="fas fa-balance-scale"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Refund Linking Tab -->
                <div class="tab-content" id="linking-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Refund Source Linking</h2>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Refund Status</span>
                                    <select class="filter-select" id="statusFilter">
                                        <option value="">All Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="linked">Linked</option>
                                        <option value="offset">Offset</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Customer</span>
                                    <select class="filter-select" id="customerFilter">
                                        <option value="">All Customers</option>
                                        <option value="john">John Smith</option>
                                        <option value="maria">Maria Garcia</option>
                                        <option value="robert">Robert Johnson</option>
                                        <option value="sarah">Sarah Williams</option>
                                        <option value="michael">Michael Brown</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <input type="date" class="filter-select" id="dateFrom">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">To</span>
                                    <input type="date" class="filter-select" id="dateTo">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Refund ID</th>
                                            <th>Customer</th>
                                            <th>Original Payment</th>
                                            <th>Payment Date</th>
                                            <th>Refund Amount</th>
                                            <th>Status</th>
                                            <th>Link to Collection</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>REF-2025-001</td>
                                            <td>John Smith</td>
                                            <td>PYM-2025-085</td>
                                            <td>2025-08-15</td>
                                            <td>₱12,500.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-link btn-sm" onclick="openModal('linkModal')"><i class="fas fa-link"></i> Link</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-004</td>
                                            <td>Sarah Williams</td>
                                            <td>PYM-2025-088</td>
                                            <td>2025-08-18</td>
                                            <td>₱9,800.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-link btn-sm" onclick="openModal('linkModal')"><i class="fas fa-link"></i> Link</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-006</td>
                                            <td>Lisa Anderson</td>
                                            <td>PYM-2025-090</td>
                                            <td>2025-08-20</td>
                                            <td>₱7,200.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-link btn-sm" onclick="openModal('linkModal')"><i class="fas fa-link"></i> Link</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Adjustment Report Tab -->
                <div class="tab-content" id="adjustment-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Adjustment Report - Net Revenue After Refunds</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Period</span>
                                    <select class="filter-select" id="periodFilter">
                                        <option value="current">Current Month</option>
                                        <option value="previous">Previous Month</option>
                                        <option value="quarter">This Quarter</option>
                                        <option value="year">This Year</option>
                                        <option value="custom">Custom Range</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">From</span>
                                    <input type="date" class="filter-select" value="2025-09-01">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">To</span>
                                    <input type="date" class="filter-select" value="2025-09-30">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Period</th>
                                            <th>Gross Revenue</th>
                                            <th>Refund Amount</th>
                                            <th>Net Revenue</th>
                                            <th>Refund %</th>
                                            <th>Offset Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>September 2025</td>
                                            <td>₱856,300.00</td>
                                            <td>₱124,500.00</td>
                                            <td>₱731,800.00</td>
                                            <td>14.5%</td>
                                            <td><span class="status status-offset">Offset Applied</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>August 2025</td>
                                            <td>₱792,150.00</td>
                                            <td>₱98,700.00</td>
                                            <td>₱693,450.00</td>
                                            <td>12.5%</td>
                                            <td><span class="status status-offset">Offset Applied</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>July 2025</td>
                                            <td>₱745,800.00</td>
                                            <td>₱87,300.00</td>
                                            <td>₱658,500.00</td>
                                            <td>11.7%</td>
                                            <td><span class="status status-offset">Offset Applied</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>June 2025</td>
                                            <td>₱812,450.00</td>
                                            <td>₱105,200.00</td>
                                            <td>₱707,250.00</td>
                                            <td>12.9%</td>
                                            <td><span class="status status-offset">Offset Applied</span></td>
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

                <!-- Audit Trail Tab -->
                <div class="tab-content" id="audit-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Audit Trail of Refunds</h2>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Refund Type</span>
                                    <select class="filter-select" id="typeFilter">
                                        <option value="">All Types</option>
                                        <option value="full">Full Refund</option>
                                        <option value="partial">Partial Refund</option>
                                        <option value="exchange">Exchange</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Approver</span>
                                    <select class="filter-select" id="approverFilter">
                                        <option value="">All Approvers</option>
                                        <option value="manager">Manager</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Reason Code</span>
                                    <select class="filter-select" id="reasonFilter">
                                        <option value="">All Reasons</option>
                                        <option value="defective">Defective Product</option>
                                        <option value="wrong">Wrong Item</option>
                                        <option value="cancel">Order Cancellation</option>
                                        <option value="return">Customer Return</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Refund ID</th>
                                            <th>Customer</th>
                                            <th>Refund Type</th>
                                            <th>Amount</th>
                                            <th>Reason Code</th>
                                            <th>Approver</th>
                                            <th>Date Processed</th>
                                            <th>GL Entry</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>REF-2025-003</td>
                                            <td>Robert Johnson</td>
                                            <td>Full Refund</td>
                                            <td>₱15,200.00</td>
                                            <td>Defective Product</td>
                                            <td>Manager</td>
                                            <td>2025-09-05</td>
                                            <td>GL-2025-0098</td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-002</td>
                                            <td>Maria Garcia</td>
                                            <td>Partial Refund</td>
                                            <td>₱8,750.00</td>
                                            <td>Wrong Item</td>
                                            <td>Supervisor</td>
                                            <td>2025-09-04</td>
                                            <td>GL-2025-0087</td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-005</td>
                                            <td>Michael Brown</td>
                                            <td>Exchange</td>
                                            <td>₱22,500.00</td>
                                            <td>Order Cancellation</td>
                                            <td>Admin</td>
                                            <td>2025-09-03</td>
                                            <td>GL-2025-0076</td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>REF-2025-001</td>
                                            <td>John Smith</td>
                                            <td>Full Refund</td>
                                            <td>₱12,500.00</td>
                                            <td>Customer Return</td>
                                            <td>Manager</td>
                                            <td>2025-09-02</td>
                                            <td>GL-2025-0065</td>
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
                <p>&copy; 2025 Financial System - Refund Offsets</p>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Refund Offset Details</h2>
                <span class="close" onclick="closeModal('viewModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Customer</label>
                            <p>John Smith</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Refund ID</label>
                            <p>REF-2025-001</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Original Payment</label>
                            <p>PYM-2025-085</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Payment Date</label>
                            <p>2025-08-15</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Refund Amount</label>
                            <p>₱12,500.00</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Refund Status</label>
                            <p><span class="status status-pending">Pending</span></p>
                        </div>
                    </div>
                </div>

                <h3 class="form-label">Refund Offset Details</h3>
                <div class="table-responsive">
                    <table class="comparison-table">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Original Revenue</th>
                                <th>Refund Amount</th>
                                <th>Net Revenue</th>
                                <th>Offset Status</th>
                                <th>GL Account</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Product Sale - Laptop</td>
                                <td>₱25,000.00</td>
                                <td>₱12,500.00</td>
                                <td>₱12,500.00</td>
                                <td><span class="status status-pending">Pending</span></td>
                                <td>Revenue - Electronics</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label class="form-label">Offset Summary</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>Status:</strong> <span class="status status-pending">Pending Offset</span></p>
                        <p><strong>Action Required:</strong> Link refund to original collection and apply offset</p>
                        <p><strong>GL Impact:</strong> Debit: Refunds Expense, Credit: Revenue Adjustments</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('viewModal')">Close</button>
                <button type="button" class="btn btn-primary">Print Report</button>
            </div>
        </div>
    </div>

    <!-- Link Modal -->
    <div id="linkModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Link Refund to Original Collection</h2>
                <span class="close" onclick="closeModal('linkModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Refund ID</label>
                    <p>REF-2025-001</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Customer</label>
                    <p>John Smith</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Refund Amount</label>
                    <p>₱12,500.00</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="collectionSelect">Select Original Collection</label>
                    <select class="form-control" id="collectionSelect">
                        <option value="">Select a collection</option>
                        <option value="PYM-2025-085">PYM-2025-085 (₱25,000.00 - 2025-08-15)</option>
                        <option value="PYM-2025-086">PYM-2025-086 (₱18,750.00 - 2025-08-16)</option>
                        <option value="PYM-2025-087">PYM-2025-087 (₱32,200.00 - 2025-08-17)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="offsetAmount">Offset Amount</label>
                    <input type="number" class="form-control" id="offsetAmount" value="12500" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label" for="reasonCode">Reason Code</label>
                    <select class="form-control" id="reasonCode">
                        <option value="">Select a reason</option>
                        <option value="defective">Defective Product</option>
                        <option value="wrong">Wrong Item</option>
                        <option value="cancel">Order Cancellation</option>
                        <option value="return">Customer Return</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="approver">Approver</label>
                    <select class="form-control" id="approver">
                        <option value="">Select an approver</option>
                        <option value="manager">Manager</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('linkModal')">Cancel</button>
                <button type="button" class="btn btn-primary">Link and Apply Offset</button>
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

        // Filter functionality
        const filters = document.querySelectorAll('.filter-select');
        filters.forEach(filter => {
            filter.addEventListener('change', filterData);
        });

        function filterData() {
            // This would filter data based on selected filters in a real application
            console.log('Filtering data...');
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

        // Simulate import functionality
        document.querySelector('.btn-import').addEventListener('click', function() {
            alert('Importing refund transactions from Disbursement Refund Processing...');
            // In a real application, this would trigger an import process
        });
    </script>
</body>
</html>

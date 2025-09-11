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
            min-width: 150px;
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
            background-color: #ffeaa7;
            color: #d35400;
        }

        .status-ongoing {
            background-color: #81ecec;
            color: #00b894;
        }

        .status-completed {
            background-color: #55efc4;
            color: #00b894;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
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
            width: 80%;
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

        /* Batch Creation */
        .batch-summary {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .summary-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .summary-item strong {
            font-family: 'Montserrat', sans-serif;
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
        }
    </style>

<!-- DASHBOARD MAIN CONTENT -->
<div class="home-section">
  <div class="text">Dashboard</div>
        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <!-- Content Area -->
            <div class="content">
                <h1 class="page-title">Payroll Management</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Total Employees</h3>
                        <p>42</p>
                        <small>August 2025</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3>Total Net Pay</h3>
                        <p>₱423,500.00</p>
                        <small>August 2025</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3>Regular Employees</h3>
                        <p>32</p>
                        <small>68% of workforce</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon red">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <h3>Contractual Employees</h3>
                        <p>10</p>
                        <small>24% of workforce</small>
                    </div>
                </div>

                <!-- Status Overview -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Payroll Status Overview</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                        <span>Draft</span>
                                        <span>12 payrolls</span>
                                    </div>
                                    <div style="height: 10px; background: #f1f2f6; border-radius: 5px; overflow: hidden;">
                                        <div style="height: 100%; width: 30%; background: #ffeaa7;"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                        <span>Ongoing</span>
                                        <span>8 payrolls</span>
                                    </div>
                                    <div style="height: 10px; background: #f1f2f6; border-radius: 5px; overflow: hidden;">
                                        <div style="height: 100%; width: 20%; background: #81ecec;"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                        <span>Completed</span>
                                        <span>20 payrolls</span>
                                    </div>
                                    <div style="height: 10px; background: #f1f2f6; border-radius: 5px; overflow: hidden;">
                                        <div style="height: 100%; width: 50%; background: #55efc4;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-section">
                    <div class="filter-item">
                        <span class="filter-label">Month</span>
                        <select class="filter-select" id="monthFilter">
                            <option value="">All Months</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08" selected>August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <span class="filter-label">Year</span>
                        <select class="filter-select" id="yearFilter">
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025" selected>2025</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <span class="filter-label">Type</span>
                        <select class="filter-select" id="typeFilter">
                            <option value="">All Types</option>
                            <option value="Regular">Regular</option>
                            <option value="Contractual">Contractual</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <span class="filter-label">Status</span>
                        <select class="filter-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="Draft">Draft</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>

                <!-- Payroll Table Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Payroll Records</h2>
                        <div>
                            <button class="btn btn-primary" onclick="openModal('batchModal')"><i class="fas fa-plus"></i> Create Batch</button>
                            <button class="btn btn-download" id="downloadCSV"><i class="fas fa-download"></i> CSV</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="payrollSearch" placeholder="Search Employee ID, Pay Period, or Net Pay...">
                            <button class="btn btn-primary">Search</button>
                        </div>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Pay Period (Begin)</th>
                                        <th>Pay Period (End)</th>
                                        <th>Type</th>
                                        <th>Gross Pay</th>
                                        <th>Net Pay</th>
                                        <th>Pay Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>EMP-001</td>
                                        <td>2025-08-01</td>
                                        <td>2025-08-15</td>
                                        <td>Regular</td>
                                        <td>₱29,500.00</td>
                                        <td>₱28,300.00</td>
                                        <td>2025-08-20</td>
                                        <td><span class="status status-draft">Draft</span></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>EMP-002</td>
                                        <td>2025-08-01</td>
                                        <td>2025-08-15</td>
                                        <td>Contractual</td>
                                        <td>₱42,500.00</td>
                                        <td>₱42,300.00</td>
                                        <td>2025-08-20</td>
                                        <td><span class="status status-ongoing">Ongoing</span></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>EMP-003</td>
                                        <td>2025-08-16</td>
                                        <td>2025-08-31</td>
                                        <td>Regular</td>
                                        <td>₱29,700.00</td>
                                        <td>₱28,900.00</td>
                                        <td>2025-09-05</td>
                                        <td><span class="status status-completed">Completed</span></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>EMP-004</td>
                                        <td>2025-08-01</td>
                                        <td>2025-08-15</td>
                                        <td>Regular</td>
                                        <td>₱24,200.00</td>
                                        <td>₱23,800.00</td>
                                        <td>2025-08-20</td>
                                        <td><span class="status status-draft">Draft</span></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>EMP-005</td>
                                        <td>2025-08-16</td>
                                        <td>2025-08-31</td>
                                        <td>Contractual</td>
                                        <td>₱38,000.00</td>
                                        <td>₱37,200.00</td>
                                        <td>2025-09-05</td>
                                        <td><span class="status status-completed">Completed</span></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Payroll Management</p>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Payroll Details</h2>
                <span class="close" onclick="closeModal('viewModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Employee ID</label>
                            <p>EMP-001</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Employee Name</label>
                            <p>Juan Dela Cruz</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Pay Period</label>
                            <p>2025-08-01 to 2025-08-15</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Type</label>
                            <p>Regular</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Pay Date</label>
                            <p>2025-08-20</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <p><span class="status status-draft">Draft</span></p>
                        </div>
                    </div>
                </div>

                <h3 class="form-label">Earnings</h3>
                <table class="line-items">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Basic Salary</td>
                            <td>₱25,000.00</td>
                        </tr>
                        <tr>
                            <td>Overtime Pay</td>
                            <td>₱3,000.00</td>
                        </tr>
                        <tr>
                            <td>Bonus</td>
                            <td>₱1,500.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: right; font-weight: bold;">Gross Pay:</td>
                            <td>₱29,500.00</td>
                        </tr>
                    </tfoot>
                </table>

                <h3 class="form-label">Deductions</h3>
                <table class="line-items">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tax</td>
                            <td>₱800.00</td>
                        </tr>
                        <tr>
                            <td>SSS</td>
                            <td>₱200.00</td>
                        </tr>
                        <tr>
                            <td>PhilHealth</td>
                            <td>₱100.00</td>
                        </tr>
                        <tr>
                            <td>Pag-IBIG</td>
                            <td>₱100.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: right; font-weight: bold;">Total Deductions:</td>
                            <td>₱1,200.00</td>
                        </tr>
                        <tr>
                            <td style="text-align: right; font-weight: bold;">Net Pay:</td>
                            <td>₱28,300.00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('viewModal')">Close</button>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Reject Payroll</h2>
                <span class="close" onclick="closeModal('rejectModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Employee ID</label>
                    <p>EMP-001</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Employee Name</label>
                    <p>Juan Dela Cruz</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Pay Period</label>
                    <p>2025-08-01 to 2025-08-15</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="rejectReason">Reason for Rejection</label>
                    <textarea class="form-control" id="rejectReason" rows="4" placeholder="Please provide a reason for rejecting this payroll"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('rejectModal')">Cancel</button>
                <button type="button" class="btn btn-danger">Submit Rejection</button>
            </div>
        </div>
    </div>

    <!-- Batch Creation Modal -->
    <div id="batchModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Create Payroll Batch</h2>
                <span class="close" onclick="closeModal('batchModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label" for="batchName">Batch Name</label>
                            <input type="text" class="form-control" id="batchName" placeholder="Enter batch name">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label" for="batchStartDate">Pay Period Start Date</label>
                            <input type="date" class="form-control" id="batchStartDate">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label" for="batchEndDate">Pay Period End Date</label>
                            <input type="date" class="form-control" id="batchEndDate">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label" for="batchType">Type</label>
                            <select class="form-control" id="batchType">
                                <option value="Regular">Regular</option>
                                <option value="Contractual">Contractual</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="batch-summary">
                    <h3 class="form-label">Batch Summary</h3>
                    <div class="summary-item">
                        <span>Number of Employees:</span>
                        <strong>12</strong>
                    </div>
                    <div class="summary-item">
                        <span>Total Gross Pay:</span>
                        <strong>₱352,400.00</strong>
                    </div>
                    <div class="summary-item">
                        <span>Total Net Pay:</span>
                        <strong>₱338,300.00</strong>
                    </div>
                    <div class="summary-item">
                        <span>Total Deductions:</span>
                        <strong>₱14,100.00</strong>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('batchModal')">Cancel</button>
                <button type="button" class="btn btn-primary">Save Draft</button>
                <button type="button" class="btn btn-success">Submit</button>
            </div>
        </div>
    </div>

    <script>
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
        document.getElementById('payrollSearch').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
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
            filter.addEventListener('change', filterTable);
        });

        function filterTable() {
            const monthFilter = document.getElementById('monthFilter').value;
            const yearFilter = document.getElementById('yearFilter').value;
            const typeFilter = document.getElementById('typeFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const periodStart = cells[1].textContent;
                const type = cells[3].textContent;
                const status = cells[7].querySelector('.status').textContent;
                
                let showRow = true;
                
                // Check month filter
                if (monthFilter && !periodStart.includes(`-${monthFilter}-`)) {
                    showRow = false;
                }
                
                // Check year filter
                if (yearFilter && !periodStart.includes(yearFilter)) {
                    showRow = false;
                }
                
                // Check type filter
                if (typeFilter && type !== typeFilter) {
                    showRow = false;
                }
                
                // Check status filter
                if (statusFilter && status !== statusFilter) {
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

        // Set default dates for batch creation
        document.getElementById('batchStartDate').value = '2025-09-01';
        document.getElementById('batchEndDate').value = '2025-09-15';
    </script>

</div>

<script src="../PANEL/ASSETS/js/script-p.js"></script>
</body>
</html>

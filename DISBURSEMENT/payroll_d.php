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
            --payroll-pending: #f39c12;
            --payroll-processing: #3498db;
            --payroll-completed: #2ecc71;
            --payroll-failed: #e74c3c;
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
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: var(--payroll-pending);
            color: white;
        }

        .status-processing {
            background-color: var(--payroll-processing);
            color: white;
        }

        .status-completed {
            background-color: var(--payroll-completed);
            color: white;
        }

        .status-failed {
            background-color: var(--payroll-failed);
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

        .btn-process {
            background-color: #00b894;
            color: white;
        }

        .btn-process:hover {
            background-color: #00a382;
        }

        .btn-export {
            background-color: #74b9ff;
            color: white;
        }

        .btn-export:hover {
            background-color: #0984e3;
        }

        .btn-retry {
            background-color: #f39c12;
            color: white;
        }

        .btn-retry:hover {
            background-color: #e67e22;
        }

        .btn-upload {
            background-color: #9b59b6;
            color: white;
        }

        .btn-upload:hover {
            background-color: #8e44ad;
        }

        .btn-download {
            background-color: #2ecc71;
            color: white;
        }

        .btn-download:hover {
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

        /* Upload Area */
        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            margin-bottom: 20px;
            transition: var(--transition);
            cursor: pointer;
        }

        .upload-area:hover {
            border-color: var(--secondary);
            background-color: #f8f9fa;
        }

        .upload-icon {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 15px;
        }

        .upload-text {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .upload-hint {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px;
        }

        /* Payroll Summary */
        .payroll-summary {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .summary-item {
            flex: 1;
            padding: 15px;
            border-radius: 8px;
            background: white;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .summary-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 10px 0 5px;
        }

        .summary-label {
            font-size: 0.9rem;
            color: #7f8c8d;
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

            .payroll-summary {
                flex-wrap: wrap;
            }
            
            .summary-item {
                flex: 1 0 calc(50% - 15px);
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
            
            .summary-item {
                flex: 1 0 100%;
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
                <h1 class="page-title">Payroll Disbursement</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Employees</h3>
                        <p>142</p>
                        <small>Active employees</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3>Total Payroll</h3>
                        <p>₱2.85M</p>
                        <small>This month</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Pending</h3>
                        <p>28</p>
                        <small>Awaiting processing</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon red">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>Failed</h3>
                        <p>3</p>
                        <small>Requiring attention</small>
                    </div>
                </div>

                <!-- Payroll Summary -->
                <div class="payroll-summary">
                    <div class="summary-item">
                        <i class="fas fa-wallet" style="color: #3498db;"></i>
                        <div class="summary-value">₱2.25M</div>
                        <div class="summary-label">Gross Salary</div>
                    </div>
                    <div class="summary-item">
                        <i class="fas fa-heart" style="color: #2ecc71;"></i>
                        <div class="summary-value">₱350K</div>
                        <div class="summary-label">Benefits</div>
                    </div>
                    <div class="summary-item">
                        <i class="fas fa-minus-circle" style="color: #e74c3c;"></i>
                        <div class="summary-value">₱350K</div>
                        <div class="summary-label">Deductions</div>
                    </div>
                    <div class="summary-item">
                        <i class="fas fa-hand-holding-usd" style="color: #f39c12;"></i>
                        <div class="summary-value">₱2.25M</div>
                        <div class="summary-label">Net Pay</div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="dashboard">Dashboard</div>
                    <div class="tab" data-tab="upload">Batch Upload</div>
                    <div class="tab" data-tab="bank">Bank Instructions</div>
                    <div class="tab" data-tab="exceptions">Exception Handling</div>
                </div>

                <!-- Dashboard Tab -->
                <div class="tab-content active" id="dashboard-tab">
                    <!-- Payroll Status Chart -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Payroll Disbursement Status</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Payroll Period</span>
                                    <select class="filter-select" id="payrollPeriod">
                                        <option value="september">September 2025</option>
                                        <option value="august">August 2025</option>
                                        <option value="july">July 2025</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Department</span>
                                    <select class="filter-select" id="departmentFilter">
                                        <option value="">All Departments</option>
                                        <option value="sales">Sales</option>
                                        <option value="marketing">Marketing</option>
                                        <option value="it">IT</option>
                                        <option value="operations">Operations</option>
                                    </select>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="payrollStatusChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Payroll Runs Table -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Payroll Runs</h2>
                            <div>
                                <button class="btn btn-process"><i class="fas fa-play"></i> Process Selected</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="payrollSearch" placeholder="Search Employee, Department, or Payroll ID...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAll"></th>
                                            <th>Payroll ID</th>
                                            <th>Period</th>
                                            <th>Employees</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                            <th>Processed Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="payroll-checkbox"></td>
                                            <td>PR-2025-09</td>
                                            <td>September 2025</td>
                                            <td>142</td>
                                            <td>₱2,250,000.00</td>
                                            <td><span class="status status-completed">Completed</span></td>
                                            <td>2025-09-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('payrollDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="payroll-checkbox"></td>
                                            <td>PR-2025-08</td>
                                            <td>August 2025</td>
                                            <td>138</td>
                                            <td>₱2,180,000.00</td>
                                            <td><span class="status status-completed">Completed</span></td>
                                            <td>2025-08-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('payrollDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="payroll-checkbox"></td>
                                            <td>PR-2025-07</td>
                                            <td>July 2025</td>
                                            <td>135</td>
                                            <td>₱2,120,000.00</td>
                                            <td><span class="status status-completed">Completed</span></td>
                                            <td>2025-07-05</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('payrollDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="payroll-checkbox"></td>
                                            <td>PR-2025-10</td>
                                            <td>October 2025</td>
                                            <td>142</td>
                                            <td>₱2,280,000.00</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>-</td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('payrollDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-play"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Batch Upload Tab -->
                <div class="tab-content" id="upload-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Payroll Batch Upload</h2>
                        </div>
                        <div class="card-body">
                            <div class="upload-area" id="uploadArea">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="upload-text">Upload Payroll File</div>
                                <div class="upload-hint">Drag & drop your CSV file here or click to browse</div>
                                <input type="file" id="fileInput" style="display: none;" accept=".csv">
                            </div>

                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Payroll Period</label>
                                        <select class="form-control" id="uploadPeriod">
                                            <option value="october">October 2025</option>
                                            <option value="november">November 2025</option>
                                            <option value="december">December 2025</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Payment Date</label>
                                        <input type="date" class="form-control" id="paymentDate" value="2025-10-05">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">File Format</label>
                                <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                    <p><strong>Expected CSV Format:</strong> Employee ID, Employee Name, Department, Basic Salary, Benefits, Deductions, Net Pay</p>
                                    <p><strong>Example:</strong> EMP-001,John Smith,Sales,50000,5000,7500,47500</p>
                                </div>
                            </div>

                            <div style="text-align: center; margin-top: 20px;">
                                <button class="btn btn-upload"><i class="fas fa-upload"></i> Upload & Validate</button>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Download Template</button>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Uploads -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Recent Uploads</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Filename</th>
                                            <th>Upload Date</th>
                                            <th>Payroll Period</th>
                                            <th>Records</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>payroll_september_2025.csv</td>
                                            <td>2025-09-01</td>
                                            <td>September 2025</td>
                                            <td>142</td>
                                            <td><span class="status status-completed">Processed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>payroll_august_2025.csv</td>
                                            <td>2025-08-01</td>
                                            <td>August 2025</td>
                                            <td>138</td>
                                            <td><span class="status status-completed">Processed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>payroll_july_2025.csv</td>
                                            <td>2025-07-01</td>
                                            <td>July 2025</td>
                                            <td>135</td>
                                            <td><span class="status status-completed">Processed</span></td>
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

                <!-- Bank Instructions Tab -->
                <div class="tab-content" id="bank-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Bank Transfer Instruction Generator</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Payroll Run</label>
                                        <select class="form-control" id="bankPayroll">
                                            <option value="">Select a Payroll Run</option>
                                            <option value="pr-2025-09">PR-2025-09 (September 2025)</option>
                                            <option value="pr-2025-08">PR-2025-08 (August 2025)</option>
                                            <option value="pr-2025-07">PR-2025-07 (July 2025)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Bank Format</label>
                                        <select class="form-control" id="bankFormat">
                                            <option value="bpi">BPI</option>
                                            <option value="bdo">BDO</option>
                                            <option value="metrobank">Metrobank</option>
                                            <option value="landbank">Landbank</option>
                                            <option value="ubp">UnionBank</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Payment Date</label>
                                <input type="date" class="form-control" id="bankPaymentDate" value="2025-10-05">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Batch Reference</label>
                                <input type="text" class="form-control" id="batchReference" placeholder="Enter batch reference" value="PAYROLL-2025-10">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Summary</label>
                                <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                    <p><strong>Payroll Run:</strong> PR-2025-09 (September 2025)</p>
                                    <p><strong>Employees:</strong> 142</p>
                                    <p><strong>Total Amount:</strong> ₱2,250,000.00</p>
                                    <p><strong>Bank:</strong> BPI</p>
                                </div>
                            </div>

                            <div style="text-align: center; margin-top: 20px;">
                                <button class="btn btn-export"><i class="fas fa-file-export"></i> Generate Bank File</button>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Download Instructions</button>
                            </div>
                        </div>
                    </div>

                    <!-- Generated Files -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Recently Generated Files</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Filename</th>
                                            <th>Payroll Period</th>
                                            <th>Bank</th>
                                            <th>Generated On</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>payroll_bpi_20250905.csv</td>
                                            <td>September 2025</td>
                                            <td>BPI</td>
                                            <td>2025-09-05</td>
                                            <td><span class="status status-completed">Processed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>payroll_bdo_20250805.csv</td>
                                            <td>August 2025</td>
                                            <td>BDO</td>
                                            <td>2025-08-05</td>
                                            <td><span class="status status-completed">Processed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>payroll_metrobank_20250705.csv</td>
                                            <td>July 2025</td>
                                            <td>Metrobank</td>
                                            <td>2025-07-05</td>
                                            <td><span class="status status-completed">Processed</span></td>
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

                <!-- Exception Handling Tab -->
                <div class="tab-content" id="exceptions-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Exception Handling</h2>
                            <div>
                                <button class="btn btn-retry"><i class="fas fa-redo"></i> Retry Selected</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="exceptionSearch" placeholder="Search Employee, Payroll ID, or Issue...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAllExceptions"></th>
                                            <th>Employee</th>
                                            <th>Payroll ID</th>
                                            <th>Amount</th>
                                            <th>Issue Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="exception-checkbox"></td>
                                            <td>Maria Garcia (EMP-028)</td>
                                            <td>PR-2025-09</td>
                                            <td>₱45,000.00</td>
                                            <td>Invalid Bank Account</td>
                                            <td><span class="status status-failed">Failed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('exceptionDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-retry btn-sm"><i class="fas fa-redo"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="exception-checkbox"></td>
                                            <td>Robert Johnson (EMP-042)</td>
                                            <td>PR-2025-09</td>
                                            <td>₱52,000.00</td>
                                            <td>Account Blocked</td>
                                            <td><span class="status status-failed">Failed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('exceptionDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-retry btn-sm"><i class="fas fa-redo"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="exception-checkbox"></td>
                                            <td>Sarah Williams (EMP-065)</td>
                                            <td>PR-2025-09</td>
                                            <td>₱38,000.00</td>
                                            <td>Insufficient Bank Details</td>
                                            <td><span class="status status-pending">Pending Review</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('exceptionDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-edit"></i></button>
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
                <p>&copy; 2025 Financial System - Payroll Disbursement</p>
            </div>
        </div>
    </div>

    <!-- Payroll Details Modal -->
    <div id="payrollDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Payroll Details: PR-2025-09</h2>
                <span class="close" onclick="closeModal('payrollDetailsModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Payroll Period</label>
                            <p>September 2025</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Payment Date</label>
                            <p>2025-09-05</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Total Employees</label>
                            <p>142</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <p><span class="status status-completed">Completed</span></p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Payroll Summary</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <div class="form-row">
                            <div class="form-col">
                                <p><strong>Gross Salary:</strong> ₱2,250,000.00</p>
                                <p><strong>Benefits:</strong> ₱350,000.00</p>
                            </div>
                            <div class="form-col">
                                <p><strong>Deductions:</strong> ₱350,000.00</p>
                                <p><strong>Net Pay:</strong> ₱2,250,000.00</p>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="form-label">Department Breakdown</h3>
                <div class="chart-container">
                    <canvas id="departmentBreakdownChart"></canvas>
                </div>

                <h3 class="form-label">Employee Payments</h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Basic Salary</th>
                                <th>Benefits</th>
                                <th>Deductions</th>
                                <th>Net Pay</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>EMP-001</td>
                                <td>John Smith</td>
                                <td>Sales</td>
                                <td>₱50,000.00</td>
                                <td>₱5,000.00</td>
                                <td>₱7,500.00</td>
                                <td>₱47,500.00</td>
                                <td><span class="status status-completed">Paid</span></td>
                            </tr>
                            <tr>
                                <td>EMP-002</td>
                                <td>Maria Garcia</td>
                                <td>Marketing</td>
                                <td>₱45,000.00</td>
                                <td>₱4,500.00</td>
                                <td>₱6,750.00</td>
                                <td>₱42,750.00</td>
                                <td><span class="status status-failed">Failed</span></td>
                            </tr>
                            <tr>
                                <td>EMP-003</td>
                                <td>Robert Johnson</td>
                                <td>IT</td>
                                <td>₱60,000.00</td>
                                <td>₱6,000.00</td>
                                <td>₱9,000.00</td>
                                <td>₱57,000.00</td>
                                <td><span class="status status-completed">Paid</span></td>
                            </tr>
                            <tr>
                                <td>EMP-004</td>
                                <td>Sarah Williams</td>
                                <td>Operations</td>
                                <td>₱42,000.00</td>
                                <td>₱4,200.00</td>
                                <td>₱6,300.00</td>
                                <td>₱39,900.00</td>
                                <td><span class="status status-completed">Paid</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label class="form-label">GL Posting Details</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>Payroll Expense:</strong> ₱2,250,000.00 (Debit)</p>
                        <p><strong>Cash Account:</strong> ₱2,250,000.00 (Credit)</p>
                        <p><strong>Posted on:</strong> 2025-09-05 14:30</p>
                        <p><strong>Reference:</strong> GL-2025-00985</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('payrollDetailsModal')">Close</button>
                <button type="button" class="btn btn-download">Download Report</button>
            </div>
        </div>
    </div>

    <!-- Exception Details Modal -->
    <div id="exceptionDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Exception Details: Maria Garcia</h2>
                <span class="close" onclick="closeModal('exceptionDetailsModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Employee</label>
                            <p>Maria Garcia (EMP-028)</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Payroll Period</label>
                            <p>September 2025</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Net Pay Amount</label>
                            <p>₱45,000.00</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Issue Type</label>
                            <p>Invalid Bank Account</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Error Details</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>Error Code:</strong> BANK_ACC_INVALID</p>
                        <p><strong>Error Message:</strong> The specified bank account number does not exist or is invalid.</p>
                        <p><strong>Bank:</strong> BPI</p>
                        <p><strong>Account Number:</strong> 1234-5678-9012-3456</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Resolution Steps</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <ol>
                            <li>Contact employee to verify bank account details</li>
                            <li>Update employee record with correct bank information</li>
                            <li>Retry payment processing</li>
                            <li>If unsuccessful, issue manual check</li>
                        </ol>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Update Bank Details</label>
                    <div class="form-row">
                        <div class="form-col">
                            <input type="text" class="form-control" placeholder="Bank Name" value="BPI">
                        </div>
                        <div class="form-col">
                            <input type="text" class="form-control" placeholder="Account Number" value="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Resolution Notes</label>
                    <textarea class="form-control" rows="3" placeholder="Add notes about the resolution"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('exceptionDetailsModal')">Cancel</button>
                <button type="button" class="btn btn-retry">Retry Payment</button>
                <button type="button" class="btn btn-process">Issue Manual Check</button>
            </div>
        </div>
    </div>

</div>

<script src="../PANEL/ASSETS/js/script-p.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        // File upload functionality
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        
        uploadArea.addEventListener('click', function() {
            fileInput.click();
        });
        
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = 'var(--secondary)';
            this.style.backgroundColor = '#f8f9fa';
        });
        
        uploadArea.addEventListener('dragleave', function() {
            this.style.borderColor = '#ddd';
            this.style.backgroundColor = 'transparent';
        });
        
        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#ddd';
            this.style.backgroundColor = 'transparent';
            
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                // Handle the file upload
                handleFileUpload(e.dataTransfer.files[0]);
            }
        });
        
        fileInput.addEventListener('change', function() {
            if (this.files.length) {
                handleFileUpload(this.files[0]);
            }
        });
        
        function handleFileUpload(file) {
            const uploadText = uploadArea.querySelector('.upload-text');
            uploadText.textContent = `File selected: ${file.name}`;
        }

        // Select all functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.payroll-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

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

        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // Payroll Status Chart
            const payrollStatusCtx = document.getElementById('payrollStatusChart').getContext('2d');
            new Chart(payrollStatusCtx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September'],
                    datasets: [{
                        label: 'Payroll Amount (₱)',
                        data: [1850000, 1920000, 2050000, 1980000, 2150000, 2250000, 2120000, 2180000, 2250000],
                        backgroundColor: 'rgba(52, 152, 219, 0.7)',
                        borderColor: 'rgba(52, 152, 219, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Amount (₱)'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Monthly Payroll Trends 2025'
                        }
                    }
                }
            });

            // Department Breakdown Chart
            const departmentBreakdownCtx = document.getElementById('departmentBreakdownChart').getContext('2d');
            new Chart(departmentBreakdownCtx, {
                type: 'pie',
                data: {
                    labels: ['Sales', 'Marketing', 'IT', 'Operations', 'HR', 'Finance'],
                    datasets: [{
                        data: [650000, 450000, 550000, 350000, 150000, 100000],
                        backgroundColor: [
                            'rgba(52, 152, 219, 0.7)',
                            'rgba(46, 204, 113, 0.7)',
                            'rgba(155, 89, 182, 0.7)',
                            'rgba(241, 196, 15, 0.7)',
                            'rgba(230, 126, 34, 0.7)',
                            'rgba(231, 76, 60, 0.7)'
                        ],
                        borderColor: [
                            'rgba(52, 152, 219, 1)',
                            'rgba(46, 204, 113, 1)',
                            'rgba(155, 89, 182, 1)',
                            'rgba(241, 196, 15, 1)',
                            'rgba(230, 126, 34, 1)',
                            'rgba(231, 76, 60, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Payroll Distribution by Department'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>

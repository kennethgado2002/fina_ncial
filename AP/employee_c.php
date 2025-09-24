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
        }

        .search-box input {
            width: 100%;
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
            background-color: #ffeaa7;
            color: #d35400;
        }

        .status-approved {
            background-color: #55efc4;
            color: #00b894;
        }

        .status-rejected {
            background-color: #ff7675;
            color: #d63031;
        }

        .status-processing {
            background-color: #81ecec;
            color: #00b894;
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

        .btn-submit {
            background-color: #3498db;
            color: white;
        }

        .btn-submit:hover {
            background-color: #2980b9;
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
            max-width: 700px;
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

        /* Attachment Preview */
        .attachment-preview {
            margin-top: 20px;
            padding: 15px;
            border: 1px dashed #ddd;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .attachment-preview:hover {
            border-color: var(--secondary);
            background-color: #f8f9fa;
        }

        .attachment-preview i {
            font-size: 2rem;
            color: #7f8c8d;
            margin-bottom: 10px;
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
            
            .modal-content {
                width: 95%;
                margin: 10% auto;
            }
        }
    </style>

<!-- DASHBOARD MAIN CONTENT -->
<div class="home-section">
  <div class="text">Dashboard</div>
    <div class="container">

        <!-- Main Content -->
        <div class="main-content" id="main-content">

            <!-- Content Area -->
            <div class="content">
                <h1 class="page-title">Employee Reimbursement Management</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <h3>Total Claim Amount</h3>
                        <p>₱85,750.00</p>
                        <small>+12% from last month</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h3>Total Claims</h3>
                        <p>42</p>
                        <small>+8% from last month</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Pending Claims</h3>
                        <p>15</p>
                        <small>Waiting for approval</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>Rejected Claims</h3>
                        <p>5</p>
                        <small>Require attention</small>
                    </div>
                </div>

                <!-- Claim Type Breakdown -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Claims by Type</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                        <span>Travel Expenses</span>
                                        <span>₱32,500.00 (18 claims)</span>
                                    </div>
                                    <div style="height: 10px; background: #f1f2f6; border-radius: 5px; overflow: hidden;">
                                        <div style="height: 100%; width: 38%; background: #3498db;"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                        <span>Meals & Entertainment</span>
                                        <span>₱18,250.00 (12 claims)</span>
                                    </div>
                                    <div style="height: 10px; background: #f1f2f6; border-radius: 5px; overflow: hidden;">
                                        <div style="height: 100%; width: 21%; background: #2ecc71;"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                        <span>Office Supplies</span>
                                        <span>₱12,800.00 (7 claims)</span>
                                    </div>
                                    <div style="height: 10px; background: #f1f2f6; border-radius: 5px; overflow: hidden;">
                                        <div style="height: 100%; width: 15%; background: #f39c12;"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                        <span>Training & Education</span>
                                        <span>₱22,200.00 (5 claims)</span>
                                    </div>
                                    <div style="height: 10px; background: #f1f2f6; border-radius: 5px; overflow: hidden;">
                                        <div style="height: 100%; width: 26%; background: #9b59b6;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reimbursement Table Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Reimbursement Claims</h2>
                        <div>
                            <button class="btn btn-download" id="downloadCSV"><i class="fas fa-download"></i> CSV</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="claimSearch" placeholder="Search Claim ID, Employee ID, Name, or Claim Type...">
                        </div>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Claim ID</th>
                                        <th>Employee ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Claim Type</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Attachment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>CLM-2025-0001</td>
                                        <td>EMP-001</td>
                                        <td>Juan</td>
                                        <td>Dela Cruz</td>
                                        <td>Travel Expenses</td>
                                        <td>2025-09-05</td>
                                        <td>₱8,500.00</td>
                                        <td><span class="status status-pending">Pending</span></td>
                                        <td><i class="fas fa-paperclip"></i></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                            <button class="btn btn-submit btn-sm"><i class="fas fa-paper-plane"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CLM-2025-0002</td>
                                        <td>EMP-003</td>
                                        <td>Maria</td>
                                        <td>Santos</td>
                                        <td>Meals & Entertainment</td>
                                        <td>2025-09-07</td>
                                        <td>₱3,200.00</td>
                                        <td><span class="status status-approved">Approved</span></td>
                                        <td><i class="fas fa-paperclip"></i></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                            <button class="btn btn-submit btn-sm"><i class="fas fa-paper-plane"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CLM-2025-0003</td>
                                        <td>EMP-007</td>
                                        <td>Pedro</td>
                                        <td>Reyes</td>
                                        <td>Office Supplies</td>
                                        <td>2025-09-10</td>
                                        <td>₱5,800.00</td>
                                        <td><span class="status status-rejected">Rejected</span></td>
                                        <td><i class="fas fa-paperclip"></i></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                            <button class="btn btn-submit btn-sm"><i class="fas fa-paper-plane"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CLM-2025-0004</td>
                                        <td>EMP-012</td>
                                        <td>Ana</td>
                                        <td>Garcia</td>
                                        <td>Training & Education</td>
                                        <td>2025-09-12</td>
                                        <td>₱12,500.00</td>
                                        <td><span class="status status-processing">Processing</span></td>
                                        <td><i class="fas fa-paperclip"></i></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                            <button class="btn btn-submit btn-sm"><i class="fas fa-paper-plane"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CLM-2025-0005</td>
                                        <td>EMP-008</td>
                                        <td>Luis</td>
                                        <td>Torres</td>
                                        <td>Travel Expenses</td>
                                        <td>2025-09-15</td>
                                        <td>₱7,300.00</td>
                                        <td><span class="status status-approved">Approved</span></td>
                                        <td><i class="fas fa-paperclip"></i></td>
                                        <td>
                                            <button class="btn btn-view btn-sm" onclick="openModal('viewModal')"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-reject btn-sm" onclick="openModal('rejectModal')"><i class="fas fa-times"></i></button>
                                            <button class="btn btn-submit btn-sm"><i class="fas fa-paper-plane"></i></button>
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
                <p>&copy; 2025 Financial System - Employee Reimbursement Management</p>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Reimbursement Claim Details</h2>
                <span class="close" onclick="closeModal('viewModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Claim ID</label>
                            <p>CLM-2025-0001</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Employee ID</label>
                            <p>EMP-001</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <p>Juan</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <p>Dela Cruz</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Claim Type</label>
                            <p>Travel Expenses</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Amount</label>
                            <p>₱8,500.00</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Date of Expense</label>
                            <p>2025-09-01</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Date of Claim</label>
                            <p>2025-09-05</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <p>Business trip to client site in Cebu. Includes airfare, hotel accommodation, and local transportation.</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Expense Breakdown</label>
                    <table class="line-items">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Airfare - Manila to Cebu</td>
                                <td>₱4,200.00</td>
                                <td>2025-09-01</td>
                            </tr>
                            <tr>
                                <td>Hotel Accommodation (3 nights)</td>
                                <td>₱3,000.00</td>
                                <td>2025-09-01 to 2025-09-03</td>
                            </tr>
                            <tr>
                                <td>Local Transportation</td>
                                <td>₱1,300.00</td>
                                <td>2025-09-02</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style="text-align: right; font-weight: bold;">Total:</td>
                                <td>₱8,500.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="form-group">
                    <label class="form-label">Attachment</label>
                    <div class="attachment-preview" onclick="openModal('attachmentModal')">
                        <i class="fas fa-file-pdf"></i>
                        <p>receipts_clm_20250001.pdf (Click to view)</p>
                    </div>
                </div>
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
                <h2 class="modal-title">Reject Reimbursement Claim</h2>
                <span class="close" onclick="closeModal('rejectModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Claim ID</label>
                    <p>CLM-2025-0001</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Employee</label>
                    <p>Juan Dela Cruz (EMP-001)</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="rejectReason">Reason for Rejection</label>
                    <textarea class="form-control" id="rejectReason" rows="4" placeholder="Please provide a reason for rejecting this claim"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('rejectModal')">Cancel</button>
                <button type="button" class="btn btn-danger">Submit Rejection</button>
            </div>
        </div>
    </div>

    <!-- Attachment Modal -->
    <div id="attachmentModal" class="modal">
        <div class="modal-content" style="max-width: 800px;">
            <div class="modal-header">
                <h2 class="modal-title">Claim Attachment</h2>
                <span class="close" onclick="closeModal('attachmentModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div style="text-align: center; padding: 20px;">
                    <i class="fas fa-file-pdf" style="font-size: 4rem; color: #e74c3c;"></i>
                    <h3 style="margin: 20px 0;">receipts_clm_20250001.pdf</h3>
                    <embed src="#" width="100%" height="500px" style="border: 1px solid #ddd; border-radius: 8px;" />
                    <div style="margin-top: 20px;">
                        <button class="btn btn-primary"><i class="fas fa-download"></i> Download</button>
                        <button class="btn btn-secondary"><i class="fas fa-print"></i> Print</button>
                    </div>
                </div>
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
        document.getElementById('claimSearch').addEventListener('input', function() {
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

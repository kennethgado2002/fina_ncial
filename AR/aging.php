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
            --current: #2ecc71;
            --days30: #3498db;
            --days60: #f39c12;
            --days90: #e74c3c;
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

        .status-current {
            background-color: var(--current);
            color: white;
        }

        .status-days30 {
            background-color: var(--days30);
            color: white;
        }

        .status-days60 {
            background-color: var(--days60);
            color: white;
        }

        .status-days90 {
            background-color: var(--days90);
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

        .btn-send {
            background-color: #00b894;
            color: white;
        }

        .btn-send:hover {
            background-color: #00a382;
        }

        .btn-flag {
            background-color: #f39c12;
            color: white;
        }

        .btn-flag:hover {
            background-color: #e67e22;
        }

        .btn-writeoff {
            background-color: #e74c3c;
            color: white;
        }

        .btn-writeoff:hover {
            background-color: #c0392b;
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
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-title .status {
            font-size: 0.8rem;
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

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px;
        }

        /* Aging Buckets */
        .aging-buckets {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .aging-bucket {
            flex: 1;
            padding: 15px;
            border-radius: 8px;
            color: white;
            text-align: center;
        }

        .bucket-current {
            background-color: var(--current);
        }

        .bucket-days30 {
            background-color: var(--days30);
        }

        .bucket-days60 {
            background-color: var(--days60);
        }

        .bucket-days90 {
            background-color: var(--days90);
        }

        .bucket-amount {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 10px 0 5px;
        }

        .bucket-label {
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

            .aging-buckets {
                flex-wrap: wrap;
            }
            
            .aging-bucket {
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
            
            .aging-bucket {
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
                <h1 class="page-title">AR Aging & Reports</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h3>Total Receivables</h3>
                        <p>₱2.85M</p>
                        <small>As of September 9, 2025</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Overdue Invoices</h3>
                        <p>42</p>
                        <small>Requiring attention</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>Average Days Late</h3>
                        <p>38</p>
                        <small>Across all customers</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>Bad Debt Risk</h3>
                        <p>₱425K</p>
                        <small>Potential write-offs</small>
                    </div>
                </div>

                <!-- Aging Buckets -->
                <div class="aging-buckets">
                    <div class="aging-bucket bucket-current">
                        <i class="fas fa-check-circle"></i>
                        <div class="bucket-amount">₱1.25M</div>
                        <div class="bucket-label">Current (0-30 days)</div>
                    </div>
                    <div class="aging-bucket bucket-days30">
                        <i class="fas fa-clock"></i>
                        <div class="bucket-amount">₱685K</div>
                        <div class="bucket-label">31-60 Days Overdue</div>
                    </div>
                    <div class="aging-bucket bucket-days60">
                        <i class="fas fa-exclamation-circle"></i>
                        <div class="bucket-amount">₱525K</div>
                        <div class="bucket-label">61-90 Days Overdue</div>
                    </div>
                    <div class="aging-bucket bucket-days90">
                        <i class="fas fa-times-circle"></i>
                        <div class="bucket-amount">₱390K</div>
                        <div class="bucket-label">90+ Days Overdue</div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="aging">Aging Report</div>
                    <div class="tab" data-tab="statements">Customer Statements</div>
                    <div class="tab" data-tab="trends">Collection Trends</div>
                    <div class="tab" data-tab="baddebt">Bad Debt Report</div>
                </div>

                <!-- Aging Report Tab -->
                <div class="tab-content active" id="aging-tab">
                    <!-- Aging Report Table -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Accounts Receivable Aging Report</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="agingSearch" placeholder="Search Customer, Invoice, or Account...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Total Balance</th>
                                            <th>Current</th>
                                            <th>1-30 Days</th>
                                            <th>31-60 Days</th>
                                            <th>61-90 Days</th>
                                            <th>90+ Days</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Global Equipment Inc.</td>
                                            <td>₱425,000.00</td>
                                            <td>₱125,000.00</td>
                                            <td>₱150,000.00</td>
                                            <td>₱100,000.00</td>
                                            <td>₱50,000.00</td>
                                            <td>₱0.00</td>
                                            <td><span class="status status-days30">Watch</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('customerDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-flag btn-sm"><i class="fas fa-flag"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tech Solutions Ltd.</td>
                                            <td>₱285,000.00</td>
                                            <td>₱85,000.00</td>
                                            <td>₱75,000.00</td>
                                            <td>₱65,000.00</td>
                                            <td>₱35,000.00</td>
                                            <td>₱25,000.00</td>
                                            <td><span class="status status-days60">Alert</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('customerDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-flag btn-sm"><i class="fas fa-flag"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Office Supplies Co.</td>
                                            <td>₱150,000.00</td>
                                            <td>₱75,000.00</td>
                                            <td>₱50,000.00</td>
                                            <td>₱15,000.00</td>
                                            <td>₱10,000.00</td>
                                            <td>₱0.00</td>
                                            <td><span class="status status-current">Good</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('customerDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-flag btn-sm"><i class="fas fa-flag"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>XYZ Technologies</td>
                                            <td>₱625,000.00</td>
                                            <td>₱200,000.00</td>
                                            <td>₱150,000.00</td>
                                            <td>₱125,000.00</td>
                                            <td>₱100,000.00</td>
                                            <td>₱50,000.00</td>
                                            <td><span class="status status-days90">Critical</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('customerDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-flag btn-sm"><i class="fas fa-flag"></i></button>
                                                <button class="btn btn-writeoff btn-sm"><i class="fas fa-ban"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ABC Suppliers</td>
                                            <td>₱325,000.00</td>
                                            <td>₱175,000.00</td>
                                            <td>₱100,000.00</td>
                                            <td>₱35,000.00</td>
                                            <td>₱15,000.00</td>
                                            <td>₱0.00</td>
                                            <td><span class="status status-current">Good</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('customerDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-flag btn-sm"><i class="fas fa-flag"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Statements Tab -->
                <div class="tab-content" id="statements-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Customer Statement Generator</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Select Customer</label>
                                        <select class="form-control" id="statementCustomer">
                                            <option value="">Select a Customer</option>
                                            <option value="global">Global Equipment Inc.</option>
                                            <option value="tech">Tech Solutions Ltd.</option>
                                            <option value="office">Office Supplies Co.</option>
                                            <option value="xyz">XYZ Technologies</option>
                                            <option value="abc">ABC Suppliers</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Statement Period</label>
                                        <select class="form-control" id="statementPeriod">
                                            <option value="august">August 2025</option>
                                            <option value="july">July 2025</option>
                                            <option value="q3">Q3 2025</option>
                                            <option value="custom">Custom Range</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row" id="customRange" style="display: none;">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="startDate">
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="endDate">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Delivery Method</label>
                                <div style="display: flex; gap: 15px;">
                                    <label style="display: flex; align-items: center;">
                                        <input type="radio" name="deliveryMethod" value="email" checked> Email
                                    </label>
                                    <label style="display: flex; align-items: center;">
                                        <input type="radio" name="deliveryMethod" value="download"> Download PDF
                                    </label>
                                    <label style="display: flex; align-items: center;">
                                        <input type="radio" name="deliveryMethod" value="print"> Print
                                    </label>
                                </div>
                            </div>

                            <div id="emailOptions">
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="customerEmail" placeholder="Enter customer email address">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Additional Message (Optional)</label>
                                    <textarea class="form-control" id="emailMessage" rows="3" placeholder="Add a custom message to the email"></textarea>
                                </div>
                            </div>

                            <div style="text-align: center; margin-top: 20px;">
                                <button class="btn btn-send"><i class="fas fa-paper-plane"></i> Generate Statement</button>
                                <button class="btn btn-view"><i class="fas fa-eye"></i> Preview</button>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Statements -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Recently Generated Statements</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Statement Period</th>
                                            <th>Generated On</th>
                                            <th>Delivery Method</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Global Equipment Inc.</td>
                                            <td>August 2025</td>
                                            <td>2025-09-01</td>
                                            <td>Email</td>
                                            <td><span class="status status-current">Delivered</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tech Solutions Ltd.</td>
                                            <td>August 2025</td>
                                            <td>2025-09-01</td>
                                            <td>Download</td>
                                            <td><span class="status status-current">Generated</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Office Supplies Co.</td>
                                            <td>July 2025</td>
                                            <td>2025-08-01</td>
                                            <td>Email</td>
                                            <td><span class="status status-current">Delivered</span></td>
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

                <!-- Collection Trends Tab -->
                <div class="tab-content" id="trends-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Collection Trends & Performance</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export Report</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Time Period</span>
                                    <select class="filter-select" id="trendPeriod">
                                        <option value="q3">Q3 2025</option>
                                        <option value="q2">Q2 2025</option>
                                        <option value="q1">Q1 2025</option>
                                        <option value="year">Full Year 2025</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Customer Segment</span>
                                    <select class="filter-select" id="customerSegment">
                                        <option value="">All Customers</option>
                                        <option value="corporate">Corporate</option>
                                        <option value="sme">SME</option>
                                        <option value="individual">Individual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="collectionTrendChart"></canvas>
                            </div>
                            <div class="chart-container">
                                <canvas id="agingTrendChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bad Debt Report Tab -->
                <div class="tab-content" id="baddebt-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Bad Debt Risk Report</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="badDebtSearch" placeholder="Search Customer or Account...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Total Balance</th>
                                            <th>Over 90 Days</th>
                                            <th>Last Payment</th>
                                            <th>Days Since Payment</th>
                                            <th>Risk Score</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>XYZ Technologies</td>
                                            <td>₱625,000.00</td>
                                            <td>₱150,000.00</td>
                                            <td>2025-06-15</td>
                                            <td>86</td>
                                            <td>92%</td>
                                            <td><span class="status status-days90">High Risk</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('customerDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-writeoff btn-sm"><i class="fas fa-ban"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tech Solutions Ltd.</td>
                                            <td>₱285,000.00</td>
                                            <td>₱60,000.00</td>
                                            <td>2025-07-20</td>
                                            <td>51</td>
                                            <td>78%</td>
                                            <td><span class="status status-days60">Medium Risk</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('customerDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-flag btn-sm"><i class="fas fa-flag"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Delta Manufacturing</td>
                                            <td>₱425,000.00</td>
                                            <td>₱125,000.00</td>
                                            <td>2025-05-30</td>
                                            <td>102</td>
                                            <td>95%</td>
                                            <td><span class="status status-days90">Critical Risk</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('customerDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-writeoff btn-sm"><i class="fas fa-ban"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Global Equipment Inc.</td>
                                            <td>₱425,000.00</td>
                                            <td>₱0.00</td>
                                            <td>2025-08-25</td>
                                            <td>15</td>
                                            <td>25%</td>
                                            <td><span class="status status-current">Low Risk</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('customerDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-flag btn-sm"><i class="fas fa-flag"></i></button>
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
                <p>&copy; 2025 Financial System - AR Aging & Reports</p>
            </div>
        </div>
    </div>

    <!-- Customer Details Modal -->
    <div id="customerDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">
                    XYZ Technologies
                    <span class="status status-days90">Critical Risk</span>
                </h2>
                <span class="close" onclick="closeModal('customerDetailsModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Customer ID</label>
                            <p>CUST-0285</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Account Manager</label>
                            <p>Sarah Johnson</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Total Balance</label>
                            <p>₱625,000.00</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Credit Limit</label>
                            <p>₱500,000.00</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Last Payment Date</label>
                            <p>2025-06-15</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Last Payment Amount</label>
                            <p>₱75,000.00</p>
                        </div>
                    </div>
                </div>

                <h3 class="form-label">Aging Breakdown</h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Period</th>
                                <th>Amount</th>
                                <th>% of Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Current (0-30 days)</td>
                                <td>₱200,000.00</td>
                                <td>32%</td>
                                <td><span class="status status-current">Current</span></td>
                            </tr>
                            <tr>
                                <td>31-60 days</td>
                                <td>₱150,000.00</td>
                                <td>24%</td>
                                <td><span class="status status-days30">Watch</span></td>
                            </tr>
                            <tr>
                                <td>61-90 days</td>
                                <td>₱125,000.00</td>
                                <td>20%</td>
                                <td><span class="status status-days60">Alert</span></td>
                            </tr>
                            <tr>
                                <td>90+ days</td>
                                <td>₱150,000.00</td>
                                <td>24%</td>
                                <td><span class="status status-days90">Critical</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="form-label">Recent Invoices</h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Due Date</th>
                                <th>Days Overdue</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>INV-2025-105</td>
                                <td>2025-08-15</td>
                                <td>₱85,000.00</td>
                                <td>2025-09-14</td>
                                <td>0</td>
                                <td><span class="status status-current">Current</span></td>
                            </tr>
                            <tr>
                                <td>INV-2025-092</td>
                                <td>2025-07-20</td>
                                <td>₱125,000.00</td>
                                <td>2025-08-19</td>
                                <td>21</td>
                                <td><span class="status status-days30">30 Days</span></td>
                            </tr>
                            <tr>
                                <td>INV-2025-078</td>
                                <td>2025-06-15</td>
                                <td>₱175,000.00</td>
                                <td>2025-07-15</td>
                                <td>56</td>
                                <td><span class="status status-days60">60 Days</span></td>
                            </tr>
                            <tr>
                                <td>INV-2025-065</td>
                                <td>2025-05-10</td>
                                <td>₱150,000.00</td>
                                <td>2025-06-09</td>
                                <td>92</td>
                                <td><span class="status status-days90">90+ Days</span></td>
                            </tr>
                            <tr>
                                <td>INV-2025-051</td>
                                <td>2025-04-05</td>
                                <td>₱90,000.00</td>
                                <td>2025-05-05</td>
                                <td>127</td>
                                <td><span class="status status-days90">90+ Days</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="form-label">Collection History</h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Contact Method</th>
                                <th>Contact Person</th>
                                <th>Notes</th>
                                <th>Follow-up Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2025-09-05</td>
                                <td>Phone Call</td>
                                <td>Sarah Johnson</td>
                                <td>Spoke with accounts payable. Promised payment by next week.</td>
                                <td>2025-09-12</td>
                            </tr>
                            <tr>
                                <td>2025-08-28</td>
                                <td>Email</td>
                                <td>Michael Chen</td>
                                <td>Sent payment reminder with statement.</td>
                                <td>2025-09-04</td>
                            </tr>
                            <tr>
                                <td>2025-08-15</td>
                                <td>Phone Call</td>
                                <td>Sarah Johnson</td>
                                <td>Discussed payment plan for overdue invoices.</td>
                                <td>2025-08-22</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('customerDetailsModal')">Close</button>
                <button type="button" class="btn btn-primary">Generate Statement</button>
                <button type="button" class="btn btn-flag">Add Collection Note</button>
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

        // Search functionality
        document.getElementById('agingSearch').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('#aging-tab tbody tr');
            
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

        // Custom date range toggle
        document.getElementById('statementPeriod').addEventListener('change', function() {
            const customRange = document.getElementById('customRange');
            customRange.style.display = this.value === 'custom' ? 'flex' : 'none';
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
            // Collection Trend Chart
            const collectionTrendCtx = document.getElementById('collectionTrendChart').getContext('2d');
            new Chart(collectionTrendCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                    datasets: [
                        {
                            label: 'Amount Collected',
                            data: [1250000, 1350000, 1420000, 1380000, 1520000, 1480000, 1620000, 1580000],
                            backgroundColor: 'rgba(46, 204, 113, 0.2)',
                            borderColor: 'rgba(46, 204, 113, 1)',
                            borderWidth: 2,
                            fill: true
                        },
                        {
                            label: 'Amount Billed',
                            data: [1850000, 1920000, 2050000, 1980000, 2150000, 2250000, 2320000, 2450000],
                            backgroundColor: 'rgba(52, 152, 219, 0.2)',
                            borderColor: 'rgba(52, 152, 219, 1)',
                            borderWidth: 2,
                            fill: true
                        }
                    ]
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
                            text: 'Collection vs Billing Trends 2025'
                        }
                    }
                }
            });

            // Aging Trend Chart
            const agingTrendCtx = document.getElementById('agingTrendChart').getContext('2d');
            new Chart(agingTrendCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                    datasets: [
                        {
                            label: 'Current',
                            data: [850000, 920000, 875000, 890000, 925000, 950000, 985000, 1250000],
                            backgroundColor: 'rgba(46, 204, 113, 0.7)',
                            borderColor: 'rgba(46, 204, 113, 1)',
                            borderWidth: 1
                        },
                        {
                            label: '1-30 Days',
                            data: [250000, 285000, 315000, 295000, 325000, 350000, 385000, 685000],
                            backgroundColor: 'rgba(52, 152, 219, 0.7)',
                            borderColor: 'rgba(52, 152, 219, 1)',
                            borderWidth: 1
                        },
                        {
                            label: '31-60 Days',
                            data: [150000, 165000, 185000, 175000, 195000, 215000, 245000, 525000],
                            backgroundColor: 'rgba(243, 156, 18, 0.7)',
                            borderColor: 'rgba(243, 156, 18, 1)',
                            borderWidth: 1
                        },
                        {
                            label: '61-90+ Days',
                            data: [85000, 95000, 115000, 125000, 145000, 165000, 195000, 390000],
                            backgroundColor: 'rgba(231, 76, 60, 0.7)',
                            borderColor: 'rgba(231, 76, 60, 1)',
                            borderWidth: 1
                        }
                    ]
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
                            text: 'Aging Trends 2025'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>

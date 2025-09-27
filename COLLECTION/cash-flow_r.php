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
            --inflow: #2ecc71;
            --outflow: #e74c3c;
            --forecast: #3498db;
            --alert: #f39c12;
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

        .card-icon.inflow {
            background-color: rgba(46, 204, 113, 0.2);
            color: #27ae60;
        }

        .card-icon.outflow {
            background-color: rgba(231, 76, 60, 0.2);
            color: #c0392b;
        }

        .card-icon.forecast {
            background-color: rgba(52, 152, 219, 0.2);
            color: #2980b9;
        }

        .card-icon.alert {
            background-color: rgba(243, 156, 18, 0.2);
            color: #d35400;
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

        .status-healthy {
            background-color: var(--success);
            color: white;
        }

        .status-warning {
            background-color: var(--warning);
            color: white;
        }

        .status-critical {
            background-color: var(--accent);
            color: white;
        }

        .status-positive {
            background-color: var(--success);
            color: white;
        }

        .status-negative {
            background-color: var(--accent);
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

        .btn-sync {
            background-color: #3498db;
            color: white;
        }

        .btn-sync:hover {
            background-color: #2980b9;
        }

        .btn-export {
            background-color: #9b59b6;
            color: white;
        }

        .btn-export:hover {
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

        /* Alert Panel */
        .alert-panel {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .alert-header {
            padding: 15px 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
            background-color: rgba(243, 156, 18, 0.2);
            color: #d35400;
        }

        .alert-body {
            padding: 20px;
        }

        .alert-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
            transition: var(--transition);
        }

        .alert-item:last-child {
            border-bottom: none;
        }

        .alert-item:hover {
            background-color: #f8f9fa;
        }

        .alert-critical {
            border-left: 4px solid var(--accent);
        }

        .alert-warning {
            border-left: 4px solid var(--warning);
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
                <h1 class="page-title">Cash Flow Reporting</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon inflow">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                        <h3>Total Inflows</h3>
                        <p>₱856,300</p>
                        <small>This month</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon outflow">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                        <h3>Total Outflows</h3>
                        <p>₱724,500</p>
                        <small>This month</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon forecast">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h3>Forecast Variance</h3>
                        <p>+₱45,800</p>
                        <small>5.4% above forecast</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon alert">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3>Liquidity Alerts</h3>
                        <p>2</p>
                        <small>Requires attention</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="dashboard">Daily Inflow Dashboard</div>
                    <div class="tab" data-tab="netposition">Net Cash Position</div>
                    <div class="tab" data-tab="variance">Forecast Variance</div>
                    <div class="tab" data-tab="alerts">Liquidity Alerts</div>
                </div>

                <!-- Daily Inflow Dashboard Tab -->
                <div class="tab-content active" id="dashboard-tab">
                    <!-- Inflow Sources Chart -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Daily Inflow Sources</h2>
                            <div>
                                <button class="btn btn-sync"><i class="fas fa-sync-alt"></i> Sync Data</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <!-- Chart would be implemented with a library like Chart.js in a real application -->
                                <div style="display: flex; align-items: flex-end; height: 100%; gap: 20px; justify-content: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="background: #2ecc71; width: 60px; height: 200px; border-radius: 5px;"></div>
                                        <span style="margin-top: 10px;">Gateway</span>
                                        <span>₱456,300</span>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="background: #3498db; width: 60px; height: 150px; border-radius: 5px;"></div>
                                        <span style="margin-top: 10px;">COD</span>
                                        <span>₱245,800</span>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="background: #9b59b6; width: 60px; height: 120px; border-radius: 5px;"></div>
                                        <span style="margin-top: 10px;">Bank Deposits</span>
                                        <span>₱154,200</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Gateway</th>
                                            <th>COD</th>
                                            <th>Bank Deposits</th>
                                            <th>Total Inflow</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2025-09-09</td>
                                            <td>₱45,300</td>
                                            <td>₱28,500</td>
                                            <td>₱15,200</td>
                                            <td>₱89,000</td>
                                            <td><span class="status status-healthy">Reconciled</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-08</td>
                                            <td>₱42,800</td>
                                            <td>₱25,700</td>
                                            <td>₱14,500</td>
                                            <td>₱83,000</td>
                                            <td><span class="status status-healthy">Reconciled</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-07</td>
                                            <td>₱38,900</td>
                                            <td>₱22,300</td>
                                            <td>₱12,800</td>
                                            <td>₱74,000</td>
                                            <td><span class="status status-healthy">Reconciled</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-06</td>
                                            <td>₱40,200</td>
                                            <td>₱24,100</td>
                                            <td>₱13,500</td>
                                            <td>₱77,800</td>
                                            <td><span class="status status-healthy">Reconciled</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-05</td>
                                            <td>₱43,500</td>
                                            <td>₱26,800</td>
                                            <td>₱14,900</td>
                                            <td>₱85,200</td>
                                            <td><span class="status status-healthy">Reconciled</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Net Cash Position Tab -->
                <div class="tab-content" id="netposition-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Net Cash Position Report</h2>
                            <div>
                                <button class="btn btn-export"><i class="fas fa-file-export"></i> Export Report</button>
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
                            
                            <div class="chart-container">
                                <!-- Net Cash Position Chart -->
                                <div style="display: flex; align-items: center; height: 100%; gap: 20px; justify-content: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                                        <div style="display: flex; width: 100%; height: 40px; margin-bottom: 10px;">
                                            <div style="background: #2ecc71; width: 70%; display: flex; align-items: center; padding-left: 10px; color: white; font-weight: bold;">Collections: ₱856,300</div>
                                            <div style="background: #e74c3c; width: 30%; display: flex; align-items: center; padding-left: 10px; color: white; font-weight: bold;">Disbursements: ₱724,500</div>
                                        </div>
                                        <div style="background: #3498db; width: 40%; height: 60px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 1.2rem;">Net Position: ₱131,800</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Week</th>
                                            <th>Collections</th>
                                            <th>Disbursements</th>
                                            <th>Net Cash Flow</th>
                                            <th>Cumulative Position</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Week 1 (Sep 1-7)</td>
                                            <td>₱198,500</td>
                                            <td>₱175,200</td>
                                            <td>+₱23,300</td>
                                            <td>₱23,300</td>
                                            <td><span class="status status-positive">Positive</span></td>
                                        </tr>
                                        <tr>
                                            <td>Week 2 (Sep 8-14)</td>
                                            <td>₱225,800</td>
                                            <td>₱195,600</td>
                                            <td>+₱30,200</td>
                                            <td>₱53,500</td>
                                            <td><span class="status status-positive">Positive</span></td>
                                        </tr>
                                        <tr>
                                            <td>Week 3 (Sep 15-21)</td>
                                            <td>₱215,400</td>
                                            <td>₱185,300</td>
                                            <td>+₱30,100</td>
                                            <td>₱83,600</td>
                                            <td><span class="status status-positive">Positive</span></td>
                                        </tr>
                                        <tr>
                                            <td>Week 4 (Sep 22-30)</td>
                                            <td>₱216,600</td>
                                            <td>₱168,400</td>
                                            <td>+₱48,200</td>
                                            <td>₱131,800</td>
                                            <td><span class="status status-positive">Positive</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Forecast Variance Tab -->
                <div class="tab-content" id="variance-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Forecast Variance Report</h2>
                            <div>
                                <button class="btn btn-sync"><i class="fas fa-sync-alt"></i> Sync to Budget</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Forecast Type</span>
                                    <select class="filter-select" id="forecastType">
                                        <option value="monthly">Monthly Forecast</option>
                                        <option value="quarterly">Quarterly Forecast</option>
                                        <option value="annual">Annual Forecast</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Category</span>
                                    <select class="filter-select" id="categoryFilter">
                                        <option value="all">All Categories</option>
                                        <option value="gateway">Gateway Payments</option>
                                        <option value="cod">COD Collections</option>
                                        <option value="bank">Bank Deposits</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="chart-container">
                                <!-- Forecast vs Actual Chart -->
                                <div style="display: flex; align-items: flex-end; height: 100%; gap: 30px; justify-content: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="background: #3498db; width: 40px; height: 180px; border-radius: 5px; margin-bottom: 5px;"></div>
                                        <div style="background: #2ecc71; width: 40px; height: 200px; border-radius: 5px; position: absolute; margin-top: -200px;"></div>
                                        <span style="margin-top: 10px;">Week 1</span>
                                        <small>F: ₱190K | A: ₱198K</small>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="background: #3498db; width: 40px; height: 200px; border-radius: 5px; margin-bottom: 5px;"></div>
                                        <div style="background: #2ecc71; width: 40px; height: 225px; border-radius: 5px; position: absolute; margin-top: -225px;"></div>
                                        <span style="margin-top: 10px;">Week 2</span>
                                        <small>F: ₱200K | A: ₱225K</small>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="background: #3498db; width: 40px; height: 210px; border-radius: 5px; margin-bottom: 5px;"></div>
                                        <div style="background: #2ecc71; width: 40px; height: 215px; border-radius: 5px; position: absolute; margin-top: -215px;"></div>
                                        <span style="margin-top: 10px;">Week 3</span>
                                        <small>F: ₱210K | A: ₱215K</small>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="background: #3498db; width: 40px; height: 205px; border-radius: 5px; margin-bottom: 5px;"></div>
                                        <div style="background: #2ecc71; width: 40px; height: 216px; border-radius: 5px; position: absolute; margin-top: -216px;"></div>
                                        <span style="margin-top: 10px;">Week 4</span>
                                        <small>F: ₱205K | A: ₱216K</small>
                                    </div>
                                </div>
                                <div style="text-align: center; margin-top: 10px;">
                                    <span style="display: inline-block; width: 15px; height: 15px; background: #3498db; margin-right: 5px;"></span> Forecast
                                    <span style="display: inline-block; width: 15px; height: 15px; background: #2ecc71; margin-right: 5px; margin-left: 15px;"></span> Actual
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Forecast Amount</th>
                                            <th>Actual Amount</th>
                                            <th>Variance</th>
                                            <th>Variance %</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Gateway Payments</td>
                                            <td>₱420,000</td>
                                            <td>₱456,300</td>
                                            <td>+₱36,300</td>
                                            <td>+8.6%</td>
                                            <td><span class="status status-positive">Above Forecast</span></td>
                                        </tr>
                                        <tr>
                                            <td>COD Collections</td>
                                            <td>₱250,000</td>
                                            <td>₱245,800</td>
                                            <td>-₱4,200</td>
                                            <td>-1.7%</td>
                                            <td><span class="status status-negative">Below Forecast</span></td>
                                        </tr>
                                        <tr>
                                            <td>Bank Deposits</td>
                                            <td>₱140,000</td>
                                            <td>₱154,200</td>
                                            <td>+₱14,200</td>
                                            <td>+10.1%</td>
                                            <td><span class="status status-positive">Above Forecast</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Inflows</strong></td>
                                            <td><strong>₱810,000</strong></td>
                                            <td><strong>₱856,300</strong></td>
                                            <td><strong>+₱46,300</strong></td>
                                            <td><strong>+5.7%</strong></td>
                                            <td><span class="status status-positive">Above Forecast</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Liquidity Alerts Tab -->
                <div class="tab-content" id="alerts-tab">
                    <!-- Liquidity Alerts Panel -->
                    <div class="alert-panel">
                        <div class="alert-header">
                            <div class="alert-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h2 class="card-title">Liquidity Alerts</h2>
                        </div>
                        <div class="alert-body">
                            <div class="alert-item alert-critical">
                                <div>
                                    <h4>Critical: Upcoming Large Disbursement</h4>
                                    <p>Vendor payment of ₱350,000 due on 2025-09-15 exceeds projected inflows for that period.</p>
                                </div>
                                <div>
                                    <span style="font-weight: bold; color: #e74c3c;">Shortfall: ₱85,000</span>
                                    <button class="btn btn-view" style="margin-left: 10px;">View Details</button>
                                </div>
                            </div>
                            <div class="alert-item alert-warning">
                                <div>
                                    <h4>Warning: COD Collection Delay</h4>
                                    <p>COD collections for Week 3 are 15% below forecast, impacting cash availability.</p>
                                </div>
                                <div>
                                    <span style="font-weight: bold; color: #f39c12;">Impact: ₱32,000</span>
                                    <button class="btn btn-view" style="margin-left: 10px;">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Cash Health Status</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> CFO Report</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <!-- Cash Health Gauge -->
                                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                                    <div style="width: 200px; height: 200px; border-radius: 50%; background: conic-gradient(#2ecc71 0% 70%, #f39c12 70% 90%, #e74c3c 90% 100%); display: flex; align-items: center; justify-content: center;">
                                        <div style="width: 150px; height: 150px; border-radius: 50%; background: white; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                            <span style="font-size: 1.5rem; font-weight: bold;">Healthy</span>
                                            <span style="color: #7f8c8d;">15-Day Buffer</span>
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px; text-align: center;">
                                        <p>Current cash position supports 15 days of operations at current burn rate.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Metric</th>
                                            <th>Current Value</th>
                                            <th>Threshold</th>
                                            <th>Status</th>
                                            <th>Trend</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Operating Cash Ratio</td>
                                            <td>1.8</td>
                                            <td>> 1.5</td>
                                            <td><span class="status status-healthy">Healthy</span></td>
                                            <td><i class="fas fa-arrow-up" style="color: #2ecc71;"></i> Improving</td>
                                        </tr>
                                        <tr>
                                            <td>Quick Ratio</td>
                                            <td>1.2</td>
                                            <td>> 1.0</td>
                                            <td><span class="status status-healthy">Adequate</span></td>
                                            <td><i class="fas fa-arrow-right" style="color: #f39c12;"></i> Stable</td>
                                        </tr>
                                        <tr>
                                            <td>Cash Burn Rate (Days)</td>
                                            <td>15</td>
                                            <td>> 30</td>
                                            <td><span class="status status-warning">Watch</span></td>
                                            <td><i class="fas fa-arrow-down" style="color: #e74c3c;"></i> Declining</td>
                                        </tr>
                                        <tr>
                                            <td>Debt Service Coverage</td>
                                            <td>3.5</td>
                                            <td>> 2.0</td>
                                            <td><span class="status status-healthy">Strong</span></td>
                                            <td><i class="fas fa-arrow-up" style="color: #2ecc71;"></i> Improving</td>
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
                <p>&copy; 2025 Financial System - Cash Flow Reporting</p>
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

        // Simulate data sync functionality
        document.querySelector('.btn-sync').addEventListener('click', function() {
            const button = this;
            const originalText = button.innerHTML;
            
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Syncing...';
            button.disabled = true;
            
            setTimeout(function() {
                button.innerHTML = originalText;
                button.disabled = false;
                alert('Data successfully synchronized with Budget Forecasting system!');
            }, 2000);
        });
    </script>
</body>
</html>

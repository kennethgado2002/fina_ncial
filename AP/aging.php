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
            --overdue-30: #3498db;
            --overdue-60: #f39c12;
            --overdue-90: #e74c3c;
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

        .card-icon.current {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--current);
        }

        .card-icon.overdue-30 {
            background-color: rgba(52, 152, 219, 0.2);
            color: var(--overdue-30);
        }

        .card-icon.overdue-60 {
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--overdue-60);
        }

        .card-icon.overdue-90 {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--overdue-90);
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

        /* Chart Containers */
        .chart-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .chart-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .chart-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: var(--dark);
            text-align: center;
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
            
            .chart-container {
                grid-template-columns: 1fr;
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
            
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .chart-container {
                grid-template-columns: 1fr;
            }
            
            .chart-card {
                padding: 15px;
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
                <h1 class="page-title">AP Aging & Reports</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon current">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Current</h3>
                        <p>₱245,800.00</p>
                        <small>Due within 30 days</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon overdue-30">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>30 Days Overdue</h3>
                        <p>₱128,500.00</p>
                        <small>31-60 days overdue</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon overdue-60">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3>60 Days Overdue</h3>
                        <p>₱75,200.00</p>
                        <small>61-90 days overdue</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon overdue-90">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>90+ Days Overdue</h3>
                        <p>₱42,800.00</p>
                        <small>Over 90 days overdue</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="ap-aging">AP Aging Report</div>
                    <div class="tab" data-tab="vendor-liability">Vendor Liability Report</div>
                    <div class="tab" data-tab="trend-analysis">Trend Analysis</div>
                </div>

                <!-- AP Aging Report Tab -->
                <div class="tab-content active" id="ap-aging-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Accounts Payable Aging Report</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export PDF</button>
                                <button class="btn btn-primary"><i class="fas fa-file-excel"></i> Export Excel</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search vendor or invoice...">
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Vendor</th>
                                            <th>Current</th>
                                            <th>1-30 Days</th>
                                            <th>31-60 Days</th>
                                            <th>61-90 Days</th>
                                            <th>90+ Days</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ABC Suppliers</td>
                                            <td>₱42,500.00</td>
                                            <td>₱12,800.00</td>
                                            <td>₱8,200.00</td>
                                            <td>₱5,500.00</td>
                                            <td>₱3,200.00</td>
                                            <td>₱72,200.00</td>
                                        </tr>
                                        <tr>
                                            <td>XYZ Technologies</td>
                                            <td>₱38,700.00</td>
                                            <td>₱15,200.00</td>
                                            <td>₱9,500.00</td>
                                            <td>₱6,800.00</td>
                                            <td>₱4,100.00</td>
                                            <td>₱74,300.00</td>
                                        </tr>
                                        <tr>
                                            <td>Global Equipment</td>
                                            <td>₱52,100.00</td>
                                            <td>₱18,500.00</td>
                                            <td>₱12,300.00</td>
                                            <td>₱7,900.00</td>
                                            <td>₱5,600.00</td>
                                            <td>₱96,400.00</td>
                                        </tr>
                                        <tr>
                                            <td>Office Supplies Co.</td>
                                            <td>₮28,400.00</td>
                                            <td>₱9,700.00</td>
                                            <td>₱6,200.00</td>
                                            <td>₱4,500.00</td>
                                            <td>₱2,900.00</td>
                                            <td>₱51,700.00</td>
                                        </tr>
                                        <tr>
                                            <td>Tech Solutions Inc.</td>
                                            <td>₱35,200.00</td>
                                            <td>₱14,800.00</td>
                                            <td>₱10,500.00</td>
                                            <td>₱7,200.00</td>
                                            <td>₱4,800.00</td>
                                            <td>₱72,500.00</td>
                                        </tr>
                                        <tr>
                                            <td>Logistics Partners</td>
                                            <td>₱49,900.00</td>
                                            <td>₱22,300.00</td>
                                            <td>₱15,700.00</td>
                                            <td>₱10,500.00</td>
                                            <td>₱7,200.00</td>
                                            <td>₱105,600.00</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr style="font-weight: bold;">
                                            <td>Total</td>
                                            <td>₱245,800.00</td>
                                            <td>₱93,300.00</td>
                                            <td>₱62,400.00</td>
                                            <td>₱42,400.00</td>
                                            <td>₱27,800.00</td>
                                            <td>₱472,700.00</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="chart-container">
                        <div class="chart-card">
                            <h3 class="chart-title">AP Aging Distribution</h3>
                            <canvas id="apAgingChart"></canvas>
                        </div>
                        <div class="chart-card">
                            <h3 class="chart-title">Aging by Vendor Type</h3>
                            <canvas id="vendorTypeChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Vendor Liability Report Tab -->
                <div class="tab-content" id="vendor-liability-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Vendor Liability Report</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export PDF</button>
                                <button class="btn btn-primary"><i class="fas fa-file-excel"></i> Export Excel</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search vendor...">
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Vendor</th>
                                            <th>Type</th>
                                            <th>Invoice Count</th>
                                            <th>Total Liability</th>
                                            <th>Avg. Days Outstanding</th>
                                            <th>Liability Distribution</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ABC Suppliers</td>
                                            <td>Supplies</td>
                                            <td>12</td>
                                            <td>₱72,200.00</td>
                                            <td>42</td>
                                            <td>
                                                <div style="background: #f0f0f0; border-radius: 5px; height: 10px; width: 100%;">
                                                    <div style="background: var(--secondary); border-radius: 5px; height: 10px; width: 65%;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>XYZ Technologies</td>
                                            <td>Technology</td>
                                            <td>8</td>
                                            <td>₱74,300.00</td>
                                            <td>38</td>
                                            <td>
                                                <div style="background: #f0f0f0; border-radius: 5px; height: 10px; width: 100%;">
                                                    <div style="background: var(--secondary); border-radius: 5px; height: 10px; width: 67%;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Global Equipment</td>
                                            <td>Equipment</td>
                                            <td>15</td>
                                            <td>₱96,400.00</td>
                                            <td>51</td>
                                            <td>
                                                <div style="background: #f0f0f0; border-radius: 5px; height: 10px; width: 100%;">
                                                    <div style="background: var(--secondary); border-radius: 5px; height: 10px; width: 87%;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Office Supplies Co.</td>
                                            <td>Supplies</td>
                                            <td>10</td>
                                            <td>₱51,700.00</td>
                                            <td>29</td>
                                            <td>
                                                <div style="background: #f0f0f0; border-radius: 5px; height: 10px; width: 100%;">
                                                    <div style="background: var(--secondary); border-radius: 5px; height: 10px; width: 47%;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tech Solutions Inc.</td>
                                            <td>Technology</td>
                                            <td>9</td>
                                            <td>₱72,500.00</td>
                                            <td>45</td>
                                            <td>
                                                <div style="background: #f0f0f0; border-radius: 5px; height: 10px; width: 100%;">
                                                    <div style="background: var(--secondary); border-radius: 5px; height: 10px; width: 65%;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Logistics Partners</td>
                                            <td>Logistics</td>
                                            <td>14</td>
                                            <td>₱105,600.00</td>
                                            <td>57</td>
                                            <td>
                                                <div style="background: #f0f0f0; border-radius: 5px; height: 10px; width: 100%;">
                                                    <div style="background: var(--secondary); border-radius: 5px; height: 10px; width: 95%;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="chart-container">
                        <div class="chart-card">
                            <h3 class="chart-title">Vendor Liability Distribution</h3>
                            <canvas id="vendorLiabilityChart"></canvas>
                        </div>
                        <div class="chart-card">
                            <h3 class="chart-title">Liability by Vendor Type</h3>
                            <canvas id="liabilityByTypeChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Trend Analysis Tab -->
                <div class="tab-content" id="trend-analysis-tab">
                    <div class="chart-container">
                        <div class="chart-card">
                            <h3 class="chart-title">AP Aging Trend (Last 6 Months)</h3>
                            <canvas id="apTrendChart"></canvas>
                        </div>
                        <div class="chart-card">
                            <h3 class="chart-title">Liabilities vs Payments</h3>
                            <canvas id="liabilitiesVsPaymentsChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-container">
                        <div class="chart-card">
                            <h3 class="chart-title">Payroll vs Reimbursement Trends</h3>
                            <canvas id="payrollReimbursementChart"></canvas>
                        </div>
                        <div class="chart-card">
                            <h3 class="chart-title">Aging Comparison by Category</h3>
                            <canvas id="categoryAgingChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - AP Aging & Reports</p>
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

        // Initialize Charts
        document.addEventListener('DOMContentLoaded', function() {
            // AP Aging Chart
            const apAgingCtx = document.getElementById('apAgingChart').getContext('2d');
            new Chart(apAgingCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Current', '30 Days', '60 Days', '90+ Days'],
                    datasets: [{
                        data: [245800, 128500, 75200, 42800],
                        backgroundColor: [
                            '#2ecc71',
                            '#3498db',
                            '#f39c12',
                            '#e74c3c'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Vendor Type Chart
            const vendorTypeCtx = document.getElementById('vendorTypeChart').getContext('2d');
            new Chart(vendorTypeCtx, {
                type: 'bar',
                data: {
                    labels: ['Supplies', 'Technology', 'Equipment', 'Logistics'],
                    datasets: [{
                        label: 'Current',
                        data: [70900, 73900, 52100, 49900],
                        backgroundColor: '#2ecc71'
                    }, {
                        label: '30 Days',
                        data: [22500, 30000, 18500, 22300],
                        backgroundColor: '#3498db'
                    }, {
                        label: '60 Days',
                        data: [14400, 19500, 12300, 15700],
                        backgroundColor: '#f39c12'
                    }, {
                        label: '90+ Days',
                        data: [8100, 8900, 5600, 7200],
                        backgroundColor: '#e74c3c'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true
                        }
                    }
                }
            });

            // Vendor Liability Chart
            const vendorLiabilityCtx = document.getElementById('vendorLiabilityChart').getContext('2d');
            new Chart(vendorLiabilityCtx, {
                type: 'pie',
                data: {
                    labels: ['ABC Suppliers', 'XYZ Technologies', 'Global Equipment', 'Office Supplies Co.', 'Tech Solutions Inc.', 'Logistics Partners'],
                    datasets: [{
                        data: [72200, 74300, 96400, 51700, 72500, 105600],
                        backgroundColor: [
                            '#3498db',
                            '#2ecc71',
                            '#f39c12',
                            '#9b59b6',
                            '#e74c3c',
                            '#1abc9c'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Liability by Type Chart
            const liabilityByTypeCtx = document.getElementById('liabilityByTypeChart').getContext('2d');
            new Chart(liabilityByTypeCtx, {
                type: 'bar',
                data: {
                    labels: ['Supplies', 'Technology', 'Equipment', 'Logistics'],
                    datasets: [{
                        label: 'Total Liability',
                        data: [123900, 146800, 96400, 105600],
                        backgroundColor: '#3498db'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // AP Trend Chart
            const apTrendCtx = document.getElementById('apTrendChart').getContext('2d');
            new Chart(apTrendCtx, {
                type: 'line',
                data: {
                    labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    datasets: [{
                        label: 'Current',
                        data: [205600, 218900, 224500, 232100, 238700, 245800],
                        borderColor: '#2ecc71',
                        fill: false
                    }, {
                        label: '30 Days',
                        data: [98500, 102300, 108700, 115200, 121800, 128500],
                        borderColor: '#3498db',
                        fill: false
                    }, {
                        label: '60 Days',
                        data: [62300, 65400, 68200, 70500, 72800, 75200],
                        borderColor: '#f39c12',
                        fill: false
                    }, {
                        label: '90+ Days',
                        data: [35200, 37200, 38900, 40500, 41800, 42800],
                        borderColor: '#e74c3c',
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Liabilities vs Payments Chart
            const liabilitiesVsPaymentsCtx = document.getElementById('liabilitiesVsPaymentsChart').getContext('2d');
            new Chart(liabilitiesVsPaymentsCtx, {
                type: 'bar',
                data: {
                    labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    datasets: [{
                        label: 'Liabilities',
                        data: [401600, 423800, 440100, 458700, 475000, 492700],
                        backgroundColor: '#e74c3c'
                    }, {
                        label: 'Payments',
                        data: [385200, 398700, 412500, 426800, 442300, 458900],
                        backgroundColor: '#2ecc71'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Payroll vs Reimbursement Chart
            const payrollReimbursementCtx = document.getElementById('payrollReimbursementChart').getContext('2d');
            new Chart(payrollReimbursementCtx, {
                type: 'line',
                data: {
                    labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    datasets: [{
                        label: 'Payroll',
                        data: [652150, 665200, 678500, 692800, 708400, 725300],
                        borderColor: '#3498db',
                        fill: false
                    }, {
                        label: 'Reimbursements',
                        data: [48750, 52300, 55800, 59200, 63500, 68700],
                        borderColor: '#9b59b6',
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Category Aging Chart
            const categoryAgingCtx = document.getElementById('categoryAgingChart').getContext('2d');
            new Chart(categoryAgingCtx, {
                type: 'radar',
                data: {
                    labels: ['Current', '30 Days', '60 Days', '90+ Days'],
                    datasets: [{
                        label: 'Supplies',
                        data: [70900, 22500, 14400, 8100],
                        backgroundColor: 'rgba(52, 152, 219, 0.2)',
                        borderColor: '#3498db'
                    }, {
                        label: 'Technology',
                        data: [73900, 30000, 19500, 8900],
                        backgroundColor: 'rgba(46, 204, 113, 0.2)',
                        borderColor: '#2ecc71'
                    }, {
                        label: 'Equipment',
                        data: [52100, 18500, 12300, 5600],
                        backgroundColor: 'rgba(243, 156, 18, 0.2)',
                        borderColor: '#f39c12'
                    }, {
                        label: 'Logistics',
                        data: [49900, 22300, 15700, 7200],
                        backgroundColor: 'rgba(231, 76, 60, 0.2)',
                        borderColor: '#e74c3c'
                    }]
                },
                options: {
                    responsive: true
                }
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
</body>
</html>

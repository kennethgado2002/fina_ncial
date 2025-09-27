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
            --project-completed: #2ecc71;
            --project-ongoing: #3498db;
            --project-delayed: #f39c12;
            --project-risk: #e74c3c;
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

        .status-completed {
            background-color: var(--project-completed);
            color: white;
        }

        .status-ongoing {
            background-color: var(--project-ongoing);
            color: white;
        }

        .status-delayed {
            background-color: var(--project-delayed);
            color: white;
        }

        .status-risk {
            background-color: var(--project-risk);
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

        .btn-edit {
            background-color: #74b9ff;
            color: white;
        }

        .btn-edit:hover {
            background-color: #0984e3;
        }

        .btn-delete {
            background-color: #d63031;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c23616;
        }

        .btn-add {
            background-color: #00b894;
            color: white;
        }

        .btn-add:hover {
            background-color: #00a382;
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

        /* Progress Bar */
        .progress-bar {
            height: 10px;
            background-color: #ecf0f1;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress {
            height: 100%;
            border-radius: 5px;
            transition: width 0.3s ease;
        }

        .progress-budget {
            background-color: #3498db;
        }

        .progress-actual {
            background-color: #2ecc71;
        }

        /* ROI Calculator */
        .roi-calculator {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .roi-result {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 10px;
            margin-top: 20px;
        }

        .roi-positive {
            color: #2ecc71;
            font-weight: 700;
        }

        .roi-negative {
            color: #e74c3c;
            font-weight: 700;
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
                <h1 class="page-title">Campaign/Project Tracking</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon blue">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <h3>Active Projects</h3>
                        <p>18</p>
                        <small>Across all departments</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>On Budget</h3>
                        <p>12</p>
                        <small>67% of projects</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orange">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3>At Risk</h3>
                        <p>4</p>
                        <small>22% of projects</small>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>Over Budget</h3>
                        <p>2</p>
                        <small>11% of projects</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="overview">Overview</div>
                    <div class="tab" data-tab="projects">Projects</div>
                    <div class="tab" data-tab="roi">ROI Calculator</div>
                </div>

                <!-- Overview Tab -->
                <div class="tab-content active" id="overview-tab">
                    <!-- Project Performance Chart -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Project Performance</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Department</span>
                                    <select class="filter-select" id="deptFilter">
                                        <option value="">All Departments</option>
                                        <option value="marketing">Marketing</option>
                                        <option value="it">IT</option>
                                        <option value="operations">Operations</option>
                                        <option value="hr">Human Resources</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="statusFilter">
                                        <option value="">All Status</option>
                                        <option value="active">Active</option>
                                        <option value="completed">Completed</option>
                                        <option value="delayed">Delayed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="projectPerformanceChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Project Status Overview -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Project Status Overview</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Project ID</th>
                                            <th>Project Name</th>
                                            <th>Department</th>
                                            <th>Manager</th>
                                            <th>Budget</th>
                                            <th>Actual Spend</th>
                                            <th>Variance</th>
                                            <th>Timeline</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>PROJ-2025-001</td>
                                            <td>Q3 Marketing Campaign</td>
                                            <td>Marketing</td>
                                            <td>Sarah Johnson</td>
                                            <td>₱550,000.00</td>
                                            <td>₱485,000.00</td>
                                            <td style="color: #2ecc71;">+₱65,000.00</td>
                                            <td>Aug 1 - Oct 31, 2025</td>
                                            <td><span class="status status-ongoing">On Track</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('projectDetailsModal')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PROJ-2025-002</td>
                                            <td>Website Redesign</td>
                                            <td>IT</td>
                                            <td>Michael Chen</td>
                                            <td>₱325,000.00</td>
                                            <td>₱340,000.00</td>
                                            <td style="color: #e74c3c;">-₱15,000.00</td>
                                            <td>Jul 15 - Nov 30, 2025</td>
                                            <td><span class="status status-risk">At Risk</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('projectDetailsModal')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PROJ-2025-003</td>
                                            <td>Warehouse Automation</td>
                                            <td>Operations</td>
                                            <td>David Wilson</td>
                                            <td>₱1,200,000.00</td>
                                            <td>₱1,050,000.00</td>
                                            <td style="color: #2ecc71;">+₱150,000.00</td>
                                            <td>Jun 1 - Dec 15, 2025</td>
                                            <td><span class="status status-ongoing">On Track</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('projectDetailsModal')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PROJ-2025-004</td>
                                            <td>Employee Training Program</td>
                                            <td>HR</td>
                                            <td>Emily Rodriguez</td>
                                            <td>₱180,000.00</td>
                                            <td>₱195,000.00</td>
                                            <td style="color: #e74c3c;">-₱15,000.00</td>
                                            <td>Sep 1 - Dec 20, 2025</td>
                                            <td><span class="status status-delayed">Delayed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('projectDetailsModal')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PROJ-2025-005</td>
                                            <td>Mobile App Development</td>
                                            <td>IT</td>
                                            <td>Jessica Lee</td>
                                            <td>₱750,000.00</td>
                                            <td>₱720,000.00</td>
                                            <td style="color: #2ecc71;">+₱30,000.00</td>
                                            <td>Aug 15 - Dec 15, 2025</td>
                                            <td><span class="status status-completed">Completed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('projectDetailsModal')"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projects Tab -->
                <div class="tab-content" id="projects-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Project Management</h2>
                            <button class="btn btn-add" onclick="openModal('addProjectModal')"><i class="fas fa-plus"></i> Add New Project</button>
                        </div>
                        <div class="card-body">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="projectSearch" placeholder="Search Project ID, Name, or Manager...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Project ID</th>
                                            <th>Project Name</th>
                                            <th>Department</th>
                                            <th>Manager</th>
                                            <th>Budget</th>
                                            <th>Actual Spend</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>PROJ-2025-001</td>
                                            <td>Q3 Marketing Campaign</td>
                                            <td>Marketing</td>
                                            <td>Sarah Johnson</td>
                                            <td>₱550,000.00</td>
                                            <td>₱485,000.00</td>
                                            <td>2025-08-01</td>
                                            <td>2025-10-31</td>
                                            <td><span class="status status-ongoing">On Track</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('projectDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-delete btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PROJ-2025-002</td>
                                            <td>Website Redesign</td>
                                            <td>IT</td>
                                            <td>Michael Chen</td>
                                            <td>₱325,000.00</td>
                                            <td>₱340,000.00</td>
                                            <td>2025-07-15</td>
                                            <td>2025-11-30</td>
                                            <td><span class="status status-risk">At Risk</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('projectDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-delete btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PROJ-2025-003</td>
                                            <td>Warehouse Automation</td>
                                            <td>Operations</td>
                                            <td>David Wilson</td>
                                            <td>₱1,200,000.00</td>
                                            <td>₱1,050,000.00</td>
                                            <td>2025-06-01</td>
                                            <td>2025-12-15</td>
                                            <td><span class="status status-ongoing">On Track</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('projectDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-delete btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PROJ-2025-004</td>
                                            <td>Employee Training Program</td>
                                            <td>HR</td>
                                            <td>Emily Rodriguez</td>
                                            <td>₱180,000.00</td>
                                            <td>₱195,000.00</td>
                                            <td>2025-09-01</td>
                                            <td>2025-12-20</td>
                                            <td><span class="status status-delayed">Delayed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('projectDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-delete btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PROJ-2025-005</td>
                                            <td>Mobile App Development</td>
                                            <td>IT</td>
                                            <td>Jessica Lee</td>
                                            <td>₱750,000.00</td>
                                            <td>₱720,000.00</td>
                                            <td>2025-08-15</td>
                                            <td>2025-12-15</td>
                                            <td><span class="status status-completed">Completed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openModal('projectDetailsModal')"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-delete btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ROI Calculator Tab -->
                <div class="tab-content" id="roi-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">ROI Calculator</h2>
                        </div>
                        <div class="card-body">
                            <div class="roi-calculator">
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Project</label>
                                            <select class="form-control" id="roiProject">
                                                <option value="">Select a Project</option>
                                                <option value="proj-001">Q3 Marketing Campaign</option>
                                                <option value="proj-002">Website Redesign</option>
                                                <option value="proj-003">Warehouse Automation</option>
                                                <option value="proj-004">Employee Training Program</option>
                                                <option value="proj-005">Mobile App Development</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Time Period</label>
                                            <select class="form-control" id="roiPeriod">
                                                <option value="q3">Q3 2025</option>
                                                <option value="q4">Q4 2025</option>
                                                <option value="full">Full Year 2025</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Project Cost (₱)</label>
                                            <input type="number" class="form-control" id="projectCost" placeholder="Enter total project cost">
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Revenue Generated (₱)</label>
                                            <input type="number" class="form-control" id="revenueGenerated" placeholder="Enter revenue generated">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Additional Benefits (₱)</label>
                                    <input type="number" class="form-control" id="additionalBenefits" placeholder="Enter cost savings or other benefits">
                                    <small>Include any cost savings or other measurable benefits</small>
                                </div>
                                <button class="btn btn-primary" onclick="calculateROI()">Calculate ROI</button>
                                
                                <div class="roi-result" id="roiResult">
                                    <h3>ROI Calculation Result</h3>
                                    <p>Enter project details and click Calculate ROI to see results</p>
                                </div>
                            </div>

                            <div class="chart-container">
                                <canvas id="roiComparisonChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; 2025 Financial System - Project Tracking</p>
            </div>
        </div>
    </div>

    <!-- Add Project Modal -->
    <div id="addProjectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add New Project</h2>
                <span class="close" onclick="closeModal('addProjectModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="projectForm">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Project ID</label>
                                <input type="text" class="form-control" value="PROJ-2025-008" readonly>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Project Name</label>
                                <input type="text" class="form-control" placeholder="Enter project name">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Department</label>
                                <select class="form-control">
                                    <option value="">Select Department</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="it">IT</option>
                                    <option value="operations">Operations</option>
                                    <option value="hr">Human Resources</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Responsible Manager</label>
                                <select class="form-control">
                                    <option value="">Select Manager</option>
                                    <option value="sarah">Sarah Johnson</option>
                                    <option value="michael">Michael Chen</option>
                                    <option value="david">David Wilson</option>
                                    <option value="emily">Emily Rodriguez</option>
                                    <option value="jessica">Jessica Lee</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Budget Allocation (₱)</label>
                                <input type="number" class="form-control" placeholder="Enter budget amount">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Project Status</label>
                                <select class="form-control">
                                    <option value="planning">Planning</option>
                                    <option value="active">Active</option>
                                    <option value="on-hold">On Hold</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Project Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter project description"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Key Milestones</label>
                        <textarea class="form-control" rows="3" placeholder="Enter key milestones and dates"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addProjectModal')">Cancel</button>
                <button type="button" class="btn btn-primary">Save Project</button>
            </div>
        </div>
    </div>

    <!-- Project Details Modal -->
    <div id="projectDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Project Details: Q3 Marketing Campaign</h2>
                <span class="close" onclick="closeModal('projectDetailsModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Project ID</label>
                            <p>PROJ-2025-001</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Department</label>
                            <p>Marketing</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Manager</label>
                            <p>Sarah Johnson</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Timeline</label>
                            <p>Aug 1, 2025 - Oct 31, 2025</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Budget</label>
                            <p>₱550,000.00</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Actual Spend</label>
                            <p>₱485,000.00</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Budget Utilization</label>
                    <div class="progress-bar">
                        <div class="progress progress-budget" style="width: 88%;"></div>
                    </div>
                    <small>88% of budget utilized</small>
                </div>

                <h3 class="form-label">Milestones</h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Milestone</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Campaign Planning</td>
                                <td>2025-08-15</td>
                                <td><span class="status status-completed">Completed</span></td>
                                <td>₱45,000.00</td>
                            </tr>
                            <tr>
                                <td>Creative Development</td>
                                <td>2025-08-31</td>
                                <td><span class="status status-completed">Completed</span></td>
                                <td>₱120,000.00</td>
                            </tr>
                            <tr>
                                <td>Digital Launch</td>
                                <td>2025-09-15</td>
                                <td><span class="status status-completed">Completed</span></td>
                                <td>₱220,000.00</td>
                            </tr>
                            <tr>
                                <td>Performance Analysis</td>
                                <td>2025-10-15</td>
                                <td><span class="status status-ongoing">In Progress</span></td>
                                <td>₱75,000.00</td>
                            </tr>
                            <tr>
                                <td>Campaign Report</td>
                                <td>2025-10-31</td>
                                <td><span class="status status-ongoing">Not Started</span></td>
                                <td>₱25,000.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="form-label">Expense Breakdown</h3>
                <div class="chart-container">
                    <canvas id="expenseBreakdownChart"></canvas>
                </div>

                <div class="form-group">
                    <label class="form-label">ROI Calculation</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>Project Cost:</strong> ₱485,000.00</p>
                        <p><strong>Revenue Generated:</strong> ₱1,250,000.00</p>
                        <p><strong>ROI:</strong> <span style="color: #2ecc71;">158%</span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('projectDetailsModal')">Close</button>
                <button type="button" class="btn btn-primary">Generate Report</button>
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
        document.getElementById('projectSearch').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('#projects-tab tbody tr');
            
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

        // ROI Calculation
        function calculateROI() {
            const cost = parseFloat(document.getElementById('projectCost').value) || 0;
            const revenue = parseFloat(document.getElementById('revenueGenerated').value) || 0;
            const benefits = parseFloat(document.getElementById('additionalBenefits').value) || 0;
            
            const totalBenefits = revenue + benefits;
            const netProfit = totalBenefits - cost;
            const roi = cost > 0 ? (netProfit / cost) * 100 : 0;
            
            const roiResult = document.getElementById('roiResult');
            
            if (cost === 0) {
                roiResult.innerHTML = `
                    <h3>ROI Calculation Result</h3>
                    <p>Please enter a valid project cost</p>
                `;
                return;
            }
            
            roiResult.innerHTML = `
                <h3>ROI Calculation Result</h3>
                <p><strong>Project Cost:</strong> ₱${cost.toLocaleString()}</p>
                <p><strong>Total Benefits:</strong> ₱${totalBenefits.toLocaleString()}</p>
                <p><strong>Net Profit:</strong> ₱${netProfit.toLocaleString()}</p>
                <p><strong>ROI:</strong> <span class="${roi >= 0 ? 'roi-positive' : 'roi-negative'}">${roi.toFixed(2)}%</span></p>
            `;
        }

        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // Project Performance Chart
            const projectPerformanceCtx = document.getElementById('projectPerformanceChart').getContext('2d');
            new Chart(projectPerformanceCtx, {
                type: 'bar',
                data: {
                    labels: ['Marketing', 'IT', 'Operations', 'HR'],
                    datasets: [
                        {
                            label: 'Budget',
                            data: [550, 1075, 1200, 180],
                            backgroundColor: 'rgba(52, 152, 219, 0.5)',
                            borderColor: 'rgba(52, 152, 219, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Actual Spend',
                            data: [485, 1060, 1050, 195],
                            backgroundColor: 'rgba(46, 204, 113, 0.5)',
                            borderColor: 'rgba(46, 204, 113, 1)',
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
                                text: 'Amount (₱ thousands)'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Budget vs Actual by Department'
                        }
                    }
                }
            });

            // Expense Breakdown Chart
            const expenseBreakdownCtx = document.getElementById('expenseBreakdownChart').getContext('2d');
            new Chart(expenseBreakdownCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Creative Development', 'Digital Ads', 'Content Production', 'Analytics', 'Miscellaneous'],
                    datasets: [{
                        data: [120, 220, 75, 45, 25],
                        backgroundColor: [
                            'rgba(52, 152, 219, 0.7)',
                            'rgba(46, 204, 113, 0.7)',
                            'rgba(155, 89, 182, 0.7)',
                            'rgba(241, 196, 15, 0.7)',
                            'rgba(230, 126, 34, 0.7)'
                        ],
                        borderColor: [
                            'rgba(52, 152, 219, 1)',
                            'rgba(46, 204, 113, 1)',
                            'rgba(155, 89, 182, 1)',
                            'rgba(241, 196, 15, 1)',
                            'rgba(230, 126, 34, 1)'
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
                            text: 'Expense Breakdown for Q3 Marketing Campaign'
                        }
                    }
                }
            });

            // ROI Comparison Chart
            const roiComparisonCtx = document.getElementById('roiComparisonChart').getContext('2d');
            new Chart(roiComparisonCtx, {
                type: 'bar',
                data: {
                    labels: ['Q3 Marketing', 'Website Redesign', 'Warehouse Automation', 'Training Program', 'Mobile App'],
                    datasets: [{
                        label: 'ROI (%)',
                        data: [158, 45, 112, -8, 85],
                        backgroundColor: function(context) {
                            const value = context.dataset.data[context.dataIndex];
                            if (value < 0) return 'rgba(231, 76, 60, 0.7)';
                            if (value < 50) return 'rgba(243, 156, 18, 0.7)';
                            return 'rgba(46, 204, 113, 0.7)';
                        },
                        borderColor: function(context) {
                            const value = context.dataset.data[context.dataIndex];
                            if (value < 0) return 'rgba(231, 76, 60, 1)';
                            if (value < 50) return 'rgba(243, 156, 18, 1)';
                            return 'rgba(46, 204, 113, 1)';
                        },
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: 'ROI (%)'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'ROI Comparison Across Projects'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>

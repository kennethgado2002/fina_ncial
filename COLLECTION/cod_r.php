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
            --matched: #2ecc71;
            --partial: #f39c12;
            --unmatched: #e74c3c;
            --pending: #3498db;
            --courier-1: #3498db;
            --courier-2: #9b59b6;
            --courier-3: #e74c3c;
            --courier-4: #f39c12;
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

        .status-matched {
            background-color: var(--matched);
            color: white;
        }

        .status-partial {
            background-color: var(--partial);
            color: white;
        }

        .status-unmatched {
            background-color: var(--unmatched);
            color: white;
        }

        .status-pending {
            background-color: var(--pending);
            color: white;
        }

        .status-overdue {
            background-color: #e74c3c;
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

        /* Upload Area */
        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            margin-bottom: 30px;
            transition: var(--transition);
            cursor: pointer;
        }

        .upload-area:hover {
            border-color: var(--secondary);
            background-color: #f8f9fa;
        }

        .upload-icon {
            font-size: 3rem;
            color: #7f8c8d;
            margin-bottom: 15px;
        }

        .upload-text {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 10px;
        }

        .upload-subtext {
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        /* Courier Selector */
        .courier-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .courier-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: var(--transition);
            cursor: pointer;
            flex: 1;
            min-width: 200px;
            text-align: center;
        }

        .courier-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .courier-card.selected {
            border: 2px solid var(--secondary);
        }

        .courier-icon {
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

        .courier-icon.lbc {
            background-color: #d32f2f;
        }

        .courier-icon.jnt {
            background-color: #ff6d00;
        }

        .courier-icon.flash {
            background-color: #1565c0;
        }

        .courier-icon.grab {
            background-color: #00b14f;
        }

        .courier-card h3 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 10px;
        }

        /* Matching Dashboard */
        .matching-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            text-align: center;
        }

        .stat-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-label {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        /* Discrepancy Cards */
        .discrepancy-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .discrepancy-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: var(--transition);
        }

        .discrepancy-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .discrepancy-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .discrepancy-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .discrepancy-amount {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .discrepancy-details {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        /* Courier Ledger */
        .ledger-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .ledger-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            text-align: center;
        }

        .ledger-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .ledger-label {
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
            min-width: 180px;
        }

        /* Comparison Table */
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .comparison-table th, .comparison-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #eee;
        }

        .comparison-table th {
            background-color: #f8f9fa;
            font-family: 'Montserrat', sans-serif;
        }

        .match-exact {
            background-color: rgba(46, 204, 113, 0.1);
        }

        .match-partial {
            background-color: rgba(243, 156, 18, 0.1);
        }

        .match-none {
            background-color: rgba(231, 76, 60, 0.1);
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
            
            .courier-selector {
                flex-direction: column;
            }
            
            .discrepancy-cards {
                grid-template-columns: 1fr;
            }
            
            .ledger-summary {
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
            
            .filter-section {
                flex-direction: column;
            }
            
            .filter-select {
                width: 100%;
            }
            
            .tabs {
                flex-wrap: wrap;
            }
            
            .tab {
                flex: 1;
                text-align: center;
                padding: 10px;
            }
            
            .matching-stats {
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
                <h1 class="page-title">COD Reconciliation</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card" onclick="switchTab('upload')">
                        <div class="card-icon blue">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h3>Pending Remittances</h3>
                        <p>6</p>
                        <small>Courier files to process</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('matching')">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Matched Orders</h3>
                        <p>185</p>
                        <small>This week</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('discrepancy')">
                        <div class="card-icon orange">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3>Discrepancies</h3>
                        <p>22</p>
                        <small>Require attention</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('ledger')">
                        <div class="card-icon purple">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <h3>Courier Liabilities</h3>
                        <p>₱125,750</p>
                        <small>Pending settlement</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="upload">COD Remittance Upload</div>
                    <div class="tab" data-tab="matching">Order Matching</div>
                    <div class="tab" data-tab="discrepancy">Discrepancy Dashboard</div>
                    <div class="tab" data-tab="ledger">Courier Settlement Ledger</div>
                </div>

                <!-- COD Remittance Upload Tab -->
                <div class="tab-content active" id="upload-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Upload Courier Remittance Files</h2>
                        </div>
                        <div class="card-body">
                            <div class="courier-selector">
                                <div class="courier-card" onclick="selectCourier('lbc')">
                                    <div class="courier-icon lbc">
                                        <i class="fas fa-shipping-fast"></i>
                                    </div>
                                    <h3>LBC Express</h3>
                                    <p>Upload remittance file</p>
                                </div>
                                <div class="courier-card" onclick="selectCourier('jnt')">
                                    <div class="courier-icon jnt">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <h3>J&T Express</h3>
                                    <p>Upload remittance file</p>
                                </div>
                                <div class="courier-card" onclick="selectCourier('flash')">
                                    <div class="courier-icon flash">
                                        <i class="fas fa-bolt"></i>
                                    </div>
                                    <h3>Flash Express</h3>
                                    <p>Upload remittance file</p>
                                </div>
                                <div class="courier-card" onclick="selectCourier('grab')">
                                    <div class="courier-icon grab">
                                        <i class="fas fa-motorcycle"></i>
                                    </div>
                                    <h3>GrabExpress</h3>
                                    <p>Upload remittance file</p>
                                </div>
                            </div>

                            <div class="upload-area" id="uploadArea">
                                <div class="upload-icon">
                                    <i class="fas fa-file-csv"></i>
                                </div>
                                <h3 class="upload-text">Drag & Drop Courier Remittance Files</h3>
                                <p class="upload-subtext">Supported formats: CSV, XLSX, or connect via API</p>
                                <button class="btn btn-primary" id="browseFiles">
                                    <i class="fas fa-folder-open"></i> Browse Files
                                </button>
                                <input type="file" id="fileInput" style="display: none;" accept=".csv,.xlsx,.xls">
                            </div>

                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <input type="date" class="filter-select" id="uploadStartDate" value="2025-09-01">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">&nbsp;</span>
                                    <input type="date" class="filter-select" id="uploadEndDate" value="2025-09-09">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Courier</span>
                                    <select class="filter-select" id="courierFilter">
                                        <option value="">All Couriers</option>
                                        <option value="lbc">LBC Express</option>
                                        <option value="jnt">J&T Express</option>
                                        <option value="flash">Flash Express</option>
                                        <option value="grab">GrabExpress</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="uploadStatusFilter">
                                        <option value="">All Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="processing">Processing</option>
                                        <option value="completed">Completed</option>
                                        <option value="error">Error</option>
                                    </select>
                                </div>
                            </div>

                            <h3 style="margin-bottom: 15px; font-family: 'Montserrat', sans-serif;">Recent Uploads</h3>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Filename</th>
                                            <th>Courier</th>
                                            <th>Date Range</th>
                                            <th>Orders</th>
                                            <th>Total Amount</th>
                                            <th>Uploaded</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>lbc_remittance_2025-09-08.csv</td>
                                            <td>LBC Express</td>
                                            <td>Sep 1 - Sep 7, 2025</td>
                                            <td>42</td>
                                            <td>₱125,500</td>
                                            <td>2025-09-08 14:30</td>
                                            <td><span class="status status-matched">Processed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>jnt_collections_2025-09-07.csv</td>
                                            <td>J&T Express</td>
                                            <td>Sep 1 - Sep 6, 2025</td>
                                            <td>38</td>
                                            <td>₱98,750</td>
                                            <td>2025-09-07 11:15</td>
                                            <td><span class="status status-matched">Processed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>flash_cod_2025-09-09.csv</td>
                                            <td>Flash Express</td>
                                            <td>Sep 1 - Sep 8, 2025</td>
                                            <td>56</td>
                                            <td>₱156,300</td>
                                            <td>2025-09-09 09:45</td>
                                            <td><span class="status status-pending">Processing</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>grab_remit_2025-09-06.csv</td>
                                            <td>GrabExpress</td>
                                            <td>Aug 30 - Sep 5, 2025</td>
                                            <td>29</td>
                                            <td>₱45,200</td>
                                            <td>2025-09-06 16:20</td>
                                            <td><span class="status status-matched">Processed</span></td>
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

                <!-- Order Matching Tab -->
                <div class="tab-content" id="matching-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">COD Order Matching</h2>
                            <div>
                                <button class="btn btn-primary" id="runMatching"><i class="fas fa-cogs"></i> Run Auto-Match</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="matching-stats">
                                <div class="stat-card">
                                    <div class="stat-value">245</div>
                                    <div class="stat-label">Total COD Orders</div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value">185</div>
                                    <div class="stat-label">Fully Matched</div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value">38</div>
                                    <div class="stat-label">Partial Match</div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value">22</div>
                                    <div class="stat-label">Unmatched</div>
                                </div>
                            </div>

                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Matching Status</span>
                                    <select class="filter-select" id="matchingStatusFilter">
                                        <option value="">All Status</option>
                                        <option value="matched">Fully Matched</option>
                                        <option value="partial">Partial Match</option>
                                        <option value="unmatched">Unmatched</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Courier</span>
                                    <select class="filter-select" id="matchingCourierFilter">
                                        <option value="">All Couriers</option>
                                        <option value="lbc">LBC Express</option>
                                        <option value="jnt">J&T Express</option>
                                        <option value="flash">Flash Express</option>
                                        <option value="grab">GrabExpress</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <input type="date" class="filter-select" id="matchingStartDate" value="2025-09-01">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">&nbsp;</span>
                                    <input type="date" class="filter-select" id="matchingEndDate" value="2025-09-09">
                                </div>
                            </div>

                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="matchingSearch" placeholder="Search Order ID, Customer, or Rider...">
                                <button class="btn btn-primary">Search</button>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Courier</th>
                                            <th>Rider</th>
                                            <th>Order Amount</th>
                                            <th>Collected Amount</th>
                                            <th>Delivery Date</th>
                                            <th>Remittance Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ORD-2025-085</td>
                                            <td>Maria Santos</td>
                                            <td>LBC Express</td>
                                            <td>Rider-015</td>
                                            <td>₱12,500.00</td>
                                            <td>₱12,500.00</td>
                                            <td>2025-09-01</td>
                                            <td>2025-09-03</td>
                                            <td><span class="status status-matched">Matched</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openComparisonModal()"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ORD-2025-086</td>
                                            <td>Juan Dela Cruz</td>
                                            <td>J&T Express</td>
                                            <td>Rider-042</td>
                                            <td>₱8,750.00</td>
                                            <td>₱8,750.00</td>
                                            <td>2025-09-02</td>
                                            <td>2025-09-04</td>
                                            <td><span class="status status-matched">Matched</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openComparisonModal()"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ORD-2025-087</td>
                                            <td>Ana Reyes</td>
                                            <td>Flash Express</td>
                                            <td>Rider-028</td>
                                            <td>₱5,250.00</td>
                                            <td>₱5,200.00</td>
                                            <td>2025-09-03</td>
                                            <td>2025-09-05</td>
                                            <td><span class="status status-partial">Partial</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openComparisonModal()"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ORD-2025-088</td>
                                            <td>Carlos Lim</td>
                                            <td>GrabExpress</td>
                                            <td>Rider-033</td>
                                            <td>₱3,800.00</td>
                                            <td>₱3,800.00</td>
                                            <td>2025-09-04</td>
                                            <td>2025-09-06</td>
                                            <td><span class="status status-matched">Matched</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openComparisonModal()"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ORD-2025-089</td>
                                            <td>Elena Torres</td>
                                            <td>LBC Express</td>
                                            <td>Rider-019</td>
                                            <td>₱4,500.00</td>
                                            <td>₱0.00</td>
                                            <td>2025-09-05</td>
                                            <td>N/A</td>
                                            <td><span class="status status-unmatched">Unmatched</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openComparisonModal()"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Discrepancy Dashboard Tab -->
                <div class="tab-content" id="discrepancy-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Discrepancy Dashboard</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export Report</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="discrepancy-cards">
                                <div class="discrepancy-card">
                                    <div class="discrepancy-header">
                                        <div class="discrepancy-title">Missing Deposits</div>
                                        <i class="fas fa-exclamation-circle" style="color: #e74c3c;"></i>
                                    </div>
                                    <div class="discrepancy-amount">₱22,500.00</div>
                                    <div class="discrepancy-details">
                                        <p>8 orders with no remittance</p>
                                        <p>Average delay: 4 days</p>
                                        <p>Most affected: LBC Express</p>
                                    </div>
                                </div>
                                
                                <div class="discrepancy-card">
                                    <div class="discrepancy-header">
                                        <div class="discrepancy-title">Partial Collections</div>
                                        <i class="fas fa-money-bill-wave" style="color: #f39c12;"></i>
                                    </div>
                                    <div class="discrepancy-amount">₱8,750.00</div>
                                    <div class="discrepancy-details">
                                        <p>12 orders with partial payment</p>
                                        <p>Total shortage: ₱8,750.00</p>
                                        <p>Most affected: Flash Express</p>
                                    </div>
                                </div>
                                
                                <div class="discrepancy-card">
                                    <div class="discrepancy-header">
                                        <div class="discrepancy-title">Courier Shortfalls</div>
                                        <i class="fas fa-truck" style="color: #3498db;"></i>
                                    </div>
                                    <div class="discrepancy-amount">₱15,300.00</div>
                                    <div class="discrepancy-details">
                                        <p>5 couriers with remittance gaps</p>
                                        <p>Total liability: ₱15,300.00</p>
                                        <p>Highest: J&T Express (₱7,500)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Discrepancy Type</span>
                                    <select class="filter-select" id="discrepancyTypeFilter">
                                        <option value="">All Types</option>
                                        <option value="missing">Missing Deposits</option>
                                        <option value="partial">Partial Collections</option>
                                        <option value="shortfall">Courier Shortfalls</option>
                                        <option value="overdue">Overdue Remittance</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Courier</span>
                                    <select class="filter-select" id="discrepancyCourierFilter">
                                        <option value="">All Couriers</option>
                                        <option value="lbc">LBC Express</option>
                                        <option value="jnt">J&T Express</option>
                                        <option value="flash">Flash Express</option>
                                        <option value="grab">GrabExpress</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <input type="date" class="filter-select" id="discrepancyStartDate" value="2025-09-01">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">&nbsp;</span>
                                    <input type="date" class="filter-select" id="discrepancyEndDate" value="2025-09-09">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Discrepancy ID</th>
                                            <th>Type</th>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Courier</th>
                                            <th>Order Amount</th>
                                            <th>Collected</th>
                                            <th>Shortfall</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>DISC-2025-001</td>
                                            <td>Missing Deposit</td>
                                            <td>ORD-2025-089</td>
                                            <td>Elena Torres</td>
                                            <td>LBC Express</td>
                                            <td>₱4,500.00</td>
                                            <td>₱0.00</td>
                                            <td>₱4,500.00</td>
                                            <td><span class="status status-unmatched">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i> Resolve</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DISC-2025-002</td>
                                            <td>Partial Collection</td>
                                            <td>ORD-2025-087</td>
                                            <td>Ana Reyes</td>
                                            <td>Flash Express</td>
                                            <td>₱5,250.00</td>
                                            <td>₱5,200.00</td>
                                            <td>₱50.00</td>
                                            <td><span class="status status-partial">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i> Resolve</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DISC-2025-003</td>
                                            <td>Courier Shortfall</td>
                                            <td>ORD-2025-092</td>
                                            <td>Michael Tan</td>
                                            <td>J&T Express</td>
                                            <td>₱7,500.00</td>
                                            <td>₱7,200.00</td>
                                            <td>₱300.00</td>
                                            <td><span class="status status-unmatched">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i> Resolve</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DISC-2025-004</td>
                                            <td>Overdue Remittance</td>
                                            <td>ORD-2025-095</td>
                                            <td>Sarah Johnson</td>
                                            <td>GrabExpress</td>
                                            <td>₱3,200.00</td>
                                            <td>₱3,200.00</td>
                                            <td>₱0.00</td>
                                            <td><span class="status status-overdue">Overdue</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i> Resolve</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DISC-2025-005</td>
                                            <td>Missing Deposit</td>
                                            <td>ORD-2025-088</td>
                                            <td>Carlos Lim</td>
                                            <td>Flash Express</td>
                                            <td>₱2,500.00</td>
                                            <td>₱0.00</td>
                                            <td>₱2,500.00</td>
                                            <td><span class="status status-unmatched">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i> Resolve</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courier Settlement Ledger Tab -->
                <div class="tab-content" id="ledger-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Courier Settlement Ledger</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="ledger-summary">
                                <div class="ledger-card">
                                    <div class="ledger-value">₱425,750</div>
                                    <div class="ledger-label">Total COD Collections</div>
                                </div>
                                <div class="ledger-card">
                                    <div class="ledger-value">₱125,750</div>
                                    <div class="ledger-label">Pending Settlement</div>
                                </div>
                                <div class="ledger-card">
                                    <div class="ledger-value">₱22,500</div>
                                    <div class="ledger-label">Outstanding Shortfalls</div>
                                </div>
                                <div class="ledger-card">
                                    <div class="ledger-value">₱300,000</div>
                                    <div class="ledger-label">Settled This Month</div>
                                </div>
                            </div>

                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Courier</span>
                                    <select class="filter-select" id="ledgerCourierFilter">
                                        <option value="">All Couriers</option>
                                        <option value="lbc">LBC Express</option>
                                        <option value="jnt">J&T Express</option>
                                        <option value="flash">Flash Express</option>
                                        <option value="grab">GrabExpress</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="ledgerStatusFilter">
                                        <option value="">All Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="settled">Settled</option>
                                        <option value="overdue">Overdue</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <input type="date" class="filter-select" id="ledgerStartDate" value="2025-09-01">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">&nbsp;</span>
                                    <input type="date" class="filter-select" id="ledgerEndDate" value="2025-09-09">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Courier</th>
                                            <th>Period</th>
                                            <th>Total Collections</th>
                                            <th>Fees & Deductions</th>
                                            <th>Net Payable</th>
                                            <th>Due Date</th>
                                            <th>Settlement Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>LBC Express</td>
                                            <td>Sep 1 - Sep 7</td>
                                            <td>₱125,500.00</td>
                                            <td>₱3,765.00</td>
                                            <td>₱121,735.00</td>
                                            <td>2025-09-10</td>
                                            <td>Pending</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-money-check"></i> Settle</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>J&T Express</td>
                                            <td>Sep 1 - Sep 6</td>
                                            <td>₱98,750.00</td>
                                            <td>₱2,962.50</td>
                                            <td>₱95,787.50</td>
                                            <td>2025-09-09</td>
                                            <td>2025-09-08</td>
                                            <td><span class="status status-matched">Settled</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Flash Express</td>
                                            <td>Sep 1 - Sep 8</td>
                                            <td>₱156,300.00</td>
                                            <td>₱4,689.00</td>
                                            <td>₱151,611.00</td>
                                            <td>2025-09-11</td>
                                            <td>Pending</td>
                                            <td><span class="status status-pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-money-check"></i> Settle</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>GrabExpress</td>
                                            <td>Aug 30 - Sep 5</td>
                                            <td>₱45,200.00</td>
                                            <td>₱1,356.00</td>
                                            <td>₱43,844.00</td>
                                            <td>2025-09-08</td>
                                            <td>2025-09-07</td>
                                            <td><span class="status status-matched">Settled</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-receipt"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h3 style="margin: 30px 0 15px; font-family: 'Montserrat', sans-serif;">Courier Liability Summary</h3>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Courier</th>
                                            <th>Pending Settlement</th>
                                            <th>Outstanding Shortfalls</th>
                                            <th>Total Liability</th>
                                            <th>Last Settlement</th>
                                            <th>Performance Score</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>LBC Express</td>
                                            <td>₱121,735.00</td>
                                            <td>₱4,500.00</td>
                                            <td>₱126,235.00</td>
                                            <td>2025-09-03</td>
                                            <td>88%</td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-chart-line"></i> Report</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>J&T Express</td>
                                            <td>₱0.00</td>
                                            <td>₱7,500.00</td>
                                            <td>₱7,500.00</td>
                                            <td>2025-09-08</td>
                                            <td>92%</td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-chart-line"></i> Report</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Flash Express</td>
                                            <td>₱151,611.00</td>
                                            <td>₱2,550.00</td>
                                            <td>₱154,161.00</td>
                                            <td>2025-09-05</td>
                                            <td>85%</td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-chart-line"></i> Report</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>GrabExpress</td>
                                            <td>₱0.00</td>
                                            <td>₱3,200.00</td>
                                            <td>₱3,200.00</td>
                                            <td>2025-09-07</td>
                                            <td>94%</td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-chart-line"></i> Report</button>
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
                <p>&copy; 2025 Financial System - COD Reconciliation</p>
            </div>
        </div>
    </div>

    <!-- Comparison Modal -->
    <div id="comparisonModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">COD Order Comparison</h2>
                <span class="close" onclick="closeModal('comparisonModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Order ID</label>
                            <p>ORD-2025-085</p>
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
                            <label class="form-label">Courier</label>
                            <p>LBC Express</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Rider</label>
                            <p>Rider-015</p>
                        </div>
                    </div>
                </div>

                <h3 class="form-label">COD Collection Comparison</h3>
                <div class="table-responsive">
                    <table class="comparison-table">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>System Data (AR Records)</th>
                                <th>Courier Data (Remittance)</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="match-exact">
                                <td>Order Amount</td>
                                <td>₱12,500.00</td>
                                <td>₱12,500.00</td>
                                <td>Exact Match</td>
                            </tr>
                            <tr class="match-exact">
                                <td>Collection Date</td>
                                <td>2025-09-01</td>
                                <td>2025-09-01</td>
                                <td>Exact Match</td>
                            </tr>
                            <tr class="match-exact">
                                <td>Remittance Date</td>
                                <td>2025-09-03</td>
                                <td>2025-09-03</td>
                                <td>Exact Match</td>
                            </tr>
                            <tr class="match-exact">
                                <td>Customer Name</td>
                                <td>Maria Santos</td>
                                <td>Maria Santos</td>
                                <td>Exact Match</td>
                            </tr>
                            <tr class="match-exact">
                                <td>Delivery Address</td>
                                <td>123 Main St, Manila</td>
                                <td>123 Main St, Manila</td>
                                <td>Exact Match</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label class="form-label">Reconciliation Summary</label>
                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <p><strong>Status:</strong> <span class="status status-matched">Fully Reconciled</span></p>
                        <p><strong>Confidence Score:</strong> 100%</p>
                        <p><strong>Auto-matched:</strong> Yes</p>
                        <p><strong>GL Posting:</strong> Cash Clearing Account #1010</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('comparisonModal')">Close</button>
                <button type="button" class="btn btn-primary">Post to GL</button>
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

        // Switch tab function for dashboard cards
        function switchTab(tabName) {
            tabs.forEach(t => t.classList.remove('active'));
            document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
            
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(`${tabName}-tab`).classList.add('active');
        }

        // Courier selection
        function selectCourier(courier) {
            // Remove selected class from all couriers
            document.querySelectorAll('.courier-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked courier
            event.currentTarget.classList.add('selected');
            
            // Update upload area text
            const uploadText = document.querySelector('.upload-text');
            let courierName = '';
            switch(courier) {
                case 'lbc': courierName = 'LBC Express'; break;
                case 'jnt': courierName = 'J&T Express'; break;
                case 'flash': courierName = 'Flash Express'; break;
                case 'grab': courierName = 'GrabExpress'; break;
            }
            uploadText.textContent = `Upload ${courierName} Remittance File`;
        }

        // File upload functionality
        document.getElementById('browseFiles').addEventListener('click', function() {
            document.getElementById('fileInput').click();
        });

        document.getElementById('fileInput').addEventListener('change', function() {
            if (this.files.length > 0) {
                const fileName = this.files[0].name;
                alert(`File "${fileName}" selected for upload. Click Process to continue.`);
            }
        });

        // Drag and drop functionality
        const uploadArea = document.getElementById('uploadArea');
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = 'var(--secondary)';
            this.style.backgroundColor = '#f8f9fa';
        });

        uploadArea.addEventListener('dragleave', function() {
            this.style.borderColor = '#ddd';
            this.style.backgroundColor = '';
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#ddd';
            this.style.backgroundColor = '';
            
            if (e.dataTransfer.files.length > 0) {
                const fileName = e.dataTransfer.files[0].name;
                alert(`File "${fileName}" dropped for upload. Click Process to continue.`);
            }
        });

        // Modal functionality
        function openComparisonModal() {
            document.getElementById('comparisonModal').style.display = 'block';
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

        // Run auto-matching functionality
        document.getElementById('runMatching').addEventListener('click', function() {
            // Simulate matching process
            this.querySelector('i').classList.add('fa-spin');
            setTimeout(() => {
                this.querySelector('i').classList.remove('fa-spin');
                alert('Auto-matching completed! 245 COD orders processed. 185 matched, 38 partial matches, 22 unmatched.');
            }, 2000);
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

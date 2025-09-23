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
            --bank-1: #3498db;
            --bank-2: #9b59b6;
            --bank-3: #e74c3c;
            --bank-4: #f39c12;
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

        .status-identified {
            background-color: #9b59b6;
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

        /* Bank Selector */
        .bank-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .bank-card {
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

        .bank-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .bank-card.selected {
            border: 2px solid var(--secondary);
        }

        .bank-icon {
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

        .bank-icon.bdo {
            background-color: #d32f2f;
        }

        .bank-icon.bpi {
            background-color: #ab003c;
        }

        .bank-icon.metrobank {
            background-color: #f57c00;
        }

        .bank-icon.unionbank {
            background-color: #0077c8;
        }

        .bank-card h3 {
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

        /* Exception Cards */
        .exception-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .exception-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: var(--transition);
        }

        .exception-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .exception-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .exception-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .exception-amount {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .exception-details {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        /* Cash Ledger */
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
            
            .bank-selector {
                flex-direction: column;
            }
            
            .exception-cards {
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
                <h1 class="page-title">Bank Deposit Matching</h1>

                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="dashboard-card" onclick="switchTab('import')">
                        <div class="card-icon blue">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h3>Pending Statements</h3>
                        <p>4</p>
                        <small>Bank statements to process</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('matching')">
                        <div class="card-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Matched Deposits</h3>
                        <p>68</p>
                        <small>This week</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('exception')">
                        <div class="card-icon orange">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3>Exceptions</h3>
                        <p>12</p>
                        <small>Require attention</small>
                    </div>
                    <div class="dashboard-card" onclick="switchTab('ledger')">
                        <div class="card-icon purple">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <h3>Cash Variance</h3>
                        <p>₱8,250</p>
                        <small>System vs Bank</small>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" data-tab="import">Bank Statement Import</div>
                    <div class="tab" data-tab="matching">Deposit Matching</div>
                    <div class="tab" data-tab="exception">Exception Report</div>
                    <div class="tab" data-tab="ledger">Cash Ledger View</div>
                </div>

                <!-- Bank Statement Import Tab -->
                <div class="tab-content active" id="import-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Import Bank Statements</h2>
                        </div>
                        <div class="card-body">
                            <div class="bank-selector">
                                <div class="bank-card" onclick="selectBank('bdo')">
                                    <div class="bank-icon bdo">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <h3>BDO</h3>
                                    <p>MT940 / CSV / API</p>
                                </div>
                                <div class="bank-card" onclick="selectBank('bpi')">
                                    <div class="bank-icon bpi">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <h3>BPI</h3>
                                    <p>MT940 / CSV / API</p>
                                </div>
                                <div class="bank-card" onclick="selectBank('metrobank')">
                                    <div class="bank-icon metrobank">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <h3>Metrobank</h3>
                                    <p>MT940 / CSV / API</p>
                                </div>
                                <div class="bank-card" onclick="selectBank('unionbank')">
                                    <div class="bank-icon unionbank">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <h3>UnionBank</h3>
                                    <p>MT940 / CSV / API</p>
                                </div>
                            </div>

                            <div class="upload-area" id="uploadArea">
                                <div class="upload-icon">
                                    <i class="fas fa-file-csv"></i>
                                </div>
                                <h3 class="upload-text">Drag & Drop Bank Statement Files</h3>
                                <p class="upload-subtext">Supported formats: MT940, CSV, XLSX, or connect via API</p>
                                <button class="btn btn-primary" id="browseFiles">
                                    <i class="fas fa-folder-open"></i> Browse Files
                                </button>
                                <input type="file" id="fileInput" style="display: none;" accept=".csv,.xlsx,.xls,.mt940">
                            </div>

                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <input type="date" class="filter-select" id="importStartDate" value="2025-09-01">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">&nbsp;</span>
                                    <input type="date" class="filter-select" id="importEndDate" value="2025-09-09">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Bank</span>
                                    <select class="filter-select" id="bankFilter">
                                        <option value="">All Banks</option>
                                        <option value="bdo">BDO</option>
                                        <option value="bpi">BPI</option>
                                        <option value="metrobank">Metrobank</option>
                                        <option value="unionbank">UnionBank</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Status</span>
                                    <select class="filter-select" id="importStatusFilter">
                                        <option value="">All Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="processing">Processing</option>
                                        <option value="completed">Completed</option>
                                        <option value="error">Error</option>
                                    </select>
                                </div>
                            </div>

                            <h3 style="margin-bottom: 15px; font-family: 'Montserrat', sans-serif;">Recent Imports</h3>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Filename</th>
                                            <th>Bank</th>
                                            <th>Account</th>
                                            <th>Date Range</th>
                                            <th>Transactions</th>
                                            <th>Imported</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>bdo_statement_2025-09-08.mt940</td>
                                            <td>BDO</td>
                                            <td>****1234</td>
                                            <td>Sep 1 - Sep 7, 2025</td>
                                            <td>142</td>
                                            <td>2025-09-08 14:30</td>
                                            <td><span class="status status-matched">Processed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>bpi_transactions_2025-09-07.csv</td>
                                            <td>BPI</td>
                                            <td>****5678</td>
                                            <td>Sep 1 - Sep 6, 2025</td>
                                            <td>98</td>
                                            <td>2025-09-07 11:15</td>
                                            <td><span class="status status-matched">Processed</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>metrobank_deposits_2025-09-09.csv</td>
                                            <td>Metrobank</td>
                                            <td>****9012</td>
                                            <td>Sep 1 - Sep 8, 2025</td>
                                            <td>76</td>
                                            <td>2025-09-09 09:45</td>
                                            <td><span class="status status-pending">Processing</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>unionbank_stmt_2025-09-06.csv</td>
                                            <td>UnionBank</td>
                                            <td>****3456</td>
                                            <td>Aug 30 - Sep 5, 2025</td>
                                            <td>65</td>
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

                <!-- Deposit Matching Tab -->
                <div class="tab-content" id="matching-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Deposit Matching Dashboard</h2>
                            <div>
                                <button class="btn btn-primary" id="runMatching"><i class="fas fa-cogs"></i> Run Auto-Match</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="matching-stats">
                                <div class="stat-card">
                                    <div class="stat-value">245</div>
                                    <div class="stat-label">Total Deposits</div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value">185</div>
                                    <div class="stat-label">Fully Matched</div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value">48</div>
                                    <div class="stat-label">Partial Match</div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value">12</div>
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
                                    <span class="filter-label">Bank</span>
                                    <select class="filter-select" id="matchingBankFilter">
                                        <option value="">All Banks</option>
                                        <option value="bdo">BDO</option>
                                        <option value="bpi">BPI</option>
                                        <option value="metrobank">Metrobank</option>
                                        <option value="unionbank">UnionBank</option>
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
                                <input type="text" id="matchingSearch" placeholder="Search Deposit ID, Reference, or Amount...">
                                <button class="btn btn-primary">Search</button>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Deposit ID</th>
                                            <th>Bank</th>
                                            <th>Bank Reference</th>
                                            <th>Bank Amount</th>
                                            <th>System Amount</th>
                                            <th>Deposit Date</th>
                                            <th>Source</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>DEP-2025-085</td>
                                            <td>BDO</td>
                                            <td>BNK-2025-001</td>
                                            <td>₱125,500.00</td>
                                            <td>₱125,500.00</td>
                                            <td>2025-09-01</td>
                                            <td>Gateway Settlement</td>
                                            <td><span class="status status-matched">Matched</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openComparisonModal()"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DEP-2025-086</td>
                                            <td>BPI</td>
                                            <td>BNK-2025-002</td>
                                            <td>₱98,750.00</td>
                                            <td>₱98,750.00</td>
                                            <td>2025-09-02</td>
                                            <td>COD Deposit</td>
                                            <td><span class="status status-matched">Matched</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openComparisonModal()"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DEP-2025-087</td>
                                            <td>Metrobank</td>
                                            <td>BNK-2025-003</td>
                                            <td>₱156,300.00</td>
                                            <td>₱156,250.00</td>
                                            <td>2025-09-03</td>
                                            <td>Gateway Settlement</td>
                                            <td><span class="status status-partial">Partial</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openComparisonModal()"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DEP-2025-088</td>
                                            <td>UnionBank</td>
                                            <td>BNK-2025-004</td>
                                            <td>₱45,200.00</td>
                                            <td>₱45,200.00</td>
                                            <td>2025-09-04</td>
                                            <td>COD Deposit</td>
                                            <td><span class="status status-matched">Matched</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm" onclick="openComparisonModal()"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DEP-2025-089</td>
                                            <td>BDO</td>
                                            <td>BNK-2025-005</td>
                                            <td>₱22,500.00</td>
                                            <td>₱0.00</td>
                                            <td>2025-09-05</td>
                                            <td>Unidentified</td>
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

                <!-- Exception Report Tab -->
                <div class="tab-content" id="exception-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Exception Report</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export Report</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="exception-cards">
                                <div class="exception-card">
                                    <div class="exception-header">
                                        <div class="exception-title">Unidentified Deposits</div>
                                        <i class="fas fa-question-circle" style="color: #e74c3c;"></i>
                                    </div>
                                    <div class="exception-amount">₱22,500.00</div>
                                    <div class="exception-details">
                                        <p>5 deposits with no system match</p>
                                        <p>Average amount: ₱4,500.00</p>
                                        <p>Most common bank: BDO</p>
                                    </div>
                                </div>
                                
                                <div class="exception-card">
                                    <div class="exception-header">
                                        <div class="exception-title">Missing Deposits</div>
                                        <i class="fas fa-exclamation-circle" style="color: #f39c12;"></i>
                                    </div>
                                    <div class="exception-amount">₱15,750.00</div>
                                    <div class="exception-details">
                                        <p>7 system entries with no bank deposit</p>
                                        <p>Total missing: ₱15,750.00</p>
                                        <p>Most affected: Gateway Settlements</p>
                                    </div>
                                </div>
                                
                                <div class="exception-card">
                                    <div class="exception-header">
                                        <div class="exception-title">Partial Matches</div>
                                        <i class="fas fa-percentage" style="color: #3498db;"></i>
                                    </div>
                                    <div class="exception-amount">₱8,250.00</div>
                                    <div class="exception-details">
                                        <p>12 deposits with amount variances</p>
                                        <p>Total variance: ₱8,250.00</p>
                                        <p>Most common: Bank fees differences</p>
                                    </div>
                                </div>
                            </div>

                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Exception Type</span>
                                    <select class="filter-select" id="exceptionTypeFilter">
                                        <option value="">All Types</option>
                                        <option value="unidentified">Unidentified Deposits</option>
                                        <option value="missing">Missing Deposits</option>
                                        <option value="partial">Partial Matches</option>
                                        <option value="date">Date Mismatches</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Bank</span>
                                    <select class="filter-select" id="exceptionBankFilter">
                                        <option value="">All Banks</option>
                                        <option value="bdo">BDO</option>
                                        <option value="bpi">BPI</option>
                                        <option value="metrobank">Metrobank</option>
                                        <option value="unionbank">UnionBank</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">Date Range</span>
                                    <input type="date" class="filter-select" id="exceptionStartDate" value="2025-09-01">
                                </div>
                                <div class="filter-item">
                                    <span class="filter-label">&nbsp;</span>
                                    <input type="date" class="filter-select" id="exceptionEndDate" value="2025-09-09">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Exception ID</th>
                                            <th>Type</th>
                                            <th>Bank Reference</th>
                                            <th>Deposit ID</th>
                                            <th>Bank Amount</th>
                                            <th>System Amount</th>
                                            <th>Variance</th>
                                            <th>Bank</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>EXC-2025-001</td>
                                            <td>Unidentified</td>
                                            <td>BNK-2025-005</td>
                                            <td>N/A</td>
                                            <td>₱22,500.00</td>
                                            <td>₱0.00</td>
                                            <td>₱22,500.00</td>
                                            <td>BDO</td>
                                            <td><span class="status status-unmatched">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i> Identify</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EXC-2025-002</td>
                                            <td>Missing</td>
                                            <td>N/A</td>
                                            <td>DEP-2025-090</td>
                                            <td>₱0.00</td>
                                            <td>₱8,500.00</td>
                                            <td>₱8,500.00</td>
                                            <td>BPI</td>
                                            <td><span class="status status-unmatched">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i> Resolve</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EXC-2025-003</td>
                                            <td>Partial</td>
                                            <td>BNK-2025-003</td>
                                            <td>DEP-2025-087</td>
                                            <td>₱156,300.00</td>
                                            <td>₱156,250.00</td>
                                            <td>₱50.00</td>
                                            <td>Metrobank</td>
                                            <td><span class="status status-partial">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i> Resolve</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EXC-2025-004</td>
                                            <td>Date Mismatch</td>
                                            <td>BNK-2025-008</td>
                                            <td>DEP-2025-092</td>
                                            <td>₱12,500.00</td>
                                            <td>₱12,500.00</td>
                                            <td>2 days</td>
                                            <td>UnionBank</td>
                                            <td><span class="status status-partial">Pending</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i> Resolve</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EXC-2025-005</td>
                                            <td>Unidentified</td>
                                            <td>BNK-2025-010</td>
                                            <td>N/A</td>
                                            <td>₱7,200.00</td>
                                            <td>₱0.00</td>
                                            <td>₱7,200.00</td>
                                            <td>BDO</td>
                                            <td><span class="status status-identified">Identified</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i> Post</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cash Ledger View Tab -->
                <div class="tab-content" id="ledger-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Cash Ledger View</h2>
                            <div>
                                <button class="btn btn-download"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="ledger-summary">
                                <div class="ledger-card">
                                    <div class="ledger-value">₱2,850,000</div>
                                    <div class="ledger-label">System Cash Balance</div>
                                </div>
                                <div class="ledger-card">
                                    <div class="ledger-value">₱2,841,750</div>
                                    <div class="ledger-label">Bank Cash Balance</div>
                                </div>
                                <div class="ledger-card">
                                    <div class="ledger-value">₱8,250</div>
                                    <div class="ledger-label">Reconciliation Variance</div>
                                </div>
                                <div class="ledger-card">
                                    <div class="ledger-value">98.7%</div>
                                    <div class="ledger-label">Reconciliation Rate</div>
                                </div>
                            </div>

                            <div class="filter-section">
                                <div class="filter-item">
                                    <span class="filter-label">Bank Account</span>
                                    <select class="filter-select" id="ledgerBankFilter">
                                        <option value="">All Accounts</option>
                                        <option value="bdo">BDO Main (****1234)</option>
                                        <option value="bpi">BPI Operations (****5678)</option>
                                        <option value="metrobank">Metrobank Payroll (****9012)</option>
                                        <option value="unionbank">UnionBank Collections (****3456)</option>
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
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>System Debit</th>
                                            <th>System Credit</th>
                                            <th>System Balance</th>
                                            <th>Bank Debit</th>
                                            <th>Bank Credit</th>
                                            <th>Bank Balance</th>
                                            <th>Variance</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2025-09-01</td>
                                            <td>Opening Balance</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>₱2,500,000</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>₱2,500,000</td>
                                            <td>₱0</td>
                                            <td><span class="status status-matched">Matched</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-02</td>
                                            <td>Gateway Settlement - PayPal</td>
                                            <td>-</td>
                                            <td>₱125,500</td>
                                            <td>₱2,625,500</td>
                                            <td>-</td>
                                            <td>₱125,500</td>
                                            <td>₱2,625,500</td>
                                            <td>₱0</td>
                                            <td><span class="status status-matched">Matched</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-03</td>
                                            <td>COD Deposit - LBC</td>
                                            <td>-</td>
                                            <td>₱98,750</td>
                                            <td>₱2,724,250</td>
                                            <td>-</td>
                                            <td>₱98,750</td>
                                            <td>₱2,724,250</td>
                                            <td>₱0</td>
                                            <td><span class="status status-matched">Matched</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-04</td>
                                            <td>Gateway Settlement - Stripe</td>
                                            <td>-</td>
                                            <td>₱156,250</td>
                                            <td>₱2,880,500</td>
                                            <td>-</td>
                                            <td>₱156,300</td>
                                            <td>₱2,880,550</td>
                                            <td>₱50</td>
                                            <td><span class="status status-partial">Variance</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-05</td>
                                            <td>Vendor Payment - ABC Suppliers</td>
                                            <td>₱125,000</td>
                                            <td>-</td>
                                            <td>₱2,755,500</td>
                                            <td>₱125,000</td>
                                            <td>-</td>
                                            <td>₱2,755,550</td>
                                            <td>₱50</td>
                                            <td><span class="status status-partial">Variance</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-06</td>
                                            <td>Unidentified Deposit</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>₱2,755,500</td>
                                            <td>-</td>
                                            <td>₱22,500</td>
                                            <td>₱2,778,050</td>
                                            <td>₱22,550</td>
                                            <td><span class="status status-unmatched">Unmatched</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-07</td>
                                            <td>Payroll Disbursement</td>
                                            <td>₱285,500</td>
                                            <td>-</td>
                                            <td>₱2,470,000</td>
                                            <td>₱285,500</td>
                                            <td>-</td>
                                            <td>₱2,492,550</td>
                                            <td>₱22,550</td>
                                            <td><span class="status status-unmatched">Unmatched</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-08</td>
                                            <td>COD Deposit - J&T Express</td>
                                            <td>-</td>
                                            <td>₱45,200</td>
                                            <td>₱2,515,200</td>
                                            <td>-</td>
                                            <td>₱45,200</td>
                                            <td>₱2,537,750</td>
                                            <td>₱22,550</td>
                                            <td><span class="status status-unmatched">Unmatched</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-09</td>
                                            <td>Missing Deposit (System)</td>
                                            <td>-</td>
                                            <td>₱8,500</td>
                                            <td>₱2,523,700</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>₱2,537,750</td>
                                            <td>₱14,050</td>
                                            <td><span class="status status-unmatched">Unmatched</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h3 style="margin: 30px 0 15px; font-family: 'Montserrat', sans-serif;">Bank Account Summary</h3>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Bank Account</th>
                                            <th>System Balance</th>
                                            <th>Bank Balance</th>
                                            <th>Variance</th>
                                            <th>Last Reconciled</th>
                                            <th>Reconciliation Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>BDO Main (****1234)</td>
                                            <td>₱1,250,000</td>
                                            <td>₱1,241,750</td>
                                            <td>₱8,250</td>
                                            <td>2025-09-09</td>
                                            <td><span class="status status-partial">Partial</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i> Details</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BPI Operations (****5678)</td>
                                            <td>₱750,000</td>
                                            <td>₱750,000</td>
                                            <td>₱0</td>
                                            <td>2025-09-09</td>
                                            <td><span class="status status-matched">Reconciled</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i> Details</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Metrobank Payroll (****9012)</td>
                                            <td>₱500,000</td>
                                            <td>₱500,000</td>
                                            <td>₱0</td>
                                            <td>2025-09-09</td>
                                            <td><span class="status status-matched">Reconciled</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i> Details</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>UnionBank Collections (****3456)</td>
                                            <td>₱350,000</td>
                                            <td>₱350,000</td>
                                            <td>₱0</td>
                                            <td>2025-09-09</td>
                                            <td><span class="status status-matched">Reconciled</span></td>
                                            <td>
                                                <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i> Details</button>
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
                <p>&copy; 2025 Financial System - Bank Deposit Matching</p>
            </div>
        </div>
    </div>

    <!-- Comparison Modal -->
    <div id="comparisonModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Deposit Comparison</h2>
                <span class="close" onclick="closeModal('comparisonModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Deposit ID</label>
                            <p>DEP-2025-085</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Bank Reference</label>
                            <p>BNK-2025-001</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Bank</label>
                            <p>BDO</p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Account</label>
                            <p>****1234</p>
                        </div>
                    </div>
                </div>

                <h3 class="form-label">Deposit Comparison</h3>
                <div class="table-responsive">
                    <table class="comparison-table">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Bank Statement Data</th>
                                <th>System Record Data</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="match-exact">
                                <td>Amount</td>
                                <td>₱125,500.00</td>
                                <td>₱125,500.00</td>
                                <td>Exact Match</td>
                            </tr>
                            <tr class="match-exact">
                                <td>Date</td>
                                <td>2025-09-01</td>
                                <td>2025-09-01</td>
                                <td>Exact Match</td>
                            </tr>
                            <tr class="match-exact">
                                <td>Description</td>
                                <td>Gateway Settlement</td>
                                <td>PayPal Settlement</td>
                                <td>Exact Match</td>
                            </tr>
                            <tr class="match-exact">
                                <td>Reference</td>
                                <td>PYPL-SETTLEMENT-085</td>
                                <td>PYPL-SETTLEMENT-085</td>
                                <td>Exact Match</td>
                            </tr>
                            <tr class="match-exact">
                                <td>Bank Fees</td>
                                <td>₱250.00</td>
                                <td>₱250.00</td>
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
                        <p><strong>GL Posting:</strong> Cash Account #1010</p>
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

        // Bank selection
        function selectBank(bank) {
            // Remove selected class from all banks
            document.querySelectorAll('.bank-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked bank
            event.currentTarget.classList.add('selected');
            
            // Update upload area text
            const uploadText = document.querySelector('.upload-text');
            let bankName = '';
            switch(bank) {
                case 'bdo': bankName = 'BDO'; break;
                case 'bpi': bankName = 'BPI'; break;
                case 'metrobank': bankName = 'Metrobank'; break;
                case 'unionbank': bankName = 'UnionBank'; break;
            }
            uploadText.textContent = `Upload ${bankName} Statement File`;
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
                alert('Auto-matching completed! 245 deposits processed. 185 matched, 48 partial matches, 12 unmatched.');
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

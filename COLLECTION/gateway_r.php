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

        .status-dispute {
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

        /* Gateway Selector */
        .gateway-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .gateway-card {
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

        .gateway-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .gateway-card.selected {
            border: 2px solid var(--secondary);
        }

        .gateway-icon {
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

        .gateway-icon.paypal {
            background-color: #003087;
        }

        .gateway-icon.stripe {
            background-color: #6772e5;
        }

        .gateway-icon.gcash {
            background-color: #0033a0;
        }

        .gateway-icon.paymongo {
            background-color: #00a2ff;
        }

        .gateway-card h3 {
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

        .filter-select {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Lato', sans-serif;
            font-size: 1rem;
            background: white;
            min-width: 180px;
        }

        /* Settlement Status */
        .settlement-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .settlement-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: var(--transition);
        }

        .settlement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .settlement-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .settlement-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .settlement-amount {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .settlement-details {
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
            
            .gateway-selector {
                flex-direction: column;
            }
            
            .settlement-cards {
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

    /* Add improved styling for better organization */
    .tab-section {
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        overflow: hidden;
    }

    .tab-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        background: #f8f9fa;
    }

    .tab-content-wrapper {
        padding: 25px;
    }

    .data-grid {
        display: grid;
        gap: 20px;
        margin-bottom: 25px;
    }

    .grid-2 {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }

    .grid-4 {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }

    .stat-box {
        background: white;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid var(--secondary);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .stat-box.matched { border-left-color: var(--matched); }
    .stat-box.partial { border-left-color: var(--partial); }
    .stat-box.unmatched { border-left-color: var(--unmatched); }
    .stat-box.pending { border-left-color: var(--pending); }

    .action-toolbar {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 0;
        border-radius: 10px;
        width: 90%;
        max-width: 800px;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        padding: 20px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }

    .form-col {
        flex: 1;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: var(--dark);
    }

    /* Enhanced table styles */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .data-table th {
        background: #f8f9fa;
        padding: 12px 15px;
        text-align: left;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }

    .data-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
    }

    .data-table tr:hover {
        background-color: #f8f9fa;
    }

    /* Improved filter section */
    .filter-bar {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        min-width: 150px;
    }

    .filter-label {
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--dark);
    }

    /* Keep existing responsive design */
    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 10px;
        }
        
        .filter-bar {
            flex-direction: column;
        }
        
        .action-toolbar {
            flex-direction: column;
        }
        
        .data-grid {
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
            <h1 class="page-title">Gateway Reconciliation</h1>

            <!-- Dashboard Cards - Keep existing -->
            <div class="dashboard-cards">
                <div class="dashboard-card" onclick="switchTab('upload')">
                    <div class="card-icon blue">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <h3>Files to Process</h3>
                    <p>4</p>
                    <small>Gateway reports pending</small>
                </div>
                <div class="dashboard-card" onclick="switchTab('matching')">
                    <div class="card-icon green">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Matched</h3>
                    <p>142</p>
                    <small>Transactions this month</small>
                </div>
                <div class="dashboard-card" onclick="switchTab('discrepancy')">
                    <div class="card-icon orange">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3>Discrepancies</h3>
                    <p>18</p>
                    <small>Require attention</small>
                </div>
                <div class="dashboard-card" onclick="switchTab('settlement')">
                    <div class="card-icon purple">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3>Settlements</h3>
                    <p>₱425,750</p>
                    <small>Pending payout</small>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="tabs">
                <div class="tab active" data-tab="upload">Gateway Upload</div>
                <div class="tab" data-tab="matching">Transaction Matching</div>
                <div class="tab" data-tab="discrepancy">Discrepancy Report</div>
                <div class="tab" data-tab="settlement">Settlement Status</div>
            </div>

            <!-- Gateway Upload Tab -->
            <div class="tab-section">
                <div class="tab-header">
                    <h2 class="card-title">Upload Gateway Settlement Files</h2>
                </div>
                <div class="tab-content-wrapper">
                    <!-- Gateway Selection -->
                    <div class="gateway-selector">
                        <div class="gateway-card" onclick="selectGateway('gcash')">
                            <div class="gateway-icon gcash">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h3>GCash</h3>
                            <p>Upload CSV or API integration</p>
                        </div>
                        <div class="gateway-card" onclick="selectGateway('paymaya')">
                            <div class="gateway-icon paymaya" style="background-color: #00a2ff;">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <h3>PayMaya</h3>
                            <p>Upload CSV or API integration</p>
                        </div>
                        <div class="gateway-card" onclick="selectGateway('paypal')">
                            <div class="gateway-icon paypal">
                                <i class="fab fa-paypal"></i>
                            </div>
                            <h3>PayPal</h3>
                            <p>Upload CSV or API integration</p>
                        </div>
                    </div>

                    <!-- Upload Area -->
                    <div class="upload-area" id="uploadArea">
                        <div class="upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h3 class="upload-text">Drag & Drop Gateway Report Files</h3>
                        <p class="upload-subtext">Supported formats: CSV, XLSX (Max: 10MB)</p>
                        <button class="btn btn-primary" id="browseFiles">
                            <i class="fas fa-folder-open"></i> Browse Files
                        </button>
                        <input type="file" id="fileInput" style="display: none;" accept=".csv,.xlsx,.xls">
                    </div>

                    <!-- Filters -->
                    <div class="filter-bar">
                        <div class="filter-group">
                            <span class="filter-label">Date Range</span>
                            <input type="date" class="filter-select" id="uploadStartDate" value="2025-09-01">
                        </div>
                        <div class="filter-group">
                            <span class="filter-label">To</span>
                            <input type="date" class="filter-select" id="uploadEndDate" value="2025-09-09">
                        </div>
                        <div class="filter-group">
                            <span class="filter-label">Gateway</span>
                            <select class="filter-select" id="gatewayFilter">
                                <option value="">All Gateways</option>
                                <option value="gcash">GCash</option>
                                <option value="paymaya">PayMaya</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                        <div class="filter-group">
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

                    <!-- Recent Uploads Table -->
                    <h3 style="margin: 20px 0 15px;">Recent Uploads</h3>
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Filename</th>
                                    <th>Gateway</th>
                                    <th>Date Range</th>
                                    <th>Transactions</th>
                                    <th>Uploaded</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>gcash_settlement_2025-09-08.csv</td>
                                    <td>GCash</td>
                                    <td>Sep 1 - Sep 7, 2025</td>
                                    <td>56</td>
                                    <td>2025-09-08 14:30</td>
                                    <td><span class="status status-matched">Processed</span></td>
                                    <td>
                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>paymaya_payouts_2025-09-07.csv</td>
                                    <td>PayMaya</td>
                                    <td>Sep 1 - Sep 6, 2025</td>
                                    <td>42</td>
                                    <td>2025-09-07 11:15</td>
                                    <td><span class="status status-matched">Processed</span></td>
                                    <td>
                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-download btn-sm"><i class="fas fa-download"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>paypal_transactions_2025-09-09.csv</td>
                                    <td>PayPal</td>
                                    <td>Sep 1 - Sep 8, 2025</td>
                                    <td>38</td>
                                    <td>2025-09-09 09:45</td>
                                    <td><span class="status status-pending">Processing</span></td>
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

            <!-- Transaction Matching Tab -->
            <div class="tab-section" style="display: none;">
                <div class="tab-header">
                    <h2 class="card-title">Transaction Matching Dashboard</h2>
                    <div class="action-toolbar">
                        <button class="btn btn-primary" id="runMatching">
                            <i class="fas fa-cogs"></i> Run Auto-Match
                        </button>
                        <button class="btn btn-secondary">
                            <i class="fas fa-sync"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="tab-content-wrapper">
                    <!-- Statistics -->
                    <div class="data-grid grid-4">
                        <div class="stat-box matched">
                            <h3>158</h3>
                            <p>Total Transactions</p>
                        </div>
                        <div class="stat-box matched">
                            <h3>142</h3>
                            <p>Matched</p>
                        </div>
                        <div class="stat-box partial">
                            <h3>12</h3>
                            <p>Partial Match</p>
                        </div>
                        <div class="stat-box unmatched">
                            <h3>4</h3>
                            <p>Unmatched</p>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="filter-bar">
                        <div class="filter-group">
                            <span class="filter-label">Matching Status</span>
                            <select class="filter-select" id="matchingStatusFilter">
                                <option value="">All Status</option>
                                <option value="matched">Matched</option>
                                <option value="partial">Partial Match</option>
                                <option value="unmatched">Unmatched</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <span class="filter-label">Gateway</span>
                            <select class="filter-select" id="matchingGatewayFilter">
                                <option value="">All Gateways</option>
                                <option value="gcash">GCash</option>
                                <option value="paymaya">PayMaya</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <span class="filter-label">From Date</span>
                            <input type="date" class="filter-select" id="matchingStartDate" value="2025-09-01">
                        </div>
                        <div class="filter-group">
                            <span class="filter-label">To Date</span>
                            <input type="date" class="filter-select" id="matchingEndDate" value="2025-09-09">
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="matchingSearch" placeholder="Search Transaction ID, Order ID, or Customer...">
                        <button class="btn btn-primary">Search</button>
                    </div>

                    <!-- Transactions Table -->
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Gateway Txn ID</th>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Gateway Amount</th>
                                    <th>System Amount</th>
                                    <th>Date</th>
                                    <th>Gateway</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>GCASH-2025-001</td>
                                    <td>ORD-2025-085</td>
                                    <td>Maria Santos</td>
                                    <td>₱12,500.00</td>
                                    <td>₱12,500.00</td>
                                    <td>2025-09-01</td>
                                    <td>GCash</td>
                                    <td><span class="status status-matched">Matched</span></td>
                                    <td>
                                        <button class="btn btn-view btn-sm" onclick="openComparisonModal()">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PMYA-2025-002</td>
                                    <td>ORD-2025-086</td>
                                    <td>Juan Dela Cruz</td>
                                    <td>₱8,750.00</td>
                                    <td>₱8,750.00</td>
                                    <td>2025-09-02</td>
                                    <td>PayMaya</td>
                                    <td><span class="status status-matched">Matched</span></td>
                                    <td>
                                        <button class="btn btn-view btn-sm" onclick="openComparisonModal()">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PYPL-2025-003</td>
                                    <td>ORD-2025-087</td>
                                    <td>Ana Reyes</td>
                                    <td>₱5,200.00</td>
                                    <td>₱5,250.00</td>
                                    <td>2025-09-03</td>
                                    <td>PayPal</td>
                                    <td><span class="status status-partial">Partial</span></td>
                                    <td>
                                        <button class="btn btn-view btn-sm" onclick="openComparisonModal()">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-process btn-sm">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Discrepancy Report Tab -->
            <div class="tab-section" style="display: none;">
                <div class="tab-header">
                    <h2 class="card-title">Discrepancy Report</h2>
                    <div class="action-toolbar">
                        <button class="btn btn-download">
                            <i class="fas fa-download"></i> Export Report
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-cog"></i> Auto-Resolve
                        </button>
                    </div>
                </div>
                <div class="tab-content-wrapper">
                    <!-- Filters -->
                    <div class="filter-bar">
                        <div class="filter-group">
                            <span class="filter-label">Discrepancy Type</span>
                            <select class="filter-select" id="discrepancyTypeFilter">
                                <option value="">All Types</option>
                                <option value="unmatched">Unmatched</option>
                                <option value="partial">Partial Match</option>
                                <option value="duplicate">Duplicate</option>
                                <option value="failed">Failed Payment</option>
                                <option value="dispute">Dispute/Chargeback</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <span class="filter-label">Gateway</span>
                            <select class="filter-select" id="discrepancyGatewayFilter">
                                <option value="">All Gateways</option>
                                <option value="gcash">GCash</option>
                                <option value="paymaya">PayMaya</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <span class="filter-label">From Date</span>
                            <input type="date" class="filter-select" id="discrepancyStartDate" value="2025-09-01">
                        </div>
                        <div class="filter-group">
                            <span class="filter-label">To Date</span>
                            <input type="date" class="filter-select" id="discrepancyEndDate" value="2025-09-09">
                        </div>
                    </div>

                    <!-- Discrepancies Table -->
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Discrepancy ID</th>
                                    <th>Type</th>
                                    <th>Gateway Txn ID</th>
                                    <th>Order ID</th>
                                    <th>Gateway Amount</th>
                                    <th>System Amount</th>
                                    <th>Date</th>
                                    <th>Gateway</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>DISC-2025-001</td>
                                    <td>Unmatched</td>
                                    <td>GCASH-2025-005</td>
                                    <td>N/A</td>
                                    <td>₱4,500.00</td>
                                    <td>N/A</td>
                                    <td>2025-09-05</td>
                                    <td>GCash</td>
                                    <td><span class="status status-unmatched">Pending</span></td>
                                    <td>
                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>DISC-2025-002</td>
                                    <td>Partial Match</td>
                                    <td>PMYA-2025-003</td>
                                    <td>ORD-2025-087</td>
                                    <td>₱5,200.00</td>
                                    <td>₱5,250.00</td>
                                    <td>2025-09-03</td>
                                    <td>PayMaya</td>
                                    <td><span class="status status-partial">Pending</span></td>
                                    <td>
                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-process btn-sm"><i class="fas fa-cog"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Settlement Status Tab -->
            <div class="tab-section" style="display: none;">
                <div class="tab-header">
                    <h2 class="card-title">Settlement Status</h2>
                    <div class="action-toolbar">
                        <button class="btn btn-download">
                            <i class="fas fa-download"></i> Export
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-sync"></i> Refresh Status
                        </button>
                    </div>
                </div>
                <div class="tab-content-wrapper">
                    <!-- Settlement Cards -->
                    <div class="data-grid grid-3">
                        <div class="settlement-card">
                            <div class="settlement-header">
                                <div class="settlement-title">GCash</div>
                                <i class="fas fa-mobile-alt" style="color: #0033a0;"></i>
                            </div>
                            <div class="settlement-amount">₱156,300.00</div>
                            <div class="settlement-details">
                                <p>Pending Payout: ₱156,300.00</p>
                                <p>Next Settlement: 2025-09-09</p>
                                <p>Status: <span style="color: #f39c12;">Delayed</span></p>
                            </div>
                        </div>
                        
                        <div class="settlement-card">
                            <div class="settlement-header">
                                <div class="settlement-title">PayMaya</div>
                                <i class="fas fa-credit-card" style="color: #00a2ff;"></i>
                            </div>
                            <div class="settlement-amount">₱98,750.00</div>
                            <div class="settlement-details">
                                <p>Pending Payout: ₱98,750.00</p>
                                <p>Next Settlement: 2025-09-11</p>
                                <p>Status: <span style="color: #27ae60;">On Track</span></p>
                            </div>
                        </div>
                        
                        <div class="settlement-card">
                            <div class="settlement-header">
                                <div class="settlement-title">PayPal</div>
                                <i class="fab fa-paypal" style="color: #003087;"></i>
                            </div>
                            <div class="settlement-amount">₱125,500.00</div>
                            <div class="settlement-details">
                                <p>Pending Payout: ₱125,500.00</p>
                                <p>Next Settlement: 2025-09-10</p>
                                <p>Status: <span style="color: #27ae60;">On Track</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Settlement Timeline -->
                    <h3 style="margin: 30px 0 15px;">Settlement Timeline</h3>
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Settlement ID</th>
                                    <th>Gateway</th>
                                    <th>Period</th>
                                    <th>Total Amount</th>
                                    <th>Fees</th>
                                    <th>Net Amount</th>
                                    <th>Expected Date</th>
                                    <th>Actual Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SET-2025-001</td>
                                    <td>GCash</td>
                                    <td>Aug 25 - Aug 31</td>
                                    <td>₱142,500.00</td>
                                    <td>₱4,275.00</td>
                                    <td>₱138,225.00</td>
                                    <td>2025-09-03</td>
                                    <td>2025-09-03</td>
                                    <td><span class="status status-matched">Completed</span></td>
                                    <td>
                                        <button class="btn btn-view btn-sm"><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SET-2025-002</td>
                                    <td>PayMaya</td>
                                    <td>Aug 26 - Sep 1</td>
                                    <td>₱98,750.00</td>
                                    <td>₱2,962.50</td>
                                    <td>₱95,787.50</td>
                                    <td>2025-09-04</td>
                                    <td>2025-09-04</td>
                                    <td><span class="status status-matched">Completed</span></td>
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

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2025 Financial System - Gateway Reconciliation</p>
        </div>
    </div>
</div>

<!-- Comparison Modal -->
<div id="comparisonModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Transaction Comparison</h2>
            <span class="close" onclick="closeModal('comparisonModal')">&times;</span>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Gateway Transaction ID</label>
                        <p>GCASH-2025-001</p>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Order ID</label>
                        <p>ORD-2025-085</p>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Customer</label>
                        <p>Maria Santos</p>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Gateway</label>
                        <p>GCash</p>
                    </div>
                </div>
            </div>

            <h3 class="form-label">Transaction Comparison</h3>
            <div class="table-responsive">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Gateway Data</th>
                            <th>System Data</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="match-exact">
                            <td>Transaction ID</td>
                            <td>GCASH-2025-001</td>
                            <td>GCASH-2025-001</td>
                            <td>Exact Match</td>
                        </tr>
                        <tr class="match-exact">
                            <td>Order ID</td>
                            <td>ORD-2025-085</td>
                            <td>ORD-2025-085</td>
                            <td>Exact Match</td>
                        </tr>
                        <tr class="match-exact">
                            <td>Amount</td>
                            <td>₱12,500.00</td>
                            <td>₱12,500.00</td>
                            <td>Exact Match</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <label class="form-label">Matching Summary</label>
                <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                    <p><strong>Status:</strong> <span class="status status-matched">Fully Matched</span></p>
                    <p><strong>Confidence Score:</strong> 100%</p>
                    <p><strong>Auto-matched:</strong> Yes</p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('comparisonModal')">Close</button>
            <button type="button" class="btn btn-primary">Post to GL</button>
        </div>
    </div>
</div>

<script src="../PANEL/ASSETS/js/script-p.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Enhanced Tab Functionality
    function initializeTabs() {
        const tabs = document.querySelectorAll('.tab');
        const tabSections = document.querySelectorAll('.tab-section');
        
        // Show first tab by default
        if (tabSections.length > 0) {
            tabSections[0].style.display = 'block';
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Hide all tab sections
                tabSections.forEach(section => {
                    section.style.display = 'none';
                });
                
                // Show the selected tab section
                const tabId = this.getAttribute('data-tab');
                const targetSection = document.querySelector(`.tab-section:nth-child(${Array.from(tabs).indexOf(this) + 4})`);
                if (targetSection) {
                    targetSection.style.display = 'block';
                }
            });
        });
    }

    // Switch tab function for dashboard cards
    function switchTab(tabName) {
        const tabs = document.querySelectorAll('.tab');
        const tabSections = document.querySelectorAll('.tab-section');
        
        tabs.forEach(t => t.classList.remove('active'));
        document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
        
        tabSections.forEach(section => {
            section.style.display = 'none';
        });
        
        const targetIndex = Array.from(tabs).findIndex(tab => tab.getAttribute('data-tab') === tabName);
        if (targetIndex !== -1 && tabSections[targetIndex]) {
            tabSections[targetIndex].style.display = 'block';
        }
    }

    // Gateway selection
    function selectGateway(gateway) {
        // Remove selected class from all gateways
        document.querySelectorAll('.gateway-card').forEach(card => {
            card.classList.remove('selected');
        });
        
        // Add selected class to clicked gateway
        event.currentTarget.classList.add('selected');
        
        // Update upload area text
        const uploadText = document.querySelector('.upload-text');
        const gatewayName = gateway.charAt(0).toUpperCase() + gateway.slice(1);
        uploadText.textContent = `Upload ${gatewayName} Settlement File`;
    }

    // File upload functionality
    document.addEventListener('DOMContentLoaded', function() {
        initializeTabs();
        
        document.getElementById('browseFiles').addEventListener('click', function() {
            document.getElementById('fileInput').click();
        });

        document.getElementById('fileInput').addEventListener('change', function() {
            if (this.files.length > 0) {
                const fileName = this.files[0].name;
                showNotification(`File "${fileName}" selected for upload.`, 'success');
            }
        });

        // Drag and drop functionality
        const uploadArea = document.getElementById('uploadArea');
        if (uploadArea) {
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
                    showNotification(`File "${fileName}" dropped for upload.`, 'success');
                }
            });
        }

        // Run auto-matching functionality
        const runMatchingBtn = document.getElementById('runMatching');
        if (runMatchingBtn) {
            runMatchingBtn.addEventListener('click', function() {
                const icon = this.querySelector('i');
                icon.classList.add('fa-spin');
                
                setTimeout(() => {
                    icon.classList.remove('fa-spin');
                    showNotification('Auto-matching completed! 158 transactions processed.', 'success');
                }, 2000);
            });
        }

        // Filter functionality
        initializeFilters();
    });

    // Modal functionality
    function openComparisonModal() {
        document.getElementById('comparisonModal').style.display = 'block';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Notification system
    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background: ${type === 'success' ? '#2ecc71' : '#3498db'};
            color: white;
            border-radius: 5px;
            z-index: 10000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            animation: slideIn 0.3s ease;
        `;
        
        notification.textContent = message;
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Initialize filters
    function initializeFilters() {
        const filters = document.querySelectorAll('.filter-select');
        filters.forEach(filter => {
            filter.addEventListener('change', function() {
                // Simulate filtering
                showNotification(`Filter applied: ${this.value}`, 'info');
            });
        });
    }

    // Add CSS for notifications
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
</script>
</body>
</html>
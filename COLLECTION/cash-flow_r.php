<?php
session_start();
include "../PANEL/panel.php";
?>

<link rel="stylesheet" href="../COLLECTION/ASSETS/css/style.css">
<!-- DASHBOARD MAIN CONTENT -->
<div class="home-section">
  <div class="text">Dashboard</div>
    <!-- Summary Cards -->
      <div class="summary-cards">
        <div class="card">
          <div class="card-title">Total Expected Inflow</div>
          <div class="card-value">₱24,420,000.00</div>
          <div class="card-footer">From all sources</div>
        </div>
        <div class="card">
          <div class="card-title">Total Actual Inflow</div>
          <div class="card-value">₱23,850,500.00</div>
          <div class="card-footer">As of today</div>
        </div>
        <div class="card">
          <div class="card-title">Variance</div>
          <div class="card-value">-₱569,500.00</div>
          <div class="card-footer">
            <span class="variance-negative">-2.33%</span>
          </div>
        </div>
        <div class="card">
          <div class="card-title">Forecast Amount</div>
          <div class="card-value">₱25,100,000.00</div>
          <div class="card-footer">Next period projection</div>
        </div>
      </div>

      <!-- Cash Flow Actions -->
      <div class="cashflow-actions">
        <button id="generateReportBtn" class="btn btn-primary">
          <i class="fa fa-sync"></i> Generate Report
        </button>
        <button id="exportReportBtn" class="btn btn-success">
          <i class="fa fa-file-export"></i> Export Report
        </button>
        <button id="forecastBtn" class="btn btn-warning">
          <i class="fa fa-chart-line"></i> Forecast
        </button>
        <button id="approvalBtn" class="btn btn-info">
          <i class="fa fa-check-circle"></i> Approval Workflow
        </button>
      </div>

      <!-- Tabs -->
      <div class="tabs">
        <div class="tab active" data-tab="cashflow">Cash Flow</div>
        <div class="tab" data-tab="payments">Payments</div>
        <div class="tab" data-tab="gateways">Gateway Settlements</div>
        <div class="tab" data-tab="cod">COD Collections</div>
        <div class="tab" data-tab="deposits">Bank Deposits</div>
        <div class="tab" data-tab="refunds">Refunds</div>
        <div class="tab" data-tab="approvals">Roles & Approvals</div>
      </div>

      <!-- Tab Content -->
      <div class="tab-content active" id="cashflow-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Cash Flow Reports</h4>
                </div>
                <div class="card-body">
                  <!-- Filter Section -->
                  <div class="filter-section mb-4">
                    <div class="row">
                      <div class="col">
                        <label for="filterSource">Inflow Source</label>
                        <select id="filterSource" class="form-control">
                          <option value="">All Sources</option>
                          <option value="gateway">Gateway</option>
                          <option value="cod">COD</option>
                          <option value="wallet">Wallet</option>
                          <option value="refund offset">Refund Offset</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="filterReportDate">Report Date</label>
                        <input type="date" id="filterReportDate" class="form-control">
                      </div>
                      <div class="col">
                        <label>&nbsp;</label>
                        <button id="applyCashFlowFilters" class="btn btn-success form-control">
                          <i class="fa fa-filter"></i> Apply Filters
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Cash Flow Chart -->
                  <div class="chart-container">
                    <canvas id="cashFlowChart"></canvas>
                  </div>

                  <!-- Cash Flow Table -->
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="cashFlowTable">
                      <thead>
                        <tr>
                          <th>Report ID</th>
                          <th>Report Date</th>
                          <th>Inflow Source</th>
                          <th>Expected Inflow</th>
                          <th>Actual Inflow</th>
                          <th>Variance</th>
                          <th>Forecast Amount</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Data will be populated by JavaScript -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-content" id="payments-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Payments (Expected Inflows)</h4>
                </div>
                <div class="card-body">
                  <!-- Filter Section -->
                  <div class="filter-section mb-4">
                    <div class="row">
                      <div class="col">
                        <label for="filterPaymentMethod">Payment Method</label>
                        <select id="filterPaymentMethod" class="form-control">
                          <option value="">All Methods</option>
                          <option value="gateway">Gateway</option>
                          <option value="cod">COD</option>
                          <option value="wallet">Wallet</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="filterPaymentStatus">Status</label>
                        <select id="filterPaymentStatus" class="form-control">
                          <option value="">All Statuses</option>
                          <option value="pending">Pending</option>
                          <option value="received">Received</option>
                          <option value="unsettled">Unsettled</option>
                          <option value="refunded">Refunded</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="filterPaymentDate">Date Range</label>
                        <input type="date" id="filterPaymentDate" class="form-control">
                      </div>
                      <div class="col">
                        <label>&nbsp;</label>
                        <button id="applyPaymentFilters" class="btn btn-success form-control">
                          <i class="fa fa-filter"></i> Apply Filters
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Payments Table -->
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="paymentsTable">
                      <thead>
                        <tr>
                          <th>Payment ID</th>
                          <th>Customer ID</th>
                          <th>Order ID</th>
                          <th>Payment Method</th>
                          <th>Amount</th>
                          <th>Status</th>
                          <th>Created At</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Data will be populated by JavaScript -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-content" id="gateways-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Gateway Settlements</h4>
                </div>
                <div class="card-body">
                  <!-- Filter Section -->
                  <div class="filter-section mb-4">
                    <div class="row">
                      <div class="col">
                        <label for="filterGateway">Gateway</label>
                        <select id="filterGateway" class="form-control">
                          <option value="">All Gateways</option>
                          <option value="PayPal">PayPal</option>
                          <option value="Stripe">Stripe</option>
                          <option value="GCash">GCash</option>
                          <option value="PayMaya">PayMaya</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="filterSettlementStatus">Status</label>
                        <select id="filterSettlementStatus" class="form-control">
                          <option value="">All Statuses</option>
                          <option value="matched">Matched</option>
                          <option value="failed">Failed</option>
                          <option value="pending">Pending</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="filterSettlementDate">Date Range</label>
                        <input type="date" id="filterSettlementDate" class="form-control">
                      </div>
                      <div class="col">
                        <label>&nbsp;</label>
                        <button id="applySettlementFilters" class="btn btn-success form-control">
                          <i class="fa fa-filter"></i> Apply Filters
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Settlements Table -->
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="settlementsTable">
                      <thead>
                        <tr>
                          <th>Settlement ID</th>
                          <th>Gateway Name</th>
                          <th>Transaction Ref</th>
                          <th>Expected Amount</th>
                          <th>Received Amount</th>
                          <th>Settlement Date</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Data will be populated by JavaScript -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-content" id="cod-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>COD Collections</h4>
                </div>
                <div class="card-body">
                  <!-- Filter Section -->
                  <div class="filter-section mb-4">
                    <div class="row">
                      <div class="col">
                        <label for="filterPartner">Partner</label>
                        <select id="filterPartner" class="form-control">
                          <option value="">All Partners</option>
                          <option value="LBC">LBC</option>
                          <option value="JRS">JRS</option>
                          <option value="APC">APC</option>
                          <option value="NinjaVan">NinjaVan</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="filterCollectionStatus">Status</label>
                        <select id="filterCollectionStatus" class="form-control">
                          <option value="">All Statuses</option>
                          <option value="pending">Pending</option>
                          <option value="received">Received</option>
                          <option value="short">Short</option>
                          <option value="delayed">Delayed</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="filterCollectionDate">Date Range</label>
                        <input type="date" id="filterCollectionDate" class="form-control">
                      </div>
                      <div class="col">
                        <label>&nbsp;</label>
                        <button id="applyCollectionFilters" class="btn btn-success form-control">
                          <i class="fa fa-filter"></i> Apply Filters
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Collections Table -->
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="collectionsTable">
                      <thead>
                        <tr>
                          <th>COD ID</th>
                          <th>Partner ID</th>
                          <th>Delivery Batch No</th>
                          <th>Expected Amount</th>
                          <th>Deposited Amount</th>
                          <th>Deposit Date</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Data will be populated by JavaScript -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-content" id="deposits-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Bank Deposits (Actual Inflows)</h4>
                </div>
                <div class="card-body">
                  <!-- Filter Section -->
                  <div class="filter-section mb-4">
                    <div class="row">
                      <div class="col">
                        <label for="filterBank">Bank</label>
                        <select id="filterBank" class="form-control">
                          <option value="">All Banks</option>
                          <option value="BDO">BDO</option>
                          <option value="BPI">BPI</option>
                          <option value="Metrobank">Metrobank</option>
                          <option value="Chinabank">Chinabank</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="filterDepositStatus">Status</label>
                        <select id="filterDepositStatus" class="form-control">
                          <option value="">All Statuses</option>
                          <option value="matched">Matched</option>
                          <option value="unmatched">Unmatched</option>
                          <option value="pending">Pending</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="filterDepositDate">Date Range</label>
                        <input type="date" id="filterDepositDate" class="form-control">
                      </div>
                      <div class="col">
                        <label>&nbsp;</label>
                        <button id="applyDepositFilters" class="btn btn-success form-control">
                          <i class="fa fa-filter"></i> Apply Filters
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Deposits Table -->
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="depositsTable">
                      <thead>
                        <tr>
                          <th>Deposit ID</th>
                          <th>Bank Name</th>
                          <th>Reference No</th>
                          <th>Amount</th>
                          <th>Deposit Date</th>
                          <th>Source Type</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Data will be populated by JavaScript -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-content" id="refunds-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Refunds (Deductions)</h4>
                </div>
                <div class="card-body">
                  <!-- Filter Section -->
                  <div class="filter-section mb-4">
                    <div class="row">
                      <div class="col">
                        <label for="filterRefundStatus">Status</label>
                        <select id="filterRefundStatus" class="form-control">
                          <option value="">All Statuses</option>
                          <option value="processed">Processed</option>
                          <option value="pending">Pending</option>
                          <option value="error">Error</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="filterRefundDate">Date Range</label>
                        <input type="date" id="filterRefundDate" class="form-control">
                      </div>
                      <div class="col">
                        <label>&nbsp;</label>
                        <button id="applyRefundFilters" class="btn btn-success form-control">
                          <i class="fa fa-filter"></i> Apply Filters
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Refunds Table -->
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="refundsTable">
                      <thead>
                        <tr>
                          <th>Refund ID</th>
                          <th>Payment ID</th>
                          <th>Order ID</th>
                          <th>Refund Amount</th>
                          <th>Refund Date</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Data will be populated by JavaScript -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-content" id="approvals-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="approval-section">
                <h3>Roles & Approval Management</h3>
                
                <div class="filter-section mb-4">
                  <div class="row">
                    <div class="col">
                      <label for="filterRole">Role</label>
                      <select id="filterRole" class="form-control">
                        <option value="">All Roles</option>
                        <option value="CFO">CFO</option>
                        <option value="Treasury Analyst">Treasury Analyst</option>
                        <option value="Financial Director">Financial Director</option>
                        <option value="Expense Auditor">Expense Auditor</option>
                      </select>
                    </div>
                    <div class="col">
                      <label for="filterApprovalDate">Date Range</label>
                      <input type="date" id="filterApprovalDate" class="form-control">
                    </div>
                    <div class="col">
                      <label>&nbsp;</label>
                      <button id="applyApprovalFilters" class="btn btn-success form-control">
                        <i class="fa fa-filter"></i> Apply Filters
                      </button>
                    </div>
                    <div class="col">
                      <label>&nbsp;</label>
                      <button id="addRoleBtn" class="btn btn-primary form-control">
                        <i class="fa fa-plus"></i> Add Role
                      </button>
                    </div>
                  </div>
                </div>
                
                <div class="table-responsive">
                  <table class="approval-table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Role ID</th>
                        <th>Role Name</th>
                        <th>User ID</th>
                        <th>Approval Rights</th>
                        <th>Last Action Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody id="approvalsTableBody">
                      <!-- Data will be populated by JavaScript -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Role Modal -->
    <div id="addRoleModal" class="modal-overlay">
      <div class="modal-box">
        <h3>Add Role & Approval</h3>
        <form id="addRoleForm">
          <div class="form-group mb-3">
            <label for="roleName">Role Name</label>
            <select class="form-control" id="roleName" required>
              <option value="">Select Role</option>
              <option value="CFO">CFO</option>
              <option value="Treasury Analyst">Treasury Analyst</option>
              <option value="Financial Director">Financial Director</option>
              <option value="Expense Auditor">Expense Auditor</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="userId">User ID</label>
            <input type="text" class="form-control" id="userId" required placeholder="Enter User ID">
          </div>
          <div class="form-group mb-3">
            <label for="approvalRights">Approval Rights</label>
            <select class="form-control" id="approvalRights" required>
              <option value="">Select Rights</option>
              <option value="view">View Only</option>
              <option value="approve">Approve</option>
              <option value="edit">Edit & Approve</option>
            </select>
          </div>
          <div class="modal-actions">
            <button type="submit" class="btn-yes">
              <i class="fas fa-plus"></i> Add Role
            </button>
            <button type="button" id="cancelAddRole" class="btn-no">
              <i class="fas fa-times"></i> Cancel
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal-overlay">
      <div class="modal-box">
        <h3>Confirm Delete</h3>
        <p>Are you sure you want to delete this role?</p>
        <div class="modal-actions">
          <button id="confirmDelete" class="btn-yes">
            <i class="fas fa-trash"></i> Delete
          </button>
          <button id="cancelDelete" class="btn-no">
            <i class="fas fa-times"></i> Cancel
          </button>
        </div>
      </div>
    </div>

</div>

<script src="../PANEL/ASSETS/js/script-p.js"></script>
<!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      // Sample data for cash flow reports
      let cashFlowReports = [
        {
          report_id: 801,
          report_date: "2025-08-31",
          inflow_source: "gateway",
          expected_inflow: 12500000.00,
          actual_inflow: 12250000.00,
          variance: -250000.00,
          forecast_amount: 12750000.00
        },
        {
          report_id: 802,
          report_date: "2025-08-31",
          inflow_source: "cod",
          expected_inflow: 8500000.00,
          actual_inflow: 8320000.00,
          variance: -180000.00,
          forecast_amount: 8650000.00
        },
        {
          report_id: 803,
          report_date: "2025-08-31",
          inflow_source: "wallet",
          expected_inflow: 2200000.00,
          actual_inflow: 2180000.00,
          variance: -20000.00,
          forecast_amount: 2250000.00
        },
        {
          report_id: 804,
          report_date: "2025-08-31",
          inflow_source: "refund offset",
          expected_inflow: 1200000.00,
          actual_inflow: 1000500.00,
          variance: -199500.00,
          forecast_amount: 1150000.00
        }
      ];

      // Sample data for payments (reusing from previous systems)
      let payments = [
        {
          payment_id: 1001,
          customer_id: 20015,
          order_id: 50123,
          payment_method: "gateway",
          amount: 2500.00,
          status: "received",
          created_at: "2025-08-15"
        },
        {
          payment_id: 1002,
          customer_id: 20032,
          order_id: 50245,
          payment_method: "gateway",
          amount: 5200.50,
          status: "received",
          created_at: "2025-08-22"
        },
        {
          payment_id: 1003,
          customer_id: 20045,
          order_id: 50312,
          payment_method: "gateway",
          amount: 1850.75,
          status: "unsettled",
          created_at: "2025-08-30"
        },
        {
          payment_id: 1004,
          customer_id: 20067,
          order_id: 50456,
          payment_method: "cod",
          amount: 3200.00,
          status: "pending",
          created_at: "2025-09-01"
        },
        {
          payment_id: 1005,
          customer_id: 20089,
          order_id: 50567,
          payment_method: "gateway",
          amount: 1750.25,
          status: "received",
          created_at: "2025-09-02"
        }
      ];

      // Sample data for gateway settlements (reusing from previous systems)
      let settlements = [
        {
          settlement_id: 501,
          gateway_name: "PayPal",
          transaction_ref: "PP-20250815-001",
          expected_amount: 2500.00,
          received_amount: 2500.00,
          settlement_date: "2025-08-16",
          status: "matched"
        },
        {
          settlement_id: 502,
          gateway_name: "Stripe",
          transaction_ref: "ST-20250822-001",
          expected_amount: 5200.50,
          received_amount: 5200.50,
          settlement_date: "2025-08-23",
          status: "matched"
        },
        {
          settlement_id: 503,
          gateway_name: "GCash",
          transaction_ref: "GC-20250830-001",
          expected_amount: 1850.75,
          received_amount: 1800.00,
          settlement_date: "2025-08-31",
          status: "failed"
        },
        {
          settlement_id: 504,
          gateway_name: "PayMaya",
          transaction_ref: "PM-20250901-001",
          expected_amount: 3200.00,
          received_amount: 3200.00,
          settlement_date: "2025-09-02",
          status: "pending"
        }
      ];

      // Sample data for COD collections (reusing from previous systems)
      let collections = [
        {
          cod_id: 301,
          partner_id: "LBC",
          delivery_batch_no: "LBC-20250815-001",
          expected_amount: 2500.00,
          deposited_amount: 2500.00,
          deposit_date: "2025-08-16",
          status: "received"
        },
        {
          cod_id: 302,
          partner_id: "JRS",
          delivery_batch_no: "JRS-20250822-001",
          expected_amount: 5200.50,
          deposited_amount: 5200.50,
          deposit_date: "2025-08-23",
          status: "received"
        },
        {
          cod_id: 303,
          partner_id: "APC",
          delivery_batch_no: "APC-20250830-001",
          expected_amount: 1850.75,
          deposited_amount: 1800.00,
          deposit_date: "2025-08-31",
          status: "short"
        },
        {
          cod_id: 304,
          partner_id: "NinjaVan",
          delivery_batch_no: "NV-20250901-001",
          expected_amount: 3200.00,
          deposited_amount: 3200.00,
          deposit_date: "2025-09-03",
          status: "delayed"
        }
      ];

      // Sample data for bank deposits (reusing from previous systems)
      let deposits = [
        {
          deposit_id: 801,
          bank_name: "BDO",
          reference_no: "BDO-20250816-001",
          amount: 2500.00,
          deposit_date: "2025-08-16",
          source_type: "gateway",
          status: "matched"
        },
        {
          deposit_id: 802,
          bank_name: "BPI",
          reference_no: "BPI-20250823-001",
          amount: 5200.50,
          deposit_date: "2025-08-23",
          source_type: "gateway",
          status: "matched"
        },
        {
          deposit_id: 803,
          bank_name: "Metrobank",
          reference_no: "MB-20250831-001",
          amount: 1800.00,
          deposit_date: "2025-08-31",
          source_type: "gateway",
          status: "unmatched"
        },
        {
          deposit_id: 804,
          bank_name: "Chinabank",
          reference_no: "CB-20250902-001",
          amount: 3200.00,
          deposit_date: "2025-09-02",
          source_type: "cod",
          status: "pending"
        }
      ];

      // Sample data for refunds (reusing from previous systems)
      let refunds = [
        {
          refund_id: 601,
          payment_id: 1001,
          order_id: 50123,
          refund_amount: 2500.00,
          refund_date: "2025-08-16",
          status: "processed"
        },
        {
          refund_id: 602,
          payment_id: 1002,
          order_id: 50245,
          refund_amount: 5200.50,
          refund_date: "2025-08-23",
          status: "processed"
        },
        {
          refund_id: 603,
          payment_id: 1003,
          order_id: 50312,
          refund_amount: 1800.00,
          refund_date: "2025-08-31",
          status: "pending"
        },
        {
          refund_id: 604,
          payment_id: 1004,
          order_id: 50456,
          refund_amount: 3200.00,
          refund_date: "2025-09-02",
          status: "error"
        }
      ];

      // Sample data for roles and approvals
      let rolesApprovals = [
        {
          role_id: 1,
          role_name: "CFO",
          user_id: "U5001",
          approval_rights: "edit",
          last_action_date: "2025-09-01"
        },
        {
          role_id: 2,
          role_name: "Treasury Analyst",
          user_id: "U5002",
          approval_rights: "approve",
          last_action_date: "2025-08-30"
        },
        {
          role_id: 3,
          role_name: "Financial Director",
          user_id: "U5003",
          approval_rights: "view",
          last_action_date: "2025-08-28"
        },
        {
          role_id: 4,
          role_name: "Expense Auditor",
          user_id: "U5004",
          approval_rights: "edit",
          last_action_date: "2025-08-25"
        }
      ];

      // DOM Elements
      const cashFlowTable = document.getElementById("cashFlowTable");
      const paymentsTable = document.getElementById("paymentsTable");
      const settlementsTable = document.getElementById("settlementsTable");
      const collectionsTable = document.getElementById("collectionsTable");
      const depositsTable = document.getElementById("depositsTable");
      const refundsTable = document.getElementById("refundsTable");
      const approvalsTableBody = document.getElementById("approvalsTableBody");
      const addRoleModal = document.getElementById("addRoleModal");
      const deleteModal = document.getElementById("deleteModal");
      const addRoleForm = document.getElementById("addRoleForm");
      const cancelAddRole = document.getElementById("cancelAddRole");
      const cancelDelete = document.getElementById("cancelDelete");
      
      // Current item being edited
      let currentRoleId = null;
      
      // Chart instance
      let cashFlowChart = null;

      // Tab functionality
      document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', () => {
          // Remove active class from all tabs and content
          document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
          document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
          
          // Add active class to clicked tab
          tab.classList.add('active');
          
          // Show corresponding content
          const tabName = tab.getAttribute('data-tab');
          document.getElementById(`${tabName}-tab`).classList.add('active');
        });
      });

      // Initialize the page
      document.addEventListener("DOMContentLoaded", function () {
        renderCashFlowReports(cashFlowReports);
        renderPayments(payments);
        renderSettlements(settlements);
        renderCollections(collections);
        renderDeposits(deposits);
        renderRefunds(refunds);
        renderApprovals(rolesApprovals);
        initializeChart(cashFlowReports);
      });

      // Initialize chart
      function initializeChart(cashFlowData) {
        const ctx = document.getElementById('cashFlowChart').getContext('2d');
        
        // Prepare data for chart
        const labels = cashFlowData.map(item => formatInflowSource(item.inflow_source));
        const expected = cashFlowData.map(item => item.expected_inflow);
        const actual = cashFlowData.map(item => item.actual_inflow);
        const forecast = cashFlowData.map(item => item.forecast_amount);
        
        cashFlowChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [
              {
                label: 'Expected Inflow',
                data: expected,
                backgroundColor: '#000a64',
                borderColor: '#000a64',
                borderWidth: 1
              },
              {
                label: 'Actual Inflow',
                data: actual,
                backgroundColor: '#2a9d8f',
                borderColor: '#2a9d8f',
                borderWidth: 1
              },
              {
                label: 'Forecast Amount',
                data: forecast,
                backgroundColor: '#f4a261',
                borderColor: '#f4a261',
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
                ticks: {
                  callback: function(value) {
                    return '₱' + value.toLocaleString();
                  }
                }
              }
            }
          }
        });
      }

      // Render cash flow reports in the table
      function renderCashFlowReports(cashFlowData) {
        const tbody = cashFlowTable.querySelector("tbody");
        tbody.innerHTML = "";

        if (cashFlowData.length === 0) {
          tbody.innerHTML = '<tr><td colspan="8" class="text-center">No cash flow reports found</td></tr>';
          return;
        }

        cashFlowData.forEach(report => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${report.report_id}</td>
            <td>${report.report_date}</td>
            <td>${formatInflowSource(report.inflow_source)}</td>
            <td>₱${formatNumber(report.expected_inflow)}</td>
            <td>₱${formatNumber(report.actual_inflow)}</td>
            <td>${formatVariance(report.variance)}</td>
            <td>₱${formatNumber(report.forecast_amount)}</td>
            <td>
              <div class="approval-actions">
                <button class="btn btn-sm btn-primary view-btn" data-type="cashflow" data-id="${report.report_id}">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </td>
          `;
          tbody.appendChild(row);
        });
        
        // Add event listeners to view buttons
        document.querySelectorAll('.view-btn[data-type="cashflow"]').forEach(btn => {
          btn.addEventListener("click", () => viewCashFlowDetails(btn.dataset.id));
        });
      }

      // Render payments in the table
      function renderPayments(paymentsData) {
        const tbody = paymentsTable.querySelector("tbody");
        tbody.innerHTML = "";

        if (paymentsData.length === 0) {
          tbody.innerHTML = '<tr><td colspan="8" class="text-center">No payments found</td></tr>';
          return;
        }

        paymentsData.forEach(payment => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${payment.payment_id}</td>
            <td>${payment.customer_id}</td>
            <td>${payment.order_id}</td>
            <td>${formatPaymentMethod(payment.payment_method)}</td>
            <td>₱${formatNumber(payment.amount)}</td>
            <td>${formatPaymentStatus(payment.status)}</td>
            <td>${payment.created_at}</td>
            <td>
              <div class="approval-actions">
                <button class="btn btn-sm btn-primary view-btn" data-type="payment" data-id="${payment.payment_id}">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </td>
          `;
          tbody.appendChild(row);
        });
        
        // Add event listeners to view buttons
        document.querySelectorAll('.view-btn[data-type="payment"]').forEach(btn => {
          btn.addEventListener("click", () => viewPaymentDetails(btn.dataset.id));
        });
      }

      // Render settlements in the table
      function renderSettlements(settlementsData) {
        const tbody = settlementsTable.querySelector("tbody");
        tbody.innerHTML = "";

        if (settlementsData.length === 0) {
          tbody.innerHTML = '<tr><td colspan="8" class="text-center">No settlements found</td></tr>';
          return;
        }

        settlementsData.forEach(settlement => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${settlement.settlement_id}</td>
            <td>${settlement.gateway_name}</td>
            <td>${settlement.transaction_ref}</td>
            <td>₱${formatNumber(settlement.expected_amount)}</td>
            <td>₱${formatNumber(settlement.received_amount)}</td>
            <td>${settlement.settlement_date}</td>
            <td>${formatSettlementStatus(settlement.status)}</td>
            <td>
              <div class="approval-actions">
                <button class="btn btn-sm btn-primary view-btn" data-type="settlement" data-id="${settlement.settlement_id}">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </td>
          `;
          tbody.appendChild(row);
        });
        
        // Add event listeners to view buttons
        document.querySelectorAll('.view-btn[data-type="settlement"]').forEach(btn => {
          btn.addEventListener("click", () => viewSettlementDetails(btn.dataset.id));
        });
      }

      // Render collections in the table
      function renderCollections(collectionsData) {
        const tbody = collectionsTable.querySelector("tbody");
        tbody.innerHTML = "";

        if (collectionsData.length === 0) {
          tbody.innerHTML = '<tr><td colspan="8" class="text-center">No collections found</td></tr>';
          return;
        }

        collectionsData.forEach(collection => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${collection.cod_id}</td>
            <td>${collection.partner_id}</td>
            <td>${collection.delivery_batch_no}</td>
            <td>₱${formatNumber(collection.expected_amount)}</td>
            <td>₱${formatNumber(collection.deposited_amount)}</td>
            <td>${collection.deposit_date}</td>
            <td>${formatCollectionStatus(collection.status)}</td>
            <td>
              <div class="approval-actions">
                <button class="btn btn-sm btn-primary view-btn" data-type="collection" data-id="${collection.cod_id}">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </td>
          `;
          tbody.appendChild(row);
        });
        
        // Add event listeners to view buttons
        document.querySelectorAll('.view-btn[data-type="collection"]').forEach(btn => {
          btn.addEventListener("click", () => viewCollectionDetails(btn.dataset.id));
        });
      }

      // Render deposits in the table
      function renderDeposits(depositsData) {
        const tbody = depositsTable.querySelector("tbody");
        tbody.innerHTML = "";

        if (depositsData.length === 0) {
          tbody.innerHTML = '<tr><td colspan="8" class="text-center">No deposits found</td></tr>';
          return;
        }

        depositsData.forEach(deposit => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${deposit.deposit_id}</td>
            <td>${deposit.bank_name}</td>
            <td>${deposit.reference_no}</td>
            <td>₱${formatNumber(deposit.amount)}</td>
            <td>${deposit.deposit_date}</td>
            <td>${formatSourceType(deposit.source_type)}</td>
            <td>${formatDepositStatus(deposit.status)}</td>
            <td>
              <div class="approval-actions">
                <button class="btn btn-sm btn-primary view-btn" data-type="deposit" data-id="${deposit.deposit_id}">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </td>
          `;
          tbody.appendChild(row);
        });
        
        // Add event listeners to view buttons
        document.querySelectorAll('.view-btn[data-type="deposit"]').forEach(btn => {
          btn.addEventListener("click", () => viewDepositDetails(btn.dataset.id));
        });
      }

      // Render refunds in the table
      function renderRefunds(refundsData) {
        const tbody = refundsTable.querySelector("tbody");
        tbody.innerHTML = "";

        if (refundsData.length === 0) {
          tbody.innerHTML = '<tr><td colspan="7" class="text-center">No refunds found</td></tr>';
          return;
        }

        refundsData.forEach(refund => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${refund.refund_id}</td>
            <td>${refund.payment_id}</td>
            <td>${refund.order_id}</td>
            <td>₱${formatNumber(refund.refund_amount)}</td>
            <td>${refund.refund_date}</td>
            <td>${formatRefundStatus(refund.status)}</td>
            <td>
              <div class="approval-actions">
                <button class="btn btn-sm btn-primary view-btn" data-type="refund" data-id="${refund.refund_id}">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </td>
          `;
          tbody.appendChild(row);
        });
        
        // Add event listeners to view buttons
        document.querySelectorAll('.view-btn[data-type="refund"]').forEach(btn => {
          btn.addEventListener("click", () => viewRefundDetails(btn.dataset.id));
        });
      }

      // Render roles and approvals
      function renderApprovals(approvalsData) {
        approvalsTableBody.innerHTML = "";

        if (approvalsData.length === 0) {
          approvalsTableBody.innerHTML = '<tr><td colspan="6" class="text-center">No roles found</td></tr>';
          return;
        }

        approvalsData.forEach(role => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${role.role_id}</td>
            <td>${role.role_name}</td>
            <td>${role.user_id}</td>
            <td>${formatApprovalRights(role.approval_rights)}</td>
            <td>${role.last_action_date}</td>
            <td>
              <div class="approval-actions">
                <button class="btn btn-sm btn-primary edit-role-btn" data-id="${role.role_id}">
                  <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger delete-role-btn" data-id="${role.role_id}">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </td>
          `;
          approvalsTableBody.appendChild(row);
        });

        // Add event listeners to edit and delete buttons
        document.querySelectorAll('.edit-role-btn').forEach(btn => {
          btn.addEventListener("click", () => editRole(btn.dataset.id));
        });

        document.querySelectorAll('.delete-role-btn').forEach(btn => {
          btn.addEventListener("click", () => confirmDelete(btn.dataset.id));
        });
      }

      // Format inflow source for display
      function formatInflowSource(source) {
        switch (source) {
          case "gateway":
            return "Payment Gateway";
          case "cod":
            return "Cash on Delivery";
          case "wallet":
            return "E-Wallet";
          case "refund offset":
            return "Refund Offset";
          default:
            return source;
        }
      }

      // Format payment method for display
      function formatPaymentMethod(method) {
        switch (method) {
          case "gateway":
            return "Payment Gateway";
          case "cod":
            return "Cash on Delivery";
          case "wallet":
            return "E-Wallet";
          default:
            return method;
        }
      }

      // Format payment status for display
      function formatPaymentStatus(status) {
        switch (status) {
          case "pending":
            return `<span class="status-badge status-behind">Pending</span>`;
          case "received":
            return `<span class="status-badge status-on-track">Received</span>`;
          case "unsettled":
            return `<span class="status-badge status-behind">Unsettled</span>`;
          case "refunded":
            return `<span class="status-badge status-over">Refunded</span>`;
          default:
            return status;
        }
      }

      // Format settlement status for display
      function formatSettlementStatus(status) {
        switch (status) {
          case "matched":
            return `<span class="status-badge status-on-track">Matched</span>`;
          case "failed":
            return `<span class="status-badge status-over">Failed</span>`;
          case "pending":
            return `<span class="status-badge status-behind">Pending</span>`;
          default:
            return status;
        }
      }

      // Format collection status for display
      function formatCollectionStatus(status) {
        switch (status) {
          case "pending":
            return `<span class="status-badge status-behind">Pending</span>`;
          case "received":
            return `<span class="status-badge status-on-track">Received</span>`;
          case "short":
            return `<span class="status-badge status-over">Short</span>`;
          case "delayed":
            return `<span class="status-badge status-behind">Delayed</span>`;
          default:
            return status;
        }
      }

      // Format source type for display
      function formatSourceType(type) {
        switch (type) {
          case "gateway":
            return "Payment Gateway";
          case "cod":
            return "Cash on Delivery";
          case "wallet":
            return "E-Wallet";
          case "refund offset":
            return "Refund Offset";
          default:
            return type;
        }
      }

      // Format deposit status for display
      function formatDepositStatus(status) {
        switch (status) {
          case "matched":
            return `<span class="status-badge status-on-track">Matched</span>`;
          case "unmatched":
            return `<span class="status-badge status-over">Unmatched</span>`;
          case "pending":
            return `<span class="status-badge status-behind">Pending</span>`;
          default:
            return status;
        }
      }

      // Format refund status for display
      function formatRefundStatus(status) {
        switch (status) {
          case "processed":
            return `<span class="status-badge status-on-track">Processed</span>`;
          case "pending":
            return `<span class="status-badge status-behind">Pending</span>`;
          case "error":
            return `<span class="status-badge status-over">Error</span>`;
          default:
            return status;
        }
      }

      // Format variance for display
      function formatVariance(variance) {
        if (variance > 0) {
          return `<span class="variance-positive">+₱${formatNumber(variance)}</span>`;
        } else if (variance < 0) {
          return `<span class="variance-negative">-₱${formatNumber(Math.abs(variance))}</span>`;
        } else {
          return `<span>₱0.00</span>`;
        }
      }

      // Format approval rights for display
      function formatApprovalRights(rights) {
        switch (rights) {
          case "view":
            return "View Only";
          case "approve":
            return "Approve";
          case "edit":
            return "Edit & Approve";
          default:
            return rights;
        }
      }

      // Format number with commas
      function formatNumber(num) {
        return num.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
      }

      // View details functions
      function viewCashFlowDetails(id) {
        const report = cashFlowReports.find(r => r.report_id == id);
        if (report) {
          alert(`Cash Flow Report Details:\nID: ${report.report_id}\nDate: ${report.report_date}\nSource: ${formatInflowSource(report.inflow_source)}\nExpected: ₱${formatNumber(report.expected_inflow)}\nActual: ₱${formatNumber(report.actual_inflow)}\nVariance: ${formatVariance(report.variance)}\nForecast: ₱${formatNumber(report.forecast_amount)}`);
        }
      }

      function viewPaymentDetails(id) {
        const payment = payments.find(p => p.payment_id == id);
        if (payment) {
          alert(`Payment Details:\nID: ${payment.payment_id}\nCustomer: ${payment.customer_id}\nOrder: ${payment.order_id}\nMethod: ${formatPaymentMethod(payment.payment_method)}\nAmount: ₱${formatNumber(payment.amount)}\nStatus: ${payment.status}\nDate: ${payment.created_at}`);
        }
      }

      function viewSettlementDetails(id) {
        const settlement = settlements.find(s => s.settlement_id == id);
        if (settlement) {
          alert(`Settlement Details:\nID: ${settlement.settlement_id}\nGateway: ${settlement.gateway_name}\nReference: ${settlement.transaction_ref}\nExpected: ₱${formatNumber(settlement.expected_amount)}\nReceived: ₱${formatNumber(settlement.received_amount)}\nDate: ${settlement.settlement_date}\nStatus: ${settlement.status}`);
        }
      }

      function viewCollectionDetails(id) {
        const collection = collections.find(c => c.cod_id == id);
        if (collection) {
          alert(`Collection Details:\nID: ${collection.cod_id}\nPartner: ${collection.partner_id}\nBatch: ${collection.delivery_batch_no}\nExpected: ₱${formatNumber(collection.expected_amount)}\nDeposited: ₱${formatNumber(collection.deposited_amount)}\nDate: ${collection.deposit_date}\nStatus: ${collection.status}`);
        }
      }

      function viewDepositDetails(id) {
        const deposit = deposits.find(d => d.deposit_id == id);
        if (deposit) {
          alert(`Deposit Details:\nID: ${deposit.deposit_id}\nBank: ${deposit.bank_name}\nReference: ${deposit.reference_no}\nAmount: ₱${formatNumber(deposit.amount)}\nDate: ${deposit.deposit_date}\nSource: ${formatSourceType(deposit.source_type)}\nStatus: ${deposit.status}`);
        }
      }

      function viewRefundDetails(id) {
        const refund = refunds.find(r => r.refund_id == id);
        if (refund) {
          alert(`Refund Details:\nID: ${refund.refund_id}\nPayment: ${refund.payment_id}\nOrder: ${refund.order_id}\nAmount: ₱${formatNumber(refund.refund_amount)}\nDate: ${refund.refund_date}\nStatus: ${refund.status}`);
        }
      }

      // Role management functions
      function editRole(id) {
        const role = rolesApprovals.find(r => r.role_id == id);
        if (role) {
          document.getElementById('roleName').value = role.role_name;
          document.getElementById('userId').value = role.user_id;
          document.getElementById('approvalRights').value = role.approval_rights;
          currentRoleId = id;
          addRoleModal.style.display = "flex";
        }
      }

      function confirmDelete(id) {
        currentRoleId = id;
        deleteModal.style.display = "flex";
      }

      // Event listeners for action buttons
      document.getElementById("approvalBtn").addEventListener("click", () => {
        // Switch to the approvals tab
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        
        document.querySelector('.tab[data-tab="approvals"]').classList.add('active');
        document.getElementById("approvals-tab").classList.add('active');
      });

      document.getElementById("addRoleBtn").addEventListener("click", () => {
        addRoleModal.style.display = "flex";
        currentRoleId = null;
        addRoleForm.reset();
      });

      cancelAddRole.addEventListener("click", () => {
        addRoleModal.style.display = "none";
      });

      cancelDelete.addEventListener("click", () => {
        deleteModal.style.display = "none";
      });

      addRoleForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const roleName = document.getElementById("roleName").value;
        const userId = document.getElementById("userId").value;
        const approvalRights = document.getElementById("approvalRights").value;
        
        if (!roleName || !userId || !approvalRights) {
          alert("Please fill in all fields.");
          return;
        }
        
        if (currentRoleId) {
          // Update existing role
          const role = rolesApprovals.find(r => r.role_id == currentRoleId);
          if (role) {
            role.role_name = roleName;
            role.user_id = userId;
            role.approval_rights = approvalRights;
            role.last_action_date = new Date().toISOString().split('T')[0];
          }
        } else {
          // Add new role to the list
          const newRole = {
            role_id: rolesApprovals.length + 1,
            role_name: roleName,
            user_id: userId,
            approval_rights: approvalRights,
            last_action_date: new Date().toISOString().split('T')[0]
          };
          
          rolesApprovals.push(newRole);
        }
        
        renderApprovals(rolesApprovals);
        
        // In a real application, this would send the data to the server
        alert(currentRoleId ? "Role updated successfully!" : "Role added successfully!");
        addRoleModal.style.display = "none";
        addRoleForm.reset();
      });

      document.getElementById('confirmDelete').addEventListener('click', () => {
        rolesApprovals = rolesApprovals.filter(r => r.role_id != currentRoleId);
        renderApprovals(rolesApprovals);
        deleteModal.style.display = "none";
        alert(`Role #${currentRoleId} has been deleted.`);
      });

      // Close modals when clicking outside
      window.addEventListener("click", (e) => {
        if (e.target === addRoleModal) {
          addRoleModal.style.display = "none";
        }
        if (e.target === deleteModal) {
          deleteModal.style.display = "none";
        }
      });

      // Generate report
      document.getElementById("generateReportBtn").addEventListener("click", () => {
        // Simulate report generation
        alert("Generating cash flow report. This may take a few moments...");
        
        // Simulate some report generation actions
        setTimeout(() => {
          alert("Cash flow report generated successfully!");
        }, 2000);
      });

      // Export report
      document.getElementById("exportReportBtn").addEventListener("click", () => {
        // In a real application, this would generate and download a report
        alert("Report exported successfully!");
      });

      // Forecast
      document.getElementById("forecastBtn").addEventListener("click", () => {
        // Simulate forecasting
        alert("Running forecast analysis. This may take a few moments...");
        
        // Simulate some forecasting actions
        setTimeout(() => {
          alert("Forecast analysis completed. Updated projections are now available.");
        }, 2000);
      });

      // Apply filters
      document.getElementById("applyCashFlowFilters").addEventListener("click", () => {
        const sourceFilter = document.getElementById("filterSource").value;
        const dateFilter = document.getElementById("filterReportDate").value;

        let filteredCashFlow = [...cashFlowReports];

        if (sourceFilter) {
          filteredCashFlow = filteredCashFlow.filter(c => c.inflow_source === sourceFilter);
        }

        if (dateFilter) {
          filteredCashFlow = filteredCashFlow.filter(c => c.report_date === dateFilter);
        }

        renderCashFlowReports(filteredCashFlow);
        initializeChart(filteredCashFlow);
      });

      document.getElementById("applyPaymentFilters").addEventListener("click", () => {
        const methodFilter = document.getElementById("filterPaymentMethod").value;
        const statusFilter = document.getElementById("filterPaymentStatus").value;
        const dateFilter = document.getElementById("filterPaymentDate").value;

        let filteredPayments = [...payments];

        if (methodFilter) {
          filteredPayments = filteredPayments.filter(p => p.payment_method === methodFilter);
        }

        if (statusFilter) {
          filteredPayments = filteredPayments.filter(p => p.status === statusFilter);
        }

        if (dateFilter) {
          filteredPayments = filteredPayments.filter(p => p.created_at === dateFilter);
        }

        renderPayments(filteredPayments);
      });

      document.getElementById("applySettlementFilters").addEventListener("click", () => {
        const gatewayFilter = document.getElementById("filterGateway").value;
        const statusFilter = document.getElementById("filterSettlementStatus").value;
        const dateFilter = document.getElementById("filterSettlementDate").value;

        let filteredSettlements = [...settlements];

        if (gatewayFilter) {
          filteredSettlements = filteredSettlements.filter(s => s.gateway_name === gatewayFilter);
        }

        if (statusFilter) {
          filteredSettlements = filteredSettlements.filter(s => s.status === statusFilter);
        }

        if (dateFilter) {
          filteredSettlements = filteredSettlements.filter(s => s.settlement_date === dateFilter);
        }

        renderSettlements(filteredSettlements);
      });

      document.getElementById("applyCollectionFilters").addEventListener("click", () => {
        const partnerFilter = document.getElementById("filterPartner").value;
        const statusFilter = document.getElementById("filterCollectionStatus").value;
        const dateFilter = document.getElementById("filterCollectionDate").value;

        let filteredCollections = [...collections];

        if (partnerFilter) {
          filteredCollections = filteredCollections.filter(c => c.partner_id === partnerFilter);
        }

        if (statusFilter) {
          filteredCollections = filteredCollections.filter(c => c.status === statusFilter);
        }

        if (dateFilter) {
          filteredCollections = filteredCollections.filter(c => c.deposit_date === dateFilter);
        }

        renderCollections(filteredCollections);
      });

      document.getElementById("applyDepositFilters").addEventListener("click", () => {
        const bankFilter = document.getElementById("filterBank").value;
        const statusFilter = document.getElementById("filterDepositStatus").value;
        const dateFilter = document.getElementById("filterDepositDate").value;

        let filteredDeposits = [...deposits];

        if (bankFilter) {
          filteredDeposits = filteredDeposits.filter(d => d.bank_name === bankFilter);
        }

        if (statusFilter) {
          filteredDeposits = filteredDeposits.filter(d => d.status === statusFilter);
        }

        if (dateFilter) {
          filteredDeposits = filteredDeposits.filter(d => d.deposit_date === dateFilter);
        }

        renderDeposits(filteredDeposits);
      });

      document.getElementById("applyRefundFilters").addEventListener("click", () => {
        const statusFilter = document.getElementById("filterRefundStatus").value;
        const dateFilter = document.getElementById("filterRefundDate").value;

        let filteredRefunds = [...refunds];

        if (statusFilter) {
          filteredRefunds = filteredRefunds.filter(r => r.status === statusFilter);
        }

        if (dateFilter) {
          filteredRefunds = filteredRefunds.filter(r => r.refund_date === dateFilter);
        }

        renderRefunds(filteredRefunds);
      });

      document.getElementById("applyApprovalFilters").addEventListener("click", () => {
        const roleFilter = document.getElementById("filterRole").value;
        const dateFilter = document.getElementById("filterApprovalDate").value;

        let filteredApprovals = [...rolesApprovals];

        if (roleFilter) {
          filteredApprovals = filteredApprovals.filter(r => r.role_name === roleFilter);
        }

        if (dateFilter) {
          filteredApprovals = filteredApprovals.filter(r => r.last_action_date === dateFilter);
        }

        renderApprovals(filteredApprovals);
      });
    </script>
</body>
</html>

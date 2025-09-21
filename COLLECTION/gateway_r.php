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
          <div class="card-title">Total Payments</div>
          <div class="card-value">1,245</div>
          <div class="card-footer">₱12,450,000.00</div>
        </div>
        <div class="card">
          <div class="card-title">Total Settlements</div>
          <div class="card-value">42</div>
          <div class="card-footer">₱12,380,500.00</div>
        </div>
        <div class="card">
          <div class="card-title">Matched Records</div>
          <div class="card-value">1,187</div>
          <div class="card-footer">
            <span class="status-badge status-matched">95.3%</span>
          </div>
        </div>
        <div class="card">
          <div class="card-title">Unmatched Records</div>
          <div class="card-value">58</div>
          <div class="card-footer">
            <span class="status-badge status-unmatched">4.7%</span>
          </div>
        </div>
      </div>

      <!-- Reconciliation Actions -->
      <div class="reconciliation-actions">
        <button id="runReconciliationBtn" class="btn btn-primary">
          <i class="fa fa-sync"></i> Run Reconciliation
        </button>
        <button id="exportReportBtn" class="btn btn-success">
          <i class="fa fa-file-export"></i> Export Report
        </button>
        <button id="manualMatchBtn" class="btn btn-warning">
          <i class="fa fa-hand-pointer"></i> Manual Match
        </button>
        <button id="approvalBtn" class="btn btn-info">
          <i class="fa fa-check-circle"></i> Approval Workflow
        </button>
      </div>

      <!-- Tabs -->
      <div class="tabs">
        <div class="tab active" data-tab="payments">Payments</div>
        <div class="tab" data-tab="settlements">Gateway Settlements</div>
        <div class="tab" data-tab="deposits">Bank Deposits</div>
        <div class="tab" data-tab="mismatches">Mismatches</div>
        <div class="tab" data-tab="approvals">Roles & Approvals</div>
      </div>

      <!-- Tab Content -->
      <div class="tab-content active" id="payments-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Customer Payments</h4>
                </div>
                <div class="card-body">
                  <!-- Filter Section -->
                  <div class="filter-section">
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

      <div class="tab-content" id="settlements-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Gateway Settlements</h4>
                </div>
                <div class="card-body">
                  <!-- Filter Section -->
                  <div class="filter-section">
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

      <div class="tab-content" id="deposits-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Bank Deposits</h4>
                </div>
                <div class="card-body">
                  <!-- Filter Section -->
                  <div class="filter-section">
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

      <div class="tab-content" id="mismatches-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Mismatches</h4>
                </div>
                <div class="card-body">
                  <!-- Filter Section -->
                  <div class="filter-section">
                    <div class="row">
                      <div class="col">
                        <label for="filterMismatchType">Mismatch Type</label>
                        <select id="filterMismatchType" class="form-control">
                          <option value="">All Types</option>
                          <option value="amount">Amount Mismatch</option>
                          <option value="missing">Missing Record</option>
                          <option value="duplicate">Duplicate Record</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="filterMismatchDate">Date Range</label>
                        <input type="date" id="filterMismatchDate" class="form-control">
                      </div>
                      <div class="col">
                        <label>&nbsp;</label>
                        <button id="applyMismatchFilters" class="btn btn-success form-control">
                          <i class="fa fa-filter"></i> Apply Filters
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Mismatches Table -->
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="mismatchesTable">
                      <thead>
                        <tr>
                          <th>Record ID</th>
                          <th>Type</th>
                          <th>Description</th>
                          <th>Expected Amount</th>
                          <th>Actual Amount</th>
                          <th>Date</th>
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

    <!-- Manual Match Modal -->
    <div id="manualMatchModal" class="modal-overlay">
      <div class="modal-box">
        <h3>Manual Match</h3>
        <form id="manualMatchForm">
          <div class="form-group mb-3">
            <label for="paymentSelect">Payment Record</label>
            <select class="form-control" id="paymentSelect" required>
              <option value="">Select Payment</option>
              <!-- Options will be populated by JavaScript -->
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="settlementSelect">Gateway Settlement</label>
            <select class="form-control" id="settlementSelect" required>
              <option value="">Select Settlement</option>
              <!-- Options will be populated by JavaScript -->
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="depositSelect">Bank Deposit</label>
            <select class="form-control" id="depositSelect" required>
              <option value="">Select Deposit</option>
              <!-- Options will be populated by JavaScript -->
            </select>
          </div>
          <div class="modal-actions">
            <button type="submit" class="btn-yes">
              <i class="fas fa-link"></i> Match Records
            </button>
            <button type="button" id="cancelManualMatch" class="btn-no">
              <i class="fas fa-times"></i> Cancel
            </button>
          </div>
        </form>
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
</div>

    <script>
      // Sample data for payments
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
          payment_method: "wallet",
          amount: 1750.25,
          status: "received",
          created_at: "2025-09-02"
        }
      ];

      // Sample data for gateway settlements
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

      // Sample data for bank deposits
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

      // Sample data for mismatches
      let mismatches = [
        {
          record_id: 901,
          type: "amount",
          description: "GCash settlement amount mismatch",
          expected_amount: 1850.75,
          actual_amount: 1800.00,
          date: "2025-08-31",
          status: "pending"
        },
        {
          record_id: 902,
          type: "missing",
          description: "Missing bank deposit for PayMaya settlement",
          expected_amount: 3200.00,
          actual_amount: 0.00,
          date: "2025-09-02",
          status: "pending"
        }
      ];

      // Sample data for roles and approvals
      let rolesApprovals = [
        {
          role_id: 1,
          role_name: "CFO",
          user_id: "U1001",
          approval_rights: "edit",
          last_action_date: "2025-09-01"
        },
        {
          role_id: 2,
          role_name: "Treasury Analyst",
          user_id: "U1002",
          approval_rights: "approve",
          last_action_date: "2025-08-30"
        },
        {
          role_id: 3,
          role_name: "Financial Director",
          user_id: "U1003",
          approval_rights: "view",
          last_action_date: "2025-08-28"
        }
      ];

      // DOM Elements
      const paymentsTable = document.getElementById("paymentsTable");
      const settlementsTable = document.getElementById("settlementsTable");
      const depositsTable = document.getElementById("depositsTable");
      const mismatchesTable = document.getElementById("mismatchesTable");
      const approvalsTableBody = document.getElementById("approvalsTableBody");
      const manualMatchModal = document.getElementById("manualMatchModal");
      const addRoleModal = document.getElementById("addRoleModal");
      const manualMatchForm = document.getElementById("manualMatchForm");
      const addRoleForm = document.getElementById("addRoleForm");
      const cancelManualMatch = document.getElementById("cancelManualMatch");
      const cancelAddRole = document.getElementById("cancelAddRole");

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
        renderPayments(payments);
        renderSettlements(settlements);
        renderDeposits(deposits);
        renderMismatches(mismatches);
        renderApprovals(rolesApprovals);
        populateManualMatchSelects();
      });

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
            <td>₱${payment.amount.toFixed(2)}</td>
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
            <td>₱${settlement.expected_amount.toFixed(2)}</td>
            <td>₱${settlement.received_amount.toFixed(2)}</td>
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
            <td>₱${deposit.amount.toFixed(2)}</td>
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

      // Render mismatches in the table
      function renderMismatches(mismatchesData) {
        const tbody = mismatchesTable.querySelector("tbody");
        tbody.innerHTML = "";

        if (mismatchesData.length === 0) {
          tbody.innerHTML = '<tr><td colspan="8" class="text-center">No mismatches found</td></tr>';
          return;
        }

        mismatchesData.forEach(mismatch => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${mismatch.record_id}</td>
            <td>${formatMismatchType(mismatch.type)}</td>
            <td>${mismatch.description}</td>
            <td>₱${mismatch.expected_amount.toFixed(2)}</td>
            <td>₱${mismatch.actual_amount.toFixed(2)}</td>
            <td>${mismatch.date}</td>
            <td>${formatMismatchStatus(mismatch.status)}</td>
            <td>
              <div class="approval-actions">
                <button class="btn btn-sm btn-success resolve-btn" data-id="${mismatch.record_id}">
                  <i class="fas fa-check"></i>
                </button>
              </div>
            </td>
          `;
          tbody.appendChild(row);
        });
        
        // Add event listeners to resolve buttons
        document.querySelectorAll('.resolve-btn').forEach(btn => {
          btn.addEventListener("click", () => resolveMismatch(btn.dataset.id));
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
          btn.addEventListener("click", () => deleteRole(btn.dataset.id));
        });
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
            return `<span class="status-badge status-pending">Pending</span>`;
          case "received":
            return `<span class="status-badge status-matched">Received</span>`;
          case "unsettled":
            return `<span class="status-badge status-unmatched">Unsettled</span>`;
          case "refunded":
            return `<span class="status-badge status-unmatched">Refunded</span>`;
          default:
            return status;
        }
      }

      // Format settlement status for display
      function formatSettlementStatus(status) {
        switch (status) {
          case "matched":
            return `<span class="status-badge status-matched">Matched</span>`;
          case "failed":
            return `<span class="status-badge status-failed">Failed</span>`;
          case "pending":
            return `<span class="status-badge status-pending">Pending</span>`;
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
          default:
            return type;
        }
      }

      // Format deposit status for display
      function formatDepositStatus(status) {
        switch (status) {
          case "matched":
            return `<span class="status-badge status-matched">Matched</span>`;
          case "unmatched":
            return `<span class="status-badge status-unmatched">Unmatched</span>`;
          default:
            return status;
        }
      }

      // Format mismatch type for display
      function formatMismatchType(type) {
        switch (type) {
          case "amount":
            return "Amount Mismatch";
          case "missing":
            return "Missing Record";
          case "duplicate":
            return "Duplicate Record";
          default:
            return type;
        }
      }

      // Format mismatch status for display
      function formatMismatchStatus(status) {
        switch (status) {
          case "pending":
            return `<span class="status-badge status-pending">Pending</span>`;
          case "resolved":
            return `<span class="status-badge status-matched">Resolved</span>`;
          default:
            return status;
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

      // View details functions
      function viewPaymentDetails(id) {
        const payment = payments.find(p => p.payment_id == id);
        if (payment) {
          alert(`Payment Details:\nID: ${payment.payment_id}\nCustomer: ${payment.customer_id}\nOrder: ${payment.order_id}\nMethod: ${formatPaymentMethod(payment.payment_method)}\nAmount: ₱${payment.amount.toFixed(2)}\nStatus: ${payment.status}\nDate: ${payment.created_at}`);
        }
      }

      function viewSettlementDetails(id) {
        const settlement = settlements.find(s => s.settlement_id == id);
        if (settlement) {
          alert(`Settlement Details:\nID: ${settlement.settlement_id}\nGateway: ${settlement.gateway_name}\nReference: ${settlement.transaction_ref}\nExpected: ₱${settlement.expected_amount.toFixed(2)}\nReceived: ₱${settlement.received_amount.toFixed(2)}\nDate: ${settlement.settlement_date}\nStatus: ${settlement.status}`);
        }
      }

      function viewDepositDetails(id) {
        const deposit = deposits.find(d => d.deposit_id == id);
        if (deposit) {
          alert(`Deposit Details:\nID: ${deposit.deposit_id}\nBank: ${deposit.bank_name}\nReference: ${deposit.reference_no}\nAmount: ₱${deposit.amount.toFixed(2)}\nDate: ${deposit.deposit_date}\nSource: ${formatSourceType(deposit.source_type)}\nStatus: ${deposit.status}`);
        }
      }

      function resolveMismatch(id) {
        const mismatch = mismatches.find(m => m.record_id == id);
        if (mismatch) {
          // Update status to resolved
          mismatch.status = "resolved";
          renderMismatches(mismatches);
          alert(`Mismatch #${id} has been marked as resolved.`);
        }
      }

      // Role management functions
      function editRole(id) {
        const role = rolesApprovals.find(r => r.role_id == id);
        if (role) {
          alert(`Edit Role:\nID: ${role.role_id}\nName: ${role.role_name}\nUser ID: ${role.user_id}\nRights: ${formatApprovalRights(role.approval_rights)}\nLast Action: ${role.last_action_date}`);
        }
      }

      function deleteRole(id) {
        if (confirm(`Are you sure you want to delete role #${id}?`)) {
          rolesApprovals = rolesApprovals.filter(r => r.role_id != id);
          renderApprovals(rolesApprovals);
          alert(`Role #${id} has been deleted.`);
        }
      }

      // Populate select options for manual matching
      function populateManualMatchSelects() {
        const paymentSelect = document.getElementById("paymentSelect");
        const settlementSelect = document.getElementById("settlementSelect");
        const depositSelect = document.getElementById("depositSelect");

        // Clear existing options
        paymentSelect.innerHTML = '<option value="">Select Payment</option>';
        settlementSelect.innerHTML = '<option value="">Select Settlement</option>';
        depositSelect.innerHTML = '<option value="">Select Deposit</option>';

        // Populate payment options
        payments.forEach(payment => {
          if (payment.status !== "refunded") {
            const option = document.createElement("option");
            option.value = payment.payment_id;
            option.textContent = `Payment #${payment.payment_id} - ₱${payment.amount.toFixed(2)}`;
            paymentSelect.appendChild(option);
          }
        });

        // Populate settlement options
        settlements.forEach(settlement => {
          if (settlement.status !== "matched") {
            const option = document.createElement("option");
            option.value = settlement.settlement_id;
            option.textContent = `${settlement.gateway_name} - ${settlement.transaction_ref} - ₱${settlement.expected_amount.toFixed(2)}`;
            settlementSelect.appendChild(option);
          }
        });

        // Populate deposit options
        deposits.forEach(deposit => {
          if (deposit.status !== "matched") {
            const option = document.createElement("option");
            option.value = deposit.deposit_id;
            option.textContent = `${deposit.bank_name} - ${deposit.reference_no} - ₱${deposit.amount.toFixed(2)}`;
            depositSelect.appendChild(option);
          }
        });
      }

      // Event listeners for action buttons
      document.getElementById("manualMatchBtn").addEventListener("click", () => {
        populateManualMatchSelects();
        manualMatchModal.style.display = "flex";
      });

      document.getElementById("approvalBtn").addEventListener("click", () => {
        // Switch to the approvals tab
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        
        document.querySelector('.tab[data-tab="approvals"]').classList.add('active');
        document.getElementById("approvals-tab").classList.add('active');
      });

      document.getElementById("addRoleBtn").addEventListener("click", () => {
        addRoleModal.style.display = "flex";
      });

      cancelManualMatch.addEventListener("click", () => {
        manualMatchModal.style.display = "none";
      });

      cancelAddRole.addEventListener("click", () => {
        addRoleModal.style.display = "none";
      });

      manualMatchForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const paymentId = document.getElementById("paymentSelect").value;
        const settlementId = document.getElementById("settlementSelect").value;
        const depositId = document.getElementById("depositSelect").value;
        
        if (!paymentId || !settlementId || !depositId) {
          alert("Please select all three records to match.");
          return;
        }
        
        // Update statuses to matched
        const payment = payments.find(p => p.payment_id == paymentId);
        const settlement = settlements.find(s => s.settlement_id == settlementId);
        const deposit = deposits.find(d => d.deposit_id == depositId);
        
        if (payment) payment.status = "received";
        if (settlement) settlement.status = "matched";
        if (deposit) deposit.status = "matched";
        
        // Refresh all tables
        renderPayments(payments);
        renderSettlements(settlements);
        renderDeposits(deposits);
        
        // In a real application, this would send the data to the server
        alert("Records matched successfully!");
        manualMatchModal.style.display = "none";
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
        
        // Add new role to the list
        const newRole = {
          role_id: rolesApprovals.length + 1,
          role_name: roleName,
          user_id: userId,
          approval_rights: approvalRights,
          last_action_date: new Date().toISOString().split('T')[0]
        };
        
        rolesApprovals.push(newRole);
        renderApprovals(rolesApprovals);
        
        // In a real application, this would send the data to the server
        alert("Role added successfully!");
        addRoleModal.style.display = "none";
        addRoleForm.reset();
      });

      // Close modals when clicking outside
      window.addEventListener("click", (e) => {
        if (e.target === manualMatchModal) {
          manualMatchModal.style.display = "none";
        }
        if (e.target === addRoleModal) {
          addRoleModal.style.display = "none";
        }
      });

      // Run reconciliation
      document.getElementById("runReconciliationBtn").addEventListener("click", () => {
        // Simulate reconciliation process
        alert("Reconciliation process started. This may take a few moments...");
        
        // Simulate some reconciliation actions
        setTimeout(() => {
          // For demo purposes, let's match a few records automatically
          if (payments.length > 0 && settlements.length > 0 && deposits.length > 0) {
            // Match first unmatched records
            const unmatchedPayment = payments.find(p => p.status === "unsettled");
            const unmatchedSettlement = settlements.find(s => s.status !== "matched");
            const unmatchedDeposit = deposits.find(d => d.status !== "matched");
            
            if (unmatchedPayment) unmatchedPayment.status = "received";
            if (unmatchedSettlement) unmatchedSettlement.status = "matched";
            if (unmatchedDeposit) unmatchedDeposit.status = "matched";
            
            // Refresh all tables
            renderPayments(payments);
            renderSettlements(settlements);
            renderDeposits(deposits);
            
            alert("Reconciliation process completed. Some records have been automatically matched.");
          } else {
            alert("Reconciliation process completed. No records to match.");
          }
        }, 2000);
      });

      // Export report
      document.getElementById("exportReportBtn").addEventListener("click", () => {
        // In a real application, this would generate and download a report
        alert("Report exported successfully!");
      });

      // Apply filters
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

      document.getElementById("applyMismatchFilters").addEventListener("click", () => {
        const typeFilter = document.getElementById("filterMismatchType").value;
        const dateFilter = document.getElementById("filterMismatchDate").value;

        let filteredMismatches = [...mismatches];

        if (typeFilter) {
          filteredMismatches = filteredMismatches.filter(m => m.type === typeFilter);
        }

        if (dateFilter) {
          filteredMismatches = filteredMismatches.filter(m => m.date === dateFilter);
        }

        renderMismatches(filteredMismatches);
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
<script src="../PANEL/ASSETS/js/script-p.js"></script>
</body>
</html>

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
          <div class="card-title">Total Refunds</div>
          <div class="card-value">1,242</div>
          <div class="card-footer">₱12,420,000.00</div>
        </div>
        <div class="card">
          <div class="card-title">Processed Refunds</div>
          <div class="card-value">1,187</div>
          <div class="card-footer">
            <span class="status-badge status-processed">95.6%</span>
          </div>
        </div>
        <div class="card">
          <div class="card-title">Pending Refunds</div>
          <div class="card-value">47</div>
          <div class="card-footer">
            <span class="status-badge status-pending">3.8%</span>
          </div>
        </div>
        <div class="card">
          <div class="card-title">Error Refunds</div>
          <div class="card-value">8</div>
          <div class="card-footer">
            <span class="status-badge status-error">0.6%</span>
          </div>
        </div>
      </div>

      <!-- Refund Actions -->
      <div class="refund-actions">
        <button id="processRefundsBtn" class="btn btn-primary">
          <i class="fa fa-sync"></i> Process Refunds
        </button>
        <button id="exportReportBtn" class="btn btn-success">
          <i class="fa fa-file-export"></i> Export Report
        </button>
        <button id="manualProcessBtn" class="btn btn-warning">
          <i class="fa fa-hand-pointer"></i> Manual Process
        </button>
        <button id="approvalBtn" class="btn btn-info">
          <i class="fa fa-check-circle"></i> Approval Workflow
        </button>
      </div>

      <!-- Tabs -->
      <div class="tabs">
        <div class="tab active" data-tab="refunds">Refunds</div>
        <div class="tab" data-tab="payments">Payments</div>
        <div class="tab" data-tab="cashflow">Cash Flow</div>
        <div class="tab" data-tab="approvals">Roles & Approvals</div>
      </div>

      <!-- Tab Content -->
      <div class="tab-content active" id="refunds-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Refunds</h4>
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

      <div class="tab-content" id="payments-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Payments</h4>
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

      <div class="tab-content" id="cashflow-tab">
        <div class="container-fluid" style="padding: 20px">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Cash Flow</h4>
                </div>
                <div class="card-body">
                  <!-- Filter Section -->
                  <div class="filter-section mb-4">
                    <div class="row">
                      <div class="col">
                        <label for="filterCashFlowType">Type</label>
                        <select id="filterCashFlowType" class="form-control">
                          <option value="">All Types</option>
                          <option value="inflow">Inflow</option>
                          <option value="outflow">Outflow</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="filterCashFlowDate">Date Range</label>
                        <input type="date" id="filterCashFlowDate" class="form-control">
                      </div>
                      <div class="col">
                        <label>&nbsp;</label>
                        <button id="applyCashFlowFilters" class="btn btn-success form-control">
                          <i class="fa fa-filter"></i> Apply Filters
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Cash Flow Table -->
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="cashFlowTable">
                      <thead>
                        <tr>
                          <th>Entry ID</th>
                          <th>Type</th>
                          <th>Description</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Related Refund</th>
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
                        <option value="AR Manager">AR Manager</option>
                        <option value="GL Accountant">GL Accountant</option>
                        <option value="Expense Auditor">Expense Auditor</option>
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

    <!-- Manual Process Modal -->
    <div id="manualProcessModal" class="modal-overlay">
      <div class="modal-box">
        <h3>Manual Process Refund</h3>
        <form id="manualProcessForm">
          <div class="form-group mb-3">
            <label for="refundSelect">Refund Record</label>
            <select class="form-control" id="refundSelect" required>
              <option value="">Select Refund</option>
              <!-- Options will be populated by JavaScript -->
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="paymentSelect">Related Payment</label>
            <select class="form-control" id="paymentSelect" required>
              <option value="">Select Payment</option>
              <!-- Options will be populated by JavaScript -->
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="cashFlowSelect">Cash Flow Entry</label>
            <select class="form-control" id="cashFlowSelect" required>
              <option value="">Select Cash Flow Entry</option>
              <!-- Options will be populated by JavaScript -->
            </select>
          </div>
          <div class="modal-actions">
            <button type="submit" class="btn-yes">
              <i class="fas fa-link"></i> Process Refund
            </button>
            <button type="button" id="cancelManualProcess" class="btn-no">
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
              <option value="AR Manager">AR Manager</option>
              <option value="GL Accountant">GL Accountant</option>
              <option value="Expense Auditor">Expense Auditor</option>
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
<script>
  // Sample data for refunds
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
        },
        {
          refund_id: 605,
          payment_id: 1005,
          order_id: 50567,
          refund_amount: 1750.25,
          refund_date: "2025-09-03",
          status: "pending"
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
          status: "refunded",
          created_at: "2025-08-15"
        },
        {
          payment_id: 1002,
          customer_id: 20032,
          order_id: 50245,
          payment_method: "gateway",
          amount: 5200.50,
          status: "refunded",
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

      // Sample data for cash flow entries
      let cashFlow = [
        {
          entry_id: 701,
          type: "outflow",
          description: "Refund for order #50123",
          amount: 2500.00,
          date: "2025-08-16",
          related_refund: 601,
          status: "processed"
        },
        {
          entry_id: 702,
          type: "outflow",
          description: "Refund for order #50245",
          amount: 5200.50,
          date: "2025-08-23",
          related_refund: 602,
          status: "processed"
        },
        {
          entry_id: 703,
          type: "outflow",
          description: "Refund for order #50312",
          amount: 1800.00,
          date: "2025-08-31",
          related_refund: 603,
          status: "pending"
        },
        {
          entry_id: 704,
          type: "outflow",
          description: "Refund for order #50456",
          amount: 3200.00,
          date: "2025-09-02",
          related_refund: 604,
          status: "error"
        }
      ];

      // Sample data for roles and approvals
      let rolesApprovals = [
        {
          role_id: 1,
          role_name: "AR Manager",
          user_id: "U4001",
          approval_rights: "edit",
          last_action_date: "2025-09-01"
        },
        {
          role_id: 2,
          role_name: "GL Accountant",
          user_id: "U4002",
          approval_rights: "approve",
          last_action_date: "2025-08-30"
        },
        {
          role_id: 3,
          role_name: "Expense Auditor",
          user_id: "U4003",
          approval_rights: "view",
          last_action_date: "2025-08-28"
        },
        {
          role_id: 4,
          role_name: "Financial Director",
          user_id: "U4004",
          approval_rights: "edit",
          last_action_date: "2025-08-25"
        }
      ];

      // DOM Elements
      const refundsTable = document.getElementById("refundsTable");
      const paymentsTable = document.getElementById("paymentsTable");
      const cashFlowTable = document.getElementById("cashFlowTable");
      const approvalsTableBody = document.getElementById("approvalsTableBody");
      const manualProcessModal = document.getElementById("manualProcessModal");
      const addRoleModal = document.getElementById("addRoleModal");
      const deleteModal = document.getElementById("deleteModal");
      const manualProcessForm = document.getElementById("manualProcessForm");
      const addRoleForm = document.getElementById("addRoleForm");
      const cancelManualProcess = document.getElementById("cancelManualProcess");
      const cancelAddRole = document.getElementById("cancelAddRole");
      const cancelDelete = document.getElementById("cancelDelete");
      
      // Current item being edited
      let currentRoleId = null;

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
        renderRefunds(refunds);
        renderPayments(payments);
        renderCashFlow(cashFlow);
        renderApprovals(rolesApprovals);
        populateManualProcessSelects();
      });

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
            <td>₱${refund.refund_amount.toFixed(2)}</td>
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

      // Render cash flow entries in the table
      function renderCashFlow(cashFlowData) {
        const tbody = cashFlowTable.querySelector("tbody");
        tbody.innerHTML = "";

        if (cashFlowData.length === 0) {
          tbody.innerHTML = '<tr><td colspan="8" class="text-center">No cash flow entries found</td></tr>';
          return;
        }

        cashFlowData.forEach(entry => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${entry.entry_id}</td>
            <td>${formatCashFlowType(entry.type)}</td>
            <td>${entry.description}</td>
            <td>₱${entry.amount.toFixed(2)}</td>
            <td>${entry.date}</td>
            <td>${entry.related_refund || 'N/A'}</td>
            <td>${formatCashFlowStatus(entry.status)}</td>
            <td>
              <div class="approval-actions">
                <button class="btn btn-sm btn-primary view-btn" data-type="cashflow" data-id="${entry.entry_id}">
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

      // Format refund status for display
      function formatRefundStatus(status) {
        switch (status) {
          case "processed":
            return `<span class="status-badge status-processed">Processed</span>`;
          case "pending":
            return `<span class="status-badge status-pending">Pending</span>`;
          case "error":
            return `<span class="status-badge status-error">Error</span>`;
          default:
            return status;
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
            return `<span class="status-badge status-pending">Pending</span>`;
          case "received":
            return `<span class="status-badge status-processed">Received</span>`;
          case "unsettled":
            return `<span class="status-badge status-error">Unsettled</span>`;
          case "refunded":
            return `<span class="status-badge status-processed">Refunded</span>`;
          default:
            return status;
        }
      }

      // Format cash flow type for display
      function formatCashFlowType(type) {
        switch (type) {
          case "inflow":
            return "Inflow";
          case "outflow":
            return "Outflow";
          default:
            return type;
        }
      }

      // Format cash flow status for display
      function formatCashFlowStatus(status) {
        switch (status) {
          case "processed":
            return `<span class="status-badge status-processed">Processed</span>`;
          case "pending":
            return `<span class="status-badge status-pending">Pending</span>`;
          case "error":
            return `<span class="status-badge status-error">Error</span>`;
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
      function viewRefundDetails(id) {
        const refund = refunds.find(r => r.refund_id == id);
        if (refund) {
          alert(`Refund Details:\nID: ${refund.refund_id}\nPayment: ${refund.payment_id}\nOrder: ${refund.order_id}\nAmount: ₱${refund.refund_amount.toFixed(2)}\nDate: ${refund.refund_date}\nStatus: ${refund.status}`);
        }
      }

      function viewPaymentDetails(id) {
        const payment = payments.find(p => p.payment_id == id);
        if (payment) {
          alert(`Payment Details:\nID: ${payment.payment_id}\nCustomer: ${payment.customer_id}\nOrder: ${payment.order_id}\nMethod: ${formatPaymentMethod(payment.payment_method)}\nAmount: ₱${payment.amount.toFixed(2)}\nStatus: ${payment.status}\nDate: ${payment.created_at}`);
        }
      }

      function viewCashFlowDetails(id) {
        const entry = cashFlow.find(e => e.entry_id == id);
        if (entry) {
          alert(`Cash Flow Entry:\nID: ${entry.entry_id}\nType: ${formatCashFlowType(entry.type)}\nDescription: ${entry.description}\nAmount: ₱${entry.amount.toFixed(2)}\nDate: ${entry.date}\nRelated Refund: ${entry.related_refund || 'N/A'}\nStatus: ${entry.status}`);
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

      // Populate select options for manual processing
      function populateManualProcessSelects() {
        const refundSelect = document.getElementById("refundSelect");
        const paymentSelect = document.getElementById("paymentSelect");
        const cashFlowSelect = document.getElementById("cashFlowSelect");

        // Clear existing options
        refundSelect.innerHTML = '<option value="">Select Refund</option>';
        paymentSelect.innerHTML = '<option value="">Select Payment</option>';
        cashFlowSelect.innerHTML = '<option value="">Select Cash Flow Entry</option>';

        // Populate refund options
        refunds.forEach(refund => {
          if (refund.status !== "processed") {
            const option = document.createElement("option");
            option.value = refund.refund_id;
            option.textContent = `Refund #${refund.refund_id} - ₱${refund.refund_amount.toFixed(2)}`;
            refundSelect.appendChild(option);
          }
        });

        // Populate payment options
        payments.forEach(payment => {
          const option = document.createElement("option");
            option.value = payment.payment_id;
            option.textContent = `Payment #${payment.payment_id} - ₱${payment.amount.toFixed(2)}`;
            paymentSelect.appendChild(option);
        });

        // Populate cash flow options
        cashFlow.forEach(entry => {
          if (entry.status !== "processed") {
            const option = document.createElement("option");
            option.value = entry.entry_id;
            option.textContent = `${formatCashFlowType(entry.type)} - ${entry.description} - ₱${entry.amount.toFixed(2)}`;
            cashFlowSelect.appendChild(option);
          }
        });
      }

      // Event listeners for action buttons
      document.getElementById("manualProcessBtn").addEventListener("click", () => {
        populateManualProcessSelects();
        manualProcessModal.style.display = "flex";
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
        currentRoleId = null;
        addRoleForm.reset();
      });

      cancelManualProcess.addEventListener("click", () => {
        manualProcessModal.style.display = "none";
      });

      cancelAddRole.addEventListener("click", () => {
        addRoleModal.style.display = "none";
      });

      cancelDelete.addEventListener("click", () => {
        deleteModal.style.display = "none";
      });

      manualProcessForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const refundId = document.getElementById("refundSelect").value;
        const paymentId = document.getElementById("paymentSelect").value;
        const cashFlowId = document.getElementById("cashFlowSelect").value;
        
        if (!refundId || !paymentId || !cashFlowId) {
          alert("Please select all required records to process.");
          return;
        }
        
        // Update statuses to processed
        const refund = refunds.find(r => r.refund_id == refundId);
        const payment = payments.find(p => p.payment_id == paymentId);
        const cashFlowEntry = cashFlow.find(c => c.entry_id == cashFlowId);
        
        if (refund) refund.status = "processed";
        if (payment) payment.status = "refunded";
        if (cashFlowEntry) cashFlowEntry.status = "processed";
        
        // Refresh all tables
        renderRefunds(refunds);
        renderPayments(payments);
        renderCashFlow(cashFlow);
        
        // In a real application, this would send the data to the server
        alert("Refund processed successfully!");
        manualProcessModal.style.display = "none";
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
        if (e.target === manualProcessModal) {
          manualProcessModal.style.display = "none";
        }
        if (e.target === addRoleModal) {
          addRoleModal.style.display = "none";
        }
        if (e.target === deleteModal) {
          deleteModal.style.display = "none";
        }
      });

      // Process refunds
      document.getElementById("processRefundsBtn").addEventListener("click", () => {
        // Simulate processing
        alert("Processing refunds. This may take a few moments...");
        
        // Simulate some processing actions
        setTimeout(() => {
          // For demo purposes, let's process a few refunds automatically
          if (refunds.length > 0 && payments.length > 0) {
            // Process first pending refund
            const pendingRefund = refunds.find(r => r.status === "pending");
            const relatedPayment = pendingRefund ? payments.find(p => p.payment_id == pendingRefund.payment_id) : null;
            
            if (pendingRefund) pendingRefund.status = "processed";
            if (relatedPayment) relatedPayment.status = "refunded";
            
            // Refresh all tables
            renderRefunds(refunds);
            renderPayments(payments);
            
            alert("Refund processing completed. Some refunds have been processed.");
          } else {
            alert("Refund processing completed. No refunds to process.");
          }
        }, 2000);
      });

      // Export report
      document.getElementById("exportReportBtn").addEventListener("click", () => {
        // In a real application, this would generate and download a report
        alert("Report exported successfully!");
      });

      // Apply filters
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

      document.getElementById("applyCashFlowFilters").addEventListener("click", () => {
        const typeFilter = document.getElementById("filterCashFlowType").value;
        const dateFilter = document.getElementById("filterCashFlowDate").value;

        let filteredCashFlow = [...cashFlow];

        if (typeFilter) {
          filteredCashFlow = filteredCashFlow.filter(c => c.type === typeFilter);
        }

        if (dateFilter) {
          filteredCashFlow = filteredCashFlow.filter(c => c.date === dateFilter);
        }

        renderCashFlow(filteredCashFlow);
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

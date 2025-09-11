<?php
include "../CONFIG/config.php";


// Restrict access if not logged in
if (!isset($_SESSION["id"])) {
    header("Location: ../");
    exit();
}

// Fetch username
$id = $_SESSION["id"];
$sql = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$username = ($result->num_rows > 0) ? $result->fetch_assoc()['username'] : "Unknown";

// Fetch role name 
$role_id = $_SESSION["role_id"];
$sql = "SELECT role_name FROM role WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $role_id);
$stmt->execute();
$result = $stmt->get_result();
$role_name = ($result->num_rows > 0) ? $result->fetch_assoc()['role_name'] : "Unknown";

// Fetch emp data 
$emp_id = $_SESSION["emp_id"];
$sql = "SELECT fname, lname, email FROM emp_data WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $emp_id);
$stmt->execute();
$result = $stmt->get_result();
$emp_data = ($result->num_rows > 0) ? $result->fetch_assoc() : ["fname" => "Unknown", "lname" => "", "email" => ""];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" href="../PANEL/ASSETS/img/logo.png">
        <title>Dashboard - ImarketPH</title>
    <link rel="stylesheet" href="../PANEL/ASSETS/css/style-p.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php
    // Notification alert for message
    if (isset($_SESSION['message'])) {
        echo '<div class="notification-alert success" id="notificationAlert">'
            . htmlspecialchars($_SESSION['message']) .
            '<span class="close-alert" onclick="document.getElementById(\'notificationAlert\').style.display=\'none\'">&times;</span></div>';
        unset($_SESSION['message']);
    }
    ?>
    <div class="sidebar">
        <div class="logo-details">
            <img src="../PANEL/ASSETS/img/logo.png" alt="Logo" class="icon">
            <div class="logo_name">ImarketPH</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>

        <ul class="nav-list" style="overflow-y: auto; max-height: 80vh; scrollbar-width: none; -ms-overflow-style: none;">
            
            <!-- DASHBOARD -->
            <li>
                <a href="../PANEL/">
                    <i class="fa-solid fa-gauge"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>

            <!-- ACCOUNTS PAYABLE -->
            <?php
            // Determine if any submenu item should be shown for Accounts Payable
            $ap_visible = (
                ($role_id >= 1 && $role_id <= 3) ||
                ($role_id >= 9 && $role_id <= 11)
            );
            $ap_visible_3way = (
                ($role_id >= 1 && $role_id <= 3) || ($role_id == 9)
            );
            ?>

            <?php if ($ap_visible) : ?>
            <li>
                <a href="#">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span class="links_name">Accounts Payable</span>
                </a>
                <ul class="submenu">
                    <li style="display: <?= $ap_visible ? 'block' : 'none' ?>;">
                        <a href="../AP/vendor_invoiceM.php"><i class="fa-solid fa-file-invoice"></i> Vendor Invoice Management</a>
                    </li>
                    <li style="display: <?= $ap_visible ? 'block' : 'none' ?>;">
                        <a href="../AP/payrollM.php"><i class="fa-solid fa-users"></i> Payroll Management</a>
                    </li>
                    <li style="display: <?= $ap_visible ? 'block' : 'none' ?>;">
                        <a href="../AP/employee_reimbursement.php"><i class="fa-solid fa-user-clock"></i> Employee Reimbursement</a>
                    </li>
                    <li style="display: <?= $ap_visible_3way ? 'block' : 'none' ?>;">
                        <a href="../AP/matching.php"><i class="fa-solid fa-layer-group"></i> 3-Way Matching</a>
                    </li>
                    <li style="display: <?= $ap_visible_3way ? 'block' : 'none' ?>;">
                        <a href="../AP/payment_scheduling.php"><i class="fa-solid fa-calendar-alt"></i> Payment Scheduling</a>
                    </li>
                    <li style="display: <?= $ap_visible ? 'block' : 'none' ?>;">
                        <a href="../AP/aging.php"><i class="fa-solid fa-chart-bar"></i> AP Aging & Reports</a>
                    </li>
                </ul>
                <span class="tooltip">Accounts Payable</span>
            </li>
            <?php endif; ?>

            <!-- ACCOUNTS RECEIVABLE -->
            <?php
            // Determine visibility for Accounts Receivable submenu items
            $ar_visible_customer_invoicing = (($role_id >= 1 && $role_id <= 2) || $role_id == 4 || ($role_id >= 9 && $role_id <= 11));
            $ar_visible_gateway = (($role_id >= 1 && $role_id <= 2) || $role_id == 4 || $role_id == 7 || $role_id == 9);
            $ar_visible_cod = (($role_id >= 1 && $role_id <= 2) || $role_id == 4 || $role_id == 8 || ($role_id >= 9 && $role_id <= 11));
            $ar_visible_refunds = (($role_id >= 1 && $role_id <= 2) || $role_id == 4 || $role_id == 5 || $role_id == 7 || ($role_id >= 9 && $role_id <= 11));
            $ar_visible_aging = (($role_id >= 1 && $role_id <= 2) || $role_id == 4 || ($role_id >= 9 && $role_id <= 11));
            $ar_visible = (
                $ar_visible_customer_invoicing ||
                $ar_visible_gateway ||
                $ar_visible_cod ||
                $ar_visible_refunds ||
                $ar_visible_aging
            );
            ?>

            <?php if ($ar_visible) : ?>
            <li>
                <a href="#">
                    <i class="fa-solid fa-receipt"></i>
                    <span class="links_name">Accounts Receivable</span>
                </a>
                <ul class="submenu">
                    <li style="display: <?= $ar_visible_customer_invoicing ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-regular fa-file-lines"></i> Customer Invoicing</a>
                    </li>
                    <li style="display: <?= $ar_visible_gateway ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-credit-card"></i> Payment Gateway Integration</a>
                    </li>
                    <li style="display: <?= $ar_visible_cod ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-truck-fast"></i> COD Orders</a>
                    </li>
                    <li style="display: <?= $ar_visible_refunds ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-arrow-rotate-left"></i> Refunds & Credit Memos</a>
                    </li>
                    <li style="display: <?= $ar_visible_aging ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-chart-bar"></i> AR Aging & Reports</a>
                    </li>
                </ul>
                <span class="tooltip">Accounts Receivable</span>
            </li>
            <?php endif; ?>

            <!-- BUDGET MANAGEMENT -->
            <?php
            // Determine visibility for Budget Management submenu items
            $bm_visible_planning = (($role_id >= 1 && $role_id <= 2) || ($role_id >= 9 && $role_id <= 11));
            $bm_visible_commitment = (($role_id >= 1 && $role_id <= 4) || ($role_id >= 9 && $role_id <= 11));
            $bm_visible_variance = (($role_id >= 1 && $role_id <= 2) || ($role_id >= 9 && $role_id <= 11));
            $bm_visible_forecasting = (($role_id >= 1 && $role_id <= 2) || ($role_id >= 9 && $role_id <= 11));
            $bm_visible_tracking = (($role_id >= 1 && $role_id <= 4) || ($role_id >= 9 && $role_id <= 11));
            $bm_visible = (
                $bm_visible_planning ||
                $bm_visible_commitment ||
                $bm_visible_variance ||
                $bm_visible_forecasting ||
                $bm_visible_tracking
            );
            ?>

            <?php if ($bm_visible) : ?>
            <li>
                <a href="budget.php">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span class="links_name">Budget Management</span>
                </a>
                <ul class="submenu">
                    <li style="display: <?= $bm_visible_planning ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-calendar-plus"></i> Budget Planning</a>
                    </li>
                    <li style="display: <?= $bm_visible_commitment ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-clipboard-list"></i> Commitment Control</a>
                    </li>
                    <li style="display: <?= $bm_visible_variance ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-chart-bar"></i> Variance Analysis</a>
                    </li>
                    <li style="display: <?= $bm_visible_forecasting ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-chart-line"></i> Forecasting</a>
                    </li>
                    <li style="display: <?= $bm_visible_tracking ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-diagram-project"></i> Campaign/Project Tracking</a>
                    </li>
                </ul>
                <span class="tooltip">Budget Management</span>
            </li>
            <?php endif; ?>

            <!-- DISBURSEMENT -->
            <?php
            // Determine visibility for Disbursement submenu items
            $disb_visible_vendor = (($role_id >= 1 && $role_id <= 3) || ($role_id == 5) || ($role_id >= 9 && $role_id <= 11));
            $disb_visible_payroll = $disb_visible_vendor;
            $disb_visible_reimburse = $disb_visible_vendor;
            $disb_visible_refund = (($role_id >= 1 && $role_id <= 2) || ($role_id >= 4 && $role_id <= 5) || ($role_id >= 9 && $role_id <= 11) || $role_id == 7);
            $disb_visible_approval = (($role_id >= 1 && $role_id <= 4) || ($role_id >= 9 && $role_id <= 10));
            $disb_visible_cashflow = (($role_id >= 1 && $role_id <= 2) || ($role_id >= 9 && $role_id <= 11) || $role_id == 6);

            $disb_visible = (
                $disb_visible_vendor ||
                $disb_visible_payroll ||
                $disb_visible_reimburse ||
                $disb_visible_refund ||
                $disb_visible_approval ||
                $disb_visible_cashflow
            );
            ?>

            <?php if ($disb_visible) : ?>
            <li>
                <a href="disbursement.php">
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <span class="links_name">Disbursement</span>
                </a>
                <ul class="submenu">
                    <li style="display: <?= $disb_visible_vendor ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-money-bill-wave"></i> Vendor Payments</a>
                    </li>
                    <li style="display: <?= $disb_visible_payroll ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-users"></i> Payroll Disbursement</a>
                    </li>
                    <li style="display: <?= $disb_visible_reimburse ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-receipt"></i> Reimbursement</a>
                    </li>
                    <li style="display: <?= $disb_visible_refund ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-rotate-left"></i> Refund Processing</a>
                    </li>
                    <li style="display: <?= $disb_visible_approval ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-check-to-slot"></i> Approval Workflow</a>
                    </li>
                    <li style="display: <?= $disb_visible_cashflow ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-chart-line"></i> Cash Flow Monitoring</a>
                    </li>
                </ul>
                <span class="tooltip">Disbursement</span>
            </li>
            <?php endif; ?>

            <!-- COLLECTION -->
            <?php
            // Determine visibility for Collection submenu items
            $collection_visible_gateway = (($role_id >= 1 && $role_id <= 2) || $role_id == 4 || ($role_id >= 6 && $role_id <= 11));
            $collection_visible_cod = (($role_id >= 1 && $role_id <= 2) || $role_id == 4 || $role_id == 6 || ($role_id >= 8 && $role_id <= 11));
            $collection_visible_bank = (($role_id >= 1 && $role_id <= 2) || $role_id == 4 || $role_id == 6 || ($role_id >= 8 && $role_id <= 11));
            $collection_visible_refund = (($role_id >= 1 && $role_id <= 2) || $role_id == 4 || ($role_id >= 9 && $role_id <= 11));
            $collection_visible_cashflow = (($role_id >= 1 && $role_id <= 2) || $role_id == 4 || ($role_id >= 9 && $role_id <= 11) || $role_id == 6);

            $collection_visible = (
                $collection_visible_gateway ||
                $collection_visible_cod ||
                $collection_visible_bank ||
                $collection_visible_refund ||
                $collection_visible_cashflow
            );
            ?>

            <?php if ($collection_visible) : ?>
            <li>
                <a href="collection.php">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    <span class="links_name">Collection</span>
                </a>
                <ul class="submenu">
                    <li style="display: <?= $collection_visible_gateway ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-file-invoice"></i> Gateway Reconciliation</a>
                    </li>
                    <li style="display: <?= $collection_visible_cod ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-truck-fast"></i> COD Reconciliation</a>
                    </li>
                    <li style="display: <?= $collection_visible_bank ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-building-columns"></i> Bank Deposit Matching</a>
                    </li>
                    <li style="display: <?= $collection_visible_refund ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-arrow-rotate-left"></i> Refund Offsets</a>
                    </li>
                    <li style="display: <?= $collection_visible_cashflow ? 'block' : 'none' ?>;">
                        <a href="#"><i class="fa-solid fa-chart-line"></i> Cash Flow Reporting</a>
                    </li>
                </ul>
                <span class="tooltip">Collection</span>
            </li>
            <?php endif; ?>

            <!-- GENERAL LEDGER -->
            <?php
            // Determine visibility for General Ledger submenu items
            $gl_visible_journal = (($role_id >= 1 && $role_id <= 6) || ($role_id >= 9 && $role_id <= 11));
            $gl_visible_chart = (($role_id >= 1 && $role_id <= 2) || ($role_id >= 9 && $role_id <= 11));
            $gl_visible_recon = (($role_id >= 1 && $role_id <= 6) || ($role_id >= 8 && $role_id <= 11));
            $gl_visible_trial = (($role_id >= 1 && $role_id <= 2) || ($role_id >= 9 && $role_id <= 11));
            $gl_visible_financial = (($role_id >= 1 && $role_id <= 2) || ($role_id >= 9 && $role_id <= 11));
            $gl_visible_audit = (($role_id >= 1 && $role_id <= 2) || ($role_id >= 9 && $role_id <= 11));

            $gl_visible = (
                $gl_visible_journal ||
                $gl_visible_chart ||
                $gl_visible_recon ||
                $gl_visible_trial ||
                $gl_visible_financial ||
                $gl_visible_audit
            );
            ?>

            <?php if ($gl_visible) : ?>
            <li>
                <a href="ledger.php">
                    <i class="fa-solid fa-book"></i>
                    <span class="links_name">General Ledger</span>
                </a>
                <ul class="submenu">
                  <li style="display: <?= $gl_visible_journal ? 'block' : 'none' ?>;">
                    <a href="#"><i class="fa-solid fa-pen-to-square"></i> Journal Entry Management</a>
                  </li>
                  <li style="display: <?= $gl_visible_chart ? 'block' : 'none' ?>;">
                    <a href="#"><i class="fa-solid fa-table-list"></i> Chart of Accounts</a>
                  </li>
                  <li style="display: <?= $gl_visible_recon ? 'block' : 'none' ?>;">
                    <a href="#"><i class="fa-solid fa-scale-balanced"></i> Reconciliation Management</a>
                  </li>
                  <li style="display: <?= $gl_visible_trial ? 'block' : 'none' ?>;">
                    <a href="#"><i class="fa-solid fa-balance-scale"></i> Trial Balance</a>
                  </li>
                  <li style="display: <?= $gl_visible_financial ? 'block' : 'none' ?>;">
                    <a href="#"><i class="fa-solid fa-file-lines"></i> Financial Statements</a>
                  </li>
                  <li style="display: <?= $gl_visible_audit ? 'block' : 'none' ?>;">
                    <a href="#"><i class="fa-solid fa-clipboard-check"></i> Audit Trail</a>
                  </li>
                </ul>
                <span class="tooltip">General Ledger</span>
            </li>
            <?php endif; ?>

        </ul>

            <!-- PROFILE -->
            <li class="profile">
                <div class="profile-details">
                    <div style="width:40px; height:40px; background:transparent; display:flex; align-items:center; justify-content:center;">
                      <i class="fa-solid fa-user" style="color:#fff; font-size:22px;"></i>
                    </div>
                    <div class="name_job">
                        <div class="name"><?= htmlspecialchars($emp_data['fname'] . ' ' . $emp_data['lname']) ?></div>
                        <div class="job"><?= htmlspecialchars($role_name) ?></div>
                    </div>
                </div>
                <a href="../CONFIG/logout.php"><i class='bx bx-log-out' id="log_out"></i></a>
            </li>
        </div>

        <!-- TOPBAR -->
    <div class="topbar">
        <div class="toggle-btn">
        </div>
        <div class="topbar-actions"><div id="ph-time" class="time-date"></div>
            <!-- Notification Bell with Dropdown -->
            <div class="dropdown">
                <i class="fa-solid fa-bell"></i>
                <span class="notification-badge">3</span>
                <div class="dropdown-content">
                    <div class="dropdown-header">
                        <span>Notifications</span>
                        <a href="#">Mark all as read</a>
                    </div>
                    <div class="dropdown-list">
                        <div class="dropdown-item info">
                            <i class="fas fa-info-circle"></i>
                            <div class="dropdown-item-content">
                                <div class="dropdown-item-title">System Update</div>
                                <div class="dropdown-item-desc">Scheduled maintenance tonight at 11 PM</div>
                                <div class="dropdown-item-time">10 minutes ago</div>
                            </div>
                        </div>
                        <div class="dropdown-item success">
                            <i class="fas fa-check-circle"></i>
                            <div class="dropdown-item-content">
                                <div class="dropdown-item-title">Payment Processed</div>
                                <div class="dropdown-item-desc">Vendor payment was successfully processed</div>
                                <div class="dropdown-item-time">2 hours ago</div>
                            </div>
                        </div>
                        <div class="dropdown-item warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div class="dropdown-item-content">
                                <div class="dropdown-item-title">Approval Needed</div>
                                <div class="dropdown-item-desc">3 invoices require your approval</div>
                                <div class="dropdown-item-time">5 hours ago</div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-footer">
                        <a href="#">View all notifications</a>
                    </div>
                </div>
            </div>
            
            <!-- Inbox Envelope with Dropdown -->
            <div class="dropdown">
                <i class="fa-solid fa-envelope"></i>
                <span class="notification-badge">5</span>
                <div class="dropdown-content">
                    <div class="dropdown-header">
                        <span>Messages</span>
                        <a href="#">Mark all as read</a>
                    </div>
                    <div class="dropdown-list">
                        <div class="dropdown-item">
                            <i class="fas fa-envelope"></i>
                            <div class="dropdown-item-content">
                                <div class="dropdown-item-title">Maria Santos</div>
                                <div class="dropdown-item-desc">Regarding the quarterly budget report</div>
                                <div class="dropdown-item-time">Yesterday</div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <i class="fas fa-envelope"></i>
                            <div class="dropdown-item-content">
                                <div class="dropdown-item-title">Juan Dela Cruz</div>
                                <div class="dropdown-item-desc">Payment inquiry for invoice #INV-2023-0456</div>
                                <div class="dropdown-item-time">2 days ago</div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <i class="fas fa-envelope"></i>
                            <div class="dropdown-item-content">
                                <div class="dropdown-item-title">Finance Team</div>
                                <div class="dropdown-item-desc">Meeting reminder: Budget review tomorrow</div>
                                <div class="dropdown-item-time">3 days ago</div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-footer">
                        <a href="#">View all messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Logout Confirmation Modal -->
<div id="logoutModal" class="modal-overlay">
  <div class="modal-box">
    <h3>Do you want to logout?</h3>
    <div class="modal-actions">
        <button id="confirmLogout" class="btn-yes"><i class="fas fa-sign-out-alt"></i> Yes</button>
        <button id="cancelLogout" class="btn-no"><i class="fas fa-times"></i> No</button>
    </div>
  </div>
</div>

<!-- Idle Warning Modal -->
<div id="idleModal" class="modal-overlay" style="display:none;">
  <div class="modal-box">
    <h3>⚠️ Are you still there?</h3>
    <p>You’ve been inactive.<br>Auto logout in <span id="countdown">60</span> seconds.</p>
    <div class="modal-actions">
      <button id="continueSession" class="btn-yes"><i class="fas fa-play"></i> Continue</button>
      <button id="cancelSession" class="btn-no"><i class="fas fa-sign-out-alt"></i> Logout</button>
    </div>
  </div>
</div>


<script src="ASSETS/js/script-p.js"></script>
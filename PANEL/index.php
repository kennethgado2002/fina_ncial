<?php
session_start();
include "../CONFIG/config.php";


// Restrict access if not logged in
if (!isset($_SESSION["id"])) {
    header("Location: ../index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image" href="ASSETS/img/logo.png">
    <link rel="stylesheet" href="ASSETS/css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .nav-list::-webkit-scrollbar { display: none; }

        /* Dropdown submenu styles */
        /* Dropdown submenu styles */
.submenu {
    display: none;
    flex-direction: column;
    margin-left: 45px;
}
.submenu li {
    margin: 1px 0;
}
.submenu li a {
    background: rgba(0, 10, 100, 0.2); /* #000a64 with 20% opacity */
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff; /* 🔥 White text color */
    
    border-radius: 6px;
    transition: 0.3s;
}
.submenu li a:hover {
    background: #fff;
    color: #11101d; /* Dark text on hover */
}

        .nav-list li.open > .submenu { display: flex; }
        .nav-list li .dropdown-icon {
            margin-left: auto;
            transition: transform 0.3s;
        }
        .nav-list li.open .dropdown-icon { transform: rotate(90deg); }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="ASSETS/img/logo.png" alt="Logo" class="icon">
            <div class="logo_name">ImarketPH</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>

        <ul class="nav-list" style="overflow-y: auto; max-height: 80vh; scrollbar-width: none; -ms-overflow-style: none;">
            
            <!-- DASHBOARD -->
            <li>
                <a href="Dashboard.html">
                    <i class="fa-solid fa-gauge"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>



            <!-- DISBURSEMENT -->
            <li>
                <a href="disbursement.php">
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <span class="links_name">Disbursement</span>
                    
                </a>
                <ul class="submenu">
                    <li><a href="#"><i class="fa-solid fa-calendar-check"></i> Batch Payment Scheduling</a></li>
                    <li><a href="#"><i class="fa-solid fa-landmark"></i> Bank Rail Selection</a></li>
                    <li><a href="#"><i class="fa-solid fa-user-check"></i> Maker-Checker Flow</a></li>
                    <li><a href="#"><i class="fa-solid fa-file-invoice"></i> Reconciliation</a></li>
                </ul>
                <span class="tooltip">Disbursement</span>
            </li>

            <!-- BUDGET -->
            <li>
                <a href="budget.php">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span class="links_name">Budget Management</span>
                      
                </a>
                <ul class="submenu">
                    <li><a href="#"><i class="fa-solid fa-file-circle-plus"></i> Budget Creation</a></li>
                    <li><a href="#"><i class="fa-solid fa-check-double"></i> Spend Validation</a></li>
                    <li><a href="#"><i class="fa-solid fa-rotate"></i> Reallocation</a></li>
                    <li><a href="#"><i class="fa-solid fa-chart-line"></i> Variance Tracking</a></li>
                </ul>
                <span class="tooltip">Budget Management</span>
            </li>

            <!-- COLLECTION -->
            <li>
                <a href="collection.php">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    <span class="links_name">Collection</span>
                    
                </a>
                <ul class="submenu">
                    <li><a href="#"><i class="fa-solid fa-envelope-open-text"></i> Dunning Workflows</a></li>
                    <li><a href="#"><i class="fa-solid fa-handshake"></i> Promise-to-Pay Tracking</a></li>
                    <li><a href="#"><i class="fa-solid fa-arrow-trend-up"></i> Escalation Rules</a></li>
                    <li><a href="#"><i class="fa-solid fa-chart-bar"></i> Recovery Analytics</a></li>
                </ul>
                <span class="tooltip">Collection</span>
            </li>

            <!-- GENERAL LEDGER -->
            <li>
                <a href="ledger.php">
                    <i class="fa-solid fa-book"></i>
                    <span class="links_name">General Ledger</span>
                    
                </a>
                <ul class="submenu">
                    <li><a href="#"><i class="fa-solid fa-pen-to-square"></i> Journal Entry Management</a></li>
                    <li><a href="#"><i class="fa-solid fa-diagram-project"></i> Subledger Mapping</a></li>
                    <li><a href="#"><i class="fa-solid fa-scale-balanced"></i> Trial Balance & Reports</a></li>
                    <li><a href="#"><i class="fa-solid fa-clipboard-check"></i> Audit Logs</a></li>
                </ul>
                <span class="tooltip">General Ledger</span>
            </li>

            <!-- ACCOUNTS PAYABLE -->
<li>
    <a href="#">
        <i class="fa-solid fa-file-invoice-dollar"></i>
        <span class="links_name">Accounts Payable</span>
    </a>
    <ul class="submenu">
        <li><a href="#"><i class="fa-solid fa-file-import"></i> Vendor Invoice Mgmt</a></li>
        <li><a href="#"><i class="fa-solid fa-cart-flatbed"></i> 3-Way Matching</a></li>
        <li><a href="#"><i class="fa-solid fa-route"></i> Payment Scheduling</a></li>
        <li><a href="#"><i class="fa-solid fa-hourglass-half"></i> AP Aging & Reports</a></li>
    </ul>
    <span class="tooltip">Accounts Payable</span>
</li>

<!-- ACCOUNTS RECEIVABLE -->
<li>
    <a href="#">
        <i class="fa-solid fa-receipt"></i>
        <span class="links_name">Accounts Receivable</span>
    </a>
    <ul class="submenu">
        <li><a href="#"><i class="fa-solid fa-file-circle-check"></i> Customer Invoicing</a></li>
        <li><a href="#"><i class="fa-solid fa-credit-card"></i> Payment Gateway Integration</a></li>
        <li><a href="#"><i class="fa-solid fa-truck"></i> COD Orders</a></li>
        <li><a href="#"><i class="fa-solid fa-rotate-left"></i> Refunds & Credit Memos</a></li>
        <li><a href="#"><i class="fa-solid fa-repeat"></i> Subscription Billing</a></li>
    </ul>
    <span class="tooltip">Accounts Receivable</span>
</li>

        </ul>

        <!-- PROFILE -->
        <li class="profile">
            <div class="profile-details">
                <img src="ASSETS/img/profile.jpg" alt="profileImg">
                <div class="name_job">
                    <div class="name">Mampusti</div>
                    <div class="job">Admin</div>
                </div>
            </div>
            <a href="../SETTINGS/logout.php"><i class='bx bx-log-out' id="log_out"></i></a>
        </li>
    </div>



<!-- TOPBAR -->
<div class="topbar">
    <div class="toggle-btn">
        <!-- pwede mo lagyan ng hamburger menu dito -->
    </div>

    <div class="topbar-actions">
        <div id="ph-time" class="time-date"></div>
        <i class="fa-solid fa-bell"></i>
        <i class="fa-solid fa-envelope"></i>
    </div>
</div>

<!-- Script for Time -->
<script>
    function updatePhilippinesTime() {
        const options = {
            timeZone: "Asia/Manila",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
            year: "numeric",
            month: "long",
            day: "numeric"
        };

        const now = new Date().toLocaleString("en-PH", options);
        document.getElementById("ph-time").innerHTML = now;
    }

    setInterval(updatePhilippinesTime, 1000);
    updatePhilippinesTime();
</script>






<!-- DASHBOARD MAIN CONTENT -->
<div class="home-section">
  <div class="text">Dashboard</div>

  <!-- Cards Section -->
  <div class="cards-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; padding: 20px;">
    <!-- Disbursement -->
    <div class="card" style="background:#fff; border-radius: 12px; padding:20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
      <i class="fa-solid fa-money-check-dollar" style="font-size:28px; color:#013583;"></i>
      <h3 style="margin-top:10px;">₱125,000</h3>
      <p>Total Disbursed</p>
    </div>
    <!-- Budget -->
    <div class="card" style="background:#fff; border-radius: 12px; padding:20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
      <i class="fa-solid fa-chart-pie" style="font-size:28px; color:#2a9d8f;"></i>
      <h3 style="margin-top:10px;">₱300,000</h3>
      <p>Budget Allocated</p>
    </div>
    <!-- Collection -->
    <div class="card" style="background:#fff; border-radius: 12px; padding:20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
      <i class="fa-solid fa-hand-holding-dollar" style="font-size:28px; color:#f4a261;"></i>
      <h3 style="margin-top:10px;">₱98,000</h3>
      <p>Total Collected</p>
    </div>
    <!-- Accounts Payable -->
    <div class="card" style="background:#fff; border-radius: 12px; padding:20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
      <i class="fa-solid fa-file-invoice-dollar" style="font-size:28px; color:#e76f51;"></i>
      <h3 style="margin-top:10px;">45</h3>
      <p>Pending AP Invoices</p>
    </div>
    <!-- Accounts Receivable -->
    <div class="card" style="background:#fff; border-radius: 12px; padding:20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
      <i class="fa-solid fa-receipt" style="font-size:28px; color:#264653;"></i>
      <h3 style="margin-top:10px;">72</h3>
      <p>Open AR Invoices</p>
    </div>
  </div>

  <!-- Recent Activity Table -->
  <div style="padding:20px;">
    <h3 style="margin-bottom:15px;">Recent Transactions</h3>
    <table style="width:100%; border-collapse:collapse; background:#fff; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
      <thead style="background:#013583; color:#fff;">
        <tr>
          <th style="text-align:left; padding:12px;">Date</th>
          <th style="text-align:left; padding:12px;">Module</th>
          <th style="text-align:left; padding:12px;">Description</th>
          <th style="text-align:left; padding:12px;">Amount</th>
          <th style="text-align:left; padding:12px;">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="padding:12px; border-bottom:1px solid #eee;">2025-08-25</td>
          <td style="padding:12px; border-bottom:1px solid #eee;">Disbursement</td>
          <td style="padding:12px; border-bottom:1px solid #eee;">Supplier Payment</td>
          <td style="padding:12px; border-bottom:1px solid #eee;">₱25,000</td>
          <td style="padding:12px; border-bottom:1px solid #eee; color:green;">Completed</td>
        </tr>
        <tr>
          <td style="padding:12px; border-bottom:1px solid #eee;">2025-08-26</td>
          <td style="padding:12px; border-bottom:1px solid #eee;">Collection</td>
          <td style="padding:12px; border-bottom:1px solid #eee;">Client Payment</td>
          <td style="padding:12px; border-bottom:1px solid #eee;">₱10,000</td>
          <td style="padding:12px; border-bottom:1px solid #eee; color:blue;">Pending</td>
        </tr>
        <tr>
          <td style="padding:12px; border-bottom:1px solid #eee;">2025-08-27</td>
          <td style="padding:12px; border-bottom:1px solid #eee;">AP</td>
          <td style="padding:12px; border-bottom:1px solid #eee;">Invoice #4567</td>
          <td style="padding:12px; border-bottom:1px solid #eee;">₱12,500</td>
          <td style="padding:12px; border-bottom:1px solid #eee; color:orange;">In Review</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Small Chart Section -->
  <div style="padding:20px; text-align:center;">
    <h3 style="margin-bottom:15px;">Financial Overview</h3>
    <div style="width:350px; height:220px; margin:auto;">
      <canvas id="myChart"></canvas>
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
    <p>You’ve been inactive.<br>Auto logout in <span id="countdown">30</span> seconds.</p>
    <div class="modal-actions">
      <button id="continueSession" class="btn-yes"><i class="fas fa-play"></i> Continue</button>
      <button id="cancelSession" class="btn-no"><i class="fas fa-sign-out-alt"></i> Logout</button>
    </div>
  </div>
</div>


<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Disbursement', 'Budget', 'Collection', 'AP', 'AR'],
      datasets: [{
        label: 'Amount (₱)',
        data: [125000, 300000, 98000, 45000, 72000],
        backgroundColor: ['#013583', '#2a9d8f', '#f4a261', '#e76f51', '#264653']
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
</script>



    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let dropdownLinks = document.querySelectorAll(".nav-list > li > a");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });

        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
            }
        }

        // Dropdown toggle
        dropdownLinks.forEach(link => {
            link.addEventListener("click", (e) => {
                let parentLi = link.parentElement;
                if (parentLi.querySelector(".submenu")) {
                    e.preventDefault();
                    parentLi.classList.toggle("open");
                }
            });
        });
    </script>

    <script>
        // Logout confirmation modal
const logoutBtn = document.querySelector("#log_out");
const logoutModal = document.getElementById("logoutModal");
const confirmLogout = document.getElementById("confirmLogout");
const cancelLogout = document.getElementById("cancelLogout");

logoutBtn.addEventListener("click", function(e) {
  e.preventDefault(); // huwag agad mag logout
  logoutModal.style.display = "flex"; // show modal
});

cancelLogout.addEventListener("click", function() {
  logoutModal.style.display = "none"; // close modal
});

confirmLogout.addEventListener("click", function() {
  window.location.href = "../SETTINGS/logout.php"; // tuloy logout
});

    </script>

    <script>
  let idleTimer;         
  let countdownTimer;    
  let countdown = 30;    
  const idleLimit = 30000; // 30s idle bago lumabas modal
  const idleModal = document.getElementById("idleModal");
  const countdownEl = document.getElementById("countdown");
  const continueBtn = document.getElementById("continueSession");
  const cancelBtn = document.getElementById("cancelSession");

  function startIdleTimer() {
    clearTimeout(idleTimer);
    idleTimer = setTimeout(showIdleModal, idleLimit);
  }

  function showIdleModal() {
    idleModal.style.display = "flex";
    countdown = 30;
    countdownEl.textContent = countdown;

    countdownTimer = setInterval(() => {
      countdown--;
      countdownEl.textContent = countdown;
      if (countdown <= 0) {
        clearInterval(countdownTimer);
        window.location.href = "../SETTINGS/logout.php"; // auto logout
      }
    }, 1000);
  }

  // Reset idle timer kapag active pa (pero wag patayin modal pag andun na)
  function activityHandler() {
    if (idleModal.style.display !== "flex") {
      startIdleTimer();
    }
  }

  window.onload = startIdleTimer;
  document.onmousemove = activityHandler;
  document.onkeypress = activityHandler;
  document.onclick = activityHandler;
  document.onscroll = activityHandler;

  // Continue session (dito lang mawawala modal + reset timer)
  continueBtn.addEventListener("click", () => {
    clearInterval(countdownTimer);
    idleModal.style.display = "none";
    startIdleTimer(); 
  });

  // Cancel session = logout agad
  cancelBtn.addEventListener("click", () => {
    window.location.href = "../SETTINGS/logout.php";
  });
</script>
</body>
</html>

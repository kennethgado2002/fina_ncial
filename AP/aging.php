<?php
session_start();
include "../PANEL/panel.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<style>
    body {
      font-family: Arial, sans-serif;
      background: #f7f9fb;
      margin: 0;
      padding: 0;
      color: #0f172a;
    }
    header {
      background: #2c3c8c;
      color: #fff;
      padding: 15px;
      font-size: 1.4em;
      text-align: center;
      font-weight: bold;
      box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    }
    .container {
      padding: 20px;
    }

    /* Dashboard Top Section (Buckets + Chart) */
    .dashboard-top {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 30px;
    }

    /* Aging Buckets */
    .aging-buckets {
      flex: 1;
      display: grid;
      gap: 15px;
    }
    .bucket {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      text-align: center;
      font-size: 1.1em;
      font-weight: bold;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
      transition: 0.3s;
    }
    .bucket:hover {
      transform: scale(1.05);
    }
    .current { background: #81c784; color: #fff; }
    .days30 { background: #ffb74d; color: #fff; }
    .days60 { background: #ef5350; color: #fff; }
    .days90 { background: #6a1b9a; color: #fff; }

    /* Chart Section */
    .chart-section {
      flex: 2;
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }
    .chart-wrapper {
      width: 100%;
      max-width: 500px;
      height: 300px;
      margin: 0 auto;
    }
    .chart-wrapper canvas {
      width: 100% !important;
      height: 100% !important;
    }
    .chart-actions {
      text-align: right;
      margin-bottom: 10px;
    }
    .chart-actions button {
      padding: 8px 14px;
      margin-left: 5px;
      border: none;
      border-radius: 6px;
      background: #2c3c8c;
      color: #fff;
      cursor: pointer;
      transition: 0.3s;
    }
    .chart-actions button:hover {
      background: #0f172a;
      transform: scale(1.05);
    }

    /* Table */
    .table-wrapper {
      overflow-x: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background: #0f172a;
      color: #fff;
    }
    tr:hover {
      background: #f1f5ff;
      transition: 0.3s;
    }

    /* Status Tag */
    .status-tag {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 0.9em;
      font-weight: bold;
    }

    /* Header with Export */
    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 30px;
      margin-bottom: 10px;
    }
    .section-header h2 {
      margin: 0;
      color: #2c3c8c;
    }
    .export-buttons button {
      padding: 10px 16px;
      margin-left: 10px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      background: #2c3c8c;
      color: #fff;
      transition: 0.3s;
    }
    .export-buttons button:hover {
      background: #0f172a;
      transform: scale(1.05);
    }
  </style>
<body>

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

<!-- DASHBOARD MAIN CONTENT -->
<div class="home-section">
  <div class="text">Dashboard</div>
    <div class="container">

    <!-- Dashboard Top -->
    <div class="dashboard-top">

      <!-- Aging Buckets -->
      <div class="aging-buckets">
        <div class="bucket current">Current<br>$25,000</div>
        <div class="bucket days30">30 Days<br>$12,500</div>
        <div class="bucket days60">60 Days<br>$8,300</div>
        <div class="bucket days90">90+ Days<br>$5,000</div>
      </div>

      <!-- Charts -->
      <div class="chart-section">
        <div class="chart-actions">
          <button onclick="showChart('pie')">Pie Chart</button>
          <button onclick="showChart('bar')">Bar Chart</button>
        </div>
        <div class="chart-wrapper">
          <canvas id="apChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Invoice Aging List -->
    <div class="section-header">
      <h2>Invoice Aging List</h2>
      <div class="export-buttons">
        <button onclick="exportReport('pdf')">Export PDF</button>
        <button onclick="exportReport('excel')">Export Excel</button>
      </div>
    </div>

    <div class="table-wrapper">
      <table id="agingTable">
        <thead>
          <tr>
            <th>Vendor</th><th>Invoice #</th><th>Amount</th>
            <th>Due Date</th><th>Days Past Due</th><th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>XYZ Traders</td><td>INV-101</td><td>$5,000</td>
            <td>2025-08-01</td><td>34</td>
            <td><span class="status-tag days30">30 Days</span></td>
          </tr>
          <tr>
            <td>ABC Supplies</td><td>INV-202</td><td>$3,200</td>
            <td>2025-09-01</td><td>0</td>
            <td><span class="status-tag current">Current</span></td>
          </tr>
          <tr>
            <td>Metro Hardware</td><td>INV-303</td><td>$2,500</td>
            <td>2025-06-20</td><td>75</td>
            <td><span class="status-tag days60">60 Days</span></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>

  <script>
    let chartType = 'pie';
    let chart;
    const ctx = document.getElementById('apChart').getContext('2d');

    const data = {
      labels: ['XYZ Traders', 'ABC Supplies', 'Metro Hardware'],
      datasets: [{
        data: [5000, 3200, 2500],
        backgroundColor: ['#81c784','#ffb74d','#ef5350'],
      }]
    };

    function renderChart(type) {
      if(chart) chart.destroy();
      chart = new Chart(ctx, {
        type: type,
        data: data,
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { position: 'bottom' }
          }
        }
      });
    }
    function showChart(type) {
      chartType = type;
      renderChart(type);
    }
    renderChart(chartType);

    function exportReport(format) {
      alert("Exporting report as " + format.toUpperCase() + "...");
      // Future: backend integration for PDF/Excel export
    }
  </script>

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


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../PANEL/ASSETS/js/script_p.js"></script>
</body>
</html>

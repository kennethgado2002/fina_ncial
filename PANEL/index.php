<?php
session_start();
include "panel.php";
?>

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

</body>
</html>

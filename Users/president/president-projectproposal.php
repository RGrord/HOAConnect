<?php
session_start();
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
error_reporting(E_ALL);

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>HOAConnect - Resolution</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>
  [x-cloak] {
    display: none !important;
  }
</style>
</head>
<body class="bg-gray-50">

<div class="min-h-screen flex">

  <!-- Sidebar -->
  <div class="bg-teal-800 text-white w-64 py-6 flex flex-col">
    <div class="px-6 mb-8">
      <h1 class="text-2xl font-bold">HOAConnect</h1>
      <p class="text-sm text-teal-200">Mabuhay Homes 2000</p>
    </div>
    <nav class="flex-1">
      <a href="president-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-tachometer-alt mr-3"></i><span>Dashboard</span>
      </a>
      <a href="president-accounts.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-user-gear mr-3"></i><span>Admin Management</span>
      </a>
      <a href="registered-homeowners.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-home mr-3"></i><span>Homeowners</span>
      </a>
      <a href="president-feetype.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-money-check mr-3"></i><span>Fee Type</span>
      </a>
      <a href="president-projectproposal.php" class="flex items-center px-6 py-3 bg-teal-700">
        <i class="fas fa-gavel mr-3"></i><span>Resolution</span>
      </a>
      <a href="president-liquidation.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-file-invoice-dollar mr-3"></i><span>Liquidation of Expenses</span>
      </a>
      <a href="president-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-book mr-3"></i><span>Ledger</span>
      </a>
      <a href="president-remittance.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-money-check mr-3"></i><span>Remittance</span>
      </a>
      <a href="president-payment-history.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-receipt mr-3"></i><span>Payment History</span>
      </a>
      <!-- Amenities dropdown -->
      <div x-data="{ open: false }">
        <button @click="open = !open" :aria-expanded="open" class="flex items-center w-full px-6 py-3 hover:bg-teal-600 focus:outline-none">
          <i class="fas fa-swimming-pool mr-3"></i><span class="flex-1 text-left">Amenities</span>
          <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="open" x-cloak class="bg-teal-800 text-sm">
          <button @click="window.location.href='president-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
            <i class="fas fa-bicycle mr-2"></i><span class="flex-1 text-left">Tricycle</span>
          </button>
          <button @click="window.location.href='president-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
            <i class="fas fa-basketball-ball mr-2"></i><span class="flex-1 text-left">Court</span>
          </button>
          <button @click="window.location.href='president-stall.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
            <i class="fas fa-store mr-2"></i><span class="flex-1 text-left">Stall</span>
          </button>
        </div>
      </div>
      <a href="president-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-newspaper mr-3"></i><span>News Feed</span>
      </a>
      <a href="president-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-calendar-alt mr-3"></i><span>Calendar</span>
      </a>
      <a href="president-logs.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-history mr-3"></i><span>Activity Logs</span>
      </a>
      <a href="president-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-user-circle mr-3"></i><span>Profile</span>
      </a>
    </nav>
    <div class="px-6 py-4 mt-auto">
      <button class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded flex items-center justify-center">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </button>
    </div>
  </div>
  <!-- End Sidebar -->

  <!-- Main Content -->
  <div class="flex-1 p-6 bg-gray-50">
    <h1 class="text-2xl font-bold mb-4">Resolution List</h1>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200">
        <thead class="bg-teal-800 text-white">
          <tr>
            <th class="px-4 py-2">Particulars</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Project Details</th>
            <th class="px-4 py-2">Budget Released</th>
            <th class="px-4 py-2">Financial Summary</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query_resolution = "SELECT * FROM resolution";
          $run_resolution = mysqli_query($conn, $query_resolution);

          if (mysqli_num_rows($run_resolution) > 0) {
              while($row_resolution = mysqli_fetch_assoc($run_resolution)){
          ?>
          <tr class="border-b border-gray-200 hover:bg-gray-100">
            <td class="px-4 py-2"><?php echo $row_resolution['project_resolution_title']; ?></td>
            <td class="px-4 py-2">
              <?php
              $status = $row_resolution['status'];
              $status_labels = [
                  0 => ['label' => 'Pending',  'color' => '#f1c40f'],
                  1 => ['label' => 'Approved', 'color' => '#2ecc71'],
                  2 => ['label' => 'Rejected', 'color' => '#e74c3c'],
                  3 => ['label' => 'On Going', 'color' => '#3498db'],
              ];
              if (isset($status_labels[$status])) {
                  echo "<span style='background: {$status_labels[$status]['color']}; color: #fff; padding:5px 10px; border-radius:5px; font-size:12px;'>{$status_labels[$status]['label']}</span>";
              } else {
                  echo "<span style='color:#7f8c8d;'>Unknown</span>";
              }
              ?>
            </td>
            <td class="px-4 py-2">
              <a href="president-project-details.php?id=<?php echo $row_resolution['id']?>" class="text-blue-600 hover:underline">Project Details</a>
            </td>
            <td class="px-4 py-2">
              <?php 
              if (!empty($row_resolution['is_budget_released']) && $row_resolution['is_budget_released'] == 1) {
                  echo '<a href="president-budget-release.php?id=' . $row_resolution['id'] . '" class="text-blue-600 hover:underline">Budget Release</a>';
              }
              ?>
            </td>
            <td class="px-4 py-2">
              <?php 
              if (!empty($row_resolution['has_financial_summary']) && $row_resolution['has_financial_summary'] == 1) {
                  echo '<a href="president-financial-summary.php?id=' . $row_resolution['id'] . '" class="text-blue-600 hover:underline">Financial Summary</a>';
              }
              ?>
            </td>
          </tr>
          <?php
              }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- End Main Content -->

</div>
</body>
</html>

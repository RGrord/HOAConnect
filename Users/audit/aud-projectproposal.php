<?php
session_start();
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
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
      <a href="aud-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
        <i class="fas fa-tachometer-alt mr-3"></i>
        <span>Dashboard</span>
      </a>
      <a href="aud-liquidation.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-file-invoice-dollar mr-3"></i>
        <span>Liquidation of Expenses</span>
      </a>
      <a href="aud-projectproposal.php" class="flex items-center px-6 py-3 bg-teal-700">
        <i class="fas fa-gavel mr-3"></i>
        <span>Resolution</span>
      </a>
      <a href="aud-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
        <i class="fas fa-newspaper mr-3"></i>
        <span>News Feed</span>
      </a>
      <a href="aud-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-book mr-3"></i>
        <span>Ledger</span>
      </a>
      <a href="aud-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
        <i class="fas fa-calendar-alt mr-3"></i>
        <span>Calendar</span>
      </a>
      <a href="aud-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
        <i class="fas fa-user-circle mr-3"></i>
        <span>Profile</span>
      </a>
    </nav>
    <div class="px-6 py-4 mt-auto">
      <button class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded flex items-center justify-center">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="flex-1 overflow-x-hidden overflow-y-auto">
    <header class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
          <h1 class="text-2xl font-bold text-gray-900">Project and Financial Resolution</h1>
          <div class="flex items-center space-x-2">
            <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
              <i class="fas fa-bell"></i>
            </button>
          </div>
        </div>
  </header>

  <?php

    $query_resolution = "SELECT * FROM resolution";
    $run_resolution = mysqli_query($conn,$query_resolution);

    if(mysqli_num_rows($run_resolution) > 0){
      foreach($run_resolution as $row_resolution){
        ?>
          <table>
            <thead>
              <tr>
                <th>Particulars</th>
                <th>Status</th>
                <th>Project Details</th>
                <th>Budget Released</th>
                <th>Financial Summary</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $row_resolution['project_resolution_title']?></td>
                <td>
                    <?php
                    $status = $row_resolution['status'];

                    // Map status codes to labels + colors
                    $status_labels = [
                        0 => ['label' => 'Pending',  'color' => '#f1c40f'],   // Yellow
                        1 => ['label' => 'Approved', 'color' => '#2ecc71'],   // Green
                        2 => ['label' => 'Rejected', 'color' => '#e74c3c'],   // Red
                        3 => ['label' => 'On Going', 'color' => '#3498db'],   // Blue
                    ];

                    if (isset($status_labels[$status])) {
                        echo "<span style='
                            background: {$status_labels[$status]['color']};
                            color: #fff;
                            padding: 5px 10px;
                            border-radius: 5px;
                            font-size: 12px;
                        '>{$status_labels[$status]['label']}</span>";
                    } else {
                        echo "<span style='color:#7f8c8d;'>Unknown</span>";
                    }
                    ?>
                </td>

                <td>
                  <a href="aud-project-details.php?id=<?php echo $row_resolution['id']?>">Project Details</a>
                </td>
                <td>
                    <?php 
                        if (!empty($row_resolution['is_budget_released']) && $row_resolution['is_budget_released'] == 1) {
                            echo '<a href="aud-budget-release.php?id=' . $row_resolution['id'] . '">Budget Release</a>';
                        }
                    ?>
                </td>
                <td>
                    <?php 
                        if (!empty($row_resolution['has_financial_summary']) && $row_resolution['has_financial_summary'] == 1) {
                            echo '<a href="aud-financial-summary.php?id=' . $row_resolution['id'] . '">Financial Summary</a>';
                        }
                    ?>
                </td>
              </tr>
            </tbody>
          </table>


        <?php 
      }
    }


    ?>

</body>
</html>

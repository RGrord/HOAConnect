<?php
session_start();
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - President Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <!-- Added jsPDF autotable plugin for table PDF generation -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
  <style>
    /* Minimal styles for the card and modal */
    .payment-details p {
      margin-bottom: 8px;
    }
    .payment-details label {
      font-weight: 500;
      color: #374151;
    }
    .payment-details span {
      color: #1f2937;
    }
    .payment-card {
      border: 2px solid #14b8a6; /* Teal-500 border */
      background-color: #ccfbf1; /* Teal-50 background */
      border-radius: 4px;
      padding: 16px;
      margin-bottom: 16px;
    }
    .modal-content {
      background-color: white;
      border-radius: 8px;
      width: 100%;
      max-width: 900px; /* Increased max-width for table */
      max-height: 90vh; /* Increased max-height */
      overflow: hidden; /* Changed to hidden, inner div will scroll */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
    }
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px 24px;
      border-bottom: 1px solid #e5e7eb;
    }
    .modal-header h3 {
      font-size: 18px;
      font-weight: 600;
      color: #1f2937;
      padding-left: 16px; /* Added left padding */
    }
    .modal-header button {
      color: #6b7280;
      font-size: 18px;
      padding-right: 16px; /* Added right padding */
    }
    .modal-body {
      padding: 24px;
      flex-grow: 1;
      overflow-y: auto; /* Make body scrollable */
    }
    /* Excel-like table styles */
    .excel-table {
      border-collapse: collapse;
      width: 100%;
      font-size: 12px;
    }
    .excel-table th,
    .excel-table td {
      border: 1px solid #d1d5db;
      padding: 8px;
      text-align: left;
    }
    .excel-table th {
      background-color: #f3f4f6;
      font-weight: bold;
    }
    .excel-table tr:nth-child(even) {
      background-color: #f9fafb;
    }
    .modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 8px;
      padding: 16px 24px;
      border-top: 1px solid #e5e7eb;
    }
    .modal-footer button {
      padding: 8px 16px;
      font-size: 14px;
      font-weight: 500;
      border-radius: 4px;
      transition: background-color 0.2s;
    }
    .modal-footer .close-btn {
      background-color: white;
      border: 1px solid #d1d5db;
      color: #374151;
    }
    .modal-footer .close-btn:hover {
      background-color: #f3f4f6;
    }
    .modal-footer .download-btn,
    .modal-footer .print-btn {
      background-color: #14b8a6;
      border: none;
      color: white;
    }
    .modal-footer .download-btn:hover,
    .modal-footer .print-btn:hover {
      background-color: #0d9488;
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
            <i class="fas fa-tachometer-alt mr-3"></i>
            <span>Dashboard</span>
          </a>
          <a href="president-accounts.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-user-gear mr-3"></i>
            <span>Admin Management</span>
          </a>
          <a href="registered-homeowners.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-home mr-3"></i>
            <span>Homeowners</span>
          </a>
          <a href="president-feetype.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-money-check mr-3"></i>
            <span>Fee Type</span>
          </a>
          <a href="president-projectproposal.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-gavel mr-3"></i>
            <span>Resolution</span>
          </a>
          <a href="president-liquidation.php" class="flex items-center px-6 py-3 bg-teal-700">
            <i class="fas fa-file-invoice-dollar mr-3"></i>
            <span>Liquidation of Expenses</span>
          </a>
          <a href="president-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-book mr-3"></i>
            <span>Ledger</span>
          </a>
          <a href="president-remittance.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-money-check mr-3"></i>
            <span>Remittance</span>
          </a>
          <a href="president-payment-history.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-receipt mr-3"></i>
            <span>Payment History</span>
          </a>
          <!-- Amenities Dropdown -->
          <div x-data="{ open: false }">
            <button @click="open = !open" :aria-expanded="open" class="flex items-center w-full px-6 py-3 hover:bg-teal-600 focus:outline-none">
              <i class="fas fa-swimming-pool mr-3"></i>
              <span class="flex-1 text-left">Amenities</span>
              <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div x-show="open" x-cloak class="bg-teal-800 text-sm">
              <!-- Tricycle Navigation -->
              <div class="relative">
                <button @click="window.location.href='president-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
                  <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
                  <span class="flex-1 text-left">Tricycle</span>
                </button>
              </div>
  
              <!-- Court Navigation -->
              <div class="relative">
                <button @click="window.location.href='president-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
                  <i class="fas fa-basketball-ball mr-2" title="Court"></i>
                  <span class="flex-1 text-left">Court</span>
                </button>
              </div>
  
              <!-- Stall Navigation -->
              <div class="relative">
                <button @click="window.location.href='president-stall.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
                  <i class="fas fa-store mr-2" title="Stall"></i>
                  <span class="flex-1 text-left">Stall</span>
                </button>
              </div>
            </div>
          </div>
  
          <a href="president-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-newspaper mr-3"></i>
            <span>News Feed</span>
          </a>
          <a href="president-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-calendar-alt mr-3"></i>
            <span>Calendar</span>
          </a>
          <a href="president-logs.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-history mr-3"></i>
            <span>Activity Logs</span>
          </a>
          <a href="president-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
      <!--End of sidebar-->
  
      <!-- Main Content -->
      <div class="flex-1 overflow-x-hidden overflow-y-auto">
        <header class="bg-white shadow-md">
          <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
              <h1 class="text-2xl font-bold text-gray-900">Liquidation of Expenses</h1>
              <div class="flex items-center space-x-2">
                <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                  <i class="fas fa-bell"></i>
                </button>
              </div>
            </div>
      </header>

      <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-6">Liquidation of Expenses</h1>

        <div class="overflow-x-auto bg-white rounded shadow-md">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-teal-100">
                    <tr>
                        <th class="border px-4 py-2">Project Resolution</th>
                        <th class="border px-4 py-2">Budget Released</th>
                        <th class="border px-4 py-2">Liquidation Status</th>
                        <th class="border px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                    $sql = "SELECT r.id AS proj_id, r.project_resolution_title, r.estimated_budget, r.status AS res_status,
                                l.status AS liq_status
                            FROM resolution r
                            LEFT JOIN liquidation_of_expenses l ON r.id = l.project_resolution_id
                            ORDER BY r.id DESC";

                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $proj_id = $row['proj_id'];
                            $proj_title = $row['project_resolution_title'];
                            $budget = $row['estimated_budget'];

                            $liq_status = $row['liq_status'];

                            switch($liq_status) {
                                case 1:
                                    $liq_status_display = "For Approval";
                                    $button_label = "View Details";
                                    $button_link = "president-view-liquidation.php?id=" . $proj_id;
                                    break;
                                case 2:
                                    $liq_status_display = "Approved";
                                    $button_label = "View Details";
                                    $button_link = "president-view-liquidation.php?id=" . $proj_id;
                                    break;
                                case 3:
                                    $liq_status_display = "Rejected";
                                    $button_label = "View Details";
                                    $button_link = "president-view-liquidation.php?id=" . $proj_id;
                                    break;
                                case 0:
                                default:
                                    $liq_status_display = "Pending";
                                    $button_label = "Generate Expense Liquidation";
                                    $button_link = "president-generate-liquidation.php?id=" . $proj_id;
                                    break;
                            }

                            echo "<tr class='hover:bg-gray-100'>
                                    <td class='border px-4 py-2'>{$proj_title}</td>
                                    <td class='border px-4 py-2'>₱ {$budget}</td>
                                    <td class='border px-4 py-2'>{$liq_status_display}</td>
                                    <td class='border px-4 py-2 text-center'>
                                        <a href='{$button_link}' class='bg-teal-600 text-white px-4 py-1 rounded hover:bg-teal-700'>{$button_label}</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='border px-4 py-2 text-center'>No project resolutions found.</td></tr>";
                    }
                    ?>



                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
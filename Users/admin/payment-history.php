<?php

include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$user_id = $_SESSION['user_id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - Payment History</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
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
    .modal-content {
      background-color: white;
      border-radius: 8px;
      width: 100%;
      max-width: 1200px; /* Increased from 900px to 1200px for larger modal */
      max-height: 95vh; /* Increased from 90vh to 95vh for taller modal */
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
      user-select: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      /* Added comprehensive selection prevention */
      -webkit-touch-callout: none;
      -webkit-tap-highlight-color: transparent;
      cursor: default;
      outline: none;
    }
    /* Added non-selectable styling for main table headers */
    #paymentTable thead th {
      user-select: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      -webkit-touch-callout: none;
      -webkit-tap-highlight-color: transparent;
      cursor: default;
      outline: none;
    }
    .payment-card {
      border: 2px solid #14b8a6; /* Teal-500 border */
      background-color: #ccfbf1; /* Teal-50 background */
      border-radius: 4px;
      padding: 16px;
      margin-bottom: 16px;
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
        <a href="admin-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
          <i class="fas fa-tachometer-alt mr-3"></i>
          <span>Dashboard</span>
        </a>
        <a href="admin-accounts.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
          <i class="fas fa-users mr-3"></i>
          <span>User Management</span>
        </a>
        <!-- Payment Management Dropdown -->
        <div x-data="{ open: true }">
          <button @click="open = !open" :aria-expanded="open" class="flex items-center w-full px-6 py-3 hover:bg-teal-600 focus:outline-none">
            <i class="fas fa-credit-card mr-3"></i>
            <span class="flex-1 text-left">Payment Management</span>
            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="open" x-cloak class="bg-teal-800 text-sm">
            <a href="fee-types.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
              <i class="fas fa-tag mr-2" title="Fee Type"></i>
              Fee Type
            </a>
            <a href="fee-assignation.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
              <i class="fas fa-clipboard-list mr-2" title="Fee Assignation"></i>
              Fee Assignation
            </a>
            <a href="payment-verification.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
              <i class="fas fa-check-circle mr-2" title="Payment Verification"></i>
              Payment Verification
            </a>
            <a href="admin-remittance.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
              <i class="fas fa-money-check mr-3"></i>
              Remittance
            </a>
            <a href="payment-history.php" class="flex items-center px-10 py-2 bg-teal-700">
              <i class="fas fa-history mr-2" title="Payment History"></i>
              Payment History
            </a>
          </div>
        </div>

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
      <button @click="window.location.href='admin-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
        <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
        <span class="flex-1 text-left">Tricycle</span>
      </button>
    </div>

    <!-- Court Navigation -->
    <div class="relative">
      <button @click="window.location.href='admin-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
        <i class="fas fa-basketball-ball mr-2" title="Court"></i>
        <span class="flex-1 text-left">Court</span>
      </button>
    </div>

    <!-- Stall Navigation -->
    <div class="relative">
      <button @click="window.location.href='admin-stall.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
        <i class="fas fa-store mr-2" title="Stall"></i>
        <span class="flex-1 text-left">Stall</span>
      </button>
    </div>
  </div>
</div>

<a href="admin-hoaprojects.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
  <i class="fas fa-gavel mr-3"></i>
  <span>Resolution</span>
</a>

<a href="admin-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
  <i class="fas fa-book mr-3"></i>
  <span>Ledger</span>
</a>

<a href="admin-projects.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
  <i class="fas fa-newspaper mr-3"></i>
<span>News Feed</span>
</a>

        <a href="admin-messages.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
          <i class="fas fa-comments mr-3"></i>
          <span>Messages</span>
        </a>
        <a href="admin-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
          <i class="fas fa-calendar-alt mr-3"></i>
          <span>Calendar</span>
        </a>
        <a href="admin-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
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

    
      <!--Main Content-->

      <div class="flex-1 overflow-x-hidden overflow-y-auto">
        <header class="bg-white shadow-md">
          <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
              <h1 class="text-2xl font-bold text-gray-900">Payment History</h1>
              <div class="flex items-center space-x-2">
                <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                  <i class="fas fa-bell"></i>
                </button>
              </div>
            </div>
      </header>

        <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <div id="payment-history" class="mb-8">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-xl font-semibold text-gray-900">Payment History Table</h2>
              <div class="relative w-64">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                  <i class="fas fa-search text-gray-400"></i>
                </span>
                <input
                  type="text"
                  id="searchInput"
                  placeholder="Search payments..."
                  class="w-full pl-10 pr-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                  oninput="filterTable()"
                />
              </div>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
              <div class="overflow-x-auto">
                <table id="paymentTable" class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <?php

                    $sql_users = "SELECT users.user_id, users.first_name, users.middle_name , users.last_name , users.email_address FROM users WHERE users.role_id = '6' ORDER BY users.last_name ASC";
                    $run_users = mysqli_query($conn, $sql_users);

                    while ($row = mysqli_fetch_assoc($run_users)) {
                      $user_id = $row['user_id'];
                      $full_name = trim($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']);
                      $email = $row['email_address'];
                      ?>
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $full_name; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $email; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                          <a href="view-payment.php?user_id=<?php echo $user_id; ?>" class="text-teal-600 hover:text-teal-900">View</a>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              
            </div>
          </div>
        </main>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
  </div>
</body>
</html>

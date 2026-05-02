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
  <title>HOAConnect - Payment Verification</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    [x-cloak] {
      display: none !important;
    }
    .modal-content {
      background-color: white;
      border-radius: 8px;
      width: 100%;
      max-width: 600px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
    }
    .modal-header button {
      color: #6b7280;
      font-size: 18px;
    }
    .modal-body {
      padding: 24px;
    }
    .modal-body h4 {
      font-size: 16px;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 16px;
    }
    .modal-body .form-row {
      display: flex;
      gap: 16px;
      margin-bottom: 16px;
    }
    .modal-body .form-row > div {
      flex: 1;
    }
    .modal-body label {
      font-size: 14px;
      font-weight: 500;
      color: #1f2937;
      margin-bottom: 4px;
      display: block;
    }
    .modal-body input,
    .modal-body select,
    .modal-body textarea {
      width: 100%;
      padding: 8px 12px;
      font-size: 14px;
      color: #6b7280;
      background-color: #f9fafb;
      border: 1px solid #e5e7eb;
      border-radius: 4px;
      outline: none;
    }
    .modal-body textarea {
      border: 1px solid #374151;
    }
    .modal-body select {
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 8px center;
      background-size: 16px;
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
    .modal-footer .cancel-btn {
      background-color: white;
      border: 1px solid #d1d5db;
      color: #374151;
    }
    .modal-footer .cancel-btn:hover {
      background-color: #f3f4f6;
    }
    .modal-footer .save-btn {
      background-color: #14b8a6;
      border: none;
      color: white;
    }
    .modal-footer .save-btn:hover {
      background-color: #0d9488;
    }
    .modal-footer .reject-btn {
      background-color: #ef4444;
      border: none;
      color: white;
    }
    .modal-footer .reject-btn:hover {
      background-color: #dc2626;
    }
    .payment-card {
      border: 2px solid #14b8a6;
      background-color: #ccfbf1;
      padding: 16px;
      border-radius: 8px;
      margin: 0 auto;
      max-width: 400px;
    }
    .payment-card p {
      margin: 4px 0;
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
            <a href="payment-verification.php" class="flex items-center px-10 py-2 bg-teal-700">
              <i class="fas fa-check-circle mr-2" title="Payment Verification"></i>
              Payment Verification
            </a>
            <a href="admin-remittance.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
              <i class="fas fa-money-check mr-3"></i>
              Remittance
            </a>
            <a href="payment-history.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
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
            <div class="relative">
              <button @click="window.location.href='admin-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
                <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
                <span class="flex-1 text-left">Tricycle</span>
              </button>
            </div>
            <div class="relative">
              <button @click="window.location.href='admin-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
                <i class="fas fa-basketball-ball mr-2" title="Court"></i>
                <span class="flex-1 text-left">Court</span>
              </button>
            </div>
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
          <span>Project Resolution</span>
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
    <!-- Main Content -->
    <div class="flex-1 overflow-x-hidden overflow-y-auto">
      <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Payment Management</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>
      <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Payment Verification Section -->
        <div id="payment-verification" class="mb-8">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-900">Payment Verification Table</h2>
            <div class="flex space-x-3">
              <div class="relative w-64">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                  <i class="fas fa-search text-gray-400"></i>
                </span>
                <input
                  type="text"
                  id="search-payment"
                  placeholder="Search by name"
                  maxlength="100"
                  class="w-full pl-10 pr-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                />
              </div>
            </div>
          </div>
          <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Payment For</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Amount</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $query_homeowners = "
                        SELECT 
                            u.user_id,
                            u.first_name,
                            u.last_name,
                            fa.id AS fee_assignation_id,
                            ft.fee_name,
                            ft.amount,
                            fa.is_paid,
                            fa.is_approved
                        FROM users u
                        LEFT JOIN fee_assignation fa ON u.user_id = fa.user_id
                        LEFT JOIN fee_type ft ON fa.fee_type_id = ft.fee_type_id
                        WHERE u.role_id = '6'
                          AND fa.id IS NOT NULL
                        ORDER BY u.first_name, u.last_name
                    ";

                    $run_homeowners = mysqli_query($conn, $query_homeowners);

                    foreach ($run_homeowners as $row_homeowners) {
                        $approved = (int)$row_homeowners['is_approved'];
                        $fee_assignation_id = $row_homeowners['fee_assignation_id'];

                        // Status logic
                        if ($approved === 2) {
                            $status_label = "<span class='px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold'>Pending</span>";
                            $show_button = true; // Only pending shows button
                        } elseif ($approved === 1) {
                            $status_label = "<span class='px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold'>Approved</span>";
                            $show_button = false;
                        } else { // $approved === 0 → Unpaid
                            $status_label = "<span class='px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold'>Unpaid</span>";
                            $show_button = false;
                        }
                    ?>
                          <tr class="hover:bg-gray-50 transition duration-150">
                          <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">
                              <?= htmlspecialchars($row_homeowners['first_name'] . " " . $row_homeowners['last_name']); ?>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                              <?= htmlspecialchars($row_homeowners['fee_name'] ?? 'N/A'); ?>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                              ₱<?= number_format($row_homeowners['amount'] ?? 0, 2); ?>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                              <?= $status_label; ?>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-center">
                              <?php if (!empty($fee_assignation_id) && $show_button): ?>
                                  <a href="view-online-payment.php?id=<?= $fee_assignation_id; ?>&user_id=<?= $row_homeowners['user_id']; ?>" 
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition">
                                    View
                                  </a>
                              <?php else: ?>
                                  <span class="text-gray-400 text-sm">N/A</span>
                              <?php endif; ?>
                          </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  
</body>
</html>
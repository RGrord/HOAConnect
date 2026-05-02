<?php
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// User ID (you may replace with dynamic $_GET['user_id'])
$user_id = '20252509';

$sql_fees = "SELECT fa.id, fa.fee_type_id, fa.due_date, fa.status
             FROM fee_assignments fa
             WHERE fa.user_id = '$user_id'
             ORDER BY fa.id DESC";
$res_fees = mysqli_query($conn, $sql_fees);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HOAConnect - Payment</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
[x-cloak] { display: none !important; }
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
            <a href="homeowner-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-tachometer-alt mr-3"></i>
                <span>Dashboard</span>
            </a>

            <!-- Payments Dropdown -->
            <div x-data="{ open: true }" class="relative">
                <button @click="open = !open" :aria-expanded="open" class="flex items-center px-6 py-3 w-full text-left hover:bg-teal-600 focus:outline-none">
                    <i class="fas fa-credit-card mr-3"></i>
                    <span>Payments</span>
                    <i :class="{ 'rotate-180': open }" class="fas fa-chevron-down ml-auto transform transition-transform duration-200"></i>
                </button>
                <div x-show="open" x-cloak class="bg-teal-800">
                    <a href="homeowner-payment.php" class="flex items-center px-8 py-2 bg-teal-700 hover:bg-teal-700">
                        <i class="fas fa-wallet mr-2"></i> View Payments
                    </a>
                    <a href="homeowner-history.php" class="flex items-center px-8 py-2 hover:bg-teal-600">
                        <i class="fas fa-history mr-2"></i> Payment History
                    </a>
                </div>
            </div>

            <a href="homeowner-hoa-projects.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-gavel mr-3"></i> Resolution
            </a>
            <a href="homeowner-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-newspaper mr-3"></i> News Feed
            </a>
            <a href="homeowner-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-book mr-3"></i> Ledger
            </a>
            <a href="homeowner-message.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-comments mr-3"></i> Messages
            </a>
            <a href="homeowner-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-calendar-alt mr-3"></i> Calendar
            </a>
            <a href="homeowner-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
                <i class="fas fa-user-circle mr-3"></i> Profile
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
                <h1 class="text-2xl font-bold text-gray-900">Payment</h1>
                <div class="flex items-center space-x-2">
                    <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                        <i class="fas fa-bell"></i>
                    </button>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <div class="bg-gradient-to-r from-teal-500 to-teal-700 rounded-xl shadow-lg mb-8 p-4 max-w-xs text-white">
                <div class="flex items-center space-x-3">
                    <div class="bg-white bg-opacity-20 p-2 rounded-full">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-md font-semibold">Outstanding Balance</h2>
                </div>
                <p class="text-2xl font-bold mt-3" id="outstandingBalance">₱100</p>
                <p class="text-xs text-white text-opacity-90 mt-1">
                    This is the total amount of unpaid and overdue fees.
                </p>
            </div>

            <!-- Payment Table -->
            <div class="bg-white rounded-lg shadow mb-8">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-medium">Payment Table</h2>
                    <div class="flex space-x-2">
                        <select id="statusFilter" class="border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option value="All">All</option>
                            <option value="Paid">Paid</option>
                            <option value="Pending">Pending</option>
                            <option value="Unpaid">Unpaid</option>
                            <option value="Overdue">Overdue</option>
                        </select>
                        <input type="text" placeholder="Search..." class="border rounded-l px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <button class="bg-teal-600 text-white px-4 py-2 rounded-r hover:bg-teal-700">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 rounded-lg text-sm font-[Arial]">
                        <thead class="bg-gray-100">
                            <tr class="text-left text-gray-700 uppercase text-xs tracking-wider">
                                <th class="px-4 py-3 text-center">Fee Name</th>
                                <th class="px-4 py-3 text-center">Amount</th>
                                <th class="px-4 py-3 text-center">Due Date</th>
                                <!-- <th class="px-4 py-3 text-center">Due Status</th> -->
                                <th class="px-4 py-3 text-center">Payment Status</th>
                                <th class="px-4 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                          <?php
                          if(mysqli_num_rows($res_fees) > 0){
                              while($row_fees = mysqli_fetch_assoc($res_fees)){
                                  $due_date = new DateTime($row_fees['next_due']);
                                  $current_date = new DateTime();
                                  $is_paid = (int)$row_fees['is_paid'];
                                  $is_approved = (int)$row_fees['is_approved'];

                                  // // Due Status
                                  // if($current_date->format('Y-m-d') == $due_date->format('Y-m-d')){
                                  //     $due_status = "<span class='text-yellow-500 font-semibold'>Due Today</span>";
                                  // } elseif($current_date > $due_date){
                                  //     $overdue_days = $current_date->diff($due_date)->days;
                                  //     $due_status = "<span class='text-red-600 font-semibold'>Overdue ({$overdue_days} days)</span>";
                                  // } else {
                                  //     $due_status = "<span class='text-gray-600 font-semibold'>Upcoming</span>";
                                  // }

                                  // Payment Status
                                  if($is_paid === 0 && $is_approved === 0){
                                      $payment_status = "<span class='text-gray-600 font-semibold'>Unpaid</span>";
                                  } elseif($is_paid === 1 && $is_approved === 0){
                                      $payment_status = "<span class='text-red-600 font-semibold'>Rejected</span>";
                                  } elseif($is_approved === 2){
                                      $payment_status = "<span class='text-yellow-500 font-semibold'>Pending</span>";
                                  } elseif($is_approved === 1){
                                      $payment_status = "<span class='text-green-500 font-semibold'>Approved</span>";
                                  } else {
                                      $payment_status = "<span class='text-gray-500 font-semibold'>N/A</span>";
                                  }

                                  // Action Button
                              if (($is_approved === 2 && $is_paid === 0) || ($is_approved === 0 && $is_paid === 1) || ($is_approved === 0 && $is_paid === 0)) {
                                  // Pending, Rejected, or Unpaid → show Pay button
                                  $action_btn = '<a href="homeowner-pay-fee.php?id=' . $row_fees['id'] . '&user_id=' . $user_id . '" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-md text-sm transition">Pay</a>';
                              } elseif ($is_approved === 1 && $is_paid === 1) {
                                  // Approved → show View button
                                  $action_btn = "";
                              } else {
                                  // Default fallback → Pay
                                  $action_btn = '<a href="homeowner-pay-fee.php?id=' . $row_fees['id'] . '&user_id=' . $user_id . '" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-md text-sm transition">Pay</a>';
                              }
                          ?>
                          <tr class="hover:bg-gray-50 transition">
                              <td class="px-4 py-3 text-center font-medium text-gray-800"><?php echo $row_fees['fee_name']; ?></td>
                              <td class="px-4 py-3 text-center text-gray-700">₱<?php echo number_format($row_fees['amount'], 2); ?></td>
                              <td class="px-4 py-3 text-center text-gray-700"><?php echo date('M d, Y', strtotime($row_fees['next_due'])); ?></td>
                              <!-- <td class="px-4 py-3 text-center"><?php echo $due_status; ?></td> -->
                              <td class="px-4 py-3 text-center"><?php echo $payment_status; ?></td>
                              <td class="px-4 py-3 text-center"><?php echo $action_btn; ?></td>
                          </tr>
                          <?php
                              }
                          } else {
                              echo '<tr><td colspan="6" class="text-center py-4 text-gray-500">No fee records found.</td></tr>';
                          }
                          ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>
</body>
</html>

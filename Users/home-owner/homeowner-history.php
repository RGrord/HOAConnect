<?php

include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$user_id = '20252509'; // palitan na lang mamaya


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - My Payment History</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    [x-cloak] { display: none !important; }
  </style>
  <style>
    /* Slightly larger table text and padding (header & body) */
    .excel-table th {
      padding: 12px 10px;
      font-size: 0.95rem; /* slightly larger header text */
    }
    .excel-table td {
      padding: 10px;
      font-size: 0.93rem; /* slightly larger body text */
    }
    .proof-card {
      border: 1px solid #99f6e4;  /* teal-200 */
      border-radius: 6px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 6px;
    }
    .pagination button {
      padding: 6px 10px;
      border-radius: 6px;
      border: 1px solid transparent;
    }
    .pagination button.active {
      background-color: #0f766e; /* teal-700 */
      color: white;
    }
    .pagination button:hover {
      border-color: #e5e7eb;
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
      <a
        href="homeowner-dashboard.php"
        class="flex items-center px-6 py-3 hover:bg-teal-600"
      >
        <i class="fas fa-tachometer-alt mr-3"></i>
        <span>Dashboard</span>
      </a>

      <!-- Payments Dropdown -->
      <div x-data="{ open: true }" class="relative">
        <button
          @click="open = !open"
          :aria-expanded="open"
          class="flex items-center px-6 py-3 w-full text-left hover:bg-teal-600 focus:outline-none"
        >
          <i class="fas fa-credit-card mr-3"></i>
          <span>Payments</span>
          <i
            :class="{ 'rotate-180': open }"
            class="fas fa-chevron-down ml-auto transform transition-transform duration-200"
          ></i>
        </button>
        <div
          x-show="open"
          x-cloak
          class="bg-teal-800"
        >
          <a
            href="homeowner-payment.php"
            class="flex items-center px-8 py-2 hover:bg-teal-600"
          >
            <i class="fas fa-wallet mr-2"></i>
            View Payments
          </a>
          <a
            href="homeowner-history.php"
            class="flex items-center px-8 py-2 bg-teal-700 hover:bg-teal-700"
          >
            <i class="fas fa-history mr-2"></i>
            Payment History
          </a>
        </div>
      </div>

      <a href="homeowner-hoa-projects.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-gavel mr-3"></i>
        <span>Resolution</span>
      </a>
      <a href="homeowner-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-newspaper mr-3"></i>
        <span>News Feed</span>
      </a>
      <a href="homeowner-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-book mr-3"></i>
        <span>Ledger</span>
      </a>
      <a href="homeowner-message.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-comments mr-3"></i>
          <span>Messages</span>
      </a>
      <a href="homeowner-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-calendar-alt mr-3"></i>
          <span>Calendar</span>
      </a>
      <a href="homeowner-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
        <i class="fas fa-user-circle mr-3"></i>
        <span>Profile</span>
    </a> 
  </nav>
  <div class="px-6 py-4 mt-auto">
      <button
          class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded flex items-center justify-center"
      >
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </button>
  </div>
</div>
<!--End of Sidebar-->

  <!--Main Content-->
  <div class="flex-1 overflow-x-hidden overflow-y-auto">
    <header class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
          <h1 class="text-2xl font-bold text-gray-900">My Payment History</h1>
          <div class="flex items-center space-x-2">
            <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
              <i class="fas fa-bell"></i>
            </button>
          </div>
        </div>
  </header>

    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <div id="project-proposals" class="mb-8"> 
        <h2 class="text-xl font-semibold text-gray-900 mb-6">My Account Information</h2>
      </div>

        <div class="bg-white shadow rounded-lg overflow-hidden" id="payment-history">
          <div class="overflow-x-auto">
            
            <table class="min-w-full divide-y divide-gray-200" id="mainPaymentTable">
              <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment For</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Submitted</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reference Number</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proof</th>
                  </tr>
              </thead>
              <tbody id="mainPaymentTableBody" class="bg-white divide-y divide-gray-200">
                <?php 

                  $sql_history_info = "SELECT fee_type.fee_type_id, fee_type.fee_name , fee_assignation.fee_type_id, payment_history.amount, payment_history.payment_method,payment_history.date_created,payment_history.reference_number,payment_history.proof_of_payment
                  FROM fee_type
                  LEFT JOIN fee_assignation ON fee_type.fee_type_id = fee_assignation.fee_type_id
                  LEFT JOIN payment_history ON fee_assignation.id = payment_history.fee_type_id
                  WHERE payment_history.user_id = '$user_id'";
                  $run_history_info = mysqli_query($conn,$sql_history_info);

                  if(mysqli_num_rows($run_history_info) > 0){
                    foreach($run_history_info as $row_history_info){
                      ?>

                          <tr>
                            <td><?php echo $row_history_info['fee_name']?></td>
                            <td><?php echo $row_history_info['amount']?></td>
                            <td>
                              <?php 
                                if (!empty($row_history_info['date_created'])) {
                                    echo date('F d, Y', strtotime($row_history_info['date_created']));
                                } else {
                                    echo 'N/A';
                                }
                              ?>
                            </td>
                            <td><?php echo $row_history_info['payment_method']?></td>
                            <td><?php echo $row_history_info['reference_number']?></td>
                            <td>
                              <div x-data="{ open: false }">
                                <!-- Button to open modal -->
                                <button @click="open = true" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                  View Image
                                </button>

                                <!-- Modal -->
                                <div 
                                  x-show="open" 
                                  x-cloak
                                  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                                >
                                  <div class="bg-white rounded-lg shadow-lg p-4 max-w-lg w-full relative">
                                    <!-- Close button -->
                                    <button @click="open = false" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900">
                                      &times;
                                    </button>

                                    <!-- Image -->
                                    <img src="../../uploads/<?php echo $row_history_info['proof_of_payment']?>" alt="Payment Proof" class="w-full h-auto rounded">
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                      <?php 
                    }
                  }

                ?>
              </tbody>
            </table>
          </div>

        <!-- pagination -->
        <div class="px-4 py-3 bg-white border-t flex items-center justify-between">
          <div id="mainTableInfo" class="text-sm text-gray-700"></div>
          <div class="pagination flex items-center space-x-2" id="mainPagination"></div>
        </div>
      </div>

    </main>
  </div>
</div>


</body>
</html>

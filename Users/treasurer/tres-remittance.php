<?php
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
<title>HOAConnect - Remittance</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
      <a href="tres-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-tachometer-alt mr-3"></i>
        <span>Dashboard</span>
      </a>
      <a href="tres-paymenthistory.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-receipt mr-3"></i>
        <span>Payment History</span>
      </a>
      <a href="tres-remittance.php" class="flex items-center px-6 py-3 bg-teal-700">
        <i class="fas fa-money-check mr-3"></i>
        <span>Remittance</span>
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
            <button @click="window.location.href='tres-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
              <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
              <span class="flex-1 text-left">Tricycle</span>
            </button>
          </div>
          <!-- Court Navigation -->
          <div class="relative">
            <button @click="window.location.href='tres-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
              <i class="fas fa-basketball-ball mr-2" title="Court"></i>
              <span class="flex-1 text-left">Court</span>
            </button>
          </div>
          <!-- Stall Navigation -->
          <div class="relative">
            <button @click="window.location.href='tres-stall.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
              <i class="fas fa-store mr-2" title="Stall"></i>
              <span class="flex-1 text-left">Stall</span>
            </button>
          </div>
        </div>
      </div>
      <a href="tres-project.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-gavel mr-3"></i>
        <span>Resolution</span>
      </a>
      <a href="tres-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-book mr-3"></i>
        <span>Ledger</span>
      </a>
      <a href="tres-acknowledgement.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-file-invoice mr-3"></i>
        <span>Receipt</span>
      </a>
      <a href="tres-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-newspaper mr-3"></i>
        <span>News Feed</span>
      </a>
      <a href="tres-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-calendar-alt mr-3"></i>
        <span>Calendar</span>
      </a>
      <a href="tres-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
          <h1 class="text-2xl font-bold text-gray-900">Remittance</h1>
          <div class="flex items-center space-x-2">
            <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
              <i class="fas fa-bell"></i>
            </button>
          </div>
        </div>
  </header>
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <!-- Payment History Section -->
      <div id="payment-history-section" class="mb-8">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-semibold text-gray-900">Daily Payment History</h2>
          <div class="flex items-center space-x-6 bg-teal-50 border border-teal-200 rounded-xl px-6 py-3 shadow-sm">
            <div>
              <p class="text-sm font-medium text-teal-700">Total Collected (₱)</p>
              <p id="totalCollected" class="text-2xl font-bold text-black-900">0</p>
            </div>
           
          </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
          <div class="overflow-x-auto">
            <form id="remitSelectorForm" method="POST" onsubmit="return false;">
              <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-teal-100">
                  <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Fee Name</th>
                    <th class="px-4 py-2 text-left">Amount (₱)</th>
                    <th class="px-4 py-2 text-left">Date</th>
                  </tr>
                </thead>

                <tbody id="paymentHistoryTableBody" class="divide-y divide-gray-200">
                  <?php 
                  $sql_view_remittance = "
                    SELECT 
                      payment_history.id,
                      users.first_name, 
                      users.last_name, 
                      payment_history.fee_name, 
                      payment_history.amount, 
                      payment_history.date_created 
                    FROM users 
                    INNER JOIN payment_history 
                      ON users.user_id = payment_history.user_id 
                    WHERE users.role_id = '6' AND payment_history.is_submitted = '0'
                    ORDER BY users.first_name, users.last_name;
                  ";

                  $run_view_remittance = mysqli_query($conn, $sql_view_remittance);

                  if(mysqli_num_rows($run_view_remittance) > 0){
                      foreach($run_view_remittance as $row_remittance) {
                        $ph_id = (int)$row_remittance['id'];
                        $fullname = htmlspecialchars($row_remittance['first_name'] . " " . $row_remittance['last_name']);
                        $fee_name = htmlspecialchars($row_remittance['fee_name']);
                        $amount_val = number_format($row_remittance['amount'], 2);
                        $raw_amount = htmlspecialchars($row_remittance['amount']);
                        $date_val = !empty($row_remittance['date_created']) ? date('F d, Y', strtotime($row_remittance['date_created'])) : 'N/A';
                  ?>
                      <tr>
                        
                        <td class="px-4 py-2"><?php echo $fullname; ?></td>
                        <td class="px-4 py-2"><?php echo $fee_name; ?></td>
                        <td class="px-4 py-2">₱<?php echo $amount_val; ?></td>
                        <td class="px-4 py-2"><?php echo $date_val; ?></td>
                      </tr>
                  <?php 
                      }
                  } else {
                    echo '<tr><td colspan="5" class="text-center py-4 text-gray-500">No payment records found.</td></tr>';
                  }
                  ?>
                </tbody>
              </table>

              <!-- Hidden field (kept for compatibility if needed) -->
              <input type="hidden" id="totalAmountInput" name="amount" value="">

              
            </form>

        

          

      <!-- Remittance Table Section -->
      <div id="remittance-table-section" class="mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Remittance Table</h2>

        <div class="bg-white shadow rounded-lg overflow-hidden">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Particular</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount (₱)</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody id="remittanceTableBody" class="bg-white divide-y divide-gray-200">
                <!-- Remittance entries will be rendered dynamically -->
                  
                <?php 

                  $sql_remittance_table = "SELECT * FROM remittance";
                  $run_remittance_table = mysqli_query($conn,$sql_remittance_table);

                  if(mysqli_num_rows($run_remittance_table) > 0){
                    foreach($run_remittance_table as $row_remittance_table){
                      ?>


                        <tr>
                          <td><?php echo $row_remittance_table['particular']?></td>
                          <td><?php echo $row_remittance_table['amount']?></td>
                          <td>
                            <?php 
                              if($row_remittance_table['is_approved'] == 0){
                                echo "Pending";
                              }else{
                                echo "Approved";
                              }
                            ?>
                          </td>
                          <td>

                            <a href="view-table-remittance.php?id=<?php echo $row_remittance_table['id']?>">View</a>
                          
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
</div>

</body>
</html>
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
      <a href="tres-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-tachometer-alt mr-3"></i>
        <span>Dashboard</span>
      </a>
      <a href="tres-paymenthistory.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-receipt mr-3"></i>
        <span>Payment History</span>
      </a>
      <a href="tres-remittance.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
   
  <div class="relative">
    <button @click="window.location.href='tres-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
      <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
      <span class="flex-1 text-left">Tricycle</span>
    </button>
  </div>

   
  <div class="relative">
    <button @click="window.location.href='tres-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
      <i class="fas fa-basketball-ball mr-2" title="Court"></i>
      <span class="flex-1 text-left">Court</span>
    </button>
  </div>

   
  <div class="relative">
    <button @click="window.location.href='tres-stall.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
      <i class="fas fa-store mr-2" title="Stall"></i>
      <span class="flex-1 text-left">Stall</span>
    </button>
  </div>
</div>
</div>

      <a href="tres-project.php" class="flex items-center px-6 py-3 bg-teal-700">
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
      <a href="tres-transactions.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-file-invoice mr-3"></i>
        <span>Transactions</span>
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


  <a href="tres-add-transactions.php">Add Transaction</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Particulars</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

    <?php
        $query_transactions = "SELECT * FROM transactions ORDER BY id DESC";
        $run_transactions = mysqli_query($conn, $query_transactions);

        if (mysqli_num_rows($run_transactions) > 0) {
            
            while ($row = mysqli_fetch_assoc($run_transactions)) {

                $id            = $row['id'];
                $particulars   = htmlspecialchars($row['particulars']);
                $status_code   = intval($row['status']);

                // Map status code to text
                switch ($status_code) {
                    case 0:
                        $status_text = "Pending";
                        break;
                    case 1:
                        $status_text = "Approved";
                        break;
                    case 2:
                        $status_text = "Rejected";
                        break;
                    default:
                        $status_text = "Unknown";
                        break;
                }

                echo "<tr>";
                    // Particulars column
                    echo "<td>{$particulars}</td>";

                    // Status column
                    echo "<td>{$status_text}</td>";

                    // Action column: link to view transaction
                    echo "<td><a href='tres-view-transaction.php?id={$id}'>View</a></td>";

                echo "</tr>";
            }

        } else {
            echo "<tr><td colspan='3' style='text-align:center;color:red;'>No transactions found.</td></tr>";
        }
    ?>

    </tbody>
</table>


</div>




</body>
</html>
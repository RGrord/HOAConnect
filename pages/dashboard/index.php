<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';

require_once $root . 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';


$role = $_SESSION['role'] ?? 0;
$pageTitle = 'Users';
$a = $_GET['a'] ?? '0';

$today = date('Y-m-d');
$month = date('M Y');
$total_collected = 0;
$tables = ['homeowner_fees', 'court_fees', 'stall_renter_fees', 'toda_fees'];

foreach ($tables as $table) {
    $sql = "SELECT COALESCE(SUM(amount_paid), 0) FROM $table WHERE status = 1 AND is_remitted = 1 AND DATE(date_created) = CURDATE()";
    $result = $conn->query($sql);
    $total_collected += $result->fetch_row()[0];
}

$src = $role == 1 ? "WHERE role_id != 6" : "WHERE role_id = 6";

$sql = "SELECT COUNT(*) AS users_today 
        FROM users $src AND status = 1";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$users = $row['users_today'];

$post_sql = "SELECT COUNT(*) AS posts 
        FROM news_feed";

$feed_res = $conn->query($post_sql);
$feed_row = $feed_res->fetch_assoc();

$total_post = $feed_row['posts'];

$pending_tables = ['payment_verification', 'liquidation_of_expenses', 'fee_type'];
$pending_approvals = 0;

foreach ($pending_tables as $table) {
    $sql = "SELECT COUNT(*) AS total FROM $table WHERE status = 0";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $pending_approvals += $row['total'] ?? 0;
}
ob_start();

?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<?php 
  if($role != 6){
    ?>
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">

  <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-200 hover:shadow-3xl transition duration-300">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-gray-600 text-lg font-semibold">Total Registered Users</p>
        <p class="text-6xl font-extrabold text-black mt-4"><?= $users ?></p>
        <p class="text-gray-500 text-sm mt-2">Active homeowners</p>
      </div>
      <div class="bg-gray-100 p-6 rounded-2xl">
        <i class="fas fa-users text-5xl text-blue-600"></i>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-200 hover:shadow-3xl transition duration-300">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-gray-600 text-lg font-semibold">Total Community Posts</p>
        <p class="text-6xl font-extrabold text-black mt-4"><?= $total_post ?></p>
        <p class="text-gray-500 text-sm mt-2">Announcements & updates</p>
      </div>
      <div class="bg-gray-100 p-6 rounded-2xl">
        <i class="ri-sticky-note-fill text-5xl text-yellow-400"></i>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-200 hover:shadow-3xl transition duration-300">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-gray-600 text-lg font-semibold">Total Collected Fees</p>
        <p class="text-6xl font-extrabold text-black mt-4">₱<?= number_format($total_collected, 2) ?></p>
        <p class="text-gray-500 text-sm mt-2">All time collection</p>
      </div>
      <div class="bg-gray-100 p-6 rounded-2xl">
        <i class="fas fa-money-bill-wave text-5xl text-teal-600"></i>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-200 hover:shadow-3xl transition duration-300">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-gray-600 text-lg font-semibold">Pending Approvals</p>
        <p class="text-6xl font-extrabold text-black mt-4"><?= $pending_approvals ?></p>
        <p class="text-gray-500 text-sm mt-2">Waiting for review</p>
      </div>
      <div class="bg-gray-100 p-6 rounded-2xl">
        <i class="fas fa-clock text-5xl text-orange-400"></i>
      </div>
    </div>
  </div>

</div>


  <?php
  } else {
  ?>
 <main class="py-6 px-4 sm:px-6 lg:px-8">
          <!-- Welcome Banner -->
          <div
            class="bg-gradient-to-r from-teal-500 to-teal-700 rounded-lg shadow-lg mb-8"
          >
            <div
              class="p-6 md:p-8 flex flex-col md:flex-row items-center justify-between"
            >
              <div class="mb-4 md:mb-0">
                <?php 
                $user_id = $_SESSION['user_id']; 

                $sql = "SELECT * FROM user_info WHERE user_id = $user_id";
                $result_user = $conn->query($sql);
                $row_user = $result_user->fetch_assoc();

                ?>
                <h2 class="text-2xl font-bold">
                  Welcome, <?= $row_user['first_name'] . ' ' . $row_user['last_name'] ?>
                </h2>
                <p class="text-gray-900 mt-1">
                  Block 5 Lot 12, Phase 1, Mabuhay Homes 2000
                </p>
              </div>
              <div
                class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2"
              ></div>
            </div>
          </div>
          
  <!-- Total Collected Fees Card -->
  <div class="bg-gradient-to-br from-white to-teal-50 rounded-2xl shadow-lg p-6 border border-teal-100 hover:shadow-2xl transition-shadow duration-300">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold text-gray-800">Total Collected Fees</h3>
      <span class="bg-teal-100 text-teal-800 text-xs font-medium px-3 py-1 rounded-full shadow-sm">
        Community Fund
      </span>
    </div>
    <div class="flex items-center">
      <div class="p-4 rounded-full bg-teal-500 text-white shadow-md">
        <i class="fas fa-money-bill-wave text-2xl"></i>
      </div>
      <div class="ml-5">
        <p class="text-4xl font-extrabold text-gray-900">₱<?= number_format($total_collected, 2) ?></p>
        <p class="text-sm text-teal-600 mt-1">as of <?= $month ?></p>
      </div>
    </div>
    <!-- <div class="mt-6">
      <a href="#" class="inline-flex items-center text-teal-600 hover:text-teal-800 text-sm font-medium transition-colors">
        View breakdown <i class="fas fa-arrow-right ml-1"></i>
      </a>
    </div> -->
  </div>


  <?php
  }
?>
<?php
$content = ob_get_clean();

$pageScripts = '

';

require_once $root . '/pages/layout.php';
?>
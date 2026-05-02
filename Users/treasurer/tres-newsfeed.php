<?php
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = "SELECT * FROM news_feed ORDER BY date_created DESC";
$result = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - NewsFeed</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
  <div class="min-h-screen flex">
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
        <a href="tres-project.php" class="flex items-center px-6 py-3 bg-teal-700">
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
            <h1 class="text-2xl font-bold text-gray-900">News Feed</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>

<body class="bg-gray-50">

  <div class="space-y-6">
      <?php while($row = mysqli_fetch_assoc($result)): ?>
      <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-4 border-b flex items-center justify-between">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2"><?= htmlspecialchars($row['post_title']) ?></h3>
                <p class="text-gray-700 mb-4"><?= nl2br(htmlspecialchars($row['description'])) ?></p>

                <!-- Images -->
                <div class="grid grid-cols-2 gap-2 mb-4">
                    <?php 
                        $images = !empty($row['post_images']) ? explode(",", $row['post_images']) : [];
                        foreach($images as $img):
                            if(!empty($img)):
                    ?>
                        <img src="../../uploads/images/<?= htmlspecialchars($img) ?>" 
                              alt="<?= htmlspecialchars($row['post_title']) ?>" 
                              class="rounded-lg w-full h-48 object-cover">
                    <?php 
                            endif;
                        endforeach;
                    ?>
                </div>

                <?php if(!empty($row['project_file'])): ?>
                    <a href="../../uploads/files/<?= htmlspecialchars($row['project_file']) ?>" target="_blank" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700">
                        <i class="fas fa-file-pdf mr-2"></i> View Project Details (PDF)
                    </a>
                <?php endif; ?>
            </div>
      </div>
      <?php endwhile; ?>
  </div>
</div>
</body>
</html>
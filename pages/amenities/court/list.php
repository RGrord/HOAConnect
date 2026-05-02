<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';

$pageTitle = 'Court Rentals';
ob_start();

$role = $_SESSION['role'];
?>

<div class="mt-1">
  <h3 class="text-2xl font-medium text-gray-900 mb-4"><?= $pageTitle ?></h3>

  <div class="flex flex-col sm:flex-row items-center mb-4 gap-3">
    <form class="flex flex-1 w-full">
      <div class="relative w-full">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <i class="ri-search-line text-gray-400"></i>
        </div>
        <input type="text" id="simple-search"
          class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-1 focus:ring-teal-600 focus:border-teal-600 block w-full ps-10 p-2.5 
                  bg-white placeholder-gray-400" 
          placeholder="Search <?= strtolower($pageTitle) ?>..." />
      </div>
    </form>
    <?php

    if($role == 3){
      ?>

    <a href="create.php" class="px-4 py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm font-medium transition whitespace-nowrap">Add Rental</a>


      <?php
    }

    ?>
    <?php if ($role == 3): ?>
    <button id="downloadPdfBtn" class="px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium transition whitespace-nowrap">Download PDF</button>
    <?php endif; ?>
  </div>

  <div class="relative shadow-md sm:rounded-lg border">
    <table id="dataTable" class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 uppercase bg-gray-100">
        <tr>
          <th class="px-6 py-3">Renter</th>
          <th class="px-6 py-3">Start Date</th>
          <th class="px-6 py-3">End Date</th>
          <th class="px-6 py-3">No. of Participants</th>
          <th class="px-6 py-3">Purpose</th>
          <th class="px-6 py-3">Amount</th>
          <th class="px-6 py-3">Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>

    <nav class="flex items-center justify-between p-4 text-sm">
      <span class="text-gray-500">
        Showing <span id="rangeStart">1</span>-<span id="rangeEnd">10</span>
        of <span id="totalRecords">0</span>
      </span>
      <ul id="paginationList" class="inline-flex -space-x-px h-8"></ul>
    </nav>
  </div>

  <!-- MODULE TRIGGER -->
  <div data-module="courtrentals"></div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '
  <script type="module" src="/hoa_system/ui/modules/amenities/court/get.court.js"></script>
';

require_once BASE_PATH . '/pages/layout.php';
?>

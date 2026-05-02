<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';

$pageTitle = 'Stall Rentals';
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

    if($role  == 3){
      ?>
        <a href="create-stall.php" class="px-4 py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm font-medium transition whitespace-nowrap">New Stall</a>
      <?php
    }

    ?>
  
  </div>

  <div class="relative overflow-x-auto shadow-md sm:rounded-lg border">
    <table id="dataTable" class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 uppercase bg-gray-100">
        <tr>
          <th class="px-6 py-3">Stall No.</th>
          <th class="px-6 py-3">Status</th>
          <th class="px-6 py-3">Date Created</th>
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
  <div data-module="stallrentals"></div>

   <div class="flex flex-wrap justify-end gap-4 pt-6 border-t border-gray-300">
      <a href="../list.php" 
          class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 font-medium transition">
          Back to List
      </a>
  </div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '
  <script type="module" src="/hoa_system/ui/modules/amenities/stall/get.available.stalls.js"></script>
';

require_once BASE_PATH . '/pages/layout.php';
?>

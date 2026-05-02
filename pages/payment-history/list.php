
<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
// require_once $root . 'app/includes/session.php';
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php');
$role = $_SESSION['role'];
$pageTitle = 'Payment History';
ob_start();
?>
<div class="mt-1">
  <div class="flex items-center justify-between">
    <h3 class="text-2xl font-medium text-gray-900 mb-4"><?= $pageTitle ?></h3>
     <?php if ($role == 4 || $role == 3): ?>
        <button id="downloadPdfBtn" class="px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium transition whitespace-nowrap">Download PDF</button>
        <?php endif; ?>
  </div>
  <div class="mb-4 border-b border-default">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
      <li class="me-2" role="presentation">
        <button id="homeowners-tab" data-tabs-target="#homeowners" type="button" role="tab" aria-controls="homeowners" aria-selected="false"
          class="inline-block p-4 border-b-2 rounded-t-lg border-transparent hover:text-teal-600 hover:border-teal-600 aria-selected:border-teal-600 aria-selected:text-teal-600">
          Homeowners
        </button>
      </li>
      <li class="me-2" role="presentation">
        <button id="tricycle-tab" data-tabs-target="#tricycle" type="button" role="tab" aria-controls="tricycle" aria-selected="false"
          class="inline-block p-4 border-b-2 rounded-t-lg border-transparent hover:text-teal-600 hover:border-teal-600 aria-selected:border-teal-600 aria-selected:text-teal-600">
          Tricycle
        </button>
      </li>
      <li class="me-2" role="presentation">
        <button id="stalls-tab" data-tabs-target="#stalls" type="button" role="tab" aria-controls="stalls" aria-selected="false"
          class="inline-block p-4 border-b-2 rounded-t-lg border-transparent hover:text-teal-600 hover:border-teal-600 aria-selected:border-teal-600 aria-selected:text-teal-600">
          Stalls
        </button>
      </li>
      <li role="presentation">
        <button id="court-tab" data-tabs-target="#court" type="button" role="tab" aria-controls="court" aria-selected="false"
          class="inline-block p-4 border-b-2 rounded-t-lg border-transparent hover:text-teal-600 hover:border-teal-600 aria-selected:border-teal-600 aria-selected:text-teal-600">
          Court
        </button>
      </li>
    </ul>
  </div>
  <div id="default-tab-content">
    <div class="hidden rounded-lg" id="homeowners" role="tabpanel" aria-labelledby="homeowners-tab">
      <div class="flex flex-col sm:flex-row items-center mb-4 gap-3">
        <form class="flex flex-1 w-full">
          <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <i class="ri-search-line text-gray-400"></i>
            </div>
            <input type="text" id="homeowner-fee-search" 
              class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-1 focus:ring-teal-600 focus:border-teal-600 block w-full ps-10 p-2.5 
                      bg-white placeholder-gray-400" 
              placeholder="Search <?= strtolower($pageTitle) ?>..." />
          </div>
        </form>
      </div>
      <div class="relative shadow-md sm:rounded-lg border">
        <table id="paymentHistoryTable" class="w-full text-sm text-left text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
              <th class="px-6 py-3">Payment Method</th>
              <th class="px-6 py-3">Homeowner</th>
              <th class="px-6 py-3">Amount Paid</th>
              <th class="px-6 py-3">Ref. No.</th>
              <th class="px-6 py-3">Date</th>
              <?php if($role == 1 || $role == 3 || $role == 4): ?>
              <th class="px-6 py-3"></th>  
              <?php endif; ?>
            </tr>
          </thead>
          <tbody></tbody>
        </table>

        <nav class="flex items-center justify-between p-4 text-sm">
          <span class="text-gray-500">
            Showing <span id="rangeStart">1</span>-<span id="rangeEnd">10</span>
            of <span id="totalRecords">0</span>
          </span>
          <ul id="homeowner_paginationList" class="inline-flex -space-x-px h-8"></ul>
        </nav>
      </div>
      <div data-module="payment-history"></div>
    </div>
  </div>
  <div id="default-tab-content">
    <div class="hidden rounded-lg" id="tricycle" role="tabpanel" aria-labelledby="tricycle-tab">
      <div class="flex flex-col sm:flex-row items-center mb-4 gap-3">
        <form class="flex flex-1 w-full">
          <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <i class="ri-search-line text-gray-400"></i>
            </div>
            <input type="text" id="toda-fee-search" 
              class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-1 focus:ring-teal-600 focus:border-teal-600 block w-full ps-10 p-2.5 
                      bg-white placeholder-gray-400" 
              placeholder="Search <?= strtolower($pageTitle) ?>..." />
          </div>
        </form>
      </div>
      <div class="relative shadow-md sm:rounded-lg border">
        <table id="todaHistoryTable" class="w-full text-sm text-left text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
              <th class="px-6 py-3">Payment Method</th>
              <th class="px-6 py-3">Fee Payer</th>
              <th class="px-6 py-3">Amount Paid</th>
              <th class="px-6 py-3">Date</th>
              <?php if($role == 1 || $role == 3 || $role == 4): ?>
              <th class="px-6 py-3"></th>  
              <?php endif; ?>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
        <nav class="flex items-center justify-between p-4 text-sm">
          <span class="text-gray-500">
            Showing <span id="rangeStart">1</span>-<span id="rangeEnd">10</span>
            of <span id="totalRecords">0</span>
          </span>
          <ul id="toda_paginationList" class="inline-flex -space-x-px h-8"></ul>
        </nav>
      </div>
      <div data-module="toda-history"></div>
    </div>
  </div>
  <div id="default-tab-content">
    <div class="hidden rounded-lg" id="stalls" role="tabpanel" aria-labelledby="stalls-tab">
      <div class="flex flex-col sm:flex-row items-center mb-4 gap-3">
        <form class="flex flex-1 w-full">
          <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <i class="ri-search-line text-gray-400"></i>
            </div>
            <input type="text" id="stall-fee-search" 
              class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-1 focus:ring-teal-600 focus:border-teal-600 block w-full ps-10 p-2.5 
                      bg-white placeholder-gray-400" 
              placeholder="Search <?= strtolower($pageTitle) ?>..." />
          </div>
        </form>
      </div>
      <div class="relative shadow-md sm:rounded-lg border">
        <table id="stallHistoryTable" class="w-full text-sm text-left text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
              <th class="px-6 py-3">Payment Method</th>
              <th class="px-6 py-3">Fee Payer</th>
              <th class="px-6 py-3">Amount Paid</th>
              <th class="px-6 py-3">Date</th>
              <?php if($role == 1 || $role == 3 || $role == 4): ?>
              <th class="px-6 py-3"></th>  
              <?php endif; ?>
            </tr>
          </thead>
          <tbody></tbody>
        </table>

        <nav class="flex items-center justify-between p-4 text-sm">
          <span class="text-gray-500">
            Showing <span id="rangeStart">1</span>-<span id="rangeEnd">10</span>
            of <span id="totalRecords">0</span>
          </span>
          <ul id="stall_paginationList" class="inline-flex -space-x-px h-8"></ul>
        </nav>
      </div>
      <div data-module="stall-history"></div>
    </div>
  </div>
  <div id="default-tab-content">
    <div class="hidden rounded-lg" id="court" role="tabpanel" aria-labelledby="court-tab">
      <div class="flex flex-col sm:flex-row items-center mb-4 gap-3">
        <form class="flex flex-1 w-full">
          <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <i class="ri-search-line text-gray-400"></i>
            </div>
            <input type="text" id="court-fee-search" 
              class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-1 focus:ring-teal-600 focus:border-teal-600 block w-full ps-10 p-2.5 
                      bg-white placeholder-gray-400" 
              placeholder="Search <?= strtolower($pageTitle) ?>..." />
          </div>
        </form>
      </div>
      <div class="relative shadow-md sm:rounded-lg border">
        <table id="courtHistoryTable" class="w-full text-sm text-left text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
              <th class="px-6 py-3">Payment Method</th>
              <th class="px-6 py-3">Fee Payer</th>
              <th class="px-6 py-3">Amount Paid</th>
              <th class="px-6 py-3">Date</th>
              <?php if($role == 1 || $role == 3 || $role == 4): ?>
              <th class="px-6 py-3"></th>  
              <?php endif; ?>
            </tr>
          </thead>
          <tbody></tbody>
        </table>

        <nav class="flex items-center justify-between p-4 text-sm">
          <span class="text-gray-500">
            Showing <span id="rangeStart">1</span>-<span id="rangeEnd">10</span>
            of <span id="totalRecords">0</span>
          </span>
          <ul id="court_paginationList" class="inline-flex -space-x-px h-8"></ul>
        </nav>
      </div>
      <div data-module="court-history"></div>
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();

$pageScripts = '
  <script type="module" src="/hoa_system/ui/modules/users/get.homeowners.js"></script>
  <script type="module" src="/hoa_system/ui/modules/payment-history/get.homeowners.fee.js"></script>
  <script type="module" src="/hoa_system/ui/modules/payment-history/get.amenities.toda.fee.js"></script>
  <script type="module" src="/hoa_system/ui/modules/payment-history/get.amenities.stall.fee.js"></script>
  <script type="module" src="/hoa_system/ui/modules/payment-history/get.amenities.court.fee.js"></script>
  <script>
  $("#downloadPdfBtn").on("click", function() {
    window.open("/hoa_system/app/api/payment-history/get.file.php", "_blank");
  });
  </script>
';

require_once BASE_PATH . '/pages/layout.php';
?>

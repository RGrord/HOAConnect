<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php');

$pageTitle = 'Payment Verification';
ob_start();
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
  </div>

  <div class="relative shadow-md sm:rounded-lg border">
    <table id="dataTable" class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 uppercase bg-gray-100">
        <tr>
          <th class="px-6 py-3">Name</th>
          <th class="px-6 py-3 text-ellipsis">Payment For</th>
          <th class="px-6 py-3">Amount Paid</th>
          <th class="px-6 py-3">Ref. No.</th>
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
</div>

<div id="paymentCheckingModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-lg w-full max-w-2xl shadow-2xl flex flex-col max-h-screen">
    <div class="border-b border-gray-200 px-6 py-4">
      <h2 class="text-2xl font-semibold text-gray-900">Preview</h2>
      <p class="text-sm text-gray-600 mt-1">Review and validate submitted payment</p>
    </div>
    <div class="flex-1 overflow-y-auto px-6 py-5">
      <div id="payment-check-details" class="space-y-4 mb-6">
      </div>
      <form id="payment-checking-form" class="space-y-5">
        <input type="hidden" id="verify_payment_id">
        <div>
          <label class="text-sm font-medium text-gray-700">Payer Name</label>
          <input type="text" id="payer-name" class="mt-1 border bg-gray-50 border-gray-300 py-2.5 px-4 rounded-lg w-full" readonly>
        </div>
        <div>
          <label class="text-sm font-medium text-gray-700">Submitted Amount</label>
          <input type="text" id="submitted-amount" class="mt-1 font-bold text-green-600 bg-gray-50 border border-gray-300 py-2.5 px-4 rounded-lg w-full" readonly>
        </div>
        <div>
          <label class="text-sm font-medium text-gray-700">Payment Method</label>
          <input type="text" id="submitted-method" class="mt-1 border bg-gray-50 border-gray-300 py-2.5 px-4 rounded-lg w-full" readonly>
        </div>
        <div>
          <label class="text-sm font-medium text-gray-700">Reference No.</label>
          <input type="text" id="submitted-reference" class="mt-1 border bg-gray-50 border-gray-300 py-2.5 px-4 rounded-lg w-full" readonly>
        </div>
        <div>
          <label class="text-sm font-medium text-gray-700">Payment Proof (if provided)</label>
          <div id="payment-proof-container" class="mt-1 bg-gray-50 border border-gray-300 rounded-lg p-3 text-center">
          </div>
        </div>
        <div>
          <label class="text-sm font-medium text-gray-700">Remarks</label>
          <textarea id="verify-remarks" rows="3" class="mt-1 border border-gray-300 py-2.5 px-4 rounded-lg w-full"></textarea>
        </div>
      </form>
    </div>

    <div class="border-t border-gray-200 px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end gap-3">
      <button id="closePaymentCheckingModal" type="button"
        class="px-6 py-2.5 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
        Cancel
      </button>

      <button id="declinePayment" type="button"
        class="px-8 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
        Decline
      </button>

      <button id="approvePayment" type="button"
        class="px-8 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
        Approve
      </button>
    </div>

  </div>
</div>


<?php
$content = ob_get_clean();

$pageScripts = '
<script type="module" src="/hoa_system/ui/modules/payment-verification/get.allVerification.js"></script>
';

require_once BASE_PATH . '/pages/layout.php';
?>

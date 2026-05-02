<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';

$pageTitle = 'Homeowner Fees';
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
          <th class="px-6 py-3">Amount Due</th>
          <th class="px-6 py-3">Status</th>
          <th class="px-6 py-3">Due Date</th>
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
  <div data-module="homeowners"></div>
</div>

<div id="feeDetailsModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
  <div class="bg-white w-full max-w-2xl rounded-lg shadow-xl p-6 relative">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold text-gray-800">Fees</h2>
      <button id="closeFeeModal" 
        class="text-gray-500 hover:text-gray-800 text-xl">
        <i class="ri-close-line"></i>
      </button>
    </div>
    <div id="feeDetailsContent" class="space-y-3"></div>

    <!-- FOOTER -->
    <div class="mt-4 flex justify-end">
      <button id="proceedWalkIn" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
        Walk-In Payment
      </button>
    </div>
  </div>
</div>

<div id="walkInPaymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"> 
  <div class="bg-white rounded-lg w-full max-w-2xl shadow-2xl flex flex-col max-h-screen"> 
    <div class="border-b border-gray-200 px-6 py-4"> 
      <h2 class="text-2xl font-semibold text-gray-900">Walk-In Payment</h2> 
      <p class="text-sm text-gray-600 mt-1">Record payment for selected fees</p> 
    </div> 
    <div class="flex-1 overflow-y-auto px-6 py-5"> 
      <div id="selected-fees-details" class="space-y-3 mb-6"></div> 
      <form id="walk-in-payment-form" class="space-y-5"> 
        <input type="hidden" id="user_id" value="<?= $user_id ?>"> 
        <div> 
          <label class="text-sm font-medium text-gray-700">Total Amount</label> 
          <input type="text" id="amount" class="mt-1 input border border-gray-300 w-full font-bold text-lg text-green-600 bg-gray-50 py-2.5 px-4 rounded-lg " readonly> 
        </div> 
        <div> 
          <label class="text-sm font-medium text-gray-700">Payment Method</label> 
          <select id="payment-method" class="mt-1 border border-gray-300 py-2.5 px-4 rounded-lg w-full" required> 
            <option value="Cash">Cash</option> 
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="GCash">GCash</option> 
          </select> 
        </div> 
        <div> 
          <label class="text-sm font-medium text-gray-700">Payment Date</label> 
          <input type="date" id="payment-date" value="<?= date('Y-m-d') ?>" class="mt-1 border border-gray-300 py-2.5 px-4 rounded-lg w-full" required> </div> 
        <div> 
          <label class="text-sm font-medium text-gray-700">Receipt / Reference No.</label> 
          <input type="text" id="receipt-name" placeholder="e.g. OR#12345, GCash Ref#..." class="mt-1 border border-gray-300 py-2.5 px-4 rounded-lg w-full" required> 
        </div> 
        <div>
          <label class="text-sm font-medium text-gray-700">Proof of Payment (Optional)</label>
          <input type="file" id="payment-proof" accept="image/*,application/pdf" class="mt-1 border border-gray-300 py-2.5 px-4 rounded-lg w-full">
          <p class="text-xs text-gray-400 mt-1">Upload image or PDF of your receipt/reference.</p>
        </div>
        <div> 
          <label class="text-sm font-medium text-gray-700">Remarks (Optional)</label> 
          <textarea id="remarks" rows="3" class="mt-1 border border-gray-300 py-2.5 px-4 rounded-lg w-full"></textarea> 
        </div> 
      </form> 
    </div> 
    <div class="border-t border-gray-200 px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end gap-3"> 
      <button type="button" id="closeModal" class="px-6 py-2.5 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition"> Cancel </button> 
      <button type="submit" form="walk-in-payment-form" class="px-8 py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition"> Submit Payment </button> 
    </div> 
  </div> 
</div>

<div id="assignFeesModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg w-full max-w-2xl shadow-2xl flex flex-col max-h-screen">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-2xl font-semibold text-gray-900">Assign Fees</h2>
            <p class="text-sm text-gray-600 mt-1">Select fees to assign to the homeowner</p>
        </div>

        <div class="flex-1 overflow-y-auto px-6 py-5">
            <div id="available-fees-list" class="space-y-3 mb-6">
                <div class="text-gray-500">Loading available fees...</div>
            </div>

            <form id="assign-fees-form" class="space-y-5">
                <input type="hidden" id="assign_user_id" value="">
            </form>
        </div>

        <div class="border-t border-gray-200 px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end gap-3">
            <button type="button" id="closeAssignModal"
                    class="px-6 py-2.5 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </button>
            <button type="submit" form="assign-fees-form"
                    class="px-8 py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                Assign Selected Fees
            </button>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '
<script type="module" src="/hoa_system/ui/modules/fee-assignation/get.homeowners.js"></script>
';

require_once BASE_PATH . '/pages/layout.php';
?>

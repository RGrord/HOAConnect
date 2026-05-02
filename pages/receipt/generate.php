<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';

$pageTitle = 'Homeowners';
ob_start();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-100">
    <div class="flex items-center mb-6">
      <div class="bg-teal-100 p-3 rounded-lg mr-4">
        <i class="fas fa-file-invoice text-teal-600 text-2xl"></i>
      </div>
      <div>
        <h2 class="text-2xl font-bold text-gray-900">Generate Receipt</h2>
        <p class="text-sm text-gray-500">Fill in the details below to create an acknowledgement receipt</p>
      </div>
    </div>
    
    <form id="receiptForm" class="space-y-5">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label for="receiptNo" class="block text-sm font-semibold text-gray-700 mb-2">
            <i class="fas fa-hashtag text-teal-600 mr-1"></i> Receipt No.
          </label>
          <input type="text" id="receiptNo" name="receiptNo" readonly class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 bg-gray-50 text-gray-700 font-medium focus:ring-2 focus:ring-teal-500 focus:border-transparent"/>
        </div>
        <div>
          <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">
            <i class="fas fa-calendar text-teal-600 mr-1"></i> Date
          </label>
          <input type="date" id="date" name="date" required class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-teal-500 focus:border-transparent"/>
        </div>
      </div>

      <div class="bg-teal-50 p-5 rounded-lg border border-teal-100">
        <h3 class="text-sm font-bold text-teal-900 mb-4 uppercase tracking-wide">Party Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label for="receiverName" class="block text-sm font-semibold text-gray-700 mb-2">
              <i class="fas fa-user-check text-teal-600 mr-1"></i> Name of Receiver
            </label>
            <input type="text" id="receiverName" name="receiverName" required class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-teal-500 focus:border-transparent"/>
          </div>
          <div>
            <label for="payerName" class="block text-sm font-semibold text-gray-700 mb-2">
              <i class="fas fa-user text-teal-600 mr-1"></i> Name of Payer
            </label>
            <input type="text" id="payerName" name="payerName" required class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-teal-500 focus:border-transparent"/>
          </div>
        </div>
      </div>

      <div class="bg-blue-50 p-5 rounded-lg border border-blue-100">
        <h3 class="text-sm font-bold text-blue-900 mb-4 uppercase tracking-wide">Payment Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
              <i class="fas fa-peso-sign text-blue-600 mr-1"></i> Amount (₱)
            </label>
            <input type="number" id="amount" name="amount" step="0.01" min="0" required class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent"/>
          </div>
          <div>
            <label for="paymentMethod" class="block text-sm font-semibold text-gray-700 mb-2">
              <i class="fas fa-credit-card text-blue-600 mr-1"></i> Payment Method
            </label>
            <select id="paymentMethod" name="paymentMethod" required class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              <option value="CASH">CASH</option>
              <option value="GCASH">GCASH</option>
              <option value="BANK TRANSFER">BANK TRANSFER</option>
            </select>
          </div>
        </div>
        <div class="mt-5">
          <label for="purpose" class="block text-sm font-semibold text-gray-700 mb-2">
            <i class="fas fa-clipboard-list text-blue-600 mr-1"></i> Purpose
          </label>
          <input type="text" id="purpose" name="purpose" required class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent"/>
        </div>
      </div>

      <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
        <h3 class="text-sm font-bold text-gray-700 mb-4 uppercase tracking-wide">Additional Information (Optional)</h3>
        <div class="space-y-4">
          <div>
            <label for="referenceNumber" class="block text-sm font-semibold text-gray-700 mb-2">
              <i class="fas fa-barcode text-gray-600 mr-1"></i> Reference Number
            </label>
            <input type="text" id="referenceNumber" name="referenceNumber" class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-gray-400 focus:border-transparent"/>
          </div>
          <div>
            <label for="remarks" class="block text-sm font-semibold text-gray-700 mb-2">
              <i class="fas fa-comment-dots text-gray-600 mr-1"></i> Remarks
            </label>
            <input type="text" id="remarks" name="remarks" class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-gray-400 focus:border-transparent"/>
          </div>
        </div>
      </div>

      <div class="flex justify-end pt-4">
        <button type="submit" class="py-3 px-8 border border-transparent rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
          <i class="fas fa-file-pdf mr-2"></i> Generate Receipt
        </button>
      </div>
    </form>
  </div>

<?php
$content = ob_get_clean();

$pageScripts = '
  <script type="module" src="/hoa_system/ui/modules/users/get.homeowners.js"></script>
';

require_once BASE_PATH . '/pages/layout.php';
?>
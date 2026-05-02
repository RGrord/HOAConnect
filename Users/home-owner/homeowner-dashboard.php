<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HOAConnect - Homeowner Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
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
          <a href="homeowner-dashboard.php" class="flex items-center px-6 py-3 bg-teal-700">
              <i class="fas fa-tachometer-alt mr-3"></i>
              <span>Dashboard</span>
          </a>

          <!-- Payments Dropdown -->
          <div x-data="{ open: false }" class="relative">
              <button
                  @click="open = !open"
                  :aria-expanded="open"
                  AIML
                  class="flex items-center px-6 py-3 w-full text-left hover:bg-teal-600 focus:outline-none"
              >
                  <i class="fas fa-credit-card mr-3"></i>
                  <span>Payments</span>
                  <i
                      :class="{ 'rotate-180': open }"
                      class="fas fa-chevron-down ml-auto transform transition-transform duration-200"
                  ></i>
              </button>
              <div
                  x-show="open"
                  x-cloak
                  class="bg-teal-800"
              >
                  <a
                      href="homeowner-payment.php"
                      class="flex items-center px-8 py-2 hover:bg-teal-600"
                  >
                      <i class="fas fa-wallet mr-2"></i>
                      View Payments
                  </a>
                  <a
                      href="homeowner-history.php"
                      class="flex items-center px-8 py-2 hover:bg-teal-600"
                  >
                      <i class="fas fa-history mr-2"></i>
                      Payment History
                  </a>
              </div>
          </div>
          <!--End Payment Dropdown-->
          
          <a href="homeowner-hoa-projects.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-gavel mr-3"></i>
            <span>Resolution</span>
          </a>
          <a href="homeowner-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-newspaper mr-3"></i>
            <span>News Feed</span>
          </a>
          <a href="homeowner-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-book mr-3"></i>
            <span>Ledger</span>
          </a>
          <a href="homeowner-message.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
              <i class="fas fa-comments mr-3"></i>
              <span>Messages</span>
          </a>
          <a href="homeowner-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
              <i class="fas fa-calendar-alt mr-3"></i>
              <span>Calendar</span>
          </a>
          <a href="homeowner-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-user-circle mr-3"></i>
            <span>Profile</span>
        </a> 
      </nav>
      <div class="px-6 py-4 mt-auto">
          <button
              class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded flex items-center justify-center"
          >
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </button>
      </div>
      </div>

      <!-- Main Content -->
      <div class="flex-1 overflow-x-hidden overflow-y-auto">
        <header class="bg-white shadow-md">
          <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
              <h1 class="text-2xl font-bold text-gray-900">Homeowner's Dashboard</h1>
              <div class="flex items-center space-x-2">
                <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                  <i class="fas fa-bell"></i>
                </button>
              </div>
            </div>
      </header>

        <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <!-- Welcome Banner -->
          <div
            class="bg-gradient-to-r from-teal-500 to-teal-700 rounded-lg shadow-lg mb-8"
          >
            <div
              class="p-6 md:p-8 flex flex-col md:flex-row items-center justify-between"
            >
              <div class="mb-4 md:mb-0">
                <h2 class="text-2xl font-bold text-white">
                  Welcome, Maria Santos!
                </h2>
                <p class="text-teal-100 mt-1">
                  Block 5 Lot 12, Phase 1, Mabuhay Homes 2000
                </p>
              </div>
              <div
                class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2"
              ></div>
            </div>
          </div>

          
          <!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

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
        <p class="text-4xl font-extrabold text-gray-900">₱125,000</p>
        <p class="text-sm text-teal-600 mt-1">as of Sept 2025</p>
      </div>
    </div>
    <div class="mt-6">
      <a href="#" class="inline-flex items-center text-teal-600 hover:text-teal-800 text-sm font-medium transition-colors">
        View breakdown <i class="fas fa-arrow-right ml-1"></i>
      </a>
    </div>
  </div>

  <!-- Upcoming Events Card -->
  <div class="bg-gradient-to-br from-white to-teal-50 rounded-2xl shadow-lg p-6 border border-teal-100 hover:shadow-2xl transition-shadow duration-300">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold text-gray-800">Upcoming Events</h3>
      <span class="bg-teal-100 text-teal-800 text-xs font-medium px-3 py-1 rounded-full shadow-sm">
        Community
      </span>
    </div>
    <div class="space-y-4">
      <!-- Event 1 -->
      <div class="flex items-start group hover:bg-teal-50 rounded-lg p-2 transition">
        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-teal-100 flex items-center justify-center text-teal-600 shadow-inner group-hover:bg-teal-500 group-hover:text-white transition-colors">
          <i class="fas fa-calendar-day"></i>
        </div>
        <div class="ml-4">
          <p class="text-sm font-semibold text-gray-800">Community Clean-up Day</p>
          <p class="text-xs text-gray-500">May 15, 2025 • 8:00 AM</p>
        </div>
      </div>
      <!-- Event 2 -->
      <div class="flex items-start group hover:bg-teal-50 rounded-lg p-2 transition">
        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-teal-100 flex items-center justify-center text-teal-600 shadow-inner group-hover:bg-teal-500 group-hover:text-white transition-colors">
          <i class="fas fa-glass-cheers"></i>
        </div>
        <div class="ml-4">
          <p class="text-sm font-semibold text-gray-800">Summer Festival</p>
          <p class="text-xs text-gray-500">May 28, 2025 • 4:00 PM</p>
        </div>
      </div>
      <!-- Event 3 -->
      <div class="flex items-start group hover:bg-teal-50 rounded-lg p-2 transition">
        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-teal-100 flex items-center justify-center text-teal-600 shadow-inner group-hover:bg-teal-500 group-hover:text-white transition-colors">
          <i class="fas fa-users"></i>
        </div>
        <div class="ml-4">
          <p class="text-sm font-semibold text-gray-800">HOA General Assembly</p>
          <p class="text-xs text-gray-500">June 10, 2025 • 2:00 PM</p>
        </div>
      </div>
    </div>
    <div class="mt-6 text-right">
      <a href="homeowner-calendar.html" class="inline-flex items-center text-teal-600 hover:text-teal-800 text-sm font-medium transition-colors">
        View all events <i class="fas fa-arrow-right ml-1"></i>
      </a>
    </div>
  </div>

</div>


          <!-- Payments Table -->
          <div class="bg-white rounded-lg shadow mb-8">
            <div
              class="px-6 py-4 border-b border-gray-200 flex justify-between items-center"
            >
              <h2 class="text-lg font-medium">Payments</h2>
              <button
                class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-500"
              >
                View all payments
              </button>
            </div>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Fee ID
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Fee Name
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Amount
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Due Date
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Status
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="paymentTableBody">
                  <!-- Table will be populated by JavaScript -->
                </tbody>
              </table>
            </div>
            <div
              class="px-6 py-4 border-t border-gray-200 flex items-center justify-between"
            >
              <div class="text-sm text-gray-500">
                Showing <span id="showingFrom">1</span> to <span id="showingTo">2</span> of <span id="totalEntries">2</span> entries
              </div>
              <div class="flex space-x-2">
                <button id="prevPage" class="px-3 py-1 border rounded text-sm bg-gray-100">Previous</button>
                <button id="currentPage" class="px-3 py-1 border rounded text-sm bg-teal-600 text-white">1</button>
                <button id="nextPage" class="px-3 py-1 border rounded text-sm bg-gray-100">Next</button>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>

    <!-- Pay Now Modal -->
    <div id="payNowModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
          <h3 class="text-lg font-medium">Make a Payment</h3>
          <button onclick="closePayNowModal()" class="text-gray-400 hover:text-gray-500">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="p-6">
          <div class="mb-4">
            <h4 class="text-sm font-medium text-gray-700 mb-2">Payment Details</h4>
            <p class="text-sm text-gray-900">Payment ID: <span id="payNowPaymentId"></span></p>
            <p class="text-sm text-gray-900">Fee ID: <span id="payNowUserId"></span></p>
            <p class="text-sm text-gray-900">Fee Name: <span id="payNowFeeName"></span></p>
            <p class="text-sm text-gray-900">Amount: <span id="payNowAmount"></span></p>
            <p class="text-sm text-gray-900">Due Date: <span id="payNowDate"></span></p>
            <p class="text-sm text-gray-900">Status: <span id="payNowStatus"></span></p>
          </div>
          <h4 class="text-sm font-medium text-gray-700 mb-2">Payment Method</h4>
          <div class="flex justify-center space-x-6">
            <button onclick="showGCashModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-28">GCash</button>
            <button onclick="showBankTransferModal()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-28">Bank Transfer</button>
          </div>
        </div>
      </div>
    </div>

    <!-- GCash Payment Modal -->
    <div id="gcashModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
          <h3 class="text-lg font-medium">GCash Payment</h3>
          <button onclick="closeGCashModal()" class="text-gray-400 hover:text-gray-500">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="p-6">
          <form id="gcashForm">
            <div class="mb-4">
              <h4 class="text-sm font-medium text-gray-700 mb-2">Payment Details</h4>
              <p class="text-sm text-gray-900">Payment ID: <span id="gcashPaymentId"></span></p>
              <p class="text-sm text-gray-900">Fee ID: <span id="gcashUserId"></span></p>
              <p class="text-sm text-gray-900">Fee Name: <span id="gcashFeeName"></span></p>
              <p class="text-sm text-gray-900">Amount: <span id="gcashAmount"></span></p>
            </div>
            <div class="mb-4 bg-gray-100 p-4 rounded-md shadow-sm">
              <h4 class="text-sm font-medium text-gray-700 mb-2">GCash Details</h4>
              <p class="text-sm text-gray-900">GCash Number: 0917 123 4567</p>
              <p class="text-sm text-gray-900">GCash Name: Mabuhay Homes 2000 HOA</p>
              <div class="mt-2">
                <p class="text-sm font-medium text-gray-700">Scan GCash QR Code</p>
                <img src="https://via.placeholder.com/150" alt="GCash QR Code" class="w-32 h-32 mt-2">
              </div>
            </div>
            <div class="mb-4">
              <h4 class="text-sm font-medium text-gray-700 mb-2">Proof of Payment</h4>
              <div class="mb-2">
                <label for="gcashReceipt" class="block text-sm font-medium text-gray-700 mb-1">Upload Receipt</label>
                <input type="file" id="gcashReceipt" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md">
              </div>
            </div>
            <div class="mt-6">
              <button type="submit" class="w-full bg-teal-600 hover:bg-teal-500 text-white font-medium py-2 px-4 rounded">Submit Receipt</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Bank Transfer Payment Modal -->
    <div id="bankTransferModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
          <h3 class="text-lg font-medium">Bank Transfer Payment</h3>
          <button onclick="closeBankTransferModal()" class="text-gray-400 hover:text-gray-500">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="p-6">
          <form id="bankTransferForm">
            <div class="mb-4">
              <h4 class="text-sm font-medium text-gray-700 mb-2">Payment Details</h4>
              <p class="text-sm text-gray-900">Payment ID: <span id="bankPaymentId"></span></p>
              <p class="text-sm text-gray-900">Fee ID: <span id="bankUserId"></span></p>
              <p class="text-sm text-gray-900">Fee Name: <span id="bankFeeName"></span></p>
              <p class="text-sm text-gray-900">Amount: <span id="bankAmount"></span></p>
            </div>
            <div class="mb-4 bg-gray-100 p-4 rounded-md shadow-sm">
              <h4 class="text-sm font-medium text-gray-700 mb-2">Bank Details</h4>
              <p class="text-sm text-gray-900">Bank Name: BDO</p>
              <p class="text-sm text-gray-900">Account Number: 1234 5678 9012</p>
              <p class="text-sm text-gray-900">Account Name: Mabuhay Homes 2000 HOA</p>
            </div>
            <div class="mb-4">
              <h4 class="text-sm font-medium text-gray-700 mb-2">Proof of Payment</h4>
              <div class="mb-2">
                <label for="bankReceipt" class="block text-sm font-medium text-gray-700 mb-1">Upload Receipt</label>
                <input type="file" id="bankReceipt" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md">
              </div>
            </div>
            <div class="mt-6">
              <button type="submit" class="w-full bg-teal-600 hover:bg-teal-500 text-white font-medium py-2 px-4 rounded">Submit Receipt</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      // Mock database to store payment data and proofs
      const paymentData = {
        'PAY001': { paymentId: 'PAY001', feeId: 'FEE001', feeName: 'Monthly Dues Fee - March 2025', amount: '50', dueDate: '2025-03-31', status: 'Overdue', proof: '', paymentMethod: '' },
        'PAY002': { paymentId: 'PAY002', feeId: 'FEE002', feeName: 'Monthly Dues Fee - April 2025', amount: '50', dueDate: '2025-04-30', status: 'Overdue', proof: '', paymentMethod: '' },
        'PAY003': { paymentId: 'PAY003', feeId: 'FEE003', feeName: 'Monthly Dues Fee - May 2025', amount: '50', dueDate: '2025-05-31', status: 'Pending', proof: 'https://via.placeholder.com/150', paymentMethod: 'GCash' },
        'PAY004': { paymentId: 'PAY004', feeId: 'FEE004', feeName: 'Monthly Dues Fee - February 2025', amount: '50', dueDate: '2025-02-28', status: 'Paid', proof: '', paymentMethod: 'GCash' },
        'PAY005': { paymentId: 'PAY005', feeId: 'FEE005', feeName: 'Monthly Dues Fee - January 2025', amount: '50', dueDate: '2025-01-31', status: 'Paid', proof: '', paymentMethod: 'Bank Transfer' }
      };

      // Show Pay Now modal with details
      function showPayNowModal(paymentId, feeId, feeName, amount, dueDate, status) {
        document.getElementById('payNowPaymentId').textContent = paymentId;
        document.getElementById('payNowUserId').textContent = feeId;
        document.getElementById('payNowFeeName').textContent = feeName;
        document.getElementById('payNowAmount').textContent = `₱${amount}`;
        document.getElementById('payNowDate').textContent = dueDate;
        document.getElementById('payNowStatus').textContent = status;
        document.getElementById('payNowModal').classList.remove('hidden');
      }

      function closePayNowModal() {
        document.getElementById('payNowModal').classList.add('hidden');
      }

      // Modal functions for payment methods
      function showGCashModal() {
        document.getElementById('payNowModal').classList.add('hidden');
        document.getElementById('gcashModal').classList.remove('hidden');
      }

      function closeGCashModal() {
        document.getElementById('gcashModal').classList.add('hidden');
        document.getElementById('payNowModal').classList.remove('hidden');
      }

      function showBankTransferModal() {
        document.getElementById('payNowModal').classList.add('hidden');
        document.getElementById('bankTransferModal').classList.remove('hidden');
      }

      function closeBankTransferModal() {
        document.getElementById('bankTransferModal').classList.add('hidden');
        document.getElementById('payNowModal').classList.remove('hidden');
      }

      // Handle form submissions
      document.getElementById('gcashForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const paymentId = document.getElementById('gcashPaymentId').textContent;
        const fileInput = document.getElementById('gcashReceipt');
        if (fileInput.files[0]) {
          const reader = new FileReader();
          reader.onload = function(e) {
            paymentData[paymentId].status = 'Pending';
            paymentData[paymentId].proof = e.target.result;
            paymentData[paymentId].paymentMethod = 'GCash';
            updateTable();
            closePayNowModal();
            closeGCashModal();
          };
          reader.readAsDataURL(fileInput.files[0]);
        }
      });

      document.getElementById('bankTransferForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const paymentId = document.getElementById('bankPaymentId').textContent;
        const fileInput = document.getElementById('bankReceipt');
        if (fileInput.files[0]) {
          const reader = new FileReader();
          reader.onload = function(e) {
            paymentData[paymentId].status = 'Pending';
            paymentData[paymentId].proof = e.target.result;
            paymentData[paymentId].paymentMethod = 'Bank Transfer';
            updateTable();
            closePayNowModal();
            closeBankTransferModal();
          };
          reader.readAsDataURL(fileInput.files[0]);
        }
      });

      // Update table
      function updateTable() {
        const tbody = document.getElementById('paymentTableBody');
        tbody.innerHTML = '';
        const sortedPayments = Object.values(paymentData)
          .filter(payment => payment.status !== 'Paid')
          .sort((a, b) => new Date(b.dueDate) - new Date(a.dueDate));

        sortedPayments.forEach(payment => {
          const row = document.createElement('tr');
          row.setAttribute('data-payment-id', payment.paymentId);
          row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">${payment.feeId}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">${payment.feeName}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">₱${payment.amount}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">${payment.dueDate}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                ${payment.status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                  payment.status === 'Unpaid' ? 'bg-red-100 text-red-800' : 'bg-orange-100 text-orange-800'}">
                ${payment.status}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              ${payment.status === 'Pending' ? 
                `<button onclick="viewPayment('${payment.paymentId}', '${payment.feeId}', '${payment.feeName}', '${payment.amount}', '${payment.dueDate}', '${payment.status}', '${payment.paymentMethod || ''}')" class="bg-teal-600 text-white px-3 py-1 rounded hover:bg-teal-500 w-20">View</button>` :
                `<button onclick="showPayNowModal('${payment.paymentId}', '${payment.feeId}', '${payment.feeName}', '${payment.amount}', '${payment.dueDate}', '${payment.status}')" class="bg-teal-600 text-white px-3 py-1 rounded hover:bg-teal-500 w-20">Pay Now</button>`}
            </td>
          `;
          tbody.appendChild(row);
        });

        const totalEntries = sortedPayments.length;
        document.getElementById('totalEntries').textContent = totalEntries;
        const showingFrom = 1;
        const showingTo = Math.min(2, totalEntries);
        document.getElementById('showingFrom').textContent = showingFrom;
        document.getElementById('showingTo').textContent = showingTo;
      }

      // Pagination controls
      let currentPage = 1;
      const itemsPerPage = 2;
      const prevPageBtn = document.getElementById('prevPage');
      const nextPageBtn = document.getElementById('nextPage');

      function paginateTable() {
        const tbody = document.getElementById('paymentTableBody');
        const sortedPayments = Object.values(paymentData)
          .filter(payment => payment.status !== 'Paid')
          .sort((a, b) => new Date(b.dueDate) - new Date(a.dueDate));
        const totalPages = Math.ceil(sortedPayments.length / itemsPerPage);
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const paginatedData = sortedPayments.slice(start, end);

        tbody.innerHTML = '';
        paginatedData.forEach(payment => {
          const row = document.createElement('tr');
          row.setAttribute('data-payment-id', payment.paymentId);
          row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">${payment.feeId}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">${payment.feeName}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">₱${payment.amount}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">${payment.dueDate}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                ${payment.status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                  payment.status === 'Unpaid' ? 'bg-red-100 text-red-800' : 'bg-orange-100 text-orange-800'}">
                ${payment.status}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              ${payment.status === 'Pending' ? 
                `<button onclick="viewPayment('${payment.paymentId}', '${payment.feeId}', '${payment.feeName}', '${payment.amount}', '${payment.dueDate}', '${payment.status}', '${payment.paymentMethod || ''}')" class="bg-teal-600 text-white px-3 py-1 rounded hover:bg-teal-500 w-20">View</button>` :
                `<button onclick="showPayNowModal('${payment.paymentId}', '${payment.feeId}', '${payment.feeName}', '${payment.amount}', '${payment.dueDate}', '${payment.status}')" class="bg-teal-600 text-white px-3 py-1 rounded hover:bg-teal-500 w-20">Pay Now</button>`}
            </td>
          `;
          tbody.appendChild(row);
        });

        const totalEntries = sortedPayments.length;
        const showingFrom = start + 1;
        const showingTo = Math.min(end, totalEntries);
        document.getElementById('showingFrom').textContent = showingFrom;
        document.getElementById('showingTo').textContent = showingTo;
        document.getElementById('totalEntries').textContent = totalEntries;

        prevPageBtn.disabled = currentPage === 1;
        nextPageBtn.disabled = currentPage === totalPages;
      }

      prevPageBtn.addEventListener('click', () => {
        if (currentPage > 1) {
          currentPage--;
          paginateTable();
        }
      });

      nextPageBtn.addEventListener('click', () => {
        const totalPages = Math.ceil(Object.values(paymentData).filter(payment => payment.status !== 'Paid').length / itemsPerPage);
        if (currentPage < totalPages) {
          currentPage++;
          paginateTable();
        }
      });

      // Sidebar Navigation Highlighting
      document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname.split('/').pop();
        const sidebarLinks = document.querySelectorAll('nav a');

        sidebarLinks.forEach(link => {
          const href = link.getAttribute('href');
          // Highlight only the current page
          if (href === currentPath) {
            link.classList.add('bg-teal-600');
          }

          link.addEventListener('click', function(e) {
            // Prevent default if already on the same page
            if (href === currentPath) {
              e.preventDefault();
            }
            // Only highlight if not a dropdown item on dashboard
            if (currentPath !== 'homeowner-dashboard.html' || !link.closest('[x-show]')) {
              sidebarLinks.forEach(l => l.classList.remove('bg-teal-600'));
              link.classList.add('bg-teal-600');
            }
          });
        });

        paginateTable();
      });
    </script>
  </body>
</html>
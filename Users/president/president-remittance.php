<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>HOAConnect - Remittance</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
    <a href="president-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-tachometer-alt mr-3"></i>
      <span>Dashboard</span>
    </a>
    <a href="president-accounts.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-user-gear mr-3"></i>
      <span>Admin Management</span>
    </a>
    <a href="registered-homeowners.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-home mr-3"></i>
      <span>Homeowners</span>
    </a>
    <a href="president-feetype.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-money-check mr-3"></i>
      <span>Fee Type</span>
    </a>
    <a href="president-projectproposal.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-gavel mr-3"></i>
      <span>Resolution</span>
    </a>
    <a href="president-liquidation.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-file-invoice-dollar mr-3"></i>
      <span>Liquidation of Expenses</span>
    </a>
    <a href="president-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-book mr-3"></i>
      <span>Ledger</span>
    </a>
    <a href="president-remittance.php" class="flex items-center px-6 py-3 bg-teal-700">
      <i class="fas fa-money-check mr-3"></i>
      <span>Remittance</span>
    </a>
    <a href="president-payment-history.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-receipt mr-3"></i>
      <span>Payment History</span>
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
          <button @click="window.location.href='president-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
            <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
            <span class="flex-1 text-left">Tricycle</span>
          </button>
        </div>

        <!-- Court Navigation -->
        <div class="relative">
          <button @click="window.location.href='president-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
            <i class="fas fa-basketball-ball mr-2" title="Court"></i>
            <span class="flex-1 text-left">Court</span>
          </button>
        </div>

        <!-- Stall Navigation -->
        <div class="relative">
          <button @click="window.location.href='president-stall.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
            <i class="fas fa-store mr-2" title="Stall"></i>
            <span class="flex-1 text-left">Stall</span>
          </button>
        </div>
      </div>
    </div>

    <a href="president-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-newspaper mr-3"></i>
      <span>News Feed</span>
    </a>
    <a href="president-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-calendar-alt mr-3"></i>
      <span>Calendar</span>
    </a>
    <a href="president-logs.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-history mr-3"></i>
      <span>Activity Logs</span>
    </a>
    <a href="president-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
<!--End of sidebar-->


  
  <!-- Main Content -->
  <div class="flex-1 overflow-x-hidden overflow-y-auto">
    <header class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
          <h1 class="text-2xl font-bold text-gray-900">Remittance</h1>
          <div class="flex items-center space-x-2">
            <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
              <i class="fas fa-bell"></i>
            </button>
          </div>
        </div>
  </header>
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <!-- Payment History Section -->
      <div id="payment-history-section" class="mb-8">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-semibold text-gray-900">Daily Payment History</h2>
          <div class="flex items-center space-x-6 bg-teal-50 border border-teal-200 rounded-xl px-6 py-3 shadow-sm">
            <div>
              <p class="text-sm font-medium text-teal-700">Total Collected (₱)</p>
              <p id="totalCollected" class="text-2xl font-bold text-black-900">0</p>
            </div>
          </div>
        </div>
        <div class="bg-white shadow rounded-lg overflow-hidden">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Name</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount (₱)</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                </tr>
              </thead>
              <tbody id="paymentHistoryTableBody" class="bg-white divide-y divide-gray-200">
                <!-- Payment history entries will be rendered dynamically -->
              </tbody>
            </table>
          </div>
          <!-- Pagination -->
          <div class="border-t border-gray-200 bg-gray-50 px-6 py-3 flex justify-center items-center space-x-4">
            <button id="prevPageButton" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white opacity-50 cursor-not-allowed" onclick="prevPage()" disabled>
              Previous
            </button>
            <span id="pageInfo" class="text-sm text-gray-700 font-medium"></span>
            <button id="nextPageButton" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50" onclick="nextPage()">
              Next
            </button>
          </div>
        </div>
      </div>
      <!-- Remittance Table Section -->
      <div id="remittance-table-section" class="mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Remittance Table</h2>
        <div class="bg-white shadow rounded-lg overflow-hidden">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Particular</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount (₱)</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody id="remittanceTableBody" class="bg-white divide-y divide-gray-200">
                <!-- Remittance entries will be rendered dynamically -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
<!-- Remit Modal -->
<div id="remitModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
      <h3 class="text-lg font-medium text-gray-900">Remit Payment</h3>
      <button onclick="closeRemitModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <form id="remitForm" class="space-y-6">
        <div>
          <label for="remitParticular" class="block text-sm font-medium text-gray-700">Particular</label>
          <input type="text" id="remitParticular" name="remitParticular" value="Today's HOA Collected Fee"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="remitAmount" class="block text-sm font-medium text-gray-700">Amount (₱)</label>
          <input type="text" id="remitAmount" name="remitAmount"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="remitDate" class="block text-sm font-medium text-gray-700">Date</label>
          <input type="date" id="remitDate" name="remitDate" value="2025-09-16"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="remitTransactionType" class="block text-sm font-medium text-gray-700">Transaction Type</label>
          <input type="text" id="remitTransactionType" name="remitTransactionType" value="Credit" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="remitSecretary" class="block text-sm font-medium text-gray-700">Secretary Name</label>
          <input type="text" id="remitSecretary" name="remitSecretary" value="Kendall Jenner"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeRemitModal()"
            class="py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            Close
          </button>
          <button type="submit" id="confirmRemitButton"
            class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-teal-600 hover:bg-teal-700">
            Confirm Remit
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit/View Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
      <h3 id="modalTitle" class="text-lg font-medium text-gray-900"></h3>
      <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <form id="editForm" class="space-y-6">
        <input type="hidden" id="editIndex" />
        <div>
          <label for="editParticular" class="block text-sm font-medium text-gray-700">Particular</label>
          <input type="text" id="editParticular" name="editParticular"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="editAmount" class="block text-sm font-medium text-gray-700">Amount (₱)</label>
          <input type="text" id="editAmount" name="editAmount"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="editDate" class="block text-sm font-medium text-gray-700">Date</label>
          <input type="date" id="editDate" name="editDate"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="editTransactionType" class="block text-sm font-medium text-gray-700">Transaction Type</label>
          <input type="text" id="editTransactionType" name="editTransactionType" value="Credit" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="editSecretary" class="block text-sm font-medium text-gray-700">Secretary Name</label>
          <input type="text" id="editSecretary" name="editSecretary"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="editStatus" class="block text-sm font-medium text-gray-700">Status</label>
          <input type="text" id="editStatus" name="editStatus" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeEditModal()"
            class="py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            Close
          </button>
          <button type="submit" id="saveEditButton"
            class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-teal-600 hover:bg-teal-700">
            Save
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Verify Modal -->
<div id="verifyModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
      <h3 id="verifyTitle" class="text-lg font-medium text-gray-900"></h3>
      <button onclick="closeVerifyModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <form id="verifyForm" class="space-y-6">
        <input type="hidden" id="verifyIndex" />
        <div>
          <label for="verifyParticular" class="block text-sm font-medium text-gray-700">Particular</label>
          <input type="text" id="verifyParticular" name="verifyParticular" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="verifyAmount" class="block text-sm font-medium text-gray-700">Amount (₱)</label>
          <input type="text" id="verifyAmount" name="verifyAmount" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="verifyDate" class="block text-sm font-medium text-gray-700">Date</label>
          <input type="date" id="verifyDate" name="verifyDate" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="verifyTransactionType" class="block text-sm font-medium text-gray-700">Transaction Type</label>
          <input type="text" id="verifyTransactionType" name="verifyTransactionType" value="Credit" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="verifySecretary" class="block text-sm font-medium text-gray-700">Secretary Name</label>
          <input type="text" id="verifySecretary" name="verifySecretary" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div>
          <label for="verifyStatus" class="block text-sm font-medium text-gray-700">Status</label>
          <input type="text" id="verifyStatus" name="verifyStatus" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 sm:text-sm" />
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeVerifyModal()"
            class="py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            Cancel
          </button>
          <button type="submit" id="confirmVerifyButton"
            class="py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-teal-600 hover:bg-teal-700">
            Verify
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  // Simulated data for payment history (individual payments)
  let paymentHistory = [
    { name: "Maria Santos", feeName: "Monthly Dues Fee - January", amount: 50, date: "2025-01-02" },
    { name: "TODA Dilaw", feeName: "Monthly Rent - August", amount: 1500, date: "2025-08-13" },
    { name: "Juan Dela Cruz", feeName: "Monthly Dues Fee - September", amount: 75, date: "2025-09-01" },
    { name: "Ana Gomez", feeName: "Amenities Fee", amount: 200, date: "2025-09-02" },
    { name: "Pedro Reyes", feeName: "Monthly Dues Fee - September", amount: 50, date: "2025-09-03" },
    { name: "Lina Cruz", feeName: "Monthly Rent - September", amount: 1200, date: "2025-09-04" },
    { name: "Ramon Santos", feeName: "Amenities Fee", amount: 300, date: "2025-09-05" },
    { name: "Maria Santos", feeName: "Monthly Dues Fee - October", amount: 60, date: "2025-09-06" }
  ];
  let currentPage = 1;
  const paymentsPerPage = 7;
  // Simulated data for remittance table
  let remittanceEntries = [
    { particular: "Today's HOA Collected Fee", amount: 10000, date: "2025-09-10", secretary: "Kendall Jenner", status: "Verified" },
    { particular: "Today's HOA Collected Fee", amount: 12000, date: "2025-09-11", secretary: "Kendall Jenner", status: "Verified" },
    { particular: "Today's HOA Collected Fee", amount: 15000, date: "2025-09-12", secretary: "Kendall Jenner", status: "Verified" }
  ];
  document.addEventListener('DOMContentLoaded', function() {
    renderPaymentHistory();
    updateTotalCollected();
    renderRemittanceTable();
    // Remit form submit
    const remitForm = document.getElementById('remitForm');
    remitForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const rawAmount = document.getElementById('remitAmount').value || "0";
      const amount = parseFloat(String(rawAmount).replace(/[^\d.-]/g, '')) || 0;
      remittanceEntries.push({
        particular: document.getElementById('remitParticular').value,
        amount: amount,
        date: document.getElementById('remitDate').value || new Date().toISOString().slice(0,10),
        secretary: document.getElementById('remitSecretary').value,
        status: "Pending"
      });
      alert('Remittance submitted successfully! Awaiting treasurer verification.');
      closeRemitModal();
      renderRemittanceTable();
    });
    // Edit form submit
    const editForm = document.getElementById('editForm');
    editForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const idxRaw = document.getElementById('editIndex').value;
      if (idxRaw === "") return;
      const idx = parseInt(idxRaw, 10);
      if (isNaN(idx) || !remittanceEntries[idx]) return;
      const rawAmount = document.getElementById('editAmount').value || "0";
      const amount = parseFloat(String(rawAmount).replace(/[^\d.-]/g, '')) || 0;
      remittanceEntries[idx].particular = document.getElementById('editParticular').value;
      remittanceEntries[idx].amount = amount;
      remittanceEntries[idx].date = document.getElementById('editDate').value || remittanceEntries[idx].date;
      remittanceEntries[idx].secretary = document.getElementById('editSecretary').value;
      // status field is readonly in the modal; if you want to allow changing it, remove readonly in markup
      alert('Remittance updated successfully!');
      closeEditModal();
      renderRemittanceTable();
    });
    // Verify form submit
    const verifyForm = document.getElementById('verifyForm');
    verifyForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const idxRaw = document.getElementById('verifyIndex').value;
      if (idxRaw === "") return;
      const idx = parseInt(idxRaw, 10);
      if (isNaN(idx) || !remittanceEntries[idx]) return;
      remittanceEntries[idx].status = "Verified";
      alert('Remittance verified successfully!');
      closeVerifyModal();
      renderRemittanceTable();
    });
  });
  function renderPaymentHistory() {
    const tbody = document.getElementById('paymentHistoryTableBody');
    const prevPageButton = document.getElementById('prevPageButton');
    const nextPageButton = document.getElementById('nextPageButton');
    const pageInfo = document.getElementById('pageInfo');
    tbody.innerHTML = '';
    const totalPages = Math.max(1, Math.ceil(paymentHistory.length / paymentsPerPage));
    if (currentPage > totalPages) currentPage = totalPages;
    const startIndex = (currentPage - 1) * paymentsPerPage;
    const paginatedPayments = paymentHistory.slice(startIndex, startIndex + paymentsPerPage);
    paginatedPayments.forEach(entry => {
      tbody.innerHTML += `
        <tr>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">${entry.name}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${entry.feeName}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₱${Number(entry.amount).toLocaleString()}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${entry.date}</td>
        </tr>
      `;
    });
    // update pagination buttons
    prevPageButton.disabled = currentPage === 1;
    prevPageButton.classList.toggle('opacity-50', currentPage === 1);
    prevPageButton.classList.toggle('cursor-not-allowed', currentPage === 1);
    nextPageButton.disabled = currentPage === totalPages || paymentHistory.length === 0;
    nextPageButton.classList.toggle('opacity-50', nextPageButton.disabled);
    nextPageButton.classList.toggle('cursor-not-allowed', nextPageButton.disabled);
    pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
  }
  function updateTotalCollected() {
    const startIndex = (currentPage - 1) * paymentsPerPage;
    const paginatedPayments = paymentHistory.slice(startIndex, startIndex + paymentsPerPage);
    const total = paginatedPayments.reduce((sum, entry) => sum + Number(entry.amount || 0), 0);
    document.getElementById('totalCollected').textContent = `₱${total.toLocaleString()}`;
    document.getElementById('remitAmount').value = `₱${total.toLocaleString()}`;
  }
  function renderRemittanceTable() {
    const tbody = document.getElementById('remittanceTableBody');
    tbody.innerHTML = '';
    remittanceEntries.forEach((entry, i) => {
      const buttonText = "View";
      const buttonAction = `viewRemittance(${i})`;
      tbody.innerHTML += `
        <tr>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">${escapeHtml(entry.particular)}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">₱${Number(entry.amount).toLocaleString()}</td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
              ${escapeHtml(entry.status)}
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <button onclick="${buttonAction}" class="bg-teal-600 hover:bg-teal-700 text-white py-1 px-3 rounded-md text-sm inline-flex items-center justify-center w-20">
              ${buttonText}
            </button>
          </td>
        </tr>
      `;
    });
  }
  function prevPage() {
    if (currentPage > 1) {
      currentPage--;
      renderPaymentHistory();
      updateTotalCollected();
    }
  }
  function nextPage() {
    const totalPages = Math.ceil(paymentHistory.length / paymentsPerPage);
    if (currentPage < totalPages) {
      currentPage++;
      renderPaymentHistory();
      updateTotalCollected();
    }
  }
  function openRemitModal() {
    document.getElementById('remitModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
  }
  function closeRemitModal() {
    document.getElementById('remitModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
  }
  function editRemittance(index) {
    const entry = remittanceEntries[index];
    if (!entry) return;
    document.getElementById('modalTitle').textContent = "Edit Remittance";
    document.getElementById('editIndex').value = index;
    document.getElementById('editParticular').value = entry.particular;
    document.getElementById('editAmount').value = `₱${Number(entry.amount).toLocaleString()}`;
    document.getElementById('editDate').value = entry.date || "";
    document.getElementById('editTransactionType').value = "Credit";
    document.getElementById('editSecretary').value = entry.secretary || "";
    document.getElementById('editStatus').value = entry.status || "Pending";
    // make fields editable
    document.getElementById('editParticular').readOnly = false;
    document.getElementById('editAmount').readOnly = false;
    document.getElementById('editDate').readOnly = false;
    document.getElementById('editSecretary').readOnly = false;
    // status stays readonly in this modal
    document.getElementById('editStatus').readOnly = true;
    // show save button
    document.getElementById('saveEditButton').style.display = '';
    document.getElementById('editModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
  }
  function viewRemittance(index) {
    const entry = remittanceEntries[index];
    if (!entry) return;
    document.getElementById('modalTitle').textContent = "View Remittance";
    document.getElementById('editIndex').value = index;
    document.getElementById('editParticular').value = entry.particular;
    document.getElementById('editAmount').value = `₱${Number(entry.amount).toLocaleString()}`;
    document.getElementById('editDate').value = entry.date || "";
    document.getElementById('editTransactionType').value = "Credit";
    document.getElementById('editSecretary').value = entry.secretary || "";
    document.getElementById('editStatus').value = entry.status || "";
    // make fields readonly
    document.getElementById('editParticular').readOnly = true;
    document.getElementById('editAmount').readOnly = true;
    document.getElementById('editDate').readOnly = true;
    document.getElementById('editSecretary').readOnly = true;
    document.getElementById('editStatus').readOnly = true;
    // hide save button when viewing
    document.getElementById('saveEditButton').style.display = 'none';
    document.getElementById('editModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
  }
  function verifyRemittance(index) {
    const entry = remittanceEntries[index];
    if (!entry) return;
    document.getElementById('verifyTitle').textContent = "Verify Remittance";
    document.getElementById('verifyIndex').value = index;
    document.getElementById('verifyParticular').value = entry.particular;
    document.getElementById('verifyAmount').value = `₱${Number(entry.amount).toLocaleString()}`;
    document.getElementById('verifyDate').value = entry.date || "";
    document.getElementById('verifyTransactionType').value = "Credit";
    document.getElementById('verifySecretary').value = entry.secretary || "";
    document.getElementById('verifyStatus').value = entry.status || "Pending";
    // make fields readonly
    document.getElementById('verifyParticular').readOnly = true;
    document.getElementById('verifyAmount').readOnly = true;
    document.getElementById('verifyDate').readOnly = true;
    document.getElementById('verifySecretary').readOnly = true;
    document.getElementById('verifyStatus').readOnly = true;
    document.getElementById('verifyModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
  }
  function closeVerifyModal() {
    document.getElementById('verifyModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    document.getElementById('verifyIndex').value = "";
  }
  function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    // reset readonly states and clear editIndex so next open is fresh
    document.getElementById('editParticular').readOnly = false;
    document.getElementById('editAmount').readOnly = false;
    document.getElementById('editDate').readOnly = false;
    document.getElementById('editSecretary').readOnly = false;
    document.getElementById('editStatus').readOnly = true;
    document.getElementById('editIndex').value = "";
    // ensure save button visible next time by default
    document.getElementById('saveEditButton').style.display = '';
  }
  // small helper to escape HTML when injecting user content
  function escapeHtml(str) {
    if (str === null || str === undefined) return "";
    return String(str)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }
</script>
</body>
</html>
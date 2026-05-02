<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';

$pageTitle = 'Ledger';
ob_start();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>
  [x-cloak] {
    display: none !important;
  }
</style>
<div class="mt-1">
  <h3 class="text-2xl font-medium text-gray-900 mb-4"><?= $pageTitle ?></h3>
  <div class="bg-teal-50 rounded-lg shadow p-4 my-4 w-100">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Total Collected Fees</p>
        <p class="text-xl font-semibold text-gray-900">₱209,400</p>
      </div>
      <div class="bg-teal-100 p-2 rounded-full text-teal-600">
        <i class="fas fa-money-bill-wave text-lg"></i>
      </div>
    </div>
  </div>

  <div id="ledger-section" class="mb-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Particulars</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Debit (₱)</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Credit (₱)</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balance After (₱)</th>
            </tr>
          </thead>
          <tbody id="ledgerTableBody" class="bg-white divide-y divide-gray-200">
          </tbody>
        </table>
      </div>
      <div class="border-t border-gray-200 bg-gray-50 px-6 py-3 flex justify-center items-center space-x-4">
        <button id="prevPageButton" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 opacity-50 cursor-not-allowed" onclick="prevPage()" disabled>
          Previous
        </button>
        <span id="pageInfo" class="text-sm text-gray-700 font-medium"></span>
        <button id="nextPageButton" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500" onclick="nextPage()">
          Next
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  let ledgerEntries = [
    {
      date: "2025-01-20",
      description: "Dues collected from residents - January",
      debit: 0,
      credit: 50000
    },
    {
      date: "2025-01-20",
      description: "Budget release for Community Garden Setup",
      debit: 15000,
      credit: 0
    },
    {
      date: "2025-02-15",
      description: "Dues collected from residents - February",
      debit: 0,
      credit: 50000
    },
    {
      date: "2025-03-15",
      description: "Budget release for Basketball Court Renovation",
      debit: 20000,
      credit: 0
    },
    {
      date: "2025-03-20",
      description: "Budget release for Street Lighting Upgrade",
      debit: 85000,
      credit: 0
    },
    {
      date: "2025-04-10",
      description: "Dues collected from residents - April",
      debit: 0,
      credit: 50000
    },
  ];

  let currentPage = 1;
  const entriesPerPage = 5;

  document.addEventListener('DOMContentLoaded', function() {
    renderLedger();
  });

  function renderLedger() {
    const tbody = document.getElementById('ledgerTableBody');
    const prevPageButton = document.getElementById('prevPageButton');
    const nextPageButton = document.getElementById('nextPageButton');
    const pageInfo = document.getElementById('pageInfo');
    tbody.innerHTML = '';

    const sortedEntries = ledgerEntries.sort((a, b) => new Date(a.date) - new Date(b.date));
    const totalPages = Math.ceil(ledgerEntries.length / entriesPerPage);
    const startIndex = (currentPage - 1) * entriesPerPage;
    const endIndex = startIndex + entriesPerPage;
    const paginatedEntries = sortedEntries.slice(startIndex, endIndex);

    let totalCollectedFees = 179400; // Initial total collected fees
    sortedEntries.forEach((entry, index) => {
      totalCollectedFees += entry.credit - entry.debit;
      entry.balanceAfter = totalCollectedFees;
    });

    paginatedEntries.forEach(entry => {
      tbody.innerHTML += `
        <tr>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">${entry.description}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${entry.date}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold ${entry.debit > 0 ? 'bg-red-200' : ''}">${entry.debit > 0 ? `₱${entry.debit.toLocaleString()}` : ''}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold ${entry.credit > 0 ? 'bg-blue-200' : ''}">${entry.credit > 0 ? `₱${entry.credit.toLocaleString()}` : ''}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">${entry.balanceAfter !== undefined ? `₱${entry.balanceAfter.toLocaleString()}` : ''}</td>
        </tr>
      `;
    });

    // Update pagination buttons
    prevPageButton.disabled = currentPage === 1;
    prevPageButton.classList.toggle('opacity-50', currentPage === 1);
    prevPageButton.classList.toggle('cursor-not-allowed', currentPage === 1);
    nextPageButton.disabled = currentPage === totalPages || totalPages === 0;
    nextPageButton.classList.toggle('opacity-50', currentPage === totalPages || totalPages === 0);
    nextPageButton.classList.toggle('cursor-not-allowed', currentPage === totalPages || totalPages === 0);
    pageInfo.textContent = `Page ${currentPage} of ${totalPages || 1}`;
  }

  function prevPage() {
    if (currentPage > 1) {
      currentPage--;
      renderLedger();
    }
  }

  function nextPage() {
    if (currentPage < Math.ceil(ledgerEntries.length / entriesPerPage)) {
      currentPage++;
      renderLedger();
    }
  }
</script>
<?php
$content = ob_get_clean();

$pageScripts = '
  <script type="module" src="/hoa_system/ui/modules/fees/get.fees.js"></script>
';

require_once BASE_PATH . '/pages/layout.php';
?>
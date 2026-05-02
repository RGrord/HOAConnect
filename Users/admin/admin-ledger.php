<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>HOAConnect - Ledger</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>
  [x-cloak] {
    display: none !important;
  }
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
    <a href="admin-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-tachometer-alt mr-3"></i>
      <span>Dashboard</span>
    </a>
    <a href="admin-accounts.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-users mr-3"></i>
      <span>User Management</span>
    </a>
  
    <!-- Payment Management Dropdown -->
    <div x-data="{ open: false }">
      <button @click="open = !open" :aria-expanded="open" class="flex items-center w-full px-6 py-3 hover:bg-teal-600 focus:outline-none">
        <i class="fas fa-credit-card mr-3"></i>
        <span class="flex-1 text-left">Payment Management</span>
        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div x-show="open" x-cloak class="bg-teal-800 text-sm">
        <a href="fee-types.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
          <i class="fas fa-tag mr-2" title="Fee Type"></i>
          Fee Type
        </a>
        <a href="fee-assignation.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
          <i class="fas fa-clipboard-list mr-2" title="Fee Assignation"></i>
          Fee Assignation
        </a>
        <a href="payment-verification.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
          <i class="fas fa-check-circle mr-2" title="Payment Verification"></i>
          Payment Verification
        </a>
        <a href="admin-remittance.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
          <i class="fas fa-money-check mr-3"></i>
          Remittance
        </a>
        <a href="payment-history.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
          <i class="fas fa-history mr-2" title="Payment History"></i>
          Payment History
        </a>
      </div>
    </div>

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
  <button @click="window.location.href='admin-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
    <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
    <span class="flex-1 text-left">Tricycle</span>
  </button>
</div>

<!-- Court Navigation -->
<div class="relative">
  <button @click="window.location.href='admin-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
    <i class="fas fa-basketball-ball mr-2" title="Court"></i>
    <span class="flex-1 text-left">Court</span>
  </button>
</div>

<!-- Stall Navigation -->
<div class="relative">
  <button @click="window.location.href='admin-stall.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
    <i class="fas fa-store mr-2" title="Stall"></i>
    <span class="flex-1 text-left">Stall</span>
  </button>
</div>
</div>
</div>

<a href="admin-hoaprojects.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
<i class="fas fa-gavel mr-3"></i>
    <span>Resolution</span>
</a>

<a href="admin-ledger.php" class="flex items-center px-6 py-3 bg-teal-700">
<i class="fas fa-book mr-3"></i>
<span>Ledger</span>
</a>

<a href="admin-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
<i class="fas fa-newspaper mr-3"></i>
<span>News Feed</span>
</a>

    <a href="admin-messages.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-comments mr-3"></i>
      <span>Messages</span>
    </a>
    <a href="admin-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-calendar-alt mr-3"></i>
      <span>Calendar</span>
    </a>
    <a href="admin-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
          <h1 class="text-2xl font-bold text-gray-900">Ledger</h1>
          <div class="flex items-center space-x-2">
            <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
              <i class="fas fa-bell"></i>
            </button>
          </div>
        </div>
  </header>

    <div class="bg-teal-50 rounded-lg shadow p-4 mx-4 sm:mx-6 lg:mx-8 mt-6 w-80">
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

    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <!-- Ledger Section -->
      <div id="ledger-section" class="mb-8">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-semibold text-gray-900">HOA Collected Fee Ledger</h2>
        </div>

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
                <!-- Ledger entries will be rendered dynamically -->
              </tbody>
            </table>
          </div>
          <!-- Pagination -->
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
    </main>
  </div>
</div>

<script>
  // Simulated data for ledger entries
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
</body>
</html>
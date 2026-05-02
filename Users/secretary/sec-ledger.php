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
      <a href="sec-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-tachometer-alt mr-3"></i>
        <span>Dashboard</span>
      </a>
      <a href="sec-projectproposal.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-gavel mr-3"></i>
  <span>Resolution</span>
      </a>
      <a href="sec-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-newspaper mr-3"></i>
        <span>News Feed</span>
      </a>
      <a href="sec-ledger.php" class="flex items-center px-6 py-3 bg-teal-700">
        <i class="fas fa-book mr-3"></i>
        <span>Ledger</span>
      </a>
      <a href="sec-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-calendar-alt mr-3"></i>
        <span>Calendar</span>
      </a>
      <a href="sec-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
          <p class="text-xl font-semibold text-gray-900">₱179,400</p>
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

    paginatedEntries.forEach(entry => {
      tbody.innerHTML += `
        <tr>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">${entry.description}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-">${entry.date}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold ${entry.debit > 0 ? 'bg-red-200' : ''}">${entry.debit > 0 ? `₱${entry.debit.toLocaleString()}` : ''}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold ${entry.credit > 0 ? 'bg-blue-200' : ''}">${entry.credit > 0 ? `₱${entry.credit.toLocaleString()}` : ''}</td>
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tricycle Parking Management - HOAConnect</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    [x-cloak] { display: none !important; }
    .modal-backdrop { backdrop-filter: blur(2px); }
    
    /* Excel-like table styles */
    .excel-table {
      border-collapse: collapse;
      width: 100%;
      font-size: 12px;
    }
    
    .excel-table th,
    .excel-table td {
      border: 1px solid #d1d5db;
      padding: 8px;
      text-align: left;
    }
    
    .excel-table th {
      background-color: #f3f4f6;
      font-weight: bold;
    }
    
    .excel-table tr:nth-child(even) {
      background-color: #f9fafb;
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

              <a href="tres-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-tachometer-alt mr-3"></i>
                <span>Dashboard</span>
              </a>
              <a href="tres-paymenthistory.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-receipt mr-3"></i>
                <span>Payment History</span>
              </a>
              <a href="tres-remittance.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-money-check mr-3"></i>
                <span>Remittance</span>
              </a>
      
<!-- Amenities Dropdown -->
<div x-data="{ open: true }">
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
        <button @click="window.location.href='tres-tricycle.php'" class="flex items-center w-full px-10 py-2 bg-teal-700 focus:outline-none">
          <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
          <span class="flex-1 text-left">Tricycle</span>
        </button>
      </div>
  
      <!-- Court Navigation -->
      <div class="relative">
        <button @click="window.location.href='tres-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
          <i class="fas fa-basketball-ball mr-2" title="Court"></i>
          <span class="flex-1 text-left">Court</span>
        </button>
      </div>
  
      <!-- Stall Navigation -->
      <div class="relative">
        <button @click="window.location.href='tres-stall.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
          <i class="fas fa-store mr-2" title="Stall"></i>
          <span class="flex-1 text-left">Stall</span>
        </button>
      </div>
    </div>
  </div>
      
              <a href="tres-project.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-gavel mr-3"></i>
                <span>Resolution</span>
              </a>
              <a href="tres-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-book mr-3"></i>
                <span>Ledger</span>
              </a>
              <a href="tres-acknowledgement.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-file-invoice mr-3"></i>
                <span>Receipt</span>
              </a>
              <a href="tres-project.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-newspaper mr-3"></i>
                <span>News Feed</span>
              </a>
              <a href="tres-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
                <i class="fas fa-calendar-alt mr-3"></i>
                <span>Calendar</span>
              </a>
              <a href="tres-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
    <!-- Header -->
    <header class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
          <h1 class="text-2xl font-bold text-gray-900">Tricyle Parking Management</h1>
          <div class="flex items-center space-x-2">
            <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
              <i class="fas fa-bell"></i>
            </button>
          </div>
        </div>
  </header>

    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
              <i class="fas fa-users text-xl"></i>
            </div>
            <div class="ml-4">
              <p class="text-2xl font-bold" id="totalTodas">0</p>
              <p class="text-sm text-gray-500">Total TODAs</p>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
              <i class="fas fa-bicycle text-xl"></i>
            </div>
            <div class="ml-4">
              <p class="text-2xl font-bold" id="totalTricycles">0</p>
              <p class="text-sm text-gray-500">Total Tricycles</p>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
              <i class="fas fa-money-bill-wave text-xl"></i>
            </div>
            <div class="ml-4">
              <p class="text-2xl font-bold" id="monthlyRevenue">₱0</p>
              <p class="text-sm text-gray-500">Monthly Revenue</p>
            </div>
          </div>
        </div>
      </div>

      <br>

      <!-- Action Buttons and Search Bar -->
      <div class="mb-6 flex justify-end items-center">
        <div class="flex space-x-4 items-center">
          <div class="relative">
            <select id="statusFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" onchange="searchTodas()">
              <option value="">All Statuses</option>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
          <div class="relative">
            <input type="text" id="searchInput" placeholder="Search TODAs..." class="w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" onkeyup="searchTodas()">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
          </div>
        </div>
      </div>

      <!-- TODA Table -->
      <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-medium text-gray-900">TODA Management</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TODA Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Representative</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monthly Fee</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paid Fees</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unpaid Fees</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody id="todaTableBody" class="bg-white divide-y divide-gray-200">
              <!-- Table rows will be populated by JavaScript -->
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- View TODA Details Modal -->
<div id="viewTodaDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
      <h3 id="viewTodaDetailsTitle" class="text-lg font-medium text-gray-900">TODA Details</h3>
      <button onclick="closeViewTodaDetailsModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div id="viewTodaDetailsContent" class="p-6 space-y-4 overflow-y-auto max-h-[70vh]">
      <!-- TODA details will be populated here -->
    </div>
    <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
      <button type="button" onclick="closeViewTodaDetailsModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
    </div>
  </div>
</div>

<!-- Paid Fees Modal -->
<div id="paidFeesModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
  <!-- Changed max-w-md to max-w-4xl to make modal wider and remove need for horizontal scrollbar -->
  <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 max-h-[90vh] overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
      <h3 id="paidFeesTitle" class="text-lg font-medium text-gray-900">Paid Fees</h3>
    </div>
    <div class="p-6 overflow-y-auto max-h-[70vh]">
      <div id="paidFeesContent">
        <!-- Paid fees will be populated here -->
      </div>
    </div>
    <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
      <button onclick="closePaidFeesModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
    </div>
  </div>
</div>

<!-- Unpaid Fees Modal -->
<div id="unpaidFeesModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
  <!-- Changed max-w-md to max-w-2xl to make modal wider for better table display -->
  <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 max-h-[90vh] overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
      <h3 id="unpaidFeesTitle" class="text-lg font-medium text-gray-900">Unpaid Fees</h3>
    </div>
    <div class="p-6 overflow-y-auto max-h-[70vh]">
      <div id="unpaidFeesContent">
        <!-- Unpaid fees will be populated here -->
      </div>
    </div>
    <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
      <button onclick="closeUnpaidFeesModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
    </div>
  </div>
</div>

<!-- Record Payment Modal -->
<div id="recordPaymentModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
    <div class="px-6 py-4 border-b border-gray-200">
      <h3 class="text-lg font-medium text-gray-900">Record Payment</h3>
    </div>
    <form id="recordPaymentForm" class="p-6 space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">TODA Name</label>
        <input type="text" id="paymentTodaName" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Period</label>
        <input type="text" id="paymentPeriod" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₱)</label>
        <input type="number" id="paymentAmount" min="0" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Payment Date</label>
        <input type="date" id="paymentDate" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
        <select id="paymentMethod" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
          <option value="">Select Method</option>
          <option value="Cash">Cash</option>
          <option value="GCash">GCash</option>
          <option value="Bank Transfer">Bank Transfer</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Remarks (Optional)</label>
        <textarea id="paymentRemarks" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Proof of Payment</label>
        <input type="file" id="paymentProof" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
      </div>
      <div class="flex justify-end space-x-3 pt-4">
        <button type="button" onclick="closeRecordPaymentModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Cancel</button>
        <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700">Record Payment</button>
      </div>
    </form>
  </div>
</div>

<!-- Contract Image Modal -->
<div id="contractImageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-4xl max-h-[90vh] overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
      <h3 class="text-lg font-medium text-gray-900">Scanned Contract</h3>
      <button onclick="closeContractImageModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <img id="contractImageView" src="/placeholder.svg" alt="Contract" class="max-w-full max-h-[70vh] object-contain rounded cursor-pointer" onclick="viewContractImage('${toda.scannedContract}')">
    </div>
    <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
      <button onclick="closeContractImageModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
    </div>
  </div>
</div>

<!-- Proof Image Modal -->
<div id="proofImageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-4xl max-h-[90vh] overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
      <h3 class="text-lg font-medium text-gray-900">Proof of Payment</h3>
      <button onclick="closeProofImageModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <img id="proofImageView" src="/placeholder.svg" alt="Proof of Payment" class="max-w-full max-h-[70vh] object-contain rounded cursor-pointer" onclick="viewProofImage('${payment.proofOfPayment}')">
    </div>
    <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
      <button onclick="closeProofImageModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
    </div>
  </div>
</div>

<script>
  // Global variables
  let todas = [];
  let payments = [];
  let currentTodaId = null;
  let selectedUnpaidFees = []; // Still needed for recordPaymentForSelected, but not directly used in viewUnpaidFees anymore

  // Initialize with sample data
  function initializeSampleData() {
    todas = [
      {
        id: 1,
        name: 'Dilaw TODA',
        tricycleCount: 15,
        monthlyRent: 500,
        status: 'Active',
        representative: 'Juan Dela Cruz',
        contactNumber: '09123456789',
        notes: 'Main TODA group in the area',
        startDate: '2024-01-01',
        endDate: '2024-12-31',
        scannedContract: '/placeholder.svg?height=400&width=600'
      },
      {
        id: 2,
        name: 'Violet TODA',
        tricycleCount: 12,
        monthlyRent: 450,
        status: 'Active',
        representative: 'Maria Santos',
        contactNumber: '09987654321',
        notes: 'Secondary group',
        startDate: '2024-02-01',
        endDate: '2024-12-31',
        scannedContract: '/placeholder.svg?height=400&width=600'
      },
      {
        id: 3,
        name: 'Green TODA',
        tricycleCount: 8,
        monthlyRent: 400,
        status: 'Inactive',
        representative: 'Pedro Reyes',
        contactNumber: '09555123456',
        notes: 'Currently suspended',
        startDate: '2023-06-01',
        endDate: '2023-12-31',
        scannedContract: '/placeholder.svg?height=400&width=600'
      }
    ];

    payments = [
      { id: 1, todaId: 1, period: 'January 2024', amount: 500, date: '2024-01-15', method: 'Cash', remarks: 'On time payment', proofOfPayment: '/placeholder.svg?height=300&width=400' },
      { id: 2, todaId: 1, period: 'February 2024', amount: 500, date: '2024-02-10', method: 'GCash', remarks: 'Early payment', proofOfPayment: '/placeholder.svg?height=300&width=400' },
      { id: 3, todaId: 2, period: 'January 2024', amount: 450, date: '2024-01-20', method: 'Cash', remarks: 'Regular payment', proofOfPayment: '/placeholder.svg?height=300&width=400' },
      { id: 4, todaId: 1, period: 'March 2024', amount: 500, date: '2024-03-12', method: 'Bank Transfer', remarks: 'Regular payment', proofOfPayment: '/placeholder.svg?height=300&width=400' }
    ];

    renderTodaTable();
    updateStats();
  }

  // Search functionality
  function searchTodas() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    
    const filteredTodas = todas.filter(toda => {
      const matchesSearch = toda.name.toLowerCase().includes(searchTerm) ||
                       toda.representative.toLowerCase().includes(searchTerm);
      const matchesStatus = !statusFilter || toda.status === statusFilter;
      return matchesSearch && matchesStatus;
    });
    
    renderTodaTable(filteredTodas);
  }

  // Render TODA table
  function renderTodaTable(dataToRender = todas) {
    const tbody = document.getElementById('todaTableBody');
    tbody.innerHTML = '';

    dataToRender.forEach(toda => {
      const paidCount = payments.filter(p => p.todaId === toda.id).length;
      const unpaidCount = Math.max(0, 3 - paidCount); // Assuming 3 months for demo
      
      const row = document.createElement('tr');
      row.innerHTML = `
        <td class="px-6 py-4 whitespace-nowrap">
          <div class="text-sm font-medium text-gray-900">${toda.name}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${toda.representative}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₱${toda.monthlyRent.toLocaleString()}</td>
        <td class="px-6 py-4 whitespace-nowrap">
          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${toda.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
            ${toda.status}
          </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
          <button onclick="viewPaidFees(${toda.id})" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded text-xs w-16">
            View
          </button>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
          <button onclick="viewUnpaidFees(${toda.id})" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded text-xs w-16">
            View
          </button>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
          <button onclick="viewTodaDetails(${toda.id})" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded text-xs w-16">
            View
          </button>
        </td>
      `;
      tbody.appendChild(row);
    });
  }

  // Update statistics
  function updateStats() {
    document.getElementById('totalTodas').textContent = todas.length;
    document.getElementById('totalTricycles').textContent = todas.reduce((sum, toda) => sum + toda.tricycleCount, 0);
    document.getElementById('monthlyRevenue').textContent = '₱' + todas.reduce((sum, toda) => sum + toda.monthlyRent, 0).toLocaleString();
  }

  // View TODA Details Modal functions
  function viewTodaDetails(id) {
    const toda = todas.find(t => t.id === id);
    if (toda) {
      document.getElementById('viewTodaDetailsTitle').textContent = `TODA Details - ${toda.name}`;
      const contentDiv = document.getElementById('viewTodaDetailsContent');
      contentDiv.innerHTML = `
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">TODA Name</label>
          <p class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">${toda.name}</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Number of Tricycles</label>
          <p class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">${toda.tricycleCount}</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Monthly Rent (₱)</label>
          <p class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">₱${toda.monthlyRent.toLocaleString()}</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
          <p class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">${toda.status}</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
          <p class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">${new Date(toda.startDate).toLocaleDateString()}</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
          <p class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">${new Date(toda.endDate).toLocaleDateString()}</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Representative Name</label>
          <p class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">${toda.representative}</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
          <p class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">${toda.contactNumber}</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
          <p class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">${toda.notes || 'N/A'}</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Scanned Contract</label>
          <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
            <img src="${toda.scannedContract}" alt="Scanned Contract" class="w-full h-48 object-cover rounded cursor-pointer" onclick="viewContractImage('${toda.scannedContract}')">
          </div>
        </div>
      `;
      document.getElementById('viewTodaDetailsModal').classList.remove('hidden');
    }
  }

  function closeViewTodaDetailsModal() {
    document.getElementById('viewTodaDetailsModal').classList.add('hidden');
  }

  // Paid Fees Modal
  function viewPaidFees(todaId) {
    currentTodaId = todaId;
    const toda = todas.find(t => t.id === todaId);
    const paidPayments = payments.filter(p => p.todaId === todaId);
    
    document.getElementById('paidFeesTitle').textContent = `Paid Fees - ${toda.name}`;
    
    let content = '';
    if (paidPayments.length === 0) {
      content = '<p class="text-gray-500">No paid fees found.</p>';
    } else {
      content = `
        <div class="overflow-x-auto">
          <table class="excel-table">
            <thead>
              <tr>
                <th>Period</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Method</th>
                <th>Proof of Payment</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
      `;
      
      paidPayments.forEach(payment => {
        content += `
          <tr>
            <td>${payment.period}</td>
            <td>₱${payment.amount.toLocaleString()}</td>
            <td>${new Date(payment.date).toLocaleDateString()}</td>
            <td>${payment.method}</td>
            <td>
              ${payment.proofOfPayment ? 
                `<img src="${payment.proofOfPayment}" alt="Proof" class="w-12 h-8 object-cover rounded cursor-pointer" onclick="viewProofImage('${payment.proofOfPayment}')">` : 
                '<span class="text-gray-400">No proof</span>'
              }
            </td>
            <td>${payment.remarks || '-'}</td>
          </tr>
        `;
      });
      
      content += '</tbody></table></div>';
    }
    
    document.getElementById('paidFeesContent').innerHTML = content;
    document.getElementById('paidFeesModal').classList.remove('hidden');
  }

  function closePaidFeesModal() {
    document.getElementById('paidFeesModal').classList.add('hidden');
  }

  // Unpaid Fees Modal
  function viewUnpaidFees(todaId) {
    currentTodaId = todaId;
    const toda = todas.find(t => t.id === todaId);
    const paidPeriods = payments.filter(p => p.todaId === todaId).map(p => p.period);
    
    document.getElementById('unpaidFeesTitle').textContent = `Unpaid Fees - ${toda.name}`;
    
    const allPeriods = ['January 2024', 'February 2024', 'March 2024', 'April 2024', 'May 2024'];
    const unpaidPeriods = allPeriods.filter(period => !paidPeriods.includes(period));
    
    let content = '';
    if (unpaidPeriods.length === 0) {
      content = '<p class="text-green-600">All fees are paid up to date!</p>';
    } else {
      content = `
        <table class="excel-table">
          <thead>
            <tr>
              <th>Period</th>
              <th>Amount Due</th>
              <th>Due Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
      `;
      
      unpaidPeriods.forEach((period, index) => {
        content += `
          <tr>
            <td>${period}</td>
            <td>₱${toda.monthlyRent.toLocaleString()}</td>
            <td>${new Date().toLocaleDateString()}</td>
            <td><span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Unpaid</span></td>
          </tr>
        `;
      });
      
      content += '</tbody></table>';
    }
    
    document.getElementById('unpaidFeesContent').innerHTML = content;
    document.getElementById('unpaidFeesModal').classList.remove('hidden');
  }

  function closeUnpaidFeesModal() {
    document.getElementById('unpaidFeesModal').classList.add('hidden');
  }

  // Record Payment Modal (still functional for manual payment recording if needed elsewhere)
  function recordPaymentForSelected() {
    // This function is kept for completeness, but its trigger button is removed from the UI.
    // If you need to re-enable payment recording, you'd need to add a button for it.
    if (selectedUnpaidFees.length === 0) {
      alert('Please select at least one unpaid fee to pay.');
      return;
    }
    
    const toda = todas.find(t => t.id === currentTodaId);
    const totalAmount = selectedUnpaidFees.length * toda.monthlyRent;
    
    document.getElementById('paymentTodaName').value = toda.name;
    document.getElementById('paymentPeriod').value = selectedUnpaidFees.join(', ');
    document.getElementById('paymentAmount').value = totalAmount;
    document.getElementById('paymentDate').value = new Date().toISOString().split('T')[0];
    document.getElementById('paymentMethod').value = '';
    document.getElementById('paymentRemarks').value = `Payment for: ${selectedUnpaidFees.join(', ')}`;
    
    document.getElementById('recordPaymentModal').classList.remove('hidden');
  }

  function closeRecordPaymentModal() {
    document.getElementById('recordPaymentModal').classList.add('hidden');
  }

  // Record Payment Form Submission
  document.getElementById('recordPaymentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const periods = document.getElementById('paymentPeriod').value.split(', ');
    const totalAmount = parseFloat(document.getElementById('paymentAmount').value);
    const date = document.getElementById('paymentDate').value;
    const method = document.getElementById('paymentMethod').value;
    const remarks = document.getElementById('paymentRemarks').value;
    const amountPerPeriod = totalAmount / periods.length;
    const proofOfPaymentFile = document.getElementById('paymentProof').files[0];
    let proofOfPaymentUrl = '/placeholder.svg?height=300&width=400'; // Default placeholder
    
    if (proofOfPaymentFile) {
      proofOfPaymentUrl = URL.createObjectURL(proofOfPaymentFile);
    }
    
    // Create separate payment records for each period
    periods.forEach(period => {
      const newPaymentId = Math.max(...payments.map(p => p.id), 0) + Math.random();
      payments.push({
        id: newPaymentId,
        todaId: currentTodaId,
        period: period.trim(),
        amount: amountPerPeriod,
        date: date,
        method: method,
        remarks: remarks,
        proofOfPayment: proofOfPaymentUrl
      });
    });
    
    renderTodaTable();
    updateStats();
    closeRecordPaymentModal();
    closeUnpaidFeesModal();
    
    alert(`Payment recorded successfully for ${periods.length} period(s)!`);
  });

  // Functions for viewing contract and proof images
  function viewContractImage(imageSrc) {
    document.getElementById('contractImageView').src = imageSrc;
    document.getElementById('contractImageModal').classList.remove('hidden');
  }

  function closeContractImageModal() {
    document.getElementById('contractImageModal').classList.add('hidden');
  }

  function viewProofImage(imageSrc) {
    document.getElementById('proofImageView').src = imageSrc;
    document.getElementById('proofImageModal').classList.remove('hidden');
  }

  function closeProofImageModal() {
    document.getElementById('proofImageModal').classList.add('hidden');
  }

  // Initialize the application
  document.addEventListener('DOMContentLoaded', function() {
    initializeSampleData();
  });
</script>
</body>
</html>
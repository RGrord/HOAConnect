<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vendor Stall Rental - HOAConnect</title>
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
    <a href="president-remittance.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-money-check mr-3"></i>
      <span>Remittance</span>
    </a>
    <a href="president-payment-history.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
      <i class="fas fa-receipt mr-3"></i>
      <span>Payment History</span>
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
                <button @click="window.location.href='president-stall.php'" class="flex items-center w-full px-10 py-2 bg-teal-700 focus:outline-none">
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
      <!-- Header -->
      <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Vendor Stall Rental</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>

      <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
          <div class="bg-white rounded-lg shadow p-6 cursor-pointer hover:shadow-lg transition-shadow" onclick="viewAllStalls()">
            <div class="flex items-center">
              <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-store text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-2xl font-bold" id="totalStalls">0</p>
                <p class="text-sm text-gray-500">Total Stalls</p>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-user-tie text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-2xl font-bold" id="activeRenters">0</p>
                <p class="text-sm text-gray-500">Active Renters</p>
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
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-clipboard-check text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-2xl font-bold" id="availableStalls">0</p>
                <p class="text-sm text-gray-500">Available Stalls</p>
              </div>
            </div>
          </div>
        </div>

        <br>
        <br>

        <!-- Search and Filters -->
        <div class="mb-6 flex justify-end items-center">
          <div class="flex space-x-4 items-center">
            <div class="relative">
              <select id="statusFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" onchange="searchRenters()">
                <option value="">All Statuses</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>
            <div class="relative">
              <select id="stallFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" onchange="searchRenters()">
                <option value="">All Stalls</option>
                <!-- Options will be populated by JavaScript -->
              </select>
            </div>
            <div class="relative">
              <input type="text" id="searchInput" placeholder="Search renters..." class="w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" onkeyup="searchRenters()">
              <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
          </div>
        </div>

        <!-- Stall Renters Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
          <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Stall Renters</h2>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Renter Name</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stall #</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paid Fees</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unpaid Fees</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody id="rentersTableBody" class="bg-white divide-y divide-gray-200">
                <!-- Table rows will be populated by JavaScript -->
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- All Stalls Modal -->
  <div id="allStallsModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <!-- Updated modal to match admin-stall.html table format -->
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">All Stalls</h3>
      </div>
      <!-- Changed to table format with scrollable content -->
      <div class="overflow-y-auto max-h-[70vh]">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50 sticky top-0">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stall #</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
            </tr>
          </thead>
          <tbody id="allStallsTableBody" class="bg-white divide-y divide-gray-200">
            <!-- Stalls table rows will be populated here -->
          </tbody>
        </table>
      </div>
      <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
        <button onclick="closeAllStallsModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
      </div>
    </div>
  </div>

  <!-- View Renter Modal -->
  <div id="viewRenterModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 id="viewRenterModalTitle" class="text-lg font-medium text-gray-900">Stall Renter Details</h3>
      </div>
      <div class="p-6 space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
          <input type="text" id="viewRenterName" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Contact Info</label>
          <input type="text" id="viewContactInfo" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Stall Number</label>
          <input type="text" id="viewRenterStallNumber" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Rental Duration</label>
          <input type="text" id="viewRentalDuration" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
            <input type="date" id="viewStartDate" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
            <input type="date" id="viewEndDate" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Rental Price (₱)</label>
          <input type="number" id="viewRentalPrice" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Scanned Contract</label>
          <div id="viewContractPreview" class="space-y-4">
            <!-- Scanned Contract will be displayed here -->
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
          <textarea id="viewRenterNotes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly></textarea>
        </div>
        <div class="flex justify-end space-x-3 pt-4">
          <button type="button" onclick="closeViewRenterModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Contract View Modal -->
  <div id="contractViewModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 max-h-[90vh] overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">View Contract</h3>
        <button onclick="closeContractViewModal()" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-6 overflow-y-auto max-h-[70vh]">
        <div id="contractViewContent" class="text-center">
          <!-- Contract content will be displayed here -->
        </div>
      </div>
    </div>
  </div>

  <!-- Paid Fees Modal -->
  <div id="paidFeesModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
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

  <!-- Record Payment Modal (kept for potential future use, but not triggered from UI) -->
  <div id="recordPaymentModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Record Payment</h3>
      </div>
      <form id="recordPaymentForm" class="p-6 space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Renter Name</label>
          <input type="text" id="paymentRenterName" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
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
        <div class="flex justify-end space-x-3 pt-4">
          <button type="button" onclick="closeRecordPaymentModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700">Record Payment</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Global variables
    let stalls = [];
    let renters = [];
    let payments = [];
    let currentRenterId = null;
    let currentContractFile = null; // Stores the actual File object for viewing

    // Initialize with sample data
    function initializeSampleData() {
      // Initialize stalls
      stalls = [
        { id: 1, number: 'Stall 1', status: 'Available', notes: 'Prime location near entrance' },
        { id: 2, number: 'Stall 2', status: 'Available', notes: 'Good visibility' },
        { id: 3, number: 'Stall 3', status: 'Occupied', notes: 'Food stall area' },
        { id: 4, number: 'Stall 4', status: 'Available', notes: 'Corner spot' },
        { id: 5, number: 'Stall 5', status: 'Available', notes: 'Near parking' },
        { id: 6, number: 'Stall 6', status: 'Available', notes: 'Standard size' },
        { id: 7, number: 'Stall 7', status: 'Occupied', notes: 'Clothing area' },
        { id: 8, number: 'Stall 8', status: 'Available', notes: 'Good foot traffic' },
        { id: 9, number: 'Stall 9', status: 'Available', notes: 'Near restrooms' },
        { id: 10, number: 'Stall 10', status: 'Inactive', notes: 'Under maintenance' }
      ];

      renters = [
        {
          id: 1,
          name: 'Ana Cruz',
          contact: '09123456789',
          stallNumber: 'Stall 3',
          duration: 'Monthly',
          startDate: '2024-01-01',
          endDate: '2024-12-31',
          price: 2500,
          status: 'Active',
          notes: 'Specializes in Filipino dishes',
          contractImages: [
            '/placeholder.svg?height=400&width=300',
            '/placeholder.svg?height=400&width=300'
          ]
        },
        {
          id: 2,
          name: 'Juan Santos',
          contact: '09987654321',
          stallNumber: 'Stall 7',
          duration: 'Weekly',
          startDate: '2024-01-15',
          endDate: '2024-06-15',
          price: 800,
          status: 'Active',
          notes: 'Sells casual wear',
          contractImages: [
            '/placeholder.svg?height=400&width=300',
            '/placeholder.svg?height=400&width=300'
          ]
        },
        {
          id: 3,
          name: 'Maria Reyes',
          contact: '09555123456',
          stallNumber: 'Stall 12', // Assuming this stall exists or is a typo for a non-existent one
          duration: 'Daily',
          startDate: '2024-02-01',
          endDate: '2024-02-28',
          price: 200,
          status: 'Inactive',
          notes: 'Jewelry and bags',
          contractImages: [
            '/placeholder.svg?height=400&width=300'
          ]
        }
      ];

      payments = [
        { 
          id: 1, 
          renterId: 1, 
          period: 'January 2024', 
          amount: 2500, 
          date: '2024-01-01', 
          method: 'Cash', 
          remarks: 'Initial payment',
          proofOfPayment: '/placeholder.svg?height=100&width=100'
        },
        { 
          id: 2, 
          renterId: 2, 
          period: 'Week 1 Jan 2024', 
          amount: 800, 
          date: '2024-01-15', 
          method: 'GCash', 
          remarks: 'Weekly payment',
          proofOfPayment: '/placeholder.svg?height=100&width=100'
        },
        { 
          id: 3, 
          renterId: 1, 
          period: 'February 2024', 
          amount: 2500, 
          date: '2024-02-01', 
          method: 'Cash', 
          remarks: 'February payment',
          proofOfPayment: '/placeholder.svg?height=100&width=100'
        },
        { 
          id: 4, 
          renterId: 2, 
          period: 'Week 2 Jan 2024', 
          amount: 800, 
          date: '2024-01-22', 
          method: 'GCash', 
          remarks: 'Weekly payment',
          proofOfPayment: '/placeholder.svg?height=100&width=100'
        }
      ];

      populateStallFilter();
      renderRentersTable();
      updateStats();
    }

    // Search functionality
    function searchRenters() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      const statusFilter = document.getElementById('statusFilter').value;
      const stallFilter = document.getElementById('stallFilter').value;
      
      const filteredRenters = renters.filter(renter => {
        const matchesSearch = renter.name.toLowerCase().includes(searchTerm) ||
                         renter.stallNumber.toLowerCase().includes(searchTerm) ||
                         renter.contact.includes(searchTerm);

        const matchesStatus = !statusFilter || renter.status === statusFilter;
        const matchesStall = !stallFilter || renter.stallNumber === stallFilter;

        return matchesSearch && matchesStatus && matchesStall;
      });
      
      renderRentersTable(filteredRenters);
    }

    // Add function to populate stall filter
    function populateStallFilter() {
      const stallFilter = document.getElementById('stallFilter');
      const occupiedStalls = [...new Set(renters.map(r => r.stallNumber))].sort();
      
      stallFilter.innerHTML = '<option value="">All Stalls</option>';
      occupiedStalls.forEach(stall => {
        stallFilter.innerHTML += `<option value="${stall}">${stall}</option>`;
      });
    }

    // Render renters table
    function renderRentersTable(dataToRender = renters) {
      const tbody = document.getElementById('rentersTableBody');
      tbody.innerHTML = '';

      dataToRender.forEach(renter => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">${renter.name}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${renter.stallNumber}</td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
              renter.status === 'Active' ? 'bg-green-100 text-green-800' :
              renter.status === 'Inactive' ? 'bg-red-100 text-red-800' :
              'bg-blue-100 text-blue-800'
            }">
              ${renter.status}
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <button onclick="viewPaidFees(${renter.id})" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded text-xs">
              View
            </button>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <button onclick="viewUnpaidFees(${renter.id})" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded text-xs">
              View
            </button>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <button onclick="openViewRenterModal(${renter.id})" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded text-xs">
              View
            </button>
          </td>
        `;
        tbody.appendChild(row);
      });
    }

    // Update statistics
    function updateStats() {
      const totalStalls = stalls.length;
      const activeRenters = renters.filter(r => r.status === 'Active').length;
      const monthlyRevenue = renters.filter(r => r.status === 'Active' && r.duration === 'Monthly')
                                   .reduce((sum, r) => sum + r.price, 0);
      const availableStalls = stalls.filter(s => s.status === 'Available').length;

      document.getElementById('totalStalls').textContent = totalStalls;
      document.getElementById('activeRenters').textContent = activeRenters;
      document.getElementById('monthlyRevenue').textContent = '₱' + monthlyRevenue.toLocaleString();
      document.getElementById('availableStalls').textContent = availableStalls;
    }

    // View all stalls
    function viewAllStalls() {
      const tbody = document.getElementById('allStallsTableBody');
      tbody.innerHTML = '';
      
      stalls.forEach(stall => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${stall.number}</td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
              stall.status === 'Available' ? 'bg-green-100 text-green-800' :
              stall.status === 'Occupied' ? 'bg-blue-100 text-blue-800' :
              'bg-red-100 text-red-800'
            }">
              ${stall.status}
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${stall.notes || '-'}</td>
        `;
        tbody.appendChild(row);
      });
      
      document.getElementById('allStallsModal').classList.remove('hidden');
    }

    function closeAllStallsModal() {
      document.getElementById('allStallsModal').classList.add('hidden');
    }

    // View Renter Modal functions
    function openViewRenterModal(id) {
      const renter = renters.find(r => r.id === id);
      
      document.getElementById('viewRenterModalTitle').textContent = `Stall Renter Details - ${renter.name}`;
      document.getElementById('viewRenterName').value = renter.name;
      document.getElementById('viewContactInfo').value = renter.contact;
      document.getElementById('viewRenterStallNumber').value = renter.stallNumber;
      document.getElementById('viewRentalDuration').value = renter.duration;
      document.getElementById('viewStartDate').value = renter.startDate;
      document.getElementById('viewEndDate').value = renter.endDate || '';
      document.getElementById('viewRentalPrice').value = renter.price;
      document.getElementById('viewRenterNotes').value = renter.notes || '';
      
      const viewContractPreview = document.getElementById('viewContractPreview');
      
      if (renter.contractImages && renter.contractImages.length > 0) {
        viewContractPreview.innerHTML = `
          <div class="border border-gray-300 rounded-lg p-4 bg-gray-50 min-h-[200px] flex items-center justify-center cursor-pointer hover:bg-gray-100 transition-colors" onclick="viewContractImage('${renter.contractImages[0]}')">
            <div class="text-center">
              <img src="${renter.contractImages[0]}" alt="Scanned Contract" class="max-w-full max-h-48 object-contain mx-auto">
            </div>
          </div>
        `;
      } else {
        viewContractPreview.innerHTML = `
          <div class="border border-gray-300 rounded-lg p-4 bg-gray-50 min-h-[200px] flex items-center justify-center">
            <div class="text-center text-gray-500">
              <i class="fas fa-file-image text-3xl mb-2"></i>
              <p class="text-sm">Scanned Contract</p>
            </div>
          </div>
        `;
      }
      
      document.getElementById('viewRenterModal').classList.remove('hidden');
    }

    function closeViewRenterModal() {
      document.getElementById('viewRenterModal').classList.add('hidden');
    }

    // Contract handling functions (for viewing only)
    function viewContract() {
      // This function is kept for backward compatibility but replaced by viewContractImage
      if (currentContractFile) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const content = document.getElementById('contractViewContent');
          if (currentContractFile.type.includes('image')) {
            content.innerHTML = `<img src="${e.target.result}" class="max-w-full h-auto" alt="Contract">`;
          } else if (currentContractFile.type === 'application/pdf') {
            content.innerHTML = `<embed src="${e.target.result}" type="application/pdf" width="100%" height="600px">`;
          } else {
            content.innerHTML = `<p class="text-gray-500">Cannot preview this file type. <a href="${e.target.result}" download="${currentContractFile.name}" class="text-blue-600 hover:underline">Download to view</a></p>`;
          }
        };
        reader.readAsDataURL(currentContractFile);
        document.getElementById('contractViewModal').classList.remove('hidden');
      }
    }

    function viewContractImage(imageUrl) {
      const content = document.getElementById('contractViewContent');
      content.innerHTML = `<img src="${imageUrl}" class="max-w-full h-auto" alt="Contract Document">`;
      document.getElementById('contractViewModal').classList.remove('hidden');
    }

    // Paid Fees Modal
    function viewPaidFees(renterId) {
      currentRenterId = renterId;
      const renter = renters.find(r => r.id === renterId);
      const paidPayments = payments.filter(p => p.renterId === renterId);
      
      document.getElementById('paidFeesTitle').textContent = `Paid Fees - ${renter.name}`;
      
      let content = '';
      if (paidPayments.length === 0) {
        content = '<p class="text-gray-500">No paid fees found.</p>';
      } else {
        content = `
          <table class="excel-table w-full">
            <thead>
              <tr>
                <th>Period</th>
                <th>Amount (₱)</th>
                <th>Payment Date</th>
                <th>Payment Method</th>
                <th>Proof of Payment</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
        `;
        
        paidPayments.forEach(payment => {
          const proofCell = payment.proofOfPayment 
            ? `<img src="${payment.proofOfPayment}" alt="Proof" class="w-12 h-12 object-cover rounded cursor-pointer hover:opacity-80" onclick="viewProofImage('${payment.proofOfPayment}')" title="Click to view larger image">`
            : '<span class="text-gray-400 text-sm">No proof uploaded</span>';
            
          content += `
            <tr>
              <td>${payment.period}</td>
              <td>₱${payment.amount.toFixed(2)}</td>
              <td>${new Date(payment.date).toLocaleDateString()}</td>
              <td>${payment.method}</td>
              <td class="text-center">${proofCell}</td>
              <td>${payment.remarks || '-'}</td>
            </tr>
          `;
        });
        
        content += '</tbody></table>';
      }
      
      document.getElementById('paidFeesContent').innerHTML = content;
      document.getElementById('paidFeesModal').classList.remove('hidden');
    }

    function closePaidFeesModal() {
      document.getElementById('paidFeesModal').classList.add('hidden');
    }

    // Unpaid Fees Modal (now purely view-only)
    function viewUnpaidFees(renterId) {
      currentRenterId = renterId;
      const renter = renters.find(r => r.id === renterId);
      const paidPeriods = payments.filter(p => p.renterId === renterId).map(p => p.period);
      
      document.getElementById('unpaidFeesTitle').textContent = `Unpaid Fees - ${renter.name}`;
      
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
        
        unpaidPeriods.forEach((period) => {
          content += `
            <tr>
              <td>${period}</td>
              <td>₱${renter.price.toLocaleString()}</td>
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

    // Record Payment Modal functions (kept for completeness, but not triggered from UI)
    function closeRecordPaymentModal() {
      document.getElementById('recordPaymentModal').classList.add('hidden');
    }

    // Record Payment form submission (kept for completeness, but not triggered from UI)
    document.getElementById('recordPaymentForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const periods = document.getElementById('paymentPeriod').value.split(', ');
      const totalAmount = parseFloat(document.getElementById('paymentAmount').value);
      const date = document.getElementById('paymentDate').value;
      const method = document.getElementById('paymentMethod').value;
      const remarks = document.getElementById('paymentRemarks').value;
      const amountPerPeriod = totalAmount / periods.length;
      
      periods.forEach(period => {
        const newPaymentId = Math.max(...payments.map(p => p.id), 0) + Math.random();
        payments.push({
          id: newPaymentId,
          renterId: currentRenterId,
          period: period.trim(),
          amount: amountPerPeriod,
          date: date,
          method: method,
          remarks: remarks
        });
      });
      
      renderRentersTable();
      closeRecordPaymentModal();
      closeUnpaidFeesModal();
      
      alert(`Payment recorded successfully for ${periods.length} period(s)!`);
    });

    function viewProofImage(imageSrc) {
      const content = document.getElementById('contractViewContent');
      content.innerHTML = `<img src="${imageSrc}" class="max-w-full h-auto" alt="Proof of Payment">`;
      document.getElementById('contractViewModal').classList.remove('hidden');
    }

    // Initialize the application
    document.addEventListener('DOMContentLoaded', function() {
      initializeSampleData();
    });
  </script>
</body>
</html>

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

         <!--Amenities Dropdown -->
        <div x-data="{ open: true }">
          <button @click="open = !open" :aria-expanded="open" class="flex items-center w-full px-6 py-3 hover:bg-teal-600 focus:outline-none">
            <i class="fas fa-swimming-pool mr-3"></i>
            <span class="flex-1 text-left">Amenities</span>
            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="open" x-cloak class="bg-teal-800 text-sm">
             
            <div class="relative">
              <button @click="window.location.href='admin-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
                <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
                <span class="flex-1 text-left">Tricycle</span>
              </button>
            </div>

             
            <div class="relative">
              <button @click="window.location.href='admin-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
                <i class="fas fa-basketball-ball mr-2" title="Court"></i>
                <span class="flex-1 text-left">Court</span>
              </button>
            </div>

             
            <div class="relative">
              <button @click="window.location.href='admin-stall.php'" class="flex items-center w-full px-10 py-2 bg-teal-700 focus:outline-none">
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

      <a href="admin-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-book mr-3"></i>
        <span>Ledger</span>
      </a>

      <a href="admin-projects.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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

     <!--Main Content -->
    <div class="flex-1 overflow-x-hidden overflow-y-auto">
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

        
        <div class="mb-6 flex justify-between items-center">
          <div class="flex space-x-4">
            <button onclick="openAddStallModal()" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg flex items-center text-base">
              <i class="fas fa-plus mr-2"></i>
              Add Stall
            </button>
            <button onclick="openAddRenterModal()" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg flex items-center text-base">
              <i class="fas fa-plus mr-2"></i>
              Add Stall Renter
            </button>
          </div>
          
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
                 Options will be populated by JavaScript 
              </select>
            </div>
            <div class="relative">
              <input type="text" id="searchInput" placeholder="Search renters..." class="w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" onkeyup="searchRenters()">
              <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
          </div>
        </div>

         
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
                 
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

   
  <div id="stallModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 id="stallModalTitle" class="text-lg font-medium text-gray-900">Add Stall</h3>
      </div>
      <form id="stallForm" class="p-6 space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Stall Number</label>
          <input type="text" id="stallNumber" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
          <select id="stallStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
            <option value="">Select Status</option>
            <option value="Available">Available</option>
            <option value="Occupied">Occupied</option>
            <option value="Inactive">Inactive</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
          <textarea id="stallNotes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
        </div>
        <div class="flex justify-end space-x-3 pt-4">
          <button type="button" onclick="closeStallModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700">Save</button>
        </div>
      </form>
    </div>
  </div>

   
  <div id="allStallsModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 max-h-[90vh] overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">All Stalls</h3>
      </div>
      <div class="p-6 overflow-y-auto max-h-[70vh]">
        <div id="allStallsContent">
           Stalls list will be populated here 
        </div>
      </div>
      <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
        <button onclick="closeAllStallsModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
      </div>
    </div>
  </div>

  
  <div id="renterModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 id="renterModalTitle" class="text-lg font-medium text-gray-900">Add Stall Renter</h3>
      </div>
      <form id="renterForm" class="p-6 space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
          <input type="text" id="renterName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Contact Info</label>
          <input type="text" id="contactInfo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Stall Number</label>
          <select id="renterStallNumber" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
            <option value="">Select Stall</option>
             Options will be populated by JavaScript 
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Rental Duration</label>
          <select id="rentalDuration" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
            <option value="">Select Duration</option>
            <option value="Daily">Daily</option>
            <option value="Weekly">Weekly</option>
            <option value="Monthly">Monthly</option>
          </select>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
            <input type="date" id="startDate" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
            <input type="date" id="endDate" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Rental Price (₱)</label>
          <input type="number" id="rentalPrice" min="0" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Scanned Contract</label>
          <div class="space-y-2">
            <input type="file" id="contractUpload" accept=".pdf,.jpg,.jpeg,.png" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
            <p class="text-xs text-gray-500">Accepted formats: PDF, JPG, PNG (Max 5MB)</p>
            <div id="contractPreview" class="hidden">
              <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                <div class="flex items-center">
                  <i class="fas fa-file-check mr-2 text-green-600"></i>
                  <span id="contractFileName" class="text-sm text-gray-700"></span>
                </div>
                <div class="flex space-x-2">
                  <button type="button" onclick="viewContract()" class="text-blue-600 hover:text-blue-800 text-sm">
                    <i class="fas fa-eye mr-1"></i>View
                  </button>
                  <button type="button" onclick="changeContract()" class="text-orange-600 hover:text-orange-800 text-sm">
                    <i class="fas fa-edit mr-1"></i>Change
                  </button>
                  <button type="button" onclick="removeContract()" class="text-red-600 hover:text-red-800 text-sm">
                    <i class="fas fa-trash mr-1"></i>Remove
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
          <textarea id="renterNotes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
        </div>
        <!-- Added Status field below Notes -->
        <div>
          <label for="editStatus" class="block text-sm font-medium text-gray-700">Status</label>
          <select id="editStatus" name="status"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
        <div class="flex justify-end space-x-3 pt-4">
          <button type="button" onclick="closeRenterModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700">Save</button>
        </div>
      </form>
    </div>
  </div>

    
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
           Contract content will be displayed here 
        </div>
      </div>
    </div>
  </div>

  
  <div id="paidFeesModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 max-h-[90vh] overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 id="paidFeesTitle" class="text-lg font-medium text-gray-900">Paid Fees</h3>
      </div>
      <div class="p-6 overflow-y-auto max-h-[70vh]">
        <div id="paidFeesContent">
           Paid fees will be populated here 
        </div>
      </div>
      <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
        <button onclick="closePaidFeesModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
      </div>
    </div>
  </div>

 
  <div id="unpaidFeesModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 max-h-[90vh] overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 id="unpaidFeesTitle" class="text-lg font-medium text-gray-900">Unpaid Fees</h3>
      </div>
      <div class="p-6 overflow-y-auto max-h-[70vh]">
        <div id="unpaidFeesContent">
           Unpaid fees will be populated here 
        </div>
      </div>
      <div class="px-6 py-4 border-t border-gray-200 flex justify-between items-center">
        <div class="flex items-center space-x-4">
          <button onclick="selectAllUnpaid()" class="text-teal-600 hover:text-teal-800 text-sm">
            <i class="fas fa-check-square mr-1"></i> Select All
          </button>
          <button onclick="deselectAllUnpaid()" class="text-gray-600 hover:text-gray-800 text-sm">
            <i class="fas fa-square mr-1"></i> Deselect All
          </button>
          <span id="selectedCount" class="text-sm text-gray-600">0 selected</span>
        </div>
        <div class="flex space-x-3">
          <button onclick="recordPaymentForSelected()" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Pay Selected
          </button>
          <button onclick="closeUnpaidFeesModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
        </div>
      </div>
    </div>
  </div>

 
  <div id="recordPaymentModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
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
          <label class="block text-sm font-medium text-gray-700">Proof of Payment</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-600">
                <label for="transactionProof" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                  <span>Upload proof of payment</span>
                  <input id="transactionProof" name="transactionProof" type="file" accept="image/png,image/jpeg,application/pdf" class="sr-only" />
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
            </div>
          </div>
          <div id="transactionProofPreview" class="mt-2"></div>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700">Acknowledgement Receipt</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-600">
                <label for="transactionAcknowledgement" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                  <span>Upload acknowledgement receipt</span>
                  <input id="transactionAcknowledgement" name="transactionAcknowledgement" type="file" accept="image/png,image/jpeg,application/pdf" class="sr-only" />
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
            </div>
          </div>
          <div id="transactionAcknowledgementPreview" class="mt-2"></div>
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
    let editingRenterId = null;
    let editingStallId = null;
    let currentRenterId = null;
    let selectedUnpaidFees = [];
    let currentContractFile = null;
    let currentProofFile = null;
    let currentAcknowledgementFile = null;

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
          notes: 'Specializes in Filipino dishes'
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
          notes: 'Sells casual wear'
        },
        {
          id: 3,
          name: 'Maria Reyes',
          contact: '09555123456',
          stallNumber: 'Stall 12',
          duration: 'Daily',
          startDate: '2024-02-01',
          endDate: '2024-02-28',
          price: 200,
          status: 'Inactive',
          notes: 'Jewelry and bags'
        }
      ];

      payments = [
        { id: 1, renterId: 1, period: 'January 2024', amount: 2500, date: '2024-01-01', method: 'Cash', remarks: 'Initial payment', proofFile: null, acknowledgementFile: null },
        { id: 2, renterId: 2, period: 'Week 1 Jan 2024', amount: 800, date: '2024-01-15', method: 'GCash', remarks: 'Weekly payment', proofFile: null, acknowledgementFile: null },
        { id: 3, renterId: 1, period: 'February 2024', amount: 2500, date: '2024-02-01', method: 'Cash', remarks: 'February payment', proofFile: null, acknowledgementFile: null },
        { id: 4, renterId: 2, period: 'Week 2 Jan 2024', amount: 800, date: '2024-01-22', method: 'GCash', remarks: 'Weekly payment', proofFile: null, acknowledgementFile: null }
      ];

      populateStallOptions();
      populateStallFilter();
      renderRentersTable();
      updateStats();
    }

    // Populate stall number options for renters
    function populateStallOptions() {
      const stallSelect = document.getElementById('renterStallNumber');
      const availableStalls = stalls.filter(s => s.status === 'Available');
      
      stallSelect.innerHTML = '<option value="">Select Stall</option>';
      
      availableStalls.forEach(stall => {
        stallSelect.innerHTML += `<option value="${stall.number}">${stall.number}</option>`;
      });
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
        const paidCount = payments.filter(p => p.renterId === renter.id).length;
        const unpaidCount = Math.max(0, 3 - paidCount);
        
        const row = document.createElement('tr');
        row.innerHTML = `
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">${renter.name}</div>
            <div class="text-sm text-gray-500">${renter.contact}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${renter.stallNumber}</td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${renter.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
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
            <button onclick="editRenter(${renter.id})" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded text-xs">
              Edit
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

    // Stall Modal functions
    function openAddStallModal() {
      editingStallId = null;
      document.getElementById('stallModalTitle').textContent = 'Add Stall';
      document.getElementById('stallForm').reset();
      document.getElementById('stallModal').classList.remove('hidden');
    }

    function closeStallModal() {
      document.getElementById('stallModal').classList.add('hidden');
    }

    // View all stalls
    function viewAllStalls() {
      let content = `
        <table class="excel-table">
          <thead>
            <tr>
              <th>Stall Number</th>
              <th>Status</th>
              <th>Notes</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
      `;
      
      stalls.forEach(stall => {
        content += `
          <tr>
            <td>${stall.number}</td>
            <td>
              <span class="px-2 py-1 text-xs rounded-full ${
                stall.status === 'Available' ? 'bg-green-100 text-green-800' :
                stall.status === 'Occupied' ? 'bg-blue-100 text-blue-800' :
                'bg-red-100 text-red-800'
              }">
                ${stall.status}
              </span>
            </td>
            <td>${stall.notes || '-'}</td>
            <td>
              <button onclick="editStall(${stall.id})" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded text-xs">Edit</button>
            </td>
          </tr>
        `;
      });
      
      content += '</tbody></table>';
      
      document.getElementById('allStallsContent').innerHTML = content;
      document.getElementById('allStallsModal').classList.remove('hidden');
    }

    function closeAllStallsModal() {
      document.getElementById('allStallsModal').classList.add('hidden');
    }

    function editStall(id) {
      closeAllStallsModal();
      editingStallId = id;
      const stall = stalls.find(s => s.id === id);
      
      document.getElementById('stallModalTitle').textContent = 'Edit Stall';
      document.getElementById('stallNumber').value = stall.number;
      document.getElementById('stallStatus').value = stall.status;
      document.getElementById('stallNotes').value = stall.notes || '';
      
      document.getElementById('stallModal').classList.remove('hidden');
    }

    // Stall form submission
    document.getElementById('stallForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = {
        number: document.getElementById('stallNumber').value,
        status: document.getElementById('stallStatus').value,
        notes: document.getElementById('stallNotes').value
      };

      if (editingStallId) {
        const index = stalls.findIndex(s => s.id === editingStallId);
        stalls[index] = { ...stalls[index], ...formData };
      } else {
        const newId = Math.max(...stalls.map(s => s.id), 0) + 1;
        stalls.push({ id: newId, ...formData });
      }

      populateStallOptions();
      updateStats();
      closeStallModal();
    });

    // Renter Modal functions
    function openAddRenterModal() {
      editingRenterId = null;
      currentContractFile = null;
      document.getElementById('renterModalTitle').textContent = 'Add Stall Renter';
      document.getElementById('renterForm').reset();
      document.getElementById('startDate').value = new Date().toISOString().split('T')[0];
      document.getElementById('contractPreview').classList.add('hidden');
      populateStallOptions();
      document.getElementById('renterModal').classList.remove('hidden');
    }

    function closeRenterModal() {
      document.getElementById('renterModal').classList.add('hidden');
    }

    function editRenter(id) {
      editingRenterId = id;
      const renter = renters.find(r => r.id === id);
      
      document.getElementById('renterModalTitle').textContent = 'Edit Stall Renter';
      document.getElementById('renterName').value = renter.name;
      document.getElementById('contactInfo').value = renter.contact;
      document.getElementById('rentalDuration').value = renter.duration;
      document.getElementById('startDate').value = renter.startDate;
      document.getElementById('endDate').value = renter.endDate || '';
      document.getElementById('rentalPrice').value = renter.price;
      document.getElementById('renterNotes').value = renter.notes || '';
      document.getElementById('editStatus').value = renter.status.toLowerCase();
      
      // Handle contract display
      if (renter.contractFile) {
        document.getElementById('contractFileName').textContent = renter.contractFile.name;
        document.getElementById('contractPreview').classList.remove('hidden');
        currentContractFile = renter.contractFile;
      } else {
        document.getElementById('contractPreview').classList.add('hidden');
        currentContractFile = null;
      }
      
      populateStallOptions();
      document.getElementById('renterStallNumber').innerHTML += `<option value="${renter.stallNumber}" selected>${renter.stallNumber}</option>`;
      document.getElementById('renterStallNumber').value = renter.stallNumber;
      
      document.getElementById('renterModal').classList.remove('hidden');
    }

    // Contract handling functions
    function viewContract() {
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

    function changeContract() {
      document.getElementById('contractUpload').click();
    }

    function removeContract() {
      currentContractFile = null;
      document.getElementById('contractUpload').value = '';
      document.getElementById('contractPreview').classList.add('hidden');
    }

    function closeContractViewModal() {
      document.getElementById('contractViewModal').classList.add('hidden');
    }

    // Contract upload handling
    document.getElementById('contractUpload').addEventListener('change', function(e) {
      const file = e.target.files[0];
      const preview = document.getElementById('contractPreview');
      const fileName = document.getElementById('contractFileName');
      
      if (file) {
        if (file.size > 5 * 1024 * 1024) {
          alert('File size must be less than 5MB');
          e.target.value = '';
          preview.classList.add('hidden');
          return;
        }
        
        currentContractFile = file;
        fileName.textContent = file.name;
        preview.classList.remove('hidden');
      } else {
        currentContractFile = null;
        preview.classList.add('hidden');
      }
    });

    document.getElementById('transactionProof').addEventListener('change', function(e) {
      const file = e.target.files[0];
      const preview = document.getElementById('transactionProofPreview');
      
      if (file) {
        if (file.size > 10 * 1024 * 1024) {
          alert('File size must be less than 10MB');
          e.target.value = '';
          preview.innerHTML = '';
          return;
        }
        
        currentProofFile = file;
        preview.innerHTML = `
          <div class="flex items-center justify-between p-2 bg-gray-50 rounded-md">
            <div class="flex items-center">
              <i class="fas fa-file-image mr-2 text-teal-600"></i>
              <span class="text-sm text-gray-700">${file.name}</span>
            </div>
            <button type="button" onclick="removeProofFile()" class="text-red-600 hover:text-red-800 text-sm">
              <i class="fas fa-times"></i>
            </button>
          </div>
        `;
      } else {
        currentProofFile = null;
        preview.innerHTML = '';
      }
    });

    document.getElementById('transactionAcknowledgement').addEventListener('change', function(e) {
      const file = e.target.files[0];
      const preview = document.getElementById('transactionAcknowledgementPreview');
      
      if (file) {
        if (file.size > 10 * 1024 * 1024) {
          alert('File size must be less than 10MB');
          e.target.value = '';
          preview.innerHTML = '';
          return;
        }
        
        currentAcknowledgementFile = file;
        preview.innerHTML = `
          <div class="flex items-center justify-between p-2 bg-gray-50 rounded-md">
            <div class="flex items-center">
              <i class="fas fa-file-check mr-2 text-teal-600"></i>
              <span class="text-sm text-gray-700">${file.name}</span>
            </div>
            <button type="button" onclick="removeAcknowledgementFile()" class="text-red-600 hover:text-red-800 text-sm">
              <i class="fas fa-times"></i>
            </button>
          </div>
        `;
      } else {
        currentAcknowledgementFile = null;
        preview.innerHTML = '';
      }
    });

    function removeProofFile() {
      currentProofFile = null;
      document.getElementById('transactionProof').value = '';
      document.getElementById('transactionProofPreview').innerHTML = '';
    }

    function removeAcknowledgementFile() {
      currentAcknowledgementFile = null;
      document.getElementById('transactionAcknowledgement').value = '';
      document.getElementById('transactionAcknowledgementPreview').innerHTML = '';
    }

    // Renter form submission
    document.getElementById('renterForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = {
        name: document.getElementById('renterName').value,
        contact: document.getElementById('contactInfo').value,
        stallNumber: document.getElementById('renterStallNumber').value,
        duration: document.getElementById('rentalDuration').value,
        startDate: document.getElementById('startDate').value,
        endDate: document.getElementById('endDate').value,
        price: parseFloat(document.getElementById('rentalPrice').value),
        status: document.getElementById('editStatus').value === 'active' ? 'Active' : 'Inactive',
        notes: document.getElementById('renterNotes').value,
        contractFile: currentContractFile
      };

      if (editingRenterId) {
        const index = renters.findIndex(r => r.id === editingRenterId);
        renters[index] = { ...renters[index], ...formData };
      } else {
        const newId = Math.max(...renters.map(p => p.id), 0) + 1;
        renters.push({ id: newId, ...formData });
        
        const stallIndex = stalls.findIndex(s => s.number === formData.stallNumber);
        if (stallIndex !== -1) {
          stalls[stallIndex].status = 'Occupied';
        }
      }

      renderRentersTable();
      updateStats();
      populateStallOptions();
      closeRenterModal();
    });

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
          <table class="excel-table">
            <thead>
              <tr>
                <th>Period</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Method</th>
                <th>Proof of Payment</th>
                <th>Acknowledgement Receipt</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
        `;
        
        paidPayments.forEach(payment => {
          const proofDisplay = payment.proofFile 
            ? `<button onclick="viewPaymentFile(${payment.id}, 'proof')" class="text-blue-600 hover:text-blue-800 text-xs">
                <i class="fas fa-eye mr-1"></i>View
              </button>`
            : '<span class="text-gray-400 text-xs">No file</span>';
          
          const acknowledgementDisplay = payment.acknowledgementFile 
            ? `<button onclick="viewPaymentFile(${payment.id}, 'acknowledgement')" class="text-blue-600 hover:text-blue-800 text-xs">
                <i class="fas fa-eye mr-1"></i>View
              </button>`
            : '<span class="text-gray-400 text-xs">No file</span>';
          
          content += `
            <tr>
              <td>${payment.period}</td>
              <td>₱${payment.amount.toLocaleString()}</td>
              <td>${new Date(payment.date).toLocaleDateString()}</td>
              <td>${payment.method}</td>
              <td>${proofDisplay}</td>
              <td>${acknowledgementDisplay}</td>
              <td>${payment.remarks || '-'}</td>
            </tr>
          `;
        });
        
        content += '</tbody></table>';
      }
      
      document.getElementById('paidFeesContent').innerHTML = content;
      document.getElementById('paidFeesModal').classList.remove('hidden');
    }

    function viewPaymentFile(paymentId, fileType) {
      const payment = payments.find(p => p.id === paymentId);
      if (!payment) return;
      
      const file = fileType === 'proof' ? payment.proofFile : payment.acknowledgementFile;
      if (!file) {
        alert('File not found');
        return;
      }
      
      const reader = new FileReader();
      reader.onload = function(e) {
        const content = document.getElementById('contractViewContent');
        const modalTitle = document.querySelector('#contractViewModal h3');
        modalTitle.textContent = fileType === 'proof' ? 'Proof of Payment' : 'Acknowledgement Receipt';
        
        if (file.type.includes('image')) {
          content.innerHTML = `<img src="${e.target.result}" class="max-w-full h-auto" alt="${fileType}">`;
        } else if (file.type === 'application/pdf') {
          content.innerHTML = `<embed src="${e.target.result}" type="application/pdf" width="100%" height="600px">`;
        } else {
          content.innerHTML = `<p class="text-gray-500">Cannot preview this file type. <a href="${e.target.result}" download="${file.name}" class="text-blue-600 hover:underline">Download to view</a></p>`;
        }
      };
      reader.readAsDataURL(file);
      document.getElementById('contractViewModal').classList.remove('hidden');
    }

    function closePaidFeesModal() {
      document.getElementById('paidFeesModal').classList.add('hidden');
    }

    // Unpaid Fees Modal
    function viewUnpaidFees(renterId) {
      currentRenterId = renterId;
      selectedUnpaidFees = [];
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
                <th width="50">Select</th>
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
              <td>
                <input type="checkbox" id="unpaid_${index}" value="${period}" onchange="updateSelectedCount()" class="unpaid-checkbox">
              </td>
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
      updateSelectedCount();
      document.getElementById('unpaidFeesModal').classList.remove('hidden');
    }

    function closeUnpaidFeesModal() {
      document.getElementById('unpaidFeesModal').classList.add('hidden');
    }

    // Checkbox management functions
    function selectAllUnpaid() {
      const checkboxes = document.querySelectorAll('.unpaid-checkbox');
      checkboxes.forEach(cb => cb.checked = true);
      updateSelectedCount();
    }

    function deselectAllUnpaid() {
      const checkboxes = document.querySelectorAll('.unpaid-checkbox');
      checkboxes.forEach(cb => cb.checked = false);
      updateSelectedCount();
    }

    function updateSelectedCount() {
      const checkboxes = document.querySelectorAll('.unpaid-checkbox:checked');
      selectedUnpaidFees = Array.from(checkboxes).map(cb => cb.value);
      document.getElementById('selectedCount').textContent = `${selectedUnpaidFees.length} selected`;
    }

    function recordPaymentForSelected() {
      if (selectedUnpaidFees.length === 0) {
        alert('Please select at least one unpaid fee to pay.');
        return;
      }
      
      currentProofFile = null;
      currentAcknowledgementFile = null;
      document.getElementById('transactionProof').value = '';
      document.getElementById('transactionAcknowledgement').value = '';
      document.getElementById('transactionProofPreview').innerHTML = '';
      document.getElementById('transactionAcknowledgementPreview').innerHTML = '';
      
      const renter = renters.find(r => r.id === currentRenterId);
      const totalAmount = selectedUnpaidFees.length * renter.price;
      
      document.getElementById('paymentRenterName').value = renter.name;
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

    // Record Payment form submission
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
          remarks: remarks,
          proofFile: currentProofFile,
          acknowledgementFile: currentAcknowledgementFile
        });
      });
      
      renderRentersTable();
      closeRecordPaymentModal();
      closeUnpaidFeesModal();
      
      alert(`Payment recorded successfully for ${periods.length} period(s)!`);
    });

    // Initialize the application
    document.addEventListener('DOMContentLoaded', function() {
      initializeSampleData();
    });
  </script>
</body>
</html>

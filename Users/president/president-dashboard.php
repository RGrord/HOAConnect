<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - President Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <!-- Added jsPDF autotable plugin for table PDF generation -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
  <style>
    /* Minimal styles for the card and modal */
    .payment-details p {
      margin-bottom: 8px;
    }
    .payment-details label {
      font-weight: 500;
      color: #374151;
    }
    .payment-details span {
      color: #1f2937;
    }
    .payment-card {
      border: 2px solid #14b8a6; /* Teal-500 border */
      background-color: #ccfbf1; /* Teal-50 background */
      border-radius: 4px;
      padding: 16px;
      margin-bottom: 16px;
    }
    .modal-content {
      background-color: white;
      border-radius: 8px;
      width: 100%;
      max-width: 900px; /* Increased max-width for table */
      max-height: 90vh; /* Increased max-height */
      overflow: hidden; /* Changed to hidden, inner div will scroll */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
    }
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px 24px;
      border-bottom: 1px solid #e5e7eb;
    }
    .modal-header h3 {
      font-size: 18px;
      font-weight: 600;
      color: #1f2937;
      padding-left: 16px; /* Added left padding */
    }
    .modal-header button {
      color: #6b7280;
      font-size: 18px;
      padding-right: 16px; /* Added right padding */
    }
    .modal-body {
      padding: 24px;
      flex-grow: 1;
      overflow-y: auto; /* Make body scrollable */
    }
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
    .modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 8px;
      padding: 16px 24px;
      border-top: 1px solid #e5e7eb;
    }
    .modal-footer button {
      padding: 8px 16px;
      font-size: 14px;
      font-weight: 500;
      border-radius: 4px;
      transition: background-color 0.2s;
    }
    .modal-footer .close-btn {
      background-color: white;
      border: 1px solid #d1d5db;
      color: #374151;
    }
    .modal-footer .close-btn:hover {
      background-color: #f3f4f6;
    }
    .modal-footer .download-btn,
    .modal-footer .print-btn {
      background-color: #14b8a6;
      border: none;
      color: white;
    }
    .modal-footer .download-btn:hover,
    .modal-footer .print-btn:hover {
      background-color: #0d9488;
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
        <a href="president-dashboard.php" class="flex items-center px-6 py-3 bg-teal-700">
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
        <a href="president-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-newspaper mr-3"></i>
          <span>News Feed</span>
        </a>

        <a href="president-transaction.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-newspaper mr-3"></i>
          <span>Transactions</span>
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
            <h1 class="text-2xl font-bold text-gray-900">President's Dashboard</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>

      <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <!-- Total Users -->
          <a href="registered-homeowners.html" class="block">
            <div class="bg-white rounded-lg shadow p-6 cursor-pointer">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-500">Total Users</p>
                  <p class="text-2xl font-bold text-gray-900">156</p>
                </div>
                <div class="bg-teal-100 p-3 rounded-full text-teal-600">
                  <i class="fas fa-users"></i>
                </div>
              </div>
            </div>
          </a>

          <!-- Total Events -->
          <a href="president-calendar.html" class="block">
            <div class="bg-white rounded-lg shadow p-6 cursor-pointer">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-500">Total Events</p>
                  <p class="text-2xl font-bold text-gray-900">24</p>
                </div>
                <div class="bg-teal-100 p-3 rounded-full text-teal-600">
                  <i class="fas fa-calendar-alt"></i>
                </div>
              </div>
            </div>
          </a>

          <!-- Total Collected Fees -->
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-500">Total Collected Fees</p>
                <p class="text-2xl font-bold text-gray-900">₱179,400</p>
              </div>
              <div class="bg-green-100 p-3 rounded-full text-green-600">
                <i class="fas fa-money-bill-wave"></i>
              </div>
            </div>
          </div>

          <!-- Pending Approvals -->
          <a href="president-projectproposal.html" class="block">
            <div class="bg-white rounded-lg shadow p-6 cursor-pointer">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-500">Pending Approvals</p>
                  <p class="text-2xl font-bold text-gray-900">5</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full text-yellow-600">
                  <i class="fas fa-clipboard-check"></i>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Fee Collection Chart -->
        <div class="bg-white rounded-lg shadow mb-8">
          <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Fee Collection Overview</h2>
          </div>
          <div class="p-6">
            <div class="flex justify-between mb-6">
              <div class="flex space-x-2">
                <button id="dailyBtn" class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-md">Daily</button>
                <button id="weeklyBtn" class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-md">Weekly</button>
                <button id="monthlyBtn" class="px-3 py-1 bg-teal-600 text-white text-sm rounded-md">Monthly</button>
                <button id="annualBtn" class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-md">Annual</button>
              </div>
              <div>
                <select id="yearSelect" class="border border-gray-300 rounded-md shadow-sm py-1 px-3 bg-white focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                  <option value="2025" selected>2025</option>
                  <option value="2023">2023</option>
                  <option value="2022">2022</option>
                  <option value="2021">2021</option>
                </select>
              </div>
            </div>
            <!-- Chart Canvas -->
            <div class="h-64">
              <canvas id="feeCollectionChart"></canvas>
            </div>
            <div class="mt-6 grid grid-cols-4 gap-4 text-center">
              <div>
                <p class="text-sm font-medium text-gray-500">Today</p>
                <p class="text-lg font-semibold text-gray-900">₱3,450</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">This Week</p>
                <p class="text-lg font-semibold text-gray-900">₱12,800</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">This Month</p>
                <p class="text-lg font-semibold text-gray-900">₱45,600</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">This Year</p>
                <p class="text-lg font-semibold text-gray-900">₱179,400</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Today's Payments -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
          <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-900">Today's Payments</h2>
            <a href="president-payment-history.html" class="bg-teal-600 text-white px-3 py-1 rounded hover:bg-teal-800 text-sm font-medium">
              View All
            </a>
          </div>
          <div class="overflow-x-auto">
            <table id="paymentTable" class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr data-user-id="USER001">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">Maria Santos</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">maria.santos@example.com</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="openPaymentHistoryModal('USER001', 'Maria Santos', 'maria.santos@example.com')"
                      class="bg-teal-600 text-white px-2 py-1 rounded hover:bg-teal-800">
                      View
                    </button>
                  </td>
                </tr>
                <tr data-user-id="USER002">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">Juan Cruz</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">juan.cruz@example.com</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="openPaymentHistoryModal('USER002', 'Juan Cruz', 'juan.cruz@example.com')"
                      class="bg-teal-600 text-white px-2 py-1 rounded hover:bg-teal-800">
                      View
                    </button>
                  </td>
                </tr>
                <tr data-user-id="USER003">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">Ana Reyes</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">ana.reyes@example.com</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="openPaymentHistoryModal('USER003', 'Ana Reyes', 'ana.reyes@example.com')"
                      class="bg-teal-600 text-white px-2 py-1 rounded hover:bg-teal-800">
                      View
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex items-center justify-between">
              <div id="paginationText" class="text-sm text-gray-700">
                Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">3</span> results
              </div>
              <div class="flex space-x-2">
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                  Previous
                </button>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                  Next
                </button>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Payment History Modal -->
  <div id="paymentHistoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="modal-user-name" class="text-lg font-semibold text-gray-900"></h3>
        <button onclick="closePaymentHistoryModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <!-- Added filtering controls section -->
      <div class="p-4 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center space-x-2">
          <label for="filterMonth" class="text-sm font-medium text-gray-700">Month:</label>
          <select id="filterMonth" class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-teal-500" onchange="filterPaymentsInModal()">
            <option value="">All</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
          <label for="filterYear" class="text-sm font-medium text-gray-700">Year:</label>
          <select id="filterYear" class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-teal-500" onchange="filterPaymentsInModal()">
            <option value="">All</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
          </select>
          <label for="filterDay" class="text-sm font-medium text-gray-700">Day:</label>
          <input type="number" id="filterDay" placeholder="Day" min="1" max="31" class="w-20 px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-teal-500" oninput="filterPaymentsInModal()">
        </div>
        <div class="flex items-center space-x-4">
          <button onclick="selectAllPayments()" class="text-teal-600 hover:text-teal-800 text-sm">
            <i class="fas fa-check-square mr-1"></i> Select All
          </button>
          <button onclick="deselectAllPayments()" class="text-gray-600 hover:text-gray-800 text-sm">
            <i class="fas fa-square mr-1"></i> Deselect All
          </button>
          <span id="selectedPaymentsCount" class="text-sm text-gray-600">0 selected</span>
        </div>
      </div>
      <div class="modal-body" id="paymentHistoryBody">
        <!-- Payment table will be dynamically inserted here -->
      </div>
      <div class="modal-footer">
        <button onclick="closePaymentHistoryModal()" class="close-btn">Close</button>
        <button onclick="downloadPDF()" class="download-btn">Download PDF</button>
        <button onclick="printPaymentHistory()" class="print-btn">Print</button>
      </div>
    </div>
  </div>

  <!-- Proof View Modal -->
  <div id="proofViewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 max-h-[90vh] overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900 pl-4">Proof of Payment</h3>
        <button onclick="closeProofViewModal()" class="text-gray-400 hover:text-gray-600 pr-4">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-6 overflow-y-auto max-h-[70vh]">
        <div id="proofViewContent" class="text-center">
          <!-- Proof content will be displayed here -->
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Sidebar functionality
      const sidebarLinks = document.querySelectorAll('nav a');
      const currentPath = window.location.pathname.split('/').pop();

      sidebarLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
          sidebarLinks.forEach(l => l.classList.remove('bg-teal-700', 'bg-teal-900'));
          link.classList.add('bg-teal-700');
        }

        link.addEventListener('mouseenter', function() {
          if (!link.classList.contains('bg-teal-700')) {
            link.classList.add('bg-teal-600');
          }
        });

        link.addEventListener('mouseleave', function() {
          if (!link.classList.contains('bg-teal-700')) {
            link.classList.remove('bg-teal-600');
          }
        });

        link.addEventListener('click', function(e) {
          if (link.getAttribute('href') === currentPath) {
            e.preventDefault();
            sidebarLinks.forEach(l => l.classList.remove('bg-teal-700', 'bg-teal-900'));
            link.classList.add('bg-teal-700');
          }
        });
      });

      // Sample payment data for each user
      const paymentData = {
        USER001: [
          { paymentId: 'PAY001', paymentFor: 'Monthly Dues', amount: '50', date: '2025-01-01', time: '10:00 AM', method: 'Bank Transfer', status: 'paid', address: 'Block 5, Lot 12', proofType: 'image', proofUrl: '/placeholder.svg?height=300&width=400', type: 'Resident' },
          { paymentId: 'PAY006', paymentFor: 'Monthly Dues', amount: '50', date: '2025-02-15', time: '02:30 PM', method: 'GCash', status: 'paid', address: 'Block 5, Lot 12', proofType: 'image', proofUrl: '/placeholder.svg?height=300&width=400', type: 'Resident' },
          { paymentId: 'PAY007', paymentFor: 'Monthly Dues', amount: '50', date: '2025-03-20', time: '01:00 PM', method: 'GCash', status: 'paid', address: 'Block 5, Lot 12', proofType: 'image', proofUrl: '/placeholder.svg?height=300&width=400', type: 'Resident' },
          { paymentId: 'PAY008', paymentFor: 'Monthly Dues', amount: '50', date: '2024-12-05', time: '09:00 AM', method: 'Bank Transfer', status: 'paid', address: 'Block 5, Lot 12', proofType: 'pdf', proofUrl: '/placeholder.svg?height=300&width=400', type: 'Resident' }
        ],
        USER002: [
          { paymentId: 'PAY002', paymentFor: 'Monthly Dues', amount: '50', date: '2025-01-02', time: '11:15 AM', method: 'GCash', status: 'paid', address: 'Block 2, Lot 8', proofType: 'image', proofUrl: '/placeholder.svg?height=300&width=400', type: 'Resident' }
        ],
        USER003: [
          { paymentId: 'PAY003', paymentFor: 'Monthly Dues', amount: '50', date: '2025-02-03', time: '09:45 AM', method: 'GCash', status: 'paid', address: 'Block 3, Lot 15', proofType: 'image', proofUrl: '/placeholder.svg?height=300&width=400', type: 'Non-Resident' }
        ]
      };

      // Added variables for tracking current payments and selections
      let currentPayments = []; // Stores the payments for the currently open modal
      let selectedPaymentIds = new Set(); // Stores IDs of selected payments

      window.openPaymentHistoryModal = function(userId, name, email) {
        const modal = document.getElementById('paymentHistoryModal');
        const modalUserName = document.getElementById('modal-user-name');

        modalUserName.textContent = `${name} (${userId}) - Payment History`;
        
        // Reset filters and selections
        document.getElementById('filterMonth').value = '';
        document.getElementById('filterYear').value = '';
        document.getElementById('filterDay').value = '';
        selectedPaymentIds.clear();

        currentPayments = paymentData[userId] || [];
        renderPaymentTable(currentPayments);
        updateSelectedPaymentsCount();

        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      };

      // Added renderPaymentTable function to create Excel-style table
      function renderPaymentTable(paymentsToRender) {
        const modalBody = document.getElementById('paymentHistoryBody');
        modalBody.innerHTML = `
          <table class="excel-table">
            <thead>
              <tr>
                <th width="30">
                  <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this.checked)">
                </th>
                <th>Fee Name</th>
                <th>Amount</th>
                <th>Due Date</th>
                <th>Status Paid</th>
                <th>Payment Method (GCash or Bank Transfer Only)</th>
                <th>Reference Number</th>
                <th>Uploaded Receipt</th>
              </tr>
            </thead>
            <tbody id="paymentTableBody">
            </tbody>
          </table>
        `;

        const tbody = document.getElementById('paymentTableBody');
        paymentsToRender.forEach(payment => {
          const referenceNumber = `REF-${new Date(payment.date).getFullYear()}-${String(payment.paymentId.slice(-3)).padStart(4, '0')}`;
          
          const isSelected = selectedPaymentIds.has(payment.paymentId);

          tbody.innerHTML += `
            <tr data-payment-id="${payment.paymentId}" class="${isSelected ? 'bg-teal-50' : ''}">
              <td>
                <input type="checkbox" class="payment-checkbox" value="${payment.paymentId}" ${isSelected ? 'checked' : ''} onchange="updateSelectedPayments()">
              </td>
              <td>${payment.paymentFor}</td>
              <td>₱${payment.amount}</td>
              <td>${payment.date}</td>
              <td>${payment.status.charAt(0).toUpperCase() + payment.status.slice(1)}</td>
              <td>${payment.method}</td>
              <td>${referenceNumber}</td>
              <td>
                <button onclick="viewProof('${payment.paymentId}')" class="bg-teal-600 text-white px-3 py-1 rounded hover:bg-teal-800 text-sm">
                  View
                </button>
              </td>
            </tr>
          `;
        });
        // Ensure selectAllCheckbox state is correct after rendering
        const allCheckboxes = document.querySelectorAll('#paymentTableBody .payment-checkbox');
        document.getElementById('selectAllCheckbox').checked = allCheckboxes.length > 0 && selectedPaymentIds.size === allCheckboxes.length;
      }

      // Added filtering, selection, and proof viewing functions
      window.filterPaymentsInModal = function() {
        const monthFilter = document.getElementById('filterMonth').value;
        const yearFilter = document.getElementById('filterYear').value;
        const dayFilter = document.getElementById('filterDay').value;

        const filtered = currentPayments.filter(payment => {
          const paymentDate = new Date(payment.date);
          const paymentMonth = String(paymentDate.getMonth() + 1).padStart(2, '0');
          const paymentYear = String(paymentDate.getFullYear());
          const paymentDay = String(paymentDate.getDate());

          const matchesMonth = !monthFilter || paymentMonth === monthFilter;
          const matchesYear = !yearFilter || paymentYear === yearFilter;
          const matchesDay = !dayFilter || paymentDay === dayFilter.padStart(2, '0');

          return matchesMonth && matchesYear && matchesDay;
        });
        
        renderPaymentTable(filtered);
        updateSelectedPaymentsCount();
      };

      window.selectAllPayments = function() {
        const checkboxes = document.querySelectorAll('#paymentTableBody .payment-checkbox');
        selectedPaymentIds.clear();
        checkboxes.forEach(cb => {
          cb.checked = true;
          selectedPaymentIds.add(cb.value);
          cb.closest('tr').classList.add('bg-teal-50');
        });
        document.getElementById('selectAllCheckbox').checked = true;
        updateSelectedPaymentsCount();
      };

      window.deselectAllPayments = function() {
        const checkboxes = document.querySelectorAll('#paymentTableBody .payment-checkbox');
        selectedPaymentIds.clear();
        checkboxes.forEach(cb => {
          cb.checked = false;
          cb.closest('tr').classList.remove('bg-teal-50');
        });
        document.getElementById('selectAllCheckbox').checked = false;
        updateSelectedPaymentsCount();
      };

      window.updateSelectedPayments = function() {
        selectedPaymentIds.clear();
        const checkboxes = document.querySelectorAll('#paymentTableBody .payment-checkbox');
        checkboxes.forEach(cb => {
          const row = cb.closest('tr');
          if (cb.checked) {
            selectedPaymentIds.add(cb.value);
            row.classList.add('bg-teal-50');
          } else {
            selectedPaymentIds.delete(cb.value);
            row.classList.remove('bg-teal-50');
          }
        });
        document.getElementById('selectAllCheckbox').checked = selectedPaymentIds.size === checkboxes.length && checkboxes.length > 0;
        updateSelectedPaymentsCount();
      };

      function updateSelectedPaymentsCount() {
        document.getElementById('selectedPaymentsCount').textContent = `${selectedPaymentIds.size} selected`;
      }

      window.viewProof = function(paymentId) {
        const payment = currentPayments.find(p => p.paymentId === paymentId);
        if (!payment || !payment.proofUrl) {
          alert('No proof available for this payment.');
          return;
        }

        const proofViewContent = document.getElementById('proofViewContent');
        proofViewContent.innerHTML = '';

        if (payment.proofType === 'image') {
          proofViewContent.innerHTML = `<img src="${payment.proofUrl}" class="max-w-full h-auto mx-auto" alt="Proof of Payment">`;
        } else if (payment.proofType === 'pdf') {
          proofViewContent.innerHTML = `<embed src="${payment.proofUrl}" type="application/pdf" width="100%" height="600px">`;
        } else {
          proofViewContent.innerHTML = `<p class="text-gray-500">Cannot preview this file type. <a href="${payment.proofUrl}" download="${paymentId}_proof" class="text-blue-600 hover:underline">Download to view</a></p>`;
        }
        document.getElementById('proofViewModal').classList.remove('hidden');
      };

      window.closeProofViewModal = function() {
        document.getElementById('proofViewModal').classList.add('hidden');
      };

      window.closePaymentHistoryModal = function() {
        const modal = document.getElementById('paymentHistoryModal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      };

      window.downloadPDF = function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('landscape');
        const modalUserName = document.getElementById('modal-user-name').textContent;
        
        const paymentsToPrint = selectedPaymentIds.size > 0
          ? currentPayments.filter(p => selectedPaymentIds.has(p.paymentId))
          : currentPayments;

        if (paymentsToPrint.length === 0) {
          alert('No payments selected or available to download.');
          return;
        }

        const tableData = paymentsToPrint.map(payment => [
          payment.paymentFor,
          `₱${payment.amount}`,
          payment.date,
          payment.status.charAt(0).toUpperCase() + payment.status.slice(1),
          payment.method,
          `REF-${new Date(payment.date).getFullYear()}-${String(payment.paymentId.slice(-3)).padStart(4, '0')}`
        ]);

        doc.setFontSize(18);
        doc.text(modalUserName, 14, 20);
        doc.autoTable({
          startY: 30,
          head: [['Fee Name', 'Amount', 'Due Date', 'Status Paid', 'Payment Method', 'Reference Number']],
          body: tableData,
          theme: 'grid',
          styles: { fontSize: 8, cellPadding: 2, overflow: 'linebreak' },
          headStyles: { fillColor: [243, 244, 246], textColor: [75, 85, 99], fontStyle: 'bold' },
          columnStyles: {
            0: { cellWidth: 40 },
            1: { cellWidth: 20 },
            2: { cellWidth: 25 },
            3: { cellWidth: 20 },
            4: { cellWidth: 25 },
            5: { cellWidth: 40 }
          }
        });

        doc.save(`${modalUserName.replace(/ /g, '_')}_payment_history.pdf`);
      };

      window.printPaymentHistory = function() {
        const originalContent = document.body.innerHTML;
        
        const paymentsToPrint = selectedPaymentIds.size > 0
          ? currentPayments.filter(p => selectedPaymentIds.has(p.paymentId))
          : currentPayments;

        if (paymentsToPrint.length === 0) {
          alert('No payments selected or available to print.');
          return;
        }

        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = `
          <h3 class="text-lg font-semibold text-gray-900 mb-4">${document.getElementById('modal-user-name').textContent}</h3>
          <table class="excel-table">
            <thead>
              <tr>
                <th>Fee Name</th>
                <th>Amount</th>
                <th>Due Date</th>
                <th>Status Paid</th>
                <th>Payment Method</th>
                <th>Reference Number</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        `;
        const tbody = tempDiv.querySelector('tbody');
        paymentsToPrint.forEach(payment => {
          const referenceNumber = `REF-${new Date(payment.date).getFullYear()}-${String(payment.paymentId.slice(-3)).padStart(4, '0')}`;
          tbody.innerHTML += `
            <tr>
              <td>${payment.paymentFor}</td>
              <td>₱${payment.amount}</td>
              <td>${payment.date}</td>
              <td>${payment.status.charAt(0).toUpperCase() + payment.status.slice(1)}</td>
              <td>${payment.method}</td>
              <td>${referenceNumber}</td>
            </tr>
          `;
        });

        document.body.innerHTML = `
          <div style="padding: 20px;">${tempDiv.innerHTML}</div>
          <style>
            body { background: white; }
            .excel-table { border-collapse: collapse; width: 100%; font-size: 12px; }
            .excel-table th, .excel-table td { border: 1px solid #d1d5db; padding: 8px; text-align: left; }
            .excel-table th { background-color: #f3f4f6; font-weight: bold; }
            .excel-table tr:nth-child(even) { background-color: #f9fafb; }
          </style>
        `;
        window.print();
        document.body.innerHTML = originalContent;
      };

      // Fee Collection Chart
      const ctx = document.getElementById('feeCollectionChart').getContext('2d');
      let feeChart;

      // Sample data for different views and years
      const chartData = {
        2025: {
          daily: {
            labels: ['Apr 25', 'Apr 26', 'Apr 27', 'Apr 28', 'Apr 29', 'Apr 30', 'May 1'],
            data: [2800, 2900, 3100, 3000, 3200, 3300, 3450] // Today: ₱3,450
          },
          weekly: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
            data: [11000, 11500, 12000, 12500, 12800] // This Week: ₱12,800
          },
          monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            data: [35000, 36000, 37000, 40000, 45600] // This Month: ₱45,600
          },
          annual: {
            labels: ['2021', '2022', '2023', '2024', '2025'],
            data: [140000, 150000, 160000, 170000, 179400] // This Year: ₱179,400
          }
        },
        2023: {
          daily: {
            labels: ['Dec 25', 'Dec 26', 'Dec 27', 'Dec 28', 'Dec 29', 'Dec 30', 'Dec 31'],
            data: [2500, 2600, 2700, 2800, 2900, 3000, 3100]
          },
          weekly: {
            labels: ['Week 49', 'Week 50', 'Week 51', 'Week 52'],
            data: [10000, 10500, 11000, 11500]
          },
          monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            data: [30000, 31000, 32000, 33000, 34000, 35000, 36000, 37000, 38000, 39000, 40000, 41000]
          },
          annual: {
            labels: ['2021', '2022', '2023'],
            data: [140000, 150000, 160000]
          }
        },
        2022: {
          daily: {
            labels: ['Dec 25', 'Dec 26', 'Dec 27', 'Dec 28', 'Dec 29', 'Dec 30', 'Dec 31'],
            data: [2200, 2300, 2400, 2500, 2600, 2700, 2800]
          },
          weekly: {
            labels: ['Week 49', 'Week 50', 'Week 51', 'Week 52'],
            data: [9000, 9500, 10000, 10500]
          },
          monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            data: [28000, 29000, 30000, 31000, 32000, 33000, 34000, 35000, 36000, 37000, 38000, 39000]
          },
          annual: {
            labels: ['2021', '2022'],
            data: [140000, 150000]
          }
        },
        2021: {
          daily: {
            labels: ['Dec 25', 'Dec 26', 'Dec 27', 'Dec 28', 'Dec 29', 'Dec 30', 'Dec 31'],
            data: [2000, 2100, 2200, 2300, 2400, 2500, 2600]
          },
          weekly: {
            labels: ['Week 49', 'Week 50', 'Week 51', 'Week 52'],
            data: [8000, 8500, 9000, 9500]
          },
          monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            data: [25000, 26000, 27000, 28000, 29000, 30000, 31000, 32000, 33000, 34000, 35000, 36000]
          },
          annual: {
            labels: ['2021'],
            data: [140000]
          }
        }
      };

      // Initialize the chart with default view (Monthly, 2025)
      feeChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: chartData[2025].monthly.labels,
          datasets: [{
            label: 'Fee Collection (₱)',
            data: chartData[2025].monthly.data,
            borderColor: '#0d9488',
            backgroundColor: 'rgba(13, 148, 136, 0.2)',
            fill: true,
            tension: 0.4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Amount (₱)'
              }
            },
            x: {
              title: {
                display: true,
                text: 'Time'
              }
            }
          },
          plugins: {
            legend: {
              display: true,
              position: 'top'
            }
          }
        }
      });

      // Function to update the chart based on view and year
      function updateChart(view, year) {
        feeChart.data.labels = chartData[year][view].labels;
        feeChart.data.datasets[0].data = chartData[year][view].data;
        feeChart.options.scales.x.title.text = view === 'daily' ? 'Day' : view === 'weekly' ? 'Week' : view === 'monthly' ? 'Month' : 'Year';
        feeChart.update();
      }

      // Button event listeners
      const buttons = {
        daily: document.getElementById('dailyBtn'),
        weekly: document.getElementById('weeklyBtn'),
        monthly: document.getElementById('monthlyBtn'),
        annual: document.getElementById('annualBtn')
      };
      let currentView = 'monthly';
      let currentYear = '2025';

      Object.keys(buttons).forEach(view => {
        buttons[view].addEventListener('click', () => {
          currentView = view;
          Object.values(buttons).forEach(btn => {
            btn.classList.remove('bg-teal-600', 'text-white');
            btn.classList.add('bg-gray-200', 'text-gray-700');
          });
          buttons[view].classList.remove('bg-gray-200', 'text-gray-700');
          buttons[view].classList.add('bg-teal-600', 'text-white');
          updateChart(currentView, currentYear);
        });
      });

      // Year dropdown event listener
      const yearSelect = document.getElementById('yearSelect');
      yearSelect.addEventListener('change', (e) => {
        currentYear = e.target.value;
        updateChart(currentView, currentYear);
      });
    });
  </script>
</body>
</html>

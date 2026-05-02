<?php

include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$user_id = $_SESSION['user_id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - Payment History</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
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
    .modal-content {
      background-color: white;
      border-radius: 8px;
      width: 100%;
      max-width: 1200px; /* Increased from 900px to 1200px for larger modal */
      max-height: 95vh; /* Increased from 90vh to 95vh for taller modal */
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
      user-select: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      /* Added comprehensive selection prevention */
      -webkit-touch-callout: none;
      -webkit-tap-highlight-color: transparent;
      cursor: default;
      outline: none;
    }
    /* Added non-selectable styling for main table headers */
    #paymentTable thead th {
      user-select: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      -webkit-touch-callout: none;
      -webkit-tap-highlight-color: transparent;
      cursor: default;
      outline: none;
    }
    .payment-card {
      border: 2px solid #14b8a6; /* Teal-500 border */
      background-color: #ccfbf1; /* Teal-50 background */
      border-radius: 4px;
      padding: 16px;
      margin-bottom: 16px;
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
        <a href="president-payment-history.php" class="flex items-center px-6 py-3 bg-teal-700">
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

      <!--Main Content-->

      <div class="flex-1 overflow-x-hidden overflow-y-auto">
        <header class="bg-white shadow-md">
          <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
              <h1 class="text-2xl font-bold text-gray-900">Payment History</h1>
              <div class="flex items-center space-x-2">
                <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                  <i class="fas fa-bell"></i>
                </button>
              </div>
            </div>
      </header>

        <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <div id="payment-history" class="mb-8">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-xl font-semibold text-gray-900">Payment History Table</h2>
              <div class="relative w-64">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                  <i class="fas fa-search text-gray-400"></i>
                </span>
                <input
                  type="text"
                  id="searchInput"
                  placeholder="Search payments..."
                  class="w-full pl-10 pr-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                  oninput="filterTable()"
                />
              </div>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
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
                    <?php

                    $sql_users = "SELECT users.user_id, users.first_name, users.middle_name , users.last_name , users.email_address FROM users WHERE users.role_id = '6' ORDER BY users.last_name ASC";
                    $run_users = mysqli_query($conn, $sql_users);

                    while ($row = mysqli_fetch_assoc($run_users)) {
                      $user_id = $row['user_id'];
                      $full_name = trim($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']);
                      $email = $row['email_address'];
                      ?>
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $full_name; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $email; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                          <a href="view-payment.php?user_id=<?php echo $user_id; ?>" class="text-teal-600 hover:text-teal-900">View</a>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex items-center justify-between">
                  <div id="paginationText" class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">5</span> results
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

              const dropdown = document.querySelector('[x-data]');
              if (dropdown) {
                const alpineInstance = dropdown.__x;
                if (alpineInstance) {
                  alpineInstance.$data.open = false;
                }
              }
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
          ],
          USER004: [
            { paymentId: 'PAY004', paymentFor: 'Monthly Dues', amount: '50', date: '2025-03-04', time: '01:20 PM', method: 'Bank Transfer', status: 'paid', address: 'Block 1, Lot 4', proofType: 'image', proofUrl: '/placeholder.svg?height=300&width=400', type: 'Non-Resident' }
          ],
          USER005: [
            { paymentId: 'PAY005', paymentFor: 'Monthly Dues', amount: '50', date: '2025-04-05', time: '03:10 PM', method: 'Bank Transfer', status: 'paid', address: 'Block 6, Lot 9', proofType: 'image', proofUrl: '/placeholder.svg?height=300&width=400', type: 'Resident' }
          ]
        };

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

        function renderPaymentTable(paymentsToRender) {
          const modalBody = document.getElementById('paymentHistoryBody');
          
          const tableContainer = document.createElement('div');
          tableContainer.innerHTML = `
            <table class="excel-table">
              <thead>
                <tr>
                  <th width="30">Select</th>
                  <th>Fee Name</th>
                  <th>Amount</th>
                  <th>Due Date</th>
                  <th>Status</th>
                  <th>Payment Method (GCash or Bank Transfer Only)</th>
                  <th>Reference Number</th>
                  <th>Uploaded Receipt</th>
                </tr>
              </thead>
              <tbody id="paymentTableBody">
              </tbody>
            </table>
          `;

          modalBody.innerHTML = '';
          modalBody.appendChild(tableContainer);

          const tbody = document.getElementById('paymentTableBody');
          
          tbody.innerHTML = '';
          
          paymentsToRender.forEach(payment => {
            const referenceNumber = `REF-${new Date(payment.date).getFullYear()}-${String(payment.paymentId.slice(-3)).padStart(4, '0')}`;
            
            tbody.innerHTML += `
              <tr data-payment-id="${payment.paymentId}">
                <td>
                  <input type="checkbox" id="checkbox-${payment.paymentId}" onchange="updateSelectedPayments()">
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
        }

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
            const matchesDay = !dayFilter || paymentDay === paymentDay.padStart(2, '0') && paymentDay === dayFilter.padStart(2, '0'); // Ensure day is two digits for comparison

            return matchesMonth && matchesYear && matchesDay;
          });
          
          renderPaymentTable(filtered); // Re-render with filtered data
          updateSelectedPaymentsCount(); // Re-evaluate selections after filtering
        };

        window.selectAllPayments = function() {
          const checkboxes = document.querySelectorAll('#paymentTableBody input[type="checkbox"]');
          checkboxes.forEach(checkbox => {
            checkbox.checked = true;
            const paymentId = checkbox.id.replace('checkbox-', '');
            selectedPaymentIds.add(paymentId);
          });
          updateSelectedPaymentsCount();
        };

        window.deselectAllPayments = function() {
          const checkboxes = document.querySelectorAll('#paymentTableBody input[type="checkbox"]');
          checkboxes.forEach(checkbox => {
            checkbox.checked = false;
            const paymentId = checkbox.id.replace('checkbox-', '');
            selectedPaymentIds.delete(paymentId);
          });
          updateSelectedPaymentsCount();
        };

        window.updateSelectedPayments = function() {
          const checkboxes = document.querySelectorAll('#paymentTableBody input[type="checkbox"]');
          selectedPaymentIds.clear();
          checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
              const paymentId = checkbox.id.replace('checkbox-', '');
              selectedPaymentIds.add(paymentId);
            }
          });
          updateSelectedPaymentsCount();
        };

        function updateSelectedPaymentsCount() {
          document.getElementById('selectedPaymentsCount').textContent = `${selectedPaymentIds.size} selected`;
        }

        window.closePaymentHistoryModal = function() {
          document.getElementById('paymentHistoryModal').classList.add('hidden');
          document.body.classList.remove('overflow-hidden');
        };

        window.viewProof = function(paymentId) {
          const payment = currentPayments.find(p => p.paymentId === paymentId);
          if (!payment || !payment.proofUrl) {
            alert('No proof available for this payment.');
            return;
          }

          const proofViewContent = document.getElementById('proofViewContent');
          proofViewContent.innerHTML = ''; // Clear previous content

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

        window.downloadPDF = function() {
          if (selectedPaymentIds.size === 0) {
            alert('Please select at least one payment to download.');
            return;
          }

          const paymentsToPrint = currentPayments.filter(payment => 
            selectedPaymentIds.has(payment.paymentId)
          );

          const { jsPDF } = window.jspdf;
          const doc = new jsPDF('landscape'); // Use landscape for wider table
          const modalUserName = document.getElementById('modal-user-name').textContent;

          if (paymentsToPrint.length === 0) {
            alert('No selected payments available to download.');
            return;
          }

          let yPosition = 20;
          
          doc.setFontSize(18);
          doc.text(modalUserName, 14, yPosition);
          yPosition += 20;

          // Process each payment with its receipt
          paymentsToPrint.forEach((payment, index) => {
            const referenceNumber = `REF-${new Date(payment.date).getFullYear()}-${String(payment.paymentId.slice(-3)).padStart(4, '0')}`;
            
            // Add payment details table
            const tableData = [[
              payment.paymentFor,
              `₱${payment.amount}`,
              payment.date,
              payment.status.charAt(0).toUpperCase() + payment.status.slice(1),
              payment.method,
              referenceNumber
            ]];

            doc.setFontSize(14);
            doc.text(`Payment ${index + 1}`, 14, yPosition);
            yPosition += 10;

            doc.autoTable({
              startY: yPosition,
              head: [['Fee Name', 'Amount', 'Due Date', 'Status', 'Payment Method', 'Reference Number']],
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

            yPosition = doc.lastAutoTable.finalY + 10;

            // Add receipt image if it's an image type
            if (payment.proofType === 'image' && payment.proofUrl) {
              try {
                doc.setFontSize(10);
                doc.text('Uploaded Receipt:', 14, yPosition);
                yPosition += 10;
                
                // Add image to PDF (note: this requires the image to be accessible)
                doc.addImage(payment.proofUrl, 'JPEG', 14, yPosition, 80, 60);
                yPosition += 70;
              } catch (error) {
                doc.text(`Receipt: Image file - ${referenceNumber}_receipt`, 14, yPosition);
                yPosition += 10;
              }
            } else {
              doc.setFontSize(10);
              doc.text(`Receipt: ${payment.proofType.toUpperCase()} file - ${referenceNumber}_receipt`, 14, yPosition);
              yPosition += 10;
            }

            yPosition += 10; // Space between payments

            // Add new page if needed
            if (yPosition > 180 && index < paymentsToPrint.length - 1) {
              doc.addPage();
              yPosition = 20;
            }
          });

          doc.save(`${modalUserName.replace(/ /g, '_')}_payment_history.pdf`);
        };

        window.printPaymentHistory = function() {
          if (selectedPaymentIds.size === 0) {
            alert('Please select at least one payment to print.');
            return;
          }

          const paymentsToPrint = currentPayments.filter(payment => 
            selectedPaymentIds.has(payment.paymentId)
          );

          const originalContent = document.body.innerHTML;

          if (paymentsToPrint.length === 0) {
            alert('No selected payments available to print.');
            return;
          }

          const tempDiv = document.createElement('div');
          tempDiv.innerHTML = `
            <h3 class="text-lg font-semibold text-gray-900 mb-4">${document.getElementById('modal-user-name').textContent}</h3>
            <div id="printContent">
            </div>
          `;
          
          const printContent = tempDiv.querySelector('#printContent');
          
          // Create payment entries with receipts
          paymentsToPrint.forEach((payment, index) => {
            const referenceNumber = `REF-${new Date(payment.date).getFullYear()}-${String(payment.paymentId.slice(-3)).padStart(4, '0')}`;
            
            const paymentSection = document.createElement('div');
            paymentSection.className = 'payment-section';
            paymentSection.style.cssText = 'margin-bottom: 30px; page-break-inside: avoid; border: 1px solid #d1d5db; padding: 15px; border-radius: 8px;';
            
            paymentSection.innerHTML = `
              <h4 style="font-size: 16px; font-weight: bold; margin-bottom: 15px; color: #1f2937;">Payment ${index + 1}</h4>
              <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                <tr>
                  <td style="border: 1px solid #d1d5db; padding: 8px; font-weight: bold; background-color: #f3f4f6; width: 25%;">Fee Name</td>
                  <td style="border: 1px solid #d1d5db; padding: 8px;">${payment.paymentFor}</td>
                  <td style="border: 1px solid #d1d5db; padding: 8px; font-weight: bold; background-color: #f3f4f6; width: 25%;">Amount</td>
                  <td style="border: 1px solid #d1d5db; padding: 8px;">₱${payment.amount}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #d1d5db; padding: 8px; font-weight: bold; background-color: #f3f4f6;">Due Date</td>
                  <td style="border: 1px solid #d1d5db; padding: 8px;">${payment.date}</td>
                  <td style="border: 1px solid #d1d5db; padding: 8px; font-weight: bold; background-color: #f3f4f6;">Status</td>
                  <td style="border: 1px solid #d1d5db; padding: 8px;">${payment.status.charAt(0).toUpperCase() + payment.status.slice(1)}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #d1d5db; padding: 8px; font-weight: bold; background-color: #f3f4f6;">Payment Method</td>
                  <td style="border: 1px solid #d1d5db; padding: 8px;">${payment.method}</td>
                  <td style="border: 1px solid #d1d5db; padding: 8px; font-weight: bold; background-color: #f3f4f6;">Reference Number</td>
                  <td style="border: 1px solid #d1d5db; padding: 8px;">${referenceNumber}</td>
                </tr>
              </table>
              <div style="margin-top: 15px;">
                <h5 style="font-size: 14px; font-weight: bold; margin-bottom: 10px; color: #374151;">Uploaded Receipt:</h5>
                <div style="text-align: center; border: 1px solid #d1d5db; padding: 10px; background-color: #f9fafb;">
                  ${payment.proofType === 'image' ? 
                    `<img src="${payment.proofUrl}" style="max-width: 300px; max-height: 400px; border: 1px solid #d1d5db;" alt="Payment Receipt">` :
                    `<p style="color: #6b7280; font-style: italic;">Receipt: ${payment.proofType.toUpperCase()} file - ${referenceNumber}_receipt</p>`
                  }
                </div>
              </div>
            `;
            
            printContent.appendChild(paymentSection);
          });

          document.body.innerHTML = `
            <div style="padding: 20px; font-family: Arial, sans-serif;">${tempDiv.innerHTML}</div>
            <style>
              @media print {
                body { background: white !important; }
                .payment-section { page-break-inside: avoid; }
                img { max-width: 100% !important; height: auto !important; }
              }
              body { background: white; color: black; }
            </style>
          `;
          window.print();
          document.body.innerHTML = originalContent; // Restore original content
        };

        window.filterTable = function() {
          const searchTerm = document.getElementById('searchInput').value.toLowerCase();
          const table = document.getElementById('paymentTable');
          const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
          let visibleRows = 0;

          for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let rowText = '';

            // Exclude the last cell (Actions) from search
            for (let j = 0; j < cells.length - 1; j++) {
              rowText += cells[j].textContent.toLowerCase() + ' ';
            }

            if (rowText.includes(searchTerm)) {
              rows[i].style.display = 'table-row';
              visibleRows++;
            } else {
              rows[i].style.display = 'none';
            }
          }

          updatePaginationText(visibleRows, rows.length);
        };

        window.updatePaginationText = function(visibleRows, totalRows) {
          const paginationText = document.getElementById('paginationText');
          paginationText.innerHTML = `Showing <span class="font-medium">1</span> to <span class="font-medium">${visibleRows}</span> of <span class="font-medium">${totalRows}</span> results`;
        };
      });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
  </div>
</body>
</html>

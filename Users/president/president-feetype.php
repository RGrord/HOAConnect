<?php
include('../../connection/connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - Fee Type (President)</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    /* Custom styles to match the reference modal design */
    .modal-content {
      background-color: white;
      border-radius: 8px;
      width: 100%;
      max-width: 550px;
      max-height: 80vh;
      overflow-y: auto;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px 20px;
      border-bottom: 1px solid #e5e7eb;
    }
    .modal-header h3 {
      font-size: 16px;
      font-weight: 600;
      color: #1f2937;
    }
    .modal-header button {
      color: #6b7280;
      font-size: 16px;
    }
    .modal-body {
      padding: 20px;
    }
    .modal-body label {
      font-size: 14px;
      font-weight: 500;
      color: #1f2937;
      margin-bottom: 4px;
      display: block;
    }
    .modal-body input,
    .modal-body textarea {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid #d1d5db;
      border-radius: 4px;
      font-size: 14px;
      color: #1f2937;
    }
    .modal-body input:focus,
    .modal-body textarea:focus {
      outline: none;
      border-color: #14b8a6;
      box-shadow: 0 0 0 2px rgba(20, 184, 166, 0.2);
    }
    .modal-body input[readonly],
    .modal-body textarea[readonly] {
      background-color: #f3f4f6;
      cursor: not-allowed;
    }
    .modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 8px;
      padding: 16px 20px;
      border-top: 1px solid #e5e7eb;
    }
    .modal-footer button {
      padding: 8px 16px;
      font-size: 14px;
      font-weight: 500;
      border-radius: 4px;
      transition: background-color 0.2s;
    }
    .modal-footer .cancel-btn {
      background-color: white;
      border: 1px solid #d1d5db;
      color: #374151;
    }
    .modal-footer .cancel-btn:hover {
      background-color: #f3f4f6;
    }
    .modal-footer .approve-btn {
      background-color: #14b8a6;
      border: none;
      color: white;
    }
    .modal-footer .approve-btn:hover {
      background-color: #0d9488;
    }
    .modal-footer .reject-btn {
      background-color: #dc2626;
      border: none;
      color: white;
    }
    .modal-footer .reject-btn:hover {
      background-color: #b91c1c;
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
        <a href="president-feetype.php" class="flex items-center px-6 py-3 bg-teal-700">
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
            <h1 class="text-2xl font-bold text-gray-900">Fee Type Management</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>

      <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Monthly Fee Type Section -->
        <div id="monthly-fee-type" class="mb-8">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-900">Monthly Fee Type</h2>
          </div>

          <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Fee Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Amount
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Status of Approval
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      START DATE
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <?php

                    $sql_fee_type = "SELECT * FROM fee_type";
                    $run_sql_fee_type = mysqli_query($conn, $sql_fee_type);

                    if(mysqli_num_rows($run_sql_fee_type) > 0){
                      foreach($run_sql_fee_type as $row_fee_type){
                        ?>
                          <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                              <?php echo $row_fee_type['fee_name']; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                              ₱<?php echo number_format($row_fee_type['amount'], 2); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                              <?php 
                                if($row_fee_type['approved'] == 1){
                                  echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>';
                                } elseif($row_fee_type['approved'] == 2){
                                  echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>';
                                } else {
                                  echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>';
                                }
                              ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                              <?php echo date('F d, Y', strtotime($row_fee_type['start_date'])); ?>
                            </td>
                            <td>
                              <?php 
                                if($row_fee_type['is_active'] == 1){
                                  echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>';
                                } else {
                                  echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>';
                                }
                              ?>
                            </td>
                            <td>
                              <a href="president-view-feetype.php?fee_type_id=<?php echo $row_fee_type['fee_type_id']; ?>">View</a>
                            </td>
                        <?php
                      }
                    }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- View Fee Modal -->
  <div id="viewFeeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="modal-content">
      <div class="modal-header">
        <h3>View Fee Details</h3>
        <button onclick="closeViewFeeModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="view-fee-form" class="space-y-4">
          <div>
            <label for="view-fee-name">Fee Name</label>
            <input type="text" id="view-fee-name" name="fee-name" readonly />
          </div>
          <div>
            <label for="view-fee-description">Description</label>
            <textarea id="view-fee-description" name="fee-description" rows="4" readonly></textarea>
          </div>
          <div>
            <label for="view-fee-amount">Amount (₱)</label>
            <input type="number" id="view-fee-amount" name="fee-amount" readonly />
          </div>
          <div>
            <label for="view-fee-start-date">Start Date</label>
            <input type="text" id="view-fee-start-date" name="fee-start-date" readonly />
          </div>
          <div>
            <label for="view-fee-secretary">Created By</label>
            <input type="text" id="view-fee-secretary" name="fee-secretary" readonly />
          </div>
          <div>
            <label for="view-fee-date-time">Date & Time</label>
            <input type="text" id="view-fee-date-time" name="fee-date-time" readonly />
          </div>
          <div>
            <label for="view-fee-status">Status</label>
            <input type="text" id="view-fee-status" name="fee-status" readonly />
          </div>
          <div>
            <label for="view-fee-notes">Note</label>
            <textarea id="view-fee-notes" name="fee-notes" rows="4" placeholder="Add notes if rejecting the fee..."></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer" id="view-fee-modal-footer">
        <button type="button" onclick="closeViewFeeModal()" class="cancel-btn">Cancel</button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let currentFeeId = null;

      // View Fee Modal
      window.openViewFeeModal = function(feeId, name, description, amount, status, timestamp, secretary, approvedBy, startDate) {
        currentFeeId = feeId;
        document.getElementById('view-fee-name').value = name;
        document.getElementById('view-fee-description').value = description;
        document.getElementById('view-fee-amount').value = amount;
        document.getElementById('view-fee-start-date').value = startDate;
        document.getElementById('view-fee-secretary').value = secretary;
        document.getElementById('view-fee-date-time').value = timestamp;
        document.getElementById('view-fee-status').value = status.charAt(0).toUpperCase() + status.slice(1);
        const notesTextarea = document.getElementById('view-fee-notes');
        notesTextarea.value = '';

        notesTextarea.removeAttribute('readonly');

        // Set modal footer buttons
        const modalFooter = document.getElementById('view-fee-modal-footer');
        if (status === 'pending') {
          modalFooter.innerHTML = `
            <button type="button" onclick="closeViewFeeModal()" class="cancel-btn">Cancel</button>
            <button type="button" onclick="rejectFee()" class="reject-btn">Reject</button>
            <button type="submit" form="view-fee-form" class="approve-btn">Approve</button>
          `;
        } else {
          modalFooter.innerHTML = `
            <button type="button" onclick="closeViewFeeModal()" class="cancel-btn">Cancel</button>
          `;
        }

        document.getElementById('viewFeeModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }

      window.closeViewFeeModal = function() {
        document.getElementById('viewFeeModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        currentFeeId = null;
      }

      // Approve Fee
      document.getElementById('view-fee-form').addEventListener('submit', function(e) {
        e.preventDefault();
        updateFee('active', 'Fee approved successfully!');
      });

      // Reject Fee
      window.rejectFee = function() {
        updateFee('inactive', 'Fee rejected successfully!');
      };

      // Shared function to update fee status
      function updateFee(newStatus, successMessage) {
        const name = document.getElementById('view-fee-name').value;
        const description = document.getElementById('view-fee-description').value;
        const amount = document.getElementById('view-fee-amount').value;
        const timestamp = document.getElementById('view-fee-date-time').value;
        const secretary = document.getElementById('view-fee-secretary').value;
        const startDate = document.getElementById('view-fee-start-date').value;
        const status = newStatus;
        const approvedBy = 'Kendall Jenner';
        const notes = document.getElementById('view-fee-notes').value;

        // Update the table row
        const row = document.querySelector(`tr[data-fee-id="${currentFeeId}"]`);
        if (row) {
          row.cells[0].querySelector('div').textContent = name;
          row.cells[1].querySelector('div').textContent = `₱${amount}`;
          row.cells[2].querySelector('div').textContent = startDate;
          const statusSpan = row.cells[3].querySelector('span');
          statusSpan.textContent = status.charAt(0).toUpperCase() + status.slice(1);
          statusSpan.className = `px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
            status === 'active' ? 'bg-green-100 text-green-800' :
            status === 'inactive' ? 'bg-red-100 text-red-800' :
            'bg-yellow-100 text-yellow-800'
          }`;
          
          // Create button element properly
          const actionCell = row.cells[4];
          actionCell.innerHTML = '';
          const button = document.createElement('button');
          button.className = 'bg-teal-600 text-white px-2 py-1 rounded hover:bg-teal-800';
          button.textContent = 'View';
          button.onclick = function() {
            openViewFeeModal(currentFeeId, name, description, amount, status, timestamp, secretary, approvedBy, startDate);
          };
          actionCell.appendChild(button);
        }

        alert(successMessage);
        closeViewFeeModal();
      }
    });
  </script>
</body>
</html>
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
  <title>HOAConnect - Fee Type</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    [x-cloak] {
      display: none !important;
    }
    /* Making both modals the same size */
    .modal-content {
      background-color: white;
      border-radius: 8px;
      width: 100%;
      max-width: 600px;
      max-height: 80vh;
      overflow-y: auto;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    /* Edit Fee Modal */
    .edit-modal-content {
      background-color: white;
      border-radius: 8px;
      width: 100%;
      max-width: 600px;
      max-height: 80vh;
      overflow-y: auto;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px 24px;
      border-bottom: 1px solid #e5e7eb;
    }
    .edit-modal-content .modal-header {
      padding: 16px 24px;
    }
    .modal-header h3 {
      font-size: 18px;
      font-weight: 600;
      color: #1f2937;
    }
    .modal-header button {
      color: #6b7280;
      font-size: 18px;
    }
    .modal-body {
      padding: 24px;
    }
    .edit-modal-content .modal-body {
      padding: 24px;
    }
    .modal-body label {
      font-size: 14px;
      font-weight: 500;
      color: #1f2937;
      margin-bottom: 4px;
      display: block;
    }
    .edit-modal-content .modal-body label {
      font-size: 14px;
    }
    .modal-body input,
    .modal-body textarea,
    .modal-body select {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid #d1d5db;
      border-radius: 4px;
      font-size: 14px;
      color: #1f2937;
    }
    .edit-modal-content .modal-body input,
    .edit-modal-content .modal-body textarea,
    .edit-modal-content .modal-body select {
      padding: 8px 12px;
      font-size: 14px;
    }
    .modal-body input:focus,
    .modal-body textarea:focus,
    .modal-body select:focus {
      outline: none;
      border-color: #14b8a6;
      box-shadow: 0 0 0 2px rgba(20, 184, 166, 0.2);
    }
    .modal-body input[readonly],
    .modal-body textarea[readonly],
    .modal-body select[disabled] {
      background-color: #f3f4f6;
      cursor: not-allowed;
    }
    .modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 8px;
      padding: 16px 24px;
      border-top: 1px solid #e5e7eb;
    }
    .edit-modal-content .modal-footer {
      padding: 16px 24px;
    }
    .modal-footer button {
      padding: 8px 16px;
      font-size: 14px;
      font-weight: 500;
      border-radius: 4px;
      transition: background-color 0.2s;
    }
    .edit-modal-content .modal-footer button {
      padding: 8px 16px;
      font-size: 14px;
    }
    .modal-footer .cancel-btn {
      background-color: white;
      border: 1px solid #d1d5db;
      color: #374151;
    }
    .modal-footer .cancel-btn:hover {
      background-color: #f3f4f6;
    }
    .modal-footer .save-btn {
      background-color: #14b8a6;
      border: none;
      color: white;
    }
    .modal-footer .save-btn:hover:not(:disabled) {
      background-color: #0d9488;
    }
    .modal-footer .save-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
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
        <a href="admin-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
          <i class="fas fa-tachometer-alt mr-3"></i>
          <span>Dashboard</span>
        </a>
        <a href="admin-accounts.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
          <i class="fas fa-users mr-3"></i>
          <span>User Management</span>
        </a>
        <!-- Payment Management Dropdown -->
        <div x-data="{ open: true }">
          <button @click="open = !open" :aria-expanded="open" class="flex items-center w-full px-6 py-3 hover:bg-teal-600 focus:outline-none">
            <i class="fas fa-credit-card mr-3"></i>
            <span class="flex-1 text-left">Payment Management</span>
            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="open" x-cloak class="bg-teal-800 text-sm">
            <a href="fee-types.php" class="flex items-center px-10 py-2 bg-teal-700">
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

<a href="admin-hoaprojects.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
  <i class="fas fa-gavel mr-3"></i>
        <span>Resolution</span>
</a>

<a href="admin-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
  <i class="fas fa-book mr-3"></i>
  <span>Ledger</span>
</a>

<a href="admin-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
  <i class="fas fa-newspaper mr-3"></i>
<span>News Feed</span>
</a>
        <a href="admin-messages.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
          <i class="fas fa-comments mr-3"></i>
          <span>Messages</span>
        </a>
        <a href="admin-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
          <i class="fas fa-calendar-alt mr-3"></i>
          <span>Calendar</span>
        </a>
        <a href="admin-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
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
            <h1 class="text-2xl font-bold text-gray-900">Payment Management</h1>
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
            <button onclick="openAddFeeModal()"
              class="bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-md flex items-center">
              <i class="fas fa-plus mr-2"></i> Add Fee
            </button>
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
                      Start Date
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
                    while($row_fee_type = mysqli_fetch_assoc($run_sql_fee_type)){
                      ?>
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                          <?php echo $row_fee_type['fee_name']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                          ₱ <?php echo number_format($row_fee_type['amount'], 2); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                          <?php 
                            if($row_fee_type['approved'] == 1){
                              echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>';
                            } elseif($row_fee_type['approved'] == 2){
                              echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>';
                            } elseif($row_fee_type['approved'] == 3){
                              echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>';
                            } else {
                              echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Unknown</span>';
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            
                          <?php

                            if($row_fee_type['approved'] == 3){
                              ?>
                              <a href="edit-fee-type.php?fee_type_id=<?php echo $row_fee_type['fee_type_id']; ?>" class="text-blue-600 hover:text-blue-800 mr-4">Edit</a>
                              <?php //pending
                            }elseif($row_fee_type['approved'] == 2){
                              ?>
                              <a href="reapprove-fee-type.php?fee_type_id=<?php echo $row_fee_type['fee_type_id']; ?>" class="text-blue-600 hover:text-blue-800 mr-4">Edit</a>
                              <?php //rejected
                            }else{
                              ?>
                              <a href="approve-fee-type.php?fee_type_id=<?php echo $row_fee_type['fee_type_id']; ?>" class="text-blue-600 hover:text-blue-800 mr-4">Edit</a>
                              <?php //approved
                            }

                          ?>
                         
                          
                        </td>
                      </tr>
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

  <!-- Add Fee Modal -->
  <div id="addFeeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="add-fee-title">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="add-fee-title">Add New Fee</h3>
        <button onclick="closeAddFeeModal()" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-fee-form" class="space-y-3" method="POST" action="../../Query/create-fee-type.php">
          <div>
            <label for="fee-name">Fee Name</label>
            <input type="text" id="fee-name" name="fee_name" required />
          </div>
          <div>
            <label for="fee-description">Description</label>
            <textarea id="fee-description" name="description" rows="3" maxlength="200" required></textarea>
          </div>
          <div>
            <label for="fee-amount">Amount (₱)</label>
            <input type="number" id="fee-amount" name="amount" min="1" step="1" required />
          </div>

          <div>
            <label for="fee-cadence">Cadence</label>
            <select name="cadence" id="fee-cadence">
              <option value="">Select cadence</option>
              <option value="1">Monthly</option>
              <option value="2">One-Time</option>
            </select>
          </div>

          <div>
            <label for="fee-start-date">Start Date</label>
            <input type="date" id="fee-start-date" name="start_date" required>
          </div>

          <div>
            <label for="">Active</label>
            <select name="active" id="">
              <option value="">Select</option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="closeAddFeeModal()" class="cancel-btn">Cancel</button>
        <button type="submit" name="create_fee_type" form="add-fee-form" class="save-btn">Save Fee</button>
      </div>
    </div>
  </div>

  <!-- Edit Fee Modal -->
    </div>
  </div>

<script>
   
    window.openAddFeeModal = function() {
      document.getElementById('add-fee-form').reset();
      
      document.getElementById('addFeeModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    };

    window.closeAddFeeModal = function() {
      document.getElementById('addFeeModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    };

        
    document.getElementById('fee-start-date').addEventListener('change', function() {
      const cadence = document.getElementById('fee-cadence').value;
      const selectedDate = new Date(this.value);

      if (cadence === '1' && selectedDate.getDate() !== 1) {
        alert('Please select the first day of the month only.');
        this.value = '';
      }
    });
    
</script>
</body>
</html>

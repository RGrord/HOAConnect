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
  <title>HOAConnect - Assignation of Monthly HOA Fee</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    /* Custom styles to match the reference modal design */
    .modal-content {
      background-color: white;
      border-radius: 8px;
      width: 100%;
      max-width: 600px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .modal-content.modal-scrollable {
      max-height: 90vh;
      overflow-y: auto;
    }
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px 24px;
      border-bottom: 1px solid #e5e7eb;
      position: sticky;
      top: 0;
      background-color: white;
      z-index: 10;
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
    .modal-body h4 {
      font-size: 16px;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 16px;
    }
    .modal-body .form-row {
      display: flex;
      gap: 16px;
      margin-bottom: 16px;
    }
    .modal-body .form-row > div {
      flex: 1;
    }
    .modal-body label {
      font-size: 14px;
      font-weight: 500;
      color: #1f2937;
      margin-bottom: 4px;
      display: block;
    }
    .modal-body input[type="checkbox"] + label {
      margin-left: 8px;
      font-size: 14px;
      color: #6b7280;
    }
    .modal-body input[type="checkbox"] {
      accent-color: #14b8a6;
    }
    .modal-body input[type="text"],
    .modal-body textarea,
    .modal-body select {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid #d1d5db;
      border-radius: 4px;
      font-size: 14px;
      color: #1f2937;
    }
    .modal-body input[type="text"]:focus,
    .modal-body textarea:focus,
    .modal-body select:focus {
      outline: none;
      border-color: #14b8a6;
      box-shadow: 0 0 0 2px rgba(20, 184, 166, 0.2);
    }
    .modal-body input[readonly],
    .modal-body textarea[readonly],
    .modal-body select[readonly] {
      background-color: #f3f4f6;
      cursor: not-allowed;
    }
    .modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 8px;
      padding: 16px 24px;
      border-top: 1px solid #e5e7eb;
      position: sticky;
      bottom: 0;
      background-color: white;
      z-index: 10;
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
    .modal-footer .save-btn, .modal-body .walk-in-btn, .modal-footer .submit-btn {
      background-color: #14b8a6;
      border: none;
      color: white;
    }
    .modal-footer .save-btn:hover, .modal-body .walk-in-btn:hover, .modal-footer .submit-btn:hover {
      background-color: #0d9488;
    }
    .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
    }
    .fee-card {
      border: 1px solid #e5e7eb;
      border-radius: 4px;
      padding: 16px;
      width: 100%;
      max-width: 250px;
      background-color: white;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .fee-card.selected {
      border-color: #14b8a6;
      background-color: #e6fffa;
    }
    .fee-card input[type="checkbox"] {
      margin-right: 8px;
    }
    #modal-year {
      max-height: 38px;
    }
    .modal-content {
      max-height: 80vh;
      overflow-y: auto;
    }
    #modal-day, #modal-year, #modal-month, #modal-week {
      max-height: 38px;
    }
    .modal-content select {
      overflow-y: auto;
    }
    #walkInPaymentModal .modal-content {
      max-height: 90vh;
      overflow-y: auto;
    }
    #walkInPaymentModal .modal-body {
      max-height: calc(90vh - 120px);
      overflow-y: auto;
    }
    #day-input {
      width: 100%;
      height: 38px;
      padding: 8px 12px;
      border: 1px solid #d1d5db;
      border-radius: 4px;
      font-size: 14px;
      color: #1f2937;
    }
    #day-input:focus {
      outline: none;
      border-color: #14b8a6;
      box-shadow: 0 0 0 2px rgba(20, 184, 166, 0.2);
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
            <a href="fee-types.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
              <i class="fas fa-tag mr-2" title="Fee Type"></i>
              Fee Type
            </a>
            <a href="fee-assignation.php" class="flex items-center px-10 py-2 bg-teal-700">
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

<a href="admin-projects.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
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
            <h1 class="text-2xl font-bold text-gray-900">Fee Assignation</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>
      <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Assignation of Monthly HOA Fee Section -->
          
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-900">Assignation of Monthly HOA Fee</h2>
            <div class="flex items-center space-x-4">
              <!-- Search Bar -->
              <div class="bg-white rounded-lg shadow flex">
                <input id="searchInput" type="text" placeholder="Search homeowners by name or email..." 
                  class="border rounded-l px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-teal-500">
                <button class="bg-teal-600 text-white px-4 py-2 rounded-r hover:bg-teal-700">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Unpaid Fees
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody id="homeownersTableBody" class="bg-white divide-y divide-gray-200">
                  <?php
                  $query_homeowners = "SELECT 
                      u.id, 
                      u.user_id,
                      u.email_address,
                      u.role_id,
                      u.status,
                      i.first_name,
                      i.middle_name,
                      i.last_name
                    FROM users u
                    LEFT JOIN user_info i 
                    On u.user_id = i.user_id
                    WHERE role_id ='6'";
                  $run_homeowners = mysqli_query($conn,$query_homeowners);

                  if(mysqli_num_rows($run_homeowners) > 0){
                        foreach($run_homeowners as $row_homeowners){
                          ?>
                        <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <?php echo $row_homeowners['first_name'] . " " . $row_homeowners['last_name']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <?php echo $row_homeowners['email_address']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <a href="admin-view-fee-assignation.php?user_id=<?php echo $row_homeowners['user_id']; ?>">View</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <?php

                          if($row_homeowners['status'] == 1){
                            echo "<span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800'>Active</span>";
                          } else {
                            echo "<span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800'>Inactive</span>";
                          }

                          ?>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          <a href="add-fee-assignation.php?user_id=<?php echo $row_homeowners['user_id']; ?>" class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700">
                            Edit
                        </td>
                      </tr>
                      <?php
                    }
                  }

                  ?>
                </tbody>
              </table>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
              <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
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
  <!-- Assign Fee Modal -->
  <div id="assignFeeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Assign Fee</h3>
        <button onclick="closeAssignFeeModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <h4>Select Fees to Assign</h4>
        <form id="assign-fee-form" class="space-y-6">
          <div class="space-y-2">
            <div class="flex items-center">
              <input type="checkbox" id="fee-FEE002" name="fees" value="FEE002"
                class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300 rounded" />
              <label for="fee-FEE002">
                Monthly Dues (₱50)
              </label>
            </div>
          </div>
          <div>
            <h4 class="mt-6">Selected Homeowners</h4>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      HOA ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Name
                    </th>
                  </tr>
                </thead>
                <tbody id="selected-homeowners-table" class="bg-white divide-y divide-gray-200">
                  <!-- Dynamically populated via JavaScript -->
                </tbody>
              </table>
            </div>
            <div class="mt-4 flex justify-center items-center space-x-2">
              <button type="button" id="prev-page-btn" onclick="changePage(-1)"
                class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                Prev
              </button>
              <span id="page-number" class="text-sm text-gray-700">1</span>
              <button type="button" id="next-page-btn" onclick="changePage(1)"
                class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                Next
              </button>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="closeAssignFeeModal()" class="cancel-btn">Cancel</button>
            <button type="submit" class="save-btn">Assign</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit Fee Assignment Modal -->
  <div id="editFeeAssignmentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Edit Fee Assignment</h3>
        <button onclick="closeEditFeeAssignmentModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <h4>Assign Fees to <span id="edit-user-name"></span></h4>
        <form id="edit-fee-assignment-form" class="space-y-4">
          <input type="hidden" id="edit-hoa-id" name="hoa-id" />
          <div class="space-y-4">
            <div class="bg-white p-4 border rounded-md shadow-sm">
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <input type="checkbox" id="edit-fee-monthly" name="fees" value="FEE-MONTHLY"
                    class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300 rounded mr-3" />
                  <label for="edit-fee-monthly" class="text-sm font-medium text-gray-900">
                    Monthly Dues (₱50)
                  </label>
                </div>
                <div class="flex space-x-2">
                  <select id="edit-fee-month" class="border border-gray-300 rounded-md px-2 py-1 text-sm">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                  <select id="edit-fee-year" class="border border-gray-300 rounded-md px-2 py-1 text-sm">
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="closeEditFeeAssignmentModal()" class="cancel-btn">Cancel</button>
            <button type="submit" class="save-btn">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Unpaid Fees Modal -->
  <div id="unpaidFeesModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="modal-content max-w-md">
      <div class="modal-header">
        <h3>Unpaid Fees</h3>
        <button onclick="closeUnpaidFeesModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-container" id="unpaid-fees-cards">
          <!-- Fee card example -->
          <div class="fee-card w-full max-w-full">
            <div class="flex items-center">
              <input type="checkbox" class="fee-checkbox focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300 rounded mr-3" data-fee-id="FEE003" />
              <div class="w-full">
                <div class="text-sm font-medium text-gray-900">Fee Name: Monthly Dues Fee - Month of April</div>
                <div class="text-sm text-gray-600">Description: Settle your payment!</div>
                <div class="text-sm text-gray-600">Amount: ₱50</div>
                <div class="text-sm text-gray-600">Due Date: April 30, 2025</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="closeUnpaidFeesModal()" class="cancel-btn">Close</button>
        <button type="button" onclick="openWalkInPaymentModal()" class="bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded">Walk-In Payment</button>
      </div>
    </div>
  </div>
  <!-- Walk In Payment Modal -->
  <div id="walkInPaymentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="modal-content max-w-md modal-scrollable">
      <div class="modal-header">
        <h3>Upload Proof of Payment</h3>
        <button onclick="closeWalkInPaymentModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-4 p-3 bg-gray-100 rounded-md">
          <h4 class="font-medium mb-2">Selected Fee</h4>
          <div id="selected-fee-details">
            <!-- Fee details will be populated dynamically -->
          </div>
        </div>
        <h4 class="font-medium mb-2">Proof of Payment</h4>
        <form id="walk-in-payment-form" class="space-y-3">
          <div>
            <label for="walk-in-full-name" class="text-sm font-medium">Full Name</label>
            <input type="text" id="walk-in-full-name" class="bg-gray-100" readonly />
          </div>
          <div>
            <label for="walk-in-amount" class="text-sm font-medium">Amount</label>
            <input type="text" id="walk-in-amount" class="bg-gray-100" readonly />
          </div>
          <div>
            <label for="walk-in-payment-method" class="text-sm font-medium">Payment Method</label>
            <select id="walk-in-payment-method" class="bg-gray-100" readonly>
              <option value="Cash">Cash</option>
              <option value="Bank Transfer">Bank Transfer</option>
              <option value="Check">Check</option>
            </select>
          </div>
          <div>
            <label for="walk-in-date" class="text-sm font-medium">Date</label>
            <input type="date" id="walk-in-date" class="bg-gray-100" readonly />
          </div>
          <div>
            <label for="walk-in-payment-receipt-name" class="text-sm font-medium">Payment Receipt Name</label>
            <input type="text" id="walk-in-payment-receipt-name" />
          </div>
          <div>
            <label for="walk-in-remarks" class="text-sm font-medium">Remarks (Optional)</label>
            <textarea id="walk-in-remarks" rows="2"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="closeWalkInPaymentModal()" class="cancel-btn">Cancel</button>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Homeowner data
      const homeownerData = [
        { hoaId: "HOA001", name: "Maria Santos", email: "maria.santos@example.com", status: "Active" },
        { hoaId: "HOA002", name: "Juan Cruz", email: "juan.cruz@example.com", status: "Active" },
        { hoaId: "HOA003", name: "Ana Reyes", email: "ana.reyes@example.com", status: "Inactive" }
      ];
      // Fee data for each homeowner
      const homeownerFees = [
        {
          hoaId: "HOA001",
          fees: [
            { feeId: "FEE001", name: "Monthly Dues Fee - Month of January", description: "Settle your payment!", amount: 50, datePaid: "2025-01-05", status: "Paid" },
            { feeId: "FEE002", name: "Monthly Dues Fee - Month of February", description: "Settle your payment!", amount: 50, datePaid: "2025-02-13", status: "Paid" },
            { feeId: "FEE003", name: "Monthly Dues Fee - Month of March", amount: 50, date: "2025-03-01", dueDate: "2025-03-15", status: "Unpaid", description: "Settle your monthly HOA fee" }
          ]
        },
        {
          hoaId: "HOA002",
          fees: [
            { feeId: "FEE001", name: "Monthly Dues Fee - Month of January", description: "Settle your payment!", amount: 50, datePaid: "2025-01-05", status: "Paid" },
            { feeId: "FEE002", name: "Monthly Dues Fee - Month of February", description: "Settle your payment!", amount: 50, datePaid: "2025-02-13", status: "Paid" },
            { feeId: "FEE003", name: "Monthly Dues Fee - Month of March", amount: 50, date: "2025-03-01", dueDate: "2025-03-15", status: "Unpaid", description: "Settle your monthly HOA fee" }
          ]
        },
        {
          hoaId: "HOA003",
          fees: [
            { feeId: "FEE001", name: "Monthly Dues Fee - Month of January", description: "Settle your payment!", amount: 50, datePaid: "2025-01-05", status: "Paid" },
            { feeId: "FEE002", name: "Monthly Dues Fee - Month of February", description: "Settle your payment!", amount: 50, datePaid: "2025-02-13", status: "Paid" },
            { feeId: "FEE003", name: "Monthly Dues Fee - Month of March", amount: 50, date: "2025-03-01", dueDate: "2025-03-15", status: "Unpaid", description: "Settle your monthly HOA fee" }
          ]
        }
      ];
      // Make sure the view buttons for unpaid fees work
      document.querySelectorAll('.view-fee-btn').forEach(button => {
        button.addEventListener('click', function() {
          const row = this.closest('tr');
          const hoaId = row.dataset.hoaId;
          const name = row.cells[1].textContent.trim();
          
          if (this.parentElement.cellIndex === 3) { // Unpaid fees column
            openUnpaidFeesModal(hoaId, name);
          }
        });
      });
      // Homeowners Fee: Select All and Individual Checkboxes
      const selectAllCheckbox = document.getElementById('select-all-homeowners');
      const homeownerCheckboxes = document.querySelectorAll('.homeowner-checkbox');
      const assignFeeBtn = document.getElementById('assign-fee-btn');
      let selectedHomeowners = [];
      let currentPage = 1;
      const itemsPerPage = 5;
      function updateButtonsState() {
        selectedHomeowners = Array.from(homeownerCheckboxes)
          .filter(checkbox => checkbox.checked)
          .map(checkbox => {
            const row = checkbox.closest('tr');
            return {
              hoaId: row.dataset.hoaId,
              name: row.cells[1].textContent.trim()
            };
          });
        assignFeeBtn.disabled = selectedHomeowners.length === 0;
      }
      selectAllCheckbox.addEventListener('change', function() {
        homeownerCheckboxes.forEach(checkbox => {
          const row = checkbox.closest('tr');
          const status = row.cells[4].querySelector('span').textContent.trim();
          if (status === 'Active') {
            checkbox.checked = selectAllCheckbox.checked;
          }
        });
        updateButtonsState();
      });
      homeownerCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
          const row = checkbox.closest('tr');
          const status = row.cells[4].querySelector('span').textContent.trim();
          if (status !== 'Active') {
            checkbox.checked = false;
          }
          updateButtonsState();
          selectAllCheckbox.checked = Array.from(homeownerCheckboxes).every(cb => {
            const cbRow = cb.closest('tr');
            const cbStatus = cbRow.cells[4].querySelector('span').textContent.trim();
            return cbStatus !== 'Active' || cb.checked;
          });
        });
      });
      // Search Functionality
      function filterHomeowners() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const filteredHomeowners = homeownerData.filter(homeowner => {
          return homeowner.name.toLowerCase().includes(searchTerm) ||
                 homeowner.email.toLowerCase().includes(searchTerm);
        });
        renderHomeownersTable(filteredHomeowners);
      }
      function renderHomeownersTable(homeowners) {
        const tbody = document.getElementById('homeownersTableBody');
        tbody.innerHTML = '';
        homeowners.forEach(homeowner => {
          const row = document.createElement('tr');
          row.dataset.hoaId = homeowner.hoaId;
          row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">
              <input type="checkbox" class="homeowner-checkbox focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300 rounded" />
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">${homeowner.name}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">${homeowner.email}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <button onclick="openUnpaidFeesModal('${homeowner.hoaId}', '${homeowner.name}')"
                class="view-fee-btn bg-teal-600 text-white px-2 py-1 rounded hover:bg-teal-800">
                View
              </button>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${homeowner.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                ${homeowner.status}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
              <button onclick="openEditFeeAssignmentModal('${homeowner.hoaId}', '${homeowner.name}')"
                class="edit-fee-btn bg-teal-600 text-white px-2 py-1 rounded hover:bg-teal-800">
                Edit
              </button>
            </td>
          `;
          tbody.appendChild(row);
        });
        // Reattach event listeners to new checkboxes
        const newCheckboxes = document.querySelectorAll('.homeowner-checkbox');
        newCheckboxes.forEach(checkbox => {
          checkbox.addEventListener('change', function() {
            const row = checkbox.closest('tr');
            const status = row.cells[4].querySelector('span').textContent.trim();
            if (status !== 'Active') {
              checkbox.checked = false;
            }
            updateButtonsState();
            selectAllCheckbox.checked = Array.from(newCheckboxes).every(cb => {
              const cbRow = cb.closest('tr');
              const cbStatus = cbRow.cells[4].querySelector('span').textContent.trim();
              return cbStatus !== 'Active' || cb.checked;
            });
          });
        });
        // Update edit buttons
        const newEditButtons = document.querySelectorAll('.edit-fee-btn');
        newEditButtons.forEach(button => {
          const row = button.closest('tr');
          const status = row.cells[4].querySelector('span').textContent.trim();
          if (status !== 'Active') {
            button.disabled = true;
            button.classList.add('opacity-50', 'cursor-not-allowed');
          }
        });
        updateButtonsState();
      }
      document.getElementById('searchInput').addEventListener('input', filterHomeowners);
      // Assign Fee Modal
      window.openAssignFeeModal = function() {
        updateSelectedHomeownersTable();
        document.getElementById('assignFeeModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }
      window.closeAssignFeeModal = function() {
        document.getElementById('assignFeeModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }
      function updateSelectedHomeownersTable() {
        const tbody = document.getElementById('selected-homeowners-table');
        tbody.innerHTML = '';
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const paginatedHomeowners = selectedHomeowners.slice(start, end);
        paginatedHomeowners.forEach(homeowner => {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${homeowner.hoaId}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${homeowner.name}</td>
          `;
          tbody.appendChild(row);
        });
        document.getElementById('page-number').textContent = currentPage;
        document.getElementById('prev-page-btn').disabled = currentPage === 1;
        document.getElementById('next-page-btn').disabled = end >= selectedHomeowners.length;
      }
      window.changePage = function(delta) {
        currentPage += delta;
        updateSelectedHomeownersTable();
      }
      document.getElementById('assign-fee-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const selectedFees = Array.from(document.querySelectorAll('#assign-fee-form input[name="fees"]:checked'))
          .map(input => input.value);
        if (selectedFees.length === 0) {
          alert('Please select at least one fee to assign.');
          return;
        }
        alert(`Assigned fees to ${selectedHomeowners.length} homeowners successfully!`);
        closeAssignFeeModal();
      });
      assignFeeBtn.addEventListener('click', openAssignFeeModal);
      // Edit Fee Assignment Modal
      window.openEditFeeAssignmentModal = function(hoaId, name) {
        document.getElementById('edit-hoa-id').value = hoaId;
        document.getElementById('edit-user-name').textContent = name;
        // Reset checkboxes
        document.querySelectorAll('#edit-fee-assignment-form input[name="fees"]').forEach(checkbox => {
          checkbox.checked = false;
        });
        document.getElementById('editFeeAssignmentModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }
      window.closeEditFeeAssignmentModal = function() {
        document.getElementById('editFeeAssignmentModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }
      document.getElementById('edit-fee-assignment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const hoaId = document.getElementById('edit-hoa-id').value;
        const selectedFees = Array.from(document.querySelectorAll('#edit-fee-assignment-form input[name="fees"]:checked'))
          .map(input => input.value);
        alert(`Updated fee assignments for homeowner ${hoaId} successfully!`);
        closeEditFeeAssignmentModal();
      });
      // Unpaid Fees Modal
      window.openUnpaidFeesModal = function(hoaId, name) {
        // Sample unpaid fee data - now with 2 fees
        const unpaidFees = [
          {
            feeId: "FEE003",
            name: "Monthly Dues Fee - Month of March",
            description: "Settle your payment!",
            amount: 50,
            dueDate: "March 31, 2025"
          },
          {
            feeId: "FEE004",
            name: "Monthly Dues Fee - Month of April",
            description: "Settle your payment!",
            amount: 50,
            dueDate: "April 30, 2025"
          }
        ];
        const container = document.getElementById('unpaid-fees-cards');
        container.innerHTML = '';
        // Add select all checkbox
        const selectAllDiv = document.createElement('div');
        selectAllDiv.className = 'mb-4';
        selectAllDiv.innerHTML = `
          <div class="flex items-center">
            <input type="checkbox" id="select-all-fees" class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300 rounded mr-3" />
            <label for="select-all-fees" class="text-sm font-medium text-gray-900">Select All</label>
          </div>
        `;
        container.appendChild(selectAllDiv);
        // Add fee cards
        unpaidFees.forEach(fee => {
          const card = document.createElement('div');
          card.className = 'fee-card w-full max-w-full mb-3';
          card.innerHTML = `
            <div class="flex items-center">
              <input type="checkbox" class="fee-checkbox focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300 rounded mr-3" 
                data-fee-id="${fee.feeId}" data-hoa-id="${hoaId}" data-name="${name}" 
                data-fee-name="${fee.name}" data-description="${fee.description}" 
                data-amount="${fee.amount}" data-due-date="${fee.dueDate}" />
              <div class="w-full">
                <div class="text-sm font-medium text-gray-900">Fee Name: ${fee.name}</div>
                <div class="text-sm text-gray-600">Description: ${fee.description}</div>
                <div class="text-sm text-gray-600">Amount: ₱${fee.amount}</div>
                <div class="text-sm text-gray-600">Due Date: ${fee.dueDate}</div>
              </div>
            </div>
          `;
          container.appendChild(card);
        });
        // Add event listener to select all checkbox
        const selectAllCheckbox = document.getElementById('select-all-fees');
        selectAllCheckbox.addEventListener('change', function() {
          const feeCheckboxes = document.querySelectorAll('.fee-checkbox');
          feeCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
            const card = checkbox.closest('.fee-card');
            card.classList.toggle('selected', checkbox.checked);
          });
        });
        // Add event listeners to fee checkboxes
        const feeCheckboxes = document.querySelectorAll('.fee-checkbox');
        feeCheckboxes.forEach(checkbox => {
          checkbox.addEventListener('change', function() {
            const card = checkbox.closest('.fee-card');
            card.classList.toggle('selected', checkbox.checked);
            // Update select all checkbox
            selectAllCheckbox.checked = Array.from(feeCheckboxes).every(cb => cb.checked);
          });
        });
        document.getElementById('unpaidFeesModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }
      window.closeUnpaidFeesModal = function() {
        document.getElementById('unpaidFeesModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }
      // Walk In Payment Modal
      window.openWalkInPaymentModal = function() {
        const selectedFees = document.querySelectorAll('.fee-checkbox:checked');
        if (selectedFees.length === 0) {
          alert('Please select at least one fee');
          return;
        }
        const firstFee = selectedFees[0];
        const name = firstFee.dataset.name;
        // Get the fee details from the selected checkboxes
        const selectedFeeDetails = document.getElementById('selected-fee-details');
        selectedFeeDetails.innerHTML = '';
        if (selectedFees.length === 1) {
          // Single fee selected
          const fee = selectedFees[0];
          selectedFeeDetails.innerHTML = `
            <div class="text-sm font-medium text-gray-900">Fee Name: ${fee.dataset.feeName}</div>
            <div class="text-sm text-gray-600">Description: ${fee.dataset.description}</div>
            <div class="text-sm text-gray-600">Amount: ₱${fee.dataset.amount}</div>
            <div class="text-sm text-gray-600">Due Date: ${fee.dataset.dueDate}</div>
          `;
        } else {
          // Multiple fees selected
          let totalAmount = 0;
          selectedFees.forEach(fee => {
            totalAmount += parseInt(fee.dataset.amount);
            selectedFeeDetails.innerHTML += `
              <div class="mb-2 pb-2 border-b border-gray-200">
                <div class="text-sm font-medium text-gray-900">Fee Name: ${fee.dataset.feeName}</div>
                <div class="text-sm text-gray-600">Amount: ₱${fee.dataset.amount}</div>
              </div>
            `;
          });
          selectedFeeDetails.innerHTML += `
            <div class="mt-2 pt-2 border-t border-gray-500">
              <div class="text-sm font-medium text-gray-900">Total Amount: ₱${totalAmount}</div>
            </div>
          `;
        }
        // Set form values (all read-only except remarks and payment receipt name)
        document.getElementById('walk-in-full-name').value = name;
        // Calculate total amount for multiple fees
        let totalAmount = 0;
        selectedFees.forEach(fee => {
          totalAmount += parseInt(fee.dataset.amount);
        });
        document.getElementById('walk-in-amount').value = `₱${totalAmount}`;
        document.getElementById('walk-in-date').value = new Date().toISOString().split('T')[0];
        document.getElementById('walk-in-payment-receipt-name').value = ''; // Editable field
        document.getElementById('walk-in-payment-method').value = 'Cash'; // Default value
        document.getElementById('walk-in-remarks').value = '';
        // Show the modal
        document.getElementById('walkInPaymentModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        // Close the unpaid fees modal
        closeUnpaidFeesModal();
      }
      window.closeWalkInPaymentModal = function() {
        document.getElementById('walkInPaymentModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }
      document.getElementById('walk-in-payment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        // Validate form
        const requiredFields = ['walk-in-full-name', 'walk-in-amount', 'walk-in-payment-method', 'walk-in-date', 'walk-in-payment-receipt-name'];
        let isValid = true;
        requiredFields.forEach(field => {
          if (!document.getElementById(field).value) {
            isValid = false;
          }
        });
        if (!isValid) {
          alert('Please fill in all required fields');
          return;
        }
        // Submit form
        alert('Payment proof submitted successfully!');
        closeWalkInPaymentModal();
      });
      // Dropdown toggle for Payment Management
      const paymentToggle = document.getElementById('payment-management-toggle');
      const paymentDropdown = document.getElementById('payment-management-dropdown');
      const paymentIcon = document.getElementById('payment-management-icon');
      // Initialize dropdown state
      paymentDropdown.classList.remove('hidden');
      paymentIcon.classList.remove('fa-chevron-down');
      paymentIcon.classList.add('fa-chevron-up');
      paymentToggle.addEventListener('click', function(e) {
        e.preventDefault();
        const isHidden = paymentDropdown.classList.contains('hidden');
        paymentDropdown.classList.toggle('hidden', !isHidden);
        paymentIcon.classList.toggle('fa-chevron-down', !isHidden);
        paymentIcon.classList.toggle('fa-chevron-up', isHidden);
        if (!isHidden) {
          paymentToggle.classList.remove('bg-teal-700');
        }
      });
      // Highlight the active page in the dropdown and handle clicks
      const currentPath = window.location.pathname.split('/').pop();
      const dropdownLinks = paymentDropdown.querySelectorAll('a');
      dropdownLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
          link.classList.add('bg-teal-700');
        }
      });
      // Add hover effect to Payment Management toggle
      paymentToggle.addEventListener('mouseenter', function() {
        if (!paymentToggle.classList.contains('bg-teal-700')) {
          paymentToggle.classList.add('bg-teal-700');
        }
      });
      paymentToggle.addEventListener('mouseleave', function() {
        if (paymentDropdown.classList.contains('hidden')) {
          paymentToggle.classList.remove('bg-teal-700');
        }
      });
      // Add hover and click effects to dropdown items
      dropdownLinks.forEach(link => {
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
            // Remove highlight from all dropdown items
            dropdownLinks.forEach(otherLink => {
              otherLink.classList.remove('bg-teal-700');
            });
            // Highlight the clicked item
            link.classList.add('bg-teal-700');
            // Ensure dropdown stays open
            paymentDropdown.classList.remove('hidden');
            paymentIcon.classList.remove('fa-chevron-down');
            paymentIcon.classList.add('fa-chevron-up');
            // Remove highlight from Payment Management toggle
            paymentToggle.classList.remove('bg-teal-700');
          }
        });
      });
    });
  </script>
</body>
</html>
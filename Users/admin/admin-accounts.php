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
  <title>HOAConnect - User Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    /* Ensure x-cloak hides elements until Alpine.js loads */
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
        <a href="admin-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
          <i class="fas fa-tachometer-alt mr-3"></i>
          <span>Dashboard</span>
        </a>
        <a href="admin-users.php" class="flex items-center px-6 py-3 bg-teal-700">
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
            <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>

      <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Action Buttons and Filters -->
        <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-4 sm:space-y-0">
          <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <button onclick="openAddHomeownerModal()"
              class="bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-md flex items-center justify-center">
              <i class="fas fa-user-plus mr-2"></i> Add Homeowners
            </button>
          </div>
          <div class="flex space-x-4">
            <div class="relative">
              <input type="text" id="searchInput" placeholder="Search users..."
                class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 w-full sm:w-64" />
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
              </div>
            </div>
            <div>
              <select id="statusFilter"
                class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                <option value="all">All</option>
                <option value="1">Active</option>
                <option value="2">Inactive</option>
              </select>
            </div>
          </div>
        </div>

        <!-- User List -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
          <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-medium text-gray-900">Registered Homeowners</h2>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <!-- Removed User ID column -->
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                  </th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                  </th>
                  <!-- Removed HOA Number column -->
                   <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                  </th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody id="userTableBody" class="bg-white divide-y divide-gray-200">
                <!-- Users will be rendered dynamically -->

                <?php

                $sql_users = "SELECT * FROM users WHERE role_id = 6";
                $run_sql_users = mysqli_query($conn, $sql_users);
                foreach($run_sql_users as $row_users){
                  ?>

                  <tr>
                  
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    <?php echo $row_users['first_name'] . ' ' . $row_users['middle_name'] . ' ' . $row_users['last_name'] . ' ' . $row_users['suffix']; ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    <?php echo $row_users['email_address']; ?>
                  </td>

                  <td>
                    <?php 
                      if($row_users['account_status'] == 1){
                        echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>';
                      }else{
                        echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-red-800">Inactive</span>';
                      }
                    ?>
                  </td>
                  
                
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="admin-edit-accounts.php?user_id=<?php echo $row_users['user_id']; ?>"
                      class="text-teal-600 hover:text-teal-900 mr-4">Edit</a>
                    <!-- <a href="../../Query/delete-account.php?user_id=<?php echo $row_users['user_id']; ?>&role_id=<?php echo $row_users['role_id']; ?>"
                      class="text-red-600 hover:text-red-900"
                      onclick="return confirm('Are you sure you want to delete this account?');">Delete</a> -->
                  </td>


                <?php
               }
               ?> 


              </tbody>
            </table>
          </div>
          <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex items-center justify-between">
              <div class="text-sm text-gray-700">
                Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span
                  class="font-medium">156</span> results
              </div>
              <div class="flex space-x-2">
                <button
                  class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                  Previous
                </button>
                <button
                  class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                  Next
                </button>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Add Homeowner Modal -->
  <div id="addHomeownerModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-y-auto">
      <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
        <h3 class="text-lg font-medium text-gray-900">Add Homeowners</h3>
        <button onclick="closeAddHomeownerModal()" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-6">
        <div class="mb-6">
          <div class="flex space-x-4 mb-6">
            <button id="singleUserBtn" onclick="showSingleUserForm()"
              class="flex-1 py-2 px-4 bg-teal-600 text-white rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
              Single Account
            </button>
            <button id="bulkUploadBtn" onclick="showBulkUploadForm()"
              class="flex-1 py-2 px-4 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
              Bulk Upload
            </button>
          </div>

          <!-- Single User Form -->
          <form id="singleUserForm" method="POST" action="../../Query/create-account.php" class="space-y-6" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" id="firstName" name="first_name"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
                <!-- Added validation error message for first name -->
                <div id="firstNameError" class="text-red-500 text-sm mt-1 hidden">First name should only contain letters and spaces</div>
              </div>
              <div>
                <label for="middleName" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input type="text" id="middleName" name="middle_name"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
                <!-- Added validation error message for middle name -->
                <div id="middleNameError" class="text-red-500 text-sm mt-1 hidden">Middle name should only contain letters and spaces</div>
              </div>
              <div>
                <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" id="lastName" name="last_name"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
                <!-- Added validation error message for last name -->
                <div id="lastNameError" class="text-red-500 text-sm mt-1 hidden">Last name should only contain letters and spaces</div>
              </div>
              <div>
                <label for="nameSuffix" class="block text-sm font-medium text-gray-700">Name Suffix</label>
                <input type="text" id="nameSuffix" name="name_suffix"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
                <!-- Added validation error message for name suffix -->
                <div id="nameSuffixError" class="text-red-500 text-sm mt-1 hidden">Name suffix should only contain letters and spaces</div>
              </div>
              <div>
                <label for="hoaNumber" class="block text-sm font-medium text-gray-700">HOA Number</label>
                <input type="text" id="hoaNumber" name="hoa_number"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              </div>
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              </div>
              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="+639XXXXXXXXX"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
                <!-- Added validation error message for phone -->
                <div id="phoneError" class="text-red-500 text-sm mt-1 hidden">Phone number must start with +639 and be 13 digits long</div>
              </div>
              <div>
                <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                <input type="number" id="age" name="age" min="1" max="120"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
                <!-- Added validation error message for age -->
                <div id="ageError" class="text-red-500 text-sm mt-1 hidden">Age must be a number between 1 and 120</div>
              </div>
              <div>
                <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" id="dob" name="date_of_birth"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              </div>
              <div>
                <label for="citizenship" class="block text-sm font-medium text-gray-700">Citizenship</label>
                <input type="text" id="citizenship" name="citizenship"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              </div>
              <div>
                <label for="civilStatus" class="block text-sm font-medium text-gray-700">Civil Status</label>
                <select id="civilStatus" name="civil_status"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                  <option value="">Select status</option>
                  <option value="single">Single</option>
                  <option value="married">Married</option>
                  <option value="divorced">Divorced</option>
                  <option value="widowed">Widowed</option>
                </select>
              </div>

              <div>
                <label for="civilStatus" class="block text-sm font-medium text-gray-700">Account Status</label>
                <select id="civilStatus" name="account_status"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                  <option value="">Select status</option>
                  <option value="1">Active</option>
                  <option value="2">Inactive</option>
                </select>
              </div>
            </div>

            <div class="mt-6">
              <h4 class="text-sm font-medium text-gray-700 mb-2">Home Address</h4>
              <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                  <label for="lotNumber" class="block text-sm font-medium text-gray-700">Lot #</label>
                  <input type="text" id="lotNumber" name="lot_number"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
                </div>
                <div>
                  <label for="blockNumber" class="block text-sm font-medium text-gray-700">Block #</label>
                  <input type="text" id="blockNumber" name="block_number"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
                </div>
                <div>
                  <label for="phaseNumber" class="block text-sm font-medium text-gray-700">Phase #</label>
                  <select id="phaseNumber" name="phase_number"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    <option value="">Select phase</option>
                    <option value="1">Phase 1</option>
                    <option value="2">Phase 2</option>
                    <option value="4">Phase 4</option>
                  </select>
                </div>
                <div>
                  <label for="villageName" class="block text-sm font-medium text-gray-700">Village Name</label>
                  <input type="text" id="villageName" name="village_name" value="Mabuhay Homes 2000"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
                </div>
              </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
              <button type="button" onclick="closeAddHomeownerModal()"
                class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                Cancel
              </button>
              <button type="submit" name="create_account_admin" id="create-submit-btn"
                class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                Save
              </button>
            </div>
          </form>

          <!-- Bulk Upload Form -->
          <div id="bulkUploadForm" class="hidden">
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
              <div class="mb-4">
                <i class="fas fa-file-excel text-gray-400 text-5xl"></i>
              </div>
              <p class="text-sm text-gray-500 mb-4">
                Upload an Excel file with homeowner information. The file should include columns for all required fields.
              </p>
              <div class="flex justify-center">
                <label for="fileUpload"
                  class="cursor-pointer bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-md inline-flex items-center">
                  <i class="fas fa-upload mr-2"></i>
                  <span>Choose Excel File</span>
                  <input id="fileUpload" type="file" accept=".xlsx,.xls" class="hidden" />
                </label>
              </div>
              <p class="mt-2 text-xs text-gray-500">
                Maximum file size: 5MB. Supported formats: .xlsx, .xls
              </p>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
              <button type="button" onclick="closeAddHomeownerModal()"
                class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                Cancel
              </button>
              <button type="submit"
                class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                Upload
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Homeowner Modal -->
  <div id="editHomeownerModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-y-auto">
      <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
        <h3 class="text-lg font-medium text-gray-900">Edit Homeowner</h3>
        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-6">
        <form id="editUserForm">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="editFirstName" class="block text-sm font-medium text-gray-700">First Name</label>
              <input type="text" id="editFirstName" name="firstName"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              <!-- Added validation error message for edit first name -->
              <div id="editFirstNameError" class="text-red-500 text-sm mt-1 hidden">First name should only contain letters and spaces</div>
            </div>
            <div>
              <label for="editMiddleName" class="block text-sm font-medium text-gray-700">Middle Name</label>
              <input type="text" id="editMiddleName" name="middleName"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              <!-- Added validation error message for edit middle name -->
              <div id="editMiddleNameError" class="text-red-500 text-sm mt-1 hidden">Middle name should only contain letters and spaces</div>
            </div>
            <div>
              <label for="editLastName" class="block text-sm font-medium text-gray-700">Last Name</label>
              <input type="text" id="editLastName" name="lastName"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              <!-- Added validation error message for edit last name -->
              <div id="editLastNameError" class="text-red-500 text-sm mt-1 hidden">Last name should only contain letters and spaces</div>
            </div>
            <div>
              <label for="editNameSuffix" class="block text-sm font-medium text-gray-700">Name Suffix</label>
              <input type="text" id="editNameSuffix" name="nameSuffix"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              <!-- Added validation error message for edit name suffix -->
              <div id="editNameSuffixError" class="text-red-500 text-sm mt-1 hidden">Name suffix should only contain letters and spaces</div>
            </div>
            <div>
              <label for="editHoaNumber" class="block text-sm font-medium text-gray-700">HOA Number</label>
              <input type="text" id="editHoaNumber" name="hoaNumber"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="editEmail" class="block text-sm font-medium text-gray-700">Email Address</label>
              <input type="email" id="editEmail" name="email"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="editPhone" class="block text-sm font-medium text-gray-700">Phone Number</label>
              <input type="tel" id="editPhone" name="phone" placeholder="+639XXXXXXXXX"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              <!-- Added validation error message for phone -->
              <div id="editPhoneError" class="text-red-500 text-sm mt-1 hidden">Phone number must start with +639 and be 13 digits long</div>
            </div>
            <div>
              <label for="editAge" class="block text-sm font-medium text-gray-700">Age</label>
              <input type="number" id="editAge" name="age" min="1" max="120"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              <!-- Added validation error message for age -->
              <div id="editAgeError" class="text-red-500 text-sm mt-1 hidden">Age must be a number between 1 and 120</div>
            </div>
            <div>
              <label for="editDob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
              <input type="date" id="editDob" name="dob"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="editCitizenship" class="block text-sm font-medium text-gray-700">Citizenship</label>
              <input type="text" id="editCitizenship" name="citizenship"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="editCivilStatus" class="block text-sm font-medium text-gray-700">Civil Status</label>
              <select id="editCivilStatus" name="civilStatus"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                <option value="">Select status</option>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="divorced">Divorced</option>
                <option value="widowed">Widowed</option>
              </select>
            </div>
            <div>
              <label for="editStatus" class="block text-sm font-medium text-gray-700">Status</label>
              <select id="editStatus" name="status"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
          </div>
          <div class="mt-6">
            <h4 class="text-sm font-medium text-gray-700 mb-2">Home Address</h4>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
              <div>
                <label for="editLotNumber" class="block text-sm font-medium text-gray-700">Lot #</label>
                <input type="text" id="editLotNumber" name="lotNumber"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              </div>
              <div>
                <label for="editBlockNumber" class="block text-sm font-medium text-gray-700">Block #</label>
                <input type="text" id="editBlockNumber" name="blockNumber"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              </div>
              <div>
                <label for="editPhaseNumber" class="block text-sm font-medium text-gray-700">Phase #</label>
                <select id="editPhaseNumber" name="phaseNumber"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                  <option value="">Select phase</option>
                  <option value="1">Phase 1</option>
                  <option value="2">Phase 2</option>
                  <option value="4">Phase 4</option>
                </select>
              </div>
              <div>
                <label for="editVillageName" class="block text-sm font-medium text-gray-700">Village Name</label>
                <input type="text" id="editVillageName" name="villageName" value="Mabuhay Homes 2000"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
              </div>
            </div>
          </div>
          <div class="flex justify-end space-x-3 mt-6">
            <button type="button" onclick="closeEditModal()"
              class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
              Cancel
            </button>
            <button type="submit"
              class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
              Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    
    // Initialize page
    document.addEventListener('DOMContentLoaded', function () {
      const phoneInput = document.getElementById('phone');
      const ageInput = document.getElementById('age');
      
      const editPhoneInput = document.getElementById('editPhone');
      const editAgeInput = document.getElementById('editAge');
      
      const nameFields = ['firstName', 'middleName', 'lastName', 'nameSuffix'];
      const editNameFields = ['editFirstName', 'editMiddleName', 'editLastName', 'editNameSuffix'];
      const nameRegex = /^[a-zA-Z\s]*$/;
      
      [...nameFields, ...editNameFields].forEach(fieldId => {
        const input = document.getElementById(fieldId);
        const errorId = fieldId.includes('edit') ? fieldId + 'Error' : fieldId + 'Error';
        
        // Prevent typing numbers and special characters in name fields
        input.addEventListener('keypress', function(e) {
          const char = String.fromCharCode(e.which);
          if (!/[a-zA-Z\s]/.test(char)) {
            e.preventDefault();
          }
        });
        
        // Also handle paste events
        input.addEventListener('paste', function(e) {
          e.preventDefault();
          const paste = (e.clipboardData || window.clipboardData).getData('text');
          const filtered = paste.replace(/[^a-zA-Z\s]/g, '');
          this.value = filtered;
        });
        
        input.addEventListener('input', function() {
          const error = document.getElementById(errorId);
          
          if (this.value && !nameRegex.test(this.value)) {
            error.classList.remove('hidden');
          } else {
            error.classList.add('hidden');
          }
        });
      });
      
      [phoneInput, editPhoneInput].forEach(input => {
        input.addEventListener('keypress', function(e) {
          const char = String.fromCharCode(e.which);
          const currentValue = this.value;
          
          // Allow backspace, delete, tab, escape, enter
          if ([8, 9, 27, 13, 46].indexOf(e.keyCode) !== -1 ||
              // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
              (e.keyCode === 65 && e.ctrlKey === true) ||
              (e.keyCode === 67 && e.ctrlKey === true) ||
              (e.keyCode === 86 && e.ctrlKey === true) ||
              (e.keyCode === 88 && e.ctrlKey === true)) {
            return;
          }
          
          // Only allow + at the beginning
          if (char === '+' && currentValue.length === 0) {
            return;
          }
          
          // Only allow numbers after +639
          if (!/[0-9]/.test(char)) {
            e.preventDefault();
            return;
          }
          
          // Ensure it starts with +639
          if (currentValue.length === 0) {
            e.preventDefault();
            this.value = '+639';
            return;
          }
          
          // Limit to 13 characters total (+639xxxxxxxxx)
          if (currentValue.length >= 13) {
            e.preventDefault();
          }
        });
        
        // Handle paste for phone input
        input.addEventListener('paste', function(e) {
          e.preventDefault();
          const paste = (e.clipboardData || window.clipboardData).getData('text');
          const filtered = paste.replace(/[^0-9+]/g, '');
          if (filtered.startsWith('+639') && filtered.length <= 13) {
            this.value = filtered;
          }
        });
      });
      
      [ageInput, editAgeInput].forEach(input => {
        input.addEventListener('keypress', function(e) {
          const char = String.fromCharCode(e.which);
          
          // Allow backspace, delete, tab, escape, enter
          if ([8, 9, 27, 13, 46].indexOf(e.keyCode) !== -1 ||
              // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
              (e.keyCode === 65 && e.ctrlKey === true) ||
              (e.keyCode === 67 && e.ctrlKey === true) ||
              (e.keyCode === 86 && e.ctrlKey === true) ||
              (e.keyCode === 88 && e.ctrlKey === true)) {
            return;
          }
          
          // Only allow numbers
          if (!/[0-9]/.test(char)) {
            e.preventDefault();
          }
        });
        
        // Handle paste for age input
        input.addEventListener('paste', function(e) {
          e.preventDefault();
          const paste = (e.clipboardData || window.clipboardData).getData('text');
          const filtered = paste.replace(/[^0-9]/g, '');
          const num = parseInt(filtered);
          if (!isNaN(num) && num >= 1 && num <= 120) {
            this.value = filtered;
          }
        });
      });

      // // Handle Single User Form submission
      // const singleUserForm = document.getElementById('singleUserForm');
      // singleUserForm.addEventListener('submit', function (e) {
      //   e.preventDefault();
        
      //   if (!validateForm()) {
      //     return;
      //   }
        
      //   const maxId = Math.max(...users.map(u => u.id), 0);
      //   const newUser = {
      //     id: maxId + 1,
      //     firstName: document.getElementById('firstName').value,
      //     middleName: document.getElementById('middleName').value,
      //     lastName: document.getElementById('lastName').value,
      //     nameSuffix: document.getElementById('nameSuffix').value,
      //     hoaNumber: document.getElementById('hoaNumber').value,
      //     email: document.getElementById('email').value,
      //     phone: document.getElementById('phone').value,
      //     age: parseInt(document.getElementById('age').value),
      //     dob: document.getElementById('dob').value,
      //     citizenship: document.getElementById('citizenship').value,
      //     civilStatus: document.getElementById('civilStatus').value,
      //     lotNumber: document.getElementById('lotNumber').value,
      //     blockNumber: document.getElementById('blockNumber').value,
      //     phaseNumber: document.getElementById('phaseNumber').value,
      //     villageName: document.getElementById('villageName').value,
      //     status: 'active'
      //   };
      //   users.unshift(newUser); // Add to beginning of array
      //   closeAddHomeownerModal();
      //   singleUserForm.reset();
      //   updateUserTable();
      //   alert('Homeowner added successfully!');
      // });

      // Handle Edit User Form submission
      const editUserForm = document.getElementById('editUserForm');
      editUserForm.addEventListener('submit', function (e) {
        e.preventDefault();
        
        if (!validateEditForm()) {
          return;
        }
        
        const userId = parseInt(editUserForm.dataset.userId);
        const userIndex = users.findIndex(u => u.id === userId);
        if (userIndex !== -1) {
          users[userIndex] = {
            ...users[userIndex],
            firstName: document.getElementById('editFirstName').value,
            middleName: document.getElementById('editMiddleName').value,
            lastName: document.getElementById('editLastName').value,
            nameSuffix: document.getElementById('editNameSuffix').value,
            hoaNumber: document.getElementById('editHoaNumber').value,
            email: document.getElementById('editEmail').value,
            phone: document.getElementById('editPhone').value,
            age: parseInt(document.getElementById('editAge').value),
            dob: document.getElementById('editDob').value,
            citizenship: document.getElementById('editCitizenship').value,
            civilStatus: document.getElementById('editCivilStatus').value,
            lotNumber: document.getElementById('editLotNumber').value,
            blockNumber: document.getElementById('editBlockNumber').value,
            phaseNumber: document.getElementById('editPhaseNumber').value,
            villageName: document.getElementById('editVillageName').value,
            status: document.getElementById('editStatus').value
          };
          closeEditModal();
          updateUserTable();
          alert('Homeowner updated successfully!');
        }
      });

      // Search and Filter
      const searchInput = document.getElementById('searchInput');
      const statusFilter = document.getElementById('statusFilter');
      searchInput.addEventListener('input', filterUsers);
      statusFilter.addEventListener('change', filterUsers);

      function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const status = statusFilter.value;
        const filteredUsers = users.filter(user => {
          const fullName = `${user.firstName} ${user.lastName}`.toLowerCase();
          const matchesSearch = fullName.includes(searchTerm) || user.email.toLowerCase().includes(searchTerm) || user.hoaNumber.toLowerCase().includes(searchTerm);
          const matchesStatus = status === 'all' || user.status === status;
          return matchesSearch && matchesStatus;
        });
        updateUserTable(filteredUsers);
      }

      // Update user table
      function updateUserTable(filteredUsers = users) {
        const tbody = document.getElementById('userTableBody');
        tbody.innerHTML = '';
        // Sort users by id in descending order
        const sortedUsers = [...filteredUsers].sort((a, b) => b.id - a.id);
        sortedUsers.forEach(user => {
          const row = document.createElement('tr');
          row.setAttribute('data-id', user.id);
          row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">${user.firstName} ${user.lastName}${user.nameSuffix ? ' ' + user.nameSuffix : ''}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">${user.email}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">${user.status.charAt(0).toUpperCase() + user.status.slice(1)}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="openEditModal(${user.id})" class="bg-teal-600 text-white px-2 py-1 rounded hover:bg-teal-800">
                Edit
              </button>
            </td>
          `;
          tbody.appendChild(row);
        });
      }

      // Initial render
      updateUserTable();
    });

    function openAddHomeownerModal() {
      document.getElementById('addHomeownerModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
      showSingleUserForm();
    }

    function closeAddHomeownerModal() {
      document.getElementById('addHomeownerModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    function showSingleUserForm() {
      document.getElementById('singleUserForm').classList.remove('hidden');
      document.getElementById('bulkUploadForm').classList.add('hidden');
      document.getElementById('singleUserBtn').classList.remove('bg-gray-200', 'text-gray-700');
      document.getElementById('singleUserBtn').classList.add('bg-teal-600', 'text-white');
      document.getElementById('bulkUploadBtn').classList.remove('bg-teal-600', 'text-white');
      document.getElementById('bulkUploadBtn').classList.add('bg-gray-200', 'text-gray-700');
    }

    function showBulkUploadForm() {
      document.getElementById('singleUserForm').classList.add('hidden');
      document.getElementById('bulkUploadForm').classList.remove('hidden');
      document.getElementById('singleUserBtn').classList.remove('bg-teal-600', 'text-white');
      document.getElementById('singleUserBtn').classList.add('bg-gray-200', 'text-gray-700');
      document.getElementById('bulkUploadBtn').classList.remove('bg-gray-200', 'text-gray-700');
      document.getElementById('bulkUploadBtn').classList.add('bg-teal-600', 'text-white');
    }


    function closeEditModal() {
      document.getElementById('editHomeownerModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    function validateForm() {
      let isValid = true;
      
      // Validate name fields
      const nameFields = [
        { id: 'firstName', errorId: 'firstNameError' },
        { id: 'middleName', errorId: 'middleNameError' },
        { id: 'lastName', errorId: 'lastNameError' },
        { id: 'nameSuffix', errorId: 'nameSuffixError' }
      ];
      
      const nameRegex = /^[a-zA-Z\s]*$/;
      
      nameFields.forEach(field => {
        const input = document.getElementById(field.id);
        const error = document.getElementById(field.errorId);
        
        if (input.value && !nameRegex.test(input.value)) {
          error.classList.remove('hidden');
          isValid = false;
        } else {
          error.classList.add('hidden');
        }
      });
      
      // Validate phone number
      const phone = document.getElementById('phone').value;
      const phoneError = document.getElementById('phoneError');
      const phoneRegex = /^\+639\d{9}$/;
      
      if (!phoneRegex.test(phone)) {
        phoneError.classList.remove('hidden');
        isValid = false;
      } else {
        phoneError.classList.add('hidden');
      }
      
      // Validate age
      const age = document.getElementById('age').value;
      const ageError = document.getElementById('ageError');
      const ageNum = parseInt(age);
      
      if (!age || isNaN(ageNum) || ageNum < 1 || ageNum > 120) {
        ageError.classList.remove('hidden');
        isValid = false;
      } else {
        ageError.classList.add('hidden');
      }
      
      return isValid;
    }

    function validateEditForm() {
      let isValid = true;
      
      // Validate name fields
      const nameFields = [
        { id: 'editFirstName', errorId: 'editFirstNameError' },
        { id: 'editMiddleName', errorId: 'editMiddleNameError' },
        { id: 'editLastName', errorId: 'editLastNameError' },
        { id: 'editNameSuffix', errorId: 'editNameSuffixError' }
      ];
      
      const nameRegex = /^[a-zA-Z\s]*$/;
      
      nameFields.forEach(field => {
        const input = document.getElementById(field.id);
        const error = document.getElementById(field.errorId);
        
        if (input.value && !nameRegex.test(input.value)) {
          error.classList.remove('hidden');
          isValid = false;
        } else {
          error.classList.add('hidden');
        }
      });
      
      // Validate phone number
      const phone = document.getElementById('editPhone').value;
      const phoneError = document.getElementById('editPhoneError');
      const phoneRegex = /^\+639\d{9}$/;
      
      if (!phoneRegex.test(phone)) {
        phoneError.classList.remove('hidden');
        isValid = false;
      } else {
        phoneError.classList.add('hidden');
      }
      
      // Validate age
      const age = document.getElementById('editAge').value;
      const ageError = document.getElementById('editAgeError');
      const ageNum = parseInt(age);
      
      if (!age || isNaN(ageNum) || ageNum < 1 || ageNum > 120) {
        ageError.classList.remove('hidden');
        isValid = false;
      } else {
        ageError.classList.add('hidden');
      }
      
      return isValid;
    }
  </script>
</body>
</html>

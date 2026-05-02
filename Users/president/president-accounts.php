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
  <title>HOAConnect - Admin Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    .view-card {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 24px;
      max-width: 500px;
      width: 100%;
    }
    .view-card .info-item {
      display: flex;
      align-items: center;
      margin-bottom: 16px;
    }
    .view-card .info-item i {
      width: 24px;
      color: #6b7280;
      margin-right: 12px;
    }
    .view-card .info-item span {
      color: #1f2937;
      font-size: 14px;
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

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Header -->
      <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Admin Management</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>
      <!-- Content -->
      <main class="flex-1 p-6">
        <!-- Replaced single button with dropdown for multiple roles -->
        <!-- Add Admin Account Dropdown -->
        <div class="mb-6" x-data="{ open: false }">
          <div class="relative inline-block text-left">
            <button @click="open = !open" type="button"
              class="inline-flex justify-center items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
              <i class="fas fa-plus mr-2"></i>
              Add Admin Account
              <i class="fas fa-chevron-down ml-2"></i>
            </button>

            <div x-show="open" @click.away="open = false" x-transition
              class="origin-top-right absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10">
              <div class="py-1">
                <button onclick="openCreateModal('Secretary')" 
                  class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fas fa-user-tie mr-3 text-blue-500"></i>
                  Add Secretary
                </button>
                <button onclick="openCreateModal('Admin')" 
                  class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fas fa-user-cog mr-3 text-green-500"></i>
                  Add Admin
                </button>
                <button onclick="openCreateModal('Treasurer')" 
                  class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fas fa-calculator mr-3 text-purple-500"></i>
                  Add Treasurer
                </button>
                <button onclick="openCreateModal('Audit')" 
                  class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fas fa-shield-alt mr-3 text-gray-500"></i>
                  Add Audit
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Existing Admin Accounts -->
        <div class="mt-8">
          <!-- Header with Search Bar on the Right -->
          <div class="flex justify-between items-center mb-4">
            <!-- Updated heading to be more generic -->
            <h3 class="text-lg font-medium text-gray-900">Existing Admin Accounts</h3>
            <div class="relative">
              <input type="text" id="search-input" placeholder="Search by Admin ID, Name, Role, or Email..."
                class="w-full sm:w-64 border border-gray-300 rounded-md shadow-sm py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                onkeyup="searchTable()" />
              <span class="absolute left-3 top-2.5 text-gray-400">
                <i class="fas fa-search"></i>
              </span>
            </div>
          </div>
          <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
              <table id="secretary-table" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Role
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Email
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


                $sql_query_accounts = "SELECT * FROM users";
                $run_sql_query_accounts = mysqli_query($conn, $sql_query_accounts);

                if(mysqli_num_rows($run_sql_query_accounts) > 0){
                  foreach($run_sql_query_accounts as $row_accounts){
                    ?>

                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?php echo $row_accounts['first_name'] . ' ' . $row_accounts['middle_name'] . ' ' . $row_accounts['last_name'] . ' ' . $row_accounts['suffix']; ?>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?php 
                          if($row_accounts['role_id'] == 2){
                            echo "Secretary";
                          }elseif($row_accounts['role_id'] == 3){
                            echo "Admin";
                          }elseif($row_accounts['role_id'] == 4){
                            echo "Treasurer";
                          }elseif($row_accounts['role_id'] == 5){
                            echo "Audit";
                          }else{
                            echo "Homeowner";
                          }
                        ?>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?php echo $row_accounts['email_address']; ?>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm">
                          <?php 
                            if($row_accounts['account_status'] == 1){
                              $statusClass = "bg-green-100 text-green-800";
                              $statusText = "Active";
                            } else {
                              $statusClass = "bg-gray-200 text-gray-700";
                              $statusText = "Inactive";
                            }
                          ?>
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $statusClass; ?>">
                            <?php echo $statusText; ?>
                          </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="president-edit-accounts.php?user_id=<?php echo $row_accounts['user_id']; ?>"
                          class="text-indigo-600 hover:text-indigo-900">
                          Edit
                        </a>
                        <!-- <a href="../../Query/delete-account.php?user_id=<?php echo $row_accounts['user_id']; ?>" onclick="return confirm('Are you sure you want to delete this account?')" class="text-red-600 hover:text-red-900">Delete</a> -->

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

  <!-- Create Admin Account Modal -->
  <div id="create-secretary-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl max-h-screen overflow-y-auto">
      <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
        <!-- Made modal title dynamic -->
        <h3 id="modal-title" class="text-lg font-medium text-gray-900">Create Admin Account</h3>
        <button id="close-create-modal" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-6">
        <form id="create-secretary-form" method="POST" enctype="multipart/form-data" action="../../Query/create-account.php">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label for="sec-first-name" class="block text-sm font-medium text-gray-700">First Name</label>
              <input type="text" name="first_name" id="sec-first-name" placeholder="Enter first name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="sec-middle-name" class="block text-sm font-medium text-gray-700">Middle Name</label>
              <input type="text" name="middle_name" id="sec-middle-name" placeholder="Enter middle name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="sec-last-name" class="block text-sm font-medium text-gray-700">Last Name</label>
              <input type="text" name="last_name" id="sec-last-name" placeholder="Enter last name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="sec-name-suffix" class="block text-sm font-medium text-gray-700">Name Suffix</label>
              <input type="text" name="name_suffix" id="sec-name-suffix" placeholder="e.g., Jr., Sr."
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="sec-role" class="block text-sm font-medium text-gray-700">Role</label>
              <!-- Made role field dynamic instead of readonly -->
              <input type="text" name="role" id="sec-role" readonly
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
            </div>
            <div>
              <label for="sec-email" class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" name="email" id="sec-email" placeholder="Enter email address"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            
            <div>
              <label for="sec-age" class="block text-sm font-medium text-gray-700">Age</label>
              <input type="number" name="age" id="sec-age" placeholder="Enter age" min="18"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="sec-phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
              <!-- Updated phone input to have +639 prefix and only accept numbers -->
              <div class="mt-1 flex rounded-md shadow-sm">
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                  +639
                </span>
                <input type="tel" name="phone" id="sec-phone" placeholder="123456789" pattern="[0-9]{9}" maxlength="9"
                  class="flex-1 block w-full rounded-none rounded-r-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" 
                  oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
              </div>
            </div>
            <div>
              <label for="sec-dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
              <input type="date" name="date_of_birth" id="sec-dob"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="sec-citizenship" class="block text-sm font-medium text-gray-700">Citizenship</label>
              <input type="text" name="citizenship" id="sec-citizenship" placeholder="Enter citizenship"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="sec-relationship-status" class="block text-sm font-medium text-gray-700">Civil Status</label>
              <select name="civil_status" id="sec-relationship-status"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                <option value="" disabled selected>Select status</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
                <option value="Annulled">Annulled</option>
              </select>
            </div>
            <div>
              <label for="sec-relationship-status" class="block text-sm font-medium text-gray-700">Status</label>
              <select name="account_status" id="sec-relationship-status"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                <option value="" disabled selected>Select status</option>
                <option value="1">Active</option>
                <option value="2">Inactive</option>
              </select>
            </div>
            <div class="sm:col-span-2">
              <label for="sec-home-address" class="block text-sm font-medium text-gray-700">Home Address</label>
              <input type="text" name="home_address" id="sec-home-address" placeholder="Enter home address"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="sec-lot-number" class="block text-sm font-medium text-gray-700">Lot #</label>
              <input type="text" name="lot_number" id="sec-lot-number" placeholder="Enter lot number"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="sec-block-number" class="block text-sm font-medium text-gray-700">Block #</label>
              <input type="text" name="block_number" id="sec-block-number" placeholder="Enter block number"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="sec-phase-number" class="block text-sm font-medium text-gray-700">Phase #</label>
              <input type="text" name="phase_number" id="sec-phase-number" placeholder="Enter phase number"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="sec-village-name" class="block text-sm font-medium text-gray-700">Village Name</label>
              <input type="text" name="village_name" id="sec-village-name" placeholder="Enter village name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
          </div>
          <div class="mt-6 flex justify-end">
            <button type="button" id="cancel-create-modal"
              class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 mr-2">
              Cancel
            </button>
            <button type="submit" id="create-submit-btn" name="create_account"
              class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
              Create Account
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Secretary Account Modal -->
  <!-- updated edit modal to match add admin modal design and content -->
  <!-- <div id="edit-secretary-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl max-h-screen overflow-y-auto">
      <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
        <h3 id="edit-modal-title" class="text-lg font-medium text-gray-900">Edit Admin Account</h3>
        <button id="close-edit-modal" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-6">
        <form id="edit-secretary-form">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label for="edit-first-name" class="block text-sm font-medium text-gray-700">First Name</label>
              <input type="text" name="first-name" id="edit-first-name" placeholder="Enter first name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="edit-middle-name" class="block text-sm font-medium text-gray-700">Middle Name</label>
              <input type="text" name="middle-name" id="edit-middle-name" placeholder="Enter middle name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="edit-last-name" class="block text-sm font-medium text-gray-700">Last Name</label>
              <input type="text" name="last-name" id="edit-last-name" placeholder="Enter last name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="edit-name-suffix" class="block text-sm font-medium text-gray-700">Name Suffix</label>
              <input type="text" name="name-suffix" id="edit-name-suffix" placeholder="e.g., Jr., Sr."
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="edit-role" class="block text-sm font-medium text-gray-700">Role</label>
              <input type="text" name="role" id="edit-role" readonly
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
            </div>
            <div>
              <label for="edit-email" class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" name="email" id="edit-email" placeholder="Enter email address"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="edit-age" class="block text-sm font-medium text-gray-700">Age</label>
              <input type="number" name="age" id="edit-age" placeholder="Enter age" min="18"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="edit-phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
              <div class="mt-1 flex rounded-md shadow-sm">
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                  +639
                </span>
                <input type="tel" name="phone" id="edit-phone" placeholder="123456789" pattern="[0-9]{9}" maxlength="9"
                  class="flex-1 block w-full rounded-none rounded-r-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" 
                  oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
              </div>
            </div>
            <div>
              <label for="edit-dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
              <input type="date" name="dob" id="edit-dob"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="edit-citizenship" class="block text-sm font-medium text-gray-700">Citizenship</label>
              <input type="text" name="citizenship" id="edit-citizenship" placeholder="Enter citizenship"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="edit-relationship-status" class="block text-sm font-medium text-gray-700">Civil Status</label>
              <select name="relationship-status" id="edit-relationship-status"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                <option value="" disabled>Select status</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
                <option value="Annulled">Annulled</option>
              </select>
            </div>
            <div>
              <label for="" class="block text-sm font-medium text-gray-700">Civil Status</label>
              <select name="account_status" id=""
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                <option value="" disabled>Select status</option>
                <option value="1">Active</option>
                <option value="2">Inactive</option>
              </select>
            </div>
            <div class="sm:col-span-2">
              <label for="edit-home-address" class="block text-sm font-medium text-gray-700">Home Address</label>
              <input type="text" name="home-address" id="edit-home-address" placeholder="Enter home address"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="edit-lot-number" class="block text-sm font-medium text-gray-700">Lot #</label>
              <input type="text" name="lot-number" id="edit-lot-number" placeholder="Enter lot number"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="edit-block-number" class="block text-sm font-medium text-gray-700">Block #</label>
              <input type="text" name="block-number" id="edit-block-number" placeholder="Enter block number"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="edit-phase-number" class="block text-sm font-medium text-gray-700">Phase #</label>
              <input type="text" name="phase-number" id="edit-phase-number" placeholder="Enter phase number"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="edit-village-name" class="block text-sm font-medium text-gray-700">Village Name</label>
              <input type="text" name="village-name" id="edit-village-name" placeholder="Enter village name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required />
            </div>
            <div>
              <label for="edit-status" class="block text-sm font-medium text-gray-700">Status</label>
              <select name="status" id="edit-status"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
          </div>
          <div class="mt-6 flex justify-end">
            <button type="button" id="cancel-edit-modal"
              class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 mr-2">
              Cancel
            </button>
            <button type="submit"
              class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
              Save Changes
            </button>
          </div> -->
        </form>
      </div>
    </div>
  </div>

  <script>
    // Sidebar functionality
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
          // Stop event propagation to prevent triggering the dropdown toggle
          e.stopPropagation();
          if (link.getAttribute('href') === currentPath) {
            e.preventDefault();
            sidebarLinks.forEach(l => l.classList.remove('bg-teal-700', 'bg-teal-900'));
            link.classList.add('bg-teal-700');
          }
        });
      });
    });

    function openCreateModal(role) {
      const modal = document.getElementById('create-secretary-modal');
      const modalTitle = document.getElementById('modal-title');
      const roleInput = document.getElementById('sec-role');
      const submitBtn = document.getElementById('create-submit-btn');
      
      // Update modal content based on role
      modalTitle.textContent = `Create ${role} Account`;
      roleInput.value = role;
      submitBtn.textContent = `Create ${role} Account`;
      
      modal.classList.remove('hidden');
    }

    // Update existing event listeners
    document.getElementById('close-create-modal').addEventListener('click', function() {
      document.getElementById('create-secretary-modal').classList.add('hidden');
    });

    document.getElementById('cancel-create-modal').addEventListener('click', function() {
      document.getElementById('create-secretary-modal').classList.add('hidden');
    });

    window.addEventListener('click', (e) => {
      if (e.target === document.getElementById('create-secretary-modal')) {
        document.getElementById('create-secretary-modal').classList.add('hidden');
      }
    });

  

    // Open Edit Secretary Modal
    function openEditModal(id, firstName, middleName, lastName, suffix, role, email, age, phone, dob, citizenship, relationshipStatus, homeAddress, lotNumber, blockNumber, phaseNumber, villageName, status) {
      const modal = document.getElementById('edit-secretary-modal');
      const modalTitle = document.getElementById('edit-modal-title');
      modalTitle.textContent = `Edit ${role} Account`;
      
      document.getElementById('edit-first-name').value = firstName;
      document.getElementById('edit-middle-name').value = middleName;
      document.getElementById('edit-last-name').value = lastName;
      document.getElementById('edit-name-suffix').value = suffix;
      document.getElementById('edit-role').value = role;
      document.getElementById('edit-email').value = email;
      document.getElementById('edit-status').value = status;
      document.getElementById('edit-age').value = age;
      document.getElementById('edit-phone').value = phone;
      document.getElementById('edit-dob').value = dob;
      document.getElementById('edit-citizenship').value = citizenship;
      document.getElementById('edit-relationship-status').value = relationshipStatus;
      document.getElementById('edit-home-address').value = homeAddress;
      document.getElementById('edit-lot-number').value = lotNumber;
      document.getElementById('edit-block-number').value = blockNumber;
      document.getElementById('edit-phase-number').value = phaseNumber;
      document.getElementById('edit-village-name').value = villageName;
      modal.classList.remove('hidden');
    }

    // Close Edit Secretary Modal
    document.getElementById('close-edit-modal').addEventListener('click', () => {
      document.getElementById('edit-secretary-modal').classList.add('hidden');
    });

    document.getElementById('cancel-edit-modal').addEventListener('click', () => {
      document.getElementById('edit-secretary-modal').classList.add('hidden');
    });

    window.addEventListener('click', (e) => {
      if (e.target === document.getElementById('edit-secretary-modal')) {
        document.getElementById('edit-secretary-modal').classList.add('hidden');
      }
    });

    // Edit Secretary Form Submission
    document.getElementById('edit-secretary-form').addEventListener('submit', (e) => {
      e.preventDefault();
      const status = document.getElementById('edit-status').value;
      alert(`Changes saved successfully! Status updated to ${status.charAt(0).toUpperCase() + status.slice(1)}.`);
      document.getElementById('edit-secretary-modal').classList.add('hidden');
    });

    function searchTable() {
      const input = document.getElementById('search-input');
      const filter = input.value.toUpperCase();
      const table = document.getElementById('secretary-table');
      const tr = table.getElementsByTagName('tr');

      for (let i = 1; i < tr.length; i++) {
        const td = tr[i].getElementsByTagName('td');
        let txtValue = '';
        
        for (let j = 0; j < td.length - 1; j++) {
          txtValue += td[j].textContent || td[j].innerText;
        }
        
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = '';
        } else {
          tr[i].style.display = 'none';
        }
      }
    }
  </script>
</body>
</html>


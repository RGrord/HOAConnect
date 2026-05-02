
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
  <title>HOAConnect - Homeowners Registered Account</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style> 
    .view-card {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 24px;
      max-width: 1000px; /* increased from 800px to 1000px for wider modal */
      width: 100%;
      max-height: 80vh; /* added max-height to prevent modal from taking full screen */
      overflow-y: auto; /* added scroll bar for content overflow */
    }
    .view-card .info-item {
      display: flex;
      align-items: center;
      margin-bottom: 16px;
    }
    .view-card .info-item i {
      width: 24px;
      color: #14b8a6;
      margin-right: 12px;
    }
    .view-card .info-item span {
      color: #1f2937;
      font-size: 14px;
    }
    [x-cloak] {
      display: none;
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
          <span>Addmin Management</span>
        </a>

        <a href="registered-homeowners.php" class="flex items-center px-6 py-3 bg-teal-700">
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
        <div x-data="{ amenitiesOpen: false }">
          <button @click="amenitiesOpen = !amenitiesOpen" :aria-expanded="amenitiesOpen" class="flex items-center w-full px-6 py-3 hover:bg-teal-600 focus:outline-none">
            <i class="fas fa-swimming-pool mr-3"></i>
            <span class="flex-1 text-left">Amenities</span>
            <svg :class="{ 'rotate-180': amenitiesOpen }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="amenitiesOpen" x-cloak class="bg-teal-800 text-sm">
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
        <div class="flex items-center"></div>
        <button class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded flex items-center justify-center">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </button>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-x-hidden overflow-y-auto">
      <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Homeowners</h1>
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
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
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
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody id="userTableBody" class="bg-white divide-y divide-gray-200">
                <?php

                  $sql_homeowners = "SELECT * FROM users WHERE role_id='6'";
                  $run_sql_homeowners = mysqli_query($conn, $sql_homeowners);
                  if(mysqli_num_rows($run_sql_homeowners) > 0){
                    foreach($run_sql_homeowners as $row_homeowner){
                      ?>
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <?php echo $row_homeowner['first_name'] . ' ' . $row_homeowner['last_name']; ?>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?php echo $row_homeowner['email_address']; ?>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <?php
                              if($row_homeowner['account_status'] == '1'){
                                echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>';
                              }else{
                                echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-red-800">Inactive</span>';
                              }
                            ?>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="view-homeowner.php?user_id=<?php echo $row_homeowner['user_id']; ?>" class="text-teal-600 hover:text-teal-900">View</a>
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
                Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">156</span> results
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

  <!-- View Homeowner Modal -->
  <div id="viewHomeownerModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="view-card">
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-medium text-gray-900">Homeowner Details</h3>
        <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div id="viewHomeownerDetails" class="space-y-4">
        <!-- Updated modal to show detailed form fields with validation -->
        <form id="homeownerForm" class="space-y-4">
          <!-- Personal Information Section -->
          <div class="border-b border-gray-200 pb-4">
            <h4 class="text-md font-semibold text-gray-800 mb-3">Personal Information</h4>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                <input type="text" id="firstName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required readonly>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                <input type="text" id="middleName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" readonly>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                <input type="text" id="lastName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required readonly>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name Suffix</label>
                <input type="text" id="nameSuffix" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" readonly>
              </div>
            </div>
          </div>

          <!-- Contact Information Section -->
          <div class="border-b border-gray-200 pb-4">
            <h4 class="text-md font-semibold text-gray-800 mb-3">Contact Information</h4>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">HOA Number</label>
                <input type="text" id="hoaNumber" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required readonly>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" id="emailAddress" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required readonly>
              </div>
              <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="tel" id="phoneNumber" pattern="^\+639[0-9]{9}$" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="+639XXXXXXXXX" required readonly>
              </div>
            </div>
          </div>

          <!-- Personal Details Section -->
          <div class="border-b border-gray-200 pb-4">
            <h4 class="text-md font-semibold text-gray-800 mb-3">Personal Details</h4>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                <input type="number" id="age" min="18" max="120" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required readonly>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                <input type="date" id="dateOfBirth" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required readonly>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Citizenship</label>
                <input type="text" id="citizenship" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required readonly>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Civil Status</label>
                <select id="civilStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required disabled>
                  <option value="">Select Status</option>
                  <option value="single">Single</option>
                  <option value="married">Married</option>
                  <option value="divorced">Divorced</option>
                  <option value="widowed">Widowed</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required disabled>
                  <option value="">Select Status</option>
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Home Address Section -->
          <div>
            <h4 class="text-md font-semibold text-gray-800 mb-3">Home Address</h4>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lot #</label>
                <input type="text" id="lotNumber" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required readonly>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Block #</label>
                <input type="text" id="blockNumber" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required readonly>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phase #</label>
                <input type="text" id="phaseNumber" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required readonly>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Village Name</label>
                <input type="text" id="villageName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" required readonly>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- Added close button at the bottom of the modal -->
      <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end">
        <button onclick="closeViewModal()" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
          Close
        </button>
      </div>
    </div>
  </div>
  <script>
    // Simulated in-memory data store for users
    let users = [
      {
        id: 1,
        firstName: "Maria",
        middleName: "Lourdes",
        lastName: "Santos",
        nameSuffix: "",
        hoaNumber: "HOA001",
        email: "maria.santos@example.com",
        phone: "+639123456789",
        age: 35,
        dob: "1988-05-12",
        citizenship: "Filipino",
        civilStatus: "married",
        lotNumber: "12",
        blockNumber: "5",
        phaseNumber: "1",
        villageName: "Mabuhay Homes 2000",
        status: "active"
      },
      {
        id: 2,
        firstName: "Juan",
        middleName: "Miguel",
        lastName: "Cruz",
        nameSuffix: "Jr.",
        hoaNumber: "HOA002",
        email: "juan.cruz@example.com",
        phone: "+639234567890",
        age: 42,
        dob: "1981-08-25",
        citizenship: "Filipino",
        civilStatus: "single",
        lotNumber: "8",
        blockNumber: "2",
        phaseNumber: "1",
        villageName: "Mabuhay Homes 2000",
        status: "active"
      },
      {
        id: 3,
        firstName: "Ana",
        middleName: "Clara",
        lastName: "Reyes",
        nameSuffix: "",
        hoaNumber: "HOA003",
        email: "ana.reyes@example.com",
        phone: "+639345678901",
        age: 29,
        dob: "1994-02-14",
        citizenship: "Filipino",
        civilStatus: "single",
        lotNumber: "15",
        blockNumber: "3",
        phaseNumber: "1",
        villageName: "Mabuhay Homes 2000",
        status: "inactive"
      }
    ];

    // Sidebar functionality
    document.addEventListener('DOMContentLoaded', function () {
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
          const matchesSearch = fullName.includes(searchTerm) || user.email.toLowerCase().includes(searchTerm);
          const matchesStatus = status === 'all' || user.status === status;
          return matchesSearch && matchesStatus;
        });
        updateUserTable(filteredUsers);
      }

      // Update user table
      function updateUserTable(filteredUsers = users) {
        const tbody = document.getElementById('userTableBody');
        tbody.innerHTML = '';
        filteredUsers.forEach(user => {
          const row = document.createElement('tr');
          row.setAttribute('data-id', user.id);
          row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">${user.firstName} ${user.middleName ? user.middleName + ' ' : ''}${user.lastName}${user.nameSuffix ? ' ' + user.nameSuffix : ''}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">${user.email}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">${user.status.charAt(0).toUpperCase() + user.status.slice(1)}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="openViewModal(${user.id})" class="bg-teal-600 text-white px-2 py-1 rounded hover:bg-teal-800">View</button>
            </td>
          `;
          tbody.appendChild(row);
        });
      }
    });

    function openViewModal(userId) {
      const user = users.find(u => u.id === userId);
      if (user) {
        document.getElementById('firstName').value = user.firstName;
        document.getElementById('middleName').value = user.middleName || '';
        document.getElementById('lastName').value = user.lastName;
        document.getElementById('nameSuffix').value = user.nameSuffix || '';
        document.getElementById('hoaNumber').value = user.hoaNumber;
        document.getElementById('emailAddress').value = user.email;
        document.getElementById('phoneNumber').value = user.phone;
        document.getElementById('age').value = user.age;
        document.getElementById('dateOfBirth').value = user.dob;
        document.getElementById('citizenship').value = user.citizenship;
        document.getElementById('civilStatus').value = user.civilStatus;
        document.getElementById('lotNumber').value = user.lotNumber;
        document.getElementById('blockNumber').value = user.blockNumber;
        document.getElementById('phaseNumber').value = user.phaseNumber;
        document.getElementById('villageName').value = user.villageName;
        document.getElementById('status').value = user.status;
        
        document.getElementById('viewHomeownerModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }
    }

    function closeViewModal() {
      document.getElementById('viewHomeownerModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }
  </script>
</body>
</html>
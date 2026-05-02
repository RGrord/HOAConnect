<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Court Rental - HOAConnect</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    [x-cloak] { display: none !important; }
    .modal-backdrop { backdrop-filter: blur(2px); }
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
            <button @click="window.location.href='admin-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
              <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
              <span class="flex-1 text-left">Tricycle</span>
            </button>
          </div>

          <!-- Court Navigation -->
          <div class="relative">
            <button @click="window.location.href='admin-court.php'" class="flex items-center w-full px-10 py-2 bg-teal-700 focus:outline-none">
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
<!--End of sidebar-->
      
    <!-- Main Content -->
    <div class="flex-1 overflow-x-hidden overflow-y-auto">
      <!-- Header -->
      <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Court Rental Management</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>

      <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-basketball-ball text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-2xl font-bold" id="totalRentals">0</p>
                <p class="text-sm text-gray-500">Total Rentals</p>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-money-bill-wave text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-2xl font-bold" id="totalRevenue">₱0</p>
                <p class="text-sm text-gray-500">Total Revenue</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Rent Court Button -->
        <div class="mb-6">
          <button onclick="openRentCourtModal()" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-md flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Rent Court
          </button>
        </div>

        <!-- Court Renters Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
          <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Court Renters Table</h2>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Renter Name</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rental Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
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

  <!-- Rent Court Modal -->
  <div id="rentCourtModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Rent Court</h3>
      </div>
      <form id="rentCourtForm" class="p-6 space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Renter Name *</label>
          <input type="text" id="renterNameInput" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Contact Info *</label>
          <input type="text" id="contactInfoInput" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Purpose of Rent *</label>
          <textarea id="purposeOfRentInput" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Amount to Pay (₱) *</label>
          <input type="number" id="amountToPayInput" min="1" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
          <input type="date" id="startDateInput" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">End Date *</label>
          <input type="date" id="endDateInput" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Start Time *</label>
          <input type="time" id="startTimeInput" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">End Time *</label>
          <input type="time" id="endTimeInput" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Expected Number of Participants *</label>
          <input type="number" id="expectedParticipantsInput" min="1" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        <div class="flex justify-end space-x-3 pt-4">
          <button type="button" onclick="closeRentCourtModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700">Rent Court</button>
        </div>
      </form>
    </div>
  </div>

  <!-- View Court Rental Modal -->
  <div id="viewCourtRentalModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 id="viewCourtRentalModalTitle" class="text-lg font-medium text-gray-900">Court Rental Details</h3>
      </div>
      <div id="viewCourtRentalForm" class="p-6 space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Renter Name</label>
          <input type="text" id="renterName" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Contact Info</label>
          <input type="text" id="contactInfo" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Purpose of Rent</label>
          <textarea id="purposeOfRent" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly></textarea>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Amount to Pay (₱)</label>
          <input type="number" id="amountToPay" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
          <input type="date" id="startDate" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
          <input type="date" id="endDate" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
          <input type="time" id="startTime" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
          <input type="time" id="endTime" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Expected Number of Participants</label>
          <input type="number" id="expectedParticipants" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div class="flex justify-end space-x-3 pt-4">
          <button type="button" onclick="closeViewCourtRentalModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Payment Modal -->
  <div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Payment Details</h3>
      </div>
      <div class="p-6 space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Renter Name</label>
          <input type="text" id="paymentRenterName" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
          <input type="text" id="paymentAmount" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div id="proofOfPaymentDisplay" class="hidden">
          <label class="block text-sm font-medium text-gray-700 mb-1">Proof of Payment</label>
          <div class="border border-gray-300 rounded-md p-4 text-center">
            <img id="proofImage" src="/placeholder.svg" alt="Proof of Payment" class="max-w-full h-auto mx-auto cursor-pointer" onclick="viewProofImage(this.src)" style="max-height: 200px;">
          </div>
        </div>
        <div id="proofOfPaymentUpload">
          <label class="block text-sm font-medium text-gray-700 mb-1">Upload Proof of Payment</label>
          <input type="file" id="proofOfPayment" accept="image/*,.pdf" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
          <p class="text-xs text-gray-500 mt-1">Accepted formats: JPG, PNG, PDF (Max 5MB)</p>
        </div>
        <div id="proofPreview" class="hidden">
          <p class="text-sm text-green-600">
            <i class="fas fa-file-check mr-1"></i>
            <span id="proofFileName"></span>
          </p>
        </div>
        <!-- Acknowledgement Receipt -->
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
        <div class="flex justify-end space-x-3 pt-4">
          <button type="button" onclick="closePaymentModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
          <button type="button" id="uploadProofButton" onclick="uploadProof()" class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700">Upload Proof</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Proof Image Modal for viewing larger images -->
  <div id="proofImageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl max-h-[90vh] overflow-auto">
      <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">Proof of Payment</h3>
        <button onclick="closeProofImageModal()" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      <div class="p-6">
        <img id="proofImageLarge" src="/placeholder.svg" alt="Proof of Payment" class="max-w-full h-auto">
      </div>
    </div>
  </div>

  <script>
    // Global variables
    let courtRentals = [];
    let payments = [];
    let editingRentalId = null;

    // Initialize with sample data
    function initializeSampleData() {
      courtRentals = [
        {
          id: 1,
          renterName: 'Juan Dela Cruz',
          contactInfo: '09123456789',
          purpose: 'Weekly basketball practice and training sessions',
          startDate: '2024-01-15',
          endDate: '2024-01-15',
          startTime: '18:00',
          endTime: '20:00',
          numberOfDays: 1,
          amountToPay: 1500,
          expectedParticipants: 20,
          paymentStatus: 'Paid',
          rentalStatus: 'Inactive',
          proofOfPayment: '/placeholder.svg?height=200&width=300',
          acknowledgementReceipt: null
        },
        {
          id: 2,
          renterName: 'Maria Santos',
          contactInfo: '09987654321',
          purpose: 'Birthday party celebration with games',
          startDate: '2024-01-20',
          endDate: '2024-01-20',
          startTime: '14:00',
          endTime: '18:00',
          numberOfDays: 1,
          amountToPay: 2000,
          expectedParticipants: 50,
          paymentStatus: 'Paid',
          rentalStatus: 'Inactive',
          proofOfPayment: '/placeholder.svg?height=200&width=300',
          acknowledgementReceipt: null
        },
        {
          id: 3,
          renterName: 'Pedro Reyes',
          contactInfo: '09555123456',
          purpose: 'Company team building activities',
          startDate: '2024-01-25',
          endDate: '2024-01-25',
          startTime: '09:00',
          endTime: '17:00',
          numberOfDays: 1,
          amountToPay: 3000,
          expectedParticipants: 30,
          paymentStatus: 'Unpaid',
          rentalStatus: 'Active',
          proofOfPayment: null,
          acknowledgementReceipt: null
        }
      ];

      payments = [
        {
          id: 1,
          rentalId: 1,
          amount: 1500,
          paymentDate: '2024-01-10',
          method: 'GCash',
          remarks: 'Advance payment for weekly practice'
        },
        {
          id: 2,
          rentalId: 2,
          amount: 2000,
          paymentDate: '2024-01-18',
          method: 'Bank Transfer',
          remarks: 'Birthday party payment'
        }
      ];

      renderRentersTable();
      updateStats();
    }

    // Rent Court Modal Functions
    function openRentCourtModal() {
      document.getElementById('rentCourtModal').classList.remove('hidden');
    }

    function closeRentCourtModal() {
      document.getElementById('rentCourtModal').classList.add('hidden');
      document.getElementById('rentCourtForm').reset();
    }

    document.getElementById('rentCourtForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const newRental = {
        id: Math.max(...courtRentals.map(r => r.id)) + 1,
        renterName: document.getElementById('renterNameInput').value,
        contactInfo: document.getElementById('contactInfoInput').value,
        purpose: document.getElementById('purposeOfRentInput').value,
        amountToPay: parseInt(document.getElementById('amountToPayInput').value),
        startDate: document.getElementById('startDateInput').value,
        endDate: document.getElementById('endDateInput').value,
        startTime: document.getElementById('startTimeInput').value,
        endTime: document.getElementById('endTimeInput').value,
        numberOfDays: 1,
        expectedParticipants: parseInt(document.getElementById('expectedParticipantsInput').value),
        paymentStatus: 'Unpaid',
        rentalStatus: 'Active',
        proofOfPayment: null,
        acknowledgementReceipt: null
      };

      courtRentals.push(newRental);
      renderRentersTable();
      updateStats();
      closeRentCourtModal();
      alert('Court rental request submitted successfully!');
    });

    // Calculate end date based on start date and number of days (no longer used for form submission, but kept for logic)
    function calculateEndDate(startDate, numberOfDays) {
      const start = new Date(startDate);
      const end = new Date(start);
      end.setDate(start.getDate() + numberOfDays - 1);
      return end.toISOString().split('T')[0];
    }

    // Render renters table
    function renderRentersTable() {
      const tbody = document.getElementById('rentersTableBody');
      tbody.innerHTML = '';

      courtRentals.forEach(rental => {
        const row = document.createElement('tr');
        
        row.innerHTML = `
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">${rental.renterName}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">${new Date(rental.startDate).toLocaleDateString()}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">${new Date(rental.endDate).toLocaleDateString()}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${rental.paymentStatus === 'Paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
              ${rental.paymentStatus}
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${rental.rentalStatus === 'Active' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'}">
              ${rental.rentalStatus}
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <button onclick="viewPayment(${rental.id})" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded text-xs w-16">
              View
            </button>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <button onclick="openViewCourtRentalModal(${rental.id})" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded text-xs w-16">
              View
            </button>
          </td>
        `;
        tbody.appendChild(row);
      });
    }

    // Update statistics
    function updateStats() {
      const totalRentals = courtRentals.length;
      const totalRevenue = payments.reduce((sum, p) => sum + p.amount, 0);

      document.getElementById('totalRentals').textContent = totalRentals;
      document.getElementById('totalRevenue').textContent = '₱' + totalRevenue.toLocaleString();
    }

    // View Court Rental Modal functions
    function openViewCourtRentalModal(id) {
      const rental = courtRentals.find(r => r.id === id);
      
      document.getElementById('viewCourtRentalModalTitle').textContent = 'Court Rental Details';
      document.getElementById('renterName').value = rental.renterName;
      document.getElementById('contactInfo').value = rental.contactInfo;
      document.getElementById('purposeOfRent').value = rental.purpose;
      document.getElementById('amountToPay').value = rental.amountToPay;
      document.getElementById('startDate').value = rental.startDate;
      document.getElementById('endDate').value = rental.endDate;
      document.getElementById('startTime').value = rental.startTime;
      document.getElementById('endTime').value = rental.endTime;
      document.getElementById('expectedParticipants').value = rental.expectedParticipants;
      
      document.getElementById('viewCourtRentalModal').classList.remove('hidden');
    }

    function closeViewCourtRentalModal() {
      document.getElementById('viewCourtRentalModal').classList.add('hidden');
    }

    // Payment Modal
    function viewPayment(rentalId) {
      const rental = courtRentals.find(r => r.id === rentalId);
      const proofOfPaymentUpload = document.getElementById('proofOfPaymentUpload');
      const proofOfPaymentDisplay = document.getElementById('proofOfPaymentDisplay');
      const uploadProofButton = document.getElementById('uploadProofButton');
      
      document.getElementById('paymentRenterName').value = rental.renterName;
      document.getElementById('paymentAmount').value = `₱${rental.amountToPay.toLocaleString()}`;
      
      if (rental.paymentStatus === 'Paid' && rental.proofOfPayment) {
        proofOfPaymentUpload.classList.add('hidden');
        proofOfPaymentDisplay.classList.remove('hidden');
        document.getElementById('proofImage').src = rental.proofOfPayment;
        uploadProofButton.classList.add('hidden');
      } else {
        proofOfPaymentUpload.classList.remove('hidden');
        proofOfPaymentDisplay.classList.add('hidden');
        uploadProofButton.classList.remove('hidden');
      }

      document.getElementById('paymentModal').dataset.rentalId = rentalId;
      document.getElementById('paymentModal').classList.remove('hidden');
    }

    function closePaymentModal() {
      document.getElementById('paymentModal').classList.add('hidden');
      document.getElementById('proofOfPayment').value = '';
      document.getElementById('proofPreview').classList.add('hidden');
      document.getElementById('transactionAcknowledgement').value = '';
      document.getElementById('transactionAcknowledgementPreview').innerHTML = '';
    }

    // Handle proof of payment file upload
    document.getElementById('proofOfPayment').addEventListener('change', function(e) {
      const file = e.target.files[0];
      const preview = document.getElementById('proofPreview');
      const fileName = document.getElementById('proofFileName');
      
      if (file) {
        if (file.size > 5 * 1024 * 1024) { // 5MB limit
          alert('File size must be less than 5MB');
          e.target.value = '';
          preview.classList.add('hidden');
          return;
        }
        
        fileName.textContent = file.name;
        preview.classList.remove('hidden');
      } else {
        preview.classList.add('hidden');
      }
    });

    // Handle acknowledgement receipt file upload
    document.getElementById('transactionAcknowledgement').addEventListener('change', function(e) {
      const file = e.target.files[0];
      const preview = document.getElementById('transactionAcknowledgementPreview');
      
      if (file) {
        if (file.size > 10 * 1024 * 1024) { // 10MB limit
          alert('File size must be less than 10MB');
          e.target.value = '';
          preview.innerHTML = '';
          return;
        }
        
        const fileName = file.name;
        preview.innerHTML = `
          <p class="text-sm text-green-600">
            <i class="fas fa-file-check mr-1"></i>
            ${fileName}
          </p>
        `;
      } else {
        preview.innerHTML = '';
      }
    });

    function uploadProof() {
      const fileInput = document.getElementById('proofOfPayment');
      const acknowledgementInput = document.getElementById('transactionAcknowledgement');
      const rentalId = parseInt(document.getElementById('paymentModal').dataset.rentalId);
      
      if (!fileInput.files[0]) {
        alert('Please select a proof of payment file to upload');
        return;
      }
      
      const file = fileInput.files[0];
      const fileURL = URL.createObjectURL(file);
      const acknowledgementFile = acknowledgementInput.files[0];
      const acknowledgementURL = acknowledgementFile ? URL.createObjectURL(acknowledgementFile) : null;
      
      const rentalIndex = courtRentals.findIndex(r => r.id === rentalId);
      if (rentalIndex !== -1) {
        courtRentals[rentalIndex].paymentStatus = 'Paid';
        courtRentals[rentalIndex].rentalStatus = 'Inactive';
        courtRentals[rentalIndex].proofOfPayment = fileURL;
        courtRentals[rentalIndex].acknowledgementReceipt = acknowledgementURL;
        
        const rental = courtRentals[rentalIndex];
        const newPaymentId = Math.max(...payments.map(p => p.id), 0) + 1;
        payments.push({
          id: newPaymentId,
          rentalId: rentalId,
          amount: rental.amountToPay,
          paymentDate: new Date().toISOString().split('T')[0],
          method: 'Proof Upload',
          remarks: 'Payment proof uploaded'
        });
      }
      
      renderRentersTable();
      updateStats();
      closePaymentModal();
      
      alert('Proof of payment and acknowledgement receipt uploaded successfully! Payment status updated to Paid.');
    }

    function viewProofImage(imageSrc) {
      document.getElementById('proofImageLarge').src = imageSrc;
      document.getElementById('proofImageModal').classList.remove('hidden');
    }

    function closeProofImageModal() {
      document.getElementById('proofImageModal').classList.add('hidden');
    }

    // Initialize the application
    document.addEventListener('DOMContentLoaded', function() {
      initializeSampleData();
    });
  </script>
</body>
</html>
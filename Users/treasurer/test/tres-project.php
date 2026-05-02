<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>HOAConnect - Resolution</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>
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
      <a href="tres-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-tachometer-alt mr-3"></i>
        <span>Dashboard</span>
      </a>
      <a href="tres-paymenthistory.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-receipt mr-3"></i>
        <span>Payment History</span>
      </a>
      <a href="tres-remittance.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-money-check mr-3"></i>
        <span>Remittance</span>
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
   
  <div class="relative">
    <button @click="window.location.href='tres-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
      <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
      <span class="flex-1 text-left">Tricycle</span>
    </button>
  </div>

   
  <div class="relative">
    <button @click="window.location.href='tres-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
      <i class="fas fa-basketball-ball mr-2" title="Court"></i>
      <span class="flex-1 text-left">Court</span>
    </button>
  </div>

   
  <div class="relative">
    <button @click="window.location.href='tres-stall.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
      <i class="fas fa-store mr-2" title="Stall"></i>
      <span class="flex-1 text-left">Stall</span>
    </button>
  </div>
</div>
</div>

      <a href="tres-project.php" class="flex items-center px-6 py-3 bg-teal-700">
        <i class="fas fa-gavel mr-3"></i>
    <span>Resolution</span>
      </a>
      <a href="tres-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-book mr-3"></i>
        <span>Ledger</span>
      </a>
      <a href="tres-acknowledgement.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-file-invoice mr-3"></i>
        <span>Receipt</span>
      </a>
      <a href="tres-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-newspaper mr-3"></i>
        <span>News Feed</span>
      </a>
      <a href="tres-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-calendar-alt mr-3"></i>
        <span>Calendar</span>
      </a>
      <a href="tres-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
          <h1 class="text-2xl font-bold text-gray-900">Project and Financial Resolution</h1>
          <div class="flex items-center space-x-2">
            <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
              <i class="fas fa-bell"></i>
            </button>
          </div>
        </div>
  </header>

    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      
      <div id="project-proposals" class="mb-8">
         
        <div class="mb-4">
          <button onclick="openAddTransactionModal()" class="bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-md shadow-sm flex items-center">
            <i class="fas fa-plus-circle mr-2"></i>
            Add Transactions
          </button>
        </div>
        
         <!-- Add Budget/Project filter dropdown next to status filter -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:space-x-4">
          <div class="flex-1 mb-4 sm:mb-0">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
              </div>
              <input id="search" type="text" placeholder="Search by title"
                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
          </div>
          <div>
            <label for="statusFilter" class="sr-only">Filter by Status</label>
            <select id="statusFilter"
              class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
              <option value="">All Statuses</option>
              <option value="Ongoing">Ongoing</option>
              <option value="Pending">Pending</option>
              <option value="Completed">Completed</option>
              <option value="Approved">Approved</option>
              <option value="Past Due">Past Due</option>
            </select>
          </div>
          <!-- Add Budget/Project type filter -->
          <div>
            <label for="typeFilter" class="sr-only">Filter by Type</label>
            <select id="typeFilter"
              class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
              <option value="">All Types</option>
              <option value="Project">Project</option>
              <option value="Budget">Budget</option>
            </select>
          </div>
        </div>

        <div id="project-proposals" class="mb-8">
          <h2 class="text-xl font-semibold text-gray-900 mb-6">Resolutions Table</h2>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Particulars</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project Details</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget Released</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Financial Summary</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project Post</th>
                </tr>
              </thead>
              <tbody id="proposalsTableBody" class="bg-white divide-y divide-gray-200">
                  
              </tbody>
            </table> 
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

  
<div id="addTransactionModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
      <h3 class="text-lg font-medium text-gray-900">Add Transaction</h3>
      <button onclick="closeAddTransactionModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <form id="addTransactionForm" class="space-y-6">
        <div>
          <label for="transactionParticulars" class="block text-sm font-medium text-gray-700">Particulars</label>
          <input type="text" id="transactionParticulars" name="transactionParticulars" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Enter transaction particulars" />
        </div>
        <div>
          <label for="transactionDate" class="block text-sm font-medium text-gray-700">Date</label>
          <input type="date" id="transactionDate" name="transactionDate" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
        </div>
        <div>
          <label for="transactionType" class="block text-sm font-medium text-gray-700">Transaction Type</label>
          <select id="transactionType" name="transactionType" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
            <option value="">Select transaction type</option>
            <option value="Credit">Credit</option>
            <option value="Debit">Debit</option>
          </select>
        </div>
        <div>
          <label for="transactionPayer" class="block text-sm font-medium text-gray-700">Name of Payer</label>
          <input type="text" id="transactionPayer" name="transactionPayer" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Enter payer name" />
        </div>
        <div>
          <label for="transactionReceiver" class="block text-sm font-medium text-gray-700">Name of Receiver</label>
          <input type="text" id="transactionReceiver" name="transactionReceiver" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Enter receiver name" />
        </div>
        <div>
          <label for="transactionPaymentMethod" class="block text-sm font-medium text-gray-700">Payment Method</label>
          <select id="transactionPaymentMethod" name="transactionPaymentMethod" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
            <option value="">Select payment method</option>
            <option value="CASH">CASH</option>
            <option value="GCASH">GCASH</option>
            <option value="BANK TRANSFER">BANK TRANSFER</option>
          </select>
        </div>
        <div>
          <label for="transactionReferenceNumber" class="block text-sm font-medium text-gray-700">Reference Number</label>
          <input type="text" id="transactionReferenceNumber" name="transactionReferenceNumber"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Enter reference number (optional for cash)" />
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
          <label for="transactionRemarks" class="block text-sm font-medium text-gray-700">Remarks</label>
          <textarea id="transactionRemarks" name="transactionRemarks" rows="4"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Enter any remarks (optional)"></textarea>
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeAddTransactionModal()"
            class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Cancel
          </button>
          <button type="submit"
            class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Add Transaction
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

 
<div id="boardResolutionModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
      <h3 class="text-lg font-medium text-gray-900">Create Board Resolution</h3>
      <button onclick="closeBoardResolutionModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <form id="boardResolutionForm" class="space-y-6">
        <div>
          <label for="resolutionTitle" class="block text-sm font-medium text-gray-700">Project Resolution Title</label>
          <input type="text" id="resolutionTitle" name="resolutionTitle" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
        </div>
        <div>
          <label for="resolutionSummary" class="block text-sm font-medium text-gray-700">Resolution Summary</label>
          <textarea id="resolutionSummary" name="resolutionSummary" rows="4" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Provide a detailed summary of the board resolution..."></textarea>
        </div>
        <div>
          <label for="estimatedBudget" class="block text-sm font-medium text-gray-700">Estimated Budget</label>
          <input type="number" id="estimatedBudget" name="estimatedBudget" min="0" step="0.01"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Enter estimated budget amount" />
        </div>
        <div>
          <label for="resolutionStartDate" class="block text-sm font-medium text-gray-700">Start Date</label>
          <input type="date" id="resolutionStartDate" name="resolutionStartDate" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
        </div>
        <div>
          <label for="resolutionTargetCompletion" class="block text-sm font-medium text-gray-700">Date Target Completion</label>
          <input type="date" id="resolutionTargetCompletion" name="resolutionTargetCompletion" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
        </div>
        <div>
          <label for="resolutionProposedBy" class="block text-sm font-medium text-gray-700">Proposed By</label>
          <input type="text" id="resolutionProposedBy" name="resolutionProposedBy" value="HOA Board of Directors" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Project Proposal Document</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-600">
                <label for="projectProposalDoc" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                  <span>Upload project proposal document</span>
                  <input id="projectProposalDoc" name="projectProposalDoc" type="file" accept="application/pdf,.doc,.docx" class="sr-only" />
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs text-gray-500">PDF, DOC, DOCX up to 10MB</p>
            </div>
          </div>
          <div id="projectProposalPreview" class="mt-2"></div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Upload Signed Resolution</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-600">
                <label for="signedResolution" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                  <span>Upload signed resolution</span>
                  <input id="signedResolution" name="signedResolution" type="file" accept="application/pdf,.doc,.docx,image/png,image/jpeg" class="sr-only" />
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs text-gray-500">PDF, DOC, DOCX, PNG, JPG up to 10MB</p>
            </div>
          </div>
          <div id="signedResolutionPreview" class="mt-2"></div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Upload Audit File</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-600">
                <label for="auditFile" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                  <span>Upload audit file</span>
                  <input id="auditFile" name="auditFile" type="file" accept="application/pdf,.doc,.docx,image/png,image/jpeg" class="sr-only" />
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs text-gray-500">PDF, DOC, DOCX, PNG, JPG up to 10MB</p>
            </div>
          </div>
          <div id="auditFilePreview" class="mt-2"></div>
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeBoardResolutionModal()"
            class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Cancel
          </button>
          <button type="submit"
            class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Create Board Resolution
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

 
<div id="viewProjectModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
      <h3 class="text-lg font-medium text-gray-900">Project Proposal Details</h3>
      <button onclick="closeViewProjectModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <form id="viewProjectForm" class="space-y-6">
        <input type="hidden" id="viewProjectId" />
        <div>
          <label for="viewResolutionTitle" class="block text-sm font-medium text-gray-700">Project Resolution Title</label>
          <input type="text" id="viewResolutionTitle" name="viewResolutionTitle" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
        </div>
        <div>
          <label for="viewResolutionSummary" class="block text-sm font-medium text-gray-700">Resolution Summary</label>
          <textarea id="viewResolutionSummary" name="viewResolutionSummary" rows="4" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Provide a detailed summary of the board resolution..."></textarea>
        </div>
        <div>
          <label for="viewEstimatedBudget" class="block text-sm font-medium text-gray-700">Estimated Budget</label>
          <input type="number" id="viewEstimatedBudget" name="viewEstimatedBudget" min="0" step="0.01"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Enter estimated budget amount" />
        </div>
        <div>
          <label for="viewResolutionStartDate" class="block text-sm font-medium text-gray-700">Start Date</label>
          <input type="date" id="viewResolutionStartDate" name="viewResolutionStartDate" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
        </div>
        <div>
          <label for="viewResolutionTargetCompletion" class="block text-sm font-medium text-gray-700">Date Target Completion</label>
          <input type="date" id="viewResolutionTargetCompletion" name="viewResolutionTargetCompletion" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
        </div>
        <div>
          <label for="viewResolutionProposedBy" class="block text-sm font-medium text-gray-700">Proposed By</label>
          <input type="text" id="viewResolutionProposedBy" name="viewResolutionProposedBy" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Project Proposal Document</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-600">
                <label for="viewProjectProposalDoc" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                  <span>Upload project proposal document</span>
                  <input id="viewProjectProposalDoc" name="viewProjectProposalDoc" type="file" accept="application/pdf,.doc,.docx" class="sr-only" />
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs text-gray-500">PDF, DOC, DOCX up to 10MB</p>
            </div>
          </div>
          <div id="viewProjectProposalPreview" class="mt-2"></div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Upload Signed Resolution</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-600">
                <label for="viewSignedResolution" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                  <span>Upload signed resolution</span>
                  <input id="viewSignedResolution" name="viewSignedResolution" type="file" accept="application/pdf,.doc,.docx,image/png,image/jpeg" class="sr-only" />
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs text-gray-500">PDF, DOC, DOCX, PNG, JPG up to 10MB</p>
            </div>
          </div>
          <div id="viewSignedResolutionPreview" class="mt-2"></div>
        </div>
        <div id="viewAuditFileSection" style="display: none;">
          <label class="block text-sm font-medium text-gray-700">Upload Audit File</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-600">
                <label for="viewAuditFile" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                  <span>Upload audit file</span>
                  <input id="viewAuditFile" name="viewAuditFile" type="file" accept="application/pdf,.doc,.docx,image/png,image/jpeg" class="sr-only" />
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs text-gray-500">PDF, DOC, DOCX, PNG, JPG up to 10MB</p>
            </div>
          </div>
          <div id="viewAuditFilePreview" class="mt-2"></div>
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeViewProjectModal()"
            class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Close
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<div id="notesModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
      <h3 class="text-lg font-medium text-gray-900">President's Notes</h3>
      <button onclick="closeNotesModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <p id="notesContent" class="text-sm text-gray-900"></p>
      <div class="mt-6 flex justify-end">
        <button type="button" onclick="closeNotesModal()"
          class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
          Close
        </button>
      </div>
    </div>
  </div>
</div>

<div id="projectPostModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
      <h3 class="text-lg font-medium text-gray-900">Create Project Post</h3>
      <button onclick="closeProjectPostModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <form id="projectPostForm" class="space-y-6">
        <div>
          <label for="postProjectTitle" class="block text-sm font-medium text-gray-700">Project Title</label>
          <input type="text" id="postProjectTitle" name="postProjectTitle" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
        </div>
        <div>
          <label for="postDescription" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea id="postDescription" name="postDescription" rows="4" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"></textarea>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Project Images</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-600">
                <label for="postImages" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                  <span>Upload images</span>
                  <input id="postImages" name="postImages" type="file" accept="image/png,image/jpeg" multiple class="sr-only" />
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs text-gray-500">PNG, JPG up to 10MB</p>
            </div>
          </div>
          <div id="postImagePreview" class="mt-2 grid grid-cols-2 gap-2"></div>
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeProjectPostModal()"
            class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Cancel
          </button>
          <button type="submit"
            class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Create Post
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

  
<div id="auditFileModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
      <h3 class="text-lg font-medium text-gray-900">Audit File</h3>
      <button onclick="closeAuditFileModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <div id="auditFileContent" class="text-sm text-gray-900"></div>
      <div class="mt-6 flex justify-end">
        <button type="button" onclick="closeAuditFileModal()"
          class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
          Close
        </button>
      </div>
    </div>
  </div>
</div>

 
<div id="budgetReleasedModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
      <h3 class="text-lg font-medium text-gray-900">Budget Release Details</h3>
      <button onclick="closeBudgetReleasedModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <form id="budgetReleasedForm" class="space-y-6">
        <div>
          <label for="budgetProjectTitle" class="block text-sm font-medium text-gray-700">Project Title</label>
          <input type="text" id="budgetProjectTitle" name="budgetProjectTitle" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label for="budgetAmountReleased" class="block text-sm font-medium text-gray-700">Amount Released</label>
          <input type="number" id="budgetAmountReleased" name="budgetAmountReleased" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label for="budgetRecipient" class="block text-sm font-medium text-gray-700">Recipient</label>
          <input type="text" id="budgetRecipient" name="budgetRecipient" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label for="budgetReleaseDate" class="block text-sm font-medium text-gray-700">Release Date</label>
          <input type="date" id="budgetReleaseDate" name="budgetReleaseDate" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label for="budgetPaymentMethod" class="block text-sm font-medium text-gray-700">Payment Method</label>
          <input type="text" id="budgetPaymentMethod" name="budgetPaymentMethod" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label for="budgetReferenceNumber" class="block text-sm font-medium text-gray-700">Reference Number</label>
          <input type="text" id="budgetReferenceNumber" name="budgetReferenceNumber" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Acknowledgement Receipt</label>
          <div id="budgetAcknowledgementPreview" class="mt-2"></div>
        </div>
        <div>
          <label for="budgetPurpose" class="block text-sm font-medium text-gray-700">Purpose</label>
          <textarea id="budgetPurpose" name="budgetPurpose" rows="4" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm"></textarea>
        </div>
        <div>
          <label for="budgetApprovalNotes" class="block text-sm font-medium text-gray-700">Approval Notes</label>
          <textarea id="budgetApprovalNotes" name="budgetApprovalNotes" rows="4" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm"></textarea>
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeBudgetReleasedModal()"
            class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Close
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<div id="releaseBudgetModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
      <h3 class="text-lg font-medium text-gray-900">Release Budget</h3>
      <button onclick="closeReleaseBudgetModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <form id="releaseBudgetForm" class="space-y-6">
        <div>
          <label for="releaseProjectTitle" class="block text-sm font-medium text-gray-700">Project Title</label>
          <input type="text" id="releaseProjectTitle" name="releaseProjectTitle" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label for="releaseAmount" class="block text-sm font-medium text-gray-700">Amount Released</label>
          <input type="number" id="releaseAmount" name="releaseAmount" min="0" step="0.01" required readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm"
            placeholder="Enter amount released" />
        </div>
        <div>
          <label for="releaseRecipient" class="block text-sm font-medium text-gray-700">Recipient</label>
          <input type="text" id="releaseRecipient" name="releaseRecipient" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Enter recipient name" />
        </div>
        <div>
          <label for="releaseDate" class="block text-sm font-medium text-gray-700">Release Date</label>
          <input type="date" id="releaseDate" name="releaseDate" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
        </div>
        <div>
          <label for="releasePaymentMethod" class="block text-sm font-medium text-gray-700">Payment Method</label>
          <select id="releasePaymentMethod" name="releasePaymentMethod" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
            <option value="">Select payment method</option>
            <option value="Cash">Cash</option>
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="Check">Check</option>
          </select>
        </div>
        <div>
          <label for="releaseReferenceNumber" class="block text-sm font-medium text-gray-700">Reference Number</label>
          <input type="text" id="releaseReferenceNumber" name="releaseReferenceNumber"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Enter reference number (optional for cash)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Acknowledgement Receipt</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-600">
                <label for="releaseProofOfRelease" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                  <span>Upload Acknowledgement Receipt</span>
                  <input id="releaseProofOfRelease" name="releaseProofOfRelease" type="file" accept="image/png,image/jpeg" class="sr-only" />
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs text-gray-500">PNG, JPG up to 10MB</p>
            </div>
          </div>
          <div id="releaseProofOfReleasePreview" class="mt-2"></div>
        </div>
        <div>
          <label for="releasePurpose" class="block text-sm font-medium text-gray-700">Purpose</label>
          <textarea id="releasePurpose" name="releasePurpose" rows="4" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Describe the purpose of the budget release"></textarea>
        </div>
        <div>
          <label for="releaseApprovalNotes" class="block text-sm font-medium text-gray-700">Approval Notes</label>
          <textarea id="releaseApprovalNotes" name="releaseApprovalNotes" rows="4"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Enter any approval notes (optional)"></textarea>
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeReleaseBudgetModal()"
            class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Cancel
          </button>
          <button type="submit"
            class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Submit Budget Release
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Added new modal for Transaction Details (for payroll and fee entries) -->
<div id="transactionDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
      <h3 class="text-lg font-medium text-gray-900">Budget Release Details</h3>
      <button onclick="closeTransactionDetailsModal()" class="text-gray-400 hover:text-gray-500">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-6">
      <form id="transactionDetailsForm" class="space-y-6">
        <div>
          <label for="transDetailParticulars" class="block text-sm font-medium text-gray-700">Particulars</label>
          <input type="text" id="transDetailParticulars" name="transDetailParticulars" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label for="transDetailDate" class="block text-sm font-medium text-gray-700">Date</label>
          <input type="date" id="transDetailDate" name="transDetailDate" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label for="transDetailType" class="block text-sm font-medium text-gray-700">Transaction Type</label>
          <input type="text" id="transDetailType" name="transDetailType" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label for="transDetailPayer" class="block text-sm font-medium text-gray-700">Name of Payer</label>
          <input type="text" id="transDetailPayer" name="transDetailPayer" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label for="transDetailReceiver" class="block text-sm font-medium text-gray-700">Name of Receiver</label>
          <input type="text" id="transDetailReceiver" name="transDetailReceiver" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label for="transDetailPaymentMethod" class="block text-sm font-medium text-gray-700">Payment Method</label>
          <input type="text" id="transDetailPaymentMethod" name="transDetailPaymentMethod" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label for="transDetailReferenceNumber" class="block text-sm font-medium text-gray-700">Reference Number</label>
          <input type="text" id="transDetailReferenceNumber" name="transDetailReferenceNumber" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Acknowledgement Receipt</label>
          <div id="transDetailAcknowledgementPreview" class="mt-2"></div>
        </div>
        <div>
          <label for="transDetailRemarks" class="block text-sm font-medium text-gray-700">Remarks</label>
          <textarea id="transDetailRemarks" name="transDetailRemarks" rows="4" readonly
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm"></textarea>
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeTransactionDetailsModal()"
            class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Close
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    // Added transactions array to store transaction data
    let transactions = [];

    // Simulated in-memory data store for project proposals
    let projectProposals = [
      {
        id: 1,
        projectTitle: "Basketball Court Renovation",
        description: "Repainting and installing new hoops and benches",
        startDate: "2025-03-01",
        targetCompletion: "2025-04-01",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "Paint: ₱15,000, Hoops: ₱20,000, Benches: ₱10,000",
        estimatedBudget: "45000",
        status: "Past Due",
        projectProposalDoc: "court_design.jpg",
        signedResolutionFile: null,
        auditFile: "basketball_audit.pdf",
        notes: "",
        hasPost: false,
        budgetReleased: {
          projectId: 1,
          projectTitle: "Basketball Court Renovation",
          amountReleased: "45000",
          recipient: "John Doe Contracting",
          releaseDate: "2025-03-15",
          paymentMethod: "Bank Transfer",
          referenceNumber: "TXN123456",
          proofOfRelease: "payment_proof.jpg",
          purpose: "Initial payment for court renovation materials including paint, hoops, and benches",
          approvalNotes: "First installment for basketball court renovation project approved by board"
        }
      },
      {
        id: 2,
        projectTitle: "Parking Lot Expansion",
        description: "Expanding parking spaces near the clubhouse",
        startDate: "2025-05-01",
        targetCompletion: "2025-08-15",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "Pavement: ₱30,000, Markings: ₱20,000",
        estimatedBudget: "50000",
        status: "Approved",
        projectProposalDoc: null,
        signedResolutionFile: null,
        auditFile: null,
        notes: "",
        hasPost: false,
        budgetReleased: null
      },
      {
        id: 3,
        projectTitle: "Street Lighting Upgrade",
        description: "Replacing old street lights with energy-efficient LED lights",
        startDate: "2023-03-15",
        targetCompletion: "2023-04-20",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "LED Lights: ₱60,000, Installation: ₱20,000, Permits: ₱5,000",
        estimatedBudget: "85000",
        status: "Completed",
        projectProposalDoc: "lighting_plan.pdf",
        signedResolutionFile: "signed_lighting_res.pdf",
        auditFile: "lighting_audit.pdf",
        notes: "",
        hasPost: true,
        budgetReleased: {
          projectId: 3,
          projectTitle: "Street Lighting Upgrade",
          amountReleased: "85000",
          recipient: "BrightFuture Ltd.",
          releaseDate: "2023-03-20",
          paymentMethod: "Bank Transfer",
          referenceNumber: "CHK789012",
          proofOfRelease: "check_scan.jpg",
          purpose: "Full payment for LED lights, installation, and permits for street lighting upgrade",
          approvalNotes: "Final payment for street lighting upgrade project completed successfully"
        }
      },
      {
        id: 4,
        projectTitle: "Community Garden Setup",
        description: "Creating a community garden for residents",
        startDate: "2025-01-15",
        targetCompletion: "2025-06-30",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "Seeds: ₱5,000, Tools: ₱15,000, Soil: ₱10,000",
        estimatedBudget: "30000",
        status: "Ongoing",
        projectProposalDoc: "garden_plan.pdf",
        signedResolutionFile: null,
        auditFile: "garden_audit.pdf",
        notes: "",
        hasPost: false,
        budgetReleased: {
          projectId: 4,
          projectTitle: "Community Garden Setup",
          amountReleased: "30000",
          recipient: "GreenThumb Supplies",
          releaseDate: "2025-01-20",
          paymentMethod: "Cash",
          referenceNumber: "",
          proofOfRelease: "receipt_scan.jpg",
          purpose: "Purchase of seeds, gardening tools, and soil for community garden project",
          approvalNotes: "Initial purchase for community garden project approved"
        }
      },
      {
        id: 5,
        projectTitle: "Admin Payroll - Month of August",
        description: "Monthly payroll for administrative staff",
        startDate: "2025-08-01",
        targetCompletion: "2025-08-31",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "Salaries: ₱50,000",
        estimatedBudget: "50000",
        status: "Approved",
        projectProposalDoc: null,
        signedResolutionFile: null,
        auditFile: null,
        notes: "",
        hasPost: false,
        budgetReleased: {
          projectId: 5,
          projectTitle: "Admin Payroll - Month of August",
          amountReleased: "50000",
          recipient: "Administrative Staff",
          releaseDate: "2025-08-05",
          paymentMethod: "Bank Transfer",
          referenceNumber: "PAY082025",
          proofOfRelease: "payroll_receipt_august.pdf",
          purpose: "Monthly salary payment for administrative staff for August 2025",
          approvalNotes: "August 2025 payroll disbursement completed"
        }
      },
      {
        id: 6,
        projectTitle: "Electricity & Garbage Fee",
        description: "Monthly utility and garbage collection fees",
        startDate: "2025-09-01",
        targetCompletion: "2025-09-30",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "Electricity: ₱25,000, Garbage: ₱10,000",
        estimatedBudget: "35000",
        status: "Pending",
        projectProposalDoc: null,
        signedResolutionFile: null,
        auditFile: null,
        notes: "",
        hasPost: false,
        budgetReleased: {
          projectId: 6,
          projectTitle: "Electricity & Garbage Fee",
          amountReleased: "35000",
          recipient: "Utility Service Providers",
          releaseDate: "2025-09-10",
          paymentMethod: "GCASH",
          referenceNumber: "UTIL092025",
          proofOfRelease: "utility_receipt_sept.pdf",
          purpose: "Payment for electricity and garbage collection services for September 2025",
          approvalNotes: "September 2025 utility payments pending approval"
        }
      },
      {
        id: 7,
        projectTitle: "Admin Payroll - Month of October 2025",
        description: "Monthly payroll for administrative staff",
        startDate: "2025-10-01",
        targetCompletion: "2025-10-31",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "Salaries: ₱50,000",
        estimatedBudget: "50000",
        status: "Completed",
        projectProposalDoc: null,
        signedResolutionFile: null,
        auditFile: "payroll_audit_october.pdf",
        notes: "",
        hasPost: false,
        budgetReleased: {
          projectId: 7,
          projectTitle: "Admin Payroll - Month of October 2025",
          amountReleased: "50000",
          recipient: "Administrative Staff",
          releaseDate: "2025-10-05",
          paymentMethod: "Bank Transfer",
          referenceNumber: "PAY102025",
          proofOfRelease: "payroll_receipt_october.pdf",
          purpose: "Monthly salary payment for administrative staff for October 2025",
          approvalNotes: "October 2025 payroll disbursement completed"
        }
      }
    ];

    // Simulated in-memory data store for budget releases
    let budgetReleases = [
      {
        projectId: 1,
        projectTitle: "Basketball Court Renovation",
        amountReleased: "45000",
        recipient: "John Doe Contracting",
        releaseDate: "2025-03-15",
        paymentMethod: "Bank Transfer",
        referenceNumber: "TXN123456",
        proofOfRelease: "payment_proof.jpg",
        purpose: "Initial payment for court renovation materials including paint, hoops, and benches",
        approvalNotes: "First installment for basketball court renovation project approved by board"
      },
      {
        projectId: 3,
        projectTitle: "Street Lighting Upgrade",
        amountReleased: "85000",
        recipient: "BrightFuture Ltd.",
        releaseDate: "2023-03-20",
        paymentMethod: "Bank Transfer",
        referenceNumber: "CHK789012",
        proofOfRelease: "check_scan.jpg",
        purpose: "Full payment for LED lights, installation, and permits for street lighting upgrade",
        approvalNotes: "Final payment for street lighting upgrade project completed successfully"
      },
      {
        projectId: 4,
        projectTitle: "Community Garden Setup",
        amountReleased: "30000",
        recipient: "GreenThumb Supplies",
        releaseDate: "2025-01-20",
        paymentMethod: "Cash",
        referenceNumber: "",
        proofOfRelease: "receipt_scan.jpg",
        purpose: "Purchase of seeds, gardening tools, and soil for community garden project",
        approvalNotes: "Initial purchase for community garden project approved"
      },
      {
        projectId: 5,
        projectTitle: "Admin Payroll - Month of August",
        amountReleased: "50000",
        recipient: "Administrative Staff",
        releaseDate: "2025-08-05",
        paymentMethod: "Bank Transfer",
        referenceNumber: "PAY082025",
        proofOfRelease: "payroll_receipt_august.pdf",
        purpose: "Monthly salary payment for administrative staff for August 2025",
        approvalNotes: "August 2025 payroll disbursement completed"
      },
      {
        projectId: 6,
        projectTitle: "Electricity & Garbage Fee",
        amountReleased: "35000",
        recipient: "Utility Service Providers",
        releaseDate: "2025-09-10",
        paymentMethod: "GCASH",
        referenceNumber: "UTIL092025",
        proofOfRelease: "utility_receipt_sept.pdf",
        purpose: "Payment for electricity and garbage collection services for September 2025",
        approvalNotes: "September 2025 utility payments pending approval"
      }
    ];

    let filteredProposals = [];

    document.addEventListener('DOMContentLoaded', function() {
      const boardResolutionForm = document.getElementById('boardResolutionForm');
      const viewProjectForm = document.getElementById('viewProjectForm');
      const projectPostForm = document.getElementById('projectPostForm');
      const budgetReleasedForm = document.getElementById('budgetReleasedForm');
      const releaseBudgetForm = document.getElementById('releaseBudgetForm');
      const addTransactionForm = document.getElementById('addTransactionForm');
      const searchInput = document.getElementById('search');
      const statusFilter = document.getElementById('statusFilter');
      const typeFilter = document.getElementById('typeFilter');
      const postImageInput = document.getElementById('postImages');
      const projectProposalDocInput = document.getElementById('projectProposalDoc');
      const signedResolutionInput = document.getElementById('signedResolution');
      const auditFileInput = document.getElementById('auditFile');
      const viewProjectProposalDocInput = document.getElementById('viewProjectProposalDoc');
      const viewSignedResolutionInput = document.getElementById('viewSignedResolution');
      const viewAuditFileInput = document.getElementById('viewAuditFile');
      const releaseProofOfReleaseInput = document.getElementById('releaseProofOfRelease');
      const transactionAcknowledgementInput = document.getElementById('transactionAcknowledgement');

      // Filter and search event listeners
      searchInput.addEventListener('input', filterProposals);
      statusFilter.addEventListener('change', filterProposals);
      typeFilter.addEventListener('change', filterProposals);

      // Initialize filtered proposals and render
      filteredProposals = projectProposals;
      renderProjectProposals();
    });

    function filterProposals() {
      const searchTerm = document.getElementById('search').value.toLowerCase();
      const statusValue = document.getElementById('statusFilter').value;
      const typeValue = document.getElementById('typeFilter').value;

      filteredProposals = projectProposals.filter(proposal => {
        const matchesSearch = proposal.projectTitle.toLowerCase().includes(searchTerm);
        const matchesStatus = statusValue ? proposal.status === statusValue : true;
        
        let matchesType = true;
        if (typeValue) {
          // A project typically has a projectProposalDoc, while a budget might not.
          // Both must have budgetReleased to be considered a financial transaction.
          const isProject = proposal.projectProposalDoc !== null && proposal.budgetReleased !== null;
          const isBudget = proposal.projectProposalDoc === null && proposal.budgetReleased !== null;
          
          if (typeValue === 'Project') {
            matchesType = isProject;
          } else if (typeValue === 'Budget') {
            matchesType = isBudget;
          }
        }
        
        return matchesSearch && matchesStatus && matchesType;
      });

      renderProjectProposals();
    }

    function handleFileUpload(input, previewId, isImageOnly = false, allowPdf = false) {
      const preview = document.getElementById(previewId);
      preview.innerHTML = '';
      const file = input.files[0];
      if (file) {
        const isValidType = isImageOnly
          ? file.type.match('image/png') || file.type.match('image/jpeg')
          : allowPdf
          ? file.type.match('application/pdf') ||
            file.type.match('image/png') ||
            file.type.match('image/jpeg')
          : file.type.match('application/pdf') ||
            file.type.match('application/msword') ||
            file.type.match('application/vnd.openxmlformats-officedocument.wordprocessingml.document') ||
            file.type.match('image/png') ||
            file.type.match('image/jpeg');

        if (isValidType && file.size <= 10 * 1024 * 1024) {
          if ((isImageOnly || allowPdf) && file.type.match('image.*')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'rounded-lg w-full h-24 object-cover';
            preview.appendChild(img);
          } else {
            const div = document.createElement('div');
            const icon = file.type.match('image/') ? 'fas fa-image' : 'fas fa-file-alt';
            div.innerHTML = `<i class="${icon} mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${file.name}</span>`;
            div.className = 'flex items-center';
            preview.appendChild(div);
          }
        } else {
          alert(`Please upload ${isImageOnly ? 'PNG or JPG images' : allowPdf ? 'PNG, JPG, or PDF files' : 'valid files'} under 10MB.`);
          input.value = '';
          preview.innerHTML = '';
        }
      }
    }

    function renderProjectProposals(proposals = null) {
      const tbody = document.getElementById('proposalsTableBody');
      tbody.innerHTML = '';

      const proposalsToRender = proposals || filteredProposals;

      if (!proposalsToRender || proposalsToRender.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No project proposals found.</td></tr>`;
        return;
      }

      proposalsToRender.forEach(proposal => {
        const statusMap = {
          Ongoing: 'bg-yellow-100 text-yellow-800',
          Pending: 'bg-blue-100 text-blue-800',
          Completed: 'bg-green-100 text-green-800',
          Approved: 'bg-teal-100 text-teal-800',
          'Past Due': 'bg-orange-100 text-orange-800'
        };
        const statusColor = statusMap[proposal.status] || 'bg-gray-100 text-gray-800';
        const isCompletedWithPost = proposal.status === 'Completed' && proposal.hasPost;
        const showBudgetReleasedButton = ['Ongoing', 'Past Due', 'Completed', 'Approved', 'Pending'].includes(proposal.status) && proposal.budgetReleased;
        const isApproved = proposal.status === 'Approved';
        const showViewButton = proposal.id !== 5 && proposal.id !== 6 && proposal.id !== 7; // Exclude specific payroll/fee entries from detailed view
        
        const isTransactionBased = [5, 6, 7].includes(proposal.id);

        tbody.innerHTML += `
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">${proposal.projectTitle}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusColor}">
                ${proposal.status}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              ${showViewButton ? `
                <div class="flex space-x-2">
                  <button onclick="openViewProjectModal(${proposal.id})"
                    class="bg-teal-600 hover:bg-teal-700 text-white py-1 px-3 rounded-md text-sm inline-flex items-center justify-center w-20">
                    View
                  </button>
                </div>
              ` : ''}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              ${showBudgetReleasedButton ? `
                <div class="inline-block">
                  <button onclick="${isTransactionBased ? `openTransactionDetailsModal(${proposal.id})` : `openBudgetReleasedModal(${proposal.id})`}"
                    class="bg-teal-600 hover:bg-teal-700 text-white py-1 px-3 rounded-md text-sm inline-flex items-center justify-center w-20">
                    View
                  </button>
                </div>
              ` : isApproved && !proposal.budgetReleased ? `
                <div class="inline-block">
                  <button onclick="openReleaseBudgetModal(${proposal.id})"
                    class="bg-teal-600 hover:bg-teal-700 text-white py-1 px-3 rounded-md text-sm inline-flex items-center justify-center w-20">
                    Release
                  </button>
                </div>
              ` : ''}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              ${proposal.auditFile ? `
                <div class="inline-block">
                  <button onclick="openAuditFileModal('${proposal.auditFile}')"
                    class="bg-teal-600 hover:bg-teal-700 text-white py-1 px-3 rounded-md text-sm inline-flex items-center justify-center w-20">
                    View
                  </button>
                </div>
              ` : ''}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              ${isCompletedWithPost ? `
                <div class="inline-block">
                  <a href="sec-newsfeed.html"
                    class="bg-teal-600 hover:bg-teal-700 text-white py-1 px-3 rounded-md text-sm inline-flex items-center justify-center w-28">
                    View Post
                  </a>
                </div>
              ` : ''}
            </td>
          </tr>
        `;
      });
    }

    function openBoardResolutionModal() {
      document.getElementById('boardResolutionModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeBoardResolutionModal() {
      document.getElementById('boardResolutionModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('boardResolutionForm').reset();
      document.getElementById('projectProposalPreview').innerHTML = '';
      document.getElementById('signedResolutionPreview').innerHTML = '';
      document.getElementById('auditFilePreview').innerHTML = '';
    }

    function openViewProjectModal(projectId) {
      const proposal = projectProposals.find(p => p.id === projectId);
      if (proposal) {
        document.getElementById('viewProjectId').value = projectId;
        document.getElementById('viewResolutionTitle').value = proposal.projectTitle;
        document.getElementById('viewResolutionSummary').value = proposal.description;
        document.getElementById('viewEstimatedBudget').value = proposal.estimatedBudget;
        document.getElementById('viewResolutionStartDate').value = proposal.startDate;
        document.getElementById('viewResolutionTargetCompletion').value = proposal.targetCompletion;
        document.getElementById('viewResolutionProposedBy').value = proposal.proposedBy;

        const projectProposalPreview = document.getElementById('viewProjectProposalPreview');
        const signedResolutionPreview = document.getElementById('viewSignedResolutionPreview');
        const auditFileSection = document.getElementById('viewAuditFileSection');
        const auditFilePreview = document.getElementById('viewAuditFilePreview');

        projectProposalPreview.innerHTML = proposal.projectProposalDoc
          ? `<div class="flex items-center"><i class="fas ${proposal.projectProposalDoc.match(/\.(jpg|jpeg|png)$/i) ? 'fa-image' : 'fa-file-alt'} mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.projectProposalDoc}</span></div>`
          : '';
        signedResolutionPreview.innerHTML = proposal.signedResolutionFile
          ? `<div class="flex items-center"><i class="fas ${proposal.signedResolutionFile.match(/\.(jpg|jpeg|png)$/i) ? 'fa-image' : 'fa-file-alt'} mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.signedResolutionFile}</span></div>`
          : '';

        // Hide audit file section for specific projects
        const specificProjects = ["Community Garden Setup", "Street Lighting Upgrade", "Parking Lot Expansion", "Basketball Court Renovation"];
        if (specificProjects.includes(proposal.projectTitle)) {
          auditFileSection.style.display = 'none';
          auditFilePreview.innerHTML = '';
        } else {
          auditFileSection.style.display = 'block';
          auditFilePreview.innerHTML = proposal.auditFile
            ? `<div class="flex items-center"><i class="fas ${proposal.auditFile.match(/\.(jpg|jpeg|png)$/i) ? 'fa-image' : 'fa-file-alt'} mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.auditFile}</span></div>`
            : '';
        }

        document.getElementById('viewProjectModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }
    }

    function closeViewProjectModal() {
      document.getElementById('viewProjectModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('viewProjectForm').reset();
      document.getElementById('viewProjectProposalPreview').innerHTML = '';
      document.getElementById('viewSignedResolutionPreview').innerHTML = '';
      document.getElementById('viewAuditFilePreview').innerHTML = '';
      document.getElementById('viewAuditFileSection').style.display = 'block';
    }

    function openNotesModal(notes) {
      document.getElementById('notesContent').innerText = notes || 'No notes available.';
      document.getElementById('notesModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeNotesModal() {
      document.getElementById('notesModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    function openProjectPostModal(projectId) {
      const projectPostForm = document.getElementById('projectPostForm');
      projectPostForm.dataset.projectId = projectId;
      const proposal = projectProposals.find(p => p.id === parseInt(projectId));
      if (proposal) {
        document.getElementById('postProjectTitle').value = proposal.projectTitle;
        document.getElementById('postDescription').value = proposal.description;
      }
      document.getElementById('projectPostModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeProjectPostModal() {
      document.getElementById('projectPostModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('projectPostForm').reset();
      document.getElementById('postImagePreview').innerHTML = '';
    }

    function openAuditFileModal(fileName) {
      const auditFileContent = document.getElementById('auditFileContent');
      auditFileContent.innerHTML = fileName
        ? `<div class="flex items-center"><i class="fas ${fileName.match(/\.(jpg|jpeg|png)$/i) ? 'fa-image' : 'fa-file-alt'} mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${fileName}</span></div>`
        : 'No audit file available.';
      document.getElementById('auditFileModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeAuditFileModal() {
      document.getElementById('auditFileModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    function openBudgetReleasedModal(projectId) {
      const budgetReleasedForm = document.getElementById('budgetReleasedForm');
      budgetReleasedForm.dataset.projectId = projectId;
      const proposal = projectProposals.find(p => p.id === parseInt(projectId));
      if (proposal && proposal.budgetReleased) {
        document.getElementById('budgetProjectTitle').value = proposal.budgetReleased.projectTitle;
        document.getElementById('budgetAmountReleased').value = proposal.budgetReleased.amountReleased;
        document.getElementById('budgetRecipient').value = proposal.budgetReleased.recipient;
        document.getElementById('budgetReleaseDate').value = proposal.budgetReleased.releaseDate;
        document.getElementById('budgetPaymentMethod').value = proposal.budgetReleased.paymentMethod;
        document.getElementById('budgetReferenceNumber').value = proposal.budgetReleased.referenceNumber;
        document.getElementById('budgetPurpose').value = proposal.budgetReleased.purpose;
        document.getElementById('budgetApprovalNotes').value = proposal.budgetReleased.approvalNotes;

        const acknowledgementPreview = document.getElementById('budgetAcknowledgementPreview');
        acknowledgementPreview.innerHTML = proposal.budgetReleased.proofOfRelease
          ? `<div class="flex items-center"><i class="fas ${proposal.budgetReleased.proofOfRelease.match(/\.(jpg|jpeg|png)$/i) ? 'fa-image' : 'fa-file-alt'} mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.budgetReleased.proofOfRelease}</span></div>`
          : '';
      }
      document.getElementById('budgetReleasedModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeBudgetReleasedModal() {
      document.getElementById('budgetReleasedModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('budgetReleasedForm').reset();
      document.getElementById('budgetAcknowledgementPreview').innerHTML = '';
    }

    function openReleaseBudgetModal(projectId) {
      const releaseBudgetForm = document.getElementById('releaseBudgetForm');
      releaseBudgetForm.dataset.projectId = projectId;
      const proposal = projectProposals.find(p => p.id === parseInt(projectId));
      if (proposal) {
        document.getElementById('releaseProjectTitle').value = proposal.projectTitle;
        document.getElementById('releaseAmount').value = proposal.estimatedBudget;
        document.getElementById('releaseRecipient').value = '';
        document.getElementById('releaseDate').value = '';
        document.getElementById('releasePaymentMethod').value = '';
        document.getElementById('releaseReferenceNumber').value = '';
        document.getElementById('releasePurpose').value = '';
        document.getElementById('releaseApprovalNotes').value = '';
        document.getElementById('releaseProofOfReleasePreview').innerHTML = '';
      }
      document.getElementById('releaseBudgetModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeReleaseBudgetModal() {
      document.getElementById('releaseBudgetModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('releaseBudgetForm').reset();
      document.getElementById('releaseProofOfReleasePreview').innerHTML = '';
    }

    function openAddTransactionModal() {
      document.getElementById('addTransactionModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeAddTransactionModal() {
      document.getElementById('addTransactionModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('addTransactionForm').reset();
      document.getElementById('transactionAcknowledgementPreview').innerHTML = '';
    }

    function openTransactionDetailsModal(projectId) {
      const proposal = projectProposals.find(p => p.id === projectId);
      if (proposal && proposal.budgetReleased) {
        document.getElementById('transDetailParticulars').value = proposal.projectTitle; // Using project title as particulars for these entries
        document.getElementById('transDetailDate').value = proposal.budgetReleased.releaseDate;
        document.getElementById('transDetailType').value = proposal.budgetReleased.paymentMethod; // Using payment method as type for these entries
        document.getElementById('transDetailPayer').value = 'HOA';
        document.getElementById('transDetailReceiver').value = proposal.budgetReleased.recipient;
        document.getElementById('transDetailPaymentMethod').value = proposal.budgetReleased.paymentMethod;
        document.getElementById('transDetailReferenceNumber').value = proposal.budgetReleased.referenceNumber;
        document.getElementById('transDetailRemarks').value = proposal.budgetReleased.purpose;

        const acknowledgementPreview = document.getElementById('transDetailAcknowledgementPreview');
        acknowledgementPreview.innerHTML = proposal.budgetReleased.proofOfRelease
          ? `<div class="flex items-center"><i class="fas ${proposal.budgetReleased.proofOfRelease.match(/\.(jpg|jpeg|png)$/i) ? 'fa-image' : 'fa-file-alt'} mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.budgetReleased.proofOfRelease}</span></div>`
          : '';
      }
      document.getElementById('transactionDetailsModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeTransactionDetailsModal() {
      document.getElementById('transactionDetailsModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('transactionDetailsForm').reset();
      document.getElementById('transDetailAcknowledgementPreview').innerHTML = '';
    }
</script>
</body>
</html>
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
      <a href="admin-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-tachometer-alt mr-3"></i>
        <span>Dashboard</span>
      </a>
      <a href="admin-accounts.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-users mr-3"></i>
        <span>User Management</span>
      </a>
      <a href="admin-residents.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-user-slash mr-2"></i>
        <span>Homeowners with No Accounts</span>
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


      <a href="admin-hoaprojects.php" class="flex items-center px-6 py-3 bg-teal-700">
        <i class="fas fa-gavel mr-3"></i>
        <span>Resolution</span>
      </a>
      <a href="admin-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-book mr-3"></i>
        <span>Ledger</span>
      </a>
      <a href="admin-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
      <!-- Project Proposals Section -->
      <div id="project-proposals" class="mb-8">
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
                <!-- Proposals will be rendered dynamically -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- Board Resolution Modal -->
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
          <label for="resolutionTitle" class="block text-sm font-medium text-gray-700">Resolution Title</label>
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

<!-- View Project Modal -->
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
        <!-- Removed Upload Audit File section from Project Proposal Details modal -->
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

<!-- Notes Modal -->
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

<!-- Project Post Modal -->
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

<!-- Audit File Modal -->
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

<!-- Budget Released Modal -->
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
        <div id="adminPayrollFields" style="display: none;">
          <div>
            <label for="budgetParticulars" class="block text-sm font-medium text-gray-700">Particulars</label>
            <input type="text" id="budgetParticulars" name="budgetParticulars" required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Enter particulars" />
          </div>
          <br>
          <div>
            <label for="budgetDate" class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" id="budgetDate" name="budgetDate" required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
          </div>
          <br>
          <div>
            <label for="transactionType" class="block text-sm font-medium text-gray-700">Transaction Type</label>
            <select id="transactionType" name="transactionType" required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
              <option value="">Select transaction type</option>
              <option value="Debit">Debit</option>
              <option value="Credit">Credit</option>
              <option value="Transfer">Transfer</option>
            </select>
          </div>
          <br>
          <div>
            <label for="nameOfPayer" class="block text-sm font-medium text-gray-700">Name of Payer</label>
            <input type="text" id="nameOfPayer" name="nameOfPayer" required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Enter payer name" />
          </div>
          <br>
          <div>
            <label for="nameOfReceiver" class="block text-sm font-medium text-gray-700">Name of Receiver</label>
            <input type="text" id="nameOfReceiver" name="nameOfReceiver" required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Enter receiver name" />
          </div>
          <br>
          <div>
            <label for="paymentMethod" class="block text-sm font-medium text-gray-700">Payment Method</label>
            <select id="paymentMethod" name="paymentMethod" required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
              <option value="">Select payment method</option>
              <option value="Cash">Cash</option>
              <option value="Bank Transfer">Bank Transfer</option>
              <option value="Check">Check</option>
              <option value="Credit Card">Credit Card</option>
            </select>
          </div>
          <br>
          <div>
            <label for="referenceNumber" class="block text-sm font-medium text-gray-700">Reference Number</label>
            <input type="text" id="referenceNumber" name="referenceNumber"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Enter reference number" />
          </div>
          <br>
          <div>
            <label class="block text-sm font-medium text-gray-700">Acknowledgement Receipt</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
              <div class="space-y-1 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                  <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="flex text-sm text-gray-600">
                  <label for="acknowledgementReceipt" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                    <span>Upload acknowledgement receipt</span>
                    <input id="acknowledgementReceipt" name="acknowledgementReceipt" type="file" accept="image/png,image/jpeg,application/pdf" class="sr-only" />
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
              </div>
            </div>
            <div id="acknowledgementReceiptPreview" class="mt-2"></div>
          </div>
          <br>
          <div>
            <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
            <textarea id="remarks" name="remarks" rows="4"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Enter any remarks (optional)"></textarea>
          </div>
        </div>

        <div id="otherProjectFields" style="display: none;">
          <!-- Added Project Title field at the beginning -->
          <div>
            <label for="projectTitle" class="block text-sm font-medium text-gray-700">Project Title</label>
            <input type="text" id="projectTitle" name="projectTitle" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
          </div>
          <br>
          <div>
            <label for="amountReleased" class="block text-sm font-medium text-gray-700">Amount Released</label>
            <input type="number" id="amountReleased" name="amountReleased" min="0" step="0.01"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Enter amount released" />
          </div>
          <br>
          <div>
            <label for="recipient" class="block text-sm font-medium text-gray-700">Recipient</label>
            <input type="text" id="recipient" name="recipient"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Enter recipient name" />
          </div>
          <br>
          <div>
            <label for="releaseDate" class="block text-sm font-medium text-gray-700">Release Date</label>
            <input type="date" id="releaseDate" name="releaseDate"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
          </div>
          <br>
          <div>
            <label for="oldPaymentMethod" class="block text-sm font-medium text-gray-700">Payment Method</label>
            <input type="text" id="oldPaymentMethod" name="oldPaymentMethod"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Enter payment method" />
          </div>
          <br>
          <div>
            <label for="oldReferenceNumber" class="block text-sm font-medium text-gray-700">Reference Number</label>
            <input type="text" id="oldReferenceNumber" name="oldReferenceNumber"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Enter reference number" />
          </div><br>
          <!-- Replaced "Proof of Release" with "Acknowledgement Receipt" -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Acknowledgement Receipt</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
              <div class="space-y-1 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                  <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="flex text-sm text-gray-600">
                  <label for="projectAcknowledgementReceipt" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                    <span>Upload acknowledgement receipt</span>
                    <input id="projectAcknowledgementReceipt" name="projectAcknowledgementReceipt" type="file" accept="image/png,image/jpeg,application/pdf" class="sr-only" />
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
              </div>
            </div>
            <div id="projectAcknowledgementReceiptPreview" class="mt-2"></div>
          </div><br>
          <div>
            <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose</label>
            <textarea id="purpose" name="purpose" rows="4"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Enter purpose"></textarea>
          </div>
          <br>
          <div>
            <label for="approvalNotes" class="block text-sm font-medium text-gray-700">Approval Notes</label>
            <textarea id="approvalNotes" name="approvalNotes" rows="4"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Enter approval notes"></textarea>
          </div>
        </div>

        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeBudgetReleasedModal()"
            class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Close
          </button>
          <!-- Submit button now only shows for Admin Payroll (project id 8) -->
          <button id="submitBudgetBtn" type="submit"
            class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Submit Budget Release
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    let projectProposals = [
      {
        id: 8,
        projectTitle: "Admin Payroll - Month of October 2025",
        description: "Administrative payroll for October 2025",
        startDate: "2025-10-01",
        targetCompletion: "2025-10-31",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "N/A",
        estimatedBudget: "0",
        status: "Completed",
        projectProposalDoc: null,
        signedResolutionFile: null,
        auditFile: "admin_payroll_oct_2025.pdf",
        notes: "",
        hasPost: false,
        hasProjectDetails: false,
        budgetReleased: {
          projectId: 8,
          projectTitle: "Admin Payroll - Month of October 2025",
          particulars: "October 2025 Payroll",
          date: "2025-10-31",
          transactionType: "Debit",
          nameOfPayer: "HOA Treasurer",
          nameOfReceiver: "Admin Staff",
          paymentMethod: "Bank Transfer",
          referenceNumber: "TXN202510001",
          acknowledgementReceipt: "payroll_receipt_oct.pdf",
          remarks: "Monthly administrative payroll processed"
        }
      },
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
        hasProjectDetails: true,
        budgetReleased: {
          projectId: 1,
          projectTitle: "Basketball Court Renovation",
          amountReleased: "20000",
          recipient: "John Doe Contracting",
          releaseDate: "2025-03-15",
          paymentMethod: "Bank Transfer",
          referenceNumber: "TXN123456",
          proofOfRelease: "payment_proof.jpg",
          purpose: "Initial payment for repainting and materials",
          approvalNotes: "Approved by treasurer on 2025-03-14"
        }
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
        hasProjectDetails: true,
        budgetReleased: {
          projectId: 3,
          projectTitle: "Street Lighting Upgrade",
          amountReleased: "85000",
          recipient: "BrightFuture Ltd.",
          releaseDate: "2023-03-20",
          paymentMethod: "Check",
          referenceNumber: "CHK789012",
          proofOfRelease: "check_scan.jpg",
          purpose: "Full payment for LED lights and installation",
          approvalNotes: "Final approval by board"
        }
      },
      {
        id: 5,
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
        hasProjectDetails: true,
        budgetReleased: {
          projectId: 5,
          projectTitle: "Community Garden Setup",
          amountReleased: "15000",
          recipient: "GreenThumb Supplies",
          releaseDate: "2025-01-20",
          paymentMethod: "Cash",
          referenceNumber: "",
          proofOfRelease: "receipt_scan.jpg",
          purpose: "Purchase of seeds and tools",
          approvalNotes: ""
        }
      },
      {
        id: 6,
        projectTitle: "Clubhouse Renovation",
        description: "Upgrading clubhouse facilities with new furniture and lighting",
        startDate: "2024-06-01",
        targetCompletion: "2024-08-15",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "Furniture: ₱40,000, Lighting: ₱25,000, Decor: ₱10,000",
        estimatedBudget: "75000",
        status: "Completed",
        projectProposalDoc: "clubhouse_plan.pdf",
        signedResolutionFile: "signed_clubhouse_res.pdf",
        auditFile: "clubhouse_audit.pdf",
        notes: "",
        hasPost: true,
        hasProjectDetails: true,
        budgetReleased: {
          projectId: 6,
          projectTitle: "Clubhouse Renovation",
          amountReleased: "75000",
          recipient: "HomeStyle Interiors",
          releaseDate: "2024-06-10",
          paymentMethod: "Bank Transfer",
          referenceNumber: "TXN456789",
          proofOfRelease: "payment_clubhouse.jpg",
          purpose: "Full payment for clubhouse renovation",
          approvalNotes: "Approved by board on 2024-06-05"
        }
      },
      {
        id: 7,
        projectTitle: "Playground Equipment Upgrade",
        description: "Installing new playground equipment for children",
        startDate: "2024-09-01",
        targetCompletion: "2024-10-30",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "Equipment: ₱50,000, Installation: ₱15,000",
        estimatedBudget: "65000",
        status: "Completed",
        projectProposalDoc: "playground_plan.pdf",
        signedResolutionFile: "signed_playground_res.pdf",
        auditFile: "playground_audit.pdf",
        notes: "",
        hasPost: true,
        hasProjectDetails: true,
        budgetReleased: {
          projectId: 7,
          projectTitle: "Playground Equipment Upgrade",
          amountReleased: "65000",
          recipient: "PlaySafe Inc.",
          releaseDate: "2024-09-10",
          paymentMethod: "Check",
          referenceNumber: "CHK123456",
          proofOfRelease: "check_playground.jpg",
          purpose: "Full payment for playground equipment and installation",
          approvalNotes: "Final approval by board"
        }
      }
    ];

    let budgetReleases = [];

    document.addEventListener('DOMContentLoaded', function() {
      renderProjectProposals();

      const acknowledgementReceiptInput = document.getElementById('acknowledgementReceipt');
      acknowledgementReceiptInput.addEventListener('change', function() {
        handleFileUpload(this, 'acknowledgementReceiptPreview', true);
      });
    });

    function renderProjectProposals(proposals = projectProposals) {
      const tbody = document.getElementById('proposalsTableBody');
      tbody.innerHTML = '';

      if (!proposals || proposals.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No project proposals found.</td></tr>`;
        return;
      }

      proposals.forEach(proposal => {
        const statusMap = {
          Ongoing: 'bg-yellow-100 text-yellow-800',
          Pending: 'bg-blue-100 text-blue-800',
          Completed: 'bg-green-100 text-green-800',
          'Past Due': 'bg-orange-100 text-orange-800'
        };
        const statusColor = statusMap[proposal.status] || 'bg-gray-100 text-gray-800';
        const isCompletedWithPost = proposal.status === 'Completed' && proposal.hasPost;
        const showBudgetReleasedButton = ['Ongoing', 'Past Due', 'Completed'].includes(proposal.status);
        const showProjectDetailsButton = proposal.hasProjectDetails !== false;

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
              <div class="flex space-x-2">
                ${showProjectDetailsButton ? `
                  <button onclick="openViewProjectModal(${proposal.id})"
                    class="bg-teal-600 hover:bg-teal-700 text-white py-1 px-3 rounded-md text-sm inline-flex items-center justify-center w-20">
                    View
                  </button>
                ` : ''}
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              ${showBudgetReleasedButton && proposal.budgetReleased ? `
                <div class="inline-block">
                  <button onclick="openBudgetReleasedModal(${proposal.id})"
                    class="bg-teal-600 hover:bg-teal-700 text-white py-1 px-3 rounded-md text-sm inline-flex items-center justify-center w-20">
                    View
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

    function openViewProjectModal(projectId) {
      const proposal = projectProposals.find(p => p.id === parseInt(projectId));
      if (proposal) {
        document.getElementById('viewProjectId').value = projectId;
        document.getElementById('viewResolutionTitle').value = proposal.projectTitle;
        document.getElementById('viewResolutionSummary').value = proposal.description;
        document.getElementById('viewEstimatedBudget').value = proposal.estimatedBudget;
        document.getElementById('viewResolutionStartDate').value = proposal.startDate;
        document.getElementById('viewResolutionTargetCompletion').value = proposal.targetCompletion;
        document.getElementById('viewResolutionProposedBy').value = proposal.proposedBy;
      }
      document.getElementById('viewProjectModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeViewProjectModal() {
      document.getElementById('viewProjectModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    function openAuditFileModal(auditFileName) {
      const auditFileContent = document.getElementById('auditFileContent');
      auditFileContent.innerHTML = `<p class="text-sm text-gray-600">Audit File: <strong>${auditFileName}</strong></p>`;
      document.getElementById('auditFileModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeAuditFileModal() {
      document.getElementById('auditFileModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    function closeNotesModal() {
      document.getElementById('notesModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    function openProjectPostModal() {
      document.getElementById('projectPostModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeProjectPostModal() {
      document.getElementById('projectPostModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    function openBudgetReleasedModal(projectId) {
      const budgetReleasedForm = document.getElementById('budgetReleasedForm');
      budgetReleasedForm.dataset.projectId = projectId;
      const proposal = projectProposals.find(p => p.id === parseInt(projectId));
      
      const isAdminPayroll = projectId === 8;
      const adminPayrollFields = document.getElementById('adminPayrollFields');
      const otherProjectFields = document.getElementById('otherProjectFields');
      const submitBudgetBtn = document.getElementById('submitBudgetBtn');

      if (isAdminPayroll) {
        adminPayrollFields.style.display = 'block';
        otherProjectFields.style.display = 'none';
        submitBudgetBtn.style.display = 'none';
        
        if (proposal && proposal.budgetReleased) {
          document.getElementById('budgetParticulars').value = proposal.budgetReleased.particulars || '';
          document.getElementById('budgetDate').value = proposal.budgetReleased.date || '';
          document.getElementById('transactionType').value = proposal.budgetReleased.transactionType || '';
          document.getElementById('nameOfPayer').value = proposal.budgetReleased.nameOfPayer || '';
          document.getElementById('nameOfReceiver').value = proposal.budgetReleased.nameOfReceiver || '';
          document.getElementById('paymentMethod').value = proposal.budgetReleased.paymentMethod || '';
          document.getElementById('referenceNumber').value = proposal.budgetReleased.referenceNumber || '';
          document.getElementById('remarks').value = proposal.budgetReleased.remarks || '';

          const acknowledgementReceiptPreview = document.getElementById('acknowledgementReceiptPreview');
          acknowledgementReceiptPreview.innerHTML = proposal.budgetReleased.acknowledgementReceipt
            ? `<div class="flex items-center"><i class="fas ${proposal.budgetReleased.acknowledgementReceipt.match(/\.(jpg|jpeg|png)$/i) ? 'fa-image' : 'fa-file-alt'} mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.budgetReleased.acknowledgementReceipt}</span></div>`
            : '';
        }
      } else {
        adminPayrollFields.style.display = 'none';
        otherProjectFields.style.display = 'block';
        submitBudgetBtn.style.display = 'none';
        
        if (proposal && proposal.budgetReleased) {
          document.getElementById('projectTitle').value = proposal.projectTitle || '';
          document.getElementById('amountReleased').value = proposal.budgetReleased.amountReleased || '';
          document.getElementById('recipient').value = proposal.budgetReleased.recipient || '';
          document.getElementById('releaseDate').value = proposal.budgetReleased.releaseDate || '';
          document.getElementById('oldPaymentMethod').value = proposal.budgetReleased.paymentMethod || '';
          document.getElementById('oldReferenceNumber').value = proposal.budgetReleased.referenceNumber || '';
          document.getElementById('purpose').value = proposal.budgetReleased.purpose || '';
          document.getElementById('approvalNotes').value = proposal.budgetReleased.approvalNotes || '';
        }
      }
      
      document.getElementById('budgetReleasedModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeBudgetReleasedModal() {
      document.getElementById('budgetReleasedModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('budgetReleasedForm').reset();
      document.getElementById('acknowledgementReceiptPreview').innerHTML = '';
    }

    function handleFileUpload(input, previewId, isImage = false) {
      const preview = document.getElementById(previewId);
      if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileName = file.name;
        const fileType = file.type;

        if (isImage && fileType.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="max-w-xs max-h-48 rounded-md" />`;
          };
          reader.readAsDataURL(file);
        } else {
          const icon = fileType.includes('pdf') ? 'fa-file-pdf' : 'fa-file-alt';
          preview.innerHTML = `<div class="flex items-center"><i class="fas ${icon} mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${fileName}</span></div>`;
        }
      }
    }
</script>
</body>
</html>

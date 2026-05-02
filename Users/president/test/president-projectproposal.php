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

    <!--Sidebar-->
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
      <a href="president-projectproposal.php" class="flex items-center px-6 py-3 bg-teal-700">
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
            <button @click="window.location.href='president-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
              <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
              <span class="flex-1 text-left">Tricycle</span>
            </button>
          </div>

           
          <div class="relative">
            <button @click="window.location.href='president-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
              <i class="fas fa-basketball-ball mr-2" title="Court"></i>
              <span class="flex-1 text-left">Court</span>
            </button>
          </div>

           
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
          <label for="viewResolutionTitle" class="block text-sm font-medium text-gray-700">Resolution Title</label>
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
        <div>
          <label for="viewRejectionNotes" class="block text-sm font-medium text-gray-700">Notes for Rejection</label>
          <textarea id="viewRejectionNotes" name="viewRejectionNotes" rows="4"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Enter notes for rejection (required if rejecting)"></textarea>
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeViewProjectModal()"
            class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Close
          </button>
          <button type="submit" onclick="rejectProject()"
            class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            Reject
          </button>
          <button type="submit" onclick="approveProject()"
            class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Approve
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
        <!-- ORIGINAL FIELDS FOR PROJECTS 1-5 -->
        <div id="originalFields" class="space-y-6">
          <div>
            <label for="budgetProjectTitle" class="block text-sm font-medium text-gray-700">Project Title</label>
            <input type="text" id="budgetProjectTitle" name="budgetProjectTitle" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label for="amountReleased" class="block text-sm font-medium text-gray-700">Amount Released</label>
            <input type="number" id="amountReleased" name="amountReleased" min="0" step="0.01" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm"
              placeholder="Enter amount released" />
          </div>
          <div>
            <label for="recipient" class="block text-sm font-medium text-gray-700">Recipient</label>
            <input type="text" id="recipient" name="recipient" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm"
              placeholder="Enter recipient name" />
          </div>
          <div>
            <label for="releaseDate" class="block text-sm font-medium text-gray-700">Release Date</label>
            <input type="date" id="releaseDate" name="releaseDate" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label for="paymentMethod" class="block text-sm font-medium text-gray-700">Payment Method</label>
            <input type="text" id="paymentMethod" name="paymentMethod" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label for="referenceNumber" class="block text-sm font-medium text-gray-700">Reference Number</label>
            <input type="text" id="referenceNumber" name="referenceNumber" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm"
              placeholder="Enter reference number (optional for cash)" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Acknowledgement Receipt</label>
            <div id="proofOfReleasePreview" class="mt-2"></div>
          </div>
          <div>
            <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose</label>
            <textarea id="purpose" name="purpose" rows="4" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm"
              placeholder="Describe the purpose of the budget release"></textarea>
          </div>
          <div>
            <label for="approvalNotes" class="block text-sm font-medium text-gray-700">Approval Notes</label>
            <textarea id="approvalNotes" name="approvalNotes" rows="4" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm"
              placeholder="Enter any approval notes (optional)"></textarea>
          </div>
        </div>

        <!-- NEW FIELDS FOR IDs 6,7,8 -->
        <div id="newFields" class="space-y-6 hidden">
          <div>
            <label class="block text-sm font-medium text-gray-700">Particulars</label>
            <input type="text" id="particulars" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" id="transactionDate" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Transaction Type</label>
            <input type="text" id="transactionType" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Name of Payer</label>
            <input type="text" id="payerName" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Name of Receiver</label>
            <input type="text" id="receiverName" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Payment Method</label>
            <input type="text" id="paymentMethodNew" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Reference Number</label>
            <input type="text" id="referenceNumberNew" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Acknowledgement Receipt</label>
            <div id="acknowledgementPreview" class="mt-2"></div>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Remarks</label>
            <textarea id="remarks" rows="4" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm"></textarea>
          </div>
        </div>

        <div>
          <label for="rejectionNotes" class="block text-sm font-medium text-gray-700">Notes for Rejection</label>
          <textarea id="rejectionNotes" name="rejectionNotes" rows="4"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
            placeholder="Enter notes for rejection (required if rejecting)"></textarea>
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeBudgetReleasedModal()"
            class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Close
          </button>
          <button type="button" onclick="rejectBudgetRelease()"
            class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            Reject
          </button>
          <button type="button" onclick="approveBudgetRelease()"
            class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Approve
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    let filteredProposals = [];

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
        id: 2,
        projectTitle: "Parking Lot Expansion",
        description: "Expanding parking spaces near the clubhouse",
        startDate: "2025-05-01",
        targetCompletion: "2025-08-15",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "Pavement: ₱30,000, Markings: ₱20,000",
        estimatedBudget: "50000",
        status: "Pending",
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
          paymentMethod: "Check",
          referenceNumber: "CHK789012",
          proofOfRelease: "check_scan.jpg",
          purpose: "Full payment for LED lights and installation",
          approvalNotes: "Final approval by board"
        }
      },
      {
        id: 4,
        projectTitle: "Luxury Fountain Installation",
        description: "Installing a decorative fountain in the park",
        startDate: "2023-01-15",
        targetCompletion: "2023-03-31",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "Fountain: ₱100,000, Installation: ₱50,000",
        estimatedBudget: "150000",
        status: "Rejected",
        projectProposalDoc: "fountain_design.pdf",
        signedResolutionFile: null,
        auditFile: null,
        notes: "Budget too high for current fiscal year.",
        hasPost: false,
        budgetReleased: null
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
        projectTitle: "Admin Payroll - Month of August",
        description: "Monthly payroll for administrative staff for August 2025",
        startDate: "2025-08-01",
        targetCompletion: "2025-08-31",
        proposedBy: "Treasurer",
        budgetBreakdown: "Administrative Staff Salaries",
        estimatedBudget: "50000",
        status: "Approved",
        projectProposalDoc: "payroll_august.pdf",
        signedResolutionFile: null,
        auditFile: null,
        notes: "",
        hasPost: false,
        budgetReleased: {
          projectId: 6,
          projectTitle: "Admin Payroll - Month of August",
          amountReleased: "50000",
          recipient: "Administrative Staff",
          releaseDate: "2025-08-05",
          paymentMethod: "Bank Transfer",
          referenceNumber: "PAY202508001",
          proofOfRelease: "payroll_proof_august.jpg",
          purpose: "Monthly salary payment for administrative staff",
          approvalNotes: "Approved by president on 2025-08-04"
        }
      },
      {
        id: 7,
        projectTitle: "Electricity & Garbage Fee",
        description: "Monthly electricity and garbage collection fees for September 2025",
        startDate: "2025-09-01",
        targetCompletion: "2025-09-30",
        proposedBy: "Treasurer",
        budgetBreakdown: "Electricity: ₱15,000, Garbage Collection: ₱8,000",
        estimatedBudget: "23000",
        status: "Pending",
        projectProposalDoc: "utility_bills_september.pdf",
        signedResolutionFile: null,
        auditFile: null,
        notes: "",
        hasPost: false,
        budgetReleased: {
          projectId: 7,
          projectTitle: "Electricity & Garbage Fee",
          amountReleased: "23000",
          recipient: "Utility Companies",
          releaseDate: "2025-09-05",
          paymentMethod: "Bank Transfer",
          referenceNumber: "UTIL202509001",
          proofOfRelease: "utility_payment_proof.jpg",
          purpose: "Monthly electricity and garbage collection fees",
          approvalNotes: ""
        }
      },
      {
        id: 8,
        projectTitle: "Admin Payroll - Month of October 2025",
        description: "Monthly payroll for administrative staff for October 2025",
        startDate: "2025-10-01",
        targetCompletion: "2025-10-31",
        proposedBy: "Treasurer",
        budgetBreakdown: "Administrative Staff Salaries",
        estimatedBudget: "50000",
        status: "Completed",
        projectProposalDoc: "payroll_october.pdf",
        signedResolutionFile: null,
        auditFile: "payroll_audit_october.pdf",
        notes: "",
        hasPost: false,
        budgetReleased: {
          projectId: 8,
          projectTitle: "Admin Payroll - Month of October 2025",
          amountReleased: "50000",
          recipient: "Administrative Staff",
          releaseDate: "2025-10-05",
          paymentMethod: "Bank Transfer",
          referenceNumber: "PAY202510001",
          proofOfRelease: "payroll_proof_october.jpg",
          purpose: "Monthly salary payment for administrative staff",
          approvalNotes: "Approved by president on 2025-10-04"
        }
      }
    ];

    let budgetReleases = [
      {
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
      },
      {
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
      },
      {
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
      },
      {
        projectId: 6,
        projectTitle: "Admin Payroll - Month of August",
        amountReleased: "50000",
        recipient: "Administrative Staff",
        releaseDate: "2025-08-05",
        paymentMethod: "Bank Transfer",
        referenceNumber: "PAY202508001",
        proofOfRelease: "payroll_proof_august.jpg",
        purpose: "Monthly salary payment for administrative staff",
        approvalNotes: "Approved by president on 2025-08-04"
      }
    ];

    document.addEventListener('DOMContentLoaded', function() {
      const boardResolutionForm = document.getElementById('boardResolutionForm');
      const viewProjectForm = document.getElementById('viewProjectForm');
      const projectPostForm = document.getElementById('projectPostForm');
      const budgetReleasedForm = document.getElementById('budgetReleasedForm');
      const searchInput = document.getElementById('search');
      const statusFilter = document.getElementById('statusFilter');
      const typeFilter = document.getElementById('typeFilter');
      const postImageInput = document.getElementById('postImages');
      const projectProposalDocInput = document.getElementById('projectProposalDoc');
      const signedResolutionInput = document.getElementById('signedResolution');
      const viewProjectProposalDocInput = document.getElementById('viewProjectProposalDoc');
      const viewSignedResolutionInput = document.getElementById('viewSignedResolution');

      // Project Proposal Document upload validation and preview
      projectProposalDocInput.addEventListener('change', function() {
        handleFileUpload(this, 'projectProposalPreview');
      });

      // Signed Resolution upload validation and preview
      signedResolutionInput.addEventListener('change', function() {
        handleFileUpload(this, 'signedResolutionPreview');
      });

      // View modal file uploads
      viewProjectProposalDocInput.addEventListener('change', function() {
        handleFileUpload(this, 'viewProjectProposalPreview');
      });

      viewSignedResolutionInput.addEventListener('change', function() {
        handleFileUpload(this, 'viewSignedResolutionPreview');
      });

      // Image upload validation and preview for Project Post
      postImageInput.addEventListener('change', function() {
        const preview = document.getElementById('postImagePreview');
        preview.innerHTML = '';
        Array.from(postImageInput.files).forEach(file => {
          if (file.type.match('image.*') && file.size <= 10 * 1024 * 1024) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'rounded-lg w-full h-24 object-cover';
            preview.appendChild(img);
          } else {
            alert('Please upload PNG or JPG images under 10MB.');
            postImageInput.value = '';
            preview.innerHTML = '';
          }
        });
      });

      // Board Resolution Form submission
      boardResolutionForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const newResolution = {
          id: Math.max(...projectProposals.map(p => p.id), 0) + 1,
          projectTitle: document.getElementById('resolutionTitle').value,
          description: document.getElementById('resolutionSummary').value,
          estimatedBudget: document.getElementById('estimatedBudget').value || "0",
          startDate: document.getElementById('resolutionStartDate').value,
          targetCompletion: document.getElementById('resolutionTargetCompletion').value,
          proposedBy: document.getElementById('resolutionProposedBy').value,
          budgetBreakdown: "N/A",
          status: "Pending",
          projectProposalDoc: projectProposalDocInput.files[0] ? projectProposalDocInput.files[0].name : null,
          signedResolutionFile: signedResolutionInput.files[0] ? signedResolutionInput.files[0].name : null,
          auditFile: null,
          notes: "",
          hasPost: false,
          budgetReleased: null
        };

        projectProposals.push(newResolution);
        alert('Board resolution created successfully!');
        closeBoardResolutionModal();
        boardResolutionForm.reset();
        document.getElementById('projectProposalPreview').innerHTML = '';
        document.getElementById('signedResolutionPreview').innerHTML = '';
        renderProjectProposals();
      });

      // View Project Form submission
      viewProjectForm.addEventListener('submit', function(e) {
        e.preventDefault();
      });

      // Project Post Form submission
      projectPostForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const projectId = projectPostForm.dataset.projectId;
        const proposal = projectProposals.find(p => p.id === parseInt(projectId));
        if (proposal) {
          proposal.hasPost = true;
          proposal.status = 'Completed';
          closeProjectPostModal();
          projectPostForm.reset();
          document.getElementById('postImagePreview').innerHTML = '';
          renderProjectProposals();
          alert('Project post created and project marked as completed!');
        }
      });

      // Budget Released Form submission
      budgetReleasedForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const projectId = budgetReleasedForm.dataset.projectId;
        const proposal = projectProposals.find(p => p.id === parseInt(projectId));
        if (proposal) {
          const paymentMethod = document.getElementById('paymentMethod').value;
          const referenceNumber = paymentMethod === 'Cash' ? '' : document.getElementById('referenceNumber').value;
          const newBudgetRelease = {
            projectId: parseInt(projectId),
            projectTitle: document.getElementById('budgetProjectTitle').value,
            amountReleased: document.getElementById('amountReleased').value,
            recipient: document.getElementById('recipient').value,
            releaseDate: document.getElementById('releaseDate').value,
            paymentMethod: paymentMethod,
            referenceNumber: referenceNumber,
            proofOfRelease: document.getElementById('proofOfReleaseInput') ? document.getElementById('proofOfReleaseInput').files[0] ? document.getElementById('proofOfReleaseInput').files[0].name : null : null,
            purpose: document.getElementById('purpose').value,
            approvalNotes: document.getElementById('approvalNotes').value
          };
          budgetReleases = budgetReleases.filter(br => br.projectId !== parseInt(projectId));
          budgetReleases.push(newBudgetRelease);
          proposal.budgetReleased = newBudgetRelease;
          alert('Budget release submitted successfully!');
          closeBudgetReleasedModal();
          budgetReleasedForm.reset();
          document.getElementById('proofOfReleasePreview').innerHTML = '';
          renderProjectProposals();
        }
      });

      // Filter and search event listeners
      searchInput.addEventListener('input', filterProposals);
      statusFilter.addEventListener('change', filterProposals);
      typeFilter.addEventListener('change', filterProposals);

      // Initial render
      filteredProposals = projectProposals;
      renderProjectProposals();
    });

    function handleFileUpload(input, previewId, isImageOnly = false) {
      const preview = document.getElementById(previewId);
      preview.innerHTML = '';
      const file = input.files[0];
      if (file) {
        const isValidType = isImageOnly
          ? file.type.match('image/png') || file.type.match('image/jpeg')
          : file.type.match('application/pdf') ||
            file.type.match('application/msword') ||
            file.type.match('application/vnd.openxmlformats-officedocument.wordprocessingml.document') ||
            file.type.match('image/png') ||
            file.type.match('image/jpeg');

        if (isValidType && file.size <= 10 * 1024 * 1024) {
          if (isImageOnly && file.type.match('image.*')) {
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
          alert(`Please upload ${isImageOnly ? 'PNG or JPG images' : 'valid files'} under 10MB.`);
          input.value = '';
          preview.innerHTML = '';
        }
      }
    }

    function filterProposals() {
      const searchTerm = document.getElementById('search').value.toLowerCase();
      const statusValue = document.getElementById('statusFilter').value;
      const typeValue = document.getElementById('typeFilter').value;

      filteredProposals = projectProposals.filter(proposal => {
        const matchesSearch = proposal.projectTitle.toLowerCase().includes(searchTerm);
        const matchesStatus = statusValue ? proposal.status === statusValue : true;
        
        let matchesType = true;
        if (typeValue) {
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

    function renderProjectProposals() {
      const tbody = document.getElementById('proposalsTableBody');
      tbody.innerHTML = '';

      const proposalsToRender = filteredProposals.length > 0 ? filteredProposals : projectProposals;

      if (!proposalsToRender || proposalsToRender.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No project proposals found.</td></tr>`;
        return;
      }

      // Render ALL proposals (NO PAGINATION)
      proposalsToRender.forEach(proposal => {
        const statusMap = {
          Ongoing: 'bg-yellow-100 text-yellow-800',
          Pending: 'bg-blue-100 text-blue-800',
          Completed: 'bg-green-100 text-green-800',
          Approved: 'bg-teal-100 text-teal-800',
          Rejected: 'bg-red-100 text-red-800',
          'Past Due': 'bg-orange-100 text-orange-800'
        };
        const statusColor = statusMap[proposal.status] || 'bg-gray-100 text-gray-800';
        const isCompletedWithPost = proposal.status === 'Completed' && proposal.hasPost;
        const showBudgetReleasedButton = proposal.budgetReleased !== null;
        const hideActionsViewButton = proposal.id === 6 || proposal.id === 7 || proposal.id === 8;

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
              ${!hideActionsViewButton ? `
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

    // Modal Functions
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
    }

    function openViewProjectModal(id) {
      const proposal = projectProposals.find(p => p.id === id);
      if (proposal) {
        document.getElementById('viewProjectId').value = proposal.id;
        document.getElementById('viewResolutionTitle').value = proposal.projectTitle;
        document.getElementById('viewResolutionSummary').value = proposal.description;
        document.getElementById('viewEstimatedBudget').value = proposal.estimatedBudget || '';
        document.getElementById('viewResolutionStartDate').value = proposal.startDate;
        document.getElementById('viewResolutionTargetCompletion').value = proposal.targetCompletion;
        document.getElementById('viewResolutionProposedBy').value = proposal.proposedBy;
        document.getElementById('viewRejectionNotes').value = proposal.notes || '';

        const projectProposalPreview = document.getElementById('viewProjectProposalPreview');
        const signedResolutionPreview = document.getElementById('viewSignedResolutionPreview');

        projectProposalPreview.innerHTML = proposal.projectProposalDoc
          ? `<div class="flex items-center"><i class="fas fa-file-alt mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.projectProposalDoc}</span></div>`
          : '';
        signedResolutionPreview.innerHTML = proposal.signedResolutionFile
          ? `<div class="flex items-center"><i class="fas fa-file-alt mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.signedResolutionFile}</span></div>`
          : '';

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
      document.getElementById('viewRejectionNotes').value = '';
    }

    function approveProject() {
      const projectId = document.getElementById('viewProjectId').value;
      const proposal = projectProposals.find(p => p.id === parseInt(projectId));
      if (proposal) {
        proposal.status = 'Ongoing';
        alert('Project approved successfully!');
        closeViewProjectModal();
        renderProjectProposals();
      }
    }

    function rejectProject() {
      const projectId = document.getElementById('viewProjectId').value;
      const notes = document.getElementById('viewRejectionNotes').value.trim();
      if (!notes) {
        alert('Please provide notes for rejection.');
        return;
      }
      const proposal = projectProposals.find(p => p.id === parseInt(projectId));
      if (proposal) {
        proposal.status = 'Rejected';
        proposal.notes = notes;
        alert('Project rejected successfully!');
        closeViewProjectModal();
        renderProjectProposals();
      }
    }

    function openNotesModal(notes) {
      document.getElementById('notesContent').textContent = notes || 'No notes available.';
      document.getElementById('notesModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeNotesModal() {
      document.getElementById('notesModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    function openProjectPostModal(id) {
      const proposal = projectProposals.find(p => p.id === id);
      if (proposal) {
        document.getElementById('postProjectTitle').value = proposal.projectTitle;
        document.getElementById('projectPostForm').dataset.projectId = id;
        document.getElementById('projectPostModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }
    }

    function closeProjectPostModal() {
      document.getElementById('projectPostModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('projectPostForm').reset();
      document.getElementById('postImagePreview').innerHTML = '';
      document.getElementById('projectPostForm').removeAttribute('data-projectId');
    }

    function openAuditFileModal(fileName) {
      const content = document.getElementById('auditFileContent');
      content.innerHTML = `<div class="flex items-center"><i class="fas fa-file-alt mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${fileName}</span></div>`;
      document.getElementById('auditFileModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeAuditFileModal() {
      document.getElementById('auditFileModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    function openBudgetReleasedModal(id) {
      const proposal = projectProposals.find(p => p.id === id);
      if (proposal) {
        document.getElementById('rejectionNotes').value = '';
        document.getElementById('budgetReleasedForm').dataset.projectId = id;

        const budget = proposal.budgetReleased;
        const originalFields = document.getElementById('originalFields');
        const newFields = document.getElementById('newFields');

        if ([6, 7, 8].includes(id) && budget) {
          // NEW LAYOUT FOR IDs 6,7,8
          originalFields.classList.add('hidden');
          newFields.classList.remove('hidden');
          
          document.getElementById('particulars').value = proposal.projectTitle;
          document.getElementById('transactionDate').value = budget.releaseDate;
          document.getElementById('transactionType').value = id === 7 ? 'Utility Payment' : 'Payroll';
          document.getElementById('payerName').value = 'Mabuhay Homes 2000 HOA';
          document.getElementById('receiverName').value = budget.recipient;
          document.getElementById('paymentMethodNew').value = budget.paymentMethod;
          document.getElementById('referenceNumberNew').value = budget.referenceNumber;
          
          const ackPreview = document.getElementById('acknowledgementPreview');
          if (budget.proofOfRelease) {
            ackPreview.innerHTML = `<div class="flex items-center"><i class="fas fa-image mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${budget.proofOfRelease}</span></div>`;
          } else {
            ackPreview.innerHTML = '<p class="text-sm text-gray-500">No receipt available.</p>';
          }
          
          document.getElementById('remarks').value = budget.purpose;
        } else {
          // ORIGINAL LAYOUT FOR IDs 1-5
          newFields.classList.add('hidden');
          originalFields.classList.remove('hidden');
          
          document.getElementById('budgetProjectTitle').value = proposal.projectTitle;
          if (budget) {
            document.getElementById('amountReleased').value = budget.amountReleased;
            document.getElementById('recipient').value = budget.recipient;
            document.getElementById('releaseDate').value = budget.releaseDate;
            document.getElementById('paymentMethod').value = budget.paymentMethod;
            document.getElementById('referenceNumber').value = budget.referenceNumber;
            document.getElementById('purpose').value = budget.purpose;
            document.getElementById('approvalNotes').value = budget.approvalNotes;
            const proofPreview = document.getElementById('proofOfReleasePreview');
            if (budget.proofOfRelease) {
              proofPreview.innerHTML = `<div class="flex items-center"><i class="fas fa-image mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${budget.proofOfRelease}</span></div>`;
            } else {
              proofPreview.innerHTML = '<p class="text-sm text-gray-500">No receipt available.</p>';
            }
          } else {
            document.getElementById('amountReleased').value = '';
            document.getElementById('recipient').value = '';
            document.getElementById('releaseDate').value = '';
            document.getElementById('paymentMethod').value = '';
            document.getElementById('referenceNumber').value = '';
            document.getElementById('purpose').value = '';
            document.getElementById('approvalNotes').value = '';
            document.getElementById('proofOfReleasePreview').innerHTML = '<p class="text-sm text-gray-500">No receipt available.</p>';
          }
        }

        document.getElementById('budgetReleasedModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }
    }

    function closeBudgetReleasedModal() {
      document.getElementById('budgetReleasedModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('budgetReleasedForm').reset();
      document.getElementById('proofOfReleasePreview').innerHTML = '';
      document.getElementById('acknowledgementPreview').innerHTML = '';
      document.getElementById('rejectionNotes').value = '';
      document.getElementById('budgetReleasedForm').removeAttribute('data-projectId');
      
      // Reset field visibility
      document.getElementById('originalFields').classList.remove('hidden');
      document.getElementById('newFields').classList.add('hidden');
    }

    function approveBudgetRelease() {
      const projectId = document.getElementById('budgetReleasedForm').dataset.projectId;
      const proposal = projectProposals.find(p => p.id === parseInt(projectId));
      if (proposal) {
        proposal.status = 'Completed';
        alert('Budget release approved successfully!');
        closeBudgetReleasedModal();
        renderProjectProposals();
      }
    }

    function rejectBudgetRelease() {
      const projectId = document.getElementById('budgetReleasedForm').dataset.projectId;
      const notes = document.getElementById('rejectionNotes').value.trim();
      if (!notes) {
        alert('Please provide notes for rejection.');
        return;
      }
      const proposal = projectProposals.find(p => p.id === parseInt(projectId));
      if (proposal) {
        proposal.status = 'Rejected';
        proposal.notes = notes;
        proposal.budgetReleased = null;
        alert('Budget release rejected successfully!');
        closeBudgetReleasedModal();
        renderProjectProposals();
      }
    }
</script>




</body>
</html>
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
      <a href="aud-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
        <i class="fas fa-tachometer-alt mr-3"></i>
        <span>Dashboard</span>
      </a>
      <a href="aud-liquidation.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-file-invoice-dollar mr-3"></i>
        <span>Liquidation of Expenses</span>
      </a>
      <a href="aud-projectproposal.php" class="flex items-center px-6 py-3 bg-teal-700">
        <i class="fas fa-gavel mr-3"></i>
        <span>Resolution</span>
      </a>
      <a href="aud-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
        <i class="fas fa-newspaper mr-3"></i>
        <span>News Feed</span>
      </a>
      <a href="aud-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-book mr-3"></i>
        <span>Ledger</span>
      </a>
      <a href="aud-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
        <i class="fas fa-calendar-alt mr-3"></i>
        <span>Calendar</span>
      </a>
      <a href="aud-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
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
                  <label for="signedResolution" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus:within:ring-2 focus:within:ring-offset-2 focus:within:ring-teal-500">
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

  <!-- Edit Project Modal -->
  <div id="editProjectModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
      <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
        <h3 class="text-lg font-medium text-gray-900">Edit Project Proposal</h3>
        <button onclick="closeEditProjectModal()" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-6">
        <form id="editProjectForm" class="space-y-6">
          <input type="hidden" id="editProjectId" />
          <div>
            <label for="editResolutionTitle" class="block text-sm font-medium text-gray-700">Resolution Title</label>
            <input type="text" id="editResolutionTitle" name="editResolutionTitle" required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
          </div>
          <div>
            <label for="editResolutionSummary" class="block text-sm font-medium text-gray-700">Resolution Summary</label>
            <textarea id="editResolutionSummary" name="editResolutionSummary" rows="4" required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Provide a detailed summary of the board resolution..."></textarea>
          </div>
          <div>
            <label for="editEstimatedBudget" class="block text-sm font-medium text-gray-700">Estimated Budget</label>
            <input type="number" id="editEstimatedBudget" name="editEstimatedBudget" min="0" step="0.01"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
              placeholder="Enter estimated budget amount" />
          </div>
          <div>
            <label for="editResolutionStartDate" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="date" id="editResolutionStartDate" name="editResolutionStartDate" required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
          </div>
          <div>
            <label for="editResolutionTargetCompletion" class="block text-sm font-medium text-gray-700">Date Target Completion</label>
            <input type="date" id="editResolutionTargetCompletion" name="editResolutionTargetCompletion" required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
          </div>
          <div>
            <label for="editResolutionProposedBy" class="block text-sm font-medium text-gray-700">Proposed By</label>
            <input type="text" id="editResolutionProposedBy" name="editResolutionProposedBy" readonly
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
                  <label for="editProjectProposalDoc" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                    <span>Upload project proposal document</span>
                    <input id="editProjectProposalDoc" name="editProjectProposalDoc" type="file" accept="application/pdf,.doc,.docx" class="sr-only" />
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs text-gray-500">PDF, DOC, DOCX up to 10MB</p>
              </div>
            </div>
            <div id="editProjectProposalPreview" class="mt-2"></div>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Upload Signed Resolution</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
              <div class="space-y-1 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                  <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="flex text-sm text-gray-600">
                  <label for="editSignedResolution" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                    <span>Upload signed resolution</span>
                    <input id="editSignedResolution" name="editSignedResolution" type="file" accept="application/pdf,.doc,.docx,image/png,image/jpeg" class="sr-only" />
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs text-gray-500">PDF, DOC, DOCX, PNG, JPG up to 10MB</p>
              </div>
            </div>
            <div id="editSignedResolutionPreview" class="mt-2"></div>
          </div>
          <div class="flex justify-end space-x-3">
            <button type="button" onclick="closeEditProjectModal()"
              class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
              Cancel
            </button>
            <button type="submit"
              class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
              Update Project
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- View Project Modal -->
  <div id="viewProjectModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full max-h-screen overflow-y-auto">
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
            <input type="text" id="viewResolutionTitle" name="viewResolutionTitle" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label for="viewResolutionSummary" class="block text-sm font-medium text-gray-700">Resolution Summary</label>
            <textarea id="viewResolutionSummary" name="viewResolutionSummary" rows="4" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm"
              placeholder="Provide a detailed summary of the board resolution..."></textarea>
          </div>
          <div>
            <label for="viewEstimatedBudget" class="block text-sm font-medium text-gray-700">Estimated Budget</label>
            <input type="number" id="viewEstimatedBudget" name="viewEstimatedBudget" min="0" step="0.01" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm"
              placeholder="Enter estimated budget amount" />
          </div>
          <div>
            <label for="viewResolutionStartDate" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="date" id="viewResolutionStartDate" name="viewResolutionStartDate" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label for="viewResolutionTargetCompletion" class="block text-sm font-medium text-gray-700">Date Target Completion</label>
            <input type="date" id="viewResolutionTargetCompletion" name="viewResolutionTargetCompletion" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label for="viewResolutionProposedBy" class="block text-sm font-medium text-gray-700">Proposed By</label>
            <input type="text" id="viewResolutionProposedBy" name="viewResolutionProposedBy" readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Project Proposal Document</label>
            <div id="viewProjectProposalPreview" class="mt-2 p-2 border border-gray-200 rounded-md min-h-[40px]"></div>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Signed Resolution</label>
            <div id="viewSignedResolutionPreview" class="mt-2 p-2 border border-gray-200 rounded-md min-h-[40px]"></div>
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

  <!-- Budget Released Modal -->
  <!-- Updated modal to show different fields based on project type -->
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
          <input type="hidden" id="budgetProjectId" />
          
          <!-- Fields for Basketball Court Renovation, Street Lighting Upgrade, and Community Garden Setup -->
          <div id="projectBudgetFields" class="hidden space-y-6">
            <div>
              <label for="projectTitle" class="block text-sm font-medium text-gray-700">Project Title</label>
              <input type="text" id="projectTitle" name="projectTitle" readonly
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 sm:text-sm" />
            </div>
            <div>
              <label for="amountReleased" class="block text-sm font-medium text-gray-700">Amount Released</label>
              <input type="number" id="amountReleased" name="amountReleased" step="0.01" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="recipient" class="block text-sm font-medium text-gray-700">Recipient</label>
              <input type="text" id="recipient" name="recipient" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="releaseDate" class="block text-sm font-medium text-gray-700">Release Date</label>
              <input type="date" id="releaseDate" name="releaseDate" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="paymentMethod" class="block text-sm font-medium text-gray-700">Payment Method</label>
              <select id="paymentMethod" name="paymentMethod" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                <option value="">Select payment method</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Cash">Cash</option>
                <option value="Check">Check</option>
              </select>
            </div>
            <div>
              <label for="referenceNumber" class="block text-sm font-medium text-gray-700">Reference Number</label>
              <input type="text" id="referenceNumber" name="referenceNumber" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Acknowledgement Receipt</label>
              <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                  <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div class="flex text-sm text-gray-600">
                    <label for="acknowledgementReceipt" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus:within:ring-2 focus:within:ring-offset-2 focus:within:ring-teal-500">
                      <span>Upload acknowledgement receipt</span>
                      <input id="acknowledgementReceipt" name="acknowledgementReceipt" type="file" accept="application/pdf,image/png,image/jpeg" class="sr-only" />
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>
                  <p class="text-xs text-gray-500">PDF, PNG, JPG up to 10MB</p>
                </div>
              </div>
              <div id="acknowledgementReceiptPreview" class="mt-2"></div>
            </div>
            <div>
              <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose</label>
              <textarea id="purpose" name="purpose" rows="3" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                placeholder="Enter purpose of budget release"></textarea>
            </div>
            <div>
              <label for="approvalNotes" class="block text-sm font-medium text-gray-700">Approval Notes</label>
              <textarea id="approvalNotes" name="approvalNotes" rows="3"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                placeholder="Enter approval notes"></textarea>
            </div>
          </div>

          <!-- Fields for Admin Payroll and Electricity & Garbage Fee (unchanged) -->
          <div id="budgetFields" class="hidden space-y-6">
            <div>
              <label for="budgetParticulars" class="block text-sm font-medium text-gray-700">Particulars</label>
              <input type="text" id="budgetParticulars" name="budgetParticulars" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                placeholder="Enter particulars" />
            </div>
            <div>
              <label for="budgetDate" class="block text-sm font-medium text-gray-700">Date</label>
              <input type="date" id="budgetDate" name="budgetDate" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="transactionType" class="block text-sm font-medium text-gray-700">Transaction Type</label>
              <select id="transactionType" name="transactionType" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                <option value="">Select transaction type</option>
                <option value="Expense">Expense</option>
                <option value="Income">Income</option>
                <option value="Transfer">Transfer</option>
              </select>
            </div>
            <div>
              <label for="namePayer" class="block text-sm font-medium text-gray-700">Name of Payer</label>
              <input type="text" id="namePayer" name="namePayer" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                placeholder="Enter payer name" />
            </div>
            <div>
              <label for="nameReceiver" class="block text-sm font-medium text-gray-700">Name of Receiver</label>
              <input type="text" id="nameReceiver" name="nameReceiver" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                placeholder="Enter receiver name" />
            </div>
            <div>
              <label for="budgetPaymentMethod" class="block text-sm font-medium text-gray-700">Payment Method</label>
              <select id="budgetPaymentMethod" name="budgetPaymentMethod" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                <option value="">Select payment method</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Cash">Cash</option>
                <option value="Check">Check</option>
              </select>
            </div>
            <div>
              <label for="budgetReferenceNumber" class="block text-sm font-medium text-gray-700">Reference Number</label>
              <input type="text" id="budgetReferenceNumber" name="budgetReferenceNumber" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                placeholder="Enter reference number" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Acknowledgement Receipt</label>
              <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                  <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div class="flex text-sm text-gray-600">
                    <label for="budgetAcknowledgement" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus:within:ring-2 focus:within:ring-offset-2 focus:within:ring-teal-500">
                      <span>Upload acknowledgement receipt</span>
                      <input id="budgetAcknowledgement" name="budgetAcknowledgement" type="file" accept="application/pdf,image/png,image/jpeg" class="sr-only" />
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>
                  <p class="text-xs text-gray-500">PDF, PNG, JPG up to 10MB</p>
                </div>
              </div>
              <div id="budgetAcknowledgementPreview" class="mt-2"></div>
            </div>
            <div>
              <label for="budgetRemarks" class="block text-sm font-medium text-gray-700">Remarks</label>
              <textarea id="budgetRemarks" name="budgetRemarks" rows="4"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                placeholder="Enter remarks"></textarea>
            </div>
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
        <form id="auditFileForm" class="space-y-6">
          <input type="hidden" id="auditProjectId" />
          <div>
            <label class="block text-sm font-medium text-gray-700">Upload Audit File</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
              <div class="space-y-1 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                  <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="flex text-sm text-gray-600">
                  <label for="auditFileUpload" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus:within:ring-2 focus:within:ring-offset-2 focus:within:ring-teal-500">
                    <span>Upload audit file</span>
                    <input id="auditFileUpload" name="auditFileUpload" type="file" accept="application/pdf,.doc,.docx,image/png,image/jpeg" class="sr-only" />
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs text-gray-500">PDF, DOC, DOCX, PNG, JPG up to 10MB</p>
              </div>
            </div>
            <div id="auditFilePreview" class="mt-2"></div>
          </div>
          <div id="auditFileContent" class="text-sm text-gray-900"></div>
          <div class="flex justify-end space-x-3">
            <button type="button" onclick="closeAuditFileModal()"
              class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
              Cancel
            </button>
            <button type="submit"
              class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
              Submit
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
                  <label for="postImages" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus:within:ring-teal-500">
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
  
  <script>
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
        budgetReleased: {
          amountReleased: "45000",
          recipient: "CourtFix Contractors",
          releaseDate: "2025-02-15",
          paymentMethod: "Check",
          referenceNumber: "CHK123456",
          purpose: "Renovation of basketball court",
          approvalNotes: "",
          proofOfRelease: "proof_court_release.pdf"
        },
        notes: "",
        hasPost: false,
        hasProjectDetails: true
      },
      {
        id: 2,
        projectTitle: "Electricity & Garbage Fee",
        description: "Monthly electricity and garbage collection fees",
        startDate: "2025-10-01",
        targetCompletion: "2025-10-31",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "N/A",
        estimatedBudget: "0",
        status: "Approved",
        projectProposalDoc: null,
        signedResolutionFile: null,
        budgetReleased: {
          amountReleased: "25000",
          recipient: "Utility Provider",
          releaseDate: "2025-10-05",
          paymentMethod: "Bank Transfer",
          referenceNumber: "TRX654321",
          purpose: "Payment for electricity and garbage collection",
          approvalNotes: "Approved by HOA board",
          proofOfRelease: "proof_utilities_release.pdf"
        },
        notes: "",
        hasPost: false,
        hasProjectDetails: false
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
        budgetReleased: {
          amountReleased: "85000",
          recipient: "BrightTech Solutions",
          releaseDate: "2023-03-01",
          paymentMethod: "Bank Transfer",
          referenceNumber: "TRX123456",
          purpose: "Purchase and installation of LED street lights",
          approvalNotes: "Approved by HOA board on 2023-02-25",
          proofOfRelease: "proof_lighting_release.pdf"
        },
        notes: "",
        hasPost: true,
        hasProjectDetails: true
      },
      {
        id: 4,
        projectTitle: "Admin Payroll - Month of October 2025",
        description: "Monthly administrative staff payroll",
        startDate: "2025-10-01",
        targetCompletion: "2025-10-31",
        proposedBy: "HOA Board of Directors",
        budgetBreakdown: "N/A",
        estimatedBudget: "0",
        status: "Completed",
        projectProposalDoc: null,
        signedResolutionFile: null,
        budgetReleased: {
          amountReleased: "50000",
          recipient: "Admin Staff",
          releaseDate: "2025-10-31",
          paymentMethod: "Bank Transfer",
          referenceNumber: "TRX789012",
          purpose: "Monthly payroll for administrative staff",
          approvalNotes: "Approved by HOA board",
          proofOfRelease: "proof_payroll_release.pdf"
        },
        notes: "",
        hasPost: false,
        hasProjectDetails: false
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
        budgetReleased: {
          amountReleased: "15000",
          recipient: "GreenGrow Supplies",
          releaseDate: "2025-01-20",
          paymentMethod: "Check",
          referenceNumber: "CHK789012",
          purpose: "Initial purchase of seeds and tools",
          approvalNotes: "",
          proofOfRelease: "proof_garden_release.pdf"
        },
        notes: "",
        hasPost: false,
        hasProjectDetails: true
      }
    ];
  
    let boardResolutions = [];
  
    document.addEventListener('DOMContentLoaded', function() {
      const boardResolutionForm = document.getElementById('boardResolutionForm');
      const editProjectForm = document.getElementById('editProjectForm');
      const projectPostForm = document.getElementById('projectPostForm');
      const budgetReleasedForm = document.getElementById('budgetReleasedForm');
      const auditFileForm = document.getElementById('auditFileForm');
      const searchInput = document.getElementById('search');
      const statusFilter = document.getElementById('statusFilter');
      const postImageInput = document.getElementById('postImages');
      const projectProposalDocInput = document.getElementById('projectProposalDoc');
      const signedResolutionInput = document.getElementById('signedResolution');
      const editProjectProposalDocInput = document.getElementById('editProjectProposalDoc');
      const editSignedResolutionInput = document.getElementById('editSignedResolution');
      const budgetAcknowledgementInput = document.getElementById('budgetAcknowledgement');
      const auditFileUploadInput = document.getElementById('auditFileUpload');

      projectProposalDocInput.addEventListener('change', function() {
        handleFileUpload(this, 'projectProposalPreview');
      });

      signedResolutionInput.addEventListener('change', function() {
        handleFileUpload(this, 'signedResolutionPreview');
      });

      editProjectProposalDocInput.addEventListener('change', function() {
        handleFileUpload(this, 'editProjectProposalPreview');
      });

      editSignedResolutionInput.addEventListener('change', function() {
        handleFileUpload(this, 'editSignedResolutionPreview');
      });

      budgetAcknowledgementInput.addEventListener('change', function() {
        handleFileUpload(this, 'budgetAcknowledgementPreview');
      });

      auditFileUploadInput.addEventListener('change', function() {
        handleFileUpload(this, 'auditFilePreview');
      });

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
          notes: "",
          hasPost: false,
          hasProjectDetails: true
        };

        projectProposals.push(newResolution);
        alert('Board resolution created successfully!');
        closeBoardResolutionModal();
        boardResolutionForm.reset();
        document.getElementById('projectProposalPreview').innerHTML = '';
        document.getElementById('signedResolutionPreview').innerHTML = '';
        renderProjectProposals();
      });

      editProjectForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const projectId = parseInt(document.getElementById('editProjectId').value);
        const proposal = projectProposals.find(p => p.id === projectId);

        if (proposal) {
          proposal.projectTitle = document.getElementById('editResolutionTitle').value;
          proposal.description = document.getElementById('editResolutionSummary').value;
          proposal.estimatedBudget = document.getElementById('editEstimatedBudget').value || "0";
          proposal.startDate = document.getElementById('editResolutionStartDate').value;
          proposal.targetCompletion = document.getElementById('editResolutionTargetCompletion').value;
          proposal.proposedBy = document.getElementById('editResolutionProposedBy').value;

          if (editProjectProposalDocInput.files[0]) {
            proposal.projectProposalDoc = editProjectProposalDocInput.files[0].name;
          }
          if (editSignedResolutionInput.files[0]) {
            proposal.signedResolutionFile = editSignedResolutionInput.files[0].name;
          }

          alert('Project updated successfully!');
          closeEditProjectModal();
          renderProjectProposals();
        }
      });

      budgetReleasedForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const projectId = parseInt(document.getElementById('budgetProjectId').value);
        const proposal = projectProposals.find(p => p.id === projectId);

        if (proposal) {
          const isProjectType = ['Basketball Court Renovation', 'Street Lighting Upgrade', 'Community Garden Setup'].includes(proposal.projectTitle);
          
          if (isProjectType) {
            proposal.budgetReleased = {
              amountReleased: document.getElementById('amountReleased').value,
              recipient: document.getElementById('recipient').value,
              releaseDate: document.getElementById('releaseDate').value,
              paymentMethod: document.getElementById('paymentMethod').value,
              referenceNumber: document.getElementById('referenceNumber').value,
              purpose: document.getElementById('purpose').value,
              approvalNotes: document.getElementById('approvalNotes').value,
              proofOfRelease: document.getElementById('acknowledgementReceipt').files[0] ? document.getElementById('acknowledgementReceipt').files[0].name : null
            };
          } else {
            proposal.budgetReleased = {
              amountReleased: document.getElementById('budgetParticulars').value,
              recipient: document.getElementById('nameReceiver').value,
              releaseDate: document.getElementById('budgetDate').value,
              paymentMethod: document.getElementById('budgetPaymentMethod').value,
              referenceNumber: document.getElementById('budgetReferenceNumber').value || '',
              purpose: document.getElementById('budgetRemarks').value,
              approvalNotes: '',
              proofOfRelease: document.getElementById('budgetAcknowledgement').files[0] ? document.getElementById('budgetAcknowledgement').files[0].name : null
            };
          }

          alert('Budget release details saved successfully!');
          closeBudgetReleasedModal();
          budgetReleasedForm.reset();
          document.getElementById('budgetAcknowledgementPreview').innerHTML = '';
          document.getElementById('acknowledgementReceiptPreview').innerHTML = '';
          renderProjectProposals();
        }
      });

      auditFileForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const projectId = parseInt(document.getElementById('auditProjectId').value);
        const proposal = projectProposals.find(p => p.id === projectId);
        
        if (proposal) {
          alert('Audit file uploaded successfully!');
          closeAuditFileModal();
          auditFileForm.reset();
          document.getElementById('auditFilePreview').innerHTML = '';
        }
      });

      searchInput.addEventListener('input', filterProposals);
      statusFilter.addEventListener('change', filterProposals);

      renderProjectProposals();
    });

    function handleFileUpload(input, previewId) {
      const preview = document.getElementById(previewId);
      preview.innerHTML = '';
      const file = input.files[0];
      if (file) {
        const isValidType = file.type.match('application/pdf') ||
                           file.type.match('application/msword') ||
                           file.type.match('application/vnd.openxmlformats-officedocument.wordprocessingml.document') ||
                           file.type.match('image/png') ||
                           file.type.match('image/jpeg');

        if (isValidType && file.size <= 10 * 1024 * 1024) {
          const div = document.createElement('div');
          const icon = file.type.match('image/') ? 'fas fa-image' : 'fas fa-file-alt';
          div.innerHTML = `<i class="${icon} mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${file.name}</span>`;
          div.className = 'flex items-center';
          preview.appendChild(div);
        } else {
          alert('Please upload valid files under 10MB.');
          input.value = '';
          preview.innerHTML = '';
        }
      }
    }

    function filterProposals() {
      const searchTerm = document.getElementById('search').value.toLowerCase();
      const statusValue = document.getElementById('statusFilter').value;

      const filteredProposals = projectProposals.filter(proposal => {
        const matchesSearch = proposal.projectTitle.toLowerCase().includes(searchTerm);
        const matchesStatus = statusValue ? proposal.status === statusValue : true;
        return matchesSearch && matchesStatus && ['Ongoing', 'Completed', 'Past Due', 'Approved'].includes(proposal.status);
      });

      renderProjectProposals(filteredProposals);
    }

    function renderProjectProposals(proposals = projectProposals.filter(p => ['Ongoing', 'Completed', 'Past Due', 'Approved'].includes(p.status))) {
      const tbody = document.getElementById('proposalsTableBody');
      tbody.innerHTML = '';

      if (!proposals || proposals.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No project proposals found.</td></tr>`;
        return;
      }

      proposals.forEach(proposal => {
        const statusMap = {
          Ongoing: 'bg-yellow-100 text-yellow-800',
          Completed: 'bg-green-100 text-green-800',
          'Past Due': 'bg-orange-100 text-orange-800',
          Approved: 'bg-blue-100 text-blue-800'
        };
        const statusColor = statusMap[proposal.status] || 'bg-gray-100 text-gray-800';
        const isCompletedWithPost = proposal.status === 'Completed' && proposal.hasPost;

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
                ${proposal.hasProjectDetails ? `
                  <button onclick="openViewProjectModal(${proposal.id})"
                    class="bg-teal-600 hover:bg-teal-700 text-white py-1 px-3 rounded-md text-sm inline-flex items-center justify-center w-20">
                    View
                  </button>
                ` : ''}
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="inline-block">
                <button onclick="openBudgetReleasedModal(${proposal.id})"
                  class="bg-teal-600 hover:bg-teal-700 text-white py-1 px-3 rounded-md text-sm inline-flex items-center justify-center w-20">
                  View
                </button>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              ${proposal.projectTitle === 'Basketball Court Renovation' || proposal.projectTitle === 'Electricity & Garbage Fee' || proposal.projectTitle === 'Community Garden Setup' ? `
                <div class="inline-block">
                  <button onclick="openAuditFileModal(${proposal.id})"
                    class="bg-teal-600 hover:bg-teal-700 text-white py-1 px-3 rounded-md text-sm inline-flex items-center justify-center w-20">
                    Add
                  </button>
                </div>
              ` : proposal.projectTitle === 'Street Lighting Upgrade' || proposal.projectTitle === 'Admin Payroll - Month of October 2025' ? `
                <div class="inline-block">
                  <button onclick="openAuditFileModal(${proposal.id})"
                    class="bg-teal-600 hover:bg-teal-700 text-white py-1 px-3 rounded-md text-sm inline-flex items-center justify-center w-20">
                    View
                  </button>
                </div>
              ` : ''}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              ${isCompletedWithPost ? `
                <div class="inline-block">
                  <a href="aud-newsfeed.html"
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

    function openEditProjectModal(id) {
      const proposal = projectProposals.find(p => p.id === id);
      if (proposal) {
        document.getElementById('editProjectId').value = proposal.id;
        document.getElementById('editResolutionTitle').value = proposal.projectTitle;
        document.getElementById('editResolutionSummary').value = proposal.description;
        document.getElementById('editEstimatedBudget').value = proposal.estimatedBudget || '';
        document.getElementById('editResolutionStartDate').value = proposal.startDate;
        document.getElementById('editResolutionTargetCompletion').value = proposal.targetCompletion;
        document.getElementById('editResolutionProposedBy').value = proposal.proposedBy || 'HOA Board of Directors';

        const proposalPreview = document.getElementById('editProjectProposalPreview');
        proposalPreview.innerHTML = '';
        if (proposal.projectProposalDoc) {
          const div = document.createElement('div');
          div.innerHTML = `<i class="fas fa-file-alt mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.projectProposalDoc}</span>`;
          div.className = 'flex items-center';
          proposalPreview.appendChild(div);
        }

        const signedResolutionPreview = document.getElementById('editSignedResolutionPreview');
        signedResolutionPreview.innerHTML = '';
        if (proposal.signedResolutionFile) {
          const div = document.createElement('div');
          div.innerHTML = `<i class="fas fa-file-alt mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.signedResolutionFile}</span>`;
          div.className = 'flex items-center';
          signedResolutionPreview.appendChild(div);
        }

        document.getElementById('editProjectModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }
    }

    function closeEditProjectModal() {
      document.getElementById('editProjectModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('editProjectForm').reset();
      document.getElementById('editProjectProposalPreview').innerHTML = '';
      document.getElementById('editSignedResolutionPreview').innerHTML = '';
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

        projectProposalPreview.innerHTML = proposal.projectProposalDoc
            ? `<div class="flex items-center"><i class="fas ${proposal.projectProposalDoc.match(/\.(jpg|jpeg|png)$/i) ? 'fa-image' : 'fa-file-alt'} mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.projectProposalDoc}</span></div>`
            : '<span class="text-sm text-gray-500">No document uploaded.</span>';
            
        signedResolutionPreview.innerHTML = proposal.signedResolutionFile
            ? `<div class="flex items-center"><i class="fas ${proposal.signedResolutionFile.match(/\.(jpg|jpeg|png)$/i) ? 'fa-image' : 'fa-file-alt'} mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.signedResolutionFile}</span></div>`
            : '<span class="text-sm text-gray-500">No document uploaded.</span>';

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
    }

    function openBoardResolutionModal() {
      const modal = document.getElementById('boardResolutionModal');
      const form = document.getElementById('boardResolutionForm');

      form.reset();
      document.getElementById('resolutionProposedBy').value = 'HOA Board of Directors';
      document.getElementById('resolutionStartDate').value = new Date().toISOString().split('T')[0];
      document.getElementById('projectProposalPreview').innerHTML = '';
      document.getElementById('signedResolutionPreview').innerHTML = '';

      modal.classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeBoardResolutionModal() {
      document.getElementById('boardResolutionModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('boardResolutionForm').reset();
      document.getElementById('projectProposalPreview').innerHTML = '';
      document.getElementById('signedResolutionPreview').innerHTML = '';
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
        document.getElementById('projectPostForm').dataset.projectId = proposal.id;
        document.getElementById('postProjectTitle').value = proposal.projectTitle;
        document.getElementById('postDescription').value = proposal.description;
        document.getElementById('postImagePreview').innerHTML = '';
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

    function openBudgetReleasedModal(id) {
      const proposal = projectProposals.find(p => p.id === id);
      if (proposal) {
        document.getElementById('budgetProjectId').value = proposal.id;
        
        const isProjectType = ['Basketball Court Renovation', 'Street Lighting Upgrade', 'Community Garden Setup'].includes(proposal.projectTitle);
        const projectBudgetFields = document.getElementById('projectBudgetFields');
        const budgetFields = document.getElementById('budgetFields');
        
        if (isProjectType) {
          projectBudgetFields.classList.remove('hidden');
          budgetFields.classList.add('hidden');
          
          document.getElementById('projectTitle').value = proposal.projectTitle;
          document.getElementById('amountReleased').value = proposal.budgetReleased?.amountReleased || '';
          document.getElementById('recipient').value = proposal.budgetReleased?.recipient || '';
          document.getElementById('releaseDate').value = proposal.budgetReleased?.releaseDate || new Date().toISOString().split('T')[0];
          document.getElementById('paymentMethod').value = proposal.budgetReleased?.paymentMethod || '';
          document.getElementById('referenceNumber').value = proposal.budgetReleased?.referenceNumber || '';
          document.getElementById('purpose').value = proposal.budgetReleased?.purpose || '';
          document.getElementById('approvalNotes').value = proposal.budgetReleased?.approvalNotes || '';
          
          const acknowledgePreview = document.getElementById('acknowledgementReceiptPreview');
          acknowledgePreview.innerHTML = '';
          if (proposal.budgetReleased?.proofOfRelease) {
            const div = document.createElement('div');
            div.innerHTML = `<i class="fas fa-file-alt mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.budgetReleased.proofOfRelease}</span>`;
            div.className = 'flex items-center';
            acknowledgePreview.appendChild(div);
          }
        } else {
          projectBudgetFields.classList.add('hidden');
          budgetFields.classList.remove('hidden');
          
          document.getElementById('budgetParticulars').value = proposal.projectTitle || '';
          document.getElementById('budgetDate').value = proposal.budgetReleased?.releaseDate || new Date().toISOString().split('T')[0];
          document.getElementById('transactionType').value = '';
          document.getElementById('namePayer').value = '';
          document.getElementById('nameReceiver').value = proposal.budgetReleased?.recipient || '';
          document.getElementById('budgetPaymentMethod').value = proposal.budgetReleased?.paymentMethod || '';
          document.getElementById('budgetReferenceNumber').value = proposal.budgetReleased?.referenceNumber || '';
          document.getElementById('budgetRemarks').value = proposal.budgetReleased?.purpose || '';

          const budgetAcknowledgePreview = document.getElementById('budgetAcknowledgementPreview');
          budgetAcknowledgePreview.innerHTML = '';
          if (proposal.budgetReleased?.proofOfRelease) {
            const div = document.createElement('div');
            div.innerHTML = `<i class="fas fa-file-alt mr-2 text-teal-600"></i><span class="text-sm text-gray-600">${proposal.budgetReleased.proofOfRelease}</span>`;
            div.className = 'flex items-center';
            budgetAcknowledgePreview.appendChild(div);
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
      document.getElementById('budgetAcknowledgementPreview').innerHTML = '';
      document.getElementById('acknowledgementReceiptPreview').innerHTML = '';
    }

    function openAuditFileModal(id) {
      document.getElementById('auditProjectId').value = id;
      document.getElementById('auditFileModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeAuditFileModal() {
      document.getElementById('auditFileModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('auditFileForm').reset();
      document.getElementById('auditFilePreview').innerHTML = '';
    }
  </script>
</body>
</html>

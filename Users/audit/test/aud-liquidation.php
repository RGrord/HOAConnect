<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Auditor's - Liquidation of Expenses</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
        <a href="aud-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-tachometer-alt mr-3"></i>
          <span>Dashboard</span>
        </a>
        <a href="aud-liquidation.php" class="flex items-center px-6 py-3 bg-teal-700">
          <i class="fas fa-file-invoice-dollar mr-3"></i>
          <span>Liquidation of Expenses</span>
        </a>
        <a href="aud-projectproposal.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-gavel mr-3"></i>
          <span>Resolution</span>
        </a>
        <a href="aud-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-newspaper mr-3"></i>
          <span>News Feed</span>
        </a>
        <a href="aud-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-book mr-3"></i>
          <span>Ledger</span>
        </a>
        <a href="aud-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-calendar-alt mr-3"></i>
          <span>Calendar</span>
        </a>
        <a href="aud-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
                <h1 class="text-2xl font-bold text-gray-900">Liquidation of Expenses</h1>
                <div class="flex items-center space-x-2">
                  <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                    <i class="fas fa-bell"></i>
                  </button>
                </div>
              </div>
        </header>

      <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
           <!-- Projects Table -->
           <div id="project-proposals" class="mb-8"> 
            <!-- Header Row with Title + Search/Filters -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
              <h2 class="text-xl font-semibold text-gray-900">Ongoing Projects Table</h2>
              
              <!-- Search and Filters -->
              <div class="flex flex-col sm:flex-row sm:space-x-4 mt-4 sm:mt-0">
                <div class="w-full sm:w-64">
                  <label for="search" class="sr-only">Search</label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input id="search" type="text" placeholder="Search by title"
                      class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
                  </div>
                </div>
                <div class="flex space-x-4 mt-4 sm:mt-0">
                  <div>
                    <label for="statusFilter" class="sr-only">Filter by Status</label>
                    <select id="statusFilter"
                      class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                      <option value="">All Statuses</option>
                      <option value="Ongoing">Approved</option>
                      <option value="Ongoing">In Progress</option>
                      <option value="Completed">Waiting for Approval</option>
                      <option value="Past Due">Rejected</option>
                      <option value="Ongoing">Pending</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PARTICULARS</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">BUDGET RELEASED</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ACTIONS</th>
                </tr>
              </thead>
              <tbody id="projectsTableBody" class="bg-white divide-y divide-gray-200">
                        <!-- Projects will be rendered here dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Expense Liquidation Modal -->
<div id="liquidationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-5xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Generate Expense Liquidation</h2>
            <button onclick="closeLiquidationModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div id="liquidationContent" class="p-6">
            <!-- Project Info -->
            <div class="mb-6 bg-teal-50 p-4 rounded-lg">
                <div class="mb-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Audit Project:</label>
                    <input type="text" id="auditProjectTitle" readonly class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-800 font-medium">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Released Budget:</label>
                    <input type="text" id="releasedBudget" readonly class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-800 font-medium">
                </div>
            </div>

            <p class="text-gray-600 mb-4">Enter actual expenses below. The system will automatically determine if the project was <span class="font-semibold text-red-600">Overspent</span>, <span class="font-semibold text-green-600">Underspent</span>, or <span class="font-semibold text-blue-600">Balanced</span> based on the released budget.</p>

            <!-- Expenses Table -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Expenses</h3>
                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 border-b">Particular</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 border-b">Amount</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 border-b">Receipt</th>
                                <th id="removeHeader" class="text-center py-3 px-4 font-semibold text-gray-700 border-b w-20">Remove</th>
                            </tr>
                        </thead>
                        <tbody id="expensesTableBody">
                            <!-- Expense rows will be added here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <button id="addExpensesBtn" onclick="addExpenseRow()" class="mb-6 bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700 transition-colors flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add Expenses
            </button>

            <!-- Total Expenses -->
            <div class="mb-4 bg-gray-50 p-4 rounded-lg">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold text-gray-800">Total Expenses:</span>
                    <span id="totalExpenses" class="text-2xl font-bold text-teal-600">₱0.00</span>
                </div>
            </div>

            <!-- Audit Result -->
            <div class="mb-6 p-4 rounded-lg border-2" id="auditResultContainer">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-semibold text-gray-800">Audit Result:</span>
                    <span id="auditResult" class="text-2xl font-bold">-</span>
                </div>
                <div class="mt-2 text-sm text-gray-600" id="auditDetails"></div>
            </div>

            <!-- Remarks -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Remarks (Optional):</label>
                <textarea id="remarks" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Enter any additional notes or remarks..."></textarea>
            </div>

            <!-- Notes for Rejection (Only for Rejected projects) -->
            <div id="rejectionNotesSection" class="mb-6 hidden">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Notes for Rejection:</label>
                <input type="text" id="rejectionNotes" readonly class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-800 font-medium" placeholder="Notes from President">
            </div>

            <!-- Action Buttons -->
            <div id="actionButtons" class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <button onclick="closeLiquidationModal()" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button onclick="showPreviewModal()" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors flex items-center">
                    <i class="fas fa-eye mr-2"></i>
                    Preview & Download
                </button>
                <button id="submitBtn" onclick="submitForApproval()" class="px-6 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 transition-colors flex items-center">
                    <i class="fas fa-check mr-2"></i>
                    Submit for Approval
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal for Expense Liquidation -->
<div id="previewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-5xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Expense Liquidation Preview</h2>
            <button onclick="closePreviewModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div id="previewContent" class="p-6 bg-white">
            <!-- Preview content will be generated here -->
        </div>

        <div class="sticky bottom-0 bg-white border-t border-gray-200 px-6 py-4 flex justify-end space-x-3">
            <button onclick="closePreviewModal()" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors">
                Close
            </button>
            <button onclick="downloadPDFFromPreview()" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors flex items-center">
                <i class="fas fa-download mr-2"></i>
                Download PDF
            </button>
        </div>
    </div>
</div>

<script>
    // Sample project data - ADDED Admin Payroll - Month of August with Rejected status
    const projects = [
        {
            id: 1,
            particular: 'Basketball Court Renovation',
            status: 'In Progress',
            budgetReleased: 150000
        },
        {
            id: 2,
            particular: 'Street Lighting Upgrade',
            status: 'Approved',
            budgetReleased: 85000
        },
        {
            id: 3,
            particular: 'Community Garden Setup',
            status: 'In Progress',
            budgetReleased: 45000
        },
        {
            id: 4,
            particular: 'Admin Payroll - Month of August',
            status: 'Waiting for Approval',
            budgetReleased: 120000
        },
        {
            id: 5,
            particular: 'Electricity & Garbage Fee',
            status: 'Pending',
            budgetReleased: 35000
        },
        {
            id: 6,
            particular: 'Admin Payroll - Month of August',
            status: 'Rejected',
            budgetReleased: 120000,
            rejectionNotes: 'Insufficient documentation provided for overtime hours.'
        }
    ];

    let currentProject = null;
    let expenseRowCounter = 0;

    // Render projects table
    function renderProjects() {
        const tbody = document.getElementById('projectsTableBody');
        tbody.innerHTML = '';

        projects.forEach(project => {
            const statusColors = {
                'In Progress': 'bg-blue-100 text-blue-800',
                'Approved': 'bg-green-100 text-green-800',
                'Pending': 'bg-yellow-100 text-yellow-800',
                'Waiting for Approval': 'bg-orange-100 text-orange-800',
                'Rejected': 'bg-red-100 text-red-800'
            };

            let actionButton = '';
            if (project.status === 'Approved') {
                actionButton = `<button onclick="viewDetails(${project.id})" class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700 transition-colors text-sm">View Details</button>`;
            } else if (project.status === 'Rejected') {
                actionButton = `<button onclick="editDetails(${project.id})" class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700 transition-colors text-sm">Edit Details</button>`;
            } else {
                actionButton = `<button onclick="openLiquidationModal(${project.id})" class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700 transition-colors text-sm">Generate Expense Liquidation</button>`;
            }

            const row = document.createElement('tr');
            row.className = 'border-b border-gray-200 hover:bg-gray-50';
            row.innerHTML = `
                <td class="py-3 px-4 text-gray-800">${project.particular}</td>
                <td class="py-3 px-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold ${statusColors[project.status]}">
                        ${project.status}
                    </span>
                </td>
                <td class="py-3 px-4 text-gray-800 font-medium">₱${project.budgetReleased.toLocaleString()}</td>
                <td class="py-3 px-4">
                    ${actionButton}
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // View Details for Approved projects (read-only)
    function viewDetails(projectId) {
        currentProject = projects.find(p => p.id === projectId);
        if (!currentProject) return;

        document.getElementById('auditProjectTitle').value = currentProject.particular;
        document.getElementById('releasedBudget').value = `₱${currentProject.budgetReleased.toLocaleString()}`;
        
        // Clear previous data
        document.getElementById('expensesTableBody').innerHTML = '';
        document.getElementById('remarks').value = '';
        expenseRowCounter = 0;
        
        // Hide add expenses button, remove header, and submit button
        document.getElementById('addExpensesBtn').style.display = 'none';
        document.getElementById('removeHeader').style.display = 'none';
        document.getElementById('submitBtn').style.display = 'none';
        
        // Add initial expense row (read-only)
        addReadOnlyExpenseRow();
        
        // Show modal
        document.getElementById('liquidationModal').classList.remove('hidden');
    }

    // Edit Details for Rejected projects
    function editDetails(projectId) {
        currentProject = projects.find(p => p.id === projectId);
        if (!currentProject) return;

        document.getElementById('auditProjectTitle').value = currentProject.particular;
        document.getElementById('releasedBudget').value = `₱${currentProject.budgetReleased.toLocaleString()}`;
        
        // Show rejection notes
        const rejectionSection = document.getElementById('rejectionNotesSection');
        rejectionSection.classList.remove('hidden');
        document.getElementById('rejectionNotes').value = currentProject.rejectionNotes || '';
        
        // Clear previous data
        document.getElementById('expensesTableBody').innerHTML = '';
        document.getElementById('remarks').value = '';
        expenseRowCounter = 0;
        
        // Add initial expense row
        addExpenseRow();
        
        // Show modal
        document.getElementById('liquidationModal').classList.remove('hidden');
    }

    // Open liquidation modal (for non-approved/rejected)
    function openLiquidationModal(projectId) {
        currentProject = projects.find(p => p.id === projectId);
        if (!currentProject) return;

        document.getElementById('auditProjectTitle').value = currentProject.particular;
        document.getElementById('releasedBudget').value = `₱${currentProject.budgetReleased.toLocaleString()}`;
        
        // Clear previous data
        document.getElementById('expensesTableBody').innerHTML = '';
        document.getElementById('remarks').value = '';
        expenseRowCounter = 0;
        
        // Show all buttons
        document.getElementById('addExpensesBtn').style.display = 'flex';
        document.getElementById('removeHeader').style.display = 'table-cell';
        document.getElementById('submitBtn').style.display = 'inline-flex';
        
        // Hide rejection notes
        document.getElementById('rejectionNotesSection').classList.add('hidden');
        
        // Add initial expense row
        addExpenseRow();
        
        // Show modal
        document.getElementById('liquidationModal').classList.remove('hidden');
    }

    // Close liquidation modal
    function closeLiquidationModal() {
        document.getElementById('liquidationModal').classList.add('hidden');
        currentProject = null;
        // Reset buttons to default
        document.getElementById('addExpensesBtn').style.display = 'flex';
        document.getElementById('removeHeader').style.display = 'table-cell';
        document.getElementById('submitBtn').style.display = 'inline-flex';
        document.getElementById('rejectionNotesSection').classList.add('hidden');
    }

    // Add expense row (editable)
    function addExpenseRow() {
        expenseRowCounter++;
        const tbody = document.getElementById('expensesTableBody');
        const row = document.createElement('tr');
        row.className = 'border-b border-gray-100';
        row.id = `expenseRow${expenseRowCounter}`;
        row.innerHTML = `
            <td class="py-2 px-4">
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Enter particular">
            </td>
            <td class="py-2 px-4">
                <input type="number" class="expense-amount w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="0.00" step="0.01" min="0" oninput="calculateTotal()">
            </td>
            <td class="py-2 px-4">
                <input type="file" accept="image/*,.pdf" class="receipt-file w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
            </td>
            <td class="py-2 px-4 text-center">
                <button onclick="removeExpenseRow(${expenseRowCounter})" class="text-red-600 hover:text-red-800 text-xl font-bold">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    }

    // Add read-only expense row (for approved projects)
    function addReadOnlyExpenseRow() {
        expenseRowCounter++;
        const tbody = document.getElementById('expensesTableBody');
        const row = document.createElement('tr');
        row.className = 'border-b border-gray-100';
        row.id = `expenseRow${expenseRowCounter}`;
        row.innerHTML = `
            <td class="py-2 px-4">
                <input type="text" class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md" placeholder="Enter particular" readonly>
            </td>
            <td class="py-2 px-4">
                <input type="number" class="expense-amount w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md" placeholder="0.00" step="0.01" min="0" readonly>
            </td>
            <td class="py-2 px-4">
                <input type="file" accept="image/*,.pdf" class="receipt-file w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" disabled>
            </td>
            <td class="py-2 px-4 text-center">
                <span class="text-gray-400">-</span>
            </td>
        `;
        tbody.appendChild(row);
    }

    // Remove expense row
    function removeExpenseRow(rowId) {
        const row = document.getElementById(`expenseRow${rowId}`);
        if (row) {
            row.remove();
            calculateTotal();
        }
    }

    // Calculate total expenses and audit result
    function calculateTotal() {
        const amountInputs = document.querySelectorAll('.expense-amount');
        let total = 0;
        
        amountInputs.forEach(input => {
            const value = parseFloat(input.value) || 0;
            total += value;
        });

        document.getElementById('totalExpenses').textContent = `₱${total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;

        // Calculate audit result
        if (currentProject && total > 0) {
            const budget = currentProject.budgetReleased;
            const difference = budget - total;
            const auditResultContainer = document.getElementById('auditResultContainer');
            const auditResult = document.getElementById('auditResult');
            const auditDetails = document.getElementById('auditDetails');

            if (Math.abs(difference) < 0.01) {
                // Balanced
                auditResultContainer.className = 'mb-6 p-4 rounded-lg border-2 border-blue-500 bg-blue-50';
                auditResult.className = 'text-2xl font-bold text-blue-600';
                auditResult.textContent = 'Balanced';
                auditDetails.textContent = 'The expenses match the released budget perfectly.';
            } else if (difference > 0) {
                // Underspent
                auditResultContainer.className = 'mb-6 p-4 rounded-lg border-2 border-green-500 bg-green-50';
                auditResult.className = 'text-2xl font-bold text-green-600';
                auditResult.textContent = 'Underspent';
                auditDetails.textContent = `Remaining budget: ₱${difference.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            } else {
                // Overspent
                auditResultContainer.className = 'mb-6 p-4 rounded-lg border-2 border-red-500 bg-red-50';
                auditResult.className = 'text-2xl font-bold text-red-600';
                auditResult.textContent = 'Overspent';
                auditDetails.textContent = `Over budget by: ₱${Math.abs(difference).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            }
        } else {
            const auditResultContainer = document.getElementById('auditResultContainer');
            auditResultContainer.className = 'mb-6 p-4 rounded-lg border-2 border-gray-300 bg-gray-50';
            document.getElementById('auditResult').className = 'text-2xl font-bold text-gray-600';
            document.getElementById('auditResult').textContent = '-';
            document.getElementById('auditDetails').textContent = '';
        }
    }

    function showPreviewModal() {
        const previewContent = document.getElementById('previewContent');
        
        // Get data from modal
        const projectTitle = document.getElementById('auditProjectTitle').value;
        const releasedBudget = document.getElementById('releasedBudget').value;
        const remarks = document.getElementById('remarks').value.trim();
        
        // Get expense data
        const expenseRows = document.querySelectorAll('#expensesTableBody tr');
        let expensesHTML = '';
        expenseRows.forEach(row => {
            const particular = row.querySelector('input[type="text"]').value;
            const amount = row.querySelector('.expense-amount').value;
            if (particular && amount) {
                expensesHTML += `
                    <tr class="border-b border-gray-100">
                        <td class="py-2 px-4 text-gray-800">${particular}</td>
                        <td class="py-2 px-4 text-gray-800 font-medium">₱${parseFloat(amount).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                        <td class="py-2 px-4 text-gray-600">Receipt attached</td>
                    </tr>
                `;
            }
        });
        
        // Create preview content
        let previewHTML = `
            <div class="mb-6 text-center border-b-2 border-gray-300 pb-4">
                <h1 class="text-2xl font-bold text-gray-800">HOAConnect</h1>
                <p class="text-sm text-gray-600">Homeowners Association</p>
                <p class="text-sm text-gray-600">Mabuhay Homes 2000, Paliparan II, Dasmariñas City, Cavite</p>
                <h2 class="text-xl font-bold text-gray-800 mt-3">LIQUIDATION OF EXPENSES</h2>
            </div>
            
            <!-- Project Info - Plain Text -->
            <div class="mb-6 bg-teal-50 p-4 rounded-lg">
                <div class="mb-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Audit Project</label>
                    <div class="w-full px-3 py-2 text-gray-800 font-medium">${projectTitle}</div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Released Budget</label>
                    <div class="w-full px-3 py-2 text-gray-800 font-medium">${releasedBudget}</div>
                </div>
            </div>

            <!-- Expenses Table -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Expenses</h3>
                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 border-b">Particular</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 border-b">Amount</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 border-b">Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${expensesHTML}
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Total Expenses -->
            <div class="mb-4 bg-gray-50 p-4 rounded-lg">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold text-gray-800">Total Expenses:</span>
                    <span id="previewTotalExpenses" class="text-2xl font-bold text-teal-600">${document.getElementById('totalExpenses').textContent}</span>
                </div>
            </div>

            <!-- Audit Result -->
            <div class="mb-6 p-4 rounded-lg border-2" id="previewAuditResultContainer">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-semibold text-gray-800">Audit Result:</span>
                    <span id="previewAuditResult">${document.getElementById('auditResult').textContent}</span>
                </div>
                <div class="mt-2 text-sm text-gray-600" id="previewAuditDetails">${document.getElementById('auditDetails').textContent}</div>
            </div>

            ${remarks ? `
                <!-- Remarks -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Remarks</label>
                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md">${remarks}</div>
                </div>
            ` : ''}
        `;

        // Add rejection notes to preview if present
        const rejectionNotes = document.getElementById('rejectionNotes').value;
        if (rejectionNotes) {
            previewHTML += `
                <!-- Notes for Rejection -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Notes for Rejection</label>
                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">${rejectionNotes}</div>
                </div>
            `;
        }
        
        previewContent.innerHTML = previewHTML;
        
        // Copy audit result styling
        const auditContainer = document.getElementById('auditResultContainer');
        const previewAuditContainer = document.getElementById('previewAuditResultContainer');
        previewAuditContainer.className = auditContainer.className;
        document.getElementById('previewAuditResult').className = document.getElementById('auditResult').className;
        
        // Show preview modal
        document.getElementById('previewModal').classList.remove('hidden');
    }

    function closePreviewModal() {
        document.getElementById('previewModal').classList.add('hidden');
    }

    async function downloadPDFFromPreview() {
        try {
            const previewContent = document.getElementById('previewContent');
            
            // Capture the preview content as an image
            const canvas = await html2canvas(previewContent, {
                scale: 2,
                useCORS: true,
                logging: false,
                backgroundColor: '#ffffff',
                allowTaint: true
            });
            
            // Create PDF
            const { jsPDF } = window.jspdf;
            const imgData = canvas.toDataURL('image/png');
            
            const doc = new jsPDF({
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            });
            
            const pageWidth = doc.internal.pageSize.getWidth();
            const pageHeight = doc.internal.pageSize.getHeight();
            
            // Calculate dimensions to fit the image on the page while maintaining aspect ratio
            const imgWidth = pageWidth - 10;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            
            // Add image to PDF
            doc.addImage(imgData, 'PNG', 5, 5, imgWidth, imgHeight);
            
            // If content is longer than one page, add additional pages
            let yPosition = imgHeight + 10;
            if (yPosition > pageHeight) {
                const totalPages = Math.ceil(imgHeight / (pageHeight - 10));
                for (let i = 1; i < totalPages; i++) {
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 5, 5 - (i * (pageHeight - 10)), imgWidth, imgHeight);
                }
            }
            
            // Save the PDF
            const safeProjectName = currentProject.particular.replace(/\s+/g, '_');
            doc.save(`Expense_Liquidation_${safeProjectName}.pdf`);
            
            // Close preview modal after download
            closePreviewModal();
        } catch (error) {
            console.error('Error generating PDF:', error);
            alert('Error generating PDF. Please try again.');
        }
    }

    function submitForApproval() {
        const rows = document.querySelectorAll('#expensesTableBody tr');
        if (rows.length === 0) {
            alert('Please add at least one expense before submitting.');
            return;
        }

        let hasEmptyFields = false;
        rows.forEach(row => {
            const particular = row.querySelector('input[type="text"]').value;
            const amount = row.querySelector('.expense-amount').value;
            if (!particular || !amount) {
                hasEmptyFields = true;
            }
        });

        if (hasEmptyFields) {
            alert('Please fill in all expense fields before submitting.');
            return;
        }

        if (confirm('Are you sure you want to submit this liquidation for approval?')) {
            alert('Liquidation submitted successfully! It will be reviewed by the administrator.');
            closeLiquidationModal();
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        renderProjects();
    });
</script>
</body>
</html>
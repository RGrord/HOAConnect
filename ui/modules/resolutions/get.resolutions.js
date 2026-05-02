import { $State } from '../../core/state.js';
import { DataFetcher } from '../../core/data-fetch.js';
import { TableView } from '../../core/table-view.js';

const BASE_URL = '/hoa_system/';
const API_URL = `${BASE_URL}app/api/resolutions/get.resolutions.php`;

const $state = $State({
  search: '',
  pagination: {
    currentPage: 1,
    limit: 10,
    totalPages: 0,
    totalRecords: 0
  },
  data: [],
  loading: false
});

const fetcher = new DataFetcher($state, API_URL);

const columns = [
  row => `
    <div class="max-w-xs">
      <div class="font-semibold text-gray-900 truncate">
        ${row.project_resolution_title || '—'}
      </div>
      <div class="text-sm text-gray-600 line-clamp-2">
        ${row.resolution_summary || 'No summary available'}
      </div>
    </div>
  `,

  row => {
    const approved = row.is_budget_released == 0 &&
                    row.status == 1
    const ongoing = row.is_budget_released == 1 &&
                    row.status == 1 &&
                    row.liquidation_status != 1

    const completed = row.is_budget_released == 1 &&
                      row.status == 1 &&
                      row.liquidation_status == 1
    if (approved) {
      return `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
        Approved
      </span>`;
    }
    if (ongoing) {
      return `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
        Ongoing
      </span>`;
    }

    if (completed) {
      return `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
        Completed
      </span>`;
    }

    return `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
      Pending
    </span>`;
  },

  row => {
    const start = row.target_start_date ? new Date(row.target_start_date).toLocaleDateString('en-PH') : '—';
    const end = row.target_end_date ? new Date(row.target_end_date).toLocaleDateString('en-PH') : '—';
    return `
      <div class="text-sm">
        <div class="font-medium text-gray-900">${start} → ${end}</div>
        <div class="text-xs text-gray-500">Proposed by: ${row.creator_name || '—'}</div>
      </div>
    `;
  },

  row => {
    const released = row.is_budget_released;
    const role = localStorage.getItem('role')

    if(role == 4){
      return released
      ? `<a href="view-budget.php?id=${row.id}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 hover:bg-green-200"><i class="ri-check-line mr-1"></i> Released</a>`
      : `<a href="budget-release.php?id=${row.id}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-gray-700"><i class="ri-add-large-line mr-1"></i> Add Budget</a>`;
    }
    
    return released
      ? `<a href="view-budget.php?id=${row.id}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 hover:bg-green-200"><i class="ri-check-line mr-1"></i> Released</a>`
      : '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700"><i class="ri-close-line mr-1"></i> Not Yet</span>';
  },

  row => {
    const hasFS = row.has_financial_summary == 1
    const role = localStorage.getItem('role') || ''
    const isApproved = row.status == 1
    const budgetReleased = row.budget_release == 1
    const id = row.id ?? 0

    if (role == 4 && isApproved && budgetReleased && !hasFS && row.has_validated == 0) {
      return `<a href="financial-summary.php?id=${id}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
        Verify Financial Summary
      </a>`
    }
    if (role == '5' && !hasFS && row.liquidation_status != 1) {
      return `<a href="#" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
        No liquidation yet
      </a>`
    }
    if (role == '5' && !hasFS && row.liquidation_status == 1) {
      return `<a href="financial-summary.php?id=${id}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
        Upload Liquidation
      </a>`
    }
    if (hasFS && row.has_validated == 0) {
      return `<a href="financial-summary.php?id=${id}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 hover:bg-yellow-200">
        <i class="ri-hourglass-fill mr-1"></i> Uploaded
      </a>`
    }
    if (row.has_validated == 1) {
      return `<a href="financial-summary.php?id=${id}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 hover:bg-green-200">
        <i class="ri-check-line mr-1"></i> Verified
      </a>`
    }

    return `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
      <i class="ri-close-line mr-1"></i> Not Uploaded
    </span>`
  },

  row => {
    const role = localStorage.getItem('role')
    if (role == 2) {
     return `
     <div class="flex items-center gap-3">
      <a href="view.php?id=${row.id}" 
         class="text-teal-600 hover:text-teal-800" title="View Resolution">
        <i class="ri-eye-fill text-xl"></i>
      </a>
       <a href="../../app/api/resolutions/getById.file.php?id=${row.id}" 
          target="_blank"
          class="text-red-600 hover:text-red-500 transition" 
          title="Download PDF Report">
          <i class="ri-file-download-line text-xl"></i>
        </a>
    </div>
    `
    }
    return `<div class="flex items-center gap-3">
      <a href="view.php?id=${row.id}" 
         class="text-teal-600 hover:text-teal-800" title="View Resolution">
        <i class="ri-eye-fill text-xl"></i>
      </a>
    </div>
  `}
];

new TableView($state, fetcher, {
  tableId: 'dataTable',
  searchId: 'simple-search',
  paginationId: 'paginationList',
  columns
});

function toast(msg, type = 'info') {
  const colors = { success: 'bg-green-600', error: 'bg-red-600', info: 'bg-blue-600', warning: 'bg-yellow-600' };
  const icons = { success: 'ri-check-line', error: 'ri-close-line', info: 'ri-information-line', warning: 'ri-alert-line' };

  const $toast = $(`
    <div role="alert" aria-live="assertive"
        class="fixed bottom-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-xl z-50 flex items-center gap-2 animate-fade-in">
      <i class="${icons[type]} text-lg"></i>
      <span>${msg}</span>
    </div>
  `);

  $('body').append($toast);
  setTimeout(() => $toast.addClass('animate-fade-out').on('animationend', () => $toast.remove()), 3500);
}
$('#downloadPdfBtn').on('click', function() {
  window.open('/hoa_system/app/api/resolutions/get.file.php', '_blank');
});
$(document).on('fetch:error', (e, msg) => toast(msg || 'Failed to load resolutions.', 'error'));
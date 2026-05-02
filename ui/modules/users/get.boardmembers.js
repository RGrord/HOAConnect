import { $State } from '../../core/state.js';
import { DataFetcher } from '../../core/data-fetch.js';
import { TableView } from '../../core/table-view.js';

const BASE_URL = '/hoa_system/';
const API_URL = `${BASE_URL}app/api/users/get.boardmembers.php`;

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
    <div class="flex items-center">
      <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold text-sm">
        ${row.fullName?.charAt(0) || '?'}
      </div>
      <div class="ml-3">
        <div class="font-medium text-gray-900">${row.fullName || '—'}</div>
        <div class="text-sm text-gray-500">${row.email_address || '—'}</div>
      </div>
    </div>`,

  row => {
    const roleMap = { 1: 'Admin', 2: 'Secretary', 3: 'President', 4: 'Treasurer', 5: 'Member' };
    const roleName = row.role_name || roleMap[row.role_id] || 'Unknown';
    return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
      ${roleName}
    </span>`;
  },
  row => row.status === 'Active'
    ? '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>'
    : '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Inactive</span>',

  row => { 
    const color = row.status == 'Active' ? 'red' : 'green'
    const title = row.status == 'Active' ? 'Deactivate' : 'Activate'
    const role = localStorage.getItem('role')

    return `<div class="flex items-center gap-2">
      <a 
        href="view.php?id=${row.user_id}" 
        class="text-teal-600 hover:text-teal-800" 
        title="View">
        <i class="ri-eye-fill text-xl"></i>
      </a>
      <a 
        id="actionBtn"
        href="javascript:void(0)" 
        class="text-teal-600 hover:text-teal-800 actionBtn" 
        title="${title}" data-action="${row.status}" data-id="${row.user_id}">
        <i class="ri-shut-down-line text-xl text-${color}-500 hover:text-${color}-300"></i>
      </a>
      <a href="../../../app/api/users/getById.boardmembers-file.php?id=${row.user_id}" 
        target="_blank"
        class="text-red-600 hover:text-red-800 transition" 
        title="Download PDF Report">
        <i class="ri-file-download-line text-xl"></i>
      </a>
    </div>`
  }
];

new TableView($state, fetcher, {
  tableId: 'dataTable',
  searchId: 'simple-search',
  paginationId: 'paginationList',
  columns
});

function toast(msg, type = 'info') {
  const colors = { success: 'bg-green-600', error: 'bg-red-600', info: 'bg-blue-600' };
  const icons = { success: 'ri-check-line', error: 'ri-close-line', info: 'ri-information-line' };

  const $toast = $(`
    <div role="alert" aria-live="assertive"
        class="fixed bottom-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-xl z-50 flex items-center gap-2 animate-fade-in">
      <i class="${icons[type]} text-lg"></i>
      <span>${msg}</span>
    </div>
  `);

  $('body').append($toast);
  setTimeout(() => $toast.addClass('animate-fade-out').on('animationend', () => $toast.remove()), 3000);
}
$('#downloadPdfBtn').on('click', function() {
  window.open('/hoa_system/app/api/users/get.boardmembers-file.php', '_blank');
});
$(document).on('fetch:error', (e, msg) => toast(msg || 'Failed to load.', 'error'));

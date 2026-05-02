import { $State } from '../../core/state.js';
import { DataFetcher } from '../../core/data-fetch.js';
import { TableView } from '../../core/table-view.js';

const BASE_URL = '/hoa_system/';
const API_URL = `${BASE_URL}app/api/fee-type/get.fee-type.php`;

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
  row => {
    const role = localStorage.getItem('role')
    const color = row.status === 'Active' ? 'red' : 'green';
    const title = row.status === 'Active' ? 'Deactivate' : 'Activate';

    if(role == 3 && (row.status == 'Active' || row.status == 'Inactive')) {
      return `<a 
          id="actionBtn"
          href="javascript:void(0)" 
          class="actionBtn" 
          title="${title}" data-action="${row.status}" data-id="${row.id}">
          <i class="ri-shut-down-line text-xl text-${color}-500 hover:text-${color}-300"></i>
        </a>`
    }else if (role == 3 && (row.status == 'Pending' || row.status == 'Rejected')){
      return `<a 
          href="javascript:void(0)" 
          title="${title}">
          <i class="ri-shut-down-line text-xl text-gray-500 hover:text-gray-300"></i>
        </a>`
    }

    return ``
  },
  row => `
    <div class="flex items-center">
      <div class="font-medium text-gray-900">${row.fee_name || '—'}</div>
    </div>`,

  row => {
    const amount = new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP',
      minimumFractionDigits: 2
    }).format(row.amount);

    return `<span class="font-medium text-green-600">${amount}</span>`;
  },

  row => { 
    const statusColors = {
      Pending:  "bg-yellow-100 text-yellow-800",
      Active: "bg-green-100 text-green-800",
      Inactive: "bg-red-100 text-red-800",
      Rejected: "bg-red-100 text-red-800",
    };

    const colorClass = statusColors[row.status] || "bg-gray-100 text-gray-800";

    return `
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${colorClass}">
            ${row.status}
        </span>
    `;
  },
   row => {
    const effectivity_date = new Date(row.effectivity_date).toLocaleDateString('en-PH', {
      month: 'short',
      day: 'numeric',
      year: 'numeric'
    });

    return `<span class="text-gray-500">${effectivity_date}</span>`;
  },
  
  row => { 
    const color = row.status === 'Active' ? 'red' : 'green';
    const title = row.status === 'Active' ? 'Deactivate' : 'Activate';
    const role = localStorage.getItem('role')

    if (row.status === 'Active' || row.status === 'Inactive') {
      return `
      <div class="flex items-center gap-2">
        <a 
          href="view.php?id=${row.id}"  
          class="text-teal-600">
          <i class="ri-eye-fill text-xl"></i> 
        </a>
        ${role == 3 ? ` <a href="../../app/api/fee-type/getById.file.php?id=${row.id}" 
          target="_blank"
          class="text-red-600"
          title="Download PDF Report">
          <i class="ri-file-download-line text-xl"></i>
        </a>` : ''}
      </div>
      `;
    } 
    return `
      <div class="flex gap-2">
        <a 
          href="view.php?id=${row.id}" 
          class="text-teal-600">
          <i class="ri-eye-fill text-xl"></i> 
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
  window.open('/hoa_system/app/api/fee-type/get.file.php', '_blank');
});
$(document).ready(function () {
  if ($('.actionBtn').length === 0) {
    $('table tbody td:first-child').hide();
    $('table').css('width', '100%');
  }
});
$(document).on('fetch:error', (e, msg) => toast(msg || 'Failed to load.', 'error'));

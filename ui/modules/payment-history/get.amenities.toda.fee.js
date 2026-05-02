import { $State } from '../../core/state.js';
import { DataFetcher } from '../../core/data-fetch.js';
import { TableView } from '../../core/table-view.js';

if (!$('[data-module="toda-history"]').length) {
  console.log('[TODA History] Not active on this page');
} else {
  console.log('[TODA History] LOADED');
}
const BASE_URL = '/hoa_system/';
const API_URL = `${BASE_URL}app/api/payment-history/get.toda.fee.php`;

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
    const method = row.payment_method || 'Cash';
    const badge = {
      'cash': 'bg-blue-100 text-blue-800',
      'gcash': 'bg-purple-100 text-purple-800',
      'bank_transfer': 'bg-indigo-100 text-indigo-800',
      'cheque': 'bg-gray-100 text-gray-800'
    }[method.toLowerCase()] || 'bg-gray-100 text-gray-700';

    return `<span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium ${badge}">
      ${method.charAt(0).toUpperCase() + method.slice(1).replace('_', ' ')}
    </span>`;
  },
  row => row.representative || 'N/A',
  row => {
    const amount = parseFloat(row.amount_paid || 0);
    const formatted = new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP'
    }).format(amount);
    return `<span class="font-semibold text-green-600 text-md">${formatted}</span>`;
  },
  row => {
    const date = new Date(row.date_created);
    return `<div class="text-sm text-gray-600">
      ${date.toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' })}
      <div class="text-xs text-gray-400">${date.toLocaleTimeString('en-PH', { hour: 'numeric', minute: '2-digit' })}</div>
    </div>`;
  },
  row => {
    const role = localStorage.getItem('role')
    if(role == 1 || role == 3 || role == 4){
      return `<a href="../../app/api/payment-history/getById.toda.file.php?id=${row.toda_id}" 
          target="_blank"
          class="text-red-600 hover:text-red-500 " 
          title="Download PDF Report">
          <i class="ri-file-download-line text-xl"></i>
        </a>`
    }
    return ``
  }
];

new TableView($state, fetcher, {
  tableId: 'todaHistoryTable',
  searchId: 'toda-fee-search',
  paginationId: 'toda_paginationList',
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
  setTimeout(() => $toast.addClass('animate-fade-out').on('animationend', () => $toast.remove()), 3500);
}

$(document).on('fetch:error', (e, msg) => toast(msg || 'Failed to load payment history.', 'error'));
import { $State } from '../../core/state.js';
import { DataFetcher } from '../../core/data-fetch.js';
import { TableView } from '../../core/table-view.js';

if (!$('[data-module="boardmembers"]').length) {
  console.log('[BoardMembers] Not active on this page');
} else {
  console.log('[BoardMembers] LOADED');
}

const BASE_URL = '/hoa_system/';
const API_URL = `${BASE_URL}app/api/fees/get.allHomeowners.php`;

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
      <div>
        <div class="font-medium text-gray-900">${row.name || '—'}</div>
      </div>
    </div>`,
  row => {
    const total = row.fees
      .reduce((sum, fee) => sum + parseFloat(fee.amount || 0), 0);

    const formatted = new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP',
      minimumFractionDigits: 2
    }).format(total);

    return `<span class="font-medium text-green-600 text-lg">${formatted}</span>`;
  },
  row => {
    if (row.fees.length === 0) {
      return '<span class="text-gray-500 text-xs">No fees recorded</span>';
    }

    const overdue = row.fees.filter(f => f.status === 'Overdue').length;
    const pending = row.fees.filter(f => f.status === 'Pending').length;
    const paid = row.fees.filter(f => f.status === 'Paid').length;

    if (overdue > 0) {
      return '<span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Overdue</span>';
    } else if (pending > 0) {
      return '<span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span>';
    } else if (paid > 0) {
      return '<span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Paid</span>';
    } else {
      return '<span class="text-gray-500 text-xs">—</span>';
    }
  },
  row => {
    if (row.fees.length === 0) return '<span class="text-gray-400">—</span>';

    const latest = row.fees
      .reduce((latest, fee) => {
        const current = new Date(fee.next_due_date);
        return (!latest || current > latest) ? current : latest;
      }, null);

    return new Date(latest).toLocaleDateString('en-PH', {
      month: 'short',
      day: 'numeric',
      year: 'numeric'
    });
  },
  row => {
  const dropdownId = `dropdown-${row.user_id}`;
  const buttonId = `dropdownButton-${row.user_id}`;

  return `
    <a href="view.php?id=${row.user_id}" class="view">
      View Details
    </a>
    <a href="payment.php?id=${row.user_id}" class="pay">
      Payment
    </a>
  `
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

$(document).on('fetch:error', (e, msg) => toast(msg || 'Failed to load.', 'error'));

import { $State } from '../../../../ui/core/state.js';
import { DataFetcher } from '../../../../ui/core/data-fetch.js';
import { TableView } from '../../../../ui/core/table-view.js';

if (!$('[data-module="stallrentals"]').length) {
  console.log('[StallRentals] Not active on this page');
} else {
  console.log('[StallRentals] LOADED');
}

const BASE_URL = '/hoa_system/';
const API_URL = `${BASE_URL}app/api/amenities/stall/get.renter.php`;

const $state = $State({
  search: '',
  pagination: { currentPage: 1, limit: 10, totalPages: 0, totalRecords: 0 },
  data: [],
  loading: false
});

const fetcher = new DataFetcher($state, API_URL);

const columns = [
  row => `<div class="font-medium text-gray-900">${row.renter_name || '—'}</div>`,
  row => `<div class="text-gray-500">${row.contact_no || '—'}</div>`,
  row => `<div class="text-gray-500">Stall ${row.stall_id || '—'}</div>`,
  row => {
    const start = new Date(row.start_date).toLocaleDateString('en-PH', {
      month: 'short',
      day: 'numeric',
      year: 'numeric'
    });
    const end = new Date(row.end_date).toLocaleDateString('en-PH', {
      month: 'short',
      day: 'numeric',
      year: 'numeric'
    });

    return `<span class="text-gray-500">${start} - ${end}</span>`;
  },
  row => {
    const amount = new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP',
      minimumFractionDigits: 2
    }).format(row.amount);

    return `<span class="font-medium text-green-600">${amount}</span>`;
  },
  row => row.status === 1
    ? '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>'
    : '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Inactive</span>',
  row => { 
    const role = localStorage.getItem('role');
    if(role == 3){
      return `
       <div class="flex items-center gap-2">
        <a 
          href="view.php?id=${row.id}" 
          class="text-teal-600 hover:text-teal-800" 
          title="View">
          <i class="ri-eye-fill text-xl"></i>
        </a>
        <a 
          href="payment.php?id=${row.id}"  
          class="flex items-center gap-2 px-4 py-2 transition">
          <i class="ri-wallet-line text-xl text-green-600"></i> 
        </a>
        <a href="../../../app/api/amenities/stall/getById.file.php?id=${row.id}" 
          target="_blank"
          class="text-red-600 hover:text-red-800 transition" 
          title="Download PDF Report">
          <i class="ri-file-download-line text-xl"></i>
        </a>
      </div>`;
    }
    return `<a 
          href="view.php?id=${row.id}" 
          class="text-teal-600 hover:text-teal-800" 
          title="View">
          <i class="ri-eye-fill text-xl"></i>
        </a>`
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
  window.open('/hoa_system/app/api/amenities/stall/get.file.php', '_blank');
});
$(document).on('fetch:error', (e, msg) => toast(msg || 'Failed to load.', 'error'));

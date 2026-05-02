import { $State } from '../../../../ui/core/state.js';
import { DataFetcher } from '../../../../ui/core/data-fetch.js';
import { TableView } from '../../../../ui/core/table-view.js';

if (!$('[data-module="courtrentals"]').length) {
  console.log('[CourtRentals] Not active on this page');
} else {
  console.log('[CourtRentals] LOADED');
}

const BASE_URL = '/hoa_system/';
const API_URL = `${BASE_URL}app/api/amenities/court/get.court.php`;

const $state = $State({
  search: '',
  pagination: { currentPage: 1, limit: 10, totalPages: 0, totalRecords: 0 },
  data: [],
  loading: false
});

const fetcher = new DataFetcher($state, API_URL);

const columns = [
  row => { 
    return `
    <div class="flex items-center">
      <div>
        <div class="font-medium text-gray-900">${row.renter_name || '—'}</div>
        <div class="text-sm text-gray-500">${row.contact_no || '—'}</div>
      </div>
    </div>`
  },
  row => {
    return new Date(row.start_date).toLocaleString('en-PH', {
      month: 'short',
      day: 'numeric',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      hour12: true
    });
  },
  row => {
    return new Date(row.end_date).toLocaleString('en-PH', {
      month: 'short',
      day: 'numeric',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      hour12: true
    });
  },
  row => `<div class="text-gray-500">${row.no_of_participants || '—'}</div>`,
  row => `<div class="text-gray-900 font-medium">${row.purpose || '—'}</div>`,
  row => {
    const amount = new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP',
      minimumFractionDigits: 2
    }).format(row.amount);

    return `<div class="text-gray-900 font-medium">${amount}</div>` 
  },
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
        <a href="../../../app/api/amenities/court/getById.file.php?id=${row.id}" 
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

// Toast helper
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
  window.open('/hoa_system/app/api/amenities/court/get.file.php', '_blank');
});
$(document).on('fetch:error', (e, msg) => toast(msg || 'Failed to load.', 'error'));

import { $State } from '../../core/state.js';
import { DataFetcher } from '../../core/data-fetch.js';
import { TableView } from '../../core/table-view.js';

const BASE_URL = '/hoa_system/';
const API_URL = `${BASE_URL}app/api/liquidation/get.liquidation.php`;

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
      <div class="text-xs text-gray-600 mt-1">
        ID: RES${String(row.proj_id).padStart(5, '0')}
      </div>
    </div>
  `,

  row => {
    const released = row.is_budget_released;
    return released
      ? `<span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
           <i class="ri-check-double-line mr-1"></i> Released
         </span>`
      : `<span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700">
           <i class="ri-time-line mr-1"></i> Not Yet
         </span>`;
  },

  row => {
    const liq = row.liq_status;
    const statusMap = {
      null: { label: 'No Liquidation', color: 'bg-orange-100 text-orange-800', icon: 'ri-file-warning-line' },
      0:    { label: 'Pending',       color: 'bg-yellow-100 text-yellow-800', icon: 'ri-hourglass-line' },
      1:    { label: 'Approved',      color: 'bg-green-100 text-green-800',   icon: 'ri-check-line' },
      2:    { label: 'Rejected',      color: 'bg-red-100 text-red-800',       icon: 'ri-close-line' }
    };
    const s = statusMap[liq] || statusMap[null];

    return `<span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold ${s.color}">
              <i class="${s.icon} mr-1"></i> ${s.label}
            </span>`;
  },

  row => {
    const role = localStorage.getItem('role')
    return `<div class="flex items-center gap-3">
      ${row.liq_status !== null ? `
        <a href="view.php?id=${row.liq_id}" 
           class="text-purple-600 hover:text-purple-800 transition" title="View Liquidation">
          <i class="ri-file-search-line text-xl"></i>
        </a>` : ''
      }
      ${row.liq_id && (role == 1 || role == 5) ? `
        <a href="../../app/api/liquidation/getById.liquidation-file.php?id=${row.liq_id}" 
          target="_blank"
          class="text-red-600 hover:text-red-800 transition" 
          title="Download PDF Report">
          <i class="ri-file-download-line text-xl"></i>
        </a>` : ''
      }
      ${row.is_budget_released && row.liq_status === null ? `
        <a href="generate.php?id=${row.proj_id}" 
           class="text-blue-600 hover:text-blue-800 transition" title="Create Liquidation">
          <i class="ri-add-box-line text-xl"></i>
        </a>` : ''
      }

    </div>`
  }
];

new TableView($state, fetcher, {
  tableId: 'dataTable',
  searchId: 'simple-search',
  paginationId: 'paginationList',
  columns
});

// TOAST NOTIFICATION (optional pero maganda)
function toast(msg, type = 'info') {
  const colors = { success: 'bg-green-600', error: 'bg-red-600', info: 'bg-blue-600', warning: 'bg-yellow-600' };
  const icons = { success: 'ri-check-line', error: 'ri-close-line', info: 'ri-information-line', warning: 'ri-alert-line' };

  const $toast = $(`
    <div role="alert" class="fixed bottom-6 right-6 ${colors[type]} text-white px-6 py-4 rounded-xl shadow-2xl z-50 flex items-center gap-3 animate-slide-in">
      <i class="${icons[type]} text-xl"></i>
      <span class="font-medium">${msg}</span>
    </div>
  `);

  $('body').append($toast);
  setTimeout(() => $toast.addClass('animate-slide-out').on('animationend', () => $toast.remove()), 4000);
}
$('#downloadPdfBtn').on('click', function() {
  window.open('/hoa_system/app/api/liquidation/get.liquidation-file.php', '_blank');
});
$(document).on('fetch:error', (e, msg) => toast(msg || 'Failed to load data.', 'error'));
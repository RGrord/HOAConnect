import { $State } from '../../core/state.js';
import { DataFetcher } from '../../core/data-fetch.js';
import { TableView } from '../../core/table-view.js';

const BASE_URL = '/hoa_system/';
const PAYMENT_API_URL = `${BASE_URL}app/api/fees/get.allPaidFees.php`;
const TRIC_API_URL = `${BASE_URL}app/api/amenities/tricycle/get.tricycle.php`;
const COURT_API_URL = `${BASE_URL}app/api/amenities/court/get.court.php`;
const STALL_API_URL = `${BASE_URL}app/api/amenities/stall/get.renter.php`;

const $historyState = $State({
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
const $tricycleState = $State({
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
const $courtState = $State({
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
const $stallState = $State({
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

const historyFetcher = new DataFetcher($historyState, PAYMENT_API_URL);
const tricycleFetcher = new DataFetcher($tricycleState, TRIC_API_URL);
const courtFetcher = new DataFetcher($courtState, COURT_API_URL);
const stallFetcher = new DataFetcher($stallState, STALL_API_URL);

const historyColumns = [
  row => `
    <div class="flex items-center">
      <div class="font-medium text-gray-900">${row.id || '—'}</div>
    </div>`,
  row => `
    <div class="flex items-center">
      <div class="font-medium text-gray-900">${row.due_name || '—'}</div>
    </div>`,

  row => {
    const amount = new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP',
      minimumFractionDigits: 2
    }).format(row.amount);

    return `<span class="font-medium text-green-600">${amount}</span>`;
  },

  row => row.status === 'Active'
    ? '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>'
    : '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Inactive</span>',

  row => { 
    const color = row.status == 'Active' ? 'red' : 'green'
    const title = row.status == 'Active' ? 'Deactivate' : 'Activate'
    return `
      <a 
        id="actionBtn"
        href="javascript:void(0)" 
        class="text-teal-600 hover:text-teal-800 actionBtn" 
        title="${title}" data-action="${row.status}" data-id="${row.id}">
        <i class="ri-shut-down-line text-xl text-${color}-500 hover:text-${color}-300"></i>
      </a>`
  }
];
const tricycleColumns = [
  row => `<div class="font-medium text-gray-900">${row.toda_name || '—'}</div>`,
  row => `<div class="text-gray-500">${row.no_of_tricycles || '—'}</div>`,
  row => row.status === 'Active'
    ? '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>'
    : '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Inactive</span>',
  row => `<div class="text-gray-500">${row.date_start || '—'}</div>`,
  row => `<div class="text-gray-500">${row.date_end || '—'}</div>`,
  row => `<div class="text-gray-500">${row.representative || '—'}</div>`,
  row => `<div class="text-gray-500">${row.contact_no || '—'}</div>`,
  row => `
    <div class="flex items-center gap-2">
      <a href="view.php?id=${row.id}" class="text-teal-600 hover:text-teal-800" title="View">
        <i class="ri-eye-fill text-xl"></i>
      </a>
    </div>`
];
const courtColumns = [
  row => { 
    return `
    <div class="flex items-center">
      <div>
        <div class="font-medium text-gray-900">${row.renter || '—'}</div>
        <div class="text-sm text-gray-500">${row.contact_no || '—'}</div>
      </div>
    </div>`
  },
  row => `<div class="text-gray-500">${row.date_start || '—'}</div>`,
  row => `<div class="text-gray-500">${row.date_end || '—'}</div>`,
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
  row => `
    <div class="flex items-center gap-2">
      <a href="view.php?id=${row.id}" class="text-teal-600 hover:text-teal-800" title="View">
        <i class="ri-eye-fill text-xl"></i>
      </a>
    </div>`
];
const stallColumns = [
  row => `<div class="font-medium text-gray-900">${row.renter || '—'}</div>`,
  row => `<div class="text-gray-500">${row.contact_no || '—'}</div>`,
  row => `<div class="text-gray-500">Stall ${row.stall_id || '—'}</div>`,
  row => {
    const start = new Date(row.date_start).toLocaleDateString('en-PH', {
      month: 'short',
      day: 'numeric',
      year: 'numeric'
    });
    const end = new Date(row.date_end).toLocaleDateString('en-PH', {
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
  row => { 
    const statusColors = {
      Pending:  "bg-yellow-100 text-yellow-800",
      Approved: "bg-green-100 text-green-800",
      Paid: "bg-green-100 text-green-800",
      Rejected: "bg-red-100 text-red-800",
      Cancelled:"bg-gray-100 text-gray-800"
    };

    const colorClass = statusColors[row.status] || "bg-gray-100 text-gray-800";

    return `
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${colorClass}">
            ${row.status}
        </span>
    `
  },
  row => ` 
    <div class="flex items-center gap-2">
      <a href="view.php?id=${row.id}" class="text-teal-600 hover:text-teal-800" title="View">
        <i class="ri-eye-fill text-xl"></i>
      </a>
    </div>`
];

new TableView($historyState, historyFetcher, {
  tableId: 'historyTable',
  searchId: 'simple-search',
  paginationId: 'history_paginationList',
  columns: historyColumns
});
new TableView($tricycleState, tricycleFetcher, {
  tableId: 'tricycleTable',
  searchId: 'simple-search',
  paginationId: 'tricycle_paginationList',
  columns: tricycleColumns
});
new TableView($courtState, courtFetcher, {
  tableId: 'courtTable',
  searchId: 'simple-search',
  paginationId: 'court_paginationList',
  columns: courtColumns
});
new TableView($stallState, stallFetcher, {
  tableId: 'stallTable',
  searchId: 'simple-search',
  paginationId: 'stall_paginationList',
  columns: stallColumns
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

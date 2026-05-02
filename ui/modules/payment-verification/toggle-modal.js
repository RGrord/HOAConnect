import { $State } from '../../core/state.js';
import { DataFetcher } from '../../core/data-fetch.js';
import { TableView } from '../../core/table-view.js';

const BASE_URL = '/hoa_system/';
const API_URL = `${BASE_URL}app/api/fees/get.payment-verification.php`;

const $state = $State({
  search: '',
  pagination: { currentPage: 1, limit: 10, totalPages: 0, totalRecords: 0 },
  data: [],
  loading: false
});

const fetcher = new DataFetcher($state, API_URL);

const columns = [
  row => `<div class="font-medium text-gray-900">${row.full_name || '—'}</div>`,
  row => `<span class="text-gray-700">${row.payment_for || '—'}</span>`,
  row => {
    const amount = new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP', minimumFractionDigits: 2 }).format(row.amount_paid);
    return `<div class="text-green-700 font-medium">${amount}</div>` 
  },
  row => `<span class="text-gray-700">${row.ref_no || '—'}</span>`,
  row => `<button class="viewDetailsBtn px-2 py-1 bg-teal-600 text-white rounded hover:bg-teal-700" 
                 data-id="${row.id}">View</button>`
];

new TableView($state, fetcher, {
  tableId: 'dataTable',
  searchId: 'simple-search',
  paginationId: 'paginationList',
  columns
});

const modal = $('#paymentModal');
const closeModal = $('#closeModal');
const detailFields = {
  name: $('#detailName'),
  for: $('#detailFor'),
  amount: $('#detailAmount'),
  ref: $('#detailRef'),
  method: $('#detailMethod'),
  // attachment: $('#detailAttachment')
};

$(document).on('click', '.viewDetailsBtn', async function() {
  const id = $(this).data('id');

  const res = await fetch(`${BASE_URL}app/api/fees/get.payment-verification.php?id=${id}`);
  const data = await res.json();
  if (data.success && data.data.length) {
    const row = data.data[0];
    detailFields.name.text(row.full_name);
    detailFields.for.text(row.payment_for);
    detailFields.amount.text(new Intl.NumberFormat('en-PH', { style:'currency', currency:'PHP'}).format(row.amount_paid));
    detailFields.ref.text(row.ref_no || '—');
    detailFields.method.text(row.payment_method || '—');
    // detailFields.attachment.attr('href', row.attachment || '#');
    modal.removeClass('hidden');
    $('body').addClass('overflow-hidden');

    $('#approveBtn').off('click').on('click', async () => handleAction(id, 'approve'));
    $('#rejectBtn').off('click').on('click', async () => handleAction(id, 'reject'));
    $('#cancelBtn').off('click').on('click', () => closeModalHandler());
  }
});

function closeModalHandler() {
  modal.addClass('hidden');
  $('body').removeClass('overflow-hidden');
}

async function handleAction(id, action) {
  const res = await fetch(`${BASE_URL}app/api/fees/verify.payment.php?id=${id}&action=${action}`, { method: 'POST' });
  const data = await res.json();
  if (data.success) {
    alert(`${action.charAt(0).toUpperCase() + action.slice(1)}d successfully`);
    closeModalHandler();
    fetcher.fetch();
  } else {
    alert('Failed: ' + data.message);
  }
}

closeModal.on('click', closeModalHandler);

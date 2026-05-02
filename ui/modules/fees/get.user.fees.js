import { $State } from '../../core/state.js';
import { DataFetcher } from '../../core/data-fetch.js';
import { TableView } from '../../core/table-view.js';
import { showToast } from '../../utils/toast.js';

if (!$('[data-module="my-fees"]').length) {
  console.log('[My Fees] Not on this page');
} else {
  console.log('[My Fees] LOADED – Homeowner Portal');
}

const API_URL = '/hoa_system/app/api/my-fees/getById.fees.php';

const $state = $State({
  search: '',
  status: 'all',
  pagination: { currentPage: 1, limit: 15, totalPages: 0, totalRecords: 0 },
  data: [],
  summary: { total_unpaid: 0, total_paid: 0, total_due: 0 },
  loading: false
});

const fetcher = new DataFetcher($state, API_URL);

const columns = [
  row => `
    <div>
      <div class="font-bold text-gray-900">${row.fee_name || 'Unknown Fee'}</div>
      ${row.description ? `<div class="text-xs text-gray-500 mt-1">${row.description}</div>` : ''}
    </div>
  `,

  row => {
    const fmt = new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(row.amount);
    return `<span class="text-lg font-bold ${row.status == 0 ? 'text-red-600' : 'text-green-600'}">${fmt}</span>`;
  },

  row => {
    const statusStyles = {
      'Paid': {
        bg: 'bg-green-100',
        text: 'text-green-800'
      },
      'Unpaid': {
        bg: 'bg-red-100',
        text: 'text-red-800'
      },
      'Waiting for Verification': {
        bg: 'bg-yellow-100',
        text: 'text-yellow-800'
      }
    };

    const s = statusStyles[row.status_text] || {
      bg: 'bg-gray-100',
      text: 'text-gray-800'
    };

    return `
      <span class="text-nowrap inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${s.bg} ${s.text}">
        ${row.status_text}
      </span>
    `;
  },

  row => {
    const d = new Date(row.date_created);
    return `<div class="text-sm text-gray-600">
      ${d.toLocaleDateString('en-PH')}
      <div class="text-xs text-gray-400">${d.toLocaleTimeString('en-PH', { hour: 'numeric', minute: '2-digit' })}</div>
    </div>`;
  },

  row => { 
    if(row.status !== 4) {
    return `
    <div class="flex gap-2">
      <button 
        class="openPaymentModal bg-teal-600 hover:bg-teal-700 py-2 px-4 rounded-lg text-white transition"
        data-user-id="${row.user_id}"
        data-fee-ids='${JSON.stringify([row.id])}'
        data-total="${row.amount}"
      >
        Pay Now
      </button>
    </div>` 
    }

    return `<span class="text-sm text-gray-500">—</span>`
  }
];

new TableView($state, fetcher, {
  tableId: 'myFeesTable',
  searchId: 'fee-search',
  paginationId: 'feesPagination',
  columns
});

$(document).on('click', '[data-status]', function () {
  const status = $(this).data('status');
  $state.set({ status, 'pagination.currentPage': 1 });
  $('[data-status]').removeClass('bg-teal-600 text-white').addClass('bg-gray-200 text-gray-700');
  $(this).removeClass('bg-gray-200 text-gray-700').addClass('bg-teal-600 text-white');
  fetcher.fetch();
});

$(document).on('fetch:error', (_, msg) => toast(msg || 'Failed to load fees', 'error'));

$(document).on('click', '.openPaymentModal', function () {
  const userId = $('#user_id').data('user-id');
  const feeIds = $(this).data('fee-ids');
  const total  = $(this).data('total');

  $('#paymentModal').removeClass('hidden');

  $('#user_id').val(userId);

  $('#amount').val(
    new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(total)
  );

  window.selectedFeeIds = feeIds;

  $('#payment-method').val('');
  $('#payment-date').val(new Date().toISOString().slice(0, 10));
  $('#receipt-name').val('');
  $('#payment-proof').val('');
  $('#remarks').val('');
});


$('#payment-form').on('submit', function (e) {
  e.preventDefault();

  const formData = new FormData();
  const userId = $("#user_id").val();
  const feeIds = window.selectedFeeIds || [];
  const paymentMethod = $("#payment-method").val();
  const paymentDate = $("#payment-date").val();
  const receiptName = $("#receipt-name").val();
  const remarks = $("#remarks").val();
  const proofFile = $("#payment-proof")[0].files[0];

  formData.append('user_id', userId);

  feeIds.forEach(id => formData.append('fee_ids[]', id));

  formData.append('payment_method', paymentMethod);
  formData.append('payment_date', paymentDate);
  formData.append('receipt_name', receiptName);
  formData.append('remarks', remarks);

  if (proofFile) {
    formData.append('attachment', proofFile);
  }

  $.ajax({
    url: '/hoa_system/app/api/fee-assignation/post.fee-payment.php',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    beforeSend: () => {
      $('#payment-form button[type="submit"]').prop('disabled', true).text('Submitting...');
    },
    success: res => {
      if (res.success) {
        showToast({ message: 'Payment recorded successfully!', type: 'success' });

        $('#paymentModal').addClass('hidden');
        $('#payment-form')[0].reset();
        window.selectedFeeIds = [];

        fetcher.fetch();
      } else {
        showToast({ message: res.message || 'Payment failed', type: 'error' });
      }
    },
    error: () => {
      showToast({ message: 'Request error', type: 'error' });
    },
    complete: () => {
      $('#payment-form button[type="submit"]').prop('disabled', false).text('Submit Payment');
    }
  });
});

$('#closePaymentModal').on('click', () => $('#paymentModal').addClass('hidden'));

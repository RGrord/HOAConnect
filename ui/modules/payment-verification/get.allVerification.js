import { $State } from '../../core/state.js';
import { DataFetcher } from '../../core/data-fetch.js';
import { TableView } from '../../core/table-view.js';
import { showToast } from '../../utils/toast.js';

if (!$('[data-module="boardmembers"]').length) {
  console.log('[BoardMembers] Not active on this page');
} else {
  console.log('[BoardMembers] LOADED');
}

const BASE_URL = '/hoa_system/';
const API_URL = `${BASE_URL}app/api/fees/get.payment-verification.php`;

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
        <div class="font-medium text-gray-900">${row.full_name || '—'}</div>
      </div>
    </div>`,

  row => `<span class="text-gray-700">${row.payment_for || '—'}</span>`,
  
  row => {
    const amount = new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP',
      minimumFractionDigits: 2
    }).format(row.amount);

    return `<div class="text-green-700 font-medium">${amount}</div>` 
  },

  row => `<span class="text-gray-700">${row.ref_no || '—'}</span>`,

  row => 
    `
    <div class="flex gap-2">
      <button 
        class="btn-verify-payment px-4 py-2 bg-teal-600 text-white rounded-lg"
        data-ref="${row.ref_no}">
        <i class="ri-eye-fill"></i> View
      </button>
    </div>`
];

new TableView($state, fetcher, {
  tableId: 'dataTable',
  searchId: 'simple-search',
  paginationId: 'paginationList',
  columns
});

function openPaymentCheckingModal(ref_no) {
  const modal = $("#paymentCheckingModal");
  const container = $("#payment-check-details");

  modal.removeClass("hidden").addClass("flex");
  container.html(`<div class="text-gray-500 py-4 text-center">Loading...</div>`);
  $.get('/hoa_system/app/api/payments/get.homeowner-fee-detail.php', { ref_no: ref_no })
    .done((res) => {
      if (!res.success) {
        container.html(`<div class="text-red-600 text-center py-4">Unable to load payment.</div>`);
        return;
      }
      const p = res.data;
      $("#verify_payment_id").val(p.id);
      $("#payer-name").val(p.payer_name);
      $("#submitted-amount").val(`₱${Number(p.amount_paid).toLocaleString()}`);
      $("#submitted-method").val(p.payment_method);
      $("#submitted-reference").val(p.ref_no);
      if (p.proof_url) {
        $("#payment-proof-container").html(`
          <img src="../../${p.attachment}" class="max-h-48 rounded-lg mx-auto shadow">
        `);
      } else {
        $("#payment-proof-container").html(
          `<p class="text-gray-500 text-sm">No file uploaded.</p>`
        );
      }
      container.html(`
        <div class="space-y-2">
          <div class="text-sm text-gray-600">Payment submitted on: <b>${p.date_created}</b></div>
        </div>
      `);
    })
    .fail(() => {
      container.html(`<div class="text-red-600 text-center">Request failed.</div>`);
    });
}

$(document).on("click", ".btn-verify-payment", function () {
  const ref = $(this).data("ref");
  openPaymentCheckingModal(ref);
});

$("#approvePayment").on("click", () => {
  const ref_no = $("#submitted-reference").val();

  $.post('/hoa_system/app/api/payments/post.approve.php', { ref_no })
    .done(res => {
      if (res.success) {
        showToast({ message: "Payment Approved!", type: "success" });
        $("#paymentCheckingModal").addClass("hidden");
        fetcher.fetch();
      } else {
        showToast({ message: res.message, type: "error" });
      }
    })
    .fail(() => showToast({ message: "Request error.", type: "error" }));
});


$("#declinePayment").on("click", () => {
  const ref_no = $("#submitted-reference").val();

  $.post('/hoa_system/app/api/payments/post.reject.php', { ref_no })
    .done(res => {
      if (res.success) {
        showToast({ message: "Payment Declined.", type: "info" });
        $("#paymentCheckingModal").addClass("hidden");
        fetcher.fetch();
      } else {
        showToast({ message: res.message, type: "error" });
      }
    })
    .fail(() => showToast({ message: "Request error.", type: "error" }));
});

$("#closePaymentCheckingModal").on("click", () =>
  $("#paymentCheckingModal").addClass("hidden")
);

$("#paymentCheckingModal").on("click", function (e) {
  if (e.target === this) $(this).addClass("hidden");
});

$(document).on('fetch:error', (e, msg) => showToast({ message: msg || 'Failed to load.', type: 'error' }));

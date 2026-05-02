import { $State } from '../../core/state.js';
import { DataFetcher } from '../../core/data-fetch.js';
import { TableView } from '../../core/table-view.js';
import { showToast } from '../../utils/toast.js';

const BASE_URL = '/hoa_system/';
const API_URL = `${BASE_URL}app/api/fee-assignation/get.homeowners.php`;

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
      <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold text-sm">
        ${row.fullName?.charAt(0) || '?'}
      </div>
      <div class="ml-3">
        <div class="font-medium text-gray-900">${row.fullName || '—'}</div>
        <div class="text-sm text-gray-500">${row.email_address || '—'}</div>
      </div>
    </div>`,
  row => {
    const formatted = new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP',
      minimumFractionDigits: 2
    }).format(row.total_unpaid_amount);

    return `<span class="font-medium text-green-600">${formatted}</span>`;
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
      'Waiting for Approval': {
        bg: 'bg-yellow-100',
        text: 'text-yellow-800'
      }
    };

    const s = statusStyles[row.status] || {
      bg: 'bg-gray-100',
      text: 'text-gray-800'
    };

    return `
      <span class="text-nowrap inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${s.bg} ${s.text}">
        ${row.status}
      </span>
    `;
  },


  row => {
    return new Date(row.next_due_date).toLocaleDateString('en-PH', {
      month: 'short',
      day: 'numeric',
      year: 'numeric'
    });
  },
  row => `
  <div class="flex gap-2">
    <button 
      class="btn-view-fee px-4 py-2 bg-teal-600 text-white rounded-lg"
      data-id="${row.id}">
      <i class="ri-eye-fill"></i> View
    </button>

    <button 
      class="btn-assign-fee px-3 py-1 bg-gray-400 text-white rounded-lg"
      data-user-id="${row.id}">
      <i class="ri-cash-line"></i> Assign
    </button>
  </div>`
];

new TableView($state, fetcher, {
  tableId: 'dataTable',
  searchId: 'simple-search',
  paginationId: 'paginationList',
  columns
});

// functions 
function showFeeDetailsModal(homeownerId) {
  const modal = $('#feeDetailsModal');
  const content = $('#feeDetailsContent');

  content.html(`<div class="text-center py-4">Loading...</div>`);
  modal.removeClass('hidden').addClass('flex');

  $.get('/hoa_system/app/api/fee-assignation/getById.fees.php', { id: homeownerId })
    .done(res => {
      if (!res.success || res.data.length === 0) {
        content.html(`<div class="text-center text-gray-500 py-4">No fee records found.</div>`);
        return;
      }
      const rows = res.data.map(fee => {
      const disabled = fee.status == 1 || fee.status == 4 ? 'disabled' : '';
      const statusText = fee.status_text || 'Unknown';

      return `
        <label class="p-3 border rounded-lg flex justify-between items-center cursor-pointer gap-3">
          <input type="checkbox" class="fee-check bg-gray-200 rounded-lg" value="${fee.id}" ${disabled}>
          <div class="flex-1">
            <div class="font-semibold text-gray-800">${fee.fee_name}</div>
            <div class="text-sm text-gray-500">Due: ${fee.due_date_formatted}</div>
            <div class="text-xs text-gray-400">Created: ${fee.date_created}</div>
          </div>

          <div class="text-right">
            <div class="font-medium text-green-700">₱${Number(fee.amount).toLocaleString()}</div>
            <span class="text-xs px-2 py-1 rounded ${fee.badge_class}">
              ${statusText}
            </span>
          </div>
        </label>
          `;
      }).join('');


      content.html(rows);
    })
    .fail(() => {
      content.html(`<div class="text-center text-red-600 py-4">Failed to load data.</div>`);
    });
}
function openWalkInPaymentModal(feeIds) {
    const modal = $("#walkInPaymentModal");
    const feeContainer = $("#selected-fees-details");
    const amountField = $("#amount");

    feeContainer.html(`<div class="text-gray-500">Loading fees...</div>`);
    amountField.val("₱0.00");

    modal.removeClass("hidden");

    $.get('/hoa_system/app/api/fee-assignation/get.multiple-fees.php', {
        ids: feeIds.join(',')
    })
    .done((res) => {
      const userIdField = $("#user_id")
      const feeContainer = $("#selected-fees-details")
      const amountField = $("#amount")

      if (!res.success || res.data.length === 0) {
          feeContainer.html(`<div class="text-red-600">No fee details found.</div>`)
          userIdField.val('')
          amountField.val("₱0.00")
          return;
      }

      let totalAmount = 0;
      let rows = '';

      const firstGroup = res.data[0];
      userIdField.val(firstGroup.user_id);
      $("#walkInPaymentModal input[readonly]").val(firstGroup.name);

      res.data.forEach(group => {
          rows += `<div class="mb-3">
                      <div class="font-semibold text-gray-700 mb-4">
                        ${group.name}
                      </div>
                      <div class="space-y-2">`;

          group.data.forEach(fee => {
              totalAmount += parseFloat(fee.amount);
              rows += `
                  <div class="p-3 border rounded-lg bg-gray-50 flex justify-between items-center">
                      <div>
                          <div class="font-semibold text-gray-800">${fee.fee_name}</div>
                          <div class="text-sm text-gray-500">Due: ${fee.due_date_formatted}</div>
                      </div>
                      <div class="font-bold text-green-600">
                          ₱${Number(fee.amount).toLocaleString()}
                      </div>
                  </div>
              `;
          });

          rows += `</div></div>`;
      });

      feeContainer.html(rows);
      amountField.val(`₱${totalAmount.toLocaleString()}`);

      window.selectedFeeGroups = res.data;
      window.selectedFeeIds = feeIds;
  })
  .fail(() => {
      $("#selected-fees-details").html(`<div class="text-red-600">Error loading fee details.</div>`);
      $("#user_id").val('');
      $("#amount").val("₱0.00");
  });
}
function openAssignFeesModal(userId) {
  const modal = $("#assignFeesModal");
  const feeContainer = $("#available-fees-list");
  const userIdField = $("#assign_user_id");

  modal.removeClass("hidden");
  feeContainer.html(`<div class="text-gray-500">Loading available fees...</div>`);
  userIdField.val(userId);

  $.get('/hoa_system/app/api/fee-assignation/get.fees.php', { user_id: userId })
    .done((res) => {
      if (!res.success || res.data.length === 0) {
          feeContainer.html(`<div class="text-red-600">No available fees to assign.</div>`);
          return;
      }

      const rows = res.data.map(fee => `
        <div class="p-3 border rounded-lg bg-gray-50 flex justify-between items-center">
          <label class="flex items-center gap-2 w-full cursor-pointer">
            <input type="checkbox" class="assign-fee-checkbox bg-gray-200 rounded-lg" value="${fee.id}">
            <div class="flex-1">
              <div class="font-semibold text-gray-800">${fee.fee_name}</div>
              <div class="text-sm text-gray-500">Amount: ₱${Number(fee.amount).toLocaleString()}</div>
            </div>
          </label>
        </div>
      `).join('');

      feeContainer.html(rows);
    })
    .fail(() => {
        feeContainer.html(`<div class="text-red-600">Error loading fees.</div>`);
    });
}


// Event Listeners
$(document).on('fetch:error', (e, msg) => toast(msg || 'Failed to load.', 'error'));
window.addEventListener('error', (e) => {
  console.error('JS ERROR:', e.error);
  showToast({ message: 'JavaScript Error: ' + e.message, type: "error" });
});
$(document).on('click', '.btn-view-fee', function () {
  const id = $(this).data('id')
  showFeeDetailsModal(id)
});
$('#closeFeeModal').on('click', () => {
  $('#feeDetailsModal').addClass('hidden').removeClass('flex');
});
$('#feeDetailsModal').on('click', function(e) {
  if (e.target === this) {
    $(this).addClass('hidden').removeClass('flex')
  }
});
$('#proceedWalkIn').on('click', function () {
    const selectedFees = $('.fee-check:checked')
      .map(function () { return $(this).val() })
      .get();
    if (selectedFees.length === 0) {
        return showToast({ message: "Select at least 1 fee.", type: "error" })
    }
    openWalkInPaymentModal(selectedFees);
    $('#feeDetailsModal').addClass('hidden')
});
$('#walk-in-payment-form').on('submit', function (e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('user_id', $("#user_id").val());
    
    window.selectedFeeIds.forEach(id => formData.append('fee_ids[]', id));

    formData.append('payment_method', $("#payment-method").val());
    formData.append('payment_date', $("#payment-date").val());
    formData.append('receipt_name', $("#receipt-name").val());
    formData.append('remarks', $("#remarks").val());

    const proofFile = $("#payment-proof")[0].files[0];
    if (proofFile) {
        formData.append('attachment', proofFile);
    }

    $.ajax({
        url: '/hoa_system/app/api/fee-assignation/post.fee-payment.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            if (res.success) {
                showToast({ message: "Payment recorded successfully!", type: "success" });
                $('#walkInPaymentModal').addClass("hidden");
                fetcher.fetch();
            } else {
                showToast({ message: res.message || "Payment failed", type: "error" });
            }
        },
        error: function() {
            showToast({ message: "Request error", type: "error" });
        }
    });
});



$(document).on('click', '.btn-assign-fee', function () {
    const userId = $(this).data('user-id')
    openAssignFeesModal(userId)
});

$('#assign-fees-form').on('submit', function (e) {
    e.preventDefault();

    const userId = $("#assign_user_id").val()
    const selectedFees = Array.from(document.querySelectorAll('.assign-fee-checkbox:checked'))
      .map(el => el.value)

    if (selectedFees.length === 0) {
        toast("Please select at least one fee to assign", "info");
        return;
    }

    $.post('/hoa_system/app/api/fee-assignation/post.fee-assignation.php', {
        user_id: userId,
        fee_ids: selectedFees
    })
    .done(res => {
        if (res.success) {
          fetcher.fetch()
          showToast({ message: "Fees assigned successfully!", type: "success" })
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          showToast({ message: res.message || "Failed to assign fees", type: "error" })
        }
    })
    .fail(() => toast("Request error", "error"));
});


$('#closeModal').on('click', () => $('#walkInPaymentModal').addClass('hidden'));
$("#closeAssignModal").on('click', () => $("#assignFeesModal").addClass("hidden"));
$('#walkInPaymentModal').on('click', function(e) {
    if (e.target === this) {
        $(this).addClass('hidden');
    }
});

window.addEventListener('unhandledrejection', (e) => {
  console.error('Promise Error:', e.reason)
  toast('System Error: Check console!', 'error')
});
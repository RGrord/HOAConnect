import { $State } from '../../core/state.js';
import { DataFetcher } from '../../core/data-fetch.js';
import { TableView } from '../../core/table-view.js';
import { showToast } from '../../utils/toast.js';

const BASE_URL = '/hoa_system/';
const API_URL = `${BASE_URL}app/api/remittance/get.remittance.php`;

const $state = $State({
  search: '',
  pagination: { currentPage: 1, limit: 10, totalPages: 0, totalRecords: 0 },
  data: [],
  loading: false
});

const fetcher = new DataFetcher($state, API_URL);

const columns = [
  row => `<div class="font-medium text-gray-900">${row.particular || '—'}</div>`,
  row => `<div class="text-green-700 font-medium">₱${parseFloat(row.amount).toFixed(2)}</div>`,
  row => {
    switch(row.status) {
        case 1:
            return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Approved</span>';
        case 2:
            return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Rejected</span>';
        default:
            return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span>';
    }
  },

  row => {
    const role = localStorage.getItem('role');
    if(role == 3 || role == 4){
      return `
      <div class="flex gap-2">
        <button 
          class="view-remittance bg-teal-600 hover:bg-teal-700 py-2 px-4 rounded-lg text-white transition"
          data-id="${row.id}"
        >
          <i class="ri-eye-fill"></i>
          View
        </button>
        <a href="../../app/api/remittance/getById.file.php?id=${row.id}" 
          target="_blank"
          class="bg-red-600 text-red-600 hover:text-red-500 py-2 px-4 rounded-lg text-white transition" 
          title="Download PDF Report">
          <i class="ri-file-download-line text-xl"></i>
          Download
        </a>
      </div>` 
    }
  }
];

new TableView($state, fetcher, {
  tableId: 'dataTable',
  searchId: 'simple-search',
  paginationId: 'paginationList',
  columns
});

$(document).on('fetch:error', (_, msg) => {
  alert(msg || 'Failed to load remittances');
})


function loadTotalCollected() {
  $.get('/hoa_system/app/api/remittance/get.remittable.php')
    .done(res => {
        if (res.success && res.data.length > 0) {
            const total = Number(res.data[0].total).toLocaleString("en-PH", {
                minimumFractionDigits: 2
            });

            $("#totalCollected").text(`₱${total}`);
            $("#amount").val(total);
        }
    })
    .fail(() => {
        console.error("Failed to load remittance total");
    });
}

function openRemitModal() {
  const modal = $("#remitModal");
  modal.removeClass("hidden").addClass("flex");
  $.get('/hoa_system/app/api/remittance/get.remittable.php')
    .done(res => {
      if (res.success && res.data.length > 0) {
        const total = Number(res.data[0].total).toLocaleString("en-PH", {
            minimumFractionDigits: 2
        });
        $("#amount").val(total);
      }
    });
}

function openViewRemittanceModal(remittanceId) {
  const modal = $("#viewRemittanceModal");
  modal.removeClass("hidden").addClass("flex");
  $("#viewRequestedBy, #viewParticular, #viewAmount, #viewDate, #viewTransType").val("");
 $.get("/hoa_system/app/api/remittance/get.remittance.php", { id: remittanceId })
  .done(res => {
    if (!res.success) {
      alert(res.message || "Failed to fetch remittance details");
      modal.addClass("hidden").removeClass("flex");
      return;
    }

    const data = res.data;

    $("#viewRequestedBy").val(data.full_name);
    $("#viewParticular").val(data.particular);
    $("#viewAmount").val("₱" + Number(data.amount).toLocaleString("en-PH", { minimumFractionDigits: 2 }));
    $("#viewDate").val(data.date);
    $("#viewTransType").val(data.transaction_type);

    if (data.status == 1 || data.status == 2) {
      $("#approveRemit").hide();
      $("#rejectRemit").hide();
      $("#viewRemittanceModal .modal-footer").prepend(
        '<div class="text-green-700 font-bold text-lg mb-4">✓ Already Approved</div>'
      );
    } else {
      $("#approveRemit").show();
      $("#rejectRemit").show();
      $("#viewRemittanceModal .modal-footer .text-green-700.font-bold").remove();
    }
    $("#approveRemit").off("click").on("click", function() {
      updateRemittanceStatus(remittanceId, 1);
    });

    $("#rejectRemit").off("click").on("click", function() {
      updateRemittanceStatus(remittanceId, 0);
    });
  })
}

function updateRemittanceStatus(remittanceId, status) {
    $.post('/hoa_system/app/api/remittance/post.update-status.php', {
        id: remittanceId,
        status: status
    }, null, 'json') 
    .done(res => {
        console.log(res); 
        if(res.success) {
            showToast({ 
                message: "Remittance " + (status === 1 ? "approved" : "rejected") + " successfully!", 
                type: "success" 
            });
            $("#viewRemittanceModal").addClass("hidden").removeClass("flex");
            setTimeout(() => {
              window.location.reload();
            }, 1500);
            $state.fetchData(); 
        } else {
            showToast({ 
                message: res.message || "Failed to update remittance", 
                type: "error" 
            });
        }
    })
    .fail((xhr) => {
        console.error(xhr.responseText);
        showToast({ message: "Connection error", type: "error" });
    });
}

$(document).on("click", "#closeViewModal", function() {
    $("#viewRemittanceModal").addClass("hidden").removeClass("flex");
});

$(document).ready(function () {
    loadTotalCollected();
});
$(document).on("click", "#openRemitModal", function () {
    openRemitModal();
});
$(document).on("click", ".view-remittance", function () {
    const remittanceId = $(this).data("id");
    openViewRemittanceModal(remittanceId);
});
$("#closeModal, #cancelRemit").on("click", function () {
    $("#remitModal").addClass("hidden").removeClass("flex");
});
$(document).on("click", "#confirmRemit", function () {
    const user_id = $("#user_id").val();
    const amount = $("#amount").val().replace(/,/g, "");
    const date = $("#remitDate").val();
    const transaction_type = $("#transType").val();
    const particular = $("#particular").val();

    if (!amount || Number(amount) <= 0) {
        alert("Amount must be greater than 0");
        return;
    }

    const data = {
        user_id,
        amount,
        date,
        transaction_type,
        particular
    };

    $(this).prop("disabled", true).text("Submitting...");

    $.post('/hoa_system/app/api/remittance/post.remittance-request.php', data)
        .done(res => {
            if (res.success) {
                showToast({ message: "Remittance submitted successfully!", type: "success" });
                $("#remitModal").addClass("hidden").removeClass("flex");
                $("#totalCollected").text("₱" + Number(amount).toLocaleString("en-PH", { minimumFractionDigits: 2 }));
                setTimeout(() => {
                  window.location.reload();
                }, 1000);
            } else {
                showToast({ message: res.message || "Failed to submit remittance" , type: "error"});
            }
        })
        .fail(() => alert("Request failed"))
        .always(() => {
            $("#confirmRemit").prop("disabled", false).text("Confirm Remit");
        });
});

$("#approveRemit").on("click", function() {
    updateRemittanceStatus(remittanceId, 1);
});
$("#rejectRemit").on("click", function() {
    updateRemittanceStatus(remittanceId, 2);
});
$('#downloadPdfBtn').on('click', function() {
  window.open('/hoa_system/app/api/remittance/get.file.php', '_blank');
});

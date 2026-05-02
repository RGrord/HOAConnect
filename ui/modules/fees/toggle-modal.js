import { showToast } from '../../utils/toast.js';

let currentUserId = null;
let selectedFeeIds = [];

function updatePaymentSummary() {
    let total = 0;
    selectedFeeIds.forEach(fee => {
        total += parseFloat(fee.amount);
    });
    $("#paymentTotal").text(`Total: ${total.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' })}`);
    // Send comma-separated IDs to hidden input
    $("#selectedFeeIds").val(selectedFeeIds.map(f => f.id).join(','));
}

$(document).on('click', '.view', function () {
    currentUserId = $(this).data('id');

    $("#paymentUserName").text("Loading...");
    $("#paymentFeeTable").html(`<tr><td colspan="4" class="px-6 py-4 text-center">Loading...</td></tr>`);
    selectedFeeIds = [];

    $.get(`/hoa_system/app/api/fees/getById.fees.php?id=${currentUserId}`)
        .done(res => {
            $("#createdBy").val(currentUserId);

            if (!res.success) return showToast({ message: res.message, type: 'error' });

            $("#paymentUserName").text(res.homeowner.full_name);

            let rows = "";
            res.data.forEach(fee => {
                selectedFeeIds.push(fee);
                rows += `
                    <tr>
                        <td><input type="checkbox" class="feeCheckbox" data-id="${fee.id}" data-amount="${fee.amount}" checked></td>
                        <td>${fee.fee_name}</td>
                        <td>${fee.amount_formatted}</td>
                        <td>${fee.next_due_date_formatted}</td>
                    </tr>
                `;
            });

            $("#paymentFeeTable").html(rows);
            updatePaymentSummary();

            $(".feeCheckbox").on("change", function () {
                const id = parseInt($(this).data("id"));
                if ($(this).is(":checked")) {
                    const fee = res.data.find(f => f.id === id);
                    if (fee) selectedFeeIds.push(fee);
                } else {
                    selectedFeeIds = selectedFeeIds.filter(f => f.id !== id);
                }
                updatePaymentSummary();
            });
        });
});

// Handle form submission
$("#paymentForm").on("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    $.ajax({
        url: '/hoa_system/app/api/fees/post.payment.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            if (res.success) {
                showToast({ message: res.message, type: 'success' });
                // optionally close modal and refresh table
            } else {
                showToast({ message: res.message, type: 'error' });
            }
        },
        error: function() {
            showToast({ message: 'Network error', type: 'error' });
        }
    });
});

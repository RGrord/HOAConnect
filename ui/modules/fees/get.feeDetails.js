$(document).on('change', '#walk_in_checkbox', function () {
    $('#is_walk_in').val(this.checked ? '1' : '0');
    $('input[name="attachment"]').prop('required', !this.checked);
});

$(document).on('submit', '#payment-form', function (e) {
    e.preventDefault();
    const $btn = $(this).find('button[type="submit"]');
    const origText = $btn.html();
    $btn.prop('disabled', true).html('Submitting...');

    const formData = new FormData(this);

    $.ajax({
        url: '/hoa_system/app/api/payments/record.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if (res.success) {
                alert('Payment submitted successfully!');
                window.location.href = 'homeowner-fees.php?id=' + res.user_id
            } else {
                alert(res.message || 'Failed to submit payment.');
            }
        },
        error: function () {
            alert('Network error. Please try again.');
        },
        complete: function () {
            $btn.prop('disabled', false).html(origText);
        }
    });
});
$(document).on('click', '#payment-form', function (e) {
    const $stallSelect = $('#stallSelect');

    $stallSelect.html('<option>Loading...</option>');

    $.ajax({
        url: '/hoa_system/app/api/amenities/stall/get.stall.php',
        method: 'GET',
        dataType: 'json',
        success: function (res) {
            if (!res.success) {
                $stallSelect.html('<option value="">Error loading stalls</option>');
                return;
            }

            const stalls = res.data;

            if (stalls.length === 0) {
                $stallSelect.html('<option value="">No available stalls</option>');
                return;
            }

            let options = '<option value="">Select Stall</option>';

            stalls.forEach(stall => {
                options += `<option value="${stall.id}">Stall ${stall.stall_no}</option>`;
            });

            $stallSelect.html(options);
        },
        error: function () {
            $stallSelect.html('<option value="">Error connecting to server</option>');
        }
    });
});

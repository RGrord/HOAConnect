import { $State } from '../../core/state.js';
import { showToast } from '../../utils/toast.js';
import { mobileNumberOnly } from '../../utils/input.mobile.js';

const createState = $State({ loading: false });

$(document).on('change', () => render());
$(document).ready(function() {
    mobileNumberOnly('input[name=phone]')
})
$('#createHomeownerForm').on('submit', function (e) {
    e.preventDefault();
    const $form = $(this);

    createState.loading(true);

    $.post('/hoa_system/app/api/users/post.user.php', $form.serialize())
        .done(res => {
            if (res.success) {
                showToast({ message: 'User created successfully!', type: 'success' });
                setTimeout(() => {
                    window.location.href = 'list.php';
                }, 1500);
            } else {
                showToast({ message: res.message || 'Failed to create user.', type: 'error' });
            }
        })
        .fail(() => {
            showToast({ message: 'Network error.', type: 'error' });
        })
        .always(() => {
            createState.loading(false);
        });
});

function render() {
    const loading = createState.val('loading');
    const $btn = $('#createBtn');

    $btn.prop('disabled', loading);
    $btn.html(loading 
        ? '<svg class="inline w-5 h-5 animate-spin text-white mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Creating...'
        : 'Create'
    );
}

render();
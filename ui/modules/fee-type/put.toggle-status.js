import { showToast } from '../../utils/toast.js';

$(document).on('click', '.actionBtn', async function (e) {
  let action = $(this).data('action')
  let actionPath = action == 'Active' ? 'deactivate' : 'activate'
  let id = $(this).data('id')
  const endpoint = `/hoa_system/app/api/fee-type/put.${actionPath}.php?id=${id}`
  $.post(endpoint)
    .done(res => {
      if (res.success) {
        showToast({ message: res.message, type: 'success' })
        setTimeout(() => {
          window.location.reload()
        }, 1300)
      } else {
        showToast({ message: res.message, type: 'error' })
      }
    })
    .fail(() => {
      showToast({ message: 'Network error', type: 'error' });
    })
});
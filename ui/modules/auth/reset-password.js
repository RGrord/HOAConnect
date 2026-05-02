import { $State } from '/hoa_system/ui/core/state.js';
import { showToast } from '/hoa_system/ui/utils/toast.js';

const setup = $State({
  loading: false,
  error: '',
  password: '',
  confirmPassword: ''
});

$(document).ready(function () {
  const $form = $('#reset-password-form');
  const $password = $('#password');
  const $confirm = $('#confirmPassword');
  const $errorBox = $('#error-message');
  const $errorText = $('#error-text');

  $password.add($confirm).on('input', function () {
    const p = $password.val().trim();
    const c = $confirm.val().trim();

    setup
      .val('password', p)
      .val('confirmPassword', c);

    const mismatch = p && c && p !== c;
    $password.toggleClass('border-red-500 focus:ring-red-500', mismatch);
    $confirm.toggleClass('border-red-500 focus:ring-red-500', mismatch);
  });

  $form.on('submit', function (e) {
    e.preventDefault();

    const p = setup.val('password');
    const c = setup.val('confirmPassword');

    setup.val('error', '');

    if (!p || !c) return setup.val('error', 'Please fill in both fields.');
    if (p.length < 6) return setup.val('error', 'Password must be at least 6 characters.');
    if (p !== c) return setup.val('error', 'Passwords do not match!');

    setup.loading(true);

    $.ajax({
      url: '/hoa_system/app/api/auth/reset-password.php',
      type: 'POST',
      data: $form.serialize(),
      dataType: 'json',
      timeout: 10000,

      success: function (res) {
        if (res?.success) {
          showToast({
            message: res.message || 'Password has been reset successfully!',
            type: 'success',
            position: 'center',
            duration: 3000
          });
          setTimeout(() => {
            window.location.href = '/hoa_system/public/auth/login.php';
          }, 2000);
        } else {
          showToast({
            message: res.message || 'Setup failed.',
            type: 'error',
            position: 'center',
            duration: 3000
          });
          setup.val('error', res?.message || 'Setup failed.');
        }
      },

      error: function () {
        showToast({
          message: res.message || 'Network error. Please try again.',
          type: 'error',
          position: 'center',
          duration: 3000
        });
        setup.val('error', 'Network error. Please try again.');
      },

      complete: function () {
        setup.loading(false);
      }
    });
  });

  function render() {
    const state = setup.val();
    const $btn = $('#submitBtn');

    $btn.prop('disabled', state.loading);
    $btn.html(state.loading
      ? `
      <svg class="inline w-4 h-4 text-gray-200 animate-spin fill-teal-600 me-3" viewBox="0 0 100 101" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.59C100 78.2 77.61 100.59 50 100.59C22.38 100.59 0 78.2 0 50.59C0 22.97 22.38 0.59 50 0.59C77.61 0.59 100 22.97 100 50.59Z" fill="currentColor" opacity="0.3"/>
        <path d="M93.97 39.04C96.39 38.4 97.86 35.91 97.01 33.55C95.29 28.82 92.87 24.37 89.82 20.35C85.85 15.12 80.88 10.72 75.21 7.41C69.54 4.1 63.27 1.94 56.77 1.05C51.77 0.36 46.7 0.44 41.73 1.27C39.26 1.69 37.81 4.19 38.45 6.62C39.09 9.05 41.57 10.47 44.05 10.11C47.85 9.55 51.72 9.53 55.54 10.05C60.86 10.78 65.99 12.55 70.63 15.25C75.27 17.96 79.33 21.56 82.58 25.84C84.92 28.91 86.8 32.29 88.18 35.88C89.08 38.21 91.54 39.68 93.97 39.04Z" fill="currentFill"/>
      </svg> Submitting...`
      : 'Submit'
    );

    if (state.error) {
      $errorText.text(state.error);
      $errorBox.removeClass('hidden');
    } else {
      $errorBox.addClass('hidden');
    }
  }

  render();
});
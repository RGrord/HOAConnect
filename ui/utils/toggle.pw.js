$(document).ready(function(){
  initPasswordToggle();
})

function initPasswordToggle() {
  $('.pw-toggle').on('click', function () {
    const $icon = $(this).find('i');
    const targetSelector = $(this).data('target');
    const $password = $(targetSelector);
    const isPassword = $password.attr('type') === 'password';
    $password.attr('type', isPassword ? 'text' : 'password');
    $icon.toggleClass('ri-eye-line ri-eye-off-line');

  });
}
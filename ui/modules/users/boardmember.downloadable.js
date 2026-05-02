$(document).on('click', '#downloadPdfBtn', function() {
  const userId = new URLSearchParams(window.location.search).get('id');
  if (userId) {
    window.open(`/hoa_system/app/api/users/getById.boardmembers-file.php?id=${userId}`, '_blank');
  }
});
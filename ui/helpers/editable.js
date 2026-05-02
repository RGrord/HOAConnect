function toggleEditable(formId) {
  const $form = $(`#${formId}`);
  const isEditable = $form.data('editable') === true;

  // Toggle editable state
  $form.find('input, select, textarea').prop('readonly', isEditable).prop('disabled', isEditable);
  $form.find('button[type="submit"]').toggleClass('hidden', !isEditable);  // Show/hide Save button

  // Toggle Edit button text
  const $editButton = $form.find('.edit-button');
  if (isEditable) {
    $editButton.text('Edit').prepend('<i class="fas fa-edit mr-1"></i>');
  } else {
    $editButton.text('Cancel').prepend('<i class="fas fa-times mr-1"></i>');
  }

  // Update the editable data attribute
  $form.data('editable', !isEditable);
}

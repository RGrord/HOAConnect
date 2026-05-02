// ui/modules/users/fetchById.boardmember.js
// FINAL VERSION — NOV 17, 2025 — FULLY WORKING: LOADING, RENDER, EDIT, SAVE (3 FORMS)

import { $State } from '../../core/state.js';
import { showToast } from '../../utils/toast.js';

const API_URL = '/hoa_system/app/api/users/getById.users.php';
const BASE_URL = '/hoa_system/'; // Make sure this matches your config

// DEDICATED STATE FOR THIS PROFILE PAGE
const profileState = $State({
  user: null,
  loading: true,
  editMode: { personal: false, home: false, account: false }
});

// React to any state change
$(document).on('change:user.profileState change:loading.profileState change:editMode.profileState', () => {
  render();
});

$(document).ready(function () {
  const userId = new URLSearchParams(window.location.search).get('id');
  if (!userId) return showError('No user ID provided.');

  profileState.val('loading', true);

  $.get(`${API_URL}?id=${userId}`)
    .done(res => {
      if (res.success && res.data) {
        profileState.val('user', res.data);
      } else {
        showError('Member not found.');
      }
    })
    .fail(() => showError('Failed to load member.'))
    .always(() => profileState.val('loading', false));
});

// MAIN RENDER — REACTIVE
function render() {
  const user = profileState.val('user');
  const loading = profileState.val('loading');
  const edit = profileState.val('editMode');

  if (loading) return showLoading();
  if (!user) return;

  // Header
  $('#heading').text(user.fullName || '—');
  $('#subheading').text(`${user.role}` + ' • ' + `${user.email || user.email_address || ''}`);

  // Hidden ID
  $('input[name="user_id"]').val(user.user_id);

  // Personal Info
  $('[name="first_name"]').val(user.first_name || '');
  $('[name="middle_name"]').val(user.middle_name || '');
  $('[name="last_name"]').val(user.last_name || '');
  $('[name="suffix"]').val(user.suffix || '');
  $('[name="phone"]').val(user.phone || '');
  $('[name="birthdate"]').val(user.birthdate || '');
  $('[name="citizenship"]').val(user.citizenship || '');
  $('[name="civil_status"]').val(user.civil_status || 'Single');

  // Home Details
  $('[name="hoa_number"]').val(user.hoa_number || '');
  $('[name="home_address"]').val(user.home_address || '');
  $('[name="lot_number"], [name="lot"]').val(user.lot_number || user.lot || '');
  $('[name="block_number"], [name="block"]').val(user.block_number || user.block || '');
  $('[name="phase_number"], [name="phase"]').val(user.phase_number || user.phase || '');
  $('[name="village_name"], [name="village"]').val(user.village_name || user.village || '');

  // Account Settings
  $('[name="email_address"], [name="email"]').val(user.email_address || user.email || '');
  $('[name="role"]').val(getRoleName(user.role_id || user.role));

  // Toggle edit modes
  toggleSectionEdit('#personalInfo', edit.personal);
  toggleSectionEdit('#homeDetailsForm', edit.home);
  toggleSectionEdit('#accountSettingsForm', edit.account);

  hideLoading();
}

function toggleSectionEdit(sectionSelector, enabled) {
  const $section = $(sectionSelector);
  
  $section.find('input, select').each(function () {
    $(this).prop({ readonly: !enabled, disabled: !enabled })
      .toggleClass('bg-gray-50', !enabled)
      .toggleClass('bg-white border border-gray-300', enabled);
});

  // THIS IS THE KEY FIX
  $section.find('.action-buttons').toggleClass('hidden', !enabled);
  $section.find('.edit-button').toggleClass('hidden', enabled);
}
function getRoleName(role) {
  const map = {1:'Admin',2:'Secretary',3:'President',4:'Treasurer',5:'Member'};
  return map[role] || 'Member';
}

// EDIT BUTTON
$(document).on('click', '.edit-button', function () {
  const formId = $(this).closest('form').attr('id');
  const key = formId === 'personalInfo' ? 'personal' :
              formId === 'homeDetailsForm' ? 'home' : 'account';

  const current = profileState.val('editMode');
  profileState.val('editMode', { ...current, [key]: !current[key] });
});

$(document).on('click', '.cancel-btn', function () {
  const $form = $(this).closest('form');
  const formId = $form.attr('id');
  const key = formId === 'personalInfo' ? 'personal' :
              formId === 'homeDetailsForm' ? 'home' : 'account';
  const current = profileState.val('editMode');
  profileState.val('editMode', { ...current, [key]: false });

  showToast({ 
    message: 'Changes discarded', 
    type: 'info',
    duration: 2500
  });
});

$(document).on('submit', 'form.profile-section', function (e) {
  e.preventDefault();
  const $form = $(this);
  const section = $form.find('[name="section"]').val();
  const $btn = $form.find('.save-btn');
  const original = $btn.html();
  $btn.prop('disabled', true).html('<i class="ri-loader-4-line animate-spin"></i> Saving...');

  const endpoint = {
    personal: `${BASE_URL}app/api/users/put.personalInfo.php`,
    home: `${BASE_URL}app/api/users/put.homeDetails.php`,
    account: `${BASE_URL}app/api/users/put.accountSettings.php`
  }[section];

  $.post(endpoint, $form.serialize())
    .done(res => {
      if (res.success) {
        showToast({ message: 'Saved successfully!', type: 'success' })
        const current = profileState.val('editMode');
        profileState.val('editMode', { ...current, [section]: false });
        if (res.data) profileState.val('user', { ...profileState.val('user'), ...res.data });
      } else {
        showToast({ message: 'Saving Failed.', type: 'error' })
      }
    })
    .fail(() => {
      showToast({ message: 'Network error', type: 'error' });
    })
    .always(() => {
      $btn.prop('disabled', false).html(original);
    });
});

function showLoading() {
  if ($('#profile-loading').length === 0) {
    $('body').append(`
      <div id="profile-loading" class="fixed inset-0 z-50 flex items-center justify-center bg-white bg-opacity-90">
        <div class="text-center">
          <svg class="inline-block animate-spin h-12 w-12 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <p class="mt-4 text-lg text-gray-700">Loading profile...</p>
        </div>
      </div>
    `);
  }
  $('#profile-loading').removeClass('hidden');
}

function hideLoading() {
  $('#profile-loading')?.addClass('hidden');
  if (typeof initFlowbite === 'function') setTimeout(initFlowbite, 100);
}

function showError(msg) {
  $('body').html(`<div class="min-h-screen flex items-center justify-center"><div class="text-center"><p class="text-2xl text-red-600 mb-4">${msg}</p><a href="list.php" class="text-teal-600">&larr; Back</a></div></div>`);
}

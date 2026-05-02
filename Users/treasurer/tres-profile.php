<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    [x-cloak] {
      display: none !important;
    }
    
    .profile-section {
      transition: all 0.2s ease;
    }
    
    .profile-section:hover {
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .edit-button {
      opacity: 0;
      transition: all 0.2s ease;
    }
    
    .profile-section:hover .edit-button {
      opacity: 1;
    }
    
    .profile-avatar {
      box-shadow: 0 4px 20px rgba(20, 184, 166, 0.3);
      border: 3px solid #ffffff;
    }
    
    .section-editing {
      background-color: #f0fdfa;
      border: 2px solid #14b8a6;
    }
    
    .form-input {
      transition: all 0.2s ease;
      border: 1px solid #d1d5db;
    }
    
    .form-input:focus {
      border-color: #14b8a6;
      box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
      outline: none;
    }
    
    .save-cancel-buttons {
      animation: slideDown 0.3s ease;
    }
    
    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .info-row {
      border-bottom: 1px solid #f3f4f6;
      transition: background-color 0.2s ease;
    }
    
    .info-row:hover {
      background-color: #f9fafb;
    }
    
    .info-row:last-child {
      border-bottom: none;
    }
  </style>
</head>
<body class="bg-gray-50">
  <div class="min-h-screen flex">
      <!-- Sidebar -->
    <div class="bg-teal-800 text-white w-64 py-6 flex flex-col">
      <div class="px-6 mb-8">
        <h1 class="text-2xl font-bold">HOAConnect</h1>
        <p class="text-sm text-teal-200">Mabuhay Homes 2000</p>
      </div>
      <nav class="flex-1">
        <a href="tres-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-tachometer-alt mr-3"></i>
          <span>Dashboard</span>
        </a>
        <a href="tres-paymenthistory.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-receipt mr-3"></i>
          <span>Payment History</span>
        </a>
        <a href="tres-remittance.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-money-check mr-3"></i>
          <span>Remittance</span>
        </a>

        <!-- Amenities Dropdown -->
<div x-data="{ open: false }">
  <button @click="open = !open" :aria-expanded="open" class="flex items-center w-full px-6 py-3 hover:bg-teal-600 focus:outline-none">
    <i class="fas fa-swimming-pool mr-3"></i>
    <span class="flex-1 text-left">Amenities</span>
    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
  </button>
  <div x-show="open" x-cloak class="bg-teal-800 text-sm">
    <!-- Tricycle Navigation -->
    <div class="relative">
      <button @click="window.location.href='tres-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
        <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
        <span class="flex-1 text-left">Tricycle</span>
      </button>
    </div>

    <!-- Court Navigation -->
    <div class="relative">
      <button @click="window.location.href='tres-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
        <i class="fas fa-basketball-ball mr-2" title="Court"></i>
        <span class="flex-1 text-left">Court</span>
      </button>
    </div>

    <!-- Stall Navigation -->
    <div class="relative">
      <button @click="window.location.href='tres-stall.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
        <i class="fas fa-store mr-2" title="Stall"></i>
        <span class="flex-1 text-left">Stall</span>
      </button>
    </div>
  </div>
</div>

        <a href="tres-project.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-gavel mr-3"></i>
          <span>Resolution</span>
        </a>
        <a href="tres-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-book mr-3"></i>
          <span>Ledger</span>
        </a>
        <a href="tres-acknowledgement.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-file-invoice mr-3"></i>
          <span>Receipt</span>
        </a>
        <a href="tres-project.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-newspaper mr-3"></i>
          <span>News Feed</span>
        </a>
        <a href="tres-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-calendar-alt mr-3"></i>
          <span>Calendar</span>
        </a>
        <a href="tres-profile.php" class="flex items-center px-6 py-3 bg-teal-700">
          <i class="fas fa-user-circle mr-3"></i>
          <span>Profile</span>
        </a>
      </nav>
      <div class="px-6 py-4 mt-auto">
        <button class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded flex items-center justify-center">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </button>
      </div>
    </div>
    <!-- Main Content -->
    <div class="flex-1 overflow-x-hidden overflow-y-auto">
      <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">My Profile</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>

      <!-- make main full width (inside the remaining area beside the sidebar) so cards expand -->
      <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Profile Header (card will stretch to the available width) -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 w-full">
          <div class="flex items-center space-x-6">
            <div class="relative">
              <img src="https://randomuser.me/api/portraits/women/8.jpg" 
                   alt="Profile" 
                   class="profile-avatar w-24 h-24 rounded-full object-cover" 
                   id="profile-picture-preview" />
              <label for="profile-picture" 
                     class="absolute -bottom-1 -right-1 bg-teal-600 text-white rounded-full p-2 cursor-pointer hover:bg-teal-700 transition-colors shadow-lg">
                <i class="fas fa-camera text-xs"></i>
                <input type="file" id="profile-picture" class="hidden" accept="image/png,image/jpeg" />
              </label>
            </div>
            <div>
              <h2 class="text-2xl font-bold text-gray-900">Marj Celine Aberia San Jose</h2>
              <p class="text-gray-600">Treasurer • Mabuhay Homes 2000</p>
            </div>
          </div>
        </div>

        <!-- Basic Information Section -->
        <div class="profile-section bg-white rounded-lg shadow-sm mb-6 w-full" id="basic-info-section">
          <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Basic Information</h3>
              <p class="text-sm text-gray-500">Your name and role information</p>
            </div>
            <button class="edit-button text-teal-600 hover:text-teal-700 px-3 py-1 rounded-md hover:bg-teal-50 transition-colors" 
                    onclick="editSection('basic-info')">
              <i class="fas fa-edit mr-1"></i> Edit
            </button>
          </div>
          
          <div id="basic-info-display" class="p-6">
            <div class="space-y-4">
              <div class="info-row py-3 px-4 rounded-md">
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm font-medium text-gray-500">Full Name</p>
                    <p class="text-gray-900" id="display-name">Marj Celine Aberia San Jose</p>
                  </div>
                  <i class="fas fa-user text-gray-400"></i>
                </div>
              </div>
              <div class="info-row py-3 px-4 rounded-md">
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm font-medium text-gray-500">Role</p>
                    <p class="text-gray-900">Treasurer</p>
                  </div>
                  <i class="fas fa-user-tie text-gray-400"></i>
                </div>
              </div>
            </div>
          </div>

          <div id="basic-info-edit" class="p-6 hidden">
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <input type="text" id="edit-name" value="Marj Celine Aberia San Jose" 
                       class="form-input w-full p-3 rounded-md" readonly 
                       style="background-color: #f9fafb; color: #6b7280;">
                <p class="text-xs text-gray-500 mt-1">Name cannot be changed. Contact administrator if needed.</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <input type="text" value="Secretary" 
                       class="form-input w-full p-3 rounded-md" readonly 
                       style="background-color: #f9fafb; color: #6b7280;">
                <p class="text-xs text-gray-500 mt-1">Role is assigned by administrator.</p>
              </div>
            </div>
            <div class="save-cancel-buttons flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-100">
              <button onclick="cancelEdit('basic-info')" 
                      class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors">
                Cancel
              </button>
              <button onclick="saveSection('basic-info')" 
                      class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 transition-colors">
                Save
              </button>
            </div>
          </div>
        </div>

        <!-- Contact Information Section -->
        <div class="profile-section bg-white rounded-lg shadow-sm mb-6 w-full" id="contact-info-section">
          <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Contact Information</h3>
              <p class="text-sm text-gray-500">How people can reach you</p>
            </div>
            <button class="edit-button text-teal-600 hover:text-teal-700 px-3 py-1 rounded-md hover:bg-teal-50 transition-colors" 
                    onclick="editSection('contact-info')">
              <i class="fas fa-edit mr-1"></i> Edit
            </button>
          </div>
          
          <div id="contact-info-display" class="p-6">
            <div class="space-y-4">
              <div class="info-row py-3 px-4 rounded-md">
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm font-medium text-gray-500">Email</p>
                    <p class="text-gray-900" id="display-email">maria.santos@email.com</p>
                  </div>
                  <i class="fas fa-envelope text-gray-400"></i>
                </div>
              </div>
              <div class="info-row py-3 px-4 rounded-md">
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm font-medium text-gray-500">Phone Number</p>
                    <p class="text-gray-900" id="display-phone">+63 917 123 4567</p>
                  </div>
                  <i class="fas fa-phone text-gray-400"></i>
                </div>
              </div>
              <div class="info-row py-3 px-4 rounded-md">
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm font-medium text-gray-500">Address</p>
                    <p class="text-gray-900" id="display-address">123 Mabuhay St. Lot 12, Block 3, Phase 2, Mabuhay Homes 2000</p>
                  </div>
                  <i class="fas fa-map-marker-alt text-gray-400"></i>
                </div>
              </div>
            </div>
          </div>

          <div id="contact-info-edit" class="p-6 hidden">
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="edit-email" value="maria.santos@email.com" 
                       class="form-input w-full p-3 rounded-md" readonly 
                       style="background-color: #f9fafb; color: #6b7280;">
                <p class="text-xs text-gray-500 mt-1">Email cannot be changed. Contact administrator if needed.</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <input type="tel" id="edit-phone" value="+63 917 123 4567" 
                       class="form-input w-full p-3 rounded-md" 
                       pattern="\+63[0-9]{10}">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <input type="text" id="edit-address" value="123 Mabuhay St. Lot 12, Block 3, Phase 2, Mabuhay Homes 2000" 
                       class="form-input w-full p-3 rounded-md" readonly 
                       style="background-color: #f9fafb; color: #6b7280;">
                <p class="text-xs text-gray-500 mt-1">Address is based on your property registration.</p>
              </div>
            </div>
            <div class="save-cancel-buttons flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-100">
              <button onclick="cancelEdit('contact-info')" 
                      class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors">
                Cancel
              </button>
              <button onclick="saveSection('contact-info')" 
                      class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 transition-colors">
                Save
              </button>
            </div>
          </div>
        </div>

        <!-- Personal Details Section -->
        <div class="profile-section bg-white rounded-lg shadow-sm mb-6 w-full" id="personal-details-section">
          <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Personal Details</h3>
              <p class="text-sm text-gray-500">Information about yourself</p>
            </div>
            <button class="edit-button text-teal-600 hover:text-teal-700 px-3 py-1 rounded-md hover:bg-teal-50 transition-colors" 
                    onclick="editSection('personal-details')">
              <i class="fas fa-edit mr-1"></i> Edit
            </button>
          </div>
          
          <div id="personal-details-display" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="info-row py-3 px-4 rounded-md">
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm font-medium text-gray-500">Date of Birth</p>
                    <p class="text-gray-900" id="display-dob">June 15, 1985</p>
                  </div>
                  <i class="fas fa-birthday-cake text-gray-400"></i>
                </div>
              </div>
              <div class="info-row py-3 px-4 rounded-md">
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm font-medium text-gray-500">Age</p>
                    <p class="text-gray-900">35 years old</p>
                  </div>
                  <i class="fas fa-calendar-alt text-gray-400"></i>
                </div>
              </div>
              <div class="info-row py-3 px-4 rounded-md">
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm font-medium text-gray-500">Relationship Status</p>
                    <p class="text-gray-900" id="display-relationship">Single</p>
                  </div>
                  <i class="fas fa-heart text-gray-400"></i>
                </div>
              </div>
              <div class="info-row py-3 px-4 rounded-md">
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm font-medium text-gray-500">Citizenship</p>
                    <p class="text-gray-900">Filipino</p>
                  </div>
                  <i class="fas fa-globe text-gray-400"></i>
                </div>
              </div>
            </div>
          </div>

          <div id="personal-details-edit" class="p-6 hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                <input type="text" value="June 15, 1985" 
                       class="form-input w-full p-3 rounded-md" readonly 
                       style="background-color: #f9fafb; color: #6b7280;">
                <p class="text-xs text-gray-500 mt-1">Cannot be changed.</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Relationship Status</label>
                <select id="edit-relationship" class="form-input w-full p-3 rounded-md">
                  <option value="Single" selected>Single</option>
                  <option value="Married">Married</option>
                  <option value="Divorced">Divorced</option>
                  <option value="Widowed">Widowed</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                <input type="text" value="Filipino" 
                       class="form-input w-full p-3 rounded-md" readonly 
                       style="background-color: #f9fafb; color: #6b7280;">
                <p class="text-xs text-gray-500 mt-1">Cannot be changed.</p>
              </div>
            </div>
            <div class="save-cancel-buttons flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-100">
              <button onclick="cancelEdit('personal-details')" 
                      class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors">
                Cancel
              </button>
              <button onclick="saveSection('personal-details')" 
                      class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 transition-colors">
                Save
              </button>
            </div>
          </div>
        </div>

        <!-- Account Settings Section -->
        <div class="profile-section bg-white rounded-lg shadow-sm mb-6 w-full" id="account-settings-section">
          <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Account Settings</h3>
              <p class="text-sm text-gray-500">Manage your account security</p>
            </div>
          </div>
          
          <div class="p-6">
            <div class="space-y-4">
              <div class="info-row py-4 px-4 rounded-md flex justify-between items-center">
                <div>
                  <p class="font-medium text-gray-900">Password</p>
                </div>
                <button onclick="openPasswordModal()" 
                        class="text-teal-600 hover:text-teal-700 px-3 py-1 rounded-md hover:bg-teal-50 transition-colors">
                  <i class="fas fa-key mr-1"></i> Change Password
                </button>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Change Password Modal -->
  <div id="password-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
      <div class="p-6 border-b border-gray-100">
        <div class="flex items-center justify-between">
          <h3 class="text-xl font-bold text-gray-900">Change Password</h3>
          <button onclick="closePasswordModal()" class="text-gray-400 hover:text-gray-600 p-2">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      
      <form id="password-form" class="p-6">
        <div class="space-y-4">
          <div>
            <label for="current-password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
            <input type="password" id="current-password" class="form-input w-full p-3 rounded-md" required>
          </div>
          <div>
            <label for="new-password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
            <input type="password" id="new-password" class="form-input w-full p-3 rounded-md" required minlength="8">
          </div>
          <div>
            <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
            <input type="password" id="confirm-password" class="form-input w-full p-3 rounded-md" required>
          </div>
        </div>
        
        <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-100">
          <button type="button" onclick="closePasswordModal()" 
                  class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors">
            Cancel
          </button>
          <button type="submit" 
                  class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 transition-colors">
            Update Password
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Profile Picture Upload
    document.getElementById('profile-picture').addEventListener('change', function (e) {
      const file = e.target.files[0];
      if (file) {
        if ((file.type === 'image/png' || file.type === 'image/jpeg') && file.size <= 5 * 1024 * 1024) {
          const reader = new FileReader();
          reader.onload = function (event) {
            document.getElementById('profile-picture-preview').src = event.target.result;
          };
          reader.readAsDataURL(file);
        } else {
          alert('Please upload a PNG or JPG image under 5MB.');
          e.target.value = '';
        }
      }
    });

    // Section Editing Functions
    function editSection(sectionName) {
      const section = document.getElementById(sectionName + '-section');
      const display = document.getElementById(sectionName + '-display');
      const edit = document.getElementById(sectionName + '-edit');
      
      section.classList.add('section-editing');
      display.classList.add('hidden');
      edit.classList.remove('hidden');
    }

    function cancelEdit(sectionName) {
      const section = document.getElementById(sectionName + '-section');
      const display = document.getElementById(sectionName + '-display');
      const edit = document.getElementById(sectionName + '-edit');
      
      section.classList.remove('section-editing');
      display.classList.remove('hidden');
      edit.classList.add('hidden');
      
      // Reset form values
      if (sectionName === 'contact-info') {
        document.getElementById('edit-phone').value = '+63 917 123 4567';
      } else if (sectionName === 'personal-details') {
        document.getElementById('edit-relationship').value = 'Single';
      }
    }

    function saveSection(sectionName) {
      if (sectionName === 'contact-info') {
        const phone = document.getElementById('edit-phone').value;
        document.getElementById('display-phone').textContent = phone;
      } else if (sectionName === 'personal-details') {
        const relationship = document.getElementById('edit-relationship').value;
        document.getElementById('display-relationship').textContent = relationship;
      }
      
      cancelEdit(sectionName);
      
      // Show success message
      const section = document.getElementById(sectionName + '-section');
      const originalBg = section.style.backgroundColor;
      section.style.backgroundColor = '#f0fdf4';
      section.style.borderColor = '#22c55e';
      
      setTimeout(() => {
        section.style.backgroundColor = originalBg;
        section.style.borderColor = '';
      }, 2000);
    }

    // Password Modal Functions
    function openPasswordModal() {
      document.getElementById('password-modal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closePasswordModal() {
      document.getElementById('password-modal').classList.add('hidden');
      document.body.style.overflow = 'auto';
      document.getElementById('password-form').reset();
    }

    // Password Form Submission
    document.getElementById('password-form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const newPassword = document.getElementById('new-password').value;
      const confirmPassword = document.getElementById('confirm-password').value;
      
      if (newPassword !== confirmPassword) {
        alert('New password and confirmation do not match!');
        return;
      }
      
      alert('Password updated successfully!');
      closePasswordModal();
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
      const modal = document.getElementById('password-modal');
      if (e.target === modal) {
        closePasswordModal();
      }
    });
  </script>
</body>
</html>

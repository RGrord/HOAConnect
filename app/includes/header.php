<header class="flex flex-row justify-between items-center p-4 sm:px-6 lg:px-8 gap-2 bg-white border-b border-gray-200 shadow-md sticky top-0 z-50">
  <span>
    <button id="sidebarToggle" class="flex items-center text-lg font-black text-teal-600 hover:text-teal-800 transition">
      <i class="ri-menu-2-fill"></i>
    </button>
  </span>

  <div class="flex flex-row items-center gap-2">
    <!-- <button type="button" class="relative py-2 px-3 text-gray-600 hover:text-teal-600 rounded-full transition">
      <i class="ri-notification-3-fill text-md"></i>
      <span class="absolute top-2 right-2 h-2 w-2 bg-red-500 rounded-full"></span>
    </button> -->

    <button 
      id="dropdownAvatarNameButton"
      data-dropdown-toggle="dropdownAvatarName"
      data-dropdown-placement="bottom-end"
      type="button"
      class="flex items-center gap-2 p-1 rounded-md"
    >
      <img 
        id="userAvatar" 
        class="w-8 h-8 rounded-md ring-2 ring-black-900 p-1.5 object-cover" 
        src="<?= BASE_URL ?>/assets/img/user-alt-64.png" 
        alt="User Avatar"
      >
      <div class="text-left leading-none">
        <p id="userName" class="text-sm font-medium text-gray-900 leading-none">Loading...</p>
        <span id="userRole" class="text-xs font-medium text-teal-600 py-0.5 rounded-full">Loading</span>
      </div>
    </button>

    <!-- Dropdown Menu -->
    <div 
      id="dropdownAvatarName" 
      class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-lg border border-gray-200 w-64"
    >
      <div class="flex items-center gap-3 px-4 py-3">
        <img 
          id="dropdownUserAvatar" 
          class="w-12 h-12 rounded-full ring-2 ring-black-900 object-cover" 
          src="<?= BASE_URL ?>/assets/img/user-alt-64.png" 
          alt="Avatar"
        >
        <div class="flex-1 min-w-0">
          <p id="dropdownUserName" class="text-sm font-semibold text-gray-900 truncate">Loading...</p>
          <p id="dropdownUserEmail" class="text-xs text-gray-500 truncate">Loading...</p>
        </div>
      </div>

      <!-- Menu Items -->
      <ul class="py-1 text-sm text-gray-700">
        <li>
          <a href="<?= BASE_URL . 'pages/profile/my-profile.php?id=' . $_SESSION['user_id'] ?>" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50 transition">
            <i class="ri-account-circle-fill text-gray-600"></i> Profile
          </a>
        </li>
      </ul>

      <!-- Logout -->
      <div class="py-1">
        <a href="<?= BASE_URL ?>app/api/auth/logout.php" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
          <i class="ri-logout-box-line"></i> Sign Out
        </a>
      </div>
    </div>
  </div>
</header>
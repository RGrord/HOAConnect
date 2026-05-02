<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - Messages</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
        <a href="admin-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-tachometer-alt mr-3"></i>
          <span>Dashboard</span>
        </a>
        <a href="admin-accounts.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-users mr-3"></i>
          <span>User Management</span>
        </a>
        <!-- Payment Management Dropdown -->
        <div x-data="{ open: false }">
          <button @click="open = !open" :aria-expanded="open" class="flex items-center w-full px-6 py-3 hover:bg-teal-600 focus:outline-none">
            <i class="fas fa-credit-card mr-3"></i>
            <span class="flex-1 text-left">Payment Management</span>
            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="open" x-cloak class="bg-teal-800 text-sm">
            <a href="fee-types.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
              <i class="fas fa-tag mr-2" title="Fee Type"></i>
              Fee Type
            </a>
            <a href="fee-assignation.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
              <i class="fas fa-clipboard-list mr-2" title="Fee Assignation"></i>
              Fee Assignation
            </a>
            <a href="payment-verification.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
              <i class="fas fa-check-circle mr-2" title="Payment Verification"></i>
              Payment Verification
            </a>
            <a href="admin-remittance.html" class="flex items-center px-10 py-2 hover:bg-teal-600">
              <i class="fas fa-money-check mr-3"></i>
              Remittance
            </a>
            <a href="payment-history.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
              <i class="fas fa-history mr-2" title="Payment History"></i>
              Payment History
            </a>
          </div>
        </div>

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
      <button @click="window.location.href='admin-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
        <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
        <span class="flex-1 text-left">Tricycle</span>
      </button>
    </div>

    <!-- Court Navigation -->
    <div class="relative">
      <button @click="window.location.href='admin-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
        <i class="fas fa-basketball-ball mr-2" title="Court"></i>
        <span class="flex-1 text-left">Court</span>
      </button>
    </div>

    <!-- Stall Navigation -->
    <div class="relative">
      <button @click="window.location.href='admin-stall.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
        <i class="fas fa-store mr-2" title="Stall"></i>
        <span class="flex-1 text-left">Stall</span>
      </button>
    </div>
  </div>
</div>

<a href="admin-hoaprojects.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
  <i class="fas fa-gavel mr-3"></i>
  <span>Resolution</span>
</a>

<a href="admin-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
  <i class="fas fa-book mr-3"></i>
  <span>Ledger</span>
</a>

<a href="admin-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
  <i class="fas fa-newspaper mr-3"></i>
<span>News Feed</span>
</a>

        <a href="admin-messages.php" class="flex items-center px-6 py-3 bg-teal-700">
          <i class="fas fa-comments mr-3"></i>
          <span>Messages</span>
        </a>
        <a href="admin-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-calendar-alt mr-3"></i>
          <span>Calendar</span>
        </a>
        <a href="admin-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
   <div class="flex-1 flex flex-col">
    <header class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
          <h1 class="text-2xl font-bold text-gray-900">Messages</h1>
          <div class="flex items-center space-x-2">
            <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
              <i class="fas fa-bell"></i>
            </button>
          </div>
        </div>
  </header>

    <!-- main area: make it flex-1 so it fills the rest of the viewport -->
    <main class="flex-1 p-4">
      <div class="bg-white rounded-lg shadow overflow-hidden h-full">
        <!-- Use h-full on the inner container and flex so children can size naturally -->
        <div class="flex h-full">
          <!-- Contacts List (left) -->
          <div class="w-1/3 border-r border-gray-200 flex flex-col">
            <!-- Search -->
            <div class="p-4 border-b">
              <div class="relative">
                <input type="text" placeholder="Search messages..."
                  class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 w-full" />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-search text-gray-400"></i>
                </div>
              </div>
            </div>

            <!-- Contact items: allow the list to scroll and fill available height -->
            <div class="overflow-y-auto flex-1">
              <div class="contact-list">
                <!-- Contact 1 (Active) -->
                <div class="flex items-center p-4 border-b border-gray-200 bg-teal-50 cursor-pointer">
                  <div class="relative">
                    <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Contact" class="w-12 h-12 rounded-full" />
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                  </div>
                  <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                      <h3 class="text-sm font-medium text-gray-900">Maria Santos</h3>
                      <p class="text-xs text-gray-500">10:23 AM</p>
                    </div>
                    <p class="text-sm text-gray-500 truncate">Thank you for the update on the street lighting project!</p>
                  </div>
                </div>

                <!-- Contact 2 -->
                <div class="flex items-center p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer">
                  <div class="relative">
                    <img src="https://randomuser.me/api/portraits/men/3.jpg" alt="Contact" class="w-12 h-12 rounded-full" />
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-gray-300 rounded-full border-2 border-white"></span>
                  </div>
                  <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                      <h3 class="text-sm font-medium text-gray-900">Juan Cruz</h3>
                      <p class="text-xs text-gray-500">Yesterday</p>
                    </div>
                    <p class="text-sm text-gray-500 truncate">I have a question about my monthly dues payment.</p>
                  </div>
                </div>

                <!-- Contact 3 -->
                <div class="flex items-center p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer">
                  <div class="relative">
                    <img src="https://randomuser.me/api/portraits/women/5.jpg" alt="Contact" class="w-12 h-12 rounded-full" />
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                  </div>
                  <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                      <h3 class="text-sm font-medium text-gray-900">Ana Reyes</h3>
                      <p class="text-xs text-gray-500">Yesterday</p>
                    </div>
                    <p class="text-sm font-semibold text-gray-900 truncate">When will the community garden project start?</p>
                  </div>
                </div>

                <!-- Contact 4 -->
                <div class="flex items-center p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer">
                  <div class="relative">
                    <img src="https://randomuser.me/api/portraits/men/7.jpg" alt="Contact" class="w-12 h-12 rounded-full" />
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-gray-300 rounded-full border-2 border-white"></span>
                  </div>
                  <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                      <h3 class="text-sm font-medium text-gray-900">Pedro Lim</h3>
                      <p class="text-xs text-gray-500">Apr 20</p>
                    </div>
                    <p class="text-sm text-gray-500 truncate">I'd like to volunteer for the next community event.</p>
                  </div>
                </div>

                <!-- Contact 5 -->
                <div class="flex items-center p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer">
                  <div class="relative">
                    <img src="https://randomuser.me/api/portraits/women/10.jpg" alt="Contact" class="w-12 h-12 rounded-full" />
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-gray-300 rounded-full border-2 border-white"></span>
                  </div>
                  <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                      <h3 class="text-sm font-medium text-gray-900">Sofia Garcia</h3>
                      <p class="text-xs text-gray-500">Apr 18</p>
                    </div>
                    <p class="text-sm text-gray-500 truncate">Can you help me with my account registration?</p>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <!-- Chat Area (right) -->
          <div class="w-2/3 flex flex-col">
            <!-- Chat Header -->
            <div class="p-4 border-b border-gray-200 flex items-center">
              <div class="flex items-center">
                <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Contact" class="w-10 h-10 rounded-full" />
                <div class="ml-3">
                  <h3 class="text-sm font-medium text-gray-900">Maria Santos</h3>
                  <p class="text-xs text-green-500">Online</p>
                </div>
              </div>
            </div>

            <!-- Chat Messages: flex-1 so it fills available height and scrolls -->
            <div id="messages" class="flex-1 overflow-y-auto p-6">
              <!-- Use a flex column; messages will stack from top. -->
              <div class="flex flex-col gap-6">
                <!-- Date separator -->
                <div class="flex justify-center">
                  <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">April 25, 2023</span>
                </div>

                <!-- Received Message -->
                <div class="flex items-start space-x-3">
                  <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Contact" class="w-8 h-8 rounded-full mt-1" />
                  <div class="bg-gray-100 rounded-lg rounded-bl-none p-4 max-w-xl min-h-[80px] flex items-center">
                    <p class="text-sm text-gray-800">Hello! I wanted to ask about the street lighting project. It looks amazing!</p>
                  </div>
                  <span class="text-xs text-gray-500 ml-3 self-start">9:45 AM</span>
                </div>

                <!-- Sent Message -->
                <div class="flex items-start justify-end space-x-3">
                  <span class="text-xs text-gray-500 mr-3 self-start">10:02 AM</span>
                  <div class="bg-teal-500 text-white rounded-lg rounded-br-none p-4 max-w-xl min-h-[80px] flex items-center">
                    <p class="text-sm">Thank you, Maria! We're glad you like it. The project was completed ahead of schedule and under budget.</p>
                  </div>
                </div>

                <!-- Received Message -->
                <div class="flex items-start space-x-3">
                  <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Contact" class="w-8 h-8 rounded-full mt-1" />
                  <div class="bg-gray-100 rounded-lg rounded-bl-none p-4 max-w-xl min-h-[80px] flex items-center">
                    <p class="text-sm text-gray-800">That's great news! Will we see a reduction in our monthly dues for electricity?</p>
                  </div>
                  <span class="text-xs text-gray-500 ml-3 self-start">10:15 AM</span>
                </div>

                <!-- Sent Message -->
                <div class="flex items-start justify-end space-x-3">
                  <span class="text-xs text-gray-500 mr-3 self-start">10:23 AM</span>
                  <div class="bg-teal-500 text-white rounded-lg rounded-br-none p-4 max-w-xl min-h-[80px] flex items-center">
                    <p class="text-sm">Yes, we expect to see a 30% reduction in our electricity costs for street lighting. This will be reflected in the next quarter's financial report.</p>
                  </div>
                </div>

              </div>
            </div>

            <!-- Chat Input pinned to bottom -->
            <div class="p-4 border-t border-gray-200">
              <div class="flex items-center">
                <button class="text-gray-400 hover:text-gray-500 mr-2">
                  <i class="fas fa-paperclip"></i>
                </button>
                <input type="text" placeholder="Type a message..."
                  class="flex-1 border border-gray-300 rounded-full px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
                <button class="ml-2 bg-teal-500 text-white rounded-full p-3 hover:bg-teal-600">
                  <i class="fas fa-paper-plane"></i>
                </button>
              </div>
            </div>

          </div>
        </div> <!-- end flex h-full -->
      </div> <!-- end card -->
    </main>
  </div>
</div>

<script>
  // (Optional) Scroll messages to bottom on load
  window.addEventListener('load', () => {
    const messages = document.getElementById('messages');
    if (messages) messages.scrollTop = messages.scrollHeight;
  });

  // Dynamic sidebar link highlighting (kept from your original)
  document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname.split('/').pop();
    const sidebarLinks = document.querySelectorAll('nav > a');
    sidebarLinks.forEach(link => {
      if (link.getAttribute('href') === currentPath) {
        link.classList.add('bg-teal-700');
      } else {
        link.classList.remove('bg-teal-700');
      }
    });
  });
</script>
</body>
</html>
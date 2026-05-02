<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - Messages</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-50 min-h-screen">
  <div class="min-h-screen flex flex-col md:flex-row">
    <!-- Sidebar -->
    <div id="sidebar" class="bg-teal-800 text-white w-64 py-6 flex flex-col md:static fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out z-30">
      <div class="px-6 mb-8">
        <h1 class="text-2xl font-bold">HOAConnect</h1>
        <p class="text-sm text-teal-200">Mabuhay Homes 2000</p>
      </div>
      <nav class="flex-1">
        <a href="homeowner-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
          <i class="fas fa-tachometer-alt mr-3"></i>
          <span>Dashboard</span>
        </a>

        <!-- Payments Dropdown -->
        <div class="relative">
          <button id="payments-toggle" class="flex items-center px-6 py-3 w-full text-left hover:bg-teal-700 focus:outline-none">
            <i class="fas fa-credit-card mr-3"></i>
            <span>Payments</span>
            <i class="fas fa-chevron-down ml-auto transform transition-transform duration-200"></i>
          </button>
          <div id="payments-dropdown" class="hidden bg-teal-800">
            <a href="homeowner-payment.php" class="flex items-center px-8 py-2 hover:bg-teal-700">
              <i class="fas fa-wallet mr-2"></i>
              View Payments
            </a>
            <a href="homeowner-history.php" class="flex items-center px-8 py-2 hover:bg-teal-700">
              <i class="fas fa-history mr-2"></i>
              Payment History
            </a>
          </div>
        </div>

        <a href="homeowner-hoa-projects.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-gavel mr-3"></i>
          <span>Resolution</span>
        </a>
        <a href="homeowner-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-newspaper mr-3"></i>
          <span>News Feed</span>
        </a>
        <a href="homeowner-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-book mr-3"></i>
          <span>Ledger</span>
        </a>
        <a href="homeowner-message.php" class="flex items-center px-6 py-3 bg-teal-700">
          <i class="fas fa-comments mr-3"></i>
          <span>Messages</span>
        </a>
        <a href="homeowner-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-calendar-alt mr-3"></i>
          <span>Calendar</span>
      </a>
      <a href="homeowner-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
    <div class="flex-1 flex flex-col w-full">
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

      <!-- Messages Card (Admin-style size) -->
      <main class="flex-1 py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col md:flex-row">
          <!-- Contacts List -->
          <div class="w-full md:w-1/3 bg-white border-b md:border-b-0 md:border-r border-gray-200 min-w-[250px]">
            <div class="overflow-y-auto h-full">
              <div class="space-y-2 p-4">
                <div class="flex items-center p-2 hover:bg-gray-50 cursor-pointer">
                  <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Maria Santos" class="w-10 h-10 rounded-full" />
                  <div class="ml-3 flex-1">
                    <div class="flex justify-between items-center">
                      <h3 class="text-sm font-medium text-gray-900">Maria Santos (Secretary)</h3>
                      <span class="text-xs text-gray-500">10:23 AM</span>
                    </div>
                    <p class="text-sm text-gray-500 truncate">Thank you for the update on the street lighting project!</p>
                  </div>
                  <span class="w-2 h-2 bg-green-500 rounded-full ml-2"></span>
                </div>
              </div>
            </div>
          </div>

          <!-- Chat Area -->
          <div class="flex-1 flex flex-col min-w-0">
            <div class="p-4 border-b border-gray-200 bg-white flex items-center">
              <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Secretary Admin" class="w-10 h-10 rounded-full" />
              <div class="ml-3">
                <h3 class="text-sm font-medium text-gray-900">Maria Santos (Secretary)</h3>
                <p class="text-xs text-green-500">Online</p>
              </div>
            </div>
            <div class="flex-1 p-6 overflow-y-auto bg-gray-100" id="chat-messages">
              <div class="space-y-4">
                <div class="flex justify-end">
                  <div class="bg-teal-500 text-white rounded-lg p-3 max-w-[70%]">
                    <p class="text-sm">Hello! I wanted to ask about the street lighting project. It looks amazing!</p>
                    <span class="text-xs text-teal-200 block mt-1">9:45 AM</span>
                  </div>
                </div>
                <div class="flex">
                  <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Maria Santos (Secretary)" class="w-8 h-8 rounded-full mr-2 self-end" />
                  <div class="bg-white rounded-lg p-3 max-w-[70%] shadow">
                    <p class="text-sm text-gray-800">Thank you! We're glad you like it. The project was completed ahead of schedule and under budget.</p>
                    <span class="text-xs text-gray-500 block mt-1">10:02 AM</span>
                  </div>
                </div>
                <div class="flex justify-end">
                  <div class="bg-teal-500 text-white rounded-lg p-3 max-w-[70%]">
                    <p class="text-sm">That's great news! Will we see a reduction in our monthly dues for electricity?</p>
                    <span class="text-xs text-teal-200 block mt-1">10:15 AM</span>
                  </div>
                </div>
                <div class="flex">
                  <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Maria Santos (Secretary)" class="w-8 h-8 rounded-full mr-2 self-end" />
                  <div class="bg-white rounded-lg p-3 max-w-[70%] shadow">
                    <p class="text-sm text-gray-800">Yes, we expect to see a 30% reduction in our electricity costs for street lighting. This will be reflected in the next quarter's financial report.</p>
                    <span class="text-xs text-gray-500 block mt-1">10:23 AM</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="p-4 border-t border-gray-200 bg-white">
              <div class="flex items-center">
                <button class="text-gray-400 hover:text-gray-600 mr-2">
                  <i class="fas fa-paperclip text-lg"></i>
                </button>
                <input type="text" placeholder="Type a message..." id="message-input" class="flex-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" />
                <button id="send-message-btn" class="ml-2 bg-teal-500 text-white rounded-full p-2 hover:bg-teal-600">
                  <i class="fas fa-paper-plane text-lg"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sidebar = document.getElementById('sidebar');
      const sidebarToggle = document.getElementById('sidebarToggle');
      sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('-translate-x-full');
      });

      // Payments dropdown
      const paymentsToggle = document.getElementById('payments-toggle');
      const paymentsDropdown = document.getElementById('payments-dropdown');
      paymentsToggle.addEventListener('click', function() {
        paymentsDropdown.classList.toggle('hidden');
        paymentsToggle.querySelector('.fa-chevron-down').classList.toggle('rotate-180');
      });

      // Send message
      const messageInput = document.getElementById('message-input');
      const sendMessageBtn = document.getElementById('send-message-btn');
      const chatMessages = document.getElementById('chat-messages');

      function sendMessage() {
        const messageText = messageInput.value.trim();
        if (!messageText) return;
        const now = new Date();
        const timeStr = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex justify-end';
        messageDiv.innerHTML = `
          <div class="bg-teal-500 text-white rounded-lg p-3 max-w-[70%]">
            <p class="text-sm">${messageText}</p>
            <span class="text-xs text-teal-200 block mt-1">${timeStr}</span>
          </div>`;
        chatMessages.querySelector('.space-y-4').appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        messageInput.value = '';
      }
      sendMessageBtn.addEventListener('click', sendMessage);
      messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          sendMessage();
        }
      });
    });
  </script>
</body>
</html>

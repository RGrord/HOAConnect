<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - Calendar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
        <a href="homeowner-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
            <i class="fas fa-tachometer-alt mr-3"></i>
            <span>Dashboard</span>
        </a>

        <!-- Payments Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button
                @click="open = !open"
                :aria-expanded="open"
                AIML
                class="flex items-center px-6 py-3 w-full text-left hover:bg-teal-600 focus:outline-none"
            >
                <i class="fas fa-credit-card mr-3"></i>
                <span>Payments</span>
                <i
                    :class="{ 'rotate-180': open }"
                    class="fas fa-chevron-down ml-auto transform transition-transform duration-200"
                ></i>
            </button>
            <div
                x-show="open"
                x-cloak
                class="bg-teal-800"
            >
                <a
                    href="homeowner-payment.php"
                    class="flex items-center px-8 py-2 hover:bg-teal-600"
                >
                    <i class="fas fa-wallet mr-2"></i>
                    View Payments
                </a>
                <a
                    href="homeowner-history.php"
                    class="flex items-center px-8 py-2 hover:bg-teal-600"
                >
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
        <a href="homeowner-message.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
            <i class="fas fa-comments mr-3"></i>
            <span>Messages</span>
        </a>
        <a href="homeowner-calendar.php" class="flex items-center px-6 py-3 bg-teal-700">
          <i class="fas fa-calendar-alt mr-3"></i>
          <span>Calendar</span>
      </a>
        <a href="homeowner-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-user-circle mr-3"></i>
          <span>Profile</span>
      </a> 
    </nav>
    <div class="px-6 py-4 mt-auto">
        <button
            class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded flex items-center justify-center"
        >
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </button>
    </div>
</div>

    <!-- Main Content -->
    <div class="flex-1 overflow-x-hidden overflow-y-auto">
      <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Calendar</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>

      <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Calendar Header -->
        <div class="flex justify-between items-center mb-6">
          <div class="flex items-center">
            <h2 id="currentMonth" class="text-xl font-semibold text-gray-900">May 2023</h2>
            <div class="ml-4 flex space-x-2">
              <button id="prevMonth" class="p-2 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-teal-500">
                <i class="fas fa-chevron-left text-gray-600"></i>
              </button>
              <button id="nextMonth" class="p-2 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-teal-500">
                <i class="fas fa-chevron-right text-gray-600"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Calendar Grid -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
          <!-- Days of Week -->
          <div class="grid grid-cols-7 gap-px bg-gray-200">
            <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Sun</div>
            <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Mon</div>
            <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Tue</div>
            <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Wed</div>
            <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Thu</div>
            <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Fri</div>
            <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Sat</div>
          </div>

          <!-- Calendar Days -->
          <div id="calendarGrid" class="grid grid-cols-7 grid-rows-5 gap-px bg-gray-200">
            <!-- Previous Month -->
            <div class="bg-gray-50 min-h-[120px] p-2">
              <div class="text-sm text-gray-400">30</div>
            </div>
            <!-- May 1 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">1</div>
              <div class="mt-1">
                <div class="bg-teal-100 text-teal-800 text-xs rounded p-1 mb-1 truncate">
                  <i class="fas fa-dollar-sign mr-1"></i> Monthly Dues Collection
                </div>
              </div>
            </div>
            <!-- May 2 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">2</div>
            </div>
            <!-- May 3 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">3</div>
            </div>
            <!-- May 4 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">4</div>
            </div>
            <!-- May 5 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">5</div>
            </div>
            <!-- May 6 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">6</div>
            </div>

            <!-- May 7 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">7</div>
            </div>
            <!-- May 8 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">8</div>
            </div>
            <!-- May 9 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">9</div>
            </div>
            <!-- May 10 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">10</div>
            </div>
            <!-- May 11 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">11</div>
            </div>
            <!-- May 12 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">12</div>
              <div class="mt-1">
                <div class="bg-green-100 text-green-800 text-xs rounded p-1 mb-1 truncate">
                  <i class="fas fa-users mr-1"></i> Board Meeting
                </div>
              </div>
            </div>
            <!-- May 13 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">13</div>
            </div>

            <!-- May 14 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">14</div>
            </div>
            <!-- May 15 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">15</div>
              <div class="mt-1">
                <div class="bg-purple-100 text-purple-800 text-xs rounded p-1 mb-1 truncate">
                  <i class="fas fa-broom mr-1"></i> Community Clean-up Day
                </div>
              </div>
            </div>
            <!-- May 16 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">16</div>
            </div>
            <!-- May 17 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">17</div>
            </div>
            <!-- May 18 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">18</div>
            </div>
            <!-- May 19 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">19</div>
            </div>
            <!-- May 20 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">20</div>
              <div class="mt-1">
                <div class="bg-red-100 text-red-800 text-xs rounded p-1 mb-1 truncate">
                  <i class="fas fa-clipboard-check mr-1"></i> Project Deadline
                </div>
              </div>
            </div>

            <!-- May 21 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">21</div>
            </div>
            <!-- May 22 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">22</div>
            </div>
            <!-- May 23 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">23</div>
            </div>
            <!-- May 24 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">24</div>
            </div>
            <!-- May 25 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">25</div>
            </div>
            <!-- May 26 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">26</div>
            </div>
            <!-- May 27 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">27</div>
            </div>

            <!-- May 28 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">28</div>
              <div class="mt-1">
                <div class="bg-teal-100 text-teal-800 text-xs rounded p-1 mb-1 truncate">
                  <i class="fas fa-glass-cheers mr-1"></i> Summer Festival
                </div>
              </div>
            </div>
            <!-- May 29 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">29</div>
            </div>
            <!-- May 30 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">30</div>
            </div>
            <!-- May 31 -->
            <div class="bg-white min-h-[120px] p-2">
              <div class="text-sm">31</div>
            </div>
            <!-- Next Month -->
            <div class="bg-gray-50 min-h-[120px] p-2">
              <div class="text-sm text-gray-400">1</div>
            </div>
            <div class="bg-gray-50 min-h-[120px] p-2">
              <div class="text-sm text-gray-400">2</div>
            </div>
            <div class="bg-gray-50 min-h-[120px] p-2">
              <div class="text-sm text-gray-400">3</div>
            </div>
          </div>
        </div>

        <!-- Upcoming Events -->
        <div class="mt-8">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Upcoming Events</h3>
          <div class="bg-white shadow rounded-lg overflow-hidden">
            <ul class="divide-y divide-gray-200">
              <li class="p-4 hover:bg-gray-50">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-12 w-12 rounded-md bg-green-100 flex items-center justify-center text-green-600">
                    <i class="fas fa-users text-lg"></i>
                  </div>
                  <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                      <h4 class="text-sm font-medium text-gray-900">Board Meeting</h4>
                      <span class="text-xs text-gray-500">May 12, 2023</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">7:00 PM - 9:00 PM • Community Clubhouse</p>
                    <p class="text-sm text-gray-500 mt-1">Monthly board meeting to discuss ongoing projects and community issues.</p>
                  </div>
                </div>
              </li>
              <li class="p-4 hover:bg-gray-50">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-12 w-12 rounded-md bg-purple-100 flex items-center justify-center text-purple-600">
                    <i class="fas fa-broom text-lg"></i>
                  </div>
                  <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                      <h4 class="text-sm font-medium text-gray-900">Community Clean-up Day</h4>
                      <span class="text-xs text-gray-500">May 15, 2023</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">8:00 AM - 12:00 PM • Community Park</p>
                    <p class="text-sm text-gray-500 mt-1">Join us for our monthly community clean-up day. Bring gloves and wear comfortable clothes.</p>
                  </div>
                </div>
              </li>
              <li class="p-4 hover:bg-gray-50">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-12 w-12 rounded-md bg-red-100 flex items-center justify-center text-red-600">
                    <i class="fas fa-clipboard-check text-lg"></i>
                  </div>
                  <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                      <h4 class="text-sm font-medium text-gray-900">Project Deadline</h4>
                      <span class="text-xs text-gray-500">May 20, 2023</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Basketball Court Renovation</p>
                    <p class="text-sm text-gray-500 mt-1">Deadline for completion of the basketball court renovation project.</p>
                  </div>
                </div>
              </li>
              <li class="p-4 hover:bg-gray-50">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-12 w-12 rounded-md bg-teal-100 flex items-center justify-center text-teal-600">
                    <i class="fas fa-glass-cheers text-lg"></i>
                  </div>
                  <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                      <h4 class="text-sm font-medium text-gray-900">Summer Festival</h4>
                      <span class="text-xs text-gray-500">May 28, 2023</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">4:00 PM - 10:00 PM • Community Clubhouse</p>
                    <p class="text-sm text-gray-500 mt-1">Annual summer festival with food, games, and entertainment for all residents.</p>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script>
    // Sidebar functionality
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarLinks = document.querySelectorAll('nav a');
      const currentPath = window.location.pathname.split('/').pop();

      sidebarLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
          sidebarLinks.forEach(l => l.classList.remove('bg-teal-700', 'bg-teal-900'));
          link.classList.add('bg-teal-700');
        }

        link.addEventListener('mouseenter', function() {
          if (!link.classList.contains('bg-teal-700')) {
            link.classList.add('bg-teal-600');
          }
        });

        link.addEventListener('mouseleave', function() {
          if (!link.classList.contains('bg-teal-700')) {
            link.classList.remove('bg-teal-600');
          }
        });

        link.addEventListener('click', function(e) {
          if (link.getAttribute('href') === currentPath) {
            e.preventDefault();
            sidebarLinks.forEach(l => l.classList.remove('bg-teal-700', 'bg-teal-900'));
            link.classList.add('bg-teal-700');
          }
        });
      });

      // Calendar navigation functionality
      let currentDate = new Date(2023, 4, 1); // May 2023 (months are 0-indexed)
      
      // Get DOM elements
      const currentMonthElement = document.getElementById('currentMonth');
      const prevMonthButton = document.getElementById('prevMonth');
      const nextMonthButton = document.getElementById('nextMonth');
      
      // Format month and year for display
      function formatMonthYear(date) {
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 
                        'July', 'August', 'September', 'October', 'November', 'December'];
        return `${months[date.getMonth()]} ${date.getFullYear()}`;
      }
      
      // Update the calendar display
      function updateCalendar() {
        currentMonthElement.textContent = formatMonthYear(currentDate);
        
        // In a real implementation, we would regenerate the calendar grid here
        // For this demo, we'll just update the month/year display
      }
      
      // Event listeners for navigation buttons
      prevMonthButton.addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateCalendar();
      });
      
      nextMonthButton.addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateCalendar();
      });
      
      // Initialize calendar
      updateCalendar();
    });
  </script>
</body>
</html>
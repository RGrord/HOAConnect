<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - Calendar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
      <a href="sec-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
        <i class="fas fa-tachometer-alt mr-3"></i>
        <span>Dashboard</span>
      </a>
      <a href="sec-projectproposal.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
        <i class="fas fa-gavel mr-3"></i>
        <span>Resolution</span>
      </a>
      <a href="sec-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
        <i class="fas fa-newspaper mr-3"></i>
        <span>News Feed</span>
      </a>
      <a href="sec-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-book mr-3"></i>
        <span>Ledger</span>
      </a>
      <a href="sec-calendar.php" class="flex items-center px-6 py-3 bg-teal-700">
        <i class="fas fa-calendar-alt mr-3"></i>
        <span>Calendar</span>
      </a>
      <a href="sec-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
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
          <div class="flex space-x-2">
            <button
              class="bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-md flex items-center justify-center"
              onclick="openAddEventModal()">
              <i class="fas fa-plus mr-2"></i> Add Event
            </button>
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
                <div class="bg-blue-100 text-blue-800 text-xs rounded p-1 mb-1 truncate">
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
                  <div class="flex-shrink-0 h-12 w-12 rounded-md bg-purple-100 flex items-center justify-center text-purple-600">
                    <i class="fas fa-broom text-lg"></i>
                  </div>
                  <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                      <h4 class="text-sm font-medium text-gray-900">Community Clean-up Day</h4>
                      <span class="text-xs text-gray-500">May 15, 2023</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">8:00 AM - 12:00 PM • Community Park</p>
                  </div>
                  <div class="ml-2">
                    <button class="text-gray-400 hover:text-gray-500">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                  </div>
                </div>
              </li>
              <li class="p-4 hover:bg-gray-50">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-12 w-12 rounded-md bg-blue-100 flex items-center justify-center text-blue-600">
                    <i class="fas fa-glass-cheers text-lg"></i>
                  </div>
                  <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                      <h4 class="text-sm font-medium text-gray-900">Summer Festival</h4>
                      <span class="text-xs text-gray-500">May 28, 2023</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">4:00 PM - 10:00 PM • Community Clubhouse</p>
                  </div>
                  <div class="ml-2">
                    <button class="text-gray-400 hover:text-gray-500">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                  </div>
                </div>
              </li>
              <li class="p-4 hover:bg-gray-50">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-12 w-12 rounded-md bg-green-100 flex items-center justify-center text-green-600">
                    <i class="fas fa-users text-lg"></i>
                  </div>
                  <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                      <h4 class="text-sm font-medium text-gray-900">HOA General Assembly</h4>
                      <span class="text-xs text-gray-500">June 10, 2023</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">2:00 PM - 5:00 PM • Community Clubhouse</p>
                  </div>
                  <div class="ml-2">
                    <button class="text-gray-400 hover:text-gray-500">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Add Event Modal -->
  <div id="addEventModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
      <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">Add New Event</h3>
        <button onclick="closeAddEventModal()" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-6">
        <form class="space-y-4">
          <div>
            <label for="event-title" class="block text-sm font-medium text-gray-700">Event Title</label>
            <input type="text" id="event-title" name="event-title"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="event-date" class="block text-sm font-medium text-gray-700">Date</label>
              <input type="date" id="event-date" name="event-date"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
            <div>
              <label for="event-time" class="block text-sm font-medium text-gray-700">Time</label>
              <input type="time" id="event-time" name="event-time"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
            </div>
          </div>
          <div>
            <label for="event-location" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" id="event-location" name="event-location"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" />
          </div>
          <div>
            <label for="event-description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="event-description" name="event-description" rows="3"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"></textarea>
          </div>
          <div class="flex justify-end space-x-3 mt-6">
            <button type="button" onclick="closeAddEventModal()"
              class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
              Cancel
            </button>
            <button type="button"
              class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
              Save Event
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script>
    // Modal functionality
    function openAddEventModal() {
      document.getElementById('addEventModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeAddEventModal() {
      document.getElementById('addEventModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    // Calendar navigation functionality
    document.addEventListener('DOMContentLoaded', function() {
      // Current date tracking
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
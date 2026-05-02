<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOAConnect - Treasurer Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body class="bg-gray-50">
  <div class="min-h-screen flex">
    <!--Sidebar-->
    <div class="bg-teal-800 text-white w-64 py-6 flex flex-col">
      <div class="px-6 mb-8">
        <h1 class="text-2xl font-bold">HOAConnect</h1>
        <p class="text-sm text-teal-200">Mabuhay Homes 2000</p>
      </div>
      <nav class="flex-1">
        <a href="tres-dashboard.php" class="flex items-center px-6 py-3 bg-teal-700">
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
        <a href="tres-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-newspaper mr-3"></i>
          <span>News Feed</span>
        </a>
        <a href="tres-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
          <i class="fas fa-calendar-alt mr-3"></i>
          <span>Calendar</span>
        </a>
        <a href="tres-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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
            <h1 class="text-2xl font-bold text-gray-900">Treasurer's Dashboard</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>

      <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <!-- Total Users -->
            <div class="bg-white rounded-lg shadow p-6 cursor-pointer">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-500">Total Users</p>
                  <p class="text-2xl font-bold text-gray-900">156</p>
                </div>
                <div class="bg-teal-100 p-3 rounded-full text-teal-600">
                  <i class="fas fa-users"></i>
                </div>
              </div>
            </div>
          </a>

          <!-- Total Events -->
          <a href="sec-calendar.html" class="block">
            <div class="bg-white rounded-lg shadow p-6 cursor-pointer">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-500">Total Events</p>
                  <p class="text-2xl font-bold text-gray-900">24</p>
                </div>
                <div class="bg-teal-100 p-3 rounded-full text-teal-600">
                  <i class="fas fa-calendar-alt"></i>
                </div>
              </div>
            </div>
          </a>

          <!-- Total Collected Fees -->
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-500">Total Collected Fees</p>
                <p class="text-2xl font-bold text-gray-900">₱179,400</p>
              </div>
              <div class="bg-green-100 p-3 rounded-full text-green-600">
                <i class="fas fa-money-bill-wave"></i>
              </div>
            </div>
          </div>

          <!-- Projects -->
          <a href="sec-projectproposal.html" class="block">
            <div class="bg-white rounded-lg shadow p-6 cursor-pointer">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-500">Projects</p>
                  <p class="text-2xl font-bold text-gray-900">5</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full text-yellow-600">
                  <i class="fas fa-clipboard-check"></i>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Fee Collection Chart -->
        <div class="bg-white rounded-lg shadow mb-8">
          <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Fee Collection Overview</h2>
          </div>
          <div class="p-6">
            <div class="flex justify-between mb-6">
              <div class="flex space-x-2">
                <button id="dailyBtn" class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-md">Daily</button>
                <button id="weeklyBtn" class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-md">Weekly</button>
                <button id="monthlyBtn" class="px-3 py-1 bg-teal-600 text-white text-sm rounded-md">Monthly</button>
                <button id="annualBtn" class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-md">Annual</button>
              </div>
              <div>
                <select id="yearSelect" class="border border-gray-300 rounded-md shadow-sm py-1 px-3 bg-white focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                  <option value="2025" selected>2025</option>
                  <option value="2023">2023</option>
                  <option value="2022">2022</option>
                  <option value="2021">2021</option>
                </select>
              </div>
            </div>
            <!-- Chart Canvas -->
            <div class="h-64">
              <canvas id="feeCollectionChart"></canvas>
            </div>
            <div class="mt-6 grid grid-cols-4 gap-4 text-center">
              <div>
                <p class="text-sm font-medium text-gray-500">Today</p>
                <p class="text-lg font-semibold text-gray-900">₱3,450</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">This Week</p>
                <p class="text-lg font-semibold text-gray-900">₱12,800</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">This Month</p>
                <p class="text-lg font-semibold text-gray-900">₱45,600</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">This Year</p>
                <p class="text-lg font-semibold text-gray-900">₱179,400</p>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Sidebar functionality
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

      // Fee Collection Chart
      const ctx = document.getElementById('feeCollectionChart').getContext('2d');
      let feeChart;

      // Sample data for different views and years
      const chartData = {
        2025: {
          daily: {
            labels: ['Apr 25', 'Apr 26', 'Apr 27', 'Apr 28', 'Apr 29', 'Apr 30', 'May 1'],
            data: [2800, 2900, 3100, 3000, 3200, 3300, 3450] // Today: ₱3,450
          },
          weekly: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
            data: [11000, 11500, 12000, 12500, 12800] // This Week: ₱12,800
          },
          monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            data: [35000, 36000, 37000, 40000, 45600] // This Month: ₱45,600
          },
          annual: {
            labels: ['2021', '2022', '2023', '2024', '2025'],
            data: [140000, 150000, 160000, 170000, 179400] // This Year: ₱179,400
          }
        },
        2023: {
          daily: {
            labels: ['Dec 25', 'Dec 26', 'Dec 27', 'Dec 28', 'Dec 29', 'Dec 30', 'Dec 31'],
            data: [2500, 2600, 2700, 2800, 2900, 3000, 3100]
          },
          weekly: {
            labels: ['Week 49', 'Week 50', 'Week 51', 'Week 52'],
            data: [10000, 10500, 11000, 11500]
          },
          monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            data: [30000, 31000, 32000, 33000, 34000, 35000, 36000, 37000, 38000, 39000, 40000, 41000]
          },
          annual: {
            labels: ['2021', '2022', '2023'],
            data: [140000, 150000, 160000]
          }
        },
        2022: {
          daily: {
            labels: ['Dec 25', 'Dec 26', 'Dec 27', 'Dec 28', 'Dec 29', 'Dec 30', 'Dec 31'],
            data: [2200, 2300, 2400, 2500, 2600, 2700, 2800]
          },
          weekly: {
            labels: ['Week 49', 'Week 50', 'Week 51', 'Week 52'],
            data: [9000, 9500, 10000, 10500]
          },
          monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            data: [28000, 29000, 30000, 31000, 32000, 33000, 34000, 35000, 36000, 37000, 38000, 39000]
          },
          annual: {
            labels: ['2021', '2022'],
            data: [140000, 150000]
          }
        },
        2021: {
          daily: {
            labels: ['Dec 25', 'Dec 26', 'Dec 27', 'Dec 28', 'Dec 29', 'Dec 30', 'Dec 31'],
            data: [2000, 2100, 2200, 2300, 2400, 2500, 2600]
          },
          weekly: {
            labels: ['Week 49', 'Week 50', 'Week 51', 'Week 52'],
            data: [8000, 8500, 9000, 9500]
          },
          monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            data: [25000, 26000, 27000, 28000, 29000, 30000, 31000, 32000, 33000, 34000, 35000, 36000]
          },
          annual: {
            labels: ['2021'],
            data: [140000]
          }
        }
      };

      // Initialize the chart with default view (Monthly, 2025)
      feeChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: chartData[2025].monthly.labels,
          datasets: [{
            label: 'Fee Collection (₱)',
            data: chartData[2025].monthly.data,
            borderColor: '#0d9488',
            backgroundColor: 'rgba(13, 148, 136, 0.2)',
            fill: true,
            tension: 0.4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Amount (₱)'
              }
            },
            x: {
              title: {
                display: true,
                text: 'Time'
              }
            }
          },
          plugins: {
            legend: {
              display: true,
              position: 'top'
            }
          }
        }
      });

      // Function to update the chart based on view and year
      function updateChart(view, year) {
        feeChart.data.labels = chartData[year][view].labels;
        feeChart.data.datasets[0].data = chartData[year][view].data;
        feeChart.options.scales.x.title.text = view === 'daily' ? 'Day' : view === 'weekly' ? 'Week' : view === 'monthly' ? 'Month' : 'Year';
        feeChart.update();
      }

      // Button event listeners
      const buttons = {
        daily: document.getElementById('dailyBtn'),
        weekly: document.getElementById('weeklyBtn'),
        monthly: document.getElementById('monthlyBtn'),
        annual: document.getElementById('annualBtn')
      };
      let currentView = 'monthly';
      let currentYear = '2025';

      Object.keys(buttons).forEach(view => {
        buttons[view].addEventListener('click', () => {
          currentView = view;
          Object.values(buttons).forEach(btn => {
            btn.classList.remove('bg-teal-600', 'text-white');
            btn.classList.add('bg-gray-200', 'text-gray-700');
          });
          buttons[view].classList.remove('bg-gray-200', 'text-gray-700');
          buttons[view].classList.add('bg-teal-600', 'text-white');
          updateChart(currentView, currentYear);
        });
      });

      // Year dropdown event listener
      const yearSelect = document.getElementById('yearSelect');
      yearSelect.addEventListener('change', (e) => {
        currentYear = e.target.value;
        updateChart(currentView, currentYear);
      });
    });
  </script>
</body>
</html>
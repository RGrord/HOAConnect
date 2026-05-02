<?php
session_start();
include('../../connection/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Calendar</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">

</head> 
<body class="bg-gray-100">

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
      <a href="admin-residents.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-user-slash mr-2"></i>
        <span>Homeowners with No Accounts</span>
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
          <a href="admin-remittance.php" class="flex items-center px-10 py-2 hover:bg-teal-600">
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


      <a href="admin-hoaprojects.php" class="flex items-center px-6 py-3 bg-teal-700">
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

      <a href="admin-messages.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
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


<div class="p-4 ml-64 w-full">
    <h1 class="text-2xl font-bold mb-4">Event Calendar</h1>

    <button 
        data-modal-target="createEventModal" 
        data-modal-toggle="createEventModal"
        class="bg-teal-600 text-white px-4 py-2 rounded mb-4 hover:bg-teal-700"
    >
        + Add Event
    </button>
    <div id="calendar" class="bg-white p-4 rounded shadow"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        height: 750,
        selectable: true,
        editable: false,
        events: "../../Query/loads-event.php",  // <--- loads events from PHP
        eventClick(info) {
            document.getElementById("edit-id").value        = info.event.id;
            document.getElementById("edit-title").value     = info.event.title;
            document.getElementById("edit-start").value     = info.event.startStr.slice(0,10);
            document.getElementById("edit-end").value       = info.event.endStr ? info.event.endStr.slice(0,10) : "";
            document.getElementById("edit-desc").value      = info.event.extendedProps.description;
            document.getElementById("editEventModal").classList.remove("hidden");
        },
        dateClick(info) {
            document.getElementById("create-start").value = info.dateStr;
            document.getElementById("createEventModal").classList.remove("hidden");
        },
    });
    calendar.render();
});
</script>

<div id="createEventModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 class="text-xl font-bold mb-3">Create Event</h2>

        <form action="../../Query/create-event.php" method="POST">

            <label class="text-sm">Title</label>
            <input name="title" class="w-full border p-2 rounded mb-2" required>

            <label class="text-sm">Start Date</label>
            <input name="start_date" id="create-start" type="date" class="w-full border p-2 rounded mb-2" required>

            <label class="text-sm">End Date</label>
            <input name="end_date" type="date" class="w-full border p-2 rounded mb-2">

            <label class="text-sm">Description</label>
            <textarea name="description" class="w-full border p-2 rounded mb-3"></textarea>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('createEventModal').classList.add('hidden')" class="px-3 py-2 border rounded">Cancel</button>
                <button type="submit" class="px-3 py-2 bg-teal-600 text-white rounded">Save</button>
            </div>

        </form>
    </div>
</div>

<div id="editEventModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 class="text-xl font-bold mb-3">Edit Event</h2>

        <form action="../../Query/edit-event.php" method="POST">

            <input type="hidden" name="id" id="edit-id">

            <label class="text-sm">Title</label>
            <input id="edit-title" name="title" class="w-full border p-2 rounded mb-2" required>

            <label class="text-sm">Start Date</label>
            <input id="edit-start" name="start_date" type="date" class="w-full border p-2 rounded mb-2" required>

            <label class="text-sm">End Date</label>
            <input id="edit-end" name="end_date" type="date" class="w-full border p-2 rounded mb-2">

            <label class="text-sm">Description</label>
            <textarea id="edit-desc" name="description" class="w-full border p-2 rounded mb-3"></textarea>

            <div class="flex justify-between mt-4">
                <button type="button" class="px-3 py-2 border rounded" onclick="document.getElementById('editEventModal').classList.add('hidden')">Cancel</button>
                
                <button 
                    type="button"
                    onclick="openDeleteModal()"
                    class="px-3 py-2 bg-red-600 text-white rounded"
                >Delete</button>

                <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>



<div id="deleteEventModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-80">
        <h2 class="text-xl font-bold mb-3 text-red-600">Delete Event</h2>

        <p class="mb-4">Are you sure you want to delete this event?</p>

        <form action="../../Query/delete-event.php" method="POST">
            <input type="hidden" name="id" id="delete-id">

            <div class="flex justify-between">
                <button type="button" onclick="document.getElementById('deleteEventModal').classList.add('hidden')" class="px-3 py-2 border rounded">Cancel</button>
                <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded">Delete</button>
            </div>
        </form>
    </div>
</div>


<?php
$today = date('Y-m-d');

$up_coming_events = "SELECT * FROM events WHERE start_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 5 DAY) ORDER BY start_date ASC;";
$run_up_coming_events = mysqli_query($conn,$up_coming_events);

if(mysqli_num_rows($run_up_coming_events) > 0){
  foreach($run_up_coming_events as $row_upcoming_events){
    ?>

      <label for="">Title:</label>
      <p><?php echo $row_upcoming_events['title']?></p>
      <label for="">Description:</label>
      <p><?php echo $row_upcoming_events['description']?></p>
      <label for="">Date:</label>
      <p><?php echo $row_upcoming_events['start_date']?></p>

    <?php
  }
}

?>

<script>
function openDeleteModal() {
    document.getElementById("delete-id").value = document.getElementById("edit-id").value;
    document.getElementById("deleteEventModal").classList.remove("hidden");
}
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
</body>
</html>

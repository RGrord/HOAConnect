<?php
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>HOAConnect - Remittance</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>
  [x-cloak] { display: none !important; }
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
      <a href="admin-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-tachometer-alt mr-3"></i>
        <span>Dashboard</span>
      </a>
      <a href="admin-accounts.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-users mr-3"></i>
        <span>User Management</span>
      </a>
      
      <!-- Payment Management Dropdown -->
      <div x-data="{ open: true }">
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
          <a href="admin-remittance.php" class="flex items-center px-10 py-2 bg-teal-700">
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

  <!-- Main Content -->
  <div class="flex-1 overflow-x-hidden overflow-y-auto">
    <header class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
          <h1 class="text-2xl font-bold text-gray-900">Remittance</h1>
          <div class="flex items-center space-x-2">
            <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
              <i class="fas fa-bell"></i>
            </button>
          </div>
        </div>
  </header>
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <!-- Payment History Section -->
      <div id="payment-history-section" class="mb-8">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-semibold text-gray-900">Daily Payment History</h2>
          <div class="flex items-center space-x-6 bg-teal-50 border border-teal-200 rounded-xl px-6 py-3 shadow-sm">
            <div>
              <p class="text-sm font-medium text-teal-700">Total Collected (₱)</p>
              <p id="totalCollected" class="text-2xl font-bold text-black-900">0</p>
            </div>
           
          </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
          <div class="overflow-x-auto">
            <form id="remitSelectorForm" method="POST" onsubmit="return false;">
              <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-teal-100">
                  <tr>
                    <th class="px-4 py-2 text-left">Select</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Fee Name</th>
                    <th class="px-4 py-2 text-left">Amount (₱)</th>
                    <th class="px-4 py-2 text-left">Date</th>
                  </tr>
                </thead>

                <tbody id="paymentHistoryTableBody" class="divide-y divide-gray-200">
                  <?php 
                  $sql_view_remittance = "
                    SELECT 
                      payment_history.id,
                      users.first_name, 
                      users.last_name, 
                      payment_history.fee_name, 
                      payment_history.amount, 
                      payment_history.date_created 
                    FROM users 
                    INNER JOIN payment_history 
                      ON users.user_id = payment_history.user_id 
                    WHERE users.role_id = '6' AND payment_history.is_submitted = '0'
                    ORDER BY users.first_name, users.last_name;
                  ";

                  $run_view_remittance = mysqli_query($conn, $sql_view_remittance);

                  if(mysqli_num_rows($run_view_remittance) > 0){
                      foreach($run_view_remittance as $row_remittance) {
                        $ph_id = (int)$row_remittance['id'];
                        $fullname = htmlspecialchars($row_remittance['first_name'] . " " . $row_remittance['last_name']);
                        $fee_name = htmlspecialchars($row_remittance['fee_name']);
                        $amount_val = number_format($row_remittance['amount'], 2);
                        $raw_amount = htmlspecialchars($row_remittance['amount']);
                        $date_val = !empty($row_remittance['date_created']) ? date('F d, Y', strtotime($row_remittance['date_created'])) : 'N/A';
                  ?>
                      <tr>
                        <td class="px-4 py-2 text-center">
                          <input 
                            type="checkbox" 
                            class="amountCheckbox" 
                            name="selected_payments[]" 
                            value="<?php echo $ph_id; ?>" 
                            data-amount="<?php echo $raw_amount; ?>"
                            data-fee="<?php echo $fee_name; ?>"
                            data-name="<?php echo $fullname; ?>">
                        </td>
                        <td class="px-4 py-2"><?php echo $fullname; ?></td>
                        <td class="px-4 py-2"><?php echo $fee_name; ?></td>
                        <td class="px-4 py-2">₱<?php echo $amount_val; ?></td>
                        <td class="px-4 py-2"><?php echo $date_val; ?></td>
                      </tr>
                  <?php 
                      }
                  } else {
                    echo '<tr><td colspan="5" class="text-center py-4 text-gray-500">No payment records found.</td></tr>';
                  }
                  ?>
                </tbody>
              </table>

              <!-- Hidden field (kept for compatibility if needed) -->
              <input type="hidden" id="totalAmountInput" name="amount" value="">

              <!-- Trigger modal instead of immediate submit -->
              <div style="margin-top: 15px;">
                <button type="button" id="openRemitModalBtn" 
                  style="background-color: #16a34a; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">
                  Submit
                </button>
              </div>
            </form>

        <!-- REMIT MODAL (final form posts to handler) -->
        <div id="remitModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999;">
          <div style="width:420px; margin:6% auto; background:#fff; padding:18px; border-radius:10px; box-shadow:0 8px 30px rgba(0,0,0,0.25); position:relative;">
            <button type="button" onclick="closeRemitModal()" style="position:absolute; right:12px; top:8px; background:transparent; border:none; font-size:22px; cursor:pointer;">&times;</button>
            <h3 style="margin-top:4px; margin-bottom:12px;">Submit Remittance</h3>

            <form id="remitForm" action="../../Query/submit-remittance.php" method="POST">
              <label style="display:block; margin-bottom:6px;">Particular</label>
              <textarea name="particular" id="modalParticular" rows="3" required style="width:100%; padding:8px; border-radius:6px; border:1px solid #ccc;"></textarea>

              <label style="display:block; margin-top:8px; margin-bottom:6px;">Amount</label>
              <input type="number" step="0.01" name="amount" id="modalAmount" readonly required style="width:100%; padding:8px; border-radius:6px; border:1px solid #ccc; background:#f8fafc;">

              <label style="display:block; margin-top:8px; margin-bottom:6px;">Date</label>
              <input type="date" name="date" id="modalDate" value="<?php echo date('Y-m-d'); ?>" required style="width:100%; padding:8px; border-radius:6px; border:1px solid #ccc;">

              <label style="display:block; margin-top:8px; margin-bottom:6px;">Transaction Type</label>
              <select name="transaction_type" id="modalTransactionType" style="width:100%; padding:8px; border-radius:6px; border:1px solid #ccc;">
                <option value="">Select</option>
                <option value="Credit">Credit</option>
                <option value="Debit">Debit</option>
              </select>

              <label style="display:block; margin-top:8px; margin-bottom:6px;">Secretary Name</label>
              <input type="text" name="secretary_name" id="modalSecretaryName" value="" required style="width:100%; padding:8px; border-radius:6px; border:1px solid #ccc;">

              <!-- Container for hidden selected payment ids -->
              <div id="selectedPaymentsContainer"></div>

              <div style="margin-top:12px; display:flex; gap:8px; justify-content:flex-end;">
                <button type="button" onclick="closeRemitModal()" style="padding:8px 12px; border-radius:6px; border:1px solid #ccc; background:#fff; cursor:pointer;">Cancel</button>
                <button type="submit" name="submit_remittance" style="padding:8px 14px; border-radius:6px; border:none; background:#16a34a; color:#fff; cursor:pointer;">Submit Remittance</button>
              </div>
            </form>
          </div>
        </div>



          

      <!-- Remittance Table Section -->
      <div id="remittance-table-section" class="mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Remittance Table</h2>

        <div class="bg-white shadow rounded-lg overflow-hidden">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Particular</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount (₱)</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody id="remittanceTableBody" class="bg-white divide-y divide-gray-200">
                <!-- Remittance entries will be rendered dynamically -->
                  
                <?php 

                  $sql_remittance_table = "SELECT * FROM remittance";
                  $run_remittance_table = mysqli_query($conn,$sql_remittance_table);

                  if(mysqli_num_rows($run_remittance_table) > 0){
                    foreach($run_remittance_table as $row_remittance_table){
                      ?>


                        <tr>
                          <td><?php echo $row_remittance_table['particular']?></td>
                          <td><?php echo $row_remittance_table['amount']?></td>
                          <td>
                            <?php 
                              if($row_remittance_table['is_approved'] == 0){
                                echo "Pending";
                              }else{
                                echo "Approved";
                              }
                            ?>
                          </td>
                          <td>

                            <a href="view-table-remittance.php?id=<?php echo $row_remittance_table['id']?>">View</a>
                          
                          </td>
                        </tr>

                      <?php 
                    }
                  }



                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>


<script>
  const checkboxes = document.querySelectorAll('.amountCheckbox');
  const totalCollectedElement = document.getElementById('totalCollected');
  const totalAmountInput = document.getElementById('totalAmountInput');

  function updateTotal() {
    let total = 0;
    checkboxes.forEach(cb => {
      if (cb.checked) total += parseFloat(cb.dataset.amount);
    });
    totalCollectedElement.innerText = "₱" + total.toLocaleString('en-PH', { minimumFractionDigits: 2 });
    totalAmountInput.value = total; // update hidden input for backend
  }

  checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
</script>

<!-- JS: open modal, fill fields, build hidden inputs -->
<script>
  document.getElementById('openRemitModalBtn').addEventListener('click', function() {
    // find checked checkboxes
    const checked = document.querySelectorAll('.amountCheckbox:checked');
    if (checked.length === 0) {
      alert('Please select at least one payment to remit.');
      return;
    }

    // build particular (list of selected items)
    let particulars = [];
    let total = 0;
    const selectedContainer = document.getElementById('selectedPaymentsContainer');
    selectedContainer.innerHTML = ''; // reset

    checked.forEach(ch => {
      const fee = ch.dataset.fee || '';
      const name = ch.dataset.name || '';
      const id = ch.value;
      const amount = parseFloat(ch.dataset.amount) || 0;
      particulars.push(name + ' — ' + fee + ' (₱' + amount.toFixed(2) + ')');
      total += amount;

      // create hidden input for each selected payment id (so remitForm will submit them)
      const hidden = document.createElement('input');
      hidden.type = 'hidden';
      hidden.name = 'selected_payments[]';
      hidden.value = id;
      selectedContainer.appendChild(hidden);
    });

    // set amount both in modal and the legacy hidden input
    document.getElementById('modalAmount').value = total.toFixed(2);
    const totalHiddenLegacy = document.getElementById('totalAmountInput');
    if (totalHiddenLegacy) totalHiddenLegacy.value = total.toFixed(2);

    // open modal
    document.getElementById('remitModal').style.display = 'block';
  });

  function closeRemitModal() {
    document.getElementById('remitModal').style.display = 'none';
  }

  // close on clicking outside
  window.addEventListener('click', function(e) {
    const modal = document.getElementById('remitModal');
    if (e.target === modal) closeRemitModal();
  });
</script>
</body>
</html>

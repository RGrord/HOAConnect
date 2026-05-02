<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php');
$role = $_SESSION['role'];
if (!isset($_GET['id'])) {
    die("Invalid request — Missing ID.");
}

$due_id = intval($_GET['id']);

$sql = "SELECT 
  ft.fee_name,
  ft.description,
  ft.amount,
  ft.effectivity_date,
  ft.status,
  CONCAT(ui.first_name, ' ', ui.middle_name, ' ', ui.last_name) AS fullName
  FROM fee_type ft
  LEFT JOIN user_info ui ON ft.created_by = ui.user_id
  WHERE ft.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $due_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Due not found.");
}

$due = $result->fetch_assoc();
$pageTitle = 'View Fee Type';
ob_start();
?>

<div class="">
    <div class="rounded-lg">
        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none"><?= $pageTitle ?></h3>
            <p class="text-gray-600">Details of the selected fee</p>
        </div>

        <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Due Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Fee Name</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2">
                        <?= htmlspecialchars($due['fee_name']) ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2">
                        <?= htmlspecialchars($due['description']) ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Amount (₱)</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2">
                        <?= number_format($due['amount'], 2) ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Date Start</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2">
                        <?= date('F j, Y', strtotime($due['effectivity_date'])) ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Created By</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2">
                        <?= htmlspecialchars($due['fullName']) ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="flex justify-end gap-2 pt-4">
          <a href="list.php" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Back</a>
          <?php
          if($role == 1 && $due['status'] != 1){
            ?>
            <a href="reject.php?id=<?= $due_id; ?>" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Reject</a>
            <a href="approve.php?id=<?= $due_id; ?>" class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">Approve</a>
            <?php
          }
          ?>
          
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once BASE_PATH . '/pages/layout.php';
?>

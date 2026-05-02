<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/core/init.php';

if (!isset($_GET['id'])) {
    die("Invalid request — Missing ID.");
}

$rental_id = intval($_GET['id']);
$role = $_SESSION['role'] ?? 0;

$sql = "SELECT stall_no, remarks, status, date_created 
        FROM stalls
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $rental_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Stall record not found.");
}

$r = $result->fetch_assoc();

$pageTitle = 'View Stalls';
ob_start();
?>

<div>
    <div class="overflow-hidden">

        <!-- Header -->
        <div class="mb-5 border-b border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">View Stall</h3>
            <p class="text-gray-600">Stall details</p>
        </div>

        <div class="space-y-5">

            <!-- Stall Info -->
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Stall Details</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Stall Number</p>
                        <p class="text-xl font-semibold text-gray-900 mt-1"><?= htmlspecialchars($r['stall_no'] ?? '—') ?></p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-600">Remarks</p>
                        <p class="text-xl font-semibold text-gray-900 mt-1"><?= htmlspecialchars($r['remarks'] ?? '—') ?></p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-600">Status</p>
                        <p class="text-xl font-semibold text-gray-900 mt-1">
                            <?= 
                            htmlspecialchars($r['status'] == 0 ? 'Inactive' : 'Active') ?>
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-600">Date Created</p>
                        <p class="text-xl font-semibold text-gray-900 mt-1">
                            <?= $r['date_created'] ? date('F j, Y', strtotime($r['date_created'])) : '—' ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap justify-end gap-4 pt-6 border-t border-gray-300">
                <a href="list.php" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 font-medium transition">
                    Back to List
                </a>
                <?php if ($role == 3): ?>
                <a href="edit.php?id=<?= $rental_id ?>"
                   class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 font-medium transition">
                    Edit Record
                </a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once BASE_PATH . '/pages/layout.php';
?>

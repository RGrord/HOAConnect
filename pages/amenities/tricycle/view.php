<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
include_once($root . 'app/core/init.php');

if (!isset($_GET['id'])) {
    die("Invalid request — Missing ID.");
}

$toda_id = intval($_GET['id']);
$role = $_SESSION['role'] ?? 0;
$sql = "SELECT * FROM toda WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $toda_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("TODA record not found.");
}

$t = $result->fetch_assoc(); // shorter variable name para consistent

$pageTitle = 'View TODA';
ob_start();
?>

<div>
    <div class="overflow-hidden">

        <!-- Header -->
        <div class="mb-5 border-b border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">View TODA</h3>
            <p class="text-gray-600">View existing TODA information</p>
        </div>

        <div class="space-y-5">

            <!-- TODA Information -->
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">TODA Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <p class="text-sm font-medium text-gray-600">TODA Name</p>
                        <p class="text-xl font-semibold text-gray-900 mt-1">
                            <?= htmlspecialchars($t['toda_name']) ?>
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-600">Number of Tricycles</p>
                        <p class="text-xl font-semibold text-gray-900 mt-1">
                            <?= htmlspecialchars($t['no_of_tricycles']) ?>
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-600">Representative</p>
                        <p class="text-xl font-semibold text-gray-900 mt-1">
                            <?= htmlspecialchars($t['representative']) ?>
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-600">Contact Number</p>
                        <p class="text-xl font-semibold text-gray-900 mt-1">
                            <?= htmlspecialchars($t['contact_no']) ?>
                        </p>
                    </div>

                    <?php if (!empty($t['contract'])): ?>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Contract File</p>
                        <a href="<?= '../../../' . $t['contract'] ?>"
                           target="_blank"
                           class="inline-flex items-center mt-1 px-4 py-2 bg-blue-100 text-blue-800 rounded-lg font-medium hover:bg-blue-200 transition">
                           View Contract
                        </a>
                    </div>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Operation Details -->
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Operation Details</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <p class="text-sm font-medium text-gray-600">Start Date</p>
                        <p class="text-xl font-semibold text-gray-900 mt-1">
                            <?= $t['start_date'] ? date('F j, Y', strtotime($t['start_date'])) : '—' ?>
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-600">End Date</p>
                        <p class="text-xl font-semibold text-gray-900 mt-1">
                            <?= $t['end_date'] ? date('F j, Y', strtotime($t['end_date'])) : '<em class="text-gray-500">Ongoing / No end date</em>' ?>
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
                <?php if($role == 3) : ?>
                <a href="edit.php?id=<?= $t['id'] ?>"
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

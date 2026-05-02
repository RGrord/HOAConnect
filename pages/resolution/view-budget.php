<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
include_once($root . 'app/core/init.php');

if (!isset($_GET['id'])) {
    die("Invalid request — Missing ID.");
}

$project_id = intval($_GET['id']);

/* FETCH PROJECT */
$stmt = $conn->prepare("SELECT * FROM resolution WHERE id = ?");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();

/* FETCH BUDGET RELEASE DETAILS */
$stmt2 = $conn->prepare("SELECT * FROM budget WHERE project_id = ?");
$stmt2->bind_param("i", $project_id);
$stmt2->execute();
$budget = $stmt2->get_result()->fetch_assoc();

if (!$budget) {
    die("No budget release record found for this project.");
}

$pageTitle = 'View Budget Release';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">
        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">Budget Release Information</h3>
            <p class="text-gray-600">Viewing released budget details</p>
        </div>

        <!-- NO FORM (VIEW ONLY) -->
        <div class="space-y-4">

            <!-- PROJECT DETAILS -->
            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Project Details</h2>

                <div class="grid grid-cols-1 gap-6">
                    <div class="grid grid-cols-2 items-center">
                        <label class="text-sm font-medium text-gray-700">Project Resolution Title</label>
                        <input type="text" value="<?= htmlspecialchars($project['project_resolution_title']) ?>" 
                               readonly class="mt-1 w-full rounded-lg border border-gray-300 bg-gray-100 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="text-sm font-medium text-gray-700">Amount Requested</label>
                        <input type="text" value="₱<?= number_format($project['estimated_budget'], 2) ?>" 
                               readonly class="mt-1 w-full rounded-lg border border-gray-300 bg-teal-50 px-3 py-2 font-bold text-teal-700">
                    </div>
                </div>
            </div>

            <!-- BUDGET RELEASE DETAILS -->
            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Released Budget Details</h2>

                <div class="grid grid-cols-1 gap-6">

                    <div class="grid grid-cols-2 items-center">
                        <label class="text-sm font-medium text-gray-700">Recipient</label>
                        <input type="text" value="<?= htmlspecialchars($budget['recipient']) ?>" 
                               readonly class="mt-1 w-full rounded-lg border border-gray-300 bg-gray-100 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="text-sm font-medium text-gray-700">Release Date</label>
                        <input type="date" value="<?= $budget['release_date'] ?>" 
                               readonly class="mt-1 w-full rounded-lg border border-gray-300 bg-gray-100 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="text-sm font-medium text-gray-700">Payment Method</label>
                        <input type="text" value="<?= htmlspecialchars($budget['payment_method']) ?>" 
                               readonly class="mt-1 w-full rounded-lg border border-gray-300 bg-gray-100 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="text-sm font-medium text-gray-700">Reference Number</label>
                        <input type="text" value="<?= htmlspecialchars($budget['reference_number']) ?>" 
                               readonly class="mt-1 w-full rounded-lg border border-gray-300 bg-gray-100 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="text-sm font-medium text-gray-700">Purpose</label>
                        <input type="text" value="<?= htmlspecialchars($budget['purpose']) ?>" 
                               readonly class="mt-1 w-full rounded-lg border border-gray-300 bg-gray-100 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="text-sm font-medium text-gray-700">Approval Notes</label>
                        <input type="text" value="<?= htmlspecialchars($budget['approval_notes']) ?>" 
                               readonly class="mt-1 w-full rounded-lg border border-gray-300 bg-gray-100 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-start">
                        <label class="text-sm font-medium text-gray-700">Acknowledgement Receipt</label>

                        <?php if (!empty($budget['acknowledgement_receipt'])): ?>
                            <a href="/hoa_system/uploads/budget_release/<?= $budget['acknowledgement_receipt'] ?>" 
                               target="_blank" 
                               class="text-blue-600 underline">
                                View File
                            </a>
                        <?php else: ?>
                            <p class="text-gray-500">No file uploaded.</p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

            <div class="flex justify-end pt-4">
                <a href="list.php" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Back
                </a>
            </div>

        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once BASE_PATH . '/pages/layout.php';
?>

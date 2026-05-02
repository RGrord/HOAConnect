<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php');

$role = $_SESSION['role'] ?? '';

if (!isset($_GET['id'])) {
    die("Invalid request — Missing ID.");
}

$id = intval($_GET['id']);

$sql = "SELECT 
            r.*,
            CONCAT(ui.first_name, ' ', COALESCE(ui.middle_name,''), ' ', ui.last_name) AS created_by_name
        FROM resolution r
        LEFT JOIN user_info ui ON r.created_by = ui.user_id
        WHERE r.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Resolution not found.");
}

$res = $result->fetch_assoc();
$pageTitle = 'View Board Resolution';
ob_start();
?>

<div class="">
    <div class="rounded-lg">
        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">View Board Resolution</h3>
            <p class="text-gray-600">Details of the selected resolution</p>
        </div>

        <!-- RESOLUTION INFORMATION -->
        <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Resolution Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Project Resolution Title</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 bg-gray-50">
                        <?= htmlspecialchars($res['project_resolution_title']) ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 items-start">
                    <label class="block text-sm font-medium text-gray-700">Resolution Summary</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 bg-gray-50 whitespace-pre-wrap">
                        <?= htmlspecialchars($res['resolution_summary']) ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Estimated Budget (₱)</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 bg-gray-50">
                        <?= $res['estimated_budget'] ? '₱' . number_format($res['estimated_budget'], 2) : '—' ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Target Start Date</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 bg-gray-50">
                        <?= $res['target_start_date'] ? date('F j, Y', strtotime($res['target_start_date'])) : '—' ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Target End Date</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 bg-gray-50">
                        <?= $res['target_end_date'] ? date('F j, Y', strtotime($res['target_end_date'])) : '—' ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Proposed By</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 bg-gray-50">
                        <?= htmlspecialchars($res['proposed_by']) ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 bg-gray-50">
                        <?php
                        $statusMap = [
                            0 => '<span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span>',
                            1 => '<span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Approved</span>',
                            2 => '<span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Rejected</span>'
                        ];
                        echo $statusMap[$res['status']] ?? '—';
                        ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Created By</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 bg-gray-50">
                        <?= htmlspecialchars($res['created_by_name'] ?? 'Unknown') ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 items-center">
                    <label class="block text-sm font-medium text-gray-700">Date Created</label>
                    <div class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 bg-gray-50">
                        <?= date('F j, Y g:i A', strtotime($res['date_created'])) ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- ATTACHMENTS -->
        <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Attachments</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Project Proposal Document</label>
                    <?php if ($res['project_proposal_document']): ?>
                        <a href="../../uploads/resolutions/<?= htmlspecialchars($res['project_proposal_document']) ?>" target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition">
                            <i class="ri-file-text-line text-xl"></i>
                            View Proposal Document
                        </a>
                    <?php else: ?>
                        <span class="text-gray-500">No file uploaded</span>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Signed Resolution</label>
                    <?php if ($res['upload_signed_resolution']): ?>
                        <a href="../../uploads/resolutions/<?= htmlspecialchars($res['upload_signed_resolution']) ?>" target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                            <i class="ri-file-check-fill text-xl"></i>
                            View Signed Resolution
                        </a>
                    <?php else: ?>
                        <span class="text-gray-500">No file uploaded</span>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <!-- FINANCIAL SUMMARY FLAGS (Optional display) -->
        <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm mb-6">
            <h2 class="text-xl font-semibold text-teal-900 mb-4">Financial Status</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="flex flex-col justify-center">
                <div class="flex items-center gap-2">
                    <i class="ri-file-list-3-line text-2xl text-teal-600"></i>
                    <div class="font-medium">Financial Summary</div>
                </div>
                <div>
                    <?php if ($res['has_financial_summary']): ?>
                        <a href="financial-summary.php?id=<?= $id ?>" target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                            View Details
                        </a>
                    <?php else: ?>
                        <span class="text-gray-500">No Record</span>
                    <?php endif; ?>
                </div>
              </div>
              <div class="flex flex-col">
                <div class="flex items-center gap-2">
                    <i class="ri-money-dollar-circle-line text-2xl text-teal-600"></i>
                    <div class="font-medium">Budget Released</div>
                </div>
                <div>
                    <?php if ($res['is_budget_released']): ?>
                        <a href="view-budget.php?id=<?= $id ?>" target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                            View Details
                        </a>
                    <?php else: ?>
                        <span class="text-gray-500">No file uploaded</span>
                    <?php endif; ?>
                </div>
              </div>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="flex justify-end gap-2 pt-4">
            <a href="list.php" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Back to List</a>
            
            <?php if ($role == 1): ?>
                <?php if ($res['status'] == 0): ?>
                    <a href="reject.php?id=<?= $id ?>" 
                       class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                       onclick="return confirm('Are you sure you want to reject this resolution?')">
                        Reject
                    </a>
                    <a href="approve.php?id=<?= $id ?>" 
                       class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition"
                       onclick="return confirm('Approve this resolution?')">
                        Approve
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once BASE_PATH . '/pages/layout.php';
?>
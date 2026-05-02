<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
include_once($root . 'app/core/init.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_id'])) {
    header('Content-Type: application/json');

    $response = ['success' => false, 'message' => 'Unknown error'];

    try {
        $project_id       = intval($_POST['project_id']);
        $recipient        = trim($_POST['recipient'] ?? '');
        $release_date     = $_POST['release_date'] ?? '';
        $payment_method   = $_POST['payment_method'] ?? '';
        $reference_number = trim($_POST['reference_number'] ?? '');
        $purpose          = trim($_POST['purpose'] ?? '');
        $approval_notes   = trim($_POST['approval_notes'] ?? '');

        if (empty($recipient) || empty($release_date) || empty($payment_method) || empty($purpose)) {
            throw new Exception("Please fill in all required fields.");
        }

        // FILE UPLOAD
        $uploaded_file = "";
        if (!empty($_FILES['acknowledgement_receipt']['name'])) {
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/hoa_system/uploads/budget_release/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);

            $ext = strtolower(pathinfo($_FILES['acknowledgement_receipt']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg','jpeg','png','pdf'])) {
                throw new Exception("Invalid file type. Only JPG, PNG, PDF allowed.");
            }
            if ($_FILES['acknowledgement_receipt']['size'] > 10*1024*1024) {
                throw new Exception("File too large. Max 10MB.");
            }

            $newFilename = time() . "_" . uniqid() . "." . $ext;
            $finalPath = $targetDir . $newFilename;

            if (!move_uploaded_file($_FILES['acknowledgement_receipt']['tmp_name'], $finalPath)) {
                throw new Exception("Failed to upload file.");
            }
            $uploaded_file = $newFilename;
        }

        $stmt = $conn->prepare("INSERT INTO budget 
            (project_id, recipient, release_date, payment_method, reference_number, 
             acknowledgement_receipt, purpose, approval_notes, created_by, has_release) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");

        $stmt->bind_param("isssssssi", 
            $project_id, $recipient, $release_date, $payment_method, 
            $reference_number, $uploaded_file, $purpose, $approval_notes, $_SESSION['user_id']
        );

        if (!$stmt->execute()) {
            throw new Exception("Database insert failed.");
        }

        // Update resolution
        $update = $conn->query("UPDATE resolution SET is_budget_released = 1 WHERE id = $project_id");
        if (!$update) {
            throw new Exception("Failed to update resolution status.");
        }

        $response = ['success' => true, 'message' => 'Budget released successfully!'];

    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response);
    exit;
}

if (!isset($_GET['id'])) {
    die("Invalid request — Missing ID.");
}

$project_id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM resolution WHERE id = ?");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Resolution not found.");
}

$project = $result->fetch_assoc();
$pageTitle = 'Release Budget';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">
        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">Release Budget</h3>
            <p class="text-gray-600">Release approved budget for the project</p>
        </div>

        <form id="releaseBudgetForm" class="space-y-4" enctype="multipart/form-data">
            <input type="hidden" name="project_id" value="<?= $project['id'] ?>">

            <!-- PROJECT DETAILS (readonly) -->
            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Project Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Project Resolution Title</label>
                        <input type="text" value="<?= htmlspecialchars($project['project_resolution_title']) ?>" readonly class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Amount Requested</label>
                        <input type="text" value="₱<?= number_format($project['estimated_budget'], 2) ?>" readonly class="mt-1 block w-full rounded-lg border border-gray-300 bg-teal-50 px-3 py-2 font-bold text-teal-700">
                    </div>
                </div>
            </div>

            <!-- RELEASE DETAILS -->
            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Budget Release Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Recipient <span class="text-red-500">*</span></label>
                        <input type="text" name="recipient" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Release Date <span class="text-red-500">*</span></label>
                        <input type="date" name="release_date" required value="<?= date('Y-m-d') ?>" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Payment Method <span class="text-red-500">*</span></label>
                        <select name="payment_method" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                            <option value="">-- Select --</option>
                            <option value="Cash">Cash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Check">Check</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Reference Number</label>
                        <input type="text" name="reference_number" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Purpose <span class="text-red-500">*</span></label>
                        <input type="text" name="purpose" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Approval Notes</label>
                        <input type="text" name="approval_notes" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-start">
                        <label class="block text-sm font-medium text-gray-700">
                            Acknowledgement Receipt
                            <span class="text-xs block text-gray-500 mt-1">JPG, PNG, PDF • Max 10MB</span>
                        </label>
                        <input type="file" name="acknowledgement_receipt" accept=".jpg,.jpeg,.png,.pdf" class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 px-3 rounded-lg">
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="list.php" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" id="releaseBtn" class="px-8 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">
                    Submit Budget Release
                </button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '
<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("releaseBudgetForm");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const btn = document.getElementById("releaseBtn");
        const original = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = "Processing...";

        const formData = new FormData(form);

        try {
            const response = await fetch("", { method: "POST", body: formData });
            const result = await response.json();

            if (result.success) {
                alert(result.message || "Success!");
                window.location.href = "list.php";
            } else {
                alert("Error: " + result.message);
            }
        } catch (err) {
            console.error(err);
            alert("Network error. Check console.");
        } finally {
            btn.disabled = false;
            btn.innerHTML = original;
        }
    });
});
</script>
';

require_once BASE_PATH . '/pages/layout.php';
?>
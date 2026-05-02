<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/core/init.php';

if (!isset($_GET['id'])) {
    die("Invalid request — Missing ID.");
}

$rental_id = intval($_GET['id']);
$role = $_SESSION['role'] ?? 0;
$sql = "SELECT stall_no, remarks, status FROM stalls WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $rental_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Rental record not found.");
}

$rental = $result->fetch_assoc();

$pageTitle = 'Edit Stall Rental';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">

        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">Edit Stall Rental</h3>
            <p class="text-gray-600">Modify stall rental information</p>
        </div>

        <form id="updateStallRentalForm" method="POST" class="space-y-4">

            <input type="hidden" name="rental_id" value="<?= $rental_id ?>">

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Editable Fields</h2>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Stall Number <span class="text-red-500">*</span></label>
                        <input 
                            type="text" 
                            name="stall_no" 
                            value="<?= htmlspecialchars($rental['stall_no']) ?>" 
                            required 
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Remarks</label>
                        <textarea 
                            name="remarks" 
                            rows="3"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2"><?= htmlspecialchars($rental['remarks'] ?? '') ?></textarea>
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                        <select 
                            name="status"
                            required
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                            
                            <option value="1"   <?= $rental['status'] === '1' ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= $rental['status'] === '0' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="list.php" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</a>
                <?php if($role == 2) :?>
                <button 
                    type="submit"
                    class="px-8 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">
                    Save Changes
                </button>
                <?php endif; ?>
            </div>

        </form>
    </div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '
<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("updateStallRentalForm");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        try {
            const response = await fetch("/hoa_system/app/api/amenities/stall/put.stall.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                alert("Stall rental updated successfully!");
                window.location.href = "list.php";
            } else {
                alert("Update failed: " + result.message);
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Something went wrong. Please try again.");
        }
    });
});
</script>
';

require_once BASE_PATH . '/pages/layout.php';
?>

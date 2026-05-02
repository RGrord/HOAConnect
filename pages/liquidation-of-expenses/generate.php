<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
include_once($root . 'app/core/init.php');

if (!isset($_GET['id'])) {
    die("Invalid request — Missing project ID.");
}

$project_id = intval($_GET['id']);
$role = $_SESSION['role'] ?? 0;
$stmt = $conn->prepare("SELECT id, project_resolution_title, estimated_budget FROM resolution WHERE id = ? AND is_budget_released = 1");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Project not found or budget not yet released.");
}

$project = $result->fetch_assoc();
$pageTitle = 'Generate Liquidation';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">
        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">Generate Liquidation of Expenses</h3>
            <p class="text-gray-600">Submit actual expenses for the approved project</p>
        </div>

        <form id="liquidationForm" class="space-y-6" enctype="multipart/form-data">
            <input type="hidden" name="project_id" value="<?= $project['id'] ?>">

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Project Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Project Resolution</label>
                        <div class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 text-gray-900 font-medium">
                            <?= htmlspecialchars($project['project_resolution_title']) ?>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Approved Budget</label>
                        <div class="mt-1 block w-full rounded-lg border border-gray-300 bg-teal-50 px-4 py-2.5 text-2xl font-bold text-teal-700">
                            ₱<?= number_format($project['estimated_budget'], 2) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Expense Details</h2>
                    <button type="button" id="addExpenseRow" class="px-5 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition text-sm font-medium flex items-center gap-2">
                        <i class="ri-add-line"></i> Add Row
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left" id="expensesTable">
                        <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-6 py-3">Particular</th>
                                <th class="px-6 py-3 w-32">Amount</th>
                                <th class="px-6 py-3">Quantity</th>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3 w-24">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="expense-row">
                                <td class="px-6 py-4">
                                    <input type="text" name="expense_particular[]" required placeholder="e.g. Materials, Labor" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-teal-500 focus:border-teal-500">
                                </td>
                                <td class="px-6 py-4">
                                    <input type="number" step="0.01" min="0" name="expense_amount[]" required class="expense_amount w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-teal-500 focus:border-teal-500" placeholder="0.00">
                                </td>
                                <td class="px-6 py-4">
                                    <input type="number" id="quantity" min="1" value="1" class="mt-1 border border-gray-300 py-2.5 px-4 rounded-lg w-full" required>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="date" id="payment-date" value="<?= date('Y-m-d') ?>" class="mt-1 border border-gray-300 py-2.5 px-4 rounded-lg w-full" required>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button type="button" class="removeRow text-red-600 hover:text-red-800 transition">
                                        <i class="ri-delete-bin-line text-xl"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SUMMARY -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm bg-yellow-50">
                    <label class="block text-sm font-medium text-gray-700">Total Expenses</label>
                    <div class="mt-2 text-3xl font-bold text-yellow-800">₱<span id="totalExpenses">0.00</span></div>
                </div>
                <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm bg-blue-50">
                    <label class="block text-sm font-medium text-gray-700">Remaining Budget</label>
                    <div class="mt-2 text-3xl font-bold text-blue-800">₱<span id="remainingBudget"><?= number_format($project['estimated_budget'], 2) ?></span></div>
                </div>
                <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm" id="auditBox">
                    <label class="block text-sm font-medium text-gray-700">Audit Result</label>
                    <div class="mt-2 text-2xl font-bold" id="auditResult">Balanced</div>
                </div>
            </div>

            <!-- REMARKS -->
            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <label class="block text-sm font-medium text-gray-700">Remarks / Notes (Optional)</label>
                <textarea name="remarks" rows="4" placeholder="Any additional explanation..." class="mt-2 block w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-teal-500 focus:border-teal-500"></textarea>
            </div>

            <!-- SUBMIT -->
            <div class="flex justify-end gap-4 pt-4">
                <a href="list.php" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                    Cancel
                </a>
                <?php if($role == 5): ?>
                <button type="submit" id="submitBtn" class="px-8 py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium flex items-center gap-2">
                    <i class="ri-send-plane-fill"></i>
                    Submit Liquidation
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
document.addEventListener("DOMContentLoaded", function() {
    const releasedBudget = parseFloat(' . $project['estimated_budget'] . ');
    const $table = $("#expensesTable tbody");

    function calculate() {
        let total = 0;
        $(".expense_amount").each(function() {
            total += parseFloat($(this).val()) || 0;
        });

        $("#totalExpenses").text(total.toFixed(2));
        const remaining = releasedBudget - total;
        $("#remainingBudget").text(remaining.toFixed(2));

        const $box = $("#auditBox");
        const $result = $("#auditResult");

        if (total > releasedBudget) {
            $box.removeClass("bg-green-50 bg-blue-50").addClass("bg-red-50");
            $result.text("Overspent").removeClass("text-green-800 text-blue-800").addClass("text-red-800");
        } else if (total < releasedBudget) {
            $box.removeClass("bg-red-50 bg-green-50").addClass("bg-blue-50");
            $result.text("Underspent").removeClass("text-red-800 text-green-800").addClass("text-blue-800");
        } else {
            $box.removeClass("bg-red-50 bg-blue-50").addClass("bg-green-50");
            $result.text("Balanced").removeClass("text-red-800 text-blue-800").addClass("text-green-800");
        }
    }

    $("#addExpenseRow").on("click", function() {
        const row = `
            <tr class="expense-row">
    <td class="px-6 py-4">
        <input type="text" name="expense_particular[]" required placeholder="e.g. Cement, Labor" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-teal-500 focus:border-teal-500">
    </td>
    <td class="px-6 py-4">
        <input type="number" step="0.01" min="0" name="expense_amount[]" required class="expense_amount w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-teal-500 focus:border-teal-500" placeholder="0.00">
    </td>
    <td class="px-6 py-4">
        <input type="number" min="1" name="quantity[]" value="1" required class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-teal-500 focus:border-teal-500" placeholder="Quantity">
    </td>
    <td class="px-6 py-4">
        <input type="date" name="date[]" value="'. date('Y-m-d') .'" required class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-teal-500 focus:border-teal-500">
    </td>
    <td class="px-6 py-4 text-center">
            <button type="button" class="removeRow text-red-600 hover:text-red-800"><i class="ri-delete-bin-line text-xl"></i></button>
        </td>
    </tr>
    `;
        $table.append(row);
    });

    $(document).on("click", ".removeRow", function() {
        $(this).closest("tr").remove();
        calculate();
    });

    $(document).on("input", ".expense_amount", calculate);

    $("#liquidationForm").on("submit", async function(e) {
        e.preventDefault();
        const btn = $("#submitBtn");
        const orig = btn.html();
        btn.prop("disabled", true).html("Submitting...");

        const formData = new FormData(this);

        try {
            const res = await fetch("/hoa_system/app/api/liquidation/submit.php", {
                method: "POST",
                body: formData
            });
            const data = await res.json();

            if (data.success) {
                alert("Liquidation submitted successfully!");
                window.location.href = "list.php";
            } else {
                alert("Error: " + data.message);
            }
        } catch (err) {
            alert("Network error. Please try again.");
        } finally {
            btn.prop("disabled", false).html(orig);
        }
    });

    calculate();
});
</script>
';

require_once BASE_PATH . '/pages/layout.php';
?>
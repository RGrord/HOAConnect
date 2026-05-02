<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';

$pageTitle = 'Create Board Resolution';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">
        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">Create Board Resolution</h3>
            <p class="text-gray-600">Submit a new resolution for the HOA board</p>
        </div>

        <form id="createResolutionForm" class="space-y-4" enctype="multipart/form-data">
            <!-- PROJECT DETAILS -->
            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Project Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Project Resolution Title <span class="text-red-500">*</span></label>
                        <input type="text" name="project_resolution_title" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-start">
                        <label class="block text-sm font-medium text-gray-700">Resolution Summary <span class="text-red-500">*</span></label>
                        <textarea name="resolution_summary" rows="5" placeholder="Provide a detailed summary..." required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2"></textarea>
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Estimated Budget</label>
                        <input type="number" name="estimated_budget" placeholder="Enter estimated budget amount" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Target Start Date</label>
                        <input type="date" name="target_start_date" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Target End Date</label>
                        <input type="date" name="target_end_date" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Proposed By</label>
                        <input type="text" name="proposed_by" value="HOA Board of Directors" readonly class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                </div>
            </div>

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Attachments</h2>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Project Proposal Document</label>
                        <input type="file" name="project_proposal_document" accept=".pdf,.doc,.docx" class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 px-3 rounded-lg">
                        <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX up to 10MB</p>
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Upload Signed Resolution</label>
                        <input type="file" name="upload_signed_resolution" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 px-3 rounded-lg">
                        <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX, PNG, JPG up to 10MB</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="list.php" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" id="createBtn" class="px-8 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">
                    Create Board Resolution
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
    const form = document.getElementById("createResolutionForm");

    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch("create-resolutions.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                alert(result.message);
                window.location.href = "list.php";
            } else {
                alert("Error: " + result.message);
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

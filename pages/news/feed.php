<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';
$role = $_SESSION['role'] ?? 0;
$user_id = $_SESSION['user_id'];
$pageTitle = 'News Feed';
ob_start();

$role = $_SESSION['role'];
?>

<div class="mt-4">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-semibold">News Feed</h2>
  </div>

  <div class="flex gap-4 mb-4">
    <input type="text" id="simple-search" placeholder="Search posts..." 
    class="flex-1 border rounded-lg p-2 focus:ring-1 focus:ring-teal-600">
    <input type="hidden" id="loggedInUserId" value="<?= $user_id ?>">
    <?php if($role == 2 || $role == 3): ?>
     <button id="openCreateModal" 
            class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700">
      + Create Post
    </button>
    <?php endif; ?>
  </div>
  <div id="newsfeed-container">
    <div id="newsfeed-list"></div>

    <nav class="flex items-center justify-between p-4 text-sm"> 
      <span class="text-gray-500"> Showing <span id="rangeStart">1</span>-<span id="rangeEnd">10</span> of <span id="totalRecords">0</span> 
      </span> 
      <ul id="paginationList" class="inline-flex -space-x-px h-8"></ul> 
    </nav>
  </div>

</div>
<div id="createNewsfeedModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white w-full max-w-lg rounded-lg p-6 relative">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-semibold">Create Newsfeed Post</h3>
      <button id="closeCreateModal" class="text-gray-500 hover:text-gray-700">
        <i class="ri-close-large-line"></i>
      </button>
    </div>
    <form id="create-newsfeed-form" enctype="multipart/form-data">
      <input type="hidden" name="created_by" value="<?= $_SESSION['user_id'] ?>">

      <label class="block mb-1">Title</label>
      <input type="text" name="post_title" required class="border rounded p-2 w-full mb-3">

      <label class="block mb-1">Description</label>
      <textarea name="description" required class="border rounded p-2 w-full mb-3"></textarea>

      <label class="block mb-1">Post Image</label>
      <input type="file" name="post_images" class="mb-3 w-full bg-gray-100 p-2 rounded" required>

      <label class="block mb-1">Project File</label>
      <input type="file" name="project_file" class="mb-3 w-full bg-gray-100 p-2 rounded" required>

      <div class="flex justify-end gap-2">
        <button type="button" id="cancelCreatePost" class="px-4 py-2 border rounded">Cancel</button>
        <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">
          Create
        </button>
      </div>
    </form>
  </div>
</div>

<div id="editNewsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
    <h3 class="text-xl font-bold mb-4">Edit Post</h3>
    <form id="edit-news-form" enctype="multipart/form-data">
      <input type="hidden" id="edit_post_id" name="id">

      <div class="mb-4">
        <label for="edit_post_title" class="block font-medium mb-1">Post Title</label>
        <input type="text" id="edit_post_title" name="post_title" class="w-full border rounded p-2">
      </div>

      <div class="mb-4">
        <label for="edit_description" class="block font-medium mb-1">Description</label>
        <textarea id="edit_description" name="description" class="w-full border rounded p-2" rows="4"></textarea>
      </div>

      <div class="mb-4">
        <label for="edit_post_images" class="block font-medium mb-1">Post Image</label>
        <input type="file" id="edit_post_images" name="post_images" accept="image/*">
      </div>

      <div class="mb-4">
        <label for="edit_project_file" class="block font-medium mb-1">Project File</label>
        <input type="file" id="edit_project_file" name="project_file">
      </div>

      <div class="flex justify-end gap-2">
        <button type="button" id="closeEditModal" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
      </div>
    </form>
  </div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '
    <script type="module" src="/hoa_system/ui/modules/news-feed/get.news-feed.js"></script>
';

require_once BASE_PATH . '/pages/layout.php';
?>
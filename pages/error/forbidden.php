<?php
http_response_code(403);
?>
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>403 - Access Forbidden | HOAConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="h-full bg-gradient-to-br from-red-50 to-orange-50 flex items-center justify-center p-4">
  <div class="max-w-md w-full text-center">
    <i class="ri-shield-cross-line text-9xl text-red-500 animate-pulse"></i>
    <h1 class="text-6xl font-bold text-gray-900 mt-6">403</h1>
    <p class="text-xl font-semibold text-gray-700 mt-2">Access Forbidden</p>
    <p class="text-gray-600 mt-4">
      You don't have permission to access this page.
    </p>
    <div class="mt-8">
      <a href="<?= defined('BASE_PATH') ? BASE_PATH : '/' ?>public/dashboard/index.php" 
         class="inline-flex items-center px-6 py-3 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition">
        <i class="ri-home-line mr-2"></i> Back to Dashboard
      </a>
    </div>
    <p class="mt-6 text-sm text-gray-500">
      Error 403 — Contact admin if this seems wrong.
    </p>
  </div>
</body>
</html>
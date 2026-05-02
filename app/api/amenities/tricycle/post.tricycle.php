<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$required = [
    'toda_name',
    'no_of_tricycles',
    'start_date',
    'representative',
    'contact_no',
    'fee_amount',
    'status'
];

foreach ($required as $field) {
    if (empty(trim($_POST[$field] ?? ''))) {
        echo json_encode([
            'success' => false,
            'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required'
        ]);
        exit;
    }
}

$toda_name       = trim($_POST['toda_name']);
$no_of_tricycles = (int)$_POST['no_of_tricycles'];
$date_start      = $_POST['start_date'];
$date_end        = !empty(trim($_POST['end_date'] ?? '')) ? trim($_POST['end_date']) : null;
$representative  = trim($_POST['representative']);
$contact_no      = trim($_POST['contact_no']);
$fee_amount      = (float)$_POST['fee_amount'];
$status          = trim($_POST['status']);

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_start)) {
    echo json_encode(['success' => false, 'message' => 'Invalid start date format']);
    exit;
}
if ($date_end && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_end)) {
    echo json_encode(['success' => false, 'message' => 'Invalid end date format']);
    exit;
}

if ($fee_amount < 0) {
    echo json_encode(['success' => false, 'message' => 'Fee amount must be positive']);
    exit;
}

$contractFilePath = null;

if (isset($_FILES['contract']) && $_FILES['contract']['error'] !== UPLOAD_ERR_NO_FILE) {
    $file = $_FILES['contract'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => 'File upload error: ' . $file['error']]);
        exit;
    }

    if ($file['size'] > 10 * 1024 * 1024) {
        echo json_encode(['success' => false, 'message' => 'File too large. Max 10MB allowed.']);
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if ($mime !== 'application/pdf') {
        echo json_encode(['success' => false, 'message' => 'Only PDF files are allowed.']);
        exit;
    }

    $header = file_get_contents($file['tmp_name'], false, null, 0, 8);
    if (strpos($header, '%PDF') !== 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid PDF file (missing %PDF header).']);
        exit;
    }

    $name = pathinfo($file['name'], PATHINFO_FILENAME);
    $name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
    $fileName = time() . '_' . $name . '.pdf';

    $uploadDir   = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/uploads/contracts/';
    $targetPath  = $uploadDir . $fileName;
    $relativePath = 'uploads/contracts/' . $fileName;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        chmod($targetPath, 0644);
        $contractFilePath = $relativePath;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save uploaded file.']);
        exit;
    }
}

try {
    $sql = "
        INSERT INTO toda 
        (toda_name, no_of_tricycles, fee_amount, `status`, `contract`, start_date, end_date, representative, contact_no, date_created)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sidssssss",
        $toda_name,
        $no_of_tricycles,
        $fee_amount,
        $status,
        $contractFilePath, 
        $date_start,
        $date_end,
        $representative,
        $contact_no
    );

    if ($stmt->execute()) {
        $new_id = $stmt->insert_id;
        $stmt->close();

        echo json_encode([
            'success' => true,
            'message' => 'TODA successfully registered!',
            'data' => ['id' => $new_id]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save record.']);
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'DB Error: ' . $e->getMessage()
    ]);
}
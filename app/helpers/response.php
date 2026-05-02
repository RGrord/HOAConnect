<?php
if (!function_exists('json_success')) {
    function json_success($data = [], $msg = 'Success') {
        http_response_code(200);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => true, 'message' => $msg] + $data);
        exit;
    }
}

if (!function_exists('json_error')) {
    function json_error($msg, $code = 400) {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => false, 'error' => $msg]);
        exit;
    }
}
?>
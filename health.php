<?php
// Health check endpoint for monitoring
header('Content-Type: application/json');

$start = microtime(true);

// Check if PHP is working
$status = 'healthy';
$php_version = phpversion();
$memory = memory_get_usage(true);

$response = [
    'status' => $status,
    'php_version' => $php_version,
    'memory_usage' => $memory,
    'time' => round((microtime(true) - $start) * 1000, 2),
    'timestamp' => date('Y-m-d H:i:s')
];

echo json_encode($response);
?>
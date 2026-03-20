<?php
// Simple test to verify app works
$url = 'http://localhost/php-cicd-demo/health.php';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    echo "✅ Health check passed\n";
    exit(0);
} else {
    echo "❌ Health check failed with code: $httpCode\n";
    exit(1);
}
?>
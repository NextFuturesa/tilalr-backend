<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$pub = env('MOYASAR_PUBLISHABLE_KEY');
$sec = env('MOYASAR_SECRET_KEY');
$testMode = filter_var(env('MOYASAR_TEST_MODE', false), FILTER_VALIDATE_BOOLEAN);

function mask($s) {
    if (!$s) return '(not set)';
    return substr($s, 0, 8) . '...';
}

echo "Moyasar diagnostic\n";
echo "===================\n";
echo "Publishable key: " . mask($pub) . "\n";
echo "Secret key: " . mask($sec) . "\n";
echo "Test mode: " . ($testMode ? 'true' : 'false') . "\n\n";

if (!$pub) {
    echo "ERROR: Publishable key not set (MOYASAR_PUBLISHABLE_KEY)\n";
}
if (!$sec) {
    echo "ERROR: Secret key not set (MOYASAR_SECRET_KEY)\n";
}

// Check prefix consistency
if ($pub && preg_match('/^pk_test_/', $pub) && !$testMode) {
    echo "WARNING: Publishable key looks like a test key but MOYASAR_TEST_MODE is false.\n";
}
if ($pub && preg_match('/^pk_live_/', $pub) && $testMode) {
    echo "WARNING: Publishable key looks live but MOYASAR_TEST_MODE is true.\n";
}

// Try to call Moyasar API to validate secret
if ($sec) {
    echo "Checking Moyasar API authentication...\n";
    try {
        $client = new GuzzleHttp\Client(['timeout' => 8]);
        $res = $client->get('https://api.moyasar.com/v1/payments?limit=1', [
            'auth' => [$sec, ''],
            'headers' => ['Accept' => 'application/json'],
            // Disable SSL verification in local environment to avoid cURL certificate issues on development machines
            'verify' => app()->environment('local') ? false : true,
        ]);
        $status = $res->getStatusCode();
        echo "HTTP status: $status\n";
        $body = (string)$res->getBody();
        $json = json_decode($body, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            echo "Response: " . json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
        } else {
            echo "Response body (non-json): $body\n";
        }
    } catch (GuzzleHttp\Exception\ClientException $e) {
        $resp = $e->getResponse();
        $code = $resp ? $resp->getStatusCode() : 'N/A';
        $body = $resp ? (string)$resp->getBody() : $e->getMessage();
        echo "ClientException: HTTP $code - $body\n";
    } catch (Exception $e) {
        echo "Request failed: " . $e->getMessage() . "\n";
    }
}

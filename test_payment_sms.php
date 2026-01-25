<?php

/**
 * Test Script for Payment (Moyasar) and SMS (Taqnyat) Configuration
 * Run with: php test_payment_sms.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

echo "===========================================\n";
echo "  TILALR PAYMENT & SMS CONFIGURATION TEST  \n";
echo "===========================================\n\n";

// =====================================
// TEST 1: Environment Variables Check
// =====================================
echo "1. CHECKING ENVIRONMENT VARIABLES\n";
echo "-----------------------------------\n";

$moyasarPublic = config('services.moyasar.publishable_key');
$moyasarSecret = config('services.moyasar.secret_key');
$moyasarTestMode = config('services.moyasar.test_mode');
$smsProvider = config('services.sms.provider');
$taqnyatToken = config('services.taqnyat.bearer_token');
$taqnyatSender = config('services.taqnyat.sender');

echo "Moyasar Public Key: " . (str_starts_with($moyasarPublic, 'pk_live') ? '✓ LIVE KEY' : '⚠ TEST KEY') . "\n";
echo "  -> " . substr($moyasarPublic, 0, 20) . "...\n";

echo "Moyasar Secret Key: " . (str_starts_with($moyasarSecret, 'sk_live') ? '✓ LIVE KEY' : '⚠ TEST KEY') . "\n";
echo "  -> " . substr($moyasarSecret, 0, 20) . "...\n";

echo "Moyasar Test Mode: " . ($moyasarTestMode ? 'TRUE (Testing)' : 'FALSE (Live)') . "\n";
echo "SMS Provider: {$smsProvider}\n";
echo "Taqnyat Token: " . ($taqnyatToken ? '✓ SET (' . strlen($taqnyatToken) . ' chars)' : '✗ NOT SET') . "\n";
echo "Taqnyat Sender: " . ($taqnyatSender ?: 'NOT SET') . "\n\n";

// =====================================
// TEST 2: Moyasar API Connection Test
// =====================================
echo "2. TESTING MOYASAR API CONNECTION\n";
echo "-----------------------------------\n";

try {
    $response = Http::withBasicAuth($moyasarSecret, '')
        ->withOptions(['verify' => false])
        ->get('https://api.moyasar.com/v1/payments', [
            'limit' => 1
        ]);

    if ($response->successful()) {
        echo "✓ Moyasar API Connection: SUCCESS\n";
        $data = $response->json();
        echo "  Account Status: Active\n";
        echo "  API Response: 200 OK\n";
    } else {
        echo "✗ Moyasar API Connection: FAILED\n";
        echo "  Status Code: " . $response->status() . "\n";
        echo "  Error: " . $response->body() . "\n";
    }
} catch (Exception $e) {
    echo "✗ Moyasar API Connection: ERROR\n";
    echo "  Error: " . $e->getMessage() . "\n";
}

echo "\n";

// =====================================
// TEST 3: Taqnyat SMS API Connection Test
// =====================================
echo "3. TESTING TAQNYAT SMS API CONNECTION\n";
echo "---------------------------------------\n";

try {
    // Test API by checking balance/account status
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $taqnyatToken,
        'Accept' => 'application/json',
    ])
    ->withOptions(['verify' => false])
    ->get('https://api.taqnyat.sa/account/balance');

    if ($response->successful()) {
        echo "✓ Taqnyat API Connection: SUCCESS\n";
        $data = $response->json();
        if (isset($data['balance'])) {
            echo "  Account Balance: " . $data['balance'] . " SAR\n";
        }
        if (isset($data['walletBalance'])) {
            echo "  Wallet Balance: " . $data['walletBalance'] . " SAR\n";
        }
        echo "  API Response: 200 OK\n";
    } else {
        echo "✗ Taqnyat API Connection: FAILED\n";
        echo "  Status Code: " . $response->status() . "\n";
        echo "  Response: " . $response->body() . "\n";
    }
} catch (Exception $e) {
    echo "✗ Taqnyat API Connection: ERROR\n";
    echo "  Error: " . $e->getMessage() . "\n";
}

echo "\n";

// =====================================
// TEST 4: Check Sender Names
// =====================================
echo "4. CHECKING TAQNYAT SENDER NAMES\n";
echo "----------------------------------\n";

try {
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $taqnyatToken,
        'Accept' => 'application/json',
    ])
    ->withOptions(['verify' => false])
    ->get('https://api.taqnyat.sa/account/senders');

    if ($response->successful()) {
        $data = $response->json();
        if (isset($data['data']) && is_array($data['data'])) {
            echo "✓ Available Sender Names:\n";
            foreach ($data['data'] as $sender) {
                $name = is_array($sender) ? ($sender['name'] ?? $sender['sender'] ?? json_encode($sender)) : $sender;
                echo "  - {$name}\n";
            }
        } else {
            echo "  Response: " . json_encode($data, JSON_PRETTY_PRINT) . "\n";
        }
    } else {
        echo "  Could not fetch sender names: " . $response->status() . "\n";
    }
} catch (Exception $e) {
    echo "  Error fetching senders: " . $e->getMessage() . "\n";
}

echo "\n";

// =====================================
// Summary
// =====================================
echo "===========================================\n";
echo "                 SUMMARY                   \n";
echo "===========================================\n";

$allGood = true;

// Check Moyasar
if (str_starts_with($moyasarPublic, 'pk_live') && str_starts_with($moyasarSecret, 'sk_live') && !$moyasarTestMode) {
    echo "✓ Moyasar: Configured for LIVE payments\n";
} else {
    echo "⚠ Moyasar: Configured for TEST mode\n";
    $allGood = false;
}

// Check SMS
if ($smsProvider === 'taqnyat' && $taqnyatToken && $taqnyatSender) {
    echo "✓ SMS (Taqnyat): Configured correctly\n";
} elseif ($smsProvider === 'log') {
    echo "⚠ SMS: Using LOG mode (no real SMS sent)\n";
} else {
    echo "✗ SMS: Configuration incomplete\n";
    $allGood = false;
}

echo "\n";
if ($allGood) {
    echo "✓ ALL SYSTEMS READY FOR VPS DEPLOYMENT!\n";
} else {
    echo "⚠ Some configurations need attention before VPS deployment.\n";
}

echo "\n===========================================\n";
echo "Expected Live Credentials:\n";
echo "-------------------------------------------\n";
echo "Moyasar Public: pk_live_JjGYt4f9iWDGpc9uCE9FCMBvZ9u5FBa5SsQvEFAY\n";
echo "Moyasar Secret: sk_live_CqsRUfH7SJ5H2dnJvdk654F4LvZb9FZs7ipNwyZJ\n";
echo "SMS Token:      5ac4d585e4292ba584d4d5f8dbfbaeb7\n";
echo "SMS Sender:     Tilalr\n";
echo "===========================================\n";

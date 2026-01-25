<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$service = app(\App\Services\TaqnyatSmsService::class);

echo "=== TAQNYAT SMS TEST ===" . PHP_EOL;
echo "Token: " . (config('services.taqnyat.bearer_token') ? 'SET (' . substr(config('services.taqnyat.bearer_token'), 0, 8) . '...)' : 'NOT SET') . PHP_EOL;
echo "Sender: " . (config('services.taqnyat.sender') ?: 'NOT SET') . PHP_EOL;
echo PHP_EOL;

echo "1. System Status:" . PHP_EOL;
$status = $service->getSystemStatus();
print_r($status);

echo PHP_EOL . "2. Account Balance:" . PHP_EOL;
$balance = $service->getBalance();
print_r($balance);

echo PHP_EOL . "3. Available Senders:" . PHP_EOL;
$senders = $service->getSenders();
print_r($senders);

echo PHP_EOL . "=== END TEST ===" . PHP_EOL;

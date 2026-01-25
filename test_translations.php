<?php
/**
 * Test script to verify translations are working correctly
 */

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\App;

echo "=== Translation Test ===\n\n";

// Test English
App::setLocale('en');
echo "English Translations:\n";
echo "  Panel Name: " . __('admin.panel_name') . "\n";
echo "  Dashboard: " . __('admin.dashboard') . "\n";
echo "  Nav Bookings: " . __('admin.nav.reservations_bookings') . "\n";
echo "  Status Pending: " . __('admin.status.pending') . "\n";
echo "  Action Edit: " . __('admin.actions.edit') . "\n";

echo "\n";

// Test Arabic
App::setLocale('ar');
echo "Arabic Translations:\n";
echo "  Panel Name: " . __('admin.panel_name') . "\n";
echo "  Dashboard: " . __('admin.dashboard') . "\n";
echo "  Nav Bookings: " . __('admin.nav.reservations_bookings') . "\n";
echo "  Status Pending: " . __('admin.status.pending') . "\n";
echo "  Action Edit: " . __('admin.actions.edit') . "\n";

echo "\n=== Translation Test Complete ===\n";

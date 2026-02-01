<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$email = 'superadmin@tilalr.com';
$password = 'superadmin123';

$user = User::where('email', $email)->first();

echo "=== Superadmin Login Check ===\n\n";

if (!$user) {
    echo "❌ User NOT FOUND with email: {$email}\n";
    echo "\nAll users in database:\n";
    foreach (User::all() as $u) {
        echo "  - ID: {$u->id}, Email: {$u->email}, is_admin: " . ($u->is_admin ? 'YES' : 'NO') . "\n";
    }
    exit(1);
}

echo "✅ User FOUND:\n";
echo "  - ID: {$user->id}\n";
echo "  - Name: {$user->name}\n";
echo "  - Email: {$user->email}\n";
echo "  - is_admin: " . ($user->is_admin ? 'YES' : 'NO') . "\n";
echo "  - Password hash: " . substr($user->password, 0, 30) . "...\n\n";

$passwordValid = Hash::check($password, $user->password);
echo "Password check ('{$password}'): " . ($passwordValid ? '✅ VALID' : '❌ INVALID') . "\n\n";

// Check if email_verified_at might be required
echo "email_verified_at: " . ($user->email_verified_at ?? 'NULL') . "\n";

// Check Filament panel provider for canAccessPanel
if (method_exists($user, 'canAccessPanel')) {
    echo "canAccessPanel(): checking...\n";
} else {
    echo "canAccessPanel() method: NOT DEFINED on User model\n";
}

<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Permission;
use App\Models\Role;

echo "=== Permissions Analysis ===\n\n";

$totalPermissions = Permission::count();
echo "Total permissions in DB: {$totalPermissions}\n\n";

echo "Permissions by module:\n";
$modules = Permission::select('module')->distinct()->pluck('module');
foreach ($modules as $module) {
    $count = Permission::where('module', $module)->count();
    echo "  - " . ($module ?? 'NULL') . ": {$count}\n";
}

echo "\n=== Role Permission Assignments ===\n\n";
foreach (Role::all() as $role) {
    $permCount = $role->permissions()->count();
    echo "Role: {$role->name} ({$role->display_name}) - {$permCount} permissions\n";
}

echo "\n=== All Permissions List ===\n\n";
foreach (Permission::orderBy('module')->orderBy('name')->get() as $p) {
    echo "  [{$p->module}] {$p->name}\n";
}

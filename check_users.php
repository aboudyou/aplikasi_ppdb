<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

$user = User::where('role', 'admin')->first();
if ($user) {
    echo "Admin user found: " . $user->name . " (" . $user->email . ")\n";
} else {
    echo "No admin user found\n";
}

$users = User::all();
echo "Total users: " . $users->count() . "\n";
foreach ($users as $u) {
    echo "- " . $u->name . " (" . $u->email . ") - Role: " . $u->role . "\n";
}
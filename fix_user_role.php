<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

DB::table('users')->where('email', 'usersatu@gmail.com')->update(['role' => 'user']);
echo "User role updated!\n";

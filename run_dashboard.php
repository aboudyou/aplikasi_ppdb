<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$ctrl = new App\Http\Controllers\Admin\DashboardController();
$view = $ctrl->index();

echo 'Executed DashboardController@index' . PHP_EOL;
if (is_array($view->getData())) {
    print_r($view->getData());
}
?>
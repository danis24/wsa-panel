<?php

define('LARAVEL_START', microtime(true));

require __DIR__.'/../laravel/vendor/autoload.php';

$app = require_once __DIR__.'/../laravel/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);


echo 'Migrating...<br>';

$kernel->call('migrate');
echo $kernel->output();

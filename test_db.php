<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    DB::connection()->getPdo();
    echo "✅ Database connected successfully!";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage();
}
?>

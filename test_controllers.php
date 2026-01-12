<?php
// Test if controllers can be instantiated without constructor errors

define('BASEPATH', realpath(__DIR__));
define('CI_ENVIRONMENT', 'development');

// Load CodeIgniter 
require_once 'vendor/autoload.php';

// Test if Admin controller can be loaded without errors
try {
    echo "Testing Admin controller...\n";
    $admin = new \App\Controllers\Admin();
    echo "✓ Admin controller loaded successfully\n";
} catch (Throwable $e) {
    echo "✗ Admin controller error: " . $e->getMessage() . "\n";
}

// Test if Auth controller can be loaded without errors
try {
    echo "Testing Auth controller...\n";
    $auth = new \App\Controllers\Auth();
    echo "✓ Auth controller loaded successfully\n";
} catch (Throwable $e) {
    echo "✗ Auth controller error: " . $e->getMessage() . "\n";
}

// Test if Api controller can be loaded without errors
try {
    echo "Testing Api controller...\n";
    $api = new \App\Controllers\Api();
    echo "✓ Api controller loaded successfully\n";
} catch (Throwable $e) {
    echo "✗ Api controller error: " . $e->getMessage() . "\n";
}

echo "\nAll controller tests completed!\n";
?>

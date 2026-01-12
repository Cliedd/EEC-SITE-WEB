<?php

/*
 * This router file is used by PHP's development server when you run `php spark serve`.
 * It serves static files from the public folder and routes other requests to index.php.
 */

$requested = $_SERVER['REQUEST_URI'];

// Check if the request is for a file that exists
if ($requested !== '/' && file_exists(__DIR__ . $requested)) {
    // File exists, let the server serve it
    return false;
}

// For everything else, route to index.php
require 'index.php';

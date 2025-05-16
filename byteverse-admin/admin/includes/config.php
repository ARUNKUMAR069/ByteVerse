<?php
// Configuration settings for the admin panel

// Database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'byteverse_admin');
define('DB_USER', 'root');
define('DB_PASS', '');

// Other configuration settings
define('SITE_NAME', 'ByteVerse Admin');
define('SITE_URL', 'http://localhost/byteverse-admin/admin/');
define('ADMIN_EMAIL', 'admin@byteverse.com');

// Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
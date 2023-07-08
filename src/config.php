<?php

/**
 * Configuration File
 *
 * This file contains the configuration settings for the application.
 * It defines constants for various paths, URLs, and database credentials.
 */

// Define the root directory path
define('ROOT_DIR', dirname(__DIR__));

// Define the base path of the application
define('BASE_PATH', "/auth-app");

// Define the name of the application
define('APP_NAME', 'Auth App');

// Define the base URL of the application
define('APP_URL', 'http://localhost/auth-app');

// Database configuration
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', 'auth');
define('DB_USER', 'root');
define('DB_PASS', '');

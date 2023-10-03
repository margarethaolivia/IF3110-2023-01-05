<?php

// URL
define('BASE_URL', 'http://localhost:8008');
define ('APP_PATH', dirname($_SERVER['DOCUMENT_ROOT']) . '/app');
define ('PUBLIC_PATH', $_SERVER['DOCUMENT_ROOT']);

// Database
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_PORT', $_ENV['DB_PORT']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['POSTGRES_USER']);
define('DB_PASSWORD', $_ENV['POSTGRES_PASSWORD']);

// File
define('IMAGE_MAX_SIZE', 10 * 1024 * 1024);
define('VIDEO_MAX_SIZE', 50 * 1024 * 1024);
define('ALLOWED_VIDEOS', ['.mp4']);

define('ALLOWED_IMAGES', ['.jpg', '.jpeg', '.png']);

// Bcrypt
define('BCRYPT_COST', 10);

// Session
// COOKIES_LIFETIME >= SESSION_EXPIRATION_TIME
define('COOKIES_LIFETIME', 24 * 60 * 60);
define('SESSION_EXPIRATION_TIME', 24 * 60 * 60);
define('SESSION_REFRESH_TIME', 60 * 60);

// Debounce
define('DEBOUNCE_TIMEOUT', 500);

// PHP CONFIGS
ob_start();
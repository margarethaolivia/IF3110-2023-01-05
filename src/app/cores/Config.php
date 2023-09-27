<?php

// URL
define('BASE_URL', 'http://localhost:8008');

// Database
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_PORT', $_ENV['DB_PORT']);
define('DB_NAME', $_ENV['DB_NAME']);
define('POSTGRES_USER', $_ENV['POSTGRES_USER']);
define('POSTGRES_PASSWORD', $_ENV['POSTGRES_PASSWORD']);

// File
define('MAX_SIZE', 10 * 1024 * 1024);
define('ALLOWED_VIDEOS', [
]);

define('ALLOWED_IMAGES', [
    'image/jpeg' => '.jpeg',
    'image/png' => '.png'
]);

// Bcrypt
define('BCRYPT_COST', 10);

// Session
define('COOKIES_LIFETIME', 24 * 60 * 60);
define('SESSION_EXPIRATION_TIME', 24 * 60 * 60);
define('SESSION_REGENERATION_TIME', 30 * 60);

// Debounce
define('DEBOUNCE_TIMEOUT', 500);
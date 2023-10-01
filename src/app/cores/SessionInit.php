<?php

if (session_status() === PHP_SESSION_ACTIVE) {
    $current_time = time();

    if ($current_time - $_SESSION['updated_at'] > SESSION_REFRESH_TIME) {
        // Prevent Session Fixation Attacks
        session_regenerate_id(true);
        $_SESSION['updated_at'] = $current_time;

        // Prevent CSRF Attacks
        unset($_SESSION['csrf_token']);
    }

    if ($current_time - $_SESSION['created_at'] > SESSION_EXPIRATION_TIME) {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/');
    }
}

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(COOKIES_LIFETIME);
    session_start();

    $current_time = time();
    $_SESSION['created_at'] = $current_time;
    $_SESSION['updated_at'] = $current_time;
}

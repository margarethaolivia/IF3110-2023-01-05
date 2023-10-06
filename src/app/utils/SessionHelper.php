<?php
class SessionHelper {
    public function startSession($user) {

        // if (session_status() !== PHP_SESSION_NONE) $this->terminateSession();
        
        session_start();
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['profile_pic'] = $user->profile_pic;
        $_SESSION['is_admin'] = $user->is_admin;
        $_SESSION['full_name'] = $user->first_name . ' ' . $user->last_name;

        // Set a cookie (adjust parameters as needed)
        setcookie('user', $user->username, time() + 3600, '/');
    }

    public function terminateSession() {
        session_unset();    
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/');
    }
}
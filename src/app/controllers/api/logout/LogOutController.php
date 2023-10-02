<?php
include_once __DIR__ . '/../APIController.php';

class LogOutController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function POST($params)
    {
        session_unset();    
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/');
        header("Location: " . BASE_URL, 302);
        exit();
    }
}
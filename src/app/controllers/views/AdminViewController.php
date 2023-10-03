<?php

require_once APP_PATH . '/controllers/views/AuthViewController.php';

abstract class AdminViewController extends AuthViewController
{  
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function authorize()
    {
        $user = $this->getSessionMiddleware()->authorizeUser(true);

        if (!$user->is_admin) {
            echo "no";
            exit;
        }
    }
}
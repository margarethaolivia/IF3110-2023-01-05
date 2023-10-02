<?php

require_once __DIR__ . '/AuthViewController.php';

abstract class AdminViewController extends AuthViewController
{  
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function authorize()
    {
        $user = $this->getSessionMiddleware()->authorizeUser();

        if (!$user->is_admin) {
            echo "no";
            exit;
        }
    }
}
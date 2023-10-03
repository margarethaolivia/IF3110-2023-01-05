<?php

require_once __DIR__ . '/AuthViewController.php';

abstract class UserViewController extends AuthViewController
{  
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function authorize()
    {
        $user = $this->getSessionMiddleware()->authorizeUser(true);
    }
}
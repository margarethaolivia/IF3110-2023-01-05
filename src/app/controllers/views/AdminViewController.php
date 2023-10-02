<?php

require_once __DIR__ . '/AuthViewController.php';

abstract class AdminViewController extends AuthViewControler
{  
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function authorize()
    {
        $this->getSessionMiddleware()->authorizeAdmin();
    }
}
<?php

require_once APP_PATH . '/controllers/views/ViewController.php';

class LogInController extends ViewController
{    
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
    
    protected function getData($params)
    {
        return [
            'title' => 'LogIn - WeTube',
            'script_paths' => ['login/login.js'],
            'style_paths' => ['template/auth.css'],
            'isPlainPage' => true
        ];
    }
}

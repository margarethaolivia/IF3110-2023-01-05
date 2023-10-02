<?php

require_once __DIR__ . '/../ViewController.php';

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

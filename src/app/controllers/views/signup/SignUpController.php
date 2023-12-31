<?php

require_once APP_PATH . '/controllers/views/ViewController.php';

class SignUpController extends ViewController
{    
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
    
    protected function getData($params)
    {
        return [
            'title' => 'Sign Up - WeTube',
            'script_paths' => ['signup/signup.js'],
            'style_paths' => ['template/auth.css'],
            'isPlainPage' => true
        ];
    }
}

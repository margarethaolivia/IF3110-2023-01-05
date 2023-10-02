<?php

require_once __DIR__ . '/../ViewController.php';

class SignInController extends ViewController
{    
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
    
    protected function getData($params)
    {
        return [
            'title' => 'SignIn - WeTube',
            'script_paths' => ['signin/signin.js'],
            'style_paths' => ['template/auth.css'],
        ];
    }
}

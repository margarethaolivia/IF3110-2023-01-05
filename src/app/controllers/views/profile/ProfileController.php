<?php

require_once __DIR__ . '/../ViewController.php';

class ProfileController extends ViewController
{    
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
    
    protected function getData($params)
    {
        return [
            'title' => 'Profile - WeTube',
            'script_paths' => ['profile/profile.js'],
            'style_paths' => ['profile/profile.css'],
        ];
    }
}

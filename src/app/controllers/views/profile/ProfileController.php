<?php

require_once __DIR__ . '/../UserViewController.php';

class ProfileController extends UserViewController
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

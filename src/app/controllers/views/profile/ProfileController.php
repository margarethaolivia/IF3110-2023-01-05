<?php

require_once APP_PATH . '/controllers/views/UserViewController.php';

class ProfileController extends UserViewController
{    
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
    
    protected function getData($params)
    {
        $userService = $this->getService('UserService');
        return [
            'title' => 'Profile - WeTube',
            'script_paths' => ['profile/profile.js'],
            'style_paths' => ['profile/profile.css'],
            'user' => $userService->getUserById($_SESSION['user_id'])
        ];
    }
}

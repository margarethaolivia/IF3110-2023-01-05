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
        return [
            'title' => 'Edit Video - WeTube',
            'script_paths' => ['videos/form.js'],
            'style_paths' => ['videos/form.css'],
        ];
    }
}

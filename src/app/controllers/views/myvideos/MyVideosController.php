<?php

require_once APP_PATH . '/controllers/views/UserViewController.php';

class MyVideosController extends UserViewController
{    
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
    
    protected function getData($params)
    {
        return [
            'title' => 'My Videos - WeTube',
            'script_paths' => ['myvideos/myvideos.js'],
            'style_paths' => ['myvideos/myvideos.css'],
        ];
    }
}

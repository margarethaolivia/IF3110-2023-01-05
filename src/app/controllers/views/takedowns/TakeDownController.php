<?php

require_once APP_PATH . '/controllers/views/AdminViewController.php';

class TakeDownController extends AdminViewController
{    
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
    
    protected function getData($params)
    {
        return [
            'title' => 'Takedowns - WeTube',
            'script_paths' => ['takedowns/takedown.js'],
            'style_paths' => ['takedowns/takedown.css'],
        ];
    }
}

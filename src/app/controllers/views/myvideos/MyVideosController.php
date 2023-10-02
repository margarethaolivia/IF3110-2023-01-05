<?php

require_once __DIR__ . '/../ViewController.php';

class MyVideosController extends ViewController
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

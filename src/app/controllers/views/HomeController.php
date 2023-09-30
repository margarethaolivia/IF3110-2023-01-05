<?php

require_once __DIR__ . '/ViewController.php';

class HomeController extends ViewController
{    
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
    
    protected function getData($params)
    {
        return [
            'title' => 'WeTube',
            'script_paths' => ['home/home.js'],
            'style_paths' => ['home/home.css'],
        ];
    }
}

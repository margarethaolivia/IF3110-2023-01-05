<?php

require_once __DIR__ . '/../ViewController.php';

class TakeDownController extends ViewController
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

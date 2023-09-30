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
            'title' => 'Edit Video - WeTube',
            'script_paths' => ['videos/form.js'],
            'style_paths' => ['videos/form.css'],
        ];
    }
}

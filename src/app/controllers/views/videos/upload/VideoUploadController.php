<?php

require_once __DIR__ . '/../../ViewController.php';

class VideoUploadController extends ViewController
{    
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
    
    protected function getData($params)
    {
        return [
            'title' => 'Upload Video - WeTube',
            'script_paths' => ['videos/form.js'],
            'style_paths' => ['videos/form.css'],
        ];
    }
}
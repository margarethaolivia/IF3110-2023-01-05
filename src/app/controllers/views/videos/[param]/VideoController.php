<?php

require_once APP_PATH . '/controllers/views/ViewController.php';

class VideoController extends ViewController
{    
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
    
    public function getData($params)
    {
        return [
            'title' => 'Video - WeTube',
            'script_paths' => ['videos/videos.js'],
            'style_paths' => ['videos/videos.css'],
        ];
    }

    public function index($params)
    {   
        $view = $this->getView($this->getData($params));
        $view->render();
    } 
}

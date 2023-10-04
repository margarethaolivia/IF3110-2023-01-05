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
        $videoService = $this->getService('videoService');
        $getVideoById = $videoService->getVideoById($params[0]);

        $commentService = $this->getService('commentService');
        $getCommentByVideoId = $commentService->getCommentByVideoId($params[0]);

        return [
            'title' => 'Video - WeTube',
            'script_paths' => ['videos/videos.js'],
            'style_paths' => ['videos/videos.css'],
            'video' => $getVideoById,
            'comments' => $getCommentByVideoId,
        ];
    }

    public function index($params)
    {   
        $view = $this->getView($this->getData($params));
        $view->render();
    } 
}

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
        $video = $videoService->getVideoById($params[0]);

        $commentService = $this->getService('commentService');
        $comments = $commentService->getCommentByVideoId($params[0]);

        $user = null;

        if (isset($_SESSION['user_id']))
        {
            $user = $this->getService('UserService')->getUserById($_SESSION['user_id']);
        }

        return [
            'title' => 'Video - WeTube',
            'script_paths' => ['videos/videos.js'],
            'style_paths' => ['videos/videos.css'],
            'video' => $video,
            'comments' => $comments,
            'user' => $user
        ];
    }

    public function index($params)
    {   
        $view = $this->getView($this->getData($params));
        $view->render();
    } 
}

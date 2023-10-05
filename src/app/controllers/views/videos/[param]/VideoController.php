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

        if ($video->is_taken_down && !($user && ($user->is_admin || $video->user_id === $user->user_id)))
        {
            $this->renderForbiddenPage([
                'link' => '/', 
                'src' => BASE_URL . '/images/vector/403.svg', 
                'desc' => 'This video is taken down by admin.'
            ]);
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

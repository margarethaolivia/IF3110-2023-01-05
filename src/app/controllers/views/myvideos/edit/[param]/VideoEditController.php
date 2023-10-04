<?php

require_once APP_PATH . '/controllers/views/UserViewController.php';

class VideoEditController extends UserViewController
{    
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
    
    protected function getData($params)
    {
        $videoService = $this->getService('VideoService');
        $data = $videoService->getVideoAndTagsById($params[0]);
        return [
            'title' => 'Edit Video - WeTube',
            'script_paths' => ['videos/form.js'],
            'style_paths' => ['videos/form.css'],
            'video' => $data['video'],
            'tags' => $data['tags']
        ];
    }
}

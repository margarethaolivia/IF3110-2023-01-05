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
        $tagService = $this->getService('TagService');
        $video = $videoService->getVideoWithoutUser($params[0]);
        $tags = $tagService->getVideoTags($params[0]);
        return [
            'title' => 'Edit Video - WeTube',
            'script_paths' => ['videos/form.js'],
            'style_paths' => ['videos/form.css'],
            'video' => $video,
            'tags' => $tags
        ];
    }
}

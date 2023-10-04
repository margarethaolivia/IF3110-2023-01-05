<?php

include_once __DIR__ . '/ProfilePicHandler.php';
include_once __DIR__ . '/VideoFileHandler.php';
include_once __DIR__ . '/ThumbnailFileHandler.php';

class FileManager {
    private $handlerMap;

    public function __construct()
    {
        $this->handlerMap = [
            'video_file' => new ProfilePicHandler(),
            'thumbnail' => new ThumbnailFileHandler(),
            'profile_pic' => new ProfilePicHandler()
        ];
    }

    public function writeFile($id, $extension, $formDataName)
    {
        return $this->handlerMap[$formDataName]->writeFile($id, $extension, $formDataName);
    }
}
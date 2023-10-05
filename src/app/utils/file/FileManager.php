<?php

include_once __DIR__ . '/ProfilePicHandler.php';
include_once __DIR__ . '/VideoFileHandler.php';
include_once __DIR__ . '/ThumbnailFileHandler.php';

class FileManager {
    private $handlerMap;

    public function __construct()
    {
        $this->handlerMap = [
            'video_file' => new VideoFileHandler(),
            'thumbnail' => new ThumbnailFileHandler(),
            'profile_pic' => new ProfilePicHandler()
        ];
    }

    public function writeFile($id, $extension, $formDataName, $dateTimeString=null)
    {
        return $this->handlerMap[$formDataName]->writeFile($id, $extension, $formDataName);
    }

    public function deleteFile($publicUrl, $formDataName, $removeAdditionalFolders=true)
    {
        return $this->handlerMap[$formDataName]->deleteFile($publicUrl, $removeAdditionalFolders);
    }
}
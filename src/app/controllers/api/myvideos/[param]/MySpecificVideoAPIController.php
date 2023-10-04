<?php
include_once APP_PATH . '/controllers/api/APIController.php';
include_once APP_PATH . '/utils/file/FileManager.php';

class MySpecificVideoAPIController extends APIController {

    private $fileManager;

    public function __construct($folder_path)
    {
        parent::__construct($folder_path);

        $this->fileManager = new FileManager();
    }

    protected function DELETE($params)
    {
        $sessionMiddleware = $this->getMiddleware('SessionMiddleware');
        $user = $sessionMiddleware->authorizeUser();
        $user_id = $user->user_id;
        $video_id = $params[0];
    
        try {
            $videoService = $this->getService('VideoService');
            $video = $videoService->getVideoById($video_id);
            $videoService->deleteVideoById($user_id, $video_id);

            $this->fileManager->deleteFile($video->video_file, 'video_file');
            $this->fileManager->deleteFile($video->thumbnail, 'thumbnail');
            return self::response('Video is deleted', 200);
    
        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }
}
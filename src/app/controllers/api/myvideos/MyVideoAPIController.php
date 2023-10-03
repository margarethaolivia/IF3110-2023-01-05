<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class MyVideoAPIController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function GET($params)
    {
        $sessionMiddleware = $this->getMiddleware('SessionMiddleware');
        $user = $sessionMiddleware->authorizeUser();

        try {
            $videoService = $this->getService('VideoService');
            $videos = $videoService->getUserVideos($user->user_id);            
            return self::response(
                "My videos fetched", 
                200, 
                [
                    "videos" => $videos
                ]
            );

        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }
}
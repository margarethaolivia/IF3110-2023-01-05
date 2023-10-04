<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class MySpecificVideoAPIController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function DELETE($params)
    {
        $sessionMiddleware = $this->getMiddleware('SessionMiddleware');
        $user = $sessionMiddleware->authorizeUser();
        $user_id = $user->user_id;
    
        try {
            $videoService = $this->getService('VideoService');
            $videoService->deleteVideoById($user_id, $params[0]);
            return self::response('Video is deleted', 200);
    
        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }
}
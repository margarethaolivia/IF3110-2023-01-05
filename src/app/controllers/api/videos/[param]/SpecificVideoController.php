<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class SpecificVideoController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function PATCH($params)
    {
        $sessionMiddleware = $this->getMiddleware('SessionMiddleware');
        $user = $sessionMiddleware->authorizeAdmin();
        $body = $this->getBody();

        $this->checkRequiredField($body, ['is_taken_down']);

        if ($body['is_taken_down'])
        {
            $this->checkRequiredField($body, ['take_down_comment']);

            if (strlen($body['take_down_comment']) === 0)
            {
                return self::response('Takedown comment length can not be zero', 400);
            }
        }

        try {
            $videoService = $this->getService('VideoService');
            $videoService->updateVideo(
                $params[0], 
                [
                    'take_down_comment' => $body['take_down_comment'] ?? null, 
                    'taken_down_by' => $body['is_taken_down'] ? $user->user_id : null, 
                    'is_taken_down' => $body['is_taken_down']
                ]
            );
        }

        catch (Exception $e)
        {
            $this->sendResponseOnError($e);
        }
       
        return self::response('Video edited', 200);
    }
}
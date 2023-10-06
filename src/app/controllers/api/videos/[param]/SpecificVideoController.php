<?php
include_once APP_PATH . '/controllers/api/APIController.php';
include_once APP_PATH . '/utils/OutputHandler.php';

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

            $video = $this->getService('VideoService')->getVideoById($params[0]);

            if ($video->is_official)
            {
                return self::response('Official video can not be taken down', 403);
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

        $responseData = [];

        if ($body['is_taken_down'])
        {
            $outputHandler =  new OutputHandler();
            $html = $outputHandler->outputComponentAsString('takedownInfo', APP_PATH . '/components/takedowns/takedownInfo.php', ['comment' => $body['take_down_comment']]);
            $responseData['take_down_info_html'] = $html;
        }
       
        return self::response('Video edited', 200, $responseData);
    }
}
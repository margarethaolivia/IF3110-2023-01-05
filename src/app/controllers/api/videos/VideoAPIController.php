<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class VideoAPIController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function POST($param) {

        $user = $this->getMiddleware('SessionMiddleware') -> authorizeuser();

        $user_id = $user->user_id;

        $request_data = $this->getBody();
        $required_fields = ['title', 'thumbnail', 'video_file'];
        $missing_field = $this->checkRequiredField($request_data, $required_fields);

        if ($missing_field)
        {
            return self::response('Missing required field: ' . $missing_field, 400);
        }

        try {
            $this->videoService->createVideo($user_id, $request_data);
            
            $redirect_value = isset($_GET['redirect']) ? $_GET['redirect'] : '';
            header("Location: " . BASE_URL . "/" . ltrim($redirect_value, '/myvideos'), true, 302);
            exit();

        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }

    protected function GET($params)
    {
        $request_data = $this->getBody();
        try {
            $this->videoService->getVideoById($request_data);            
            $redirect_value = isset($_GET['redirect']) ? $_GET['redirect'] : '';
            header("Location: " . BASE_URL . "/videos/" . ltrim($request_data, '/'), true, 302);
            exit();
        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }
}
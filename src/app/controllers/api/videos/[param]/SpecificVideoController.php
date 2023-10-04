<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class SpecificVideoController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
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
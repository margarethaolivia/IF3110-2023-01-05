<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class CommentController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function GET($params)
    {
        try {
            $this->commentService->getCommentByVideoId($params[0]);
        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }
}
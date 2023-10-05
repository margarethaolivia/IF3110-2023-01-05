<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class SpecificCommentController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function DELETE($params)
    {
        $sessionMiddleware = $this->getMiddleware('SessionMiddleware');
        $user = $sessionMiddleware->authorizeUser();
        $user_id = $user->user_id;
        $comment_id = $params[1];

        try {
            $commentService = $this->getService('CommentService');
            $comment = $commentService->getCommentById($comment_id);
            $commentService->deleteCommentById($user_id, $comment_id);
    
            return self::response('Comment is deleted', 200);
    
        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }
}
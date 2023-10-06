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

            if($user_id !== $comment->user_id)
            {
                if (!$user->is_admin)
                {
                    return self::response('Unauthorized', 401);
                }

                else if ($comment->is_admin)
                {
                    return self::response('Forbidden', 403);
                }
            }
            
            $commentService->deleteCommentById($comment->user_id, $comment_id);
    
            return self::response('Comment is deleted', 200);
    
        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }

    protected function POST($params)
    {
        $user = $this->getMiddleware('SessionMiddleware')->authorizeuser();
        $user_id = $user->user_id;
        $request_data = [];
        $comment_id = $params[1];

        // Check if comment_text is empty
        if (empty($_POST['comment_text'])) {
            return self::response('Comment text is required', 400);
        }

        $request_data['comment_text'] = $_POST['comment_text'];

        $commentService = $this->getService('CommentService');

        try {
            $commentService->updateComment($user_id, $comment_id, $request_data);
            
            return self::response('Comment is edited', 200);
        }

        catch (Exception $e)
        {
            $this->sendResponseOnError($e);
        }
       
        return self::response('Comment edited', 200);
    }
}
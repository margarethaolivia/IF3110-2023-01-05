<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class CommentAPIController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function POST($params) {
        $user = $this->getMiddleware('SessionMiddleware')->authorizeuser();
        $body = $this->getBody();

        $this->checkRequiredField($body, ['comment_text']);

        if (strlen($body['comment_text'] === 0))
        {
            return self::response('Comment length can not be zero', 400);
        }

        $postBody = [
            'comment_text' => $body['comment_text'],
            'video_id' => $params[0],
            'user_id' => $user->user_id
        ];

        try {
            $commentService = $this->getService('CommentService');
            $comment_id = $commentService->createComment($postBody);

            $comment = $commentService->getCommentById($comment_id);
            return self::response('Comment posted', 201, ['comment' => $comment]);

        } catch (Exception $e) {
            return $this->sendResponseOnError($e);
        }
    }
}
<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class CommentAPIController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function POST($param) {
        $user = $this->getMiddleware('SessionMiddleware')->authorizeuser();
        $user_id = $user->user_id;
        $request_data = [];

        if (empty($_POST['comment_text'])) {
            return self::response('Comment text is required', 400);
        }

        $request_data['video_id'] = $_POST['video_id'];
        $request_data['comment_text'] = $_POST['comment_text'];
        $request_data['user_id'] = $user_id;

        try {
            $commentService = $this->getService('CommentService');$commentService->createComment($request_data);

            return self::response('Comment is posted', 201);
        } catch (Exception $e) {
            return $this->sendResponseOnError($e);
        }
    }
}
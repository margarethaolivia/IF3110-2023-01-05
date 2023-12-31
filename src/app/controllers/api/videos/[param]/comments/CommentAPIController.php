<?php
include_once APP_PATH . '/controllers/api/APIController.php';
include_once APP_PATH . '/utils/OutputHandler.php';

class CommentAPIController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function GET($param) {

        $outputHandler =  new OutputHandler();
        $videoId = $param[0];

        $offset = intval($_GET['offset'] ?? 0);

        try {
            $commentService = $this->getService('CommentService');
            $comments = $commentService->getCommentByVideoId($videoId, $offset);

            $body = [];
            $html = "";
            $total_comment = 0;

            foreach ($comments as $comment)
            {
                if ($total_comment === 0 && $comment->total_count > 0)
                {
                    $total_comment = $comment->total_count;
                }

                $html = $html . $outputHandler->outputComponentAsString('commentCard', APP_PATH . '/components/elements/commentCard.php', [
                    'comment' =>$comment,
                    'deleteAction' => "deleteMyComment(event, " . $comment->video_id . ", " . $comment->comment_id . ", 'popup-delete-comment')",
                ]);
            }

            $html .= "<div id='end-of-comment'></div>";

            $body['comment_list_html'] = $html;
            $body['total_comment'] = $total_comment;

            return self::response('HTML fetched', 200, $body);

        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
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
            $outputHandler =  new OutputHandler();
            $html = $outputHandler->outputComponentAsString('commentCard', APP_PATH . '/components/elements/commentCard.php', [
                'comment' =>$comment,
                'deleteAction' => "deleteMyComment(event, " . $comment->video_id . ", " . $comment->comment_id . ", 'popup-delete-comment')",
            ]);

            return self::response('Comment posted', 201, ['comment' => $comment, 'comment_card_html' => $html]);

        } catch (Exception $e) {
            return $this->sendResponseOnError($e);
        }
    }
}
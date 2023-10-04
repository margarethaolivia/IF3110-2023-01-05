<?php
include_once (__DIR__ . '/Service.php');
include_once (APP_PATH . '/cores/Database.php');

class CommentService extends Service
{   
    public function getCommentByVideoId($video_id) {
        $query = "SELECT * FROM comment INNER JOIN metube_user USING (user_id) WHERE video_id = :video_id";

        return $this->getDatabase()->fetchAll(
            [
                'query' => $query,
                'bindings' => [Database::binding('video_id', $video_id)]
            ]
        );
    }

    public function createComment($data) {
        $query = 'INSERT INTO comment (video_id, comment_text, user_id) VALUES(:video_id, :comment_text, :user_id)';
        
        $this->getDatabase()->execute(
            $query,
            [
                Database::binding('video_id', $data['video_id']),
                Database::binding('comment_text', $data['comment_text']),
                Database::binding('user_id', $data['user_id']),
            ]
        );

        return $this->getDatabase()->getLastInsertID();
    }
}

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
        
        $res = $this->getDatabase()->execute(
            $query,
            [
                Database::binding('video_id', $data['video_id']),
                Database::binding('comment_text', $data['comment_text']),
                Database::binding('user_id', $data['user_id']),
            ]
        );

        return $this->getDatabase()->getLastInsertID();
    }

    public function updateComment($user_id, $comment_id, $data) {
        $allowedAttributes = ['comment_text'];

        // Prepare the SET part of the SQL query
        $setClause = '';
        $bindings = [Database::binding('comment_id', $comment_id), Database::binding('user_id', $user_id)];

        foreach ($allowedAttributes as $attribute) {
            if (isset($data[$attribute])) {
                $setClause .= "$attribute = :$attribute, ";
                array_push($bindings, Database::binding($attribute, $data[$attribute]));
            }
        }
        
        // Remove the trailing comma and space from the setClause
        $setClause = rtrim($setClause, ', ');

        // Construct the SQL query
        $query = "UPDATE comment SET $setClause WHERE comment_id = :comment_id AND user_id = :user_id";

        // Execute the update query
        $res = $this->getDatabase()->execute($query, $bindings, true);

        return $res;
    }

    public function deleteCommentById($user_id, $comment_id)
    {
        $query = 'DELETE FROM comment WHERE comment_id = :comment_id AND user_id = :user_id';

        return $this->getDatabase()->execute(
            $query,
            [Database::binding('comment_id', $comment_id), Database::binding('user_id', $user_id)]
        );
    }
}

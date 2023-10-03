<?php
include_once (__DIR__ . '/Service.php');
include_once (APP_PATH . '/cores/Database.php');

class VideoService extends Service
{   
    public function getVideoCount($user_id)
    {
        $sql = "SELECT COUNT(*) AS count FROM video WHERE user_id = :user_id";
        $bindings = [Database::binding('user_id', $user_id)];

        $res = $this->getDatabase()->fetch(Database::fetchParam($sql, $bindings));
        
        return $res->count;
    }

    public function createVideo($data)
    {
        $query = 'INSERT INTO video (user_id, title, video_desc, is_official) VALUES(:user_id, :title, :video_desc, :is_official)';
        
        $this->getDatabase()->execute(
            $query,
            [
                Database::binding('user_id', $data['user_id']),
                Database::binding('title', $data['title']),
                Database::binding('video_desc', $data['video_desc']),
                Database::binding('is_official', $data['is_official']),
            ]
        );

        return $this->getDatabase()->getLastInsertID();
    }

    public function getVideoById($id)
    {
        $query = 'SELECT * FROM video WHERE video_id = :video_id LIMIT 1';

        return $this->getDatabase()->fetch(
            [
                'query' => $query,
                'bindings' => [Database::binding('video_id', $id)]
            ]
        );
    }

    public function updateVideo($user_id, $video_id, $data)
    {
        // Define the allowed attributes that can be updated
        $allowedAttributes = ['title', 'video_desc', 'thumbnail', 'video_file', 'is_taken_down', 'taken_down_by', 'take_down_comment'];

        // Prepare the SET part of the SQL query
        $setClause = '';
        $bindings = [Database::binding('video_id', $video_id), Database::binding('user_id', $user_id)];

        foreach ($allowedAttributes as $attribute) {
            if (isset($data[$attribute])) {
                $setClause .= "$attribute = :$attribute, ";
                array_push($bindings, Database::binding($attribute, $data[$attribute]));
            }
        }
        
        // Remove the trailing comma and space from the setClause
        $setClause = rtrim($setClause, ', ');

        // Construct the SQL query
        $sql = "UPDATE video SET $setClause WHERE video_id = :video_id AND user_id = :user_id";

        // Execute the update query
        $res = $this->getDatabase()->execute($sql, $bindings, true);

        return $res;
    }
}

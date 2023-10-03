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

    public function createVideo($user_id, $data)
    {
        $query = 'INSERT INTO video (user_id, title, thumbnail, video_file, video_desc) VALUES(:user_id, :title, :thumbnail, :video_file, :video_desc)';
        
        return $this->getDatabase()->execute(
            $query,
            [
                Database::binding('user_id', $user_id),
                Database::binding('title', $data['title']),
                Database::binding('thumbnail', $data['thumbnail']),
                Database::binding('video_file', $data['video_file']),
                Database::binding('video_desc', $data['video_desc']),
            ]
        );
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
}

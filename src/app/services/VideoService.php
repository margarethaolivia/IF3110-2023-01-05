<?php
include_once (__DIR__ . '/Service.php');
include_once (APP_PATH . '/cores/Database.php');

class VideoService extends Service
{   
    private function getPageOffset($page_number, $limit)
    {
        return ($page_number - 1) * $limit;
    }

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

    public function getAllVideo($page_number=1, $search='')
    {
        $limit = MAX_VIDEO_DISPLAY;
        $offset = $this->getPageOffset($page_number, $limit);

        $searchCondition = '';

        if ($search)
        {
            $searchCondition = "AND title ILIKE :search";
            $search = '%' . $search . '%';
        }

        $whereCondition = "is_taken_down = false $searchCondition";

        $query = "WITH TotalCount AS (
            SELECT CEIL(COUNT(video_id) / :video_limit) AS total_page
            FROM video
            WHERE $whereCondition
        )

        SELECT video_id, title, thumbnail, is_official, video.created_at, first_name || ' ' || last_name as full_name, profile_pic, TotalCount.total_page
        FROM video INNER JOIN metube_user USING(user_id), TotalCount
        WHERE $whereCondition
        OFFSET :offset LIMIT :video_limit";

        $bindings = [Database::binding('offset', $offset), Database::binding('video_limit', $limit)];

        if ($searchCondition)
        {
            $bindings[] = Database::binding('search', $search);
        }

        $videos = $this->getDatabase()->fetchAll(
            Database::fetchParam($query, $bindings));
        
        return $videos;
    }

    public function getVideoById($id)
    {
        $query = 'SELECT * FROM video INNER JOIN metube_user USING (user_id) WHERE video_id = :video_id LIMIT 1';

        return $this->getDatabase()->fetch(
            [
                'query' => $query,
                'bindings' => [Database::binding('video_id', $id)]
            ]
        );
    }

    public function getVideoAndTagsById($id)
    {
        $query = 'SELECT * FROM video WHERE video_id = :video_id LIMIT 1';

        $video = $this->getDatabase()->fetch(
            [
                'query' => $query,
                'bindings' => [Database::binding('video_id', $id)]
            ]
        );

        return [
            'video' => $video,
            'tags' => []
        ];
    }

    public function deleteVideoById($user_id, $video_id)
    {
        $query = 'DELETE FROM video WHERE video_id = :video_id AND user_id =:user_id';

        return $this->getDatabase()->execute(
            $query,
            [Database::binding('video_id', $video_id), Database::binding('user_id', $user_id)]
        );
    }

    public function getUserVideos($user_id, $page_number=1)
    {
        $limit = MAX_VIDEO_DISPLAY;
        $offset = $this->getPageOffset($page_number, $limit);

        $whereCondition = "user_id = :user_id";

        $query = "WITH TotalCount AS (
            SELECT CEIL(COUNT(video_id) / :video_limit) AS total_page
            FROM video
            WHERE $whereCondition
        )
        
        SELECT *
        FROM video, TotalCount
        WHERE $whereCondition
        OFFSET :offset LIMIT :video_limit";

        $bindings = [Database::binding('user_id', $user_id), Database::binding('offset', $offset), Database::binding('video_limit', $limit)];

        $videos = $this->getDatabase()->fetchAll(
            Database::fetchParam($query, $bindings));
        
        return $videos;
    }

    public function updateVideo($video_id, $data, $user_id = null)
    {
        // Define the allowed attributes that can be updated
        $allowedAttributes = ['title', 'video_desc', 'thumbnail', 'video_file', 'is_taken_down', 'taken_down_by', 'take_down_comment'];

        // Prepare the SET part of the SQL query
        $setClause = '';
        $bindings = [Database::binding('video_id', $video_id)];

        if ($user_id)
        {
            $bindings[] = Database::binding('user_id', $user_id);
        }

        foreach ($allowedAttributes as $attribute) {
            if (array_key_exists($attribute, $data)) {
                $setClause .= "$attribute = :$attribute, ";
                array_push($bindings, Database::binding($attribute, $data[$attribute]));
            }
        }
        
        // Remove the trailing comma and space from the setClause
        $setClause = rtrim($setClause, ', ');
        $whereClause = "video_id = :video_id";

        if ($user_id)
        {
            $whereClause = $whereClause . " AND user_id = :user_id";
        }
        // Construct the SQL query
        $sql = "UPDATE video SET $setClause WHERE $whereClause";
        // Execute the update query
        $res = $this->getDatabase()->execute($sql, $bindings, true);

        return $res;
    }

    public function getTakedowns($user_id, $page_number=1)
    {
        $limit = MAX_TAKEDOWN_DISPLAY;
        $offset = $this->getPageOffset($page_number, $limit);

        $whereCondition = "is_taken_down = TRUE AND taken_down_by = :user_id";

        $query = "WITH TotalCount AS (
            SELECT CEIL(COUNT(video_id) / :video_limit) AS total_page 
            FROM video
            WHERE $whereCondition
        )
        
        SELECT video_id, title, video_desc, thumbnail, first_name || ' ' || last_name as full_name, TotalCount.total_page, take_down_comment
        FROM video INNER JOIN metube_user USING(user_id), TotalCount
        WHERE $whereCondition
        OFFSET :offset LIMIT :video_limit";

        $bindings = [Database::binding('user_id', $user_id), Database::binding('offset', $offset), Database::binding('video_limit', $limit)];

        $videos = $this->getDatabase()->fetchAll(
            Database::fetchParam($query, $bindings));
        
        return $videos;
    }
}

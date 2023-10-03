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
}

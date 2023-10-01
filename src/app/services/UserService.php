<?php
include(__DIR__ . '/Service.php');

class UserService extends Service
{   
    public function getUser($id)
    {
        $query = 'SELECT user_id FROM user WHERE user_id = :user_id LIMIT 1';

        return $this->getDatabase()->fetch(
            [
                'query' => $query,
                'bindings' => [Database::binding('user_id', $id)]
            ]
        );
    }
}

<?php
include_once (__DIR__ . '/Service.php');
include_once (__DIR__ . '/../cores/Database.php');

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

    public function isFullNameExists($firstname, $lastname)
    {
        $full_name = $firstname . $lastname;
        $sql = "SELECT COUNT(*) AS count FROM your_table WHERE CONCAT(firstname, ' ', lastname) = :full_name";
        $bindings = [Database::binding('full_name', $full_name)];

        $res = $this->getDatabase()->fetch(Database::fetchParam($sql, $bindings));
        print_r($res);
    }
}

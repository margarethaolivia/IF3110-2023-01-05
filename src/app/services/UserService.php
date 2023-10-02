<?php
include_once (__DIR__ . '/Service.php');
include_once (__DIR__ . '/../cores/Database.php');

class UserService extends Service
{   

    public function createUser($data)
    {
        $query = 'INSERT INTO metube_user (username, pass, first_name, last_name, is_admin) VALUES(:username, :pass, :first_name, :last_name, false)';
        $options = [
            'cost' => BCRYPT_COST
        ];
        
        return $this->getDatabase()->execute(
            $query,
            [
                Database::binding('username', $data['username']),
                Database::binding('pass', password_hash($data['password'], PASSWORD_BCRYPT, $options)),
                Database::binding('first_name', $data['first_name']),
                Database::binding('last_name', $data['last_name']),
            ]
        );
    }

    public function getUserById($id)
    {
        $query = 'SELECT * FROM metube_user WHERE user_id = :user_id LIMIT 1';

        return $this->getDatabase()->fetch(
            [
                'query' => $query,
                'bindings' => [Database::binding('user_id', $id)]
            ]
        );
    }

    public function getUserByUsername($username)
    {
        $query = 'SELECT * FROM metube_user WHERE username = :username LIMIT 1';

        return $this->getDatabase()->fetch(
            [
                'query' => $query,
                'bindings' => [Database::binding('username', $username)]
            ]
        );
    }

    public function isFullNameExists($firstname, $lastname)
    {
        $full_name = $firstname . $lastname;
        $sql = "SELECT COUNT(*) AS count FROM metube_user WHERE CONCAT(first_name, ' ', last_name) = :full_name";
        $bindings = [Database::binding('full_name', $full_name)];

        $res = $this->getDatabase()->fetch(Database::fetchParam($sql, $bindings));
        
        return $res->count > 0;
    }

    public function isUsernameExists($username)
    {
        $sql = "SELECT COUNT(*) AS count FROM metube_user WHERE username = :username";
        $bindings = [Database::binding('username', $username)];

        $res = $this->getDatabase()->fetch(Database::fetchParam($sql, $bindings));
        
        return $res->count > 0;
    }


}

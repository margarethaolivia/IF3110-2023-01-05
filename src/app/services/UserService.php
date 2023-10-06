<?php
include_once (__DIR__ . '/Service.php');
include_once (APP_PATH . '/cores/Database.php');

class UserService extends Service
{   
    public function isUsernameValid($username)
    {
        return 0 < strlen($username) && strlen($username) <= 20 && preg_match('/^[A-Za-z0-9_]+$/', $username);
    }

    public function isPasswordValid($password)
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,20}$/', $password);
    }

    public function createUser($data)
    {
        $query = 'INSERT INTO metube_user (username, pass, first_name, last_name, is_admin) VALUES(:username, :pass, :first_name, :last_name, false)';
        $options = [
            'cost' => BCRYPT_COST
        ];
        
        $this->getDatabase()->execute(
            $query,
            [
                Database::binding('username', $data['username']),
                Database::binding('pass', password_hash($data['password'], PASSWORD_BCRYPT, $options)),
                Database::binding('first_name', $data['first_name']),
                Database::binding('last_name', $data['last_name']),
            ]
        );

        return $this->getDatabase()->getLastInsertID();
    }

    function isNameValid($full_name) {
        // Define the pattern
        $pattern = '/^[a-zA-Z]+$/';
    
        // Use preg_match to check if the name matches the pattern
        return preg_match($pattern, $full_name);
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
        $full_name = $firstname . ' ' . $lastname;
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

    public function addProfilePicture($user_id, $path)
    {
        $sql = "UPDATE metube_user SET profile_pic = :profile_pic WHERE user_id = :user_id";
        $bindings = [Database::binding('profile_pic', $path), Database::binding('user_id', $user_id)];

        $res = $this->getDatabase()->execute($sql, $bindings);
        return $res;
    }

    public function updateUser($user_id, $data)
    {
        // Define the allowed attributes that can be updated
        $allowedAttributes = ['first_name', 'last_name', 'pass'];

        // Prepare the SET part of the SQL query
        $setClause = '';
        $bindings = [Database::binding('user_id', $user_id)];

        foreach ($allowedAttributes as $attribute) {
            if (array_key_exists($attribute, $data)) {
                $setClause .= "$attribute = :$attribute, ";

                if ($attribute == 'pass')
                {
                    $options = [
                        'cost' => BCRYPT_COST
                    ];

                    $data['pass'] = password_hash($data['pass'], PASSWORD_BCRYPT, $options);
                }

                array_push($bindings, Database::binding($attribute, $data[$attribute]));
            }
        }
        
        // Remove the trailing comma and space from the setClause
        $setClause = rtrim($setClause, ', ');

        // Construct the SQL query
        $sql = "UPDATE metube_user SET $setClause WHERE user_id = :user_id";

        // Execute the update query
        $res = $this->getDatabase()->execute($sql, $bindings, true);

        return $res;
    }
}

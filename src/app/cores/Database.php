<?php

class Database
{
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $port = DB_PORT;
    private $option = [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    private $db_connection;
    private $statement;

    public function __construct()
    {
        try {
            $pdo = new PDO(
                "pgsql:host=$this->host;port=$this->port;dbname=$this->db_name", 
                $this->user, 
                $this->password, 
                $this->option
            );

            $this->db_connection = $pdo;

        } catch (PDOException $e) {
            throw new Exception('Bad Gateway', 502);
        }
    }

    private function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            if (is_int($value)) 
            {
                $type = PDO::PARAM_INT;
            } 
            
            elseif (is_bool($value)) 
            {
                $type = PDO::PARAM_BOOL;
            } 
            
            elseif (is_null($value))
            {
                $type = PDO::PARAM_NULL;
            } 
            
            else {
                // Default to treating the value as a string if type is null
                $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    public function execute($query, $bindings)
    {
        $this->statement = $this->db_connection->prepare($query);

    
        foreach ($bindings as $binding) {
            $param = $binding['param'];
            $value = $binding['value'];
            $type = $binding['type'] ?? null; // Default to null if type is not specified
            $this->bind($param, $value, $type);
        }

        $this->statement->execute();
    }

    public function fetch($params=null)
    {
        try {
            if ($params) $this->execute($params['query'], $params['bindings']);
            return $this->statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException) {
            throw new Exception('Internal Server Error', 500);
        }
    }

    public function fetchAll($params=null)
    {
        try {
            if ($params) $this->execute($params['query'], $params['bindings']);
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException) {
            throw new Exception('Internal Server Error', 500);
        }
    }

    public function getRowCount()
    {
        try {
            return $this->statement->rowCount();
        } catch (PDOException) {
            throw new Exception('Internal Server Error', 500);
        }
    }
    
    public function getLastInsertID()
    {
        try {
            return $this->db_connection->lastInsertId();
        } catch (PDOException) {
            throw new Exception('Internal Server Error', 500);
        }
    }

    public function reset()
    {
        unset($this->statement);
    }

    static public function binding($param, $value, $type = null)
    {
        return [
            'param' => $param,
            'value' => $value,
            'type' => $type
        ];
    }

    static public function fetchParam($query, $bindings)
    {
        return [
            'query' => $query,
            'bindings' => $bindings
        ];
    }

}

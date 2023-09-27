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

    public function __construct()
    {
        try {
            $pdo = new PDO(
                "pgsql:host=$this->host;port=$this->port;dbname=$this->db_name", 
                $this->user, 
                $this->password, 
                $this->option
            );
            
            echo "DB Connection succeeded";

            $this->db_connection = $pdo;

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            throw new Exception('Bad Gateway', 502);
        }
    }

    public function getConnection()
    {
        return $this->db_connection;
    }
}

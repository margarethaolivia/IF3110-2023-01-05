<?php
include_once (__DIR__ . '/../cores/Database.php');

abstract class Service
{   
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    protected function getDatabase()
    {
        return $this->db;
    }
}

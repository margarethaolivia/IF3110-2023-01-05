<?php
include_once (APP_PATH . '/cores/Database.php');

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

    protected function getPageOffset($page_number, $limit)
    {
        return ($page_number - 1) * $limit;
    }
}

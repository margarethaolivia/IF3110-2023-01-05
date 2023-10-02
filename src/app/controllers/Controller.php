<?php

abstract class Controller
{   
    private $folder_path;

    public function __construct($folder_path)
    {
        $this->folder_path = $folder_path;
    }

    abstract public function index($params);

    protected function getFolderPath() {
        return $this->folder_path;
    }

    protected function notAllowedResponse() {
        http_response_code(405);
    }

    protected function getMiddleware($middleware)
    {
        require_once __DIR__ . '/../middlewares/' . $middleware . '.php';
        return new $middleware();
    }
}

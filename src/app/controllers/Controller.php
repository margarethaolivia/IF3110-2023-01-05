<?php

abstract class Controller
{   
    protected $folder_path;

    public function __construct($folder_path)
    {
        $this->folder_path = $folder_path;
    }

    abstract public function index();

    protected function getView($data = [])
    {
        require_once __DIR__ . '/../views/template/view.php';
        return new View($this->folder_path, $data);
    }

    protected function getModel($model)
    {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    protected function getMiddleware($middleware)
    {
        require_once __DIR__ . '/../middlewares/' . $middleware . '.php';
        return new $middleware();
    }
}

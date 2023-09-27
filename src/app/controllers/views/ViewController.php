<?php

require_once __DIR__ . '/../Controller.php';

abstract class ViewController extends Controller
{  
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    abstract protected function getData($params);

    public function index($params)
    {
        $view = $this->getView($this->getData($params));
        $view->render();
    } 
}

<?php

require_once __DIR__ . '/../Controller.php';

abstract class ViewController extends Controller
{  
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    abstract public function getData();

    public function index()
    {
        $view = $this->getView($this->getData());
        $view->render();
    } 
}

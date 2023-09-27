<?php

require_once __DIR__ . '/ViewController.php';

class HomeController extends ViewController
{    
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
    
    public function getData()
    {
        return [];
    }

    public function index()
    {
        $view = $this->getView($this->getData());
        $view->render();
    } 
}

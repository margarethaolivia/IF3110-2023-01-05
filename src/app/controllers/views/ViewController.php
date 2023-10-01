<?php

require_once __DIR__ . '/../Controller.php';

abstract class ViewController extends Controller
{  
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    abstract protected function getData($params);

    protected function getView($data = [])
    {
        require_once __DIR__ . '/../../views/template/view.php';
        return new View($this->getFolderPath(), $data);
    }

    public function index($params)
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $view = $this->getView($this->getData($params));
                $view->render();
                break;

            default:
                $this->notAllowedResponse();
        }
    } 
}

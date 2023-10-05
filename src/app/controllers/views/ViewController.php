<?php

require_once APP_PATH . '/controllers/Controller.php';

abstract class ViewController extends Controller
{  
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    abstract protected function getData($params);

    protected function getView($data = [])
    {
        require_once APP_PATH . '/views/template/view.php';
        return new View($this->getFolderPath(), $data);
    }

    protected function renderForbiddenPage($data)
    {
        $data['isPlainPage'] = true;
        $data['style_paths'] = ['template/403.css'];
        $view = new View('/error', $data);
        $view->render();
        exit;
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

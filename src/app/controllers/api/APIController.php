<?php

require_once __DIR__ . '/../Controller.php';

abstract class APIController extends Controller
{  
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function GET($params)
    {
        $this->notAllowedResponse();

    }
    protected function POST($params)
    {
        $this->notAllowedResponse();
    }

    protected function PUT($params)
    {
        $this->notAllowedResponse();
    }
    
    protected function PATCH($params)
    {
        $this->notAllowedResponse();
    }

    protected function DELETE($params)
    {
        $this->notAllowedResponse();
    }

    public function index($params)
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->GET($params);
                break;
            
            case 'POST':
                $this->POST($params);
                break;

            case 'PUT':
                $this->PUT($params);
                break;
            
            case 'PATCH':
                $this->PATCH($params);
                break;

            case "DELETE":
                $this->DELETE($params);
                break;
        } 
    }
}

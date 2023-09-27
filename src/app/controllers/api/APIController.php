<?php

require_once __DIR__ . '/../Controller.php';

abstract class APIController extends Controller
{  
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function GET()
    {
        $this->notAllowedResponse();

    }
    protected function POST()
    {
        $this->notAllowedResponse();
    }

    protected function PUT()
    {
        $this->notAllowedResponse();
    }
    
    protected function PATCH()
    {
        $this->notAllowedResponse();
    }

    protected function DELETE()
    {
        $this->notAllowedResponse();
    }

    public function index($params)
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->GET();
                break;
            
            case 'POST':
                $this->POST();
                break;

            case 'PUT':
                $this->PUT();
                break;
            
            case 'PATCH':
                $this->PATCH();
                break;

            case "DELETE":
                $this->DELETE();
                break;
        } 
    }
}

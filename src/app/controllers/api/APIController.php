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
                $data = $this->GET($params);
                break;
            
            case 'POST':
                $data = $this->POST($params);
                break;

            case 'PUT':
                $data = $this->PUT($params);
                break;
            
            case 'PATCH':
                $data = $this->PATCH($params);
                break;

            case "DELETE":
                $data = $this->DELETE($params);
                break;
        } 

        $response = array(
            'message' => $data['message'],
            'data' => $data['data']
        );
    
        // Set the content type to JSON
        header('Content-Type: application/json');
        // Set the HTTP status code
        http_response_code($data['code']);
    
        // Encode the array into JSON format and echo it
        echo json_encode($response);
    
    }

    static public function response($message, $code=200, $data=null)
    {
        return [
            'message' => $message,
            'code' => $code,
            'data' => $data
        ];
    }
}

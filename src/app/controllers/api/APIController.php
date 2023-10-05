<?php

require_once APP_PATH . '/controllers/Controller.php';

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

    protected function getBody()
    {
        return json_decode(file_get_contents("php://input"), true);
    }

    protected function getAuthorizationHeader() {
        $headers = getallheaders();
        foreach ($headers as $name => $value) {
            if (strtolower($name) == 'authorization') {
                return $value;
            }
        }
        return null;
    }

    protected function checkRequiredField($request_data, $required_fields, $returnMissingField=false)
    {
        foreach ($required_fields as $field) {
            if (!array_key_exists($field, $request_data)) {
                if ($returnMissingField) return $field;
                $this->sendResponse(self::response('Missing required field: ' . $field, 400));
            }
        }

        return null;
    }

    public function index($params)
    {
        $data = [];
        
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

            default:
                $this->notAllowedResponse();
        } 

        $this->sendResponse($data);
    
    }

    protected function extractCredentialsFromHeader() {

        $authorizationHeader = $this->getAuthorizationHeader();

        if ($authorizationHeader) {
            try {
                // Remove the 'Basic ' prefix
                $base64Credentials = substr($authorizationHeader, 6);
                
                // Decode the base64-encoded credentials
                $credentials = base64_decode($base64Credentials);
                
                // Split into username and password
                list($username, $password) = explode(':', $credentials, 2);
                
                return [
                    'username' => $username,
                    'password' => $password,
                ];
            }

            catch (Exception $e)
            {
                return $this->response('Invalid authorization header', 400);
            }
        }
    
        return null;
    }
}

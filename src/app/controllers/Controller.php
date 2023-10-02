<?php

abstract class Controller
{   
    private $folder_path;

    public function __construct($folder_path)
    {
        $this->folder_path = $folder_path;
    }

    abstract public function index($params);

    protected function getFolderPath() {
        return $this->folder_path;
    }

    protected function sendResponse($data)
    {
        $response = array(
            'message' => $data['message'],
            'data' => $data['body']
        );
    
        // Set the HTTP status code
        http_response_code($data['code']);
    
        // Encode the array into JSON format and echo it
        echo json_encode($response);
        exit;
    }

    protected function notAllowedResponse() {
        $data = self::response('Unsupported HTTP method', 405);
        $this->sendResponse($data);
   
    }

    protected function getMiddleware($middleware)
    {
        require_once __DIR__ . '/../middlewares/' . $middleware . '.php';
        return new $middleware();
    }

    static public function response($message, $code=200, $body=null)
    {
        return [
            'message' => $message,
            'code' => $code,
            'body' => $body
        ];
    }
}

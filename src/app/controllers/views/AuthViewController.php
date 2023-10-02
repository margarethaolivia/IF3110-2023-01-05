<?php

require_once __DIR__ . '/ViewController.php';
require_once __DIR__ . '/../../middlewares/sessionMiddleware.php';

abstract class AuthViewControler extends ViewController
{  
    private $sessionMiddleware;
    abstract protected function getData($params);

    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
        $this->sessionMiddleware = new SessionMiddleware();
    }

    abstract protected function authorize();

    protected function getSessionMiddleware()
    {
        return $this->sessionMiddleware;
    }
    
    protected function redirectToLogIn()
    {
        $redirect_value = $_SERVER['PATH_INFO'] ?? "/";
        
        header("Location: " . BASE_URL . "/login?redirect=" . $redirect_value, true, 302);
        exit();
    }

    public function index($params)
    { 
        try {
            $this->authorize();
        }

        catch (Exception) {
            $this->redirectToLogIn();
        }

        parent::index($params);
    } 
}

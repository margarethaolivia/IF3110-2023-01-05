<?php
include_once (APP_PATH . '/services/UserService.php');

class SessionMiddleware
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    private function getUser()
    {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Unauthorized', 401);
        }

        return $this->userService->getUserById($_SESSION['user_id']);
    }

    private function sendUnauthorizedResponse()
    {
        $response = array(
            'message' => 'Unauthorized',
            'body' => null
        );
    
        // Set the HTTP status code
        http_response_code(401);
    
        // Encode the array into JSON format and echo it
        echo json_encode($response);
        exit;
    }

    public function authorizeUser()
    {
        $user = $this->getUser();

        if (!$user) {
            $this->sendUnauthorizedResponse();
        }

        return $user;
    }

    public function authorizeAdmin()
    {
        $user = $this->getUser();

        if (!$user || !$user->is_admin) {
            $this->sendUnauthorizedResponse();
        }

        return $user;
    }
}

<?php
include(__DIR__ . '/../services/UserService.php');

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

        return $this->userService->getUser($_SESSION['user_id']);
    }

    public function authenticateUser()
    {
        $user = $this->getUser();

        if (!$user) {
            throw new Exception('Unauthorized', 401);
        }
    }

    public function authenticateAdmin()
    {
        $user = $this->getUser();

        if (!$user || !$user->is_admin) {
            throw new Exception('Unauthorized', 401);
        }
    }
}

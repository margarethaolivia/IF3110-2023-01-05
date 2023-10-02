<?php
include_once (__DIR__ . '/../services/UserService.php');

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

    public function authorizeUser()
    {
        $user = $this->getUser();

        if (!$user) {
            throw new Exception('Unauthorized', 401);
        }

        return $user;
    }

    public function authorizeAdmin()
    {
        $user = $this->getUser();

        if (!$user || !$user->is_admin) {
            throw new Exception('Unauthorized', 401);
        }

        return $user;
    }
}

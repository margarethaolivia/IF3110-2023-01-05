<?php
include_once APP_PATH . '/controllers/api/APIController.php';
include_once APP_PATH . '/services/UserService.php';

class LogInController extends APIController {

    private $userService;

    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
        $this->userService = new UserService();
    }

    protected function POST($params)
    {
        // Check if all required fields are present

        $credentials = $this->extractCredentialsFromHeader();
        $username = $credentials['username'];
        $password = $credentials['password'];
        if (!($username && $password)) return $this->response('Missing username or password', 400);

        // Fetch hashed password from the database
        $user = null;

        try {
            $user = $this->userService->getUserByUsername($username);
        }
        
        catch (Exception $e)
        {
            $this->sendResponseOnError($e);
        }

        if (!$user || !password_verify($password, $user->pass)) {
            // Incorrect username or password
            return self::response('Incorrect username or password', 401);
        }

        // Set session (assuming you have started the session)
        session_start();
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['profile_pic'] = $user->profile_pic;
        $_SESSION['is_admin'] = $user->is_admin;

        // Set a cookie (adjust parameters as needed)
        setcookie('user', $username, time() + 3600, '/');

        // Redirect the user based on the value in query parameters
        $redirect_value = isset($_GET['redirect']) ? $_GET['redirect'] : '';
        
        header("Location: " . BASE_URL . "/" . ltrim($redirect_value, '/'), true, 302);
        exit();
    }
    
}
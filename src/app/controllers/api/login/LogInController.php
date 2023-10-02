<?php
include_once __DIR__ . '/../APIController.php';
include_once __DIR__ . '/../../../services/UserService.php';

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
        $user = $this->userService->getUserByUsername($username);

        if (!$user || !password_verify($password, $user->pass)) {
            // Incorrect username or password
            return self::response('Incorrect username or password', 401);
        }

        // Set session (assuming you have started the session)
        $_SESSION['user'] = $username;

        // Set a cookie (adjust parameters as needed)
        setcookie('user', $username, time() + 3600, '/');

        // Redirect the user based on the value in query parameters
        $redirect_value = isset($params['redirect']) ? $params['redirect'] : '';
        header("Location: /$redirect_value");
        exit;
    }
    
}
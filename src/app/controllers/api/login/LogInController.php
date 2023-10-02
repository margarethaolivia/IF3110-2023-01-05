<?php
include_once __DIR__ . '/../APIController.php';
include_once __DIR__ . '/../../../services/UserService.php';

class LogInController extends APIController {

    private $userService;

    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
        $userService = new UserService();
    }

    protected function POST($params)
    {
        // Assuming you have a database connection
        // $pdo = new PDO(...);

        $request_data = $this->getUrlParams();

        // Check if all required fields are present
        $required_fields = ['username', 'password'];
        $this->checkRequiredField($request_data, $required_fields);

        $username = $request_data['username'];
        $password = $request_data['password'];

        // Fetch hashed password from the database
        $hashed_password = $this->userService->get($username);

        if (!$hashed_password || !password_verify($password, $hashed_password)) {
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
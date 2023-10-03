<?php
include_once APP_PATH . '/controllers/api/APIController.php';
include_once APP_PATH . '/utils/SessionHelper.php';

class UserController extends APIController {
    private $userService;

    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
        $this->userService = $this->getService('UserService');
    }

    protected function POST($param)
    {
       
        $request_data = $this->getBody();
        $credentials = $this->extractCredentialsFromHeader();
        $username = $credentials['username'];
        $password = $credentials['password'];
        
        $request_data['username'] = $username;
        $request_data['password'] = $password;
        
        if (!isset($request_data['last_name']))
        {
            $request_data['last_name'] = '';
        }

        // Check if all required fields are present
        $required_fields = ['username', 'password', 'first_name'];
        $missing_field = $this->checkRequiredField($request_data, $required_fields);

        if ($missing_field)
        {
            return self::response('Missing required field: ' . $missing_field, 400);
        }

        // Check if username only consists of characters and underscore
        $username = $request_data['username'];
        if (!$this->userService->isUsernameValid($username)) {
            return self::response('Invalid username: max 20 characters and only consists of alphabets, numbers, and underscores', 400);
        }

        $password = $request_data['password'];
        
        // Check if password meets the specified criteria
        if (!$this->userService->isPasswordValid($password)) {
            return self::response('Invalid password format', 400);
        }

        // Check if concatenation of firstname and lastname doesn't exist in the database
        $firstname = $request_data['first_name'];
        $lastname = $request_data['last_name'] ?? '';

        if (strlen($firstname) == 0)
        {
            return self::response('First name can not be empty', 400);
        }

        try {
            if ($this->userService->isUsernameExists($username)) {
                return self::response('Username is already taken', 400);
            }
    
    
            if ($this->userService->isFullNameExists($firstname, $lastname)) {
                return self::response('Combination of firstname and lastname already exists', 400);
            }
    
            // Additional checks or actions can be added as needed
    
            // If all checks pass, you can proceed with creating the user account
            
     
            $user_id = $this->userService->createUser($request_data);
            $user = $this->userService->getUserById($user_id);
            $helper = new SessionHelper();
            $helper->startSession($user);
            
            $redirect_value = isset($_GET['redirect']) ? $_GET['redirect'] : '';
            header("Location: " . BASE_URL . "/" . ltrim($redirect_value, '/'), true, 302);
            exit();
        }
        
        catch (Exception $e)
        {
            $this->sendResponseOnError($e);
        }
    }
}
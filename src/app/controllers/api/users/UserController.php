<?php
include_once __DIR__ . '/../APIController.php';

class UserController extends APIController {
    private $userService;

    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
        $userService = new UserService();
    }

    private function isUsernameValid($username)
    {
        return preg_match('/^[A-Za-z_]+$/', $username);
    }

    private function isPasswordMatch($password, $confirmPassword)
    {
        return $password == $confirmPassword;
    }

    private function isPasswordValid($password)
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,20}$/', $password);
    }
    protected function POST($param)
    {
        $request_data = $this->getUrlParams();

        // Check if all required fields are present
        $required_fields = ['username', 'password', 'confirmpassword', 'firstname'];
        $this->checkRequiredField($request_data, $required_fields);

        // Check if username only consists of characters and underscore
        $username = $request_data['username'];
        if ($this->isUsernameValid($username)) {
            return self::response('Invalid characters in the username', 400);
        }

        // Check if password and confirmpassword match
        $password = $request_data['password'];
        $confirm_password = $request_data['confirmpassword'];
        if ($this->isPasswordMatch($password, $confirm_password)) {
            return self::response('Password and Confirm Password do not match', 400);
        }

        // Check if password meets the specified criteria
        if (!$this->isPasswordValid($password)) {
            return self::response('Invalid password format', 400);
        }

        // Check if concatenation of firstname and lastname doesn't exist in the database
        $firstname = $request_data['firstname'];
        $lastname = $request_data['lastname'];

        if ($this->userService->isFullNameExists($firstname, $lastname)) {
            return self::response('Combination of firstname and lastname already exists', 400);
        }

        // Additional checks or actions can be added as needed

        // If all checks pass, you can proceed with creating the user account
        // $this->userService->createUser($username, $password, $firstname, $lastname);

        // Respond with success message

        return self::response('User account created successfully');
    }
}
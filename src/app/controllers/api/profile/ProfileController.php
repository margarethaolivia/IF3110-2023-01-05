<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class ProfileController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function POST($params)
    {
        $sessionMiddleware = $this->getMiddleware('SessionMiddleware');
        $user = $sessionMiddleware->authorizeUser();
        $request_body = $this->getBody();

        $userService = $this->getService('UserService');
        $user_id = $user->user_id;

        if (isset($request_body['first_name']))
        {

            if (strlen($request_body['first_name']) == 0)
            {
                return self::response("First name can not be empty", 400);
            }

            if ($userService->isFullNameExists($request_body['first_name'], ($request_body['last_name'] ?? '')))
            {
                return self::response("Combination of firstname and lastname already exists", 400);
            }
        }

        if (isset($request_body['old_password']) ^ isset($request_body['new_password']))
        {
            return self::response("Old and new password must be filled", 400);
        }

        if (isset($request_body['old_password']) && isset($request_body['new_password']))
        {
            if (!password_verify($request_body['old_password'], $user->pass))
            {
                return self::response("Old password incorrect", 401);
            }

            if (!$userService->isPasswordValid($request_body['new_password']))
            {
                return self::response("New password invalid format", 400);
            }

            if ($request_body['old_password'] == $request_body['new_password'])
            {
                return self::response("New password must be different", 400);
            }

            $request_body['pass'] = $request_body['new_password'];
        }

        try {
            $userService->updateUser($user_id, $request_body);

            return self::response("User data changed");
        }   

        catch (Exception $e)
        {
            $this->sendResponseOnError($e);
        }
    }
}
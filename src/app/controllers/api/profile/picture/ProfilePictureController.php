<?php
include_once APP_PATH . '/controllers/api/APIController.php';
include_once APP_PATH . '/middlewares/SessionMiddleware.php';
include_once APP_PATH . '/services/UserService.php';

class ProfilePictureController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function POST($params)
    {
        $sessionMiddleware = new SessionMiddleware();
        $user = $sessionMiddleware->authorizeUser();

        $userService = new UserService();
        $user_id = $user->user_id;
        $extension = '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $route = "/images/profile/$user_id/pic" . $extension;
        $path = BASE_URL . $route;
        $filepath = PUBLIC_PATH . $route;

        $directory = pathinfo($filepath, PATHINFO_DIRNAME);

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $existingFiles = glob("$directory/*");

        foreach ($existingFiles as $existingFile) {
            unlink($existingFile);
        }

        move_uploaded_file($_FILES['file']['tmp_name'], $filepath);

        if (count($existingFiles) == 0)
        {
            $userService->addProfilePicture($user->user_id, $path);
        }

        $_SESSION['profile_pic'] = $path;

        return self::response("Profile picture changed", body: ['path' => $path, 'exist' => $existingFiles]);
    }
}
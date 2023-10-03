<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class ProfilePictureController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function POST($params)
    {
        $sessionMiddleware = $this->getMiddleware('SessionMiddleware');
        $user = $sessionMiddleware->authorizeUser();

        if (!isset($_FILES['profile_pic'])|| $_FILES['profile_pic']['error'] !== UPLOAD_ERR_OK || $_FILES['profile_pic']['size'] === 0) {
            return self::response('Profile picture is required', 400);
        }

        if ($_FILES['profile_pic']['size'] > IMAGE_MAX_SIZE) {
            return self::response('Profile picture size exceeds the limit', 400);
        }

        $userService = $this->getService('UserService');
        $user_id = $user->user_id;
        $extension = '.' . pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
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

        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $filepath);
        $userService->addProfilePicture($user->user_id, $path);

        $_SESSION['profile_pic'] = $path;

        return self::response("Profile picture changed", body: ['path' => $path, 'exist' => $existingFiles]);
    }
}
<?php
include_once APP_PATH . '/controllers/api/APIController.php';
include_once APP_PATH . '/utils/file/ProfilePicHandler.php';

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
        
        $handler = new ProfilePicHandler();
        $dateTimeString = $handler->getCurrentDateTimeStringExtension();
        $filepath = $handler->getFilePath($user_id, $extension, $dateTimeString);

        $directory = pathinfo($filepath, PATHINFO_DIRNAME);

        $existingFiles = glob("$directory/*");

        foreach ($existingFiles as $existingFile) {
            unlink($existingFile);
        }

        $path = $handler->writeFile($user_id, $extension, 'profile_pic', $dateTimeString);
        $userService->addProfilePicture($user->user_id, $path);

        $_SESSION['profile_pic'] = $path;

        return self::response("Profile picture changed", body: ['path' => $path, 'exist' => $existingFiles]);
    }
}
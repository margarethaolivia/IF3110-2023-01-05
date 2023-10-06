<?php
include_once APP_PATH . '/controllers/api/APIController.php';
include_once APP_PATH . '/utils/file/FileManager.php';

class MySpecificVideoAPIController extends APIController {

    private $fileManager;

    public function __construct($folder_path)
    {
        parent::__construct($folder_path);

        $this->fileManager = new FileManager();
    }

    protected function POST($params)
    {
        $user = $this->getMiddleware('SessionMiddleware')->authorizeuser();
        $user_id = $user->user_id;
        $request_data = [];
        $video_id = $params[0];
    
        // Check if title is empty
        if (empty($_POST['title'])) {
            return self::response('Title is required', 400);
        }

        if ($_FILES['thumbnail']['size'] > IMAGE_MAX_SIZE) {
            return self::response('Thumbnail size exceeds the limit', 400);
        }

        $tagService = $this->getService('TagService');
        $tags = !empty($_POST['tags']) ? $_POST['tags'] : [];


        try {
            $tagService->isTagsValid($tags);
        }

        catch (Exception $e)
        {
            return self::response($e->getMessage(), 400);
        }
    
        $request_data['title'] = $_POST['title'];
        $request_data['video_desc'] = $_POST['video_desc'] ?? '';

        $videoService = $this->getService('VideoService');

        try {
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK && $_FILES['thumbnail']['size'] > 0) {
                
                $thumbnailExtension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
                $video = $videoService->getVideoById($video_id);

                $manager = new FileManager();
                $manager->deleteFile($video->thumbnail, 'thumbnail', false);
                $thumbnailPath = $manager->writeFile($video_id, $thumbnailExtension, 'thumbnail');

                $request_data['thumbnail'] = $thumbnailPath;
            }

            $videoService->updateVideo($video_id, $request_data, user_id: $user_id);
            $tagService->updateVideoTags($video_id, $tags);
    
            return self::response('Video is edited', 200);
    
        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }

    protected function DELETE($params)
    {
        $sessionMiddleware = $this->getMiddleware('SessionMiddleware');
        $user = $sessionMiddleware->authorizeUser();
        $user_id = $user->user_id;
        $video_id = $params[0];
    
        try {
            $videoService = $this->getService('VideoService');
            $video = $videoService->getVideoById($video_id);
            $videoService->deleteVideoById($user_id, $video_id);

            $this->fileManager->deleteFile($video->video_file, 'video_file');
            $this->fileManager->deleteFile($video->thumbnail, 'thumbnail');
            return self::response('Video is deleted', 200);
    
        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }
}
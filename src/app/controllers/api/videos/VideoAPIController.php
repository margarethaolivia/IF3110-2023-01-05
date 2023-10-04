<?php
include_once APP_PATH . '/controllers/api/APIController.php';
include_once APP_PATH . '/utils/file/FileManager.php';

class VideoAPIController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function GET($param) {
        try {
            $videoService = $this->getService('VideoService');
            $videos = $videoService->getAllVideo(1);

            return self::response('Videos is fetched', 200, ['videos' => $videos]);
    
        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }

    protected function POST($param) {
        $user = $this->getMiddleware('SessionMiddleware')->authorizeuser();
        $user_id = $user->user_id;
        $request_data = [];
    
        // Check if title is empty
        if (empty($_POST['title'])) {
            return self::response('Title is required', 400);
        }
    
        // Check if thumbnail is in form data
        if (!isset($_FILES['video_file'])|| $_FILES['video_file']['error'] !== UPLOAD_ERR_OK || $_FILES['video_file']['size'] === 0) {
            return self::response('Video is required', 400);
        }
    
        // Check if thumbnail is in form data
        if (!isset($_FILES['thumbnail'])|| $_FILES['thumbnail']['error'] !== UPLOAD_ERR_OK || $_FILES['thumbnail']['size'] === 0) {
            return self::response('Thumbnail is required', 400);
        }
        
        // Check video file size
        if ($_FILES['video_file']['size'] > VIDEO_MAX_SIZE) {
            return self::response('Video size exceeds the limit', 400);
        }

        if ($_FILES['thumbnail']['size'] > IMAGE_MAX_SIZE) {
            return self::response('Thumbnail size exceeds the limit', 400);
        }
    
        $request_data['user_id'] = $user_id;
        $request_data['title'] = $_POST['title'];
        $request_data['video_desc'] = $_POST['video_desc'] ?? '';
        $request_data['is_official'] = $user->is_admin;

    
        try {
            $videoService = $this->getService('VideoService');
            $video_id = $videoService->createVideo($request_data);
    
            $thumbnailExtension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
            $videoExtension = pathinfo($_FILES['video_file']['name'], PATHINFO_EXTENSION);

            $manager = new FileManager();
            $videoPath = $manager->writeFile($video_id, $videoExtension, 'video_file');
            $thumbnailPath = $manager->writeFile($video_id, $thumbnailExtension, 'thumbnail');

            $videoService->updateVideo(
                $user_id, 
                $video_id, 
                [
                    'thumbnail' => $thumbnailPath, 
                    'video_file' => $videoPath
                ]
            );
    
            return self::response('Video is uploaded', 201);
    
        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }
}
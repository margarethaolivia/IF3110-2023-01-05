<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class VideoAPIController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
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
        if (!isset($_FILES['thumbnail'])) {
            return self::response('Thumbnail is required', 400);
        }
    
        // Check if video_file is in form data
        if (!isset($_FILES['video_file'])) {
            return self::response('Video is required', 400);
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
    
            $thumbnailRoute = "/images/thumbnails/$video_id/pic.$thumbnailExtension";
            $videoRoute = "/videos/$video_id/vid.$videoExtension"; 
    
            $thumbnailPath = BASE_URL . $thumbnailRoute;
            $videoPath = BASE_URL . $videoRoute;
            
            $thumbnailFilePath = PUBLIC_PATH . $thumbnailRoute;
            $videoFilePath = PUBLIC_PATH . $videoRoute;
    
            $thumbnailDirectory = pathinfo($thumbnailFilePath, PATHINFO_DIRNAME);
    
            if (!is_dir($thumbnailDirectory)) {
                mkdir($thumbnailDirectory, 0777, true);
            }

            
            $videoDirectory = pathinfo($videoFilePath, PATHINFO_DIRNAME);
            if (!is_dir($videoDirectory)) {
                mkdir($videoDirectory, 0777, true);
            }

            // Move uploaded files to destination
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnailFilePath);
            move_uploaded_file($_FILES['video_file']['tmp_name'], $videoFilePath);

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

    protected function GET($params)
    {
        $request_data = $this->getBody();
        try {
            $videoService = $this->getService('VideoService');
            $videoService->getVideoById($request_data);            
            $redirect_value = isset($_GET['redirect']) ? $_GET['redirect'] : '';
            header("Location: " . BASE_URL . "/videos/" . ltrim($request_data, '/'), true, 302);
            exit();
        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }
}
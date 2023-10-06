<?php
include_once APP_PATH . '/controllers/api/APIController.php';
include_once APP_PATH . '/utils/OutputHandler.php';

class MyVideoAPIController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function GET($params)
    {
        $sessionMiddleware = $this->getMiddleware('SessionMiddleware');
        $user = $sessionMiddleware->authorizeUser();
        $page = intval($_GET['page'] ?? 1);

        $outputHandler =  new OutputHandler();

        try {
            $videoService = $this->getService('VideoService');
            
            $videos = $videoService->getUserVideos($user->user_id, $page);

            $body = [];
            $html = "";

            $totalPage = 1;

            foreach ($videos as $video)
            {
                if ($totalPage === 1 && $video->total_page > 1)
                {
                    $totalPage = $video->total_page;
                }
                $html = $html . $outputHandler->outputComponentAsString(
                    'videoCard', 
                    APP_PATH . '/components/elements/videoCard.php', 
                    [
                        'video' => $video, 
                        'noUser' => true, 
                        'settings' => true, 
                        'editLink' => "/myvideos/edit/" . $video->video_id,
                        'deleteAction' => "deleteMyVideo(event, " . $video->video_id . ", 'popup-delete-video')",
                        'cardId' => 'card-' . $video->video_id, 
                        'showTakeDown' => false
                    ]
                );
            }
            
            $paginationHTML = $outputHandler->outputComponentAsString(
                'pagination', 
                APP_PATH . '/components/elements/pagination.php', 
                ['maxNum' => $totalPage, 'currentPage' => $page]
            );

            $body['video_list_html'] = $html;
            $body['pagination_html'] = $paginationHTML;
            $body['total_page'] = $totalPage;

            return self::response('HTML fetched', 200, $body);
    
        } catch (Exception $e) {
            $this->sendResponseOnError($e);
        }
    }
}
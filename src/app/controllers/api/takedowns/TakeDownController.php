<?php
include_once APP_PATH . '/controllers/api/APIController.php';
include_once APP_PATH . '/utils/OutputHandler.php';

class TakeDownController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function GET($param) {

        $user = $this->getMiddleware('SessionMiddleware')->authorizeAdmin();

        $page = intval($_GET['page'] ?? 1);

        $outputHandler =  new OutputHandler();

        try {
            $videoService = $this->getService('VideoService');
            $videos = $videoService->getTakedowns($user->user_id, $page);

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
                    'takedownRow', 
                    APP_PATH . '/components/takedowns/takedownRow.php', 
                    ['video' => $video]
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
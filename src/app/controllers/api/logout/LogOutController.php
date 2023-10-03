<?php
include_once APP_PATH . '/controllers/api/APIController.php';
include_once APP_PATH . '/utils/SessionHelper.php';

class LogOutController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function POST($params)
    {
        $helper = new SessionHelper();
        $helper->terminateSession();
        header("Location: " . BASE_URL, 302);
        exit();
    }
}
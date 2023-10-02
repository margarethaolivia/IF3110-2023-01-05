<?php
include_once APP_PATH . '/controllers/api/APIController.php';

class VideoAPIController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
}
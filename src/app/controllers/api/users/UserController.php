<?php
include_once __DIR__ . '/../APIController.php';

class UserController extends APIController {
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }
}
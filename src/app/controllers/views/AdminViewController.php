<?php

require_once APP_PATH . '/controllers/views/AuthViewController.php';

abstract class AdminViewController extends AuthViewController
{  
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    protected function authorize()
    {
        $user = $this->getSessionMiddleware()->authorizeUser(true);

        if (!$user->is_admin) {
            $this->renderForbiddenPage([
                'title' => 'Forbidden Page - WeTube',
                'link' => '/', 
                'src' => BASE_URL . '/images/webp/403.webp', 
                'desc' => 'This page can only be accessed by admin.'   
            ]);
            exit;
        }
    }
}
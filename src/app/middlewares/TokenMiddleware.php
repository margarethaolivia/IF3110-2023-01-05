<?php

class TokenMiddleware
{
    public function setCSRFToken()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
        }
    }

    public function validateCSRFToken()
    {
        $token = $_REQUEST['csrf_token'];

        if (!$token) {
            throw new Exception('CSRF Token not Set', 400);
        }

        if ($token !== $_SESSION['csrf_token'])
        {
            throw new Exception('Forbidden Access', 403);
        }
    }
}

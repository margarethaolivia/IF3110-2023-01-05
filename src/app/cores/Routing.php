<?php
require_once __DIR__ . '/Router.php';
require_once APP_PATH . '/utils/PatternHandler.php';

$router = new Router();
$PARAM_PATTERN = PatternHandler::URL_PARAM_PATTERN;

// ROUTING FOR VIEWS

// Define routes using regular expressions
$router->add([
    'pattern' => '#^/$#', // Match the root URL,
    'controller' => 'HomeController',
]);

$router->add([
    'pattern' => '#^/signup$#', // Match "/about"
    'controller' => 'SignUpController'
]);

$router->add([
    'pattern' => '#^/login$#', // Match "/about"
    'controller' => 'LogInController'
]);

$router->add([
    'pattern' => '#^/profile$#', // Match "/profile"
    'controller' => 'ProfileController'

]);

$router->add([
    'pattern' => "#^/myvideos$#", // Match "/myvideos"
    'controller' => 'MyVideosController'
]);


$router->add([
    'pattern' => "#^/myvideos/edit/$PARAM_PATTERN$#", // Match "/myvideos/edit/{video_id}"
    'controller' => 'VideoEditController'
]);

$router->add([
    'pattern' => "#^/videos/$PARAM_PATTERN$#", // Match "/videos/{video_id}"
    'controller' => 'VideoController',
]);

$router->add([
    'pattern' => "#^/videos/upload$#", // Match "/videos/upload"
    'controller' => 'VideoUploadController'
]);

$router->add([
    'pattern' => "#^/takedowns$#", // Match "/videos/upload"
    'controller' => 'TakeDownController'
]);


// ROUTING FOR API

$router->add([
    'pattern' => "#^/api/users$#", // Match "/api/videos"
    'controller' => 'UserController'
]);

$router->add([
    'pattern' => "#^/api/users/$PARAM_PATTERN$#", // Match "/api/videos"
    'controller' => 'SpecificUserController'
]);

$router->add([
    'pattern' => "#^/api/videos$#", // Match "/api/videos"
    'controller' => 'VideoAPIController'
]);

$router->add([
    'pattern' => "#^/api/login$#", // Match "/api/videos"
    'controller' => 'LogInController'
]);

$router->add([
    'pattern' => "#^/api/logout$#", // Match "/api/videos"
    'controller' => 'LogOutController'
]);

$router->add([
    'pattern' => "#^/api/profile/picture$#", // Match "/profile/picture"
    'controller' => 'ProfilePictureController'
]);


$router->index();
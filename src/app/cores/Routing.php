<?php
require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/../utils/PatternHandler.php';

$router = new Router();
$PARAM_PATTERN = PatternHandler::URL_PARAM_PATTERN;

// ROUTING FOR VIEWS

// Define routes using regular expressions
$router->add([
    'pattern' => '#^/$#', // Match the root URL,
    'controller' => 'HomeController',
]);

$router->add([
    'pattern' => '#^/signin$#', // Match "/about"
]);

$router->add([
    'pattern' => '#^/login$#', // Match "/about"
]);

$router->add([
    'pattern' => '#^/profile$#', // Match "/profile"
    'controller' => 'ProfileController'

]);

$router->add([
    'pattern' => "#^/myvideos/$PARAM_PATTERN$#", // Match "/myvideos/{video_id}"
]);

$router->add([
    'pattern' => "#^/videos$#", // Match "/videos"
]);

$router->add([
    'pattern' => "#^/videos/$PARAM_PATTERN$#", // Match "/videos/{video_id}"
    'controller' => 'VideoController',
]);

$router->add([
    'pattern' => "#^/videos/edit/$PARAM_PATTERN$#", // Match "/videos/edit/{video_id}"
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
    'pattern' => "#^/api/videos$#", // Match "/api/videos"
    'controller' => 'VideoAPIController'
]);

$router->index();
<?php
require_once __DIR__ . '/../utils/PatternHandler.php';
require_once __DIR__ . '/../views/template/404.php';

class Router {
    private $routes;
    const API_ROUTE_PATTERN = '/^\/api\//';

    public function __construct()
    {
        $this->routes = [];
    }

    public function add($route) {
        $this->routes[] = $route;
    }

    public function index()
    {
        $requestUri = $_SERVER['REQUEST_URI'];

        foreach ($this->routes as $route) {
            $pattern = $route['pattern'];

            // Check if the request URI matches the pattern
            if (preg_match($pattern, $requestUri, $matches)) {

                // Remove the first element (full match)
                array_shift($matches);

                $controllerName = $route['controller'];

                $patternHandler = new PatternHandler();
                $folder_path = $patternHandler->convertPatternToPath($pattern);
                
                // Include the controller file

                if (preg_match(ROUTER::API_ROUTE_PATTERN, $requestUri))
                {
                    // Include api controller file
                    require_once __DIR__ . "/../controllers$folder_path/$controllerName.php";
                }

                else
                {
                    // Include view controller file
                    require_once __DIR__ . "/../controllers/views$folder_path/$controllerName.php";
                }

                // Create an instance of the controller
                $controller = new $controllerName($folder_path);
      
                // Call the controller's action method with the matched parameters
                call_user_func_array([$controller, "index"], [$matches]);

                // Exit the loop since we found a matching route

                return;
            }
        }

        // If no matching route is found, you can handle a 404 error here.
        // For example, you can include a 404 error page.
        notFound();
    }

}
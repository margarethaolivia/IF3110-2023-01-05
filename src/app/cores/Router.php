<?php
require_once APP_PATH . '/utils/PatternHandler.php';
require_once APP_PATH . '/views/template/404.php';

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
        $requestPath = $_SERVER['PATH_INFO'] ?? "/";

        if (strlen($requestPath) > 1 && substr($requestPath, -1) === '/') {
            // Remove the trailing "/" and create the new URL
            $newUrl = rtrim($requestPath, '/');

            // Parse the URL to get the query string
            $urlComponents = parse_url($_SERVER['REQUEST_URI']);
            $queryString = isset($urlComponents['query']) ? $urlComponents['query'] : '';
            // Parse the query string to get the parameters
            parse_str($queryString, $queryParams);
            
            if (!empty($queryParams)) $newUrl = $newUrl . '?' . http_build_query($queryParams);

            // Perform the redirection
            header("Location: $newUrl", true, 301);
            exit;
        }

        foreach ($this->routes as $route) {
            $pattern = $route['pattern'];

            // Check if the request URI matches the pattern
            if (preg_match($pattern, $requestPath, $matches)) {

                // Remove the first element (full match)
                array_shift($matches);

                $controllerName = $route['controller'];

                $patternHandler = new PatternHandler();
                $folder_path = $patternHandler->convertPatternToPath($pattern);
                
                // Include the controller file

                if (preg_match(ROUTER::API_ROUTE_PATTERN, $requestPath))
                {
                    // Include api controller file
                    require_once APP_PATH . "/controllers$folder_path/$controllerName.php";
                }

                else
                {
                    // Include view controller file
                    require_once APP_PATH . "/controllers/views$folder_path/$controllerName.php";
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
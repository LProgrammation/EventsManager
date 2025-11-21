<?php 

namespace Src\cores;

use Src\Enums\RoutesEnum as Routes; 

class Router {
    /**
     * Dispatch the request to the appropriate controller and action
     * @param mixed $Database
     * @return void
     */
    public static function dispatch($Database = null) {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routesEnum = new Routes();
        $routes = $routesEnum->getRoutes();
        if (in_array($uri, array_keys($routes))) {
            $route = $routes[$uri];
            if (in_array($method, $route['methods'])) {
                $controllerName = '\\Src\\Controllers\\' . $route['controller'];
                $actionName = $route['action'];
                if (class_exists($controllerName)) {
                    $controller = new $controllerName($Database);
                    if (method_exists($controller, $actionName)) {
                        return call_user_func_array([$controller, $actionName], []);
                    }
                }
            }
        }
        foreach ($routes as $pattern => $route) {
            if (strpos($pattern, '{') === false) {
                continue;
            }
            preg_match_all('/\{(\w+)\}/', $pattern, $paramNameMatches);
            $paramNames = $paramNameMatches[1] ?? [];

            $regex = preg_replace_callback('/\{(\w+)\}/', function($m) {
                return '(?P<' . $m[1] . '>[^/]+)';
            }, $pattern);
            $regex = '#^' . $regex . '$#';
            if (preg_match($regex, $uri, $matches)) {
                if (!in_array($method, $route['methods'])) {
                    break; 
                }
                $params = [];
                foreach ($paramNames as $name) {
                    $params[] = $matches[$name] ?? null;
                }
                $controllerName = '\\Src\\Controllers\\' . $route['controller'];
                $actionName = $route['action'];
                if (class_exists($controllerName)) {
                    $controller = new $controllerName($Database);
                    if (method_exists($controller, $actionName)) {
                        return call_user_func_array([$controller, $actionName], $params);
                    }
                }
            }
        }
        self::redirectToError(404);
    }
    /**
     * Redirect to error page
     * @param int $code
     * @return void
     */
    private static function redirectToError(int $code): void {
        http_response_code($code);
        header("Location: /errors/$code");
        exit;
    }
}

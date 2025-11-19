<?php 

namespace src\enums ; 

class RoutesEnum {  

    private $routes = [
        '/' => ['controller' => 'HomeController', 'action' => 'index', 'methods' => ['GET']],
        '/events' => ['controller' => 'EventsController', 'action' => 'index', 'methods' => ['GET']],
        '/events/register' => ['controller' => 'EventsController', 'action' => 'registerToEvents', 'methods' => ['GET']],
        '/events/registerSubmit' => ['controller' => 'EventsController', 'action' => 'registerSubmit', 'methods' => ['POST']],
        '/errors/{errorCode}' => ['controller' => 'ErrorsController', 'action' => 'index', 'methods' => ['GET'] ],
    ];
    
    public function getRoute($routeName) {
        return $this->routes[$routeName] ?? null;
    }
    public function getRoutes() {
        return $this->routes ?? null;
    }
}

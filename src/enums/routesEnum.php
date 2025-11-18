<?php 

namespace src\enums ; 

class RoutesEnum {

    private $routes = [
        '/events' => ['controller' => 'EventsController', 'action' => 'index', 'methods' => ['GET']],
        '/events/register' => ['controller' => 'EventsController', 'action' => 'registerToEvents', 'methods' => ['GET']],
        '/errors/{errorCode}' => ['controller' => 'ErrorsController', 'action' => 'index', 'methods' => ['GET'] ],
    ];
    
    public function getRoute($routeName) {
        return $this->routes[$routeName] ?? null;
    }
    public function getRoutes() {
        return $this->routes ?? null;
    }
}

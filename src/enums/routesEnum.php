<?php 

namespace Src\Enums ; 

class RoutesEnum {  

    private $routes = [
        '/' => ['controller' => 'HomeController', 'action' => 'index', 'methods' => ['GET']],
        '/events' => ['controller' => 'EventsController', 'action' => 'index', 'methods' => ['GET']],
        '/events/editDates' => ['controller' => 'EventsController', 'action' => 'editEventDates', 'methods' => ['GET']],
        '/events/create' => ['controller' => 'EventsController', 'action' => 'createEvent', 'methods' => ['GET']],
        '/events/register' => ['controller' => 'AttendeesController', 'action' => 'registerToEvents', 'methods' => ['GET']],
        '/events/unregister' => ['controller' => 'AttendeesController', 'action' => 'unregisterFromEvents', 'methods' => ['GET']],
        '/events/importEvent' => ['controller' => 'EventsController', 'action' => 'importEvent', 'methods' => ['GET'] ],
       
        '/errors/{errorCode}' => ['controller' => 'ErrorsController', 'action' => 'index', 'methods' => ['GET'] ],
        '/events/deleteEvent/{id}' => ['controller' => 'EventsController', 'action' => 'deleteEvent', 'methods' => ['GET'] ],


        '/events/importEventSubmit' => ['controller' => 'EventsController', 'action' => 'importEventSubmit', 'methods' => ['POST'] ],
        '/events/registerSubmit' => ['controller' => 'AttendeesController', 'action' => 'registerSubmit', 'methods' => ['POST']],
        '/events/unregisterSubmit' => ['controller' => 'AttendeesController', 'action' => 'unregisterSubmit', 'methods' => ['POST']],
        '/events/updateEventSubmit' => ['controller' => 'EventsController', 'action' => 'updateEventSubmit', 'methods' => ['POST']],
        '/events/createEventSubmit' => ['controller' => 'EventsController', 'action' => 'createEventSubmit', 'methods' => ['POST']],
    ];
    /**
     * Return route by name
     */
    public function getRoute($routeName) {
        return $this->routes[$routeName] ?? null;
    }
    /**
     * Return all routes
     */
    public function getRoutes() {
        return $this->routes ?? null;
    }
}

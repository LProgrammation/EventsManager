<?php 

namespace src\controllers;
use src\controllers\AbstractController;
class EventsController extends AbstractController {
    public function index(){
        $this->render('events/index');
    }

    public function registerToEvents(){
        $this->render('events/register');
    }
}
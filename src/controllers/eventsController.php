<?php 

namespace src\controllers;
use src\controllers\AbstractController;
class EventsController extends AbstractController {
    public function index(){
        $this->render('events/index', ['title' => 'Liste des événements']);
    }

    public function registerToEvents(){
        $this->render('events/register');
    }
}
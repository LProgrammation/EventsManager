<?php 

namespace src\controllers;
use src\controllers\AbstractController;
class HomeController extends AbstractController {
    public function __construct(array $database)
    {
        parent::__construct($database);
    }
    /**
     * Show home page
     * @return void
     */
    public function index(){
        $this->render('home/index', ['title' => 'Welcome to Events Manager']);
    }

   
}
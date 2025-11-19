<?php 

namespace src\controllers;
use src\controllers\AbstractController;
class HomeController extends AbstractController {
    public function index(){
        $this->render('home/index');
    }

   
}
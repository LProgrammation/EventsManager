<?php 

namespace src\controllers;
use src\controllers\AbstractController;
class ErrorsController extends AbstractController {
    public function index($errorCode){
        $this->render('errors/index', ['title' => 'Error Page', 'errorCode' => $errorCode]);
    }
}
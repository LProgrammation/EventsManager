<?php 

namespace src\controllers;
use src\controllers\AbstractController;
class ErrorsController extends AbstractController {

    public function __construct($database = null)
    {
        parent::__construct($database);
    }
    /**
     * Show error with message
     * @param mixed $errorCode
     * @return void
     */
    public function index($errorCode){
        $this->render('errors/index', 
                    [
                        'title' => 'Error Page', 
                        'errorCode' => $errorCode,
                        'errorMessage' => urldecode($_GET['msg'] ?? 'An error occurred'),
                    ]
        );
    }
}
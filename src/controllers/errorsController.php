<?php 

namespace src\controllers;
use src\controllers\AbstractController;
class ErrorsController extends AbstractController {
    public function index($errorCode){
        $this->render('errors/index', 
                    [
                        'title' => 'Error Page', 
                        'errorCode' => $errorCode, 
                        'errorMessage' => $this->getErrorMessage($errorCode)
                    ]
        );
    }

    private function getErrorMessage($errorCode) {
        $errorMessages = [
            1045 => 'Database connection error: Access denied for user. Please check your database credentials.',
            // You can add more error codes and messages here
        ];

        return $errorMessages[$errorCode] ?? 'An unknown error occurred.';
    }
}
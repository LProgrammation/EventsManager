<?php 

namespace Src\Controllers;
use Src\Controllers\AbstractController;
class ErrorsController extends AbstractController {

    public function __construct($database = null)
    {
        parent::__construct($database);
    }
    /**
     * Error page
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
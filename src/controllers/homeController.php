<?php 

namespace Src\Controllers;
use Src\Controllers\AbstractController;
class HomeController extends AbstractController {
    public function __construct(array $database)
    {
        parent::__construct($database);
    }
    /**
     * Home page
     * @return void
     */
    public function index(){
        $this->render('home/index', ['title' => 'Welcome to Events Manager']);
    }

   
}
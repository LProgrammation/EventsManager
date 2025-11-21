<?php

namespace Src\Controllers;

use Src\cores\Renderer;
abstract class AbstractController {

    protected array $database;

    public function __construct(array $database)
    {
        $this->database = $database;
    }
    /**
     * Abstract render method for all controller
     * @param string $view
     * @param array $data
     * @return void
     */
    protected function render(string $view, array $data = []): void {
        Renderer::render($view, $data);
    }
}
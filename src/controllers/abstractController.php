<?php

namespace src\controllers;

use src\cores\Renderer;
abstract class AbstractController {
    protected function render(string $view, array $data = []): void {
        Renderer::render($view, $data);
    }
}
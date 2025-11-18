<?php 

namespace src\cores;

class Renderer {
    public static function render(string $template, array $data = []): void {
        $renderData = [
            'content' => $template . '.php',
            'data' => array_merge([
                'title' => 'No Title Found',
                'controller' => null
            ], $data),
            'styles' => $data['styles'] ?? [],
            'scripts' => $data['scripts'] ?? [],
            'head_scripts' => $data['head_scripts'] ?? []
        ];

        extract($renderData);
        include '../templates/index.php';
    }
}

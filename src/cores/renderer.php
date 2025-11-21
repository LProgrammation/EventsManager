<?php 

namespace Src\cores;

class Renderer {
    /**
     * Render a template with data
     * @param string $template
     * @param array $data
     * @return void
     */
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

<?php

namespace Alura\Cursos\Controller;

abstract class ControllerComHtml{
    public function renderizaHTML(string $caminhoTemplate, array $dados): string
    {
        extract($dados);
        ob_start();
        require __DIR__ . '/../../view/' . $caminhoTemplate;
        $html = ob_get_clean();

        return $html;
    }
}
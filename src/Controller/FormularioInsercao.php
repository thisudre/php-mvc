<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizarHtml;

class FormularioInsercao implements InterfaceControladorRequisicao
{
    use RenderizarHtml;
    public function processaRequisicao(): void
    {
        echo $this->renderizaHTML(
            'cursos/formulario.php', 
            ['titulo' => 'Novo Curso']
        );
    }
}

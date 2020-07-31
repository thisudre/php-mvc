<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizarHtml;

class FormularioLogin implements InterfaceControladorRequisicao{

    use RenderizarHtml;

    public function processaRequisicao(): void
    {
        echo $this->renderizaHTML('login/formulario.php', [
            'titulo' => 'Login'
        ]);
    }
}
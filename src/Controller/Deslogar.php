<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\FlashMessageTrait;

class Deslogar implements InterfaceControladorRequisicao{

    use FlashMessageTrait;
    public function processaRequisicao(): void
    {
        session_destroy();
        $this->enviaMensagem('Usuário deslogado com sucesso.', 'success');
        header('Location: /login');
    }
}
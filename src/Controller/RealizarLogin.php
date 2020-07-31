<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class RealizarLogin implements InterfaceControladorRequisicao{
    use FlashMessageTrait;
    
    private $repositorioUsuarios;

    public function __construct() {
        $this->repositorioUsuarios = ((new EntityManagerCreator)->getEntityManager())->getRepository(Usuario::class);
    }
    
    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        if (is_null($email) || $email === false || is_null($senha) || $senha === false) {
            $this->enviaMensagem('Dados inválidos', 'danger');
            header('Location: /login');
            return;
        }

        /**@var Usuario $usuario */
        $usuario = $this->repositorioUsuarios->findOneBy([
            'email' => $email
        ]);

        if (is_null($usuario)) {
            $this->enviaMensagem('Usuário não encontrado!', 'danger');
            header('Location: /login');
            return;
        }
        if (!$usuario->senhaEstaCorreta($senha)) {
            $this->enviaMensagem('Senha incorreta', 'danger');
            header('Location: /login');
            return;
        }

        $_SESSION['logado'] = true;
        header('Location: /listar-cursos', true, 302);

    }
}
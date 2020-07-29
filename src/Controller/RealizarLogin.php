<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;

class RealizarLogin extends ControllerComHtml implements InterfaceControladorRequisicao{
    private $repositorioUsuarios;

    public function __construct() {
        $this->repositorioUsuarios = ((new EntityManagerCreator)->getEntityManager())->getRepository(Usuario::class);
    }
    
    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        if (is_null($email) || $email === false || is_null($senha) || $senha === false) {
            echo "dados incorretos";
            return;
        }

        /**@var Usuario $usuario */
        $usuario = $this->repositorioUsuarios->findOneBy([
            'email' => $email
        ]);

        if (is_null($usuario)) {
            echo "usuario não encontrado";
            return;
        }
        if (!$usuario->senhaEstaCorreta($senha)) {
            echo "senha incorreta";
            return;
        }

        header('Location: /listar-cursos', true, 302);

    }
}
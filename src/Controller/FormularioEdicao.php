<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioEdicao extends ControllerComHtml implements InterfaceControladorRequisicao
{
    private $repository;
    
    public function __construct() {
        $entityManager = (new EntityManagerCreator)->getEntityManager();
        $this->repository = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            header('Location: listar-cursos');
            return;
        }

        $curso = $this->repository->find($id);

        echo $this->renderizaHTML(
            'cursos/formulario.php',
            [
                'curso' => $curso,
                'titulo' => 'Alterar curso' . $curso->getDescricao()
            ]
        );
    }
}
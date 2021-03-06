<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizarHtml;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarCursos implements InterfaceControladorRequisicao
{
    private $repositorioCursos;
    use RenderizarHtml;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCursos = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        echo $this->renderizaHTML(
            'cursos/listar-cursos.php',
            [
                'cursos' => $this->repositorioCursos->findAll(),
                'titulo' => 'Lista de Cursos'
            ]
        );

    }
}

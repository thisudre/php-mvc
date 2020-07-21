<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManager;

class ListarCursos  implements InterfaceControladorRequisicao
{
    private $repositorioCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCursos = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $cursos = $this->repositorioCursos->findAll();
        $titulo = 'Lista de cursos';
        require __DIR__ . '/../../view/cursos/listar-cursos.php';
    }
}

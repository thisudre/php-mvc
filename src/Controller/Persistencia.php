<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class Persistencia implements InterfaceControladorRequisicao
{
    /**
     * @var $entityManager \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct() {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        // pegar os dados
        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING
        );
        $curso = new Curso();
        $curso->setDescricao($descricao);
        // persistir os dados
        $this->entityManager->persist($curso);
        $this->entityManager->flush();
        // redirecionar
        header('Location: listar-cursos', true, 302);
    }
}
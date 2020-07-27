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

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        $curso = new Curso();
        $curso->setDescricao($descricao);

        if(is_null($id) || $id === false)
        {
            $this->entityManager->persist($curso);
        }
        else
        {
            $curso->setId($id);
            $this->entityManager->merge($curso);
        }

        $this->entityManager->flush();
        header('Location: listar-cursos', true, 302);
    }
}
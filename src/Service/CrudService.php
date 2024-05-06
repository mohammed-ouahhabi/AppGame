<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class CrudService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function update()
    {
        $this->entityManager->flush();
    }

    public function delete($entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function getRepository($entityClass): ObjectRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }
}

<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class CrudService
{


    public function __construct(private readonly EntityManagerInterface $entityManager)
    {

    }
    public function create($entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function update(): void
    {
        $this->entityManager->flush();
    }

    public function delete($entity): void
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function getRepository($entityClass): ObjectRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }
}

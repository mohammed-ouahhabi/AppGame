<?php


// src/Repository/OffreRepository.php

namespace App\Repository;

use App\Entity\Offre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class OffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offre::class);
    }

    public function findByCriteria(array $criteria): array
    {
        $qb = $this->createQueryBuilder('o');

        if (!empty($criteria['edition'])) {
            $qb->andWhere('o.edition = :edition')
                ->setParameter('edition', $criteria['edition']);
        }

        if (!empty($criteria['plateformeJeu'])) {
            $qb->andWhere('o.plateformeJeu = :plateformeJeu')
                ->setParameter('plateformeJeu', $criteria['plateformeJeu']);
        }

        if (!empty($criteria['plateformeActivation'])) {
            $qb->andWhere('o.plateformeActivation = :plateformeActivation')
                ->setParameter('plateformeActivation', $criteria['plateformeActivation']);
        }

        if (!empty($criteria['sortByPrice'])) {
            $order = $criteria['sortByPrice'] === 'asc' ? 'ASC' : 'DESC';
            $qb->orderBy('o.prix', $order);
        }

        return $qb->getQuery()->getResult();
    }

    public function findPrixFinal(int $offreId)
    {
        return $this->createQueryBuilder('o')
            ->select('o.prix, c.reduction, (o.prix - (o.prix * c.reduction / 100)) AS prix_final')
            ->innerJoin('o.coupon', 'c')
            ->where('o.id = :id')
            ->setParameter('id', $offreId)
            ->getQuery()
            ->getOneOrNullResult();  // fetch single result or null
    }
}

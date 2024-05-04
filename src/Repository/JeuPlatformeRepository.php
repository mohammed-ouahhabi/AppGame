<?php

namespace App\Repository;

use App\Entity\JeuPlatforme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JeuPlatforme>
 *
 * @method JeuPlatforme|null find($id, $lockMode = null, $lockVersion = null)
 * @method JeuPlatforme|null findOneBy(array $criteria, array $orderBy = null)
 * @method JeuPlatforme[]    findAll()
 * @method JeuPlatforme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JeuPlatformeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JeuPlatforme::class);
    }

//    /**
//     * @return JeuPlatforme[] Returns an array of JeuPlatforme objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JeuPlatforme
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

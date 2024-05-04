<?php

namespace App\Repository;

use App\Entity\UserWishlist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserWishlist>
 *
 * @method UserWishlist|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserWishlist|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserWishlist[]    findAll()
 * @method UserWishlist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserWishlistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserWishlist::class);
    }

//    /**
//     * @return UserWishlist[] Returns an array of UserWishlist objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserWishlist
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

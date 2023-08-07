<?php

namespace App\Repository;

use App\Entity\UserBookmark;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserBookmark>
 *
 * @method UserBookmark|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserBookmark|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserBookmark[]    findAll()
 * @method UserBookmark[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserBookmarkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserBookmark::class);
    }

//    /**
//     * @return UserBookmark[] Returns an array of UserBookmark objects
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

//    public function findOneBySomeField($value): ?UserBookmark
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

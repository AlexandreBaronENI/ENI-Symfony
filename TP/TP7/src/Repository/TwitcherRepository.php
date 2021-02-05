<?php

namespace App\Repository;

use App\Entity\Twitcher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Twitcher|null find($id, $lockMode = null, $lockVersion = null)
 * @method Twitcher|null findOneBy(array $criteria, array $orderBy = null)
 * @method Twitcher[]    findAll()
 * @method Twitcher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TwitcherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Twitcher::class);
    }

    // /**
    //  * @return Twitcher[] Returns an array of Twitcher objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Twitcher
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

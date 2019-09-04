<?php

namespace App\Repository;

use App\Entity\QuartersType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method QuartersType|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuartersType|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuartersType[]    findAll()
 * @method QuartersType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuartersTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuartersType::class);
    }

    // /**
    //  * @return QuartersType[] Returns an array of QuartersType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuartersType
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

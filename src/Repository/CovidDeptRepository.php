<?php

namespace App\Repository;

use App\Entity\CovidDept;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CovidDept|null find($id, $lockMode = null, $lockVersion = null)
 * @method CovidDept|null findOneBy(array $criteria, array $orderBy = null)
 * @method CovidDept[]    findAll()
 * @method CovidDept[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CovidDeptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CovidDept::class);
    }

    // /**
    //  * @return CovidDept[] Returns an array of CovidDept objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CovidDept
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

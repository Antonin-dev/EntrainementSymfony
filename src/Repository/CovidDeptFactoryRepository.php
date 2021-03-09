<?php

namespace App\Repository;

use App\Entity\CovidDeptFactory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CovidDeptFactory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CovidDeptFactory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CovidDeptFactory[]    findAll()
 * @method CovidDeptFactory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CovidDeptFactoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CovidDeptFactory::class);
    }

    // /**
    //  * @return CovidDeptFactory[] Returns an array of CovidDeptFactory objects
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
    public function findOneBySomeField($value): ?CovidDeptFactory
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

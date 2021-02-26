<?php

namespace App\Repository;

use App\Entity\Ville;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Ville|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ville|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ville[]    findAll()
 * @method Ville[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VilleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ville::class);
    }

    // /**
    //  * @return Ville[] Returns an array of Ville objects
    //  */
    
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.id :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function contrainteNombreVille($value) : int
    {
        return count($this->createQueryBuilder('v')
            ->andWhere('v.dept = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()) 
        ;
    }


    public function createVille($entityManager, $nom)
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        

        $ville = new Ville;
        $ville->setNom($nom);
        $ville->setPays('France');
        $ville->setDept(12000);
        $ville->setPopulation(3498763);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->persist($ville);
        $entityManager->flush();
        return $ville;
        
    }
    
    public function test (){


    }

    public function findByTwoFields(int $population, int $departement)
    {
        return $this->createQueryBuilder('u')
            ->where('u.population > :val1')
            ->andWhere('u.dept = :val2')
            ->setParameter('val1', $population)
            ->setParameter('val2', $departement)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Ville
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php


namespace App\Service;

use App\Entity\Pays;
use Doctrine\ORM\EntityManagerInterface;

class RandomService 
{

    private $injectedName;
    private $entityManager;
    

    public function __construct($injectedName, EntityManagerInterface $entityManager)
    {
        $this->injectedName = $injectedName;
        $this->entityManager = $entityManager;
    }

    public function randomNumber(){

        $random = rand(1,10000);
        return $this->injectedName . ' a ' . $random . ' ans';
    }

    public function pays (){
        $pays = $this->entityManager->getRepository(Pays::class)->findOneBy(['nom' => 'France']);
        return $pays;
    }

}
<?php

namespace App\Controller;

use App\Entity\Commune;
use App\Entity\Pays;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaysPopController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/pays/pop/{pays}", name="pays_pop")
     */
    public function index($pays): Response
    {

        $paysObj = $this->entityManager->getRepository(Pays::class)->findBy([
            'nom' => $pays
        ]);
        $paysObjet = $paysObj[0];
        $idPays = $paysObjet->getId();
        
        $communeObj = $this->entityManager->getRepository(Commune::class)->findBy([
            'pays' => $idPays
        ]);
        
        $totalPopulationPays = 0;

        foreach ($communeObj as $key) {
            $totalPopulationPays += $key->getPopulation();
        }

        $paysObjet->setPopulationGlobale($totalPopulationPays);
        $this->entityManager->persist($paysObjet);
        $this->entityManager->flush();
        



        return $this->render('pays_pop/index.html.twig', [
            'pays' => $pays,
            'populationGlobale' => $totalPopulationPays
        ]);
    }
}

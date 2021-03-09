<?php

namespace App\Controller;

use App\Entity\Acteur;
use App\Form\DetailActeurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheActeurController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/recherche/acteur", name="recherche_acteur")
     */
    public function index(Request $request): Response
    {

        $form = $this->createForm(DetailActeurType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nomActeur = $form->getData()->getNom();
            return $this->redirectToRoute('acteur_detail', ['nom' => $nomActeur]);

        }

        return $this->render('recherche_acteur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/acteur/detail/{nom}", name="acteur_detail")
     */
    public function rechercheValide(string $nom): Response
    {

        $acteur = $this->entityManager->getRepository(Acteur::class)->findOneBy([
            'nom' => $nom
        ]);
        
        $acteur = $acteur->getFilms()->toArray();
            
        return $this->render('recherche_acteur/acteurDetail.html.twig',[
            'data' => $acteur[0],
            'acteur' => $nom
        ]);
    }
}

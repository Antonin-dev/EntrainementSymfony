<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddPersonController extends AbstractController
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/add/person", name="add_person")
     */
    public function index(Request $request): Response
    {
        $person = new Person;
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);
        $formulaireEnvoye = false;

        if ($form->isSubmitted() && $form->isValid()) {
            $person = $form->getData();
            $this->entityManager->persist($person);
            $this->entityManager->flush();
            $formulaireEnvoye = true;
            
        }

        return $this->render('add_person/index.html.twig', [
            'form' => $form->createView(),
            'person' => $person,
            'valide' => $formulaireEnvoye
        ]);
    }
}

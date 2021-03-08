<?php

namespace App\Controller;

use App\Form\FilmType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheFilmController extends AbstractController
{
    /**
     * @Route("/recherche/film", name="recherche_film")
     */
    public function index(Request $request): Response
    {

        $form = $this->createForm(FilmType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $result = $result->getTitre();
            return $this->redirectToRoute('film', ['film' => $result]);
            
        }

        return $this->render('recherche_film/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

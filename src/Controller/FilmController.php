<?php

namespace App\Controller;


use App\Service\FilmService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/film/{film}", name="film")
     */
    public function index(FilmService $filmService, $film): Response
    {
        $error='';
        try {
            $result = $filmService->affichageFilm($film);
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
        
        // dd($result);
  
        return $this->render('film/index.html.twig', [
            'data' => $result,
            'error' => $error

        ]);
    }
}

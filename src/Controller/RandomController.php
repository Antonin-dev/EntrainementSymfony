<?php

namespace App\Controller;


use App\Service\RandomService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RandomController extends AbstractController
{
    /**
     * @Route("/random", name="random")
     */
    public function index(RandomService $random): Response
    {
        $randomNumber = $random->randomNumber();
        $pays = $random->pays();
        dd($randomNumber . ' ' . $pays);
        return $this->render('random/index.html.twig');
    }
}

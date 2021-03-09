<?php

namespace App\Controller;

use App\Entity\CovidDept;
use App\Entity\CovidDeptFactory;
use App\Service\CovidService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CovidController extends AbstractController
{
    /**
     * @Route("/covid/national", name="covid_national")
     */
    public function index(CovidService $covidApi): Response
    {
        $error = null;
        try {
            $response = $covidApi->getApi();
            
        } 
        catch (\Exception $e) {

           $error = $e->getMessage();
        }

        
        
        return $this->render('covid/index.html.twig', [
            'data' => $response
        ]);
    }

    /**
     * @Route("/covid/global", name="covid_global")
     */
    public function global(CovidService $covidApi): Response
    {
        try {
            $response = $covidApi->global();
            
        } 
        catch (\Exception $e) {

            $e->getMessage();
        }
        
        return $this->render('covid/global.html.twig', [
            'data' => $response
        ]);
    }

    /**
     * @Route("/covid/faible", name="covid_faible")
     */
    public function faible(CovidService $covidApi): Response
    {
        $error = null;
        try {
            $response = $covidApi->getApi();
            
        } 
        catch (\Exception $e) {

           $error = $e->getMessage();
        }
        $covidFactory = new CovidDeptFactory;
        
        foreach ($response as $dept) {
            $covidDept = new CovidDept($dept['nom'], $dept['hospitalises'], $dept['reanimation']);
            $covidFactory->addListeDept($covidDept);
        }

        $resultMini = $covidApi->search($covidFactory->getListeDept()->toArray());

        $resultMaxi = $covidApi->searchMax($covidFactory->getListeDept()->toArray());

        
        return $this->render('covid/faible.html.twig', [
            'data' => $resultMini,
            'dataMax' => $resultMaxi
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    /**
     * @Route("/city", name="city")
     */
    public function index(VilleRepository $villeRep): Response
    {
        // RECUPERE TOUTE LES VILLES
        $tableau = $villeRep->findAll();
  
        return $this->render('city/index.html.twig', [
            'tableauVille' => $tableau
        ]);
    }




    /**
     * @Route("/city/add/{nom}", name="city_add")
     */
    public function add(VilleRepository $villeRep, $nom): Response
    {
        // CREATION D'UNE VILLE
        
        $villeRep->createVille($this->getDoctrine()->getManager(), $nom);
        

        return $this->render('city/addCity.html.twig',[
            'villeAdd' => $nom
        ]);
    }




    /**
     * @Route("/city/{id}", name="city_one")
     */

    public function showCity(int $id): Response
    {
        // RECUPERER UNE VILLE

        $entityManager = $this->getDoctrine()->getManager();
        $citys = $entityManager->getRepository(Ville::class)->find($id);
        

        return $this->render('city/indexCityOne.html.twig', [
            'detailVille' => $citys,
        ]);
    }

    /**
     * @Route("/city/edit/{id}/{nom}", name="city_edit")
     */

    public function update(int $id, string $nom): Response
    {

        // MIS A JOUR D'UNE VILLE

        $entityManager = $this->getDoctrine()->getManager();
        $ville = $entityManager->getRepository(Ville::class)->find($id);

        if (!$ville) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $ville->setNom($nom);
        $entityManager->flush();

        return $this->redirectToRoute('city');
    }


    /**
     * @Route("/city/delete/{id}", name="city_delete")
     */

    public function delete(int $id): Response
    {

        // SUPPRIMER UNE VILLE

        $entityManager = $this->getDoctrine()->getManager();
        $ville = $entityManager->getRepository(Ville::class)->find($id);

        if (!$ville) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $entityManager->remove($ville);
        $entityManager->flush();

        return $this->redirectToRoute('city');
    }

    /**
     * @Route("/city/{population}/{dep}", name="city_populationdep")
     */
    public function showUsersByPopulationDepartment(VilleRepository $villeRep, int $population, int $dep): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $rep = $entityManager->getRepository(Ville::class);
        $result = $villeRep->findByTwoFields($population, $dep);
        dd($result);

        

        return $this->render('city/index.html.twig');
    }


}

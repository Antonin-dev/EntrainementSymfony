<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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
     * @Route("/city/add/", name="city_add")
     */
    public function add(Request $request, VilleRepository $villeRep): Response
    {
        // CREATION D'UNE VILLE
        $ville = new Ville;
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);
        $etatFormulaire = false;

        if ($form->isSubmitted() && $form->isValid()) {
            $ville = $form->getData();
            $this->entityManager->persist($ville);
            $this->entityManager->flush();
            $etatFormulaire = true;

        }

        // $villeRep->createVille($this->getDoctrine()->getManager(), $nom);
        

        return $this->render('city/addCity.html.twig',[
            'form' => $form->createView(),
            'etat' => $etatFormulaire,
            'ville' => $ville
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

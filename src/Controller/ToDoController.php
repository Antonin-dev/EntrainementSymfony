<?php

namespace App\Controller;

use App\Entity\ToDo;
use App\Form\ToDoType;
use App\Repository\ToDoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/to/do/lire", name="to_do_lire")
     */
    public function lire(ToDoRepository $todoRepo): Response
    {

        $toDo = $todoRepo->findAll();

        return $this->render('to_do/indexLire.html.twig', [
            
            'toDo' => $toDo
        ]);
    }




    /**
     * @Route("/to/do/add", name="to_do_add")
     */
    public function index(Request $request): Response
    {


    $toDo = new ToDo;
    $form = $this->createForm(ToDoType::class, $toDo);
    $form->handleRequest($request);
    $etatForm = false;

    if ($form->isSubmitted() && $form->isValid()) {
        $toDo = $form->getData();
        $this->entityManager->persist($toDo);
        $this->entityManager->flush();
        $etatForm = true;
    }

        return $this->render('to_do/index.html.twig', [
            'form' => $form->createView(),
            'etat' => $etatForm,
            'toDo' => $toDo
        ]);
    }



    /**
     * @Route("/todo/delete/{id}", name="todo_delete")
     */

    public function delete(int $id): Response
    {

        

        $entityManager = $this->getDoctrine()->getManager();
        $toDo = $this->entityManager->getRepository(ToDo::class)->find($id);

        if (!$toDo) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $this->entityManager->remove($toDo);
        $this->entityManager->flush();
        

        return $this->redirectToRoute('to_do_lire');
    }
}

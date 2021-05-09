<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Form\MatiereType;
use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Matiere")
 */
class MatiereController extends AbstractController
{
    /**
     * @Route("/", name="Matiere_index", methods={"GET"})
     */
    public function index(MatiereRepository $MatiereRepository): Response
    {
        $Matieres= $MatiereRepository->findAll();
        //dd($Matieres);
        return $this->render('Matiere/index.html.twig', [
            'Matieres' => $MatiereRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Matiere_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Matiere = new Matiere();
        $form = $this->createForm(MatiereType::class, $Matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Matiere);
            $entityManager->flush();

            return $this->redirectToRoute('Matiere_index');
        }

        return $this->render('Matiere/new.html.twig', [
            'Matiere' => $Matiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Matiere_show", methods={"GET"})
     */
    public function show(Matiere $Matiere): Response
    {
        return $this->render('Matiere/show.html.twig', [
            'Matiere' => $Matiere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Matiere_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Matiere $Matiere): Response
    {
        $form = $this->createForm(MatiereType::class, $Matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Matiere_index');
        }

        return $this->render('Matiere/edit.html.twig', [
            'Matiere' => $Matiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Matiere_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Matiere $Matiere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Matiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Matiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Matiere_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Cours")
 */
class CoursController extends AbstractController
{
    /**
     * @Route("/", name="Cours_index", methods={"GET"})
     */
    public function index(CoursRepository $CoursRepository): Response
    {
        return $this->render('Cours/index.html.twig', [
            'Cours' => $CoursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Cours_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Cours = new Cours();
        $form = $this->createForm(CoursType::class, $Cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Cours);
            $entityManager->flush();

            return $this->redirectToRoute('Cours_index');
        }

        return $this->render('Cours/new.html.twig', [
            'Cours' => $Cours,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Cours_show", methods={"GET"})
     */
    public function show(Cours $Cours): Response
    {
        return $this->render('Cours/show.html.twig', [
            'Cours' => $Cours,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Cours_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cours $Cours): Response
    {
        $form = $this->createForm(CoursType::class, $Cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Cours_index');
        }

        return $this->render('Cours/edit.html.twig', [
            'Cours' => $Cours,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Cours_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cours $Cours): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Cours->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Cours);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Cours_index');
    }
}

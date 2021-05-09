<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Form\QuizzType;
use App\Repository\QuizzRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Quizz")
 */
class QuizzController extends AbstractController
{
    /**
     * @Route("/", name="Quizz_index", methods={"GET"})
     */
    public function index(QuizzRepository $QuizzRepository): Response
    {
        return $this->render('Quizz/index.html.twig', [
            'Quizzs' => $QuizzRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Quizz_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Quizz = new Quizz();
        $form = $this->createForm(QuizzType::class, $Quizz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Quizz);
            $entityManager->flush();

            return $this->redirectToRoute('Quizz_index');
        }

        return $this->render('Quizz/new.html.twig', [
            'Quizz' => $Quizz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Quizz_show", methods={"GET"})
     */
    public function show(Quizz $Quizz): Response
    {
        return $this->render('Quizz/show.html.twig', [
            'Quizz' => $Quizz,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Quizz_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Quizz $Quizz): Response
    {
        $form = $this->createForm(QuizzType::class, $Quizz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Quizz_index');
        }

        return $this->render('Quizz/edit.html.twig', [
            'Quizz' => $Quizz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Quizz_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Quizz $Quizz): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Quizz->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Quizz);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Quizz_index');
    }
}

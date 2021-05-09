<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Classe")
 */
class ClasseController extends AbstractController
{
    /**
     * @Route("/", name="Classe_index", methods={"GET"})
     */
    public function index(ClasseRepository $ClasseRepository): Response
    {
        return $this->render('Classe/index.html.twig', [
            'classes' => $ClasseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Classe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Classe = new Classe();
        $form = $this->createForm(ClasseType::class, $Classe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Classe);
            $entityManager->flush();

            return $this->redirectToRoute('Classe_index');
        }

        return $this->render('Classe/new.html.twig', [
            'Classe' => $Classe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Classe_show", methods={"GET"})
     */
    public function show(Classe $Classe): Response
    {
        return $this->render('Classe/show.html.twig', [
            'Classe' => $Classe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Classe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Classe $Classe): Response
    {
        $form = $this->createForm(ClasseType::class, $Classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Classe_index');
        }

        return $this->render('Classe/edit.html.twig', [
            'Classe' => $Classe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Classe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Classe $Classe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Classe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Classe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Classe_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Section;
use App\Form\SectionType;
use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Section")
 */
class SectionController extends AbstractController
{
    /**
     * @Route("/", name="Section_index", methods={"GET"})
     */
    public function index(SectionRepository $SectionRepository): Response
    {
        return $this->render('Section/index.html.twig', [
            'Sections' => $SectionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Section_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Section = new Section();
        $form = $this->createForm(SectionType::class, $Section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Section);
            $entityManager->flush();

            return $this->redirectToRoute('Section_index');
        }

        return $this->render('Section/new.html.twig', [
            'Section' => $Section,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Section_show", methods={"GET"})
     */
    public function show(Section $Section): Response
    {
        return $this->render('Section/show.html.twig', [
            'Section' => $Section,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Section_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Section $Section): Response
    {
        $form = $this->createForm(SectionType::class, $Section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Section_index');
        }

        return $this->render('Section/edit.html.twig', [
            'Section' => $Section,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Section_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Section $Section): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Section->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Section);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Section_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Form\PublicationType;
use App\Repository\PublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Publication")
 */
class PublicationController extends AbstractController
{
    /**
     * @Route("/", name="Publication_index", methods={"GET"})
     */
    public function index(PublicationRepository $PublicationRepository): Response
    {
        return $this->render('Publication/index.html.twig', [
            'Publications' => $PublicationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Publication_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Publication = new Publication();
        $form = $this->createForm(PublicationType::class, $Publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Publication);
            $entityManager->flush();

            return $this->redirectToRoute('Publication_index');
        }

        return $this->render('Publication/new.html.twig', [
            'Publication' => $Publication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Publication_show", methods={"GET"})
     */
    public function show(Publication $Publication): Response
    {
        return $this->render('Publication/show.html.twig', [
            'Publication' => $Publication,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Publication_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Publication $Publication): Response
    {
        $form = $this->createForm(PublicationType::class, $Publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Publication_index');
        }

        return $this->render('Publication/edit.html.twig', [
            'Publication' => $Publication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Publication_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Publication $Publication): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Publication->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Publication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Publication_index');
    }
}

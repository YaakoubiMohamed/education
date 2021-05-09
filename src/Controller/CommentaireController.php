<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Commentaire")
 */
class CommentaireController extends AbstractController
{
    /**
     * @Route("/", name="Commentaire_index", methods={"GET"})
     */
    public function index(CommentaireRepository $CommentaireRepository): Response
    {
        return $this->render('Commentaire/index.html.twig', [
            'Commentaires' => $CommentaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Commentaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $Commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('Commentaire_index');
        }

        return $this->render('Commentaire/new.html.twig', [
            'Commentaire' => $Commentaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Commentaire_show", methods={"GET"})
     */
    public function show(Commentaire $Commentaire): Response
    {
        return $this->render('Commentaire/show.html.twig', [
            'Commentaire' => $Commentaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Commentaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commentaire $Commentaire): Response
    {
        $form = $this->createForm(CommentaireType::class, $Commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Commentaire_index');
        }

        return $this->render('Commentaire/edit.html.twig', [
            'Commentaire' => $Commentaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Commentaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commentaire $Commentaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Commentaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Commentaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Commentaire_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Utilisateur")
 */
class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="Utilisateur_index", methods={"GET"})
     */
    public function index(UtilisateurRepository $UtilisateurRepository): Response
    {
        return $this->render('Utilisateur/index.html.twig', [
            'Utilisateurs' => $UtilisateurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Utilisateur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $Utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('Utilisateur_index');
        }

        return $this->render('Utilisateur/new.html.twig', [
            'Utilisateur' => $Utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Utilisateur_show", methods={"GET"})
     */
    public function show(Utilisateur $Utilisateur): Response
    {
        return $this->render('Utilisateur/show.html.twig', [
            'Utilisateur' => $Utilisateur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Utilisateur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Utilisateur $Utilisateur): Response
    {
        $form = $this->createForm(UtilisateurType::class, $Utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Utilisateur_index');
        }

        return $this->render('Utilisateur/edit.html.twig', [
            'Utilisateur' => $Utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Utilisateur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Utilisateur $Utilisateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Utilisateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Utilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Utilisateur_index');
    }
}

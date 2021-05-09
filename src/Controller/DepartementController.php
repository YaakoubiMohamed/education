<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Form\DepartementType;
use App\Repository\DepartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Departement")
 */
class DepartementController extends AbstractController
{
    /**
     * @Route("/", name="Departement_index", methods={"GET"})
     */
    public function index(DepartementRepository $DepartementRepository): Response
    {
        return $this->render('Departement/index.html.twig', [
            'Departements' => $DepartementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Departement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Departement = new Departement();
        $form = $this->createForm(DepartementType::class, $Departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Departement);
            $entityManager->flush();

            return $this->redirectToRoute('Departement_index');
        }

        return $this->render('Departement/new.html.twig', [
            'Departement' => $Departement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Departement_show", methods={"GET"})
     */
    public function show(Departement $Departement): Response
    {
        return $this->render('Departement/show.html.twig', [
            'Departement' => $Departement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Departement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Departement $Departement): Response
    {
        $form = $this->createForm(DepartementType::class, $Departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Departement_index');
        }

        return $this->render('Departement/edit.html.twig', [
            'Departement' => $Departement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Departement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Departement $Departement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Departement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Departement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Departement_index');
    }
}

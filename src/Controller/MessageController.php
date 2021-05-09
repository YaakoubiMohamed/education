<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Message")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/", name="Message_index", methods={"GET"})
     */
    public function index(MessageRepository $MessageRepository): Response
    {
        return $this->render('Message/index.html.twig', [
            'Messages' => $MessageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Message_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Message = new Message();
        $form = $this->createForm(MessageType::class, $Message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Message);
            $entityManager->flush();

            return $this->redirectToRoute('Message_index');
        }

        return $this->render('Message/new.html.twig', [
            'Message' => $Message,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Message_show", methods={"GET"})
     */
    public function show(Message $Message): Response
    {
        return $this->render('Message/show.html.twig', [
            'Message' => $Message,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Message_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Message $Message): Response
    {
        $form = $this->createForm(MessageType::class, $Message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Message_index');
        }

        return $this->render('Message/edit.html.twig', [
            'Message' => $Message,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Message_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Message $Message): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Message->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Message);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Message_index');
    }
}

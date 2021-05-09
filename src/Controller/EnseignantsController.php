<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class EnseignantsController extends AbstractController
{
    /**
     * @Route("/Enseignants", name="Enseignants")
     */
    public function index(UserRepository $UserRepository): Response
    {
        return $this->render('User/index.html.twig', [
            'users' => $UserRepository->findByExampleField('Enseignant'),
        ]);
    }
}

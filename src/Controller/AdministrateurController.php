<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="Administrateu_")
 */
class AdministrateurController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('administrateur/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
/**
 * @Route("/users", name="users_")
 */
public function userList()
{
    return $this->render('administrateur/user.html.twig', [
        'user' => $user->findAll(),
    ]);
}
 
}
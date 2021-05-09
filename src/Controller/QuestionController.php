<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Question")
 */
class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="Question_index", methods={"GET"})
     */
    public function index(QuestionRepository $QuestionRepository): Response
    {
        return $this->render('Question/index.html.twig', [
            'Questions' => $QuestionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Question_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    { 
        
        $Question = new Question();
        if ($request->getMethod() ==Request::METHOD_POST){
            
        
        $titre=$request->request->get('Titre');
        
         $choix=$request->request->get('choix');
         $reponse=$request->request->get('Reponse');
         $quizz=$request->request->get('Quizz');
        
       
        $Question->setTitre($titre);
        $Question->setChoix($choix);
        $Question->setReponse($reponse)  ;
        $Question->setQuizz($quizz);
    }
        $form= $this->createForm(QuestionType::class, $Question);
        return $this->render('question/new.html.twig',array(
           'form
           '=>$form->createView() 
        ));
        
    }




    /**
     * @Route("/{id}", name="Question_show", methods={"GET"})
     */
    public function show(Question $Question): Response
    {
        return $this->render('Question/show.html.twig', [
            'Question' => $Question,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Question_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Question $Question): Response
    {
        $form = $this->createForm(QuestionType::class, $Question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Question_index');
        }

        return $this->render('Question/edit.html.twig', [
            'Question' => $Question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Question_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Question $Question): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Question->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Question);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Question_index');
    }
}

<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $titre;

    /**
  

     * @ORM\Column(type="text")
     */
    private $reponse;

    /**
     * @ORM\ManyToOne(targetEntity=Quizz::class, inversedBy="question")
     * @ORM\JoinColumn(nullable=false)
     */

  
    private $quizz;

    /**
     * @ORM\Column(type="text")
     */
    private $choix;

    
 

    public function __construct()
    {
        $this->Choixes = new ArrayCollection();
    }

 
  
    public function __toString(){
        return $this->titre;
     
        
    }
  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }



    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getQuizz(): ?Quizz
    {
        return $this->quizz;
    }

    public function setQuizz(?Quizz $quizz): self
    {
        $this->quizz = $quizz;

        return $this;
    }

    public function getChoix(): ?string
    {
        return $this->choix;
    }

    public function setChoix(string $choix): self
    {
        $this->choix = $choix;

        return $this;
    }

  

   

 
}

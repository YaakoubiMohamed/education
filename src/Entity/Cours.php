<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
class Cours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $professeur;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matiere;

    /**
     * @ORM\OneToOne(targetEntity=Quizz::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $quizz;

    public function __toString(){
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getProfesseur(): ?User
    {
        return $this->professeur;
    }

    public function setProfesseur(?User $professeur): self
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getQuizz(): ?Quizz
    {
        return $this->quizz;
    }

    public function setQuizz(Quizz $quizz): self
    {
        $this->quizz = $quizz;

        return $this;
    }
}

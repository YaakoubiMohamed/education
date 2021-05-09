<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
class Classe
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
    public $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Matiere::class, mappedBy="Classe")
     */
    private $matiere;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="Classe", orphanRemoval=true)
     */
    private $idetudiant;

    /**
     * @ORM\ManyToOne(targetEntity=Section::class, inversedBy="classes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $section;

    public function __construct()
    {
        $this->matieres = new ArrayCollection();
        $this->idetudiant = new ArrayCollection();
    }

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

    /**
     * @return Collection|Matiere[]
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
            $matiere->addClasse($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        if ($this->matieres->removeElement($matiere)) {
            $matiere->removeClasse($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdetudiant(): Collection
    {
        return $this->idetudiant;
    }

    public function addIdetudiant(User $idetudiant): self
    {
        if (!$this->idetudiant->contains($idetudiant)) {
            $this->idetudiant[] = $idetudiant;
            $idetudiant->setClasse($this);
        }

        return $this;
    }

    public function removeIdetudiant(User $idetudiant): self
    {
        if ($this->idetudiant->removeElement($idetudiant)) {
            // set the owning side to null (unless already changed)
            if ($idetudiant->getClasse() === $this) {
                $idetudiant->setClasse(null);
            }
        }

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }
}

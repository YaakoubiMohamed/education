<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
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
     * @ORM\OneToMany(targetEntity=Cours::class, mappedBy="matiere")
     */
    private $cours;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="matieres")
     */
    private $idprofesseur;

    /**
     * @ORM\ManyToMany(targetEntity=Classe::class, inversedBy="matieres")
     */
    public $classe;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->idprofesseur = new ArrayCollection();
        $this->classe = new ArrayCollection();
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
     * @return Collection|Cours[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setMatiere($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getMatiere() === $this) {
                $cour->setMatiere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdprofesseur(): Collection
    {
        return $this->idprofesseur;
    }

    public function addIdprofesseur(User $idprofesseur): self
    {
        if (!$this->idprofesseur->contains($idprofesseur)) {
            $this->idprofesseur[] = $idprofesseur;
        }

        return $this;
    }

    public function removeIdprofesseur(User $idprofesseur): self
    {
        $this->idprofesseur->removeElement($idprofesseur);

        return $this;
    }

    /**
     * @return Collection|classe[]
     */
    public function getClasse(): Collection
    {
        return $this->classe;
    }

    public function addClasse(classe $classe): self
    {
        if (!$this->classe->contains($classe)) {
            $this->classe[] = $classe;
        }

        return $this;
    }

    public function removeClasse(classe $classe): self
    {
        $this->classe->removeElement($classe);

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomCours;

    #[ORM\Column(type: 'string', length: 255)]
    private $heureCours;

    #[ORM\ManyToMany(targetEntity: Classe::class, inversedBy: 'cours')]
    private $classe;

    #[ORM\OneToMany(mappedBy: 'cours', targetEntity: CoursEtudiant::class)]
    private $coursEtudiants;


    public function __construct()
    {
        $this->classe = new ArrayCollection();
        $this->prof = new ArrayCollection();
        $this->etudiant = new ArrayCollection();
        $this->coursEtudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCours(): ?string
    {
        return $this->nomCours;
    }

    public function setNomCours(string $nomCours): self
    {
        $this->nomCours = $nomCours;

        return $this;
    }

    public function getHeureCours(): ?string
    {
        return $this->heureCours;
    }

    public function setHeureCours(string $heureCours): self
    {
        $this->heureCours = $heureCours;

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasse(): Collection
    {
        return $this->classe;
    }

    public function addClasse(Classe $classe): self
    {
        if (!$this->classe->contains($classe)) {
            $this->classe[] = $classe;
        }

        return $this;
    }

    public function removeClasse(Classe $classe): self
    {
        $this->classe->removeElement($classe);

        return $this;
    }

    /**
     * @return Collection<int, CoursEtudiant>
     */
    public function getCoursEtudiants(): Collection
    {
        return $this->coursEtudiants;
    }

    public function addCoursEtudiant(CoursEtudiant $coursEtudiant): self
    {
        if (!$this->coursEtudiants->contains($coursEtudiant)) {
            $this->coursEtudiants[] = $coursEtudiant;
            $coursEtudiant->setCours($this);
        }

        return $this;
    }

    public function removeCoursEtudiant(CoursEtudiant $coursEtudiant): self
    {
        if ($this->coursEtudiants->removeElement($coursEtudiant)) {
            // set the owning side to null (unless already changed)
            if ($coursEtudiant->getCours() === $this) {
                $coursEtudiant->setCours(null);
            }
        }

        return $this;
    }

  

  
}

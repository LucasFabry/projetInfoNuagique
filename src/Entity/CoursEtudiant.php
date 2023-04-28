<?php

namespace App\Entity;

use App\Repository\CoursEtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursEtudiantRepository::class)]
class CoursEtudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Cours::class, inversedBy: 'coursEtudiants')]
    private $cours;

    #[ORM\ManyToOne(targetEntity: Etudiant::class, inversedBy: 'coursEtudiants')]
    private $etudiant;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $heurePointage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getHeurePointage(): ?string
    {
        return $this->heurePointage;
    }

    public function setHeurePointage(?string $heurePointage): self
    {
        $this->heurePointage = $heurePointage;

        return $this;
    }
}

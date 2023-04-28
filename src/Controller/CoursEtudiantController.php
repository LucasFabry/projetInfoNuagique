<?php

namespace App\Controller;

use App\Entity\Cours;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursEtudiantController extends AbstractController
{
    #[Route('/cours/etudiant/{id<\d+>}', name: 'app_cours_etudiant')]
    public function index(ManagerRegistry $doctrine, $id): Response
    {
        $repoCours = $doctrine->getRepository(Cours::class);
        
        $cours = $repoCours->findOneById($id);
        $classe = $cours->getClasse();
        $listeEtudiant = $classe[0]->getEtudiants();
        $coursEtudiant = $cours->getCoursEtudiants();

        return $this->render('cours_etudiant/index.html.twig', [
            'cours' => $cours,
            'classe' => $classe,
            'listeEtudiant' => $listeEtudiant,
            'listeCoursEtudiant' => $coursEtudiant
        ]);
    }
}

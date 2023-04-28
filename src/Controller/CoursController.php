<?php

namespace App\Controller;

use App\Entity\Cours;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{
    #[Route('/cours', name: 'app_cours'), IsGranted("ROLE_USER")]
    public function index(ManagerRegistry $doctrine): Response
    {
        //Si c'est un étudiant on affihce tous les cours de sa classe
        if($this->getUser()->getRoles()[0] == 'ROLE_USER'){
            $listeDesCours = [];
            foreach($this->getUser()->getCoursEtudiants() as $coursEtudiants){
                array_push($listeDesCours, $coursEtudiants->getCours());
                
            }
            return $this->render('cours/index.html.twig', [
                'listeCours' => $listeDesCours,
                'nomPromo' => $this->getUser()->getClasse()
            ]);
        }
        //Si c'est un prof on affiche tous ses cours
        elseif($this->getUser()->getRoles()[0] == 'ROLE_PROF'){

            $listeDesCours = [];
            foreach($this->getUser()->getCoursEtudiants() as $coursEtudiants){
                array_push($listeDesCours, $coursEtudiants->getCours());
                
            }

            return $this->render('cours/index.html.twig', [
                'listeCours' => $listeDesCours,
            ]);
        }
        return $this->render('cours/index.html.twig', [
            'controller_name' => 'CoursController',
        ]);
    }
}

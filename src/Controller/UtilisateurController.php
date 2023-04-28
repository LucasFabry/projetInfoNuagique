<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('utilisateur')]

class UtilisateurController extends AbstractController
{
    #[Route('/listeUser', name: 'utilisateur.list')]
    public function selectAll(ManagerRegistry $manager): Response
    {
        $repository = $manager->getRepository(Utilisateur::class);
        $utilisateur = $repository->findAll();
        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateur,
            'css' => '../css/base2.css',
        ]);
    }

    #[Route('/add', name: 'app_personne')]
    public function addPersonne(ManagerRegistry $doctrine, Request $request): Response
    {   
        $entityManager = $doctrine->getManager();
        $utilisateur = new Utilisateur();
        
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->remove('numAuth');

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $entityManager = $doctrine->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            return $this->redirectToRoute("utilisateur.list");
        }else{
            return $this->render('utilisateur/add-user.html.twig', [
            'form' => $form->createView()
        ]);
        }
    }

    /*#[Route('/', name: 'utilisateur.pagePerso')]
    public function pagePers(ManagerRegistry $doctrine, Request $request): Response
    {

    }*/
}

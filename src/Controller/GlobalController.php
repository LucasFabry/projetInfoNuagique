<?php

namespace App\Controller;

use App\Entity\Etudiant;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GlobalController extends AbstractController
{
    #[Route('/', name: 'app_global')]
    public function index(): Response
    {
        return $this->render('global/index.html.twig', [
            'css' => 'css/accueil.css',
        ]);
    }

    #[Route('/connexion', name: 'global.connexion')]
    public function getConnexion(): Response
    {
        return $this->render('global/connexion.html.twig', [
            'css' => 'login.css',
        ]);
    }

    #[Route('/edt', name: 'global.edt')]
    public function getEDT(): Response
    {
        return $this->render('global/timetable.html.twig', [
            'css' => 'css/edt.css',
        ]);
    }

    #[Route('/qrcode', name: 'global.qrcode')]
    public function getQRCode(): Response
    {
        $listeCoursEtu = $this->getUser()->getCoursEtudiants();

        return $this->render('global/qrcode.html.twig', [
            'css' => 'css/qrcode.css',
            'coursEtudiants' => $listeCoursEtu
        ]);
    }

    #[Route('/presGenerale', name: 'global.presGenerale')]
    public function getPresGenerale() : Response{

       
        return $this->render('global/presentation.html.twig', [
            'css' => 'css/profil.css' ,

        ]);
    }
}

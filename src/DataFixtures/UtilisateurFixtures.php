<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UtilisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $repo = $manager->getRepository(Classe::class);
        $faker = Factory::create("fr_FR");;
        
        $classe = new Classe();
        $classe->setNomPromo('SNI-4-B2');
        $manager->persist($classe);
        $classe2 = new Classe();
        $classe2->setNomPromo('SNI-4-B2');
        $manager->persist($classe2);
        $classe3 = new Classe();
        $classe3->setNomPromo('SNI-4-B2');
        $manager->persist($classe3);
        $manager->flush();

        $tabClasse = $repo->findAll();
        for ($i=0; $i < 100; $i++) { 
            $user = new Utilisateur();
            $user->setNom($faker->lastname);
            $user->setPrenom($faker->firstname);
            $user->setPassword($faker->password);
            $num = random_int(10000,99999);
            $user->setNumEtudiant($num);
            $user->setNumAuth($num);
            shuffle($tabClasse);
            $user->setClasse($tabClasse[0]);
            $manager->persist($user);
        }
        
        $manager->flush();
        
    }
}

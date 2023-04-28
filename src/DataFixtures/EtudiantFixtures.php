<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class EtudiantFixtures extends Fixture implements FixtureGroupInterface
{

    public function __construct(
        private UserPasswordHasherInterface $hasher
    ){

    }

    public function load(ObjectManager $manager): void
    {
        //Création du Faker
        $faker = Factory::create("fr_FR");;
       //Récupération de toutes les classes disponibles
        $classeManager = $manager->getRepository(Classe::class);

        $classe = new Classe();
        $classe->setNomPromo('SNI-4-A1');
        $manager->persist($classe);
        $classe2 = new Classe();
        $classe2->setNomPromo('SNI-4-A2');
        $manager->persist($classe2);
        $classe3 = new Classe();
        $classe3->setNomPromo('SNI-4-B2');
        $manager->persist($classe3);
        $manager->flush();

        $classes = $classeManager->findAll();
       //Création des administrateurs
       for ($i=0; $i < 5; $i++) { 
            $admin = new Etudiant();
            $admin->setNumEtudiant("123456$i");
            $admin->setPassword($this->hasher->hashPassword($admin,"admin"));
            $admin->setRoles(['ROLE_ADMIN']);
            $admin->setNom($faker->lastname);
            $admin->setPrenom($faker->firstname);
            $admin->setMail($faker->email);
            $admin->setIsVerified(true);
            $manager->persist($admin);
       }

       //Création des professeurs
       for ($i=0; $i < 5; $i++) { 
            $admin = new Etudiant();
            $admin->setNumEtudiant("1234567$i");
            $admin->setPassword($this->hasher->hashPassword($admin,"admin"));
            $admin->setRoles(['ROLE_PROF']);
            $admin->setNom($faker->lastname);
            $admin->setPrenom($faker->firstname);
            $admin->setMail($faker->email);
            $admin->setIsVerified(true);
            $manager->persist($admin);
        }

       //Création des étudiants
       for ($i=0; $i < 50; $i++) { 
            $user = new Etudiant();
            $user->setNumEtudiant("12345678$i");
            $user->setPassword($this->hasher->hashPassword($user,"admin"));
            $user->setRoles(['ROLE_USER']);
            $user->setNom($faker->lastname);
            $user->setPrenom($faker->firstname);
            $user->setMail($faker->email);
            $user->setIsVerified(true);
            shuffle($classes);
            $user->setClasse($classes[0]);
            $manager->persist($user);
       }
       
        /* $admin1 = new Etudiant();
        $admin1->setNumEtudiant("123456");
        $admin1->setPassword($this->hasher->hashPassword($admin1,"admin"));
        $admin1->setRoles(['ROLE_ADMIN']);
        $admin1->setPrenom("Lucas");
        $admin2 = new Etudiant();
        $admin2->setNumEtudiant("12345678");
        $admin2->setPassword($this->hasher->hashPassword($admin2,"admin"));
        $admin2->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin1);
        $manager->persist($admin2);
        for ($i=0; $i < 5; $i++) { 
            $user = new Etudiant();
            $user->setNumEtudiant("1234$i");
            $user->setPassword($this->hasher->hashPassword($user,"user"));
            $manager->persist($user);
        }*/

        $manager->flush();
    }

    public static function getGroups() : array
    {
        return ['user'];
    }
}

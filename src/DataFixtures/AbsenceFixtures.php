<?php

namespace App\DataFixtures;

use App\Entity\Absence;
use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class AbsenceFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        
        //On crée le faker
        $faker = Factory::create("fr_FR");;
        //On récupère la liste des étudiants
        $etuManager = $manager->getRepository(Etudiant::class);
        $listeEtu = $etuManager->findAll();

        //On génère 100 absences
        for ($i=0; $i <200; $i++){
            $absence = new Absence();
            //Chaque étudiant est placé au hasard
            shuffle($listeEtu);
            $absence->setEtudiant($listeEtu[0]);
            $absence->setDate($faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $format = 'd-n-Y H:i:s'));
            $manager->persist($absence);
        }
        $manager->flush();
    }

    public static function getGroups() : array
    {
        return ['absence'];
    }
}

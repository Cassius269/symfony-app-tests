<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthorFixtures extends Fixture
{
    // Injection de la dépendance de hashage de mot de passe d'un utilisateur 
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}

    public function load(ObjectManager $manager): void
    {
        // Instancier Faker
        $faker = Factory::create('fr_FR'); // Régionnalisation de Faker en français

        // Génération de 10 utilisateurs avec des données factices
        for ($i = 0; $i < 10; $i++) {
            // Déclarer un objet author et remplir les informations personnelles
            $author = new Author;
            $author->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setEmail($faker->email());

            // Hasher le mot de passe
            $hashedPassword = $this->passwordHasher->hashPassword(
                $author,
                $faker->password(8, 12)
            );
            $author->setPassword($hashedPassword);


            // Prevenir Doctrine de l'enregistrement de chaque utilisateur
            $manager->persist($author);
        }

        // executer la requête d'envoi de tous les utilisateurs en base de données
        $manager->flush();
    }
}

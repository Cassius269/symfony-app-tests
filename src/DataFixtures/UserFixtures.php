<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    // Injection de dépendances
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        // Déclarer un objet User et remplir les informations personnelles
        $user = new User;
        $user->setFirstname('Jean')
            ->setLastname('DUPONT')
            ->setEmail('jean-dupont@exemple.com');

        // Hasher le mot de passe
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            '1234'
        );
        $user->setPassword($hashedPassword);


        // Enregistrer l'User dans la base de données
        $manager->persist($user); // construire la requête
        $manager->flush(); // executer la requête d'envoi en base de données
    }
}

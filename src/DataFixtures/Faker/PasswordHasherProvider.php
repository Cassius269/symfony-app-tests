<?php
// src/DataFixtures/Faker/PasswordHasherProvider.php

namespace App\DataFixtures\Faker;

use Faker\Provider\Base;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class PasswordHasherProvider extends Base
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function hashPassword(string $plainPassword): string
    {
        // Crée un utilisateur minimal pour le hachage
        $user = new class implements PasswordAuthenticatedUserInterface {
            public function getPassword(): ?string
            {
                return null;
            }
        };

        return $this->passwordHasher->hashPassword($user, $plainPassword);
    }
}

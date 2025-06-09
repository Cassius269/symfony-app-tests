<?php

namespace App\Tests\Repository;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

// Tester le nombre d'utilisateurs présent en base de données
class UserRepositoryTest extends KernelTestCase
{
    // Utiliser le trait de LiipBundle
    use FixturesTrait;

    public function testCount()
    {
        // Démarrer le kernel
        self::bootKernel();
        // Récuperer le nombre d'utilisateurs depuis le container
        $users = self::getContainer()->get(UserRepository::class)->count([]);

        // Verifier le nombre d'utilisateurs enregistrés de façon factice avec ceux trouvés
        $this->assertEquals(10, $users, 'Le nombre d\'utilisateurs ne correspond pas');
    }
}

<?php

namespace App\Tests\Repository;

use App\Repository\AdminRepository;
use App\Repository\AuthorRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


// Tester le nombre d'auteurs présents en base de données
class AuthorRepositoryTest extends KernelTestCase
{

    // Création d'une variable qui va stocker l'outil de gestion de base de données de test
    private $databaseTool;

    // La fonction setUp s'execute avant chaque test
    public function setUp(): void
    {
        parent::setUp();

        // on injecte la classe DatabaseToolCollection dans la propriété pour l'utiliser dans les tests
        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testRepositoryCount(): void
    {
        // On charge les utilisateurs en base de données
        $users = $this->databaseTool->loadAliceFixture([
            \dirname(__DIR__) . '/Fixtures/UserTestFixtures.yaml'
        ]);


        // On compte le nombre d'auteurs depuis le container
        $admins = self::getContainer()->get(AdminRepository::class)->count([]);

        // Verifier le nombre d'utilisateurs enregistrés de façon factice avec ceux trouvés
        $this->assertSame(1, $admins, 'Le nombre d\'auteurs ne correspond pas');
    }
}

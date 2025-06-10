<?php

namespace App\Tests\Repository;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

// Tester le nombre de livres présents en base de données
class BookRepositoryTest extends KernelTestCase
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
        // On charge les données de test des livres en base de données
        $this->databaseTool->loadAliceFixture([
            \dirname(__DIR__) . '/Fixtures/BookTestFixtures.yaml'
        ]);

        // On compte le nombre de livres depuis le container
        $books =  self::getContainer()->get(BookRepository::class)->count([]);

        // Verifier le nombre de livres enregistrés en base de données
        $this->assertSame(20, $books);
    }
}

<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use App\DataFixtures\UserFixtures;
use Doctrine\ORM\Tools\SchemaTool;
use App\DataFixtures\ClientFixtures;
use App\DataFixtures\ProductFixtures;
use Doctrine\ORM\Tools\ToolsException;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class DoctrineContext implements Context
{
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @BeforeScenario
     *
     * @throws ToolsException
     */
    public function initDatabase()
    {
        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->dropSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
        $schemaTool->createSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
        $this->loadFixtures();
    }

    private function loadFixtures()
    {
        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->entityManager, $purger);

        $productFixtures = new ProductFixtures();
        $clientFixtures = new ClientFixtures();
        $userFixtures = new UserFixtures();

        $loader = new Loader();
        $loader->addFixture($productFixtures);
        $loader->addFixture($clientFixtures);
        $loader->addFixture($userFixtures);

        $executor->execute($loader->getFixtures());
    }
}
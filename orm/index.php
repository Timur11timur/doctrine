<?php

declare(strict_types = 1);

use App\Entity\User;
use App\Enum\StatusEnum;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

require_once(__DIR__ . '/vendor/autoload.php');

$dotenv = Dotenv::createImmutable(dirname(__DIR__ . '/dbal'));
$dotenv->load();

$dsnParser = new DsnParser();
$connectionParams = $dsnParser
    ->parse("mysqli://" . $_ENV['DB_USERNAME'] .":" . $_ENV['DB_PASSWORD'] . "@" . $_ENV['DB_HOST'] . "/" . $_ENV['DB_DATABASE']);

$conn = DriverManager::getConnection($connectionParams);

$entityManager = new EntityManager(
    $conn,
    ORMSetup::createAttributeMetadataConfiguration([
        __DIR__ . '/Entity/Entity',
    ])
);

$user = (new User())
    ->setFirstName('FirstName1')
    ->setLastName('LastName')
    ->setEmail('some@email.com')
    ->setPassword('Password')
    ->setRoles('Admin, Dev')
    ->setStatus(StatusEnum::ACTIVE)
    ->setCreatedAt(new DateTime())
    ->setUpdatedAt(new DateTime());

$entityManager->persist($user);

$entityManager->flush();


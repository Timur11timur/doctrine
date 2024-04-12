<?php

declare(strict_types = 1);

use Doctrine\DBAL\ArrayParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;

require_once(__DIR__ . '/vendor/autoload.php');

$dotenv = Dotenv::createImmutable(dirname(__DIR__ . '/dbal'));
$dotenv->load();

$connectionParams = [
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
];

$conn = DriverManager::getConnection($connectionParams);

//$stmt = $conn->prepare("SELECT * FROM `users`");
//$result = $stmt->executeQuery();

//$result = $conn->executeQuery("SELECT * FROM `users`");

//var_dump($result->fetchAllAssociative());

//$stmt = $conn->prepare("SELECT * FROM `users` WHERE id = :id");
//$stmt->bindValue('id', 50);
//$result = $stmt->executeQuery();
//var_dump($result->fetchAssociative());

//$stmt = $conn->prepare("SELECT ID,LastEmailOn  FROM `users` WHERE LastEmailOn BETWEEN :from AND :to");

//$from = "2023-01-01 00:00:00";
//$to = "2023-05-31 23:59:59";
//$stmt->bindValue('from', $from);
//$stmt->bindValue('to', $to);

//$from = new DateTime("01/01/2023 00:00:00");
//$to = new DateTime("05/31/2023 23:59:59");
//$stmt->bindValue('from', $from, 'datetime');
//$stmt->bindValue('to', $to, 'datetime');
//
//$result = $stmt->executeQuery();
//var_dump($result->fetchAllAssociative());

//$result = $conn->executeQuery("SELECT ID,LastEmailOn  FROM `users` WHERE ID IN (?)", [[51, 52, 53]], [ArrayParameterType::INTEGER]);
//var_dump($result->fetchAllAssociative());

//$result = $conn->fetchAllAssociative("SELECT ID,LastEmailOn  FROM `users` WHERE ID IN (?)", [[51, 52, 53]], [ArrayParameterType::INTEGER]);
//var_dump($result);

$builder = $conn->createQueryBuilder();

$users = $builder
    ->select('ID', 'FirstName')
    ->where('ID > ?')
    ->from('users')
    ->setParameter(0, 20)
//    ->getSQL()
    ->fetchAllAssociative();

var_dump($users);

$schema = $conn->createSchemaManager();

var_dump($schema->listTableNames());

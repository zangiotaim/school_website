<?php

date_default_timezone_set('Asia/Tashkent');

$server = '127.0.0.1';
$username = 'db_name';
$password = 'db_password';
$database = 'db_name';
$databasePort = 3311;
$databaseCharset = 'utf8mb4';
$databaseSessionOffset = '+05:00';

function create_pdo_connection($server, $username, $password, $database, $databasePort, $databaseCharset, $databaseSessionOffset)
{
    $dsn = "mysql:host={$server};port={$databasePort};dbname={$database};charset={$databaseCharset}";

    $pdo = new PDO(
        $dsn,
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    $pdo->exec("SET time_zone = '{$databaseSessionOffset}'");

    return $pdo;
}

function db_select_all(PDO $connection, string $sql, array $params = []): array
{
    $stmt = $connection->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll();
}

function db_select_one(PDO $connection, string $sql, array $params = []): ?array
{
    $stmt = $connection->prepare($sql);
    $stmt->execute($params);
    $row = $stmt->fetch();

    return $row === false ? null : $row;
}

function db_execute(PDO $connection, string $sql, array $params = []): bool
{
    $stmt = $connection->prepare($sql);

    return $stmt->execute($params);
}

$pdo = create_pdo_connection($server, $username, $password, $database, $databasePort, $databaseCharset, $databaseSessionOffset);
$connection = $pdo;

<?php
namespace KoruPHP\Database;

use PDO;

class Connection
{
    private PDO $pdo;

    public function __construct(string $dsn, string $user = '', string $pass = '')
    {
        $this->pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}

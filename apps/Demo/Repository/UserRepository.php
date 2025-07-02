<?php
namespace Apps\Demo\Repository;

use PDO;

class UserRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findAll(): array
    {
        return $this->pdo->query('SELECT id, name FROM users')->fetchAll(PDO::FETCH_ASSOC);
    }
}

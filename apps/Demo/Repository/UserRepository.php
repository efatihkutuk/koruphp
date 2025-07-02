<?php
namespace Apps\Demo\Repository;

use PDO;

class UserRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function init(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
        )");

        $stmt = $this->pdo->prepare('INSERT OR IGNORE INTO users (username, password) VALUES (?, ?)');
        $stmt->execute(['admin', '2bb80d537b1da3e38bd30361aa855686bde0eacd7162fef6a25fe97bf527a25b']);
    }

    public function findAll(): array
    {
        return $this->pdo->query('SELECT id, username FROM users')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }
}

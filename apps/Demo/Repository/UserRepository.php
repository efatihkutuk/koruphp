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
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $stmt = $this->pdo->prepare('INSERT IGNORE INTO users (username, password) VALUES (?, ?)');
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

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT id, username FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function create(string $username, string $password): void
    {
        $hash = hash('sha256', $password);
        $stmt = $this->pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $stmt->execute([$username, $hash]);
    }

    public function update(int $id, string $username, ?string $password = null): void
    {
        if ($password !== null && $password !== '') {
            $hash = hash('sha256', $password);
            $stmt = $this->pdo->prepare('UPDATE users SET username = ?, password = ? WHERE id = ?');
            $stmt->execute([$username, $hash, $id]);
        } else {
            $stmt = $this->pdo->prepare('UPDATE users SET username = ? WHERE id = ?');
            $stmt->execute([$username, $id]);
        }
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);
    }
}

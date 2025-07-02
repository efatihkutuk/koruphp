<?php
namespace KoruPHP\Session;

use PDO;
use SessionHandlerInterface;

class DbSessionHandler implements SessionHandlerInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function open($savePath, $name): bool
    {
        return true;
    }

    public function close(): bool
    {
        return true;
    }

    public function read($id): string|false
    {
        $stmt = $this->pdo->prepare('SELECT data FROM sessions WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['data'] ?? '';
    }

    public function write($id, $data): bool
    {
        $stmt = $this->pdo->prepare('REPLACE INTO sessions (id, data, last_activity) VALUES (?, ?, ?)');
        return $stmt->execute([$id, $data, time()]);
    }

    public function destroy($id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM sessions WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function gc($maxlifetime): int|false
    {
        $stmt = $this->pdo->prepare('DELETE FROM sessions WHERE last_activity < ?');
        $stmt->execute([time() - $maxlifetime]);
        return $stmt->rowCount();
    }
}

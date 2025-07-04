<?php
namespace Apps\Demo\Repository;

use PDO;

class SessionRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT id, user, ip, user_agent, last_page, last_activity FROM sessions ORDER BY last_activity DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

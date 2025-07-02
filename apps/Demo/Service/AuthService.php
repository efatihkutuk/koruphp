<?php
namespace Apps\Demo\Service;

use Apps\Demo\Repository\UserRepository;

class AuthService
{
    public function __construct(private UserRepository $users, private string $googleToken)
    {
    }

    public function authenticate(string $username, string $password): bool
    {
        $user = $this->users->findByUsername($username);
        if (!$user) {
            return false;
        }
        return hash('sha256', $password) === $user['password'];
    }

    public function googleAuthenticate(string $token): bool
    {
        return $token === $this->googleToken;
    }
}

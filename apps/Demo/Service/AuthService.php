<?php
namespace Apps\Demo\Service;

use Apps\Demo\Repository\UserRepository;

class AuthService
{
    public function __construct(private UserRepository $users, private string $googleClientId)
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

    public function googleAuthenticate(string $token): ?string
    {
        if ($token === '') {
            return null;
        }

        $info = @file_get_contents('https://oauth2.googleapis.com/tokeninfo?id_token=' . urlencode($token));
        if ($info === false) {
            return null;
        }
        $data = json_decode($info, true);
        if (!$data || ($data['aud'] ?? '') !== $this->googleClientId) {
            return null;
        }
        return $data['email'] ?? ($data['sub'] ?? null);
    }

    public function getGoogleClientId(): string
    {
        return $this->googleClientId;
    }
}


<?php
namespace Apps\Demo\Controller;

use Apps\Demo\Service\AuthService;
use KoruPHP\View\View;

class AuthController
{
    public function __construct(private AuthService $auth, private View $view)
    {
    }

    public function form(): string
    {
        return $this->view->render('login.php', [
            'googleClientId' => $this->auth->getGoogleClientId(),
        ]);
    }

    public function login(): string
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        if ($this->auth->authenticate($username, $password)) {
            $_SESSION['user'] = $username;
            return 'Logged in as ' . $username;
        }
        return 'Invalid credentials';
    }

    public function googleCallback(): string
    {
        $token = $_POST['credential'] ?? '';
        $email = $this->auth->googleAuthenticate($token);
        if ($email) {
            $_SESSION['user'] = $email;
            return 'Logged in with Google';
        }
        return 'Google authentication failed';
    }
}

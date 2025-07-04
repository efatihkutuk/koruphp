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
        return $this->view->render('login.twig', [
            'googleClientId' => $this->auth->getGoogleClientId(),
            'session' => $_SESSION
        ]);
    }

    public function login(): string
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        if ($this->auth->authenticate($username, $password)) {
            $_SESSION['user'] = $username;
            header('Location: /');
            return '';
        }
        return 'Invalid credentials';
    }

    public function googleCallback(): string
    {
        $token = $_POST['credential'] ?? '';
        $email = $this->auth->googleAuthenticate($token);
        if ($email) {
            $_SESSION['user'] = $email;
            header('Location: /');
            return '';
        }
        return 'Google authentication failed';
    }

    public function logout(): string
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        header('Location: /login');
        return '';
    }
}

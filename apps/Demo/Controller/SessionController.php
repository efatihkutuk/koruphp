<?php
namespace Apps\Demo\Controller;

use Apps\Demo\Repository\SessionRepository;
use KoruPHP\View\View;

class SessionController
{
    public function __construct(private SessionRepository $repo, private View $view)
    {
    }

    public function list(): string
    {
        $sessions = $this->repo->findAll();
        return $this->view->render('sessions.twig', ['sessions' => $sessions, 'session' => $_SESSION]);
    }
}

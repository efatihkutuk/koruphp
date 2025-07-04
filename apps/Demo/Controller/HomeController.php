<?php
namespace Apps\Demo\Controller;

use KoruPHP\View\View;
use Apps\Demo\Service\GreetingService;

class HomeController
{
    public function __construct(private GreetingService $greeting, private View $view)
    {
    }

    public function index(): string
    {
        $message = $this->greeting->greet($_SESSION['user'] ?? 'Guest');
        return $this->view->render('home.twig', ['message' => $message, 'session' => $_SESSION]);
    }
}

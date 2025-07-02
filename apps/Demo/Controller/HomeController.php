<?php
namespace Apps\Demo\Controller;

use KoruPHP\View\View;

class HomeController
{
    public function index(): string
    {
        $view = new View(__DIR__.'/../View');
        return $view->render('home.php', ['message' => 'Welcome to KoruPHP Demo']);
    }
}

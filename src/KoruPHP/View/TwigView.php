<?php
namespace KoruPHP\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigView extends View
{
    private Environment $twig;

    public function __construct(string $basePath)
    {
        parent::__construct($basePath);
        $loader = new FilesystemLoader($basePath);
        $this->twig = new Environment($loader);
    }

    public function render(string $template, array $params = []): string
    {
        return $this->twig->render($template, $params);
    }
}

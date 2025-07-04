<?php
namespace KoruPHP\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigView
{
    private Environment $twig;

    public function __construct(private string $basePath)
    {
        $loader = new FilesystemLoader($this->basePath);
        $this->twig = new Environment($loader);
    }

    public function render(string $template, array $params = []): string
    {
        return $this->twig->render($template, $params);
    }
}

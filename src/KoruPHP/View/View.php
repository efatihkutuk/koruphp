<?php
namespace KoruPHP\View;

class View
{
    public function __construct(private string $basePath)
    {
    }

    public function render(string $template, array $params = []): string
    {
        $path = rtrim($this->basePath, '/').'/'.$template;
        extract($params, EXTR_OVERWRITE);
        ob_start();
        include $path;
        return ob_get_clean();
    }
}

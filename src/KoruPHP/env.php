<?php
function loadEnv(string $file): void
{
    if (!is_readable($file)) {
        return;
    }
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) {
            continue;
        }
        if (!str_contains($line, '=')) {
            continue;
        }
        [$name, $value] = array_map('trim', explode('=', $line, 2));
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv("$name=$value");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

function env(string $key, $default = null)
{
    $value = getenv($key);
    return $value === false ? $default : $value;
}

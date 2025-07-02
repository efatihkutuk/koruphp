# KoruPHP

KoruPHP is a lightweight PHP framework inspired by modern frameworks while remaining easy to extend. It supports controllers, middleware, services, repositories, simple token authentication and templating.

## Getting Started

1. Install dependencies using [Composer](https://getcomposer.org/):

```bash
composer install
```

2. Start the development server:

```bash
php -S localhost:8080 -t public
```

The demo uses an in-memory SQLite database created automatically on first run.
For Google login the expected token can be changed via the `KORUPHP_GOOGLE_TOKEN` environment variable.

Visit `/login` to authenticate using the built in demo user (`admin` / `secret`) or try the Google demo with `/google-login?token=test-google-token`.
After logging in (or by providing the header `Authorization: Bearer secret`) you can access the protected home page at `http://localhost:8080`.

## Directory Structure

- `src/` – framework source files
- `config/` – configuration files
- `public/` – web entry point
- `apps/` – place your applications here

## Extending

KoruPHP ships with a very small core so that you can easily add new libraries or features such as Redis. Create additional services and middleware and register them in `src/KoruPHP/bootstrap.php`.

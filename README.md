# KoruPHP

KoruPHP is a lightweight framework that borrows ideas from modern PHP stacks while staying easy to extend. It supports controllers, middleware, services, repositories and simple templating.

## Getting Started

1. Install dependencies with [Composer](https://getcomposer.org/):

```bash
composer install
```

2. Initialise the SQLite database (creates `data/app.sqlite`):

```bash
php setup.php
```

3. Launch the development server:

```bash
php -S localhost:8080 -t public
```

Browse to `http://localhost:8080/login` to sign in with the demo credentials (`admin` / `secret`) or click the Google login button. After authentication you can view the protected home page at `http://localhost:8080`.

## Configuration

Settings are stored in `config/config.php` and can be overridden via environment variables. By default a local SQLite file is used and the expected Google token is `test-google-token`.

## Directory Structure

- `src/` – framework source
- `apps/` – your applications
- `config/` – configuration files
- `public/` – web entry point
- `data/` – database files (ignored in git)

## Creating Components

The framework relies on simple PHP classes:

- **Controllers** handle web requests. They receive their dependencies via the container. See `apps/Demo/Controller` for examples.
- **Services** contain business logic and can be shared between controllers. Register them in `src/KoruPHP/bootstrap.php`.
- **Repositories** wrap database access. The demo `UserRepository` also seeds the database on first run.
- **Views** are basic PHP templates rendered through `KoruPHP\View\View`.

Add your own classes following these patterns and wire them up in `bootstrap.php`.

## Extending Further

KoruPHP intentionally keeps the core small. You can easily introduce new middleware or libraries such as Redis by registering additional services in the bootstrap file.

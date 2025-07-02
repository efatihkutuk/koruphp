# KoruPHP

KoruPHP is a lightweight framework that borrows ideas from modern PHP stacks while staying easy to extend. It supports controllers, middleware, services, repositories and simple templating.

## Getting Started

1. Install dependencies with [Composer](https://getcomposer.org/):

```bash
composer install
```

2. Copy `.env.example` to `.env` and adjust the settings if required.

3. Initialise the SQLite database (creates `data/app.sqlite`):

```bash
php setup.php
```

4. Launch the development server:

```bash
php -S localhost:8080 -t public
```

Browse to `http://localhost:8080/login` to sign in with the demo credentials (`admin` / `secret`) or click the Google login button. After authentication you can view the protected home page at `http://localhost:8080`.

## Configuration

Settings are loaded from `.env` and fall back to values in `config/config.php`. The default setup uses a local SQLite file and expects the Google token `test-google-token`.

## Directory Structure

- `src/` – framework source
- `apps/` – your applications
- `config/` – configuration files
- `public/` – web entry point
- `data/` – database files (ignored in git)

## Creating Applications

Each subdirectory of `apps/` represents an application. Add a `services.php` file to register services with the container and a `routes.php` file to configure routes. Both files return a callback that receives the container or application instance.

Controllers, services, repositories and views live under the app directory just like the `Demo` example. When you add a new app with these files it becomes available automatically – no further bootstrap changes are required.

## Extending Further

KoruPHP intentionally keeps the core small. You can easily introduce new middleware or libraries such as Redis by registering additional services in `services.php`.

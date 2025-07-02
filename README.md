# KoruPHP

KoruPHP is a lightweight framework that borrows ideas from modern PHP stacks while staying easy to extend. It supports controllers, middleware, services, repositories and simple templating.

## Getting Started

1. Install dependencies with [Composer](https://getcomposer.org/):

```bash
composer install
```

2. Copy `.env.example` to `.env` and adjust the settings if required.

Ensure a MySQL database named `koruphp` exists and is accessible with the `root` user.

3. Initialise the MySQL database (ensure MySQL is running on `localhost:3306` with user `root` and an empty password):

```bash
php setup.php
```

4. Launch the development server:

```bash
php -S localhost:8080 -t public
```

Browse to `http://localhost:8080/login` to sign in. The demo user credentials are:

```
username: admin
password: secret
```

You can also click the Google login button. After authentication you can view the
protected home page at `http://localhost:8080`.

## Configuration

Settings are loaded from `.env` and fall back to values in `config/config.php`. The
default setup connects to a MySQL database named `koruphp` on `localhost` using the
`root` user. Set `KORUPHP_GOOGLE_CLIENT_ID` to your Google OAuth client ID so that the
login button works. Session data is stored in the database table `sessions` so your
users remain logged in even after server restarts.

## Directory Structure

- `src/` – framework source
- `apps/` – your applications
- `config/` – configuration files
- `public/` – web entry point
- `data/` – database files (ignored in git)

## Creating Applications

Each subdirectory of `apps/` represents an application. Add a `services.php` file to
register services with the container and a `routes.php` file to configure routes.
Both files return a callback that receives the container or application instance.

Controllers, services, repositories and views live under the app directory just
like the `Demo` example. A typical layout is:

```
apps/
  MyApp/
    Controller/
    Service/
    Repository/
    View/
    services.php
    routes.php
```

Define your controllers under `Controller/`, business logic in `Service/` classes and
database access in `Repository/`. Register these in `services.php` and expose HTTP
endpoints via `routes.php`. When you add a new app with these files it becomes
available automatically – no further bootstrap changes are required.

## Extending Further

KoruPHP intentionally keeps the core small. You can easily introduce new middleware or libraries such as Redis by registering additional services in `services.php`.

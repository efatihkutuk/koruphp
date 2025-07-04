# KoruPHP

KoruPHP is a lightweight framework that borrows ideas from modern PHP stacks while staying easy to extend. It supports controllers, middleware, services and repositories. Views are rendered with the [Twig](https://twig.symfony.com/) template engine so you can build clean UIs with reusable layouts.

## Getting Started

1. Install dependencies with [Composer](https://getcomposer.org/):

```bash
composer install
```

2. Copy `.env.example` to `.env` and adjust the settings if required.

Ensure a MySQL database named `koruphp` exists and is accessible with the `root` user.

3. Initialise the MySQL database (ensure MySQL is running on `localhost:3306` with user `root` and an empty password). This drops any existing demo tables and recreates them so you can rerun it whenever the schema changes:

```bash
php setup.php
```

4. Launch the development server:

```bash
php -S localhost:8080 -t public
```

The demo uses Twig templates under `apps/Demo/View` and the styles defined in
`public/css/style.css` for a simple responsive layout.

Browse to `http://localhost:8080/login` to sign in. The demo user credentials are:

```
username: admin
password: secret
```
These credentials are inserted automatically when you run `php setup.php`.

You can also click the Google login button. After authentication you can view the
protected home page at `http://localhost:8080`.

Visit `http://localhost:8080/sessions` (requires authentication) to see a table of
active sessions including IP address, last visited page and activity time.

You can also manage users via a simple CRUD interface:

```
http://localhost:8080/users        # list users
http://localhost:8080/users/create # add a user
```

Editing and deleting are available from the list view. Authentication is required for all user management pages.

## Configuration

Settings are loaded from `.env` and fall back to values in `config/config.php`. The
default setup connects to a MySQL database named `koruphp` on `localhost` using the
`root` user. Set `KORUPHP_GOOGLE_CLIENT_ID` to your Google OAuth client ID so that the
login button works. Session data is stored in the database table `sessions` so your
users remain logged in even after server restarts. Each entry records the user name,
IP address, user agent, last visited page and last activity time.

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

The demo app registers multiple repositories and services – for example `UserRepository`
and `SessionRepository` for database access plus `AuthService` and `GreetingService`.
You can declare as many services as you need and fetch them from the container
inside your controllers.

## Extending Further

KoruPHP intentionally keeps the core small. You can easily introduce new middleware or libraries such as Redis by registering additional services in `services.php`.

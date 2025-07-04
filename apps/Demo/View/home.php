<!DOCTYPE html>
<html>
<head>
    <title>KoruPHP Demo</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>KoruPHP Demo</header>
    <div class="container">
    <h1><?= htmlspecialchars($message) ?></h1>
    <p>Logged in as <?= htmlspecialchars($session['user'] ?? 'guest') ?> | <a href="/logout">Logout</a></p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>KoruPHP Demo</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h1><?= htmlspecialchars($message) ?></h1>
    <p>Logged in as <?= htmlspecialchars($_SESSION['user'] ?? 'guest') ?> | <a href="/logout">Logout</a></p>
</body>
</html>

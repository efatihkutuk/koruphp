<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header>KoruPHP Demo</header>
<div class="container">
<h1>Login</h1>
<?php if (isset($session['user'])): ?>
<p>You are logged in as <?= htmlspecialchars($session['user']) ?>. <a href="/">Go to home</a></p>
<?php endif; ?>
<form method="POST" action="/login">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<?php if (!empty($googleClientId)): ?>
<div id="g_id_onload"
     data-client_id="<?= htmlspecialchars($googleClientId) ?>"
     data-login_uri="/google-callback"
     data-ux_mode="popup">
</div>
<div class="g_id_signin" data-type="standard"></div>
<script src="https://accounts.google.com/gsi/client" async defer></script>
<?php endif; ?>
</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        form { margin-bottom: 1em; }
    </style>
</head>
<body>
<h1>Login</h1>
<?php if (isset($_SESSION['user'])): ?>
<p>You are logged in as <?= htmlspecialchars($_SESSION['user']) ?>. <a href="/">Go to home</a></p>
<?php endif; ?>
<form method="POST" action="/login">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<div id="g_id_onload"
     data-client_id="<?= htmlspecialchars($googleClientId) ?>"
     data-login_uri="/google-callback"
     data-ux_mode="popup">
</div>
<div class="g_id_signin" data-type="standard"></div>
<pre id="message"></pre>
<script src="https://accounts.google.com/gsi/client" async defer></script>
</body>
</html>

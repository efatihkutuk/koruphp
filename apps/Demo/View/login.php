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
<form method="POST" action="/login">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<button id="google-btn" type="button">Login with Google</button>
<pre id="message"></pre>
<script>
  document.getElementById('google-btn').addEventListener('click', function () {
    fetch('/google-login?token=test-google-token')
      .then(r => r.text())
      .then(t => document.getElementById('message').textContent = t);
  });
</script>
</body>
</html>

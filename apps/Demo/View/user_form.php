<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Form</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header>KoruPHP Demo</header>
<div class="container">
<h1><?= $user ? 'Edit User' : 'Add User' ?></h1>
<form method="POST" action="<?= htmlspecialchars($action) ?>">
    <?php if ($user): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
    <?php endif; ?>
    <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
    <input type="password" name="password" placeholder="Password" <?= $user ? '' : 'required' ?>>
    <button type="submit">Save</button>
</form>
<p><a href="/users">Back to list</a></p>
</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Users</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<h1>Users</h1>
<p><a href="/users/create">Add User</a> | <a href="/">Home</a></p>
<table>
    <tr><th>ID</th><th>Username</th><th class="actions">Actions</th></tr>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= htmlspecialchars($u['id']) ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td class="actions">
                <a href="/users/edit?id=<?= $u['id'] ?>">Edit</a>
                <a href="/users/delete?id=<?= $u['id'] ?>" onclick="return confirm('Delete user?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>

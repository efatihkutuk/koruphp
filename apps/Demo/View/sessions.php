<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sessions</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header>KoruPHP Demo</header>
<div class="container">
<h1>Active Sessions</h1>
<table>
    <tr><th>ID</th><th>User</th><th>IP</th><th>User Agent</th><th>Last Page</th><th>Last Activity</th></tr>
    <?php foreach ($sessions as $s): ?>
        <tr>
            <td><?= htmlspecialchars($s['id']) ?></td>
            <td><?= htmlspecialchars($s['user'] ?? '') ?></td>
            <td><?= htmlspecialchars($s['ip']) ?></td>
            <td><?= htmlspecialchars($s['user_agent']) ?></td>
            <td><?= htmlspecialchars($s['last_page']) ?></td>
            <td><?= htmlspecialchars(date('Y-m-d H:i:s', strtotime($s['last_activity']))) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<p><a href="/">Home</a></p>
</div>
</body>
</html>

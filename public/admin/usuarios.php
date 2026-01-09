<?php
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../../app/models/User.php';

$userModel = new User();
$users = $userModel->getAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de usuarios</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<h1>Gestión de usuarios</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= $user['role'] ?></td>
            <td>
                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                    <form action="user_action.php" method="POST" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?= $user['id'] ?>">
                        <input type="submit" value="Eliminar" onclick="return confirm('¿Eliminar usuario?')">
                    </form>
                <?php else: ?>
                    —
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="productos.php">Volver al panel</a>

</body>
</html>

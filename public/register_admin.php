<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Admin</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<h2 style="text-align:center;">Registro de Administrador</h2>

<form action="../app/controllers/AuthController.php" method="POST">
    <label>Nombre:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <input type="hidden" name="role" value="admin">
    <input type="hidden" name="action" value="register">
    <input type="submit" value="Registrar Admin">
</form>

<p>¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
</body>
</html>

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<form action="../app/controllers/AuthController.php" method="POST">
    <h2>Iniciar Sesión</h2>
    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <input type="hidden" name="action" value="login">
    <button type="submit">Iniciar sesión</button>

    <a class="form-link" href="register.php">¿No tienes cuenta? Regístrate aquí</a>
</form>
</body>
</html>

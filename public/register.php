<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Cliente</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<form action="../app/controllers/AuthController.php" method="POST">
    <h2>Registro</h2>

    <label>Nombre:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <input type="hidden" name="role" value="client">
    <input type="hidden" name="action" value="register">

    <button type="submit">Registrar</button>
    <a class="form-link" href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
</form>
</body>
</html>


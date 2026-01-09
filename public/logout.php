<?php
session_start();

// Vaciar todas las variables de sesión
$_SESSION = [];

// Destruir la sesión
session_destroy();

// Redirigir a la landing pública
header('Location: home.php');
exit;

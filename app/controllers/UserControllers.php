<?php
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../../public/login.php');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/Zapatillas/tienda-zapatillas-php/app/models/User.php';


$userModel = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    // Evitar que el admin se elimine a sí mismo
    if ($id != $_SESSION['user_id']) {
        $userModel->delete($id);
    }
}

header('Location: ../../public/admin/usuarios.php');
exit;

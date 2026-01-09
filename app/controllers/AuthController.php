<?php
session_start();

require_once dirname(__DIR__) . '/models/User.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/login.php');
    exit;
}

$action = $_POST['action'] ?? '';

$userModel = new User();

/* =======================
   REGISTRO
======================= */
if ($action === 'register') {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'client';

    if (empty($name) || empty($email) || empty($password)) {
        header('Location: ../../public/register.php?error=empty');
        exit;
    }

    // 🔐 HASH CORRECTO
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $userModel->create($name, $email, $hashedPassword, $role);

    header('Location: ../../public/login.php?success=registered');
    exit;
}

/* =======================
   LOGIN
======================= */
if ($action === 'login') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        header('Location: ../../public/login.php?error=empty');
        exit;
    }

    $user = $userModel->getByEmail($email);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header('Location: ../../public/admin/productos.php');
        } else {
            header('Location: ../../public/index.php');
        }
        exit;
    }

    header('Location: ../../public/login.php?error=invalid');
    exit;
}

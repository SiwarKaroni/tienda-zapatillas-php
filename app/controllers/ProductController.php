<?php
session_start();
require_once dirname(__DIR__) . '/models/Product.php';

// Solo admins
if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../../public/login.php');
    exit;
}

$productModel = new Product();
$action = $_POST['action'] ?? '';

if ($action === 'create') {

    $name = trim($_POST['name'] ?? '');
    $price = $_POST['price'] ?? '';
    $description = trim($_POST['description'] ?? '');
    $image = null;

    if ($name === '' || $price === '') {
        header('Location: ../../public/admin/productos.php?error=empty');
        exit;
    }

    // Subida de imagen
    if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
        $uploadDir = __DIR__ . '/../../public/uploads/';
        $filename = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if(in_array($ext, ['jpg','jpeg','png'])){
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename);
            $image = $filename;
        }
    }

    // Guardar producto con imagen
    $productModel->create($name, $description, $price, $image);

    header('Location: ../../public/admin/productos.php?success=created');
    exit;
}

if ($action === 'delete') {
    $id = $_POST['id'] ?? null;
    if($id) $productModel->delete($id);
    header('Location: ../../public/admin/productos.php');
    exit;
}

header('Location: ../../public/admin/productos.php');
exit;

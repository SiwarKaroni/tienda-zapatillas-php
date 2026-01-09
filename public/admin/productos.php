<?php
session_start();
require_once '../../app/models/Product.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../login.php');
    exit;
}

$productModel = new Product();
$products = $productModel->getAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin - Sport</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<header class="header">
    <div class="header-top">
        <div class="logo">Sport Admin</div>
        <nav class="top-nav">
            <a href="../home.php">Inicio</a>
            <a href="../logout.php" class="btn-login">Cerrar sesión</a>
        </nav>
    </div>
</header>

<div class="hero">
    <h1>Bienvenida, <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
    <p>Desde aquí puedes gestionar productos y usuarios.</p>
</div>

<!-- BOTONES DE ACCIÓN -->
<div class="admin-actions">
    <a href="#add-product-form" class="btn">Añadir producto</a>
    <a href="#product-list" class="btn">Ver productos</a>
    <a href="usuarios.php" class="btn">Usuarios</a>
</div>

<!-- FORMULARIO AGREGAR PRODUCTO -->
<section id="add-product-form">
    <h2>Añadir nuevo producto</h2>
    <form action="../../app/controllers/ProductController.php" method="POST" enctype="multipart/form-data" class="admin-form">
        <input type="hidden" name="action" value="create">

        <label>Nombre</label>
        <input type="text" name="name" required>

        <label>Precio</label>
        <input type="number" step="0.01" name="price" required>

        <label>Descripción</label>
        <textarea name="description"></textarea>

        <label>Imagen (.jpg, .png)</label>
        <input type="file" name="image" accept=".jpg,.jpeg,.png">

        <button type="submit">Guardar producto</button>
    </form>
</section>

<!-- LISTA DE PRODUCTOS EXISTENTES -->
<section id="product-list">
    <h2 style="text-align:center;margin:30px 0;">Productos existentes</h2>
    <div class="catalog">
        <?php foreach($products as $p): ?>
        <div class="product-card">
            <img src="../../uploads/<?= !empty($p['image']) ? htmlspecialchars($p['image']) : 'placeholder.jpg' ?>" alt="<?= htmlspecialchars($p['name']) ?>">
            <div class="info">
                <h3><?= htmlspecialchars($p['name']) ?></h3>
                <p><?= htmlspecialchars($p['description']) ?></p>
                <strong><?= $p['price'] ?> €</strong>
            </div>
            <form action="../../app/controllers/ProductController.php" method="POST">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                <button type="submit" class="btn-action" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</section>

</body>
</html>

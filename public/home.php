<?php
session_start();
require_once __DIR__ . '/../app/models/Product.php';

$productModel = new Product();
$products = $productModel->getAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sport - Tienda de Zapatillas</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="dashboard-home">

<!-- Sidebar -->
<aside class="sidebar">
    <div class="logo">Sport</div>
    <nav>
        <ul>
            <li><a href="home.php">Inicio</a></li>
            <li><a href="#">Hombre</a></li>
            <li><a href="#">Mujer</a></li>
            <li><a href="#">Niño/a</a></li>
            <li><a href="#">Ofertas</a></li>
            <?php if(isset($_SESSION['user_name'])): ?>
                <li><a href="cart.php">🛒 Carrito</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a href="login.php">Iniciar sesión</a></li>
                <li><a href="register.php">Registrarse</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</aside>

<!-- Contenido -->
<main class="dashboard-content">
    <div class="hero">
        <h1>Bienvenido a Sport</h1>
        <p>Las mejores zapatillas para ti, estilo y comodidad en un solo lugar</p>
        <?php if(!isset($_SESSION['user_name'])): ?>
            <a href="register.php" class="btn">Únete ahora</a>
            <a href="login.php" class="btn">Inicia sesión</a>
        <?php endif; ?>
    </div>

    <h2>Catálogo de Productos</h2>
    <div class="catalog">
        <?php foreach($products as $p): ?>
        <div class="product-card">
            <img src="uploads/<?= !empty($p['image']) ? htmlspecialchars($p['image']) : 'placeholder.jpg' ?>" alt="<?= htmlspecialchars($p['name']) ?>">
            <div class="info">
                <h3><?= htmlspecialchars($p['name']) ?></h3>
                <p><?= htmlspecialchars($p['description']) ?></p>
                <strong><?= $p['price'] ?> €</strong>
            </div>
            <?php if(isset($_SESSION['user_name'])): ?>
                <form action="cart_add.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                    <button class="btn-action" type="submit">Añadir al carrito</button>
                </form>
            <?php else: ?>
                <a href="login.php" class="btn-action">Inicia sesión para comprar</a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>

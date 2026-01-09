<?php
session_start();
require_once dirname(__DIR__) . '/app/models/Product.php';

// Solo usuarios logueados
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart) || !is_array($cart)) {
    header('Location: cart.php');
    exit;
}

$productModel = new Product();
$orderProducts = [];
$total = 0;

// Construimos el resumen REAL del pedido
foreach ($cart as $productId => $quantity) {
    $product = $productModel->getById((int)$productId);

    if (is_array($product)) {
        $product['quantity'] = (int)$quantity;
        $product['subtotal'] = $product['price'] * $product['quantity'];
        $total += $product['subtotal'];
        $orderProducts[] = $product;
    }
}

// Guardamos resumen para mostrar
$_SESSION['last_order_products'] = $orderProducts;
$_SESSION['last_order_total'] = $total;

// Vaciar carrito
unset($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra confirmada</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<div class="order-confirmation">
    <div class="confirmation-box">
        <div class="checkmark">✓</div>
        <h1>¡Compra realizada con éxito!</h1>
        <p>Gracias por tu compra, <?= htmlspecialchars($_SESSION['user_name']) ?>.</p>

        <?php if (!empty($_SESSION['last_order_products'])): ?>
        <div class="order-summary">
            <h2>Resumen del pedido</h2>
            <ul>
                <?php foreach ($_SESSION['last_order_products'] as $product): ?>
                    <li>
                        <?= htmlspecialchars($product['name']) ?>
                        × <?= $product['quantity'] ?>
                        — <?= number_format($product['subtotal'], 2) ?> €
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="order-total">
                <strong>Total: <?= number_format($_SESSION['last_order_total'], 2) ?> €</strong>
            </div>
        </div>
        <?php endif; ?>

        <a href="index.php" class="btn-back">Seguir comprando</a>
    </div>
</div>

</body>
</html>

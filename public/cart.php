<?php
session_start();
require_once dirname(__DIR__) . '/app/models/Product.php';

// Solo usuarios logueados
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];

// Seguridad extra
if (!is_array($cart)) {
    $cart = [];
}

$productModel = new Product();
$products = [];
$total = 0;

// Obtenemos info de productos del carrito
foreach ($cart as $productId => $quantity) {
    $product = $productModel->getById((int)$productId);
    if (is_array($product)) {
        $product['quantity'] = (int)$quantity;
        $product['subtotal'] = $product['quantity'] * $product['price'];
        $total += $product['subtotal'];
        $products[] = $product;
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<div class="cart-container">
    <h2>🛒 Tu carrito</h2>

    <?php if (empty($products)): ?>
        <div class="cart-empty">Tu carrito está vacío</div>
        <a href="index.php" class="btn-checkout" style="margin-top:20px;">⬅ Seguir comprando</a>
    <?php else: ?>
    <table class="cart-table">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th></th>
        </tr>

        <?php foreach ($products as $product): ?>
        <tr>
            <td>
                <img src="uploads/<?= !empty($product['image']) ? htmlspecialchars($product['image']) : 'placeholder.jpg' ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <div><?= htmlspecialchars($product['name']) ?></div>
            </td>
            <td><?= number_format($product['price'],2) ?> €</td>
            <td>
                <div class="cart-quantity">
                    <button data-action="decrease">−</button>
                    <input type="number" value="<?= $product['quantity'] ?>" min="1">
                    <button data-action="increase">+</button>
                </div>
            </td>
            <td><?= number_format($product['subtotal'],2) ?> €</td>
            <td>
                <form method="POST" action="remove_from_cart.php">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="submit" class="btn-remove">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="cart-summary">
        <span>Total: <?= number_format($total,2) ?> €</span>
        <form action="checkout.php" method="POST">
            <button type="submit" class="btn-checkout">Finalizar compra</button>
        </form>
    </div>

    <a href="index.php" class="btn-checkout" style="margin-top:20px;">⬅ Seguir comprando</a>
    <?php endif; ?>
</div>

</body>
</html>

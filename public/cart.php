<?php
session_start();
include('../includes/db.php');

// Remove product from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

// Calculate total
$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart - Handmade Jewellery</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('../includes/header.php'); ?>

<div class="container">

    <h2 class="title">Your Shopping Cart</h2>

    <?php if (empty($_SESSION['cart'])): ?>
        <p class="empty-cart">Your cart is empty!</p>

    <?php else: ?>

        <div class="cart-items">
            <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                <div class="cart-card">

                    <img src="images/<?= $item['image'] ?>" class="cart-img">

                    <div class="cart-info">
                        <h3><?= $item['name'] ?></h3>
                        <p class="price">₹<?= $item['price'] ?></p>

                        <a href="cart.php?remove=<?= $id ?>" class="remove-btn">Remove</a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-summary">
            <h3>Total: ₹<?= $total ?></h3>
            <a href="checkout.php" class="btn checkout-btn">Proceed to Checkout</a>
        </div>

    <?php endif; ?>

</div>

<?php include('../includes/footer.php'); ?>

</body>
</html>

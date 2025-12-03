<?php
session_start();
include('../includes/db.php');

// If cart is empty
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Calculate total again
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'];
    }

    // Insert order
    mysqli_query($conn, "INSERT INTO orders (name, phone, address, total) 
                         VALUES ('$name', '$phone', '$address', '$total')");
    
    $order_id = mysqli_insert_id($conn);

    // Insert order items
    foreach ($_SESSION['cart'] as $pid => $item) {
        $price = $item['price'];
        mysqli_query($conn, 
            "INSERT INTO order_items (order_id, product_id, price) 
             VALUES ('$order_id', '$pid', '$price')");
    }

    // Clear cart
    $_SESSION['cart'] = [];

    header("Location: success.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Handmade Jewellery</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('../includes/header.php'); ?>

<div class="container">
    <h2 class="title">Checkout</h2>

    <div class="checkout-box">
        <form method="POST">

            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <textarea name="address" placeholder="Delivery Address" required></textarea>

            <button type="submit" class="btn checkout-btn">Place Order</button>

        </form>
    </div>
</div>

<?php include('../includes/footer.php'); ?>

</body>
</html>

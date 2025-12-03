<?php
include('../includes/db.php');
session_start();

// Fetch product by ID
$id = $_GET['id'];
$product = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$p = mysqli_fetch_assoc($product);

if (!$p) {
    die("Product not found");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $p['name'] ?> - Handmade Jewellery</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('../includes/header.php'); ?>

<div class="container">

    <div class="product-page">

        <div class="product-image">
            <img src="images/<?= $p['image'] ?>" alt="<?= $p['name'] ?>">
        </div>

        <div class="product-info">
            <h2><?= $p['name'] ?></h2>
            <p class="price">₹<?= $p['price'] ?></p>

            <p><strong>Category:</strong> <?= $p['category'] ?></p>
            <p class="description"><?= $p['description'] ?></p>

            <a href="add_to_cart.php?id=<?= $p['id'] ?>" class="btn add-btn">
                Add to Cart
            </a>
        </div>

    </div>

</div>

<?php include('../includes/footer.php'); ?>

</body>
</html>

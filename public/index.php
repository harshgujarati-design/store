<?php
include('../includes/db.php');
session_start();

// Fetch categories
$categories = ["Necklace", "Bracelet", "Earrings"];

// Filter + Search
$filter = "";
if (isset($_GET['category']) && $_GET['category'] != "") {
    $cat = $_GET['category'];
    $filter = "WHERE category='$cat'";
}
if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = $_GET['search'];
    $filter = "WHERE name LIKE '%$search%'";
}

// Fetch products
$products = mysqli_query($conn, "SELECT * FROM products $filter");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Handmade Jewellery Store</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php include('../includes/header.php'); ?>

<div class="container">

    <h2 class="title">Handmade Jewellery</h2>

    <!-- Search + Category -->
    <div class="filters">
        <form method="GET">
            <input type="text" name="search" placeholder="Search jewellery...">
            <select name="category">
                <option value="">All Categories</option>
                <?php foreach ($categories as $c): ?>
                    <option value="<?= $c ?>"><?= $c ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Apply</button>
        </form>
    </div>

    <div class="product-grid">
        <?php while($p = mysqli_fetch_assoc($products)): ?>
            <div class="card">
                <img src="images/<?= $p['image'] ?>" alt="">
                <h3><?= $p['name'] ?></h3>
                <p class="price">₹<?= $p['price'] ?></p>
                <a href="product.php?id=<?= $p['id'] ?>" class="btn">View Details</a>
            </div>
        <?php endwhile; ?>
    </div>

</div>

<?php include('../includes/footer.php'); ?>

</body>
</html>

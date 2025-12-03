<?php
session_start();
include('../includes/db.php');

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$p = mysqli_fetch_assoc($result);

if (!$p) {
    die("Product not found");
}

// Add product to session cart
$_SESSION['cart'][$id] = [
    'name' => $p['name'],
    'price' => $p['price'],
    'image' => $p['image']
];

// Redirect to cart
header("Location: cart.php");

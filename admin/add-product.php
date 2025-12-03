<?php
require "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];

    // Upload Image
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../public/images/" . $image);

    mysqli_query($conn, "INSERT INTO products (name, description, price, image) 
                         VALUES ('$name', '$desc', '$price', '$image')");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Add New Product</h1>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Product Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="number" name="price" placeholder="Price" required>
    <input type="file" name="image" required>
    <button class="btn">Add Product</button>
</form>

</body>
</html>

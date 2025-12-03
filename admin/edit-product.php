<?php
require "../includes/db.php";
$id = $_GET['id'];
$product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=$id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../public/images/" . $image);
        mysqli_query($conn, "UPDATE products SET name='$name', description='$desc', price='$price', image='$image' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE products SET name='$name', description='$desc', price='$price' WHERE id=$id");
    }

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Edit Product</h1>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" value="<?= $product['name'] ?>" required>
    <textarea name="description" required><?= $product['description'] ?></textarea>
    <input type="number" name="price" value="<?= $product['price'] ?>" required>

    <p>Existing Image:</p>
    <img src="../public/images/<?= $product['image'] ?>" width="150">

    <p>Upload New Image (optional):</p>
    <input type="file" name="image">

    <button class="btn">Update Product</button>
</form>

</body>
</html>

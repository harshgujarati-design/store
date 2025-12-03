<?php
require "../includes/db.php";
$products = mysqli_query($conn, "SELECT * FROM products");
require "auth.php";   // protect this page
require "../includes/db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Admin Dashboard</h1>
<a class="btn" href="add-product.php">Add New Product</a>
<a href="logout.php" class="btn" style="background:#EF4444;">Logout</a>


<table>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>

<?php while($p = mysqli_fetch_assoc($products)): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><img src="../public/images/<?= $p['image'] ?>" height="50"></td>
        <td><?= $p['name'] ?></td>
        <td>₹<?= $p['price'] ?></td>
        <td>
            <a class="edit" href="edit-product.php?id=<?= $p['id'] ?>">Edit</a>
            <a class="delete" href="delete.php?id=<?= $p['id'] ?>">Delete</a>
        </td>
    </tr>
<?php endwhile; ?>

</table>

</body>
</html>

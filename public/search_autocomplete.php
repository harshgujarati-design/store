<?php
include("../includes/db.php");

$term = $_GET['term'] ?? '';

$data = [];

if ($term != "") {
    $query = mysqli_query($conn, 
        "SELECT id, name, image FROM products 
         WHERE name LIKE '%$term%' LIMIT 5");

    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>

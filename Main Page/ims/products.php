<?php

include 'config/database.php';
include 'includes/functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Inventory Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Produk</h1>

        <?php
        // Query untuk mendapatkan semua produk
        $sql = "SELECT * FROM products";
        $result = mysqli_query($koneksi, $sql);

        if (!$result) {
            // Handle query error
            die("Error: " . mysqli_error($koneksi));
        }

        if (mysqli_num_rows($result) > 0) {
            // Output data produk dalam tabel
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nama Pemasok</th>";
            echo "<th>Nama Produk</th>";
            echo "<th>Stok</th>";
            echo "<th>Harga Unit</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['supplier_name'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "<td>" . $row['price'] .  "</td";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            // Tampilkan pesan jika tidak ada produk
            echo "Tidak ada produk.";
        }
        ?>
        <a href="add_product.php" class="btn btn-primary">Tambah Produk</a>

        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</body>
</html>

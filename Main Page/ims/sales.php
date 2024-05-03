<?php

include 'config/database.php';
include 'includes/functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan - Inventory Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Data Penjualan</h1>

        <?php
        // Mendapatkan data penjualan dari database dengan informasi produk yang sesuai
        $sql = "SELECT sales.id, products.product_name, sales.sale_date, sales.quantity FROM sales JOIN products ON sales.id = products.id";
        $result = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Jika terdapat data penjualan, tampilkan dalam tabel
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nama Barang</th>";
            echo "<th>Tanggal Penjualan</th>";
            echo "<th>Jumlah</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['sale_date'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            // Jika tidak ada data penjualan
            echo "<p>Tidak ada data penjualan.</p>";
        }
        ?>
        <a href="add_sale.php" class="btn btn-primary">Tambah Penjualan</a>

        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</body>
</html>

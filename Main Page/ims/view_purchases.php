<?php

include 'config/database.php';
include 'includes/functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Purchases - Inventory Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>View Purchases</h1>

        <?php
        // Mendapatkan data pembelian dari database
        $sql = "SELECT purchase_items.id, products.product_name, purchase_items.purchase_date, purchase_items.quantity, purchase_items.status FROM purchase_items JOIN products" ;
        $result = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Jika terdapat data pembelian, tampilkan dalam tabel
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nama Barang</th>";
            echo "<th>Tanggal Pembelian</th>";
            echo "<th>Jumlah</th>";
            echo "<th>Status</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['purchase_date'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            // Jika tidak ada data pembelian
            echo "<p>Tidak ada data pembelian.</p>";
        }
        ?>

        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</body>
</html>

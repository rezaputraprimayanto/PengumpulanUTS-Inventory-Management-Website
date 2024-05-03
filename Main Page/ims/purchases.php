<?php

include 'config/database.php';
include 'includes/functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian - Inventory Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Pembelian</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemasok</th>
                    <th>Tanggal Pembelian</th>
                    <th>Harga</th>
                    <th>Aksi</th>                 
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * FROM purchase_items";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . (isset($row['supplier_name']) ? $row['supplier_name'] : '') . "</td>"; 
                        echo "<td>" . $row['purchase_date'] . "</td>";
                        // Pastikan kunci array 'total_price' ada sebelum mengaksesnya
                        echo "<td>" . (isset($row['total_price']) ? formatRupiah($row['total_price']) : '') . "</td>";
                        echo "<td>";
                        echo "<a href='view_purchases.php?id=" . $row['id'] . "' class='btn btn-info'>Lihat</a>"; // Mengarahkan ke view_purchases.php
                        echo "<a href='edit_purchase.php?id=" . $row['id'] . "' class='btn btn-warning'>Ubah</a>";
                        echo "<a href='delete_purchase.php?id=" . $row['id'] . "' class='btn btn-danger'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Belum ada data pembelian</td></tr>";
                }

                ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a> 

        <a href="add_purchase.php" class="btn btn-primary">Tambah Pembelian</a>
    </div>

    <script src="js/script.js"></script>
</body>
</html>

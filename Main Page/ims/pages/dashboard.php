<?php

include '../config/database.php';
include '../includes/functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Inventory Management System</h1>

        <div class="row">
            <div class="col-md-6">
                <h2>Produk</h2>
                <a href="products.php" class="btn btn-primary">Lihat Semua</a>
            </div>
            <div class="col-md-6">
                <h2>Penjualan</h2>
                <a href="sales.php" class="btn btn-primary">Lihat Semua</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h2>Pembelian</h2>
                <a href="purchases.php" class="btn btn-primary">Lihat Semua</a>
            </div>
            <div class="col-md-6">
                <h2>Laporan</h2>
                <a href="reports.php" class="btn btn-primary">Lihat Semua</a>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>

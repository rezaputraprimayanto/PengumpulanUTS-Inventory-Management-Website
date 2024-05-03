<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Inventory Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Produk</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="supplier_name">Nama Pemasok:</label>
                <input type="text" id="supplier_name" name="supplier_name" required>
            </div>
            <div class="form-group">
                <label for="product_name">Nama Produk:</label>
                <input type="text" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="stock">Stok:</label>
                <input type="number" id="stock" name="stock" required>
            </div>
            <div class="form-group">
                <label for="price">Harga:</label>
                <input type="number" id="price" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
        </form>

        <?php
        include 'config/database.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $supplier_name = $_POST['supplier_name'];
            $product_name = $_POST['product_name'];
            $description = $_POST['description'];
            $stock = $_POST['stock'];
            $price = $_POST['price'];
            $created_at = date('Y-m-d H:i:s');

            $sql = "INSERT INTO products (supplier_name, product_name, description, stock, price, created_at) VALUES ('$supplier_name', '$product_name','$description', '$stock', '$price', '$created_at')";
            $result = mysqli_query($koneksi, $sql);

            if ($result) {
                echo "Produk berhasil ditambahkan.";
            } else {
                echo "Error: " . mysqli_error($koneksi);
            }
        }
        ?>
        <br>
        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</body>
</html>

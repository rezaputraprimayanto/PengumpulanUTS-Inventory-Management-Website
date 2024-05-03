<?php
include 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sale_date = $_POST['sale_date'];
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Lakukan validasi data jika diperlukan

    $sql = "INSERT INTO sales (sale_date, id, quantity) VALUES ('$sale_date', '$id', '$quantity')";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        echo "Penjualan berhasil ditambahkan.";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penjualan - Inventory Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Penjualan</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="form-group">
                <label for="sale_date">Tanggal Penjualan:</label>
                <input type="date" id="sale_date" name="sale_date" required>
            </div>
            <div class="form-group">
                <label for="product_id">Produk:</label>
                <select id="product_id" name="id" required>
                    <?php
                    // Query untuk mendapatkan semua produk
                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($koneksi, $sql);

                    if (!$result) {
                        // Handle query error
                        die("Error: " . mysqli_error($koneksi));
                    }

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['product_name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada produk tersedia</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <br>
            <br>
            <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
        </form>
    </div>
</body>
</html>

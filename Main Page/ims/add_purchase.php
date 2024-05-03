<?php
include 'config/database.php';
include 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $purchase_date = $_POST['purchase_date'];

    // Ambil informasi harga, nama pemasok, dan nama produk dari produk yang dipilih
    $query_product = "SELECT supplier_name, product_name, price FROM products WHERE id = '$id'";
    $result_product = mysqli_query($koneksi, $query_product);
    
    if($result_product && mysqli_num_rows($result_product) > 0) {
        $product_data = mysqli_fetch_assoc($result_product);
        
        $supplier_name = $product_data['supplier_name'];
        $product_name = $product_data['product_name'];
        $price = $product_data['price'];
        
        // Hitung total harga
        $total_price = $price * $quantity;
        
        // Lakukan insert data pembelian ke database
        $sql = "INSERT INTO purchase_items (id, supplier_name, product_name, price, quantity, total_price, purchase_date) 
                VALUES ('$id', '$supplier_name', '$product_name', '$price', '$quantity', '$total_price', '$purchase_date')";
        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            echo "Data pembelian berhasil ditambahkan.";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        echo "Produk tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembelian - Inventory Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Pembelian</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="id">Produk:</label>
                <select name="id" class="form-control" required>
                    <option value="">Pilih Produk</option>
                    <?php
                    $sql = "SELECT id, product_name, supplier_name, price FROM products";
                    $result = mysqli_query($koneksi, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['product_name'] . "</option>";
                    }
                    ?>
                </select>
                <input type="hidden" name="product_name" id="product_name">
            </div>
            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="purchase_date">Tanggal Pembelian:</label>
                <input type="date" name="purchase_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a> 
    </div>
    

    <script>
        // Fungsi untuk mengubah nilai input tersembunyi product_name saat memilih produk
        document.querySelector('select[name="id"]').addEventListener('change', function() {
            var productName = this.options[this.selectedIndex].text;
            document.getElementById('product_name').value = productName;
        });
    </script>
</body>

</html>

<?php
include 'config/database.php';
include 'includes/functions.php';

// Pastikan parameter id tersedia
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID pembelian tidak valid.";
    exit;
}

$id = $_GET['id'];

// Ambil data pembelian berdasarkan ID
$sql = "SELECT * FROM purchase_items WHERE id = $id";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($koneksi);
    exit;
}

if (mysqli_num_rows($result) == 0) {
    echo "Pembelian tidak ditemukan.";
    exit;
}

$row = mysqli_fetch_assoc($result);

// Proses form saat disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $purchase_date = $_POST['purchase_date'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];

    // Update data pembelian
    $update_sql = "UPDATE purchase_items SET purchase_date = '$purchase_date', quantity = '$quantity', status = '$status' WHERE id = $id";
    $update_result = mysqli_query($koneksi, $update_sql);

    if ($update_result) {
        echo "Pembelian berhasil diperbarui.";
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
    <title>Edit Pembelian - Inventory Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Pembelian</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$id"); ?>" method="POST">
            <div class="form-group">
                <label for="purchase_date">Tanggal Pembelian:</label>
                <input type="date" id="purchase_date" name="purchase_date" value="<?php echo $row['purchase_date']; ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="berhasil" <?php if ($row['status'] == 'berhasil') echo 'selected'; ?>>Berhasil</option>
                    <option value="gagal" <?php if ($row['status'] == 'gagal') echo 'selected'; ?>>Gagal</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="purchases.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>

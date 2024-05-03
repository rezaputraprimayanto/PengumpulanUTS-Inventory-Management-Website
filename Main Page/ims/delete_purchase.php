<?php
include 'config/database.php';
include 'includes/functions.php';

// Pastikan parameter id tersedia
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID pembelian tidak valid.";
    exit;
}

$id = $_GET['id'];

// Hapus data pembelian berdasarkan ID
$sql = "DELETE FROM purchase_items WHERE id = $id";
$result = mysqli_query($koneksi, $sql);

if ($result) {
    echo "Pembelian berhasil dihapus.";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>

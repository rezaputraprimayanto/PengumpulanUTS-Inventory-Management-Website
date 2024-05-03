<?php

include 'config/database.php';

// Fungsi untuk memformat angka menjadi format mata uang Rupiah
function formatRupiah($angka) {
    $hasil = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil;
}

// Fungsi untuk mendapatkan informasi produk berdasarkan ID
function getProdukById($id) {
    global $koneksi;

    // Lindungi terhadap serangan SQL Injection
    $safe_id = mysqli_real_escape_string($koneksi, $id);

    $sql = "SELECT * FROM products WHERE id = '$safe_id'";
    $result = mysqli_query($koneksi, $sql);

    if (!$result) {
        // Handle query error
        die("Error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

?>

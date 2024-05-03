<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$database = "dbmahasiswa";

// Membuat koneksi ke MySQL
$koneksi = mysqli_connect($host, $user, $pass, $database);

// Memeriksa koneksi
if (!$koneksi) {
    echo "Gagal terhubung ke database MySQL: " . mysqli_connect_error();
    exit; // Menghentikan eksekusi skrip jika gagal terhubung
}
?>

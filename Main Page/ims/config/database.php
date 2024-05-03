<?php

$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "inventory_db";

$koneksi = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

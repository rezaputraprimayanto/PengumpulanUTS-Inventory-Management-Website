<?php
include 'config/database.php';
include 'includes/functions.php';

// Handle database connection errors
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Inventory Management</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Laporan Inventory Management</h1>

        <p>Pilih laporan yang ingin Anda lihat:</p>

        <ul>
            <li><a href="reports.php?type=stock">Stok Produk</a></li>
            <li><a href="reports.php?type=sales">Laporan Penjualan (Periode)</a></li>
            <li><a href="reports.php?type=purchases">Laporan Pembelian (Periode)</a></li>
        </ul>

        <?php
        // Handle report type
        if (isset($_GET['type'])) {
            $reportType = $_GET['type'];

            if ($reportType == "stock") {
                // Laporan Stok Produk
                $sql = "SELECT * FROM products";
                $result = mysqli_query($koneksi, $sql);

                // Check for query errors
                if (!$result) {
                    die("Error: " . mysqli_error($koneksi));
                }

                echo "<h2>Laporan Stok Produk</h2>";
                echo "<table class='table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nama Produk</th>";
                echo "<th>Stok</th>";
                echo "<th>Harga</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>" . $row['stock'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada produk</td></tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else if ($reportType == "sales" || $reportType == "purchases") {
                // Laporan Penjualan/Pembelian (Periode)
                echo "<h2>Laporan " . ($reportType == "sales" ? "Penjualan" : "Pembelian") . " (Periode)</h2>";

                // Form untuk memilih periode
                echo "<form method='get'>";
                echo "<label for='start_date'>Tanggal Mulai:</label>";
                echo "<input type='date' name='start_date' required>";
                echo "<label for='end_date'>Tanggal Akhir:</label>";
                echo "<input type='date' name='end_date' required>";
                echo "<input type='submit' value='Tampilkan Laporan'>";
                echo "</form>";

                // Handle permintaan laporan berdasarkan periode
                if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                    $start_date = $_GET['start_date'];
                    $end_date = $_GET['end_date'];

                    $sql = "";
                    if ($reportType == "sales") {
                        // Query untuk laporan penjualan berdasarkan periode
                        $sql = "SELECT * FROM sales WHERE sale_date BETWEEN '$start_date' AND '$end_date'";
                    } else if ($reportType == "purchases") {
                        // Query untuk laporan pembelian berdasarkan periode
                        $sql = "SELECT * FROM purchase_items WHERE purchase_date BETWEEN '$start_date' AND '$end_date'";
                    }

                    $result = mysqli_query($koneksi, $sql);

                    if (!$result) {
                        die("Error: " . mysqli_error($koneksi));
                    }

                    echo "<table class='table'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Nama Produk</th>";
                    echo "<th>Jumlah</th>";
                    echo "<th>Total Harga</th>";
                    echo "<th>Tanggal</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['product_name'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . $row['total_price'] . "</td>";
                            echo "<td>" . $row['purchase_date'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                }
            }
        }
        ?>
        <br>
        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</body>

</html>

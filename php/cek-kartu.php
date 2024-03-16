<?php
session_start();
include "../db_conn.php";

// Ambil data barcode dari input
$barcode = $_GET['barcode'];

// Query SQL untuk memeriksa apakah barcode sudah ada di database
$sql = "SELECT * FROM input WHERE ambil_kartu = '$barcode'";
$result = $conn->query($sql);

// Jika ada hasil dari query, berarti barcode sudah ada di database
if ($result->num_rows > 0) {
    echo 'true'; // Kirimkan 'true' ke JavaScript jika barcode sudah ada
} else {
    echo 'false'; // Kirimkan 'false' ke JavaScript jika barcode belum ada
}

// Tutup koneksi ke database
$conn->close();
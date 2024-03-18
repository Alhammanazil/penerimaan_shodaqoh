<?php
include "../db_conn.php";

// Check if the request is a POST request
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form inputs from the request body
    $kodetrx = $_POST['kodetrx'];
    $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kode = $_POST['kode'];
    $ambil_kartu = $_POST['ambil_kartu'] ?? null;

    // Query to update the main data in the database based on the form inputs
    $update_main_query = "UPDATE input SET kodetrx='$kodetrx', tanggal='$tanggal', nama='$nama', alamat='$alamat', kode_kartu='$kode', ambil_kartu='$ambil_kartu' WHERE kodetrx='$kodetrx'";
    $update_main_result = mysqli_query($conn, $update_main_query);

    if($update_main_result) {
        // Redirect to a different page after editing
        header("Location: ../edit.php");
        exit();
    } else {
        // Display error message if the query failed
        echo "Error updating data: " . mysqli_error($conn);
    }
} else {
    // Display error message if the request is not a POST request
    echo "Invalid request.";
}


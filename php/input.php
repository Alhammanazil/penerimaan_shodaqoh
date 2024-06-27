<?php
session_start();
include "../db_conn.php";
include "../function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $kodetrx = mysqli_real_escape_string($conn, $_POST['kodetrx']);
    $operator = mysqli_real_escape_string($conn, $_POST['operator']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $gelar1 = mysqli_real_escape_string($conn, $_POST['gelar1'] ?? null);
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nama']));
    $gelar2 = mysqli_real_escape_string($conn, $_POST['gelar2'] ?? null);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']); // Sesuaikan dengan nama input field di form
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $total_sumbangan = mysqli_real_escape_string($conn, $_POST['sumbangan_barang']);
    $total_sumbangan_rp = extractNumber(mysqli_real_escape_string($conn, $_POST['sumbangan_uang']));
    $kode_kartu = mysqli_real_escape_string($conn, $_POST['kode_kartu']);
    $ambil_kartu = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['ambil_kartu']));

    // Debugging
    error_log("Form Data: " . print_r($_POST, true));

    // Submit data ke database
    $input = "INSERT INTO `input` (`kodetrx`, `operator`, `tanggal`, `gelar1`, `nama`, `gelar2`, `alamat`, `telepon`, `total_sumbangan`, `total_sumbangan_rp`, `kode_kartu`, `ambil_kartu`)
              VALUES ('$kodetrx', '$operator', '$tanggal', '$gelar1', '$nama', '$gelar2', '$alamat', '$telepon', '$total_sumbangan', '$total_sumbangan_rp', '$kode_kartu', '$ambil_kartu')";

    if (mysqli_query($conn, $input)) {
        $response = array('status' => 'success', 'message' => 'Data berhasil ditambahkan, silahkan masukkan detail sumbangan', 'kodetrx' => $kodetrx);
        echo json_encode($response);
    } else {
        // Log the error message
        error_log("SQL Error: " . mysqli_error($conn));
        error_log("SQL Query: " . $input);
        $response = array('status' => 'error', 'message' => 'Data gagal ditambahkan');
        echo json_encode($response);
    }
}
?>

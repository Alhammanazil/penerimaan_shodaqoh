<?php
include "../db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodetrx = $_POST['kodetrx'];
    $operator = $_POST['operator'];
    $tanggal = $_POST['tanggal'];
    $gelar1 = $_POST['gelar1'];
    $nama = $_POST['nama'];
    $gelar2 = $_POST['gelar2'];
    $alamat = $_POST['alamat'] ?? '';
    $telepon = $_POST['telepon'];
    $sumbangan_barang = $_POST['sumbangan_barang'];
    $sumbangan_uang = $_POST['sumbangan_uang'];
    $kode_kartu = $_POST['kode_kartu'];
    $ambil_kartu = $_POST['ambil_kartu'] ?? null;

    $update_main = "UPDATE input SET
                    operator = ?,
                    tanggal = ?,
                    gelar1 = ?,
                    nama = ?,
                    gelar2 = ?,
                    alamat = ?,
                    telepon = ?,
                    total_sumbangan = ?,
                    total_sumbangan_rp = ?,
                    kode_kartu = ?,
                    ambil_kartu = ?
                    WHERE kodetrx = ?";
    $stmt = mysqli_prepare($conn, $update_main);
    mysqli_stmt_bind_param($stmt, "ssssssssssss", $operator, $tanggal, $gelar1, $nama, $gelar2, $alamat, $telepon, $sumbangan_barang, $sumbangan_uang, $kode_kartu, $ambil_kartu, $kodetrx);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan', 'redirect' => 'true']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Kode Kartu gagal disimpan', 'redirect' => 'false']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request', 'redirect' => 'false']);
}

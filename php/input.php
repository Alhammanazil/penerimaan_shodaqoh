<?php
// panggil koneksi
session_start();
include "../db_conn.php";
include "../function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $kodetrx = htmlspecialchars($_POST['kodetrx'], ENT_QUOTES);
    $operator = htmlspecialchars($_POST['operator'], ENT_QUOTES);
    $tanggal = htmlspecialchars($_POST['tanggal'], ENT_QUOTES);
    $gelar1 = htmlspecialchars($_POST['gelar1'] ?? null, ENT_QUOTES);
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $gelar2 = htmlspecialchars($_POST['gelar2'] ?? null, ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['lengkap'], ENT_QUOTES);
    $telepon = htmlspecialchars($_POST['telepon'], ENT_QUOTES);
    $total_sumbangan = htmlspecialchars($_POST['sumbangan_barang'], ENT_QUOTES);
    $total_sumbangan_rp = extractNumber(htmlspecialchars($_POST['sumbangan_uang'], ENT_QUOTES));
    $kode_kartu = htmlspecialchars($_POST['kode_kartu'], ENT_QUOTES);
    $ambil_kartu = htmlspecialchars($_POST['ambil_kartu'], ENT_QUOTES);

    //submit data ke database
    $input = "INSERT INTO `input` (`kodetrx`, `operator`, `tanggal`, `gelar1`, `nama`, `gelar2`, `alamat`, `telepon`, `total_sumbangan`, `total_sumbangan_rp`, `kode_kartu`, `ambil_kartu`) 
        VALUES ('$kodetrx',
                '$operator', 
                '$tanggal', 
                '$gelar1', 
                '$nama', 
                '$gelar2', 
                '$alamat', 
                '$telepon', 
                '$total_sumbangan', 
                '$total_sumbangan_rp', 
                '$kode_kartu', 
                '$ambil_kartu')";

    if (mysqli_query($conn, $input)) {
        echo "<script>
            alert('Data berhasil ditambahkan, silahkan masukkan detail sumbangan');
            window.location.href = '../input.php?success=1&kodetrx=" . $kodetrx . "#bottom';
          </script>";
        exit();
    } else {
        echo "<script>
                alert('Data Gagal Tersimpan');
                document.location.href = '../input.php';
            </script>";
    }
}


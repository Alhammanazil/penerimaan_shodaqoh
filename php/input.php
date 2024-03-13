<?php
// panggil koneksi
session_start();
include "../db_conn.php";

if (isset($_POST['asimpan'])) {

    //submit data ke database
    $simpan = mysqli_query($conn, "INSERT INTO input (kodetrx, Operator, tanggal, Gelar1, Nama, Gelar2, Alamat, Telepon, total_sumbangan, total_sumbangan_rp, kode_kartu, ambil_kartu)

    VALUES ('$_POST[kodetrx]',
            '$_POST[operator]',
            '$_POST[tanggal]',
            '$_POST[gelar1]',
            '$_POST[nama]',
            '$_POST[gelar2]',
            '$_POST[lengkap]',
            '$_POST[telepon]',
            '$_POST[total_sumbangan]',
            '$_POST[total_sumbangan_rp]',
            '$_POST[kode_kartu]',
            '$_POST[ambil_kartu]')");

    //jika simpan sukses
    if ($simpan) {
        echo "<script>
                alert('Data Tersimpan');
                document.location.href = '../input.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Gagal Tersimpan');
                document.location.href = '../input.php';
            </script>";
    }
}
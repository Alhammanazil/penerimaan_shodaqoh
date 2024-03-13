<?php
// panggil koneksi
session_start();
include "../db_conn.php";

// uji jika tombol simpan di klik
if (isset($_POST['bsimpan'])) {

    // persiapan simpan data baru
    $simpan = mysqli_query($conn, "INSERT INTO input_detail (kodetrx, nama_barang, total_nominal, total_jumlah, nama_sub_sumbangan, atas_nama, keterangan) 
    
    VALUES ('$_POST[kodetrx]',
            '$_POST[nama_barang]',
            '$_POST[total_nominal]',
            '$_POST[total_jumlah]',
            '$_POST[nama_sub_sumbangan]',
            '$_POST[atas_nama]',
            '$_POST[keterangan]')");

    // jika simpan gagal
    if (!$simpan) {
        die("Gagal menyimpan data: " . mysqli_error($conn));
    }

    // jika simpan sukses
    if ($simpan) {
        echo "<script>
                alert('Data Tersimpan');
                document.location.href = '../input.php';
            </script>";
    }else {
        echo "<script>
                alert('Data Gagal Tersimpan');
                document.location.href = '../input.php';
            </script>";
    }
}
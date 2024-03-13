<?php
// panggil koneksi
session_start();
include "../db_conn.php";

// uji jika tombol simpan di klik
if (isset($_POST['bsimpan'])) {

    //hapus pemisah ribuan dan konversi ke bilangan bulat
    $_POST['total_nominal'] = preg_replace("/[^0-9]/", "", $_POST['total_nominal']);

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

// uji jika tombol delete di klik
if (isset($_POST['bhapus'])) {

    //persiapan hapus data
    $hapus = mysqli_query($conn, "DELETE FROM input_detail WHERE id = '$_POST[id]' ");

    //jika hapus sukses
    if ($hapus) {
        echo "<script>
                alert('Data Terhapus');
                document.location.href = '../input.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Gagal Terhapus');
                document.location.href = '../input.php';
            </script>";
    }
}
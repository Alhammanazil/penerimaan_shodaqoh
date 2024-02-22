<?php
session_start();
include "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $
    $operator = $_POST['operator'];
    $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $sumbangan = $_POST['sumbangan'];

    // Validasi dan keamanan: Gunakan prepared statements
    $stmtInput = $conn->prepare("INSERT INTO Input (NamaOperator, Tanggal, Nama, Alamat, Telepon, TotalSumbangan) 
                                VALUES (?, ?, ?, ?, ?, ?)");
    $stmtInput->bind_param("ssssss", $operator, $tanggal, $nama, $alamat, $telepon, $sumbangan);

    if ($stmtInput->execute()) {
        $lastInsertedID = $stmtInput->insert_id;

        // Loop untuk setiap baris data pada tabel detail-sumbangan di HTML
        foreach ($_POST['namaBarang'] as $key => $value) {
            $namaBarang = $_POST['namaBarang'][$key];
            $totalJumlah = $_POST['totalJumlah'][$key];
            $keterangan = $_POST['keterangan'][$key];

            // Validasi dan keamanan: Gunakan prepared statements
            $stmtInputDetail = $conn->prepare("INSERT INTO InputDetail (KodeTrx, NamaBarang, TotalJumlah, Keterangan) 
                                            VALUES (?, ?, ?, ?)");
            $stmtInputDetail->bind_param("isss", $lastInsertedID, $namaBarang, $totalJumlah, $keterangan);

            $stmtInputDetail->execute();
        }

        header("Location: input.php?success=true");
        exit(); // Pastikan keluar setelah me-redirect
    } else {
        // Error handling: Menampilkan pesan kesalahan
        echo "Error: " . $stmtInput->error;
        // atau
        // die("Error: " . $stmtInput->error);
    }
    $stmtInput->close(); // Tutup prepared statement
} else {
    header("Location: input.php");
    exit(); // Pastikan keluar setelah me-redirect
}

$conn->close();
?>

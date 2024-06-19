<?php
session_start();
include "../db_conn.php";
include "../function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $kodetrx_detail = $_POST['kodetrx_detail'];
    $kodetrx = $_POST['kodetrx'];
    $tanggal = $_POST['tanggal'];
    $nama_barang = $_POST['nama_barang'];
    $total_nominal = (int) extractNumber($_POST['total_nominal']);
    $akun = $_POST['akun'];
    $total_jumlah = (float) $_POST['total_jumlah'];
    $nama_sub_sumbangan = $_POST['nama_sub_sumbangan'] ?? null;
    $atas_nama = htmlspecialchars($_POST['atas_nama']);
    $urut_hewan = $_POST['urut_hewan'];
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $kode_kartu = $_POST['kode_kartu'];

    // Penanganan file bukti pembayaran
    $bukti_pembayaran = null;
    if (isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['bukti_pembayaran']['tmp_name'];
        $fileName = $_FILES['bukti_pembayaran']['name'];
        $fileSize = $_FILES['bukti_pembayaran']['size'];
        $fileType = $_FILES['bukti_pembayaran']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'pdf');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Check file size (5MB maximum)
            if ($fileSize < 5000000) {
                // Directory in which the uploaded file will be saved
                $uploadFileDir = '../uploads/';
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $bukti_pembayaran = $newFileName;
                } else {
                    $response = array('status' => 'error', 'message' => 'File gagal diupload');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response = array('status' => 'error', 'message' => 'Ukuran file terlalu besar. Maksimal 5MB.');
                echo json_encode($response);
                exit();
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Jenis file tidak diizinkan. Hanya jpg, jpeg, png, pdf.');
            echo json_encode($response);
            exit();
        }
    }

    // Input data ke mysql
    $input = "INSERT INTO input_detail (kodetrx_detail, kodetrx, tanggal, nama_barang, total_jumlah, total_nominal, akun, nama_sub_sumbangan, atas_nama, urut_hewan, keterangan, kode_kartu, bukti_pembayaran)
    VALUES ('$kodetrx_detail',
    '$kodetrx',
    '$tanggal',
    '$nama_barang',
    '$total_jumlah',
    '$total_nominal',
    '$akun',
    '$nama_sub_sumbangan',
    '$atas_nama',
    '$urut_hewan',
    '$keterangan',
    '$kode_kartu',
    " . ($bukti_pembayaran ? "'$bukti_pembayaran'" : "NULL") . ")";

    if (mysqli_query($conn, $input)) {
        $response = array('status' => 'success', 'message' => 'Data berhasil ditambahkan', 'kodetrx' => $kodetrx);
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'Data gagal ditambahkan: ' . mysqli_error($conn));
        echo json_encode($response);
    }
    exit();
}

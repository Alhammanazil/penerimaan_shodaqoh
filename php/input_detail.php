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
    $urut_hewan = 0;
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $kode_kartu = $_POST['kode_kartu'];

    // Get new urut_hewan
    $query = "SELECT MAX(urut_hewan) AS max_urut FROM input_detail WHERE nama_barang = '" . mysqli_real_escape_string($conn, $nama_barang) . "'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $urut_hewan = $row['max_urut'] ? $row['max_urut'] + 1 : 1;
    } else {
        $urut_hewan = 1;
    }

    // Penanganan file foto
    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileName = $_FILES['foto']['name'];
        $fileSize = $_FILES['foto']['size'];
        $fileType = $_FILES['foto']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedfileExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Check file size (10MB maximum)
            if ($fileSize < 10000000) {
                // Directory in which the uploaded file will be saved
                $uploadFileDir = '../uploads/';
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $foto = $newFileName;
                } else {
                    $response = array('status' => 'error', 'message' => 'File gagal diupload');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response = array('status' => 'error', 'message' => 'Ukuran file terlalu besar. Maksimal 10MB.');
                echo json_encode($response);
                exit();
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Jenis file tidak diizinkan. Hanya jpg, jpeg, png.');
            echo json_encode($response);
            exit();
        }
    }

    // Input data ke mysql
    $input = "INSERT INTO input_detail (kodetrx_detail, kodetrx, tanggal, nama_barang, total_jumlah, total_nominal, akun, nama_sub_sumbangan, atas_nama, urut_hewan, keterangan, kode_kartu, foto)
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
    " . ($foto ? "'$foto'" : "NULL") . ")";

    if (mysqli_query($conn, $input)) {
        $response = array('status' => 'success', 'message' => 'Data berhasil ditambahkan', 'kodetrx' => $kodetrx);
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'Data gagal ditambahkan: ' . mysqli_error($conn));
        echo json_encode($response);
    }
    exit();
}

<?php
session_start();
include "../db_conn.php";
include "../function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodetrx_detail = $_POST['kodetrx_detail'];

    // Fetch the file name from the database
    $query = "SELECT bukti_pembayaran FROM input_detail WHERE kodetrx_detail = '$kodetrx_detail'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $bukti_pembayaran = $row['bukti_pembayaran'];

        // Delete the record from the database
        $delete_query = "DELETE FROM input_detail WHERE kodetrx_detail = '$kodetrx_detail'";
        if (mysqli_query($conn, $delete_query)) {
            // If the record is deleted, delete the file from the server
            if ($bukti_pembayaran) {
                $file_path = "../uploads/" . $bukti_pembayaran;
                if (file_exists($file_path)) {
                    if (unlink($file_path)) {
                        $response = array('status' => 'success', 'message' => 'Data dan file berhasil dihapus');
                    } else {
                        $response = array('status' => 'error', 'message' => 'File gagal dihapus');
                    }
                } else {
                    $response = array('status' => 'error', 'message' => 'File tidak ditemukan');
                }
            } else {
                $response = array('status' => 'success', 'message' => 'Data berhasil dihapus tanpa file');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menghapus data: ' . mysqli_error($conn));
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Data tidak ditemukan');
    }
    echo json_encode($response);
    exit();
}

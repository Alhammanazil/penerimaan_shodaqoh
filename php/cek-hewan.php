<?php
session_start();
include "../db_conn.php";

$namaHewan = $_GET['namaHewan'];

// Start a transaction
$conn->begin_transaction();

try {
    // Get the current highest urut_hewan
    $stmt = $conn->prepare("SELECT MAX(urut_hewan) AS max_urut FROM input_detail WHERE nama_barang = ?");
    $stmt->bind_param("s", $namaHewan);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $currentMaxUrut = $result['max_urut'] ? $result['max_urut'] : 0;

    // Increment the urut_hewan
    $newUrut = $currentMaxUrut + 1;

    // Return the new urut_hewan
    echo $newUrut;

    // Commit the transaction
    $conn->commit();
} catch (Exception $e) {
    // An error occurred, rollback the transaction
    $conn->rollback();
    echo 0;
}

$stmt->close();
$conn->close();

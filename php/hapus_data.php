<?php
session_start();
include "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap kodetrx_detail data yang akan dihapus
    $kodetrx_detail = $_POST['kodetrx_detail'];

    // Query untuk menghapus data dari database
    $query = "DELETE FROM input_detail WHERE kodetrx_detail = '$kodetrx_detail'";

    if (mysqli_query($conn, $query)) {
        $kodetrx = $_POST['kodetrx'];
        echo "<script>
        window.location.href = '../input.php?success=1&kodetrx=" . $kodetrx . "#bottom';
        </script>";
    } else {
        echo "<script>
        window.location.href = '../input.php?error=1';
        </script>";
    }
}

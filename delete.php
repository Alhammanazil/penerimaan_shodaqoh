<?php
include "db_conn.php";

// cek apakah parameter kodetrx ada di URL
if (isset($_GET['kodetrx'])) {
    $kodetrx = $_GET['kodetrx'];

    // query untuk menghapus data yang sesuai dengan kodetrx
    $query = "DELETE FROM input WHERE kodetrx = ?;";
    $stmt = mysqli_prepare($conn, $query);

    // bind parameter kodetrx ke query
    mysqli_stmt_bind_param($stmt, "s", $kodetrx);

    // eksekusi query
    mysqli_stmt_execute($stmt);

    // cek apakah ada data yang terpengaruh oleh data yang akan dihapus
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $ada_data_yang_terpengaruh = isset($_GET['ada_data_yang_terpengaruh']) ? $_GET['ada_data_yang_terpengaruh'] : '';
        if (strtolower($ada_data_yang_terpengaruh) == 'ya') {
            echo "<script>
            alert('Data gagal dihapus');
            window.location.href = 'form.php';
            </script>";
        } else {
            echo "<script>
            alert('Data berhasil dihapus.');
            window.location.href = 'form.php';
            </script>";
        }
    }
}



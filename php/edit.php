<?php
include "../db_conn.php";

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form inputs from the request body
    $kodetrx = $_POST['kodetrx'];
    $operator = $_POST['operator'];
    $tanggal = $_POST['tanggal'];
    $gelar1 = $_POST['gelar1'];
    $nama = htmlspecialchars($_POST['nama']);
    $gelar2 = $_POST['gelar2'];
    $alamat = $_POST['alamat']; // Pastikan ini sesuai dengan input form
    $telepon = $_POST['telepon'] ?? null;
    $total_sumbangan = $_POST['sumbangan_barang'] ?? 0;
    $total_sumbangan_rp = $_POST['sumbangan_uang'] ?? 0;
    $kode_kartu = $_POST['kode_kartu'] ?? null;
    $ambil_kartu = htmlspecialchars($_POST['ambil_kartu'] ?? null);

    // Debugging: Logging the inputs
    error_log("Updating data with kodetrx: " . $kodetrx);
    error_log("Alamat: " . $alamat);

    // Update ke database
    $update_main = "UPDATE input SET
        operator = ?,
        tanggal = ?,
        gelar1 = ?,
        nama = ?,
        gelar2 = ?,
        alamat = ?,
        telepon = ?,
        total_sumbangan_rp = ?,
        total_sumbangan = ?,
        kode_kartu = ?,
        ambil_kartu = ?
        WHERE kodetrx = ?";
    
    $stmt = mysqli_prepare($conn, $update_main);
    mysqli_stmt_bind_param($stmt, "ssssssssssss", $operator, $tanggal, $gelar1, $nama, $gelar2, $alamat, $telepon, $total_sumbangan_rp, $total_sumbangan, $kode_kartu, $ambil_kartu, $kodetrx);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>
                alert('Data berhasil diperbarui');
                window.location.href = '../form.php';
                </script>";
        } else {
            echo "<script>
                alert('Tidak ada data yang diupdate');
                window.location.href = '../form.php';
                </script>";
        }
    } else {
        // Handle query error
        echo "<script>
            alert('Data gagal diperbarui: " . mysqli_error($conn) . "');
            window.location.href = '../form.php';
            </script>";
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Display error message if the request is not a POST request
    echo "Invalid request.";
}
?>

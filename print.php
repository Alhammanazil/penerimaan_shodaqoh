<?php
include "db_conn.php";
include "function.php";

if(isset($_GET['kodetrx'])) {
    $kodetrx = $_GET['kodetrx'];

    // Query to fetch data based on the kodetrx parameter
    $query = "SELECT * FROM input WHERE kodetrx = '$kodetrx'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        // Fetch and display the data
        $row = mysqli_fetch_assoc($result);

        echo '<script>
            alert("Fitur print masih dalam tahap pengembangan");
            window.location.href = "form.php";
        </script>';

        exit;
    } else {
        echo '<script>
            alert("Fitur print masih dalam tahap pengembangan");
            window.location.href = "form.php?error=data-tidak-ditemukan";
        </script>';

        exit;
    }
} else {
    echo '<script>
        alert("Data Gagal Ditemukan");
        window.location.href = "form.php?error=invalid-request";
    </script>';

    exit;
}



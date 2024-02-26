<?php
session_start();
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap data dari formulir
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    // Set nilai bawaan untuk opsi peran sebagai "user"
    $role = "user";

    // Lakukan validasi data
    if (empty($username) || empty($password) || empty($name)) {
        header("Location: register.php?error=1");
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyimpan pengguna baru ke database
    $sql = "INSERT INTO users (username, password, name, role) VALUES ('$username', '$hashedPassword', '$name', '$role')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Akunmu berhasil dibuat! Silahkan login untuk melanjutkan.');
                window.location.href = 'index.php?success=1';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Registrasi gagal. Silahkan coba lagi.');
                window.location.href = 'register.php?error=1';
              </script>";
        exit();
    }
}
?>

<!-- Tampilan halaman register -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Register</title>

    <link rel="stylesheet" href="sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">

        <form action="register.php" class="border shadow p-3 rounded"  method="post" style="width: 450px;" data-aos="fade-up" data-aos-duration="1000">
        
            <h1 class="text-center p-3">REGISTER</h1>
            <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                Registration failed. Please try again.
            </div>
            <?php } ?>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>

            <input type="hidden" name="role" value="user">
            <button type="submit" class="btn btn-primary">REGISTER</button>
            
            <p class="mt-3">Sudah memiliki akun? <a href="index.php">Login</a></p>
        </form>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="sweetalert2.min.js"></script>
    
    <script>
    AOS.init();
    </script>

</body>

</html>

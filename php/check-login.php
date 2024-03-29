<?php
session_start();
include "../db_conn.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $role = test_input($_POST['role']);

    if (empty($username)) {
        header("Location: ../index.php?error=Username tidak boleh kosong&username=$username");
        exit();
    } elseif (empty($password)) {
        header("Location: ../index.php?error=Password tidak boleh kosong&username=$username");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Verifikasi password menggunakan password_verify()
            if (password_verify($password, $row['password']) && $row['role'] == $role) {
                if ($row['akses'] == 1) {
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['username'] = $row['username'];

                    header("Location: ../dashboard.php");
                    exit();
                } else {
                    header("Location: ../index.php?error=Akses ditolak! Hubungi admin.&username=$username");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=Username atau password tidak ditemukan&username=$username");
                exit();
            }
        } else {
            header("Location: ../index.php?error=Username atau password tidak ditemukan&username=$username");
            exit();
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}

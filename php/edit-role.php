<?php
session_start();
include "../db_conn.php";

$id = $_GET['id'];
// $id = 1;

$sql = "SELECT * FROM users WHERE id = '$id'";
$query = $conn->query($sql);
$result = mysqli_fetch_assoc($query);

$role = $result['role'] == 'admin' ? 'user' : 'admin';
$akses = $result['akses'];
$username = $result['username'];
$password = $result['password'];
$name = $result['name'];

$result = $conn->query("UPDATE users SET role='$role', akses='$akses', username='$username', password='$password', name='$name' WHERE id=$id");

if (mysqli_affected_rows($conn) > 0) {
    echo 1;
} else {
    echo 0;
}


$conn->close();

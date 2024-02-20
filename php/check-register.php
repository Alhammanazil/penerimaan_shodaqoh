<?php
session_start();
include_once "db_conn.php";
$conn = db_conn(); // Establish database connection

if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password'])){
    
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $name = validate($_POST['name']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($name)) {
        header("Location: register.php?error=Name is required");
        exit();
    } else if (empty($username)) {
        header("Location: register.php?error=User Name is required");
        exit();
    } else if(empty($password)){
        header("Location: register.php?error=Password is required");
        exit();
    } else {
        // hashing the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE username='$username' ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: register.php?error=The username is taken, try another");
            exit();
        } else {
           $sql2 = "INSERT INTO users(name, username, password) VALUES('$name', '$username', '$password')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
             header("Location: register.php?success=Your account has been created successfully");
             exit();
           } else {
                header("Location: register.php?error=Unknown error occurred");
                exit();
           }
        }
    }
    
} else {
    header("Location: register.php");
    exit();
}
?>

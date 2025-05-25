<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['is_admin'] = $row['is_admin'];
            header("Location: index.php");        } else {
            header("Location: login.php?error=invalid");
        }
    } else {
        header("Location: login.php?error=notfound");
    }
}
?>

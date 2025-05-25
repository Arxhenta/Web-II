<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = htmlspecialchars($_POST['fullname']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $state = htmlspecialchars($_POST['state']);
    $zip = htmlspecialchars($_POST['zip']);
    $total = $_POST['total'];
    $payment_method = 'Kesh ne pranim'; 
    $cart = $_SESSION['cart'];

   
    $sql = "INSERT INTO orders (fullname, phone, email, address, city, state, zip, total, payment_method) VALUES ('$fullname', '$phone', '$email', '$address', '$city', '$state', '$zip', '$total', '$payment_method')";
    if (mysqli_query($conn, $sql)) {
        // zbraz shporten
        unset($_SESSION['cart']);

        header('Location: thank_you.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
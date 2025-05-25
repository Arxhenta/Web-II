<?php
session_start();
include('../config.php');

if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];
$sql = "DELETE FROM products WHERE id = $id";
mysqli_query($conn, $sql);
header("Location: manage_products.php");
?>

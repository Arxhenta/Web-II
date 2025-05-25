<?php
session_start();
include('../config.php');

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    //Se pari i fshin produktet per shkak te foreign keys
    $sql = "DELETE FROM order_items WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    
    //E fshin order
    $sql = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
}

header('Location: manage_orders.php');
exit();
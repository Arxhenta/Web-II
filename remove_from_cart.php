<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }
}

header('Location: cart.php');
exit;

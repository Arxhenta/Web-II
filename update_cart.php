<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] = $quantity;
                break;
            }
        }
    }
}

echo 'success';

<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate required fields
        $required = ['product_id', 'product_name', 'product_price', 'product_image', 'quantity'];
        foreach ($required as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                throw new Exception("Missing or invalid field: $field");
            }
        }

        // Initialize cart if not already set
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Sanitize and validate input
        $item = [
            'id' => filter_var($_POST['product_id'], FILTER_VALIDATE_INT),
            'name' => filter_var($_POST['product_name'], FILTER_SANITIZE_STRING),
            'price' => filter_var($_POST['product_price'], FILTER_VALIDATE_FLOAT),
            'image' => filter_var($_POST['product_image'], FILTER_SANITIZE_STRING),
            'quantity' => filter_var($_POST['quantity'], FILTER_VALIDATE_INT)
        ];

        // Validate filtered data
        if (!$item['id'] || !$item['price'] || !$item['quantity']) {
            throw new Exception("Invalid data format");
        }

        // Check if the item already exists in the cart
        $found = false;
        foreach ($_SESSION['cart'] as &$cartItem) {
            if ($cartItem['id'] === $item['id']) {
                $cartItem['quantity'] += $item['quantity'];
                $found = true;
                break;
            }
        }

        // Add new item if not found
        if (!$found) {
            $_SESSION['cart'][] = $item;
        }

        // Redirect to the cart page
        header('Location: cart.php');
        exit;
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    header('Location: product_details.php?id=' . ($_POST['product_id'] ?? 0) . '&error=' . urlencode($e->getMessage()));
    exit;
}
<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = htmlspecialchars($_POST['fullname'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $address = htmlspecialchars($_POST['address'] ?? '');
    $city = htmlspecialchars($_POST['city'] ?? '');
    $state = htmlspecialchars($_POST['state'] ?? '');
    $zip = htmlspecialchars($_POST['zip'] ?? '');
    $total = $_POST['total'] ?? 0;
    $payment_method = 'Kesh ne pranim';
    $cart = $_SESSION['cart'];

    $conn->begin_transaction();

    try {
        
        $sql = "INSERT INTO orders (fullname, phone, email, address, city, state, zip, total, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssds", $fullname, $phone, $email, $address, $city, $state, $zip, $total, $payment_method);
        $stmt->execute();
        $order_id = $conn->insert_id;

        foreach ($cart as $item) {
            $sql = "INSERT INTO order_items (order_id, name, image, quantity, price) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issid", $order_id, $item['name'], $item['image'], $item['quantity'], $item['price']);
            $stmt->execute();
        }

        $conn->commit();
        unset($_SESSION['cart']);
        header('Location: thank_you.php');
        exit();

    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>

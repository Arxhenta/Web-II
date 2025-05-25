<?php
session_start();
include('../config.php');

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: ../login.php');
    exit();
}

$order_id = $_GET['id'] ?? 0;

// Get order details
$sql = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

// Get order items directly from order_items table
$sql = "SELECT * FROM order_items WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detajet e Porosisë</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="header">
        <!-- Include your existing header/navbar here -->
    </div>

    <div class="small-container">
        <h2 class="title">Detajet e Porosisë #<?php echo $order_id; ?></h2>
        
        <div class="order-info">
            <h3>Informacioni i Klientit</h3>
            <br>
            <p><strong>Emri:</strong> <?php echo $order['fullname']; ?></p>
            <p><strong>Email:</strong> <?php echo $order['email']; ?></p>
            <p><strong>Tel:</strong> <?php echo $order['phone']; ?></p>
            <p><strong>Adresa:</strong> <?php echo $order['address']; ?></p>
            <p><strong>Qyteti:</strong> <?php echo $order['city']; ?></p>
        </div>
        <br><br>
        <table>
            <tr>
                <th>Produkti</th>
                <th>Çmimi</th>
                <th>Sasia</th>
                <th>Subtotali</th>
            </tr>
            <?php while($item = mysqli_fetch_assoc($items)): ?>
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="../<?php echo $item['image']; ?>">
                        <div>
                            <p><?php echo $item['name']; ?></p>
                        </div>
                    </div>
                </td>
                <td><?php echo $item['price']; ?>€</td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $item['price'] * $item['quantity']; ?>€</td>
            </tr>
            <?php endwhile; ?>
        </table>
        <div class="order-total">
            <h3 style="text-align: right;">Totali: <?php echo $order['total']; ?>€</h3>
        </div>
        <a href="manage_orders.php" class="btn">Kthehu tek Porositë</a>
    </div>
</body>
</html>

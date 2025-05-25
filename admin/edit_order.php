<?php
session_start();
include('../config.php');

// Kontrollo nëse përdoruesi është i loguar dhe është admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $fullname = htmlspecialchars($_POST['fullname']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $state = htmlspecialchars($_POST['state']);
    $zip = htmlspecialchars($_POST['zip']);
    $total = $_POST['total'];
    $payment_method = htmlspecialchars($_POST['payment_method']);

    $sql = "UPDATE orders SET fullname=?, phone=?, email=?, address=?, city=?, state=?, zip=?, total=?, payment_method=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $fullname, $phone, $email, $address, $city, $state, $zip, $total, $payment_method, $id);

    if ($stmt->execute()) {
        header('Location: manage_orders.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$id = $_GET['id'];
$sql = "SELECT * FROM orders WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ndrysho Porosinë</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h2>Ndrysho Porosinë</h2>
        <form action="edit_order.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
            <div class="input-group">
                <label for="fullname">Emri dhe Mbiemri:</label>
                <input type="text" id="fullname" name="fullname" value="<?php echo $order['fullname']; ?>" required>
            </div>
            <div class="input-group">
                <label for="phone">Numri i Telefonit:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $order['phone']; ?>" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $order['email']; ?>" required>
            </div>
            <div class="input-group">
                <label for="address">Adresa:</label>
                <input type="text" id="address" name="address" value="<?php echo $order['address']; ?>" required>
            </div>
            <div class="input-group">
                <label for="city">Qyteti:</label>
                <input type="text" id="city" name="city" value="<?php echo $order['city']; ?>" required>
            </div>
            <div class="input-group">
                <label for="state">Shteti:</label>
                <input type="text" id="state" name="state" value="<?php echo $order['state']; ?>" required>
            </div>
            <div class="input-group">
                <label for="zip">Kodi Postar:</label>
                <input type="text" id="zip" name="zip" value="<?php echo $order['zip']; ?>" required>
            </div>
            <div class="input-group">
                <label for="total">Totali:</label>
                <input type="number" id="total" name="total" value="<?php echo $order['total']; ?>" required>
            </div>
            <div class="input-group">
                <label for="payment_method">Mënyra e Pagesës:</label>
                <input type="text" id="payment_method" name="payment_method" value="<?php echo $order['payment_method']; ?>" required>
            </div>
            <button type="submit" class="btn">Përditëso Porosinë</button>
        </form>
    </div>
</body>
</html>
<?php
session_start();
include('../config.php');

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: ../login.php');
    exit();
}

$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@496&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Menaxho Porositë</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="../index.php"><img src="../images/logo.png" width="125px" alt="A-Tech Logo"></a>
                </div>
                <nav>
                    <ul>
                        <li><a href="index.php">Admin Dashboard</a></li>
                        <li><a href="manage_products.php">Menaxho Produktet</a></li>
                        <li><a href="add_product.php">Shto Produkt</a></li>
                        <li><a href="manage_orders.php">Menaxho Porositë</a></li>
                        <li><a href="../logout.php">Dilni</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="small-container">
        <h2 class="title">Menaxho Porositë</h2>
        
        <?php if(mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Emri</th>
                        <th>Tel</th>
                        <th>Email</th>
                        <th>Adresa</th>
                        <th>Qyteti</th>
                        <th>Shteti</th>
                        <th>ZIP</th>
                        <th>Totali</th>
                        <th>Pagesa</th>
                        <th>Data</th>
                        <th>Veprime</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td><?php echo $row['state']; ?></td>
                        <td><?php echo $row['zip']; ?></td>
                        <td><?php echo $row['total']; ?>€</td>
                        <td><?php echo $row['payment_method']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <a href="order_details.php?id=<?php echo $row['id']; ?>" class="btn">Shiko Detajet</a>
                            <a href="edit_order.php?id=<?php echo $row['id']; ?>">Ndrysho</a>
                            <a href="delete_order.php?id=<?php echo $row['id']; ?>" onclick="return confirm('A jeni i sigurt që dëshironi të fshini këtë porosi?');">Fshij</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-orders" style="text-align: center; padding: 20px;">
                <h3>Nuk ka porosi për momentin</h3>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
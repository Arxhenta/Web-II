<?php
session_start();
if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}
include('../config.php');

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | A-TECH</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@496&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <h2 class="title">Admin Dashboard</h2>
        <div class="row">
            <div class="col-3">
                <a href="manage_products.php" class="admin-card">
                    <h3>Menaxho Produktet</h3>
                    <p>Shiko, ndrysho dhe fshi produktet</p>
                </a>
            </div>
            <div class="col-3">
                <a href="add_product.php" class="admin-card">
                    <h3>Shto Produkt</h3>
                    <p>Shto produkte të reja</p>
                </a>
            </div>
            <div class="col-3">
                <a href="manage_orders.php" class="admin-card">
                    <h3>Menaxho Porositë</h3>
                    <p>Shiko dhe fshi porositë</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>   

<?php
$conn->close();
?>


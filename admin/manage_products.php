<?php
session_start();
include('../config.php');

if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | A-TECH</title>
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
                        <li><a href="index.php">Admin Dashboard</a></li>
                        <li><a href="add_product.php">Shto Produkt</a></li>
                        <li><a href="../logout.php">Dilni</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="small-container">
        <div class="row row-2">
            <h2>Të gjitha produktet</h2>
            <a href="add_product.php" class="btn">Shto Produkt</a>
        </div>

        <div class="row">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-4">
                <img src="../<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h4><?php echo $row['name']; ?></h4>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <p><?php echo $row['price']; ?>€</p>
                <div class="admin-actions">
                    <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn">Ndrysho</a>
                    <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('A jeni i sigurt?')">Fshi</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

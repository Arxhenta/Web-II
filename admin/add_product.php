<?php
session_start();
include('../config.php');

if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image_path = "images/" . basename($_FILES["image"]["name"]);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $sql = "INSERT INTO products (name, price, image, category_id, description) VALUES ('$name', '$price', '$image_path', '$category_id', '$description')";
    mysqli_query($conn, $sql);
    header("Location: manage_products.php");
}

$sql = "SELECT * FROM categories";
$categories = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | A-TECH</title>
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
                        <li><a href="manage_products.php">Menaxho Produktet</a></li>
                        <li><a href="../logout.php">Dilni</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="small-container">
        <h2 class="title">Shto Produkt të Ri</h2>
        <form action="" method="POST" enctype="multipart/form-data" class="admin-form">
            <div class="form-group">
                <label>Emri i Produktit:</label>
                <input type="text" name="name" required>
            </div>
            
            <div class="form-group">
                <label>Çmimi (€):</label>
                <input type="number" step="0.01" name="price" required>
            </div>
            
            <div class="form-group">
                <label>Kategoria:</label>
                <select name="category_id" required>
                    <?php while($cat = mysqli_fetch_assoc($categories)): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Foto e Produktit:</label>
                <input type="file" name="image" required>
            </div>

            <div class="form-group">
                  <label>Përshkrimi i Produktit:</label>
            <textarea name="description" rows="6" required></textarea>
            </div>
            
            <button type="submit" class="btn">Shto Produktin</button>
        </form>
    </div>
</body>
</html>

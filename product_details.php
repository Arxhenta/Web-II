<?php 
include 'includes/header.php';
include 'config.php';

$id = isset($_GET['id']) ? $_GET['id'] : 1;
$sql = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);
?>

<div class="small-container single-product">
    <div class="row">
        <div class="col-2">
            <img src="<?php echo $product['image']; ?>" width="100%">
            <div class="small-img-row">
                <div class="small-img-col">
                    <img src="<?php echo $product['image']; ?>" width="100%">
                </div>
                <div class="small-img-col">
                    <img src="<?php echo $product['image']; ?>" width="100%">
                </div>
                <div class="small-img-col">
                    <img src="<?php echo $product['image']; ?>" width="100%">
                </div>
                <div class="small-img-col">
                    <img src="<?php echo $product['image']; ?>" width="100%">
                </div>
            </div>
        </div>
        <div class="col-2">
            <p>Ballina / <?php echo $product['category_id'] == 1 ? 'Telefona' : ($product['category_id'] == 2 ? 'Laptopë' : 'Të tjera'); ?></p>
            <h1><?php echo $product['name']; ?></h1>
            <h4><?php echo $product['price']; ?>&#8364;</h4>
            <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>">
                <input type="number" name="quantity" value="1" min="1">
                <button type="submit" class="btn">Shto në shportë</button>
            </form>
            <h3>Detajet e produktit<i class="fa fa-indent"></i></h3>
            <br>
            <p><?php echo $product['description']; ?></p>
        </div>
    </div>
</div>

<div class="small-container">
    <div class="row row-2">
        <h2>Produkte të ngjashme</h2>
        <p>Shiko më shumë</p>
    </div>

    <div class="row">
        <?php 
        $category_id = $product['category_id'];
        $sql = "SELECT * FROM products WHERE category_id = $category_id AND id != $id LIMIT 4";
        $result = mysqli_query($conn, $sql);
        while($related = mysqli_fetch_assoc($result)):
        ?>
        <div class="col-4">
            <a href="product_details.php?id=<?php echo $related['id']; ?>">
                <img src="<?php echo $related['image']; ?>" alt="<?php echo $related['name']; ?>">
                <h4><?php echo $related['name']; ?></h4>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <p><?php echo $related['price']; ?>&#8364;</p>
            </a>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<?php include 'includes/header.php'; ?>

        <div class="container">
            <div class="row">
                <div class="col-2">
                    <h1>Dyqani më i pajisur në Kosovë<br>me produktet me teknologjinë më të re!</h1>
                    <p>A-Tech ka për qellim të ofrojë produktet e fjalës së fundit,të ndjekë trendet dhe inovacionet si dhe <br>të garantojë kënaqësinë e klientit me çmimet me te uleta ne treg</p>
                    <a href="products.php" class="btn">Blej tani &#8594;</a>
                </div>
                <div class="col-2">
                    <img src="images/image1.png" alt="Web Image">
                </div>
            </div>
        </div>


    <div class="categories">
        <div class="small-container">
            <br>
            <br>
            <h2 class="title">Kategoritë</h2>
            <div class="row">
                <div class="col-3">
                    <img src="images/category-2.jpg" alt="Category 1">
                    <a href="products.php?category=1">Telefon</a>
                </div>
                <div class="col-3">
                    <img src="images/category-1.jpg" alt="Category 2">
                    <a href="products.php?category=2">Laptop</a>
                </div>
                <div class="col-3">
                    <img src="images/category-3.jpg" alt="Category 3">
                    <a href="products.php?category=3">Të tjera</a>
                </div>
            </div>
        </div>
    </div>
 
    <div class="small-container">
        <br>
        <br>
        <h2 class="title">Produkte të reja</h2>
        <div class="row">
            <!--Konektimi me databazen-->
            <?php
            require_once 'config.php';
            $query = "SELECT * FROM products ORDER BY id DESC LIMIT 4";
            $result = mysqli_query($conn, $query);
            while($product = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-4">
                <a href="product_details.php?id=<?php echo $product['id']; ?>">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <h4><?php echo $product['name']; ?></h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p><?php echo $product['price']; ?>€</p>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="offer">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="images/exclusive.png" alt="Exclusive Offer">
                </div>
                <div class="col-2">
                    <h2>Produkt ekskluziv</h2>
                    <h1>Apple Watch Series 10</h1>
                    <h3>Merrni avantazhet e epokës së re të teknologjisë duke përdorurm<br> orët e zgjuara Apple Watch Series 10. Ato janë të zgjuara,<br> të qëndrueshme, dhe plot me funksione praktike që do t'ju<br> ndihmojnë të monitoroni shëndetin tuaj, si dhe do t'ju mbajnë të lidhur<br> lehtësisht me kolegët dhe të dashurit tuaj. <h3>
                </div>
            </div>
        </div>
    </div>
    <div class="brands">
        <div class="row">
            <?php
            $brands = [
                ['src' => 'images/Apple-Logo.png', 'alt' => 'Apple Logo'],
                ['src' => 'images/acer.png', 'alt' => 'Acer Logo'],
                ['src' => 'images/Asus-Logo.png', 'alt' => 'Asus Logo'],
                ['src' => 'images/dell.png', 'alt' => 'Dell Logo'],
                ['src' => 'images/hp.png', 'alt' => 'HP Logo'],
                ['src' => 'images/lenovo.png', 'alt' => 'Lenovo Logo'],
                ['src' => 'images/Samsung.png', 'alt' => 'Samsung Logo'],
                ['src' => 'images/Sony-logo.png', 'alt' => 'Sony Logo']
            ];

            foreach ($brands as $brand) {
                echo "<div class='col-5'><img src='{$brand['src']}' alt='{$brand['alt']}'></div>";
            }
            ?>
        </div>
    </div>
</div></div><?php include 'includes/footer.php'; ?>


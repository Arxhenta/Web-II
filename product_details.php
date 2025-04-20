<?php
session_start();
include 'includes/header.php';

class Product {
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;
    public $category_id;
    public $rating;

    public function __construct($id, $name, $description, $price, $image, $category_id, $rating = 5) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->category_id = $category_id;
        $this->rating = $rating;
    }
}


$sample_products = [
   
    new Product(1, 'iPhone 16 Pro', 'iPhone 16 Pro është telefoni më i ri nga Apple, me procesor A18 Bionic, kamerë të trefishtë 48MP, ekran Super Retina XDR 6.7 inch, dhe teknologjinë më të fundit të sigurisë. Përfshin Face ID të përmirësuar dhe mbështetje për 5G.', 999.00, 'images/product-1.jpg', 1, 5),
    new Product(9, 'Samsung Galaxy S24 Ultra', 'Samsung Galaxy S24 Ultra është telefoni më i avancuar i Samsung me S Pen të integruar, ekran Dynamic AMOLED 2X 6.8 inch, sistem kamerash 200MP, dhe veçori të shumta AI.', 1199.00, 'images/samsung-s24.jpg', 1, 5),
    new Product(10, 'Google Pixel 8 Pro', 'Google Pixel 8 Pro shquhet për kamerën e tij të jashtëzakonshme dhe përpunimin AI të imazheve. Përfshin ekran OLED 120Hz, procesor Tensor G3, dhe përditësime të garantuara për 7 vjet.', 899.00, 'images/pixel-8.jpg', 1, 4),
    
  
    new Product(2, 'MacBook Air 15-inch with M3 chip', 'MacBook Air 15-inch me çipin M3 ofron performancë të jashtëzakonshme me efikasitet të lartë të energjisë. Ekrani Liquid Retina, tastiera Magic Keyboard, dhe bateria që zgjat deri në 18 orë e bëjnë atë zgjedhjen perfekte për profesionistët.', 1299.00, 'images/product-2.jpg', 2, 5),
    new Product(11, 'Dell XPS 15', 'Dell XPS 15 është laptop premium me ekran OLED 4K, procesor Intel Core i9, kartë grafike NVIDIA RTX, dhe ndërtim alumini. Ideal për krijues përmbajtjeje dhe profesionistë.', 1799.00, 'images/dell-xps.jpg', 2, 5),
    

    new Product(3, 'PRO X SUPERLIGHT 2 DEX', 'PRO X SUPERLIGHT 2 DEX është një maus gaming me sensor HERO 25K, peshë ultra të lehtë prej vetëm 63g, dhe lidhje wireless LIGHTSPEED.', 159.00, 'images/product-3.jpg', 3, 4),
    new Product(4, 'BOSE QuietComfort', 'BOSE QuietComfort ofron cilësi të jashtëzakonshme të zërit dhe anulim të zhurmës.', 119.99, 'images/product-4.jpg', 3, 5)
];


$id = isset($_GET['id']) && preg_match('/^[1-9]\d*$/', $_GET['id']) ? (int)$_GET['id'] : 1;


$product = null;
foreach ($sample_products as $p) {
    if ($p->id == $id) {
        $product = $p;
        break;
    }
}

if (!$product) {
    header('Location: products.php');
    exit;
}


$relatedProducts = array_filter($sample_products, function($p) use ($product) {
    return $p->id != $product->id && $p->category_id == $product->category_id;
});
?>

<div class="small-container single-product">
    <div class="row">
        <div class="col-2">
            <img src="<?php echo $product->image; ?>" width="100%">
            <div class="small-img-row">
                <?php for ($i = 0; $i < 4; $i++): ?>
                <div class="small-img-col">
                    <img src="<?php echo $product->image; ?>" width="100%">
                </div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="col-2">
            <p>Ballina / <?php 
                echo $product->category_id == 1 ? 'Telefona' : 
                     ($product->category_id == 2 ? 'Laptopë' : 'Të tjera'); 
            ?></p>
            <h1><?php echo $product->name; ?></h1>
            <h4><?php echo number_format($product->price, 2); ?>&#8364;</h4>
            <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                <input type="hidden" name="product_name" value="<?php echo $product->name; ?>">
                <input type="hidden" name="product_price" value="<?php echo $product->price; ?>">
                <input type="hidden" name="product_image" value="<?php echo $product->image; ?>">
                <input type="number" name="quantity" value="1" min="1">
                <button type="submit" class="btn">Shto në shportë</button>
            </form>
            <h3>Detajet e produktit<i class="fa fa-indent"></i></h3>
            <br>
            <p><?php echo $product->description; ?></p>
        </div>
    </div>
</div>

<div class="small-container">
    <div class="row row-2">
        <h2>Produkte të ngjashme</h2>
        <p>Shiko më shumë</p>
    </div>

    <div class="row">
        <?php foreach($relatedProducts as $related): ?>
        <div class="col-4">
            <a href="product_details.php?id=<?php echo $related->id; ?>">
                <img src="<?php echo $related->image; ?>" alt="<?php echo $related->name; ?>">
                <h4><?php echo $related->name; ?></h4>
                <div class="rating">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <i class="fa fa-star<?php echo $i < $related->rating ? '' : '-o'; ?>"></i>
                    <?php endfor; ?>
                </div>
                <p><?php echo number_format($related->price, 2); ?>&#8364;</p>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
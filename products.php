<?php 
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
    new Product(6, 'ThinkPad E16 Gen 1 Laptop', 'ThinkPad E16 Gen 1 është laptop biznesi me procesor Intel Core të gjeneratës së 13-të, ekran 16 inch FHD, dhe tastierë të njohur ThinkPad. Përfshin veçori të avancuara të sigurisë dhe ndërtim të qëndrueshëm.', 829.50, 'images/product-6.png', 2, 4),
    new Product(11, 'Dell XPS 15', 'Dell XPS 15 është laptop premium me ekran OLED 4K, procesor Intel Core i9, kartë grafike NVIDIA RTX, dhe ndërtim alumini. Ideal për krijues përmbajtjeje dhe profesionistë.', 1799.00, 'images/dell-xps.jpg', 2, 5),
    new Product(12, 'ASUS ROG Zephyrus G14', 'ASUS ROG Zephyrus G14 është laptop gaming kompakt me procesor AMD Ryzen, kartë grafike NVIDIA RTX, dhe ekran 14 inch 144Hz. Perfekt për gaming në lëvizje.', 1699.00, 'images/rog-zephyrus.jpg', 2, 4),
    
    
    new Product(3, 'PRO X SUPERLIGHT 2 DEX', 'PRO X SUPERLIGHT 2 DEX është një maus gaming me sensor HERO 25K, peshë ultra të lehtë prej vetëm 63g, dhe lidhje wireless LIGHTSPEED. Ofron deri në 70 orë jetëgjatësi të baterisë dhe është i përshtatshëm për të gjitha stilet e lojërave.', 159.00, 'images/product-3.jpg', 3, 4),
    new Product(4, 'BOSE QuietComfort Bluetooth Headphone', 'BOSE QuietComfort ofron cilësi të jashtëzakonshme të zërit dhe anulim të zhurmës. Me komoditet superior dhe bateri që zgjat deri në 24 orë, këto kufje janë perfekte për udhëtime dhe përdorim të përditshëm.', 119.99, 'images/product-4.jpg', 3, 5),
    new Product(5, 'iPad Pro 11‑inch', 'iPad Pro 11-inch kombinon fuqinë e çipit M2 me ekranin Liquid Retina. Përfshin Face ID, kamera të avancuara, dhe mbështet Apple Pencil gjenerata e dytë. Ideal për krijimtari dhe produktivitet.', 999.99, 'images/product-5.jpg', 3, 5),
    new Product(7, 'HP Color LaserJet Pro MFP 3301fdw', 'HP Color LaserJet Pro MFP 3301fdw është printer multifunksional me shpejtësi të lartë printimi, skaner, kopjues dhe faks. Ofron cilësi të shkëlqyer printimi dhe kosto të ulët për faqe.', 429.00, 'images/product-7.png', 3, 4),
    new Product(8, 'PRIME Z890-P-CSM', 'PRIME Z890-P-CSM është pllakë amë e avancuar që mbështet procesorët më të fundit Intel. Përfshin WiFi 6E, PCIe 5.0, dhe veçori të shumta për performancë dhe qëndrueshmëri optimale.', 499.99, 'images/product-8.png', 3, 4),
    new Product(13, 'Sony WH-1000XM5 Headphones', 'Sony WH-1000XM5 janë kufje wireless me anulimin më të mirë të zhurmës në industri. Ofrojnë cilësi të lartë audio, komoditet superior, dhe 30 orë jetëgjatësi të baterisë.', 399.00, 'images/sony-wh1000xm5.jpg', 3, 5),
    new Product(14, 'Apple AirPods Pro 2', 'Apple AirPods Pro 2 ofrojnë cilësi të jashtëzakonshme të zërit, anulim aktiv të zhurmës, modalitet transparence adaptiv, dhe rezistencë ndaj ujit. Përfshijnë gjurmimin hapësinor të zërit dhe integrimin e përsosur me ekosistemin Apple.', 279.00, 'images/airpods-pro.jpg', 3, 5)
];

$catalog = new class {
    public function getProducts($category_id = null, $sort = 'default') {
        global $sample_products;
        $filtered = $sample_products;
        
        // Filter by category
        if ($category_id !== null) {
            $filtered = array_filter($filtered, function($product) use ($category_id) {
                return $product->category_id == $category_id;
            });
        }
        
        // Sort products
        switch ($sort) {
            case 'name_asc':
                usort($filtered, function($a, $b) { return strcmp($a->name, $b->name); });
                break;
            case 'name_desc':
                usort($filtered, function($a, $b) { return strcmp($b->name, $a->name); });
                break;
            case 'price_asc':
                usort($filtered, function($a, $b) { return $a->price - $b->price; });
                break;
            case 'price_desc':
                usort($filtered, function($a, $b) { return $b->price - $a->price; });
                break;
        }
        
        return array_values($filtered);
    }
};
$category_id = isset($_GET['category']) ?(int) $_GET['category'] : null;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';

$filtered_products = $catalog->getProducts($category_id, $sort);

?>
<div class="small-container">
    <div class="row row-2">
        <h2>Të gjitha produktet</h2>
        <form id="productFilterForm" method="GET">
            <?php if ($category_id): ?>
                <input type="hidden" name="category" value="<?php echo htmlspecialchars($category_id); ?>">
            <?php endif; ?>
            <select id="productFilter" name="sort" onchange="this.form.submit()">
                <option value="default">Renditja</option>
                <option value="name_asc" <?php echo $sort == 'name_asc' ? 'selected' : ''; ?>>A-Z</option>
                <option value="name_desc" <?php echo $sort == 'name_desc' ? 'selected' : ''; ?>>Z-A</option>
                <option value="price_asc" <?php echo $sort == 'price_asc' ? 'selected' : ''; ?>>Cmimi më i ulët</option>
                <option value="price_desc" <?php echo $sort == 'price_desc' ? 'selected' : ''; ?>>Cmimi me i lartë</option>
            </select>
        </form>
    </div>
    
    <div class="row">
        <?php foreach ($filtered_products as $product): ?>
            <div class="col-4">
                <a href="product_details.php?id=<?php echo $product->id; ?>">
                    <img src="<?php echo $product->image; ?>" alt="<?php echo htmlspecialchars($product->name); ?>">
                    <h4><?php echo htmlspecialchars($product->name); ?></h4>
                    <div class="rating">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <i class="fa fa-star<?php echo $i < $product->rating ? '' : '-o'; ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <p><?php echo number_format($product->price, 2); ?>€</p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

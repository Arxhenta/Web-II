<?php 
include 'includes/header.php';
include 'config.php';

$category_id = isset($_GET['category']) ? $_GET['category'] : null;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';


// Modified query with LIMIT and OFFSET
$sql = "SELECT * FROM products";
if ($category_id) {
    $sql .= " WHERE category_id = " . (int)$category_id;
}
switch ($sort) {
    case 'name_asc':
        $sql .= " ORDER BY name ASC";
        break;
    case 'name_desc':
        $sql .= " ORDER BY name DESC";
        break;
    case 'price_asc':
        $sql .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $sql .= " ORDER BY price DESC";
        break;
    default:
        $sql .= " ORDER BY name ASC";
}
$result = mysqli_query($conn, $sql);
?>
<div class="small-container">
    <div class="row row-2">
        <h2>Të gjitha produktet</h2>
        <form id="productFilterForm" method="GET">
            <?php if ($category_id): ?>
                <input type="hidden" name="category" value="<?php echo $category_id; ?>">
            <?php endif; ?>
            <select id="productFilter" name="sort" onchange="this.form.submit()">
                <option value="name_asc" <?php echo $sort == 'name_asc' ? 'selected' : ''; ?>>A-Z</option>
                <option value="name_desc" <?php echo $sort == 'name_desc' ? 'selected' : ''; ?>>Z-A</option>
                <option value="price_asc" <?php echo $sort == 'price_asc' ? 'selected' : ''; ?>>Cmimi më i ulët</option>
                <option value="price_desc" <?php echo $sort == 'price_desc' ? 'selected' : ''; ?>>Cmimi me i lartë</option>
            </select>
        </form>
    </div>
    
    <div class="row">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-4">
                <a href="product_details.php?id=<?php echo $row['id']; ?>">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    <h4><?php echo $row['name']; ?></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <p><?php echo $row['price']; ?>€</p>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script>
$(document).ready(function() {
    $('#productFilter').change(function() {
        let sortBy = $(this).val();
        let products = $('.col-4').get();
        
        products.sort(function(a, b) {
            switch(sortBy) {
                case 'price_asc':
                    return $(a).find('p').text().replace('€','') - $(b).find('p').text().replace('€','');
                case 'price_desc':
                    return $(b).find('p').text().replace('€','') - $(a).find('p').text().replace('€','');
                case 'rating':
                    return $(b).find('.fa-star').length - $(a).find('.fa-star').length;
                default:
                    return 0;
            }
        });
        
        $('.row').first().html(products);
    });
});
</script>



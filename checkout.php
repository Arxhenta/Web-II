<?php 
include 'includes/header.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;

// Calculate total
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Redirect to cart page if cart is empty
if (empty($cart)) {
    header('Location: cart.php');
    exit();
}
?>

<div class="small-container">
    <div class="row">
    <div class="col-2">   
                <?php foreach($cart as $item): ?>
                        <div class="cart-item">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>"/>      
                            <h4><?php echo $item['name']; ?></h4>
                            <p>Sasia: <?php echo $item['quantity']; ?></p>
                            <p>Cmimi: <?php echo $item['price']; ?>€</p>
                            <p>Subtotal: <?php echo $item['price'] * $item['quantity']; ?>€</p>
                        </div>
                <?php endforeach; ?>
            </div>       
    <div class="col-2">
    <form action="process_order.php" method="POST" class="checkout-form">
    <h2 class="title">Checkout</h2>
    <h3>Adresa e dergeses:</h3>
            <div class="input-group">
                <label for="fullname">Emri dhe Mbiemri:</label>
                <input type="text" id="fullname" name="fullname" placeholder="Ardona Gjyrevci" required>
            </div>
            <div class="input-group">
                <label for="number">Numri i telefonit:</label>
                <input type="number" id="phone" name="phone" placeholder="000-000-000" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="example@example.com" required>
            </div>
            <div class="input-group">
                <label for="address">Adresa:</label>
                <input type="text" id="address" name="address" placeholder="Rruga..." required>
            </div>
            <div class="input-group">
                <label for="city">Qyteti:</label>
                <input type="text" id="city" name="city" placeholder="Prishtina" required>
            </div>
            <div class="input-group">
                <label for="state">Shteti</label>
                <input type="text" id="state" name="state" placeholder="Kosove" required>
            </div>
            <div class="input-group">
                <label for="zip">Kodi Postar:</label>
                <input type="text" id="zip" name="zip" placeholder="10000" required>
            </div>
            <h3></h3>
            <p><strong>Totali:</strong> <?php echo $total; ?>&#8364;</p>
            <p><strong>Menyra e pageses:</strong>Kesh ne pranim</p>
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <div class="row">
                  <button type="submit" class="btn">Perfundo porosine</button>
            </div>
        </form>
        <br><br>
    </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

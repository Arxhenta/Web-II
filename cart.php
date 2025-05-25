
<?php include 'includes/header.php';
session_start();

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>
<div class="small-container cart-page">
    <table>
        <tr>
            <th>Produkti</th>
            <th>Sasia</th>
            <th>Totali</th>
        </tr>
        <?php foreach ($cart as $item): ?>
        <tr>
            <td>
                <div class="cart-info">
                    <img src="<?php echo $item['image']; ?>">
                    <div>
                        <p><?php echo $item['name']; ?></p>
                        <small>Cmimi: <?php echo $item['price']; ?>&#8364;</small>
                        <br>
                        <a href="remove_from_cart.php? id=<?php echo $item['id']; ?>">Hiq nga shporta</a> 
                    </div>
                </div>
            </td>
            <td><input type="number" value="<?php echo $item['quantity']; ?>" min="1" data-id="<?php echo $item['id']; ?>" class="quantity-input"></td>
            <td><?php echo $item['price'] * $item['quantity']; ?>&#8364;</td>
        </tr>
        <?php 
        $total += $item['price'] * $item['quantity'];
        endforeach; 
        ?>
    </table>

    <div class="total-price">
        <table>
            <tr>
                <td>Total</td>
                <td><?php echo $total; ?>&#8364;</td>
            </tr>
            <tr>
                <td>Posta</td>
                <td>0&#8364;</td>
            </tr>
            <tr>
                <td>Total për pagesë</td>
                <td><?php echo $total; ?>&#8364;</td>
            </tr>
            <tr>
                <td><a href="checkout.php"><button type="submit" class="btn">Paguaj</button></a></td>
            </tr>
        </table>

    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.quantity-input').change(function() {
        var id = $(this).data('id');
        var quantity = $(this).val();

        $.post('update_cart.php', {id: id, quantity: quantity}, function(data) {
            location.reload();
        });
    });
});
</script>

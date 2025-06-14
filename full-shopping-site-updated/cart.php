
<?php include 'db.php';
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (isset($_GET['id'])) $_SESSION['cart'][] = $_GET['id'];
?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="style.css"></head><body>
<div class="container">
<h2>Your Cart</h2>
<?php
$cart = $_SESSION['cart'];
if (count($cart) == 0) {
    echo "Cart is empty.";
} else {
    echo "<ul>";
    foreach ($cart as $c) echo "<li>Product $c</li>";
    echo "</ul>";
    echo "<a href='order.php'>Place Order</a>";
}
?>
<br><a href='products.php'>Back to Products</a>
</div></body></html>

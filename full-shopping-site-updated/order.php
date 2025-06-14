
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Place Order</title>
</head>
<body>
<div class="container">
<h2>Place Order</h2>

<?php
// Handle registration
if (isset($_POST['register'])) {
    $reg_user = $_POST['reg_username'];
    $reg_pass = $_POST['reg_password'];

    $check = $conn->query("SELECT * FROM users WHERE username='$reg_user'");
    if ($check->num_rows > 0) {
        echo "❌ Username already exists. Please login.";
    } else {
        $conn->query("INSERT INTO users (username, password) VALUES ('$reg_user', '$reg_pass')");
        $_SESSION['username'] = $reg_user;
        echo "✅ Registered and logged in as <b>$reg_user</b>.<br><br>";
    }
}

// Handle login
if (!isset($_SESSION['username']) && isset($_POST['login'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $res = $conn->query("SELECT * FROM users WHERE username='$u' AND password='$p'");
    if ($res->num_rows == 1) {
        $_SESSION['username'] = $u;
        echo "✅ Logged in successfully as <b>$u</b>.<br><br>";
    } else {
        echo "❌ Invalid login credentials.<br><br>";
    }
}

// If not logged in, show both login and registration forms
if (!isset($_SESSION['username'])) {
    echo "
    <div style='display: flex; gap: 50px;'>
        <div>
            <h3>Login</h3>
            <form method='post'>
                <input type='text' name='username' placeholder='Username' required><br><br>
                <input type='password' name='password' placeholder='Password' required><br><br>
                <button type='submit' name='login'>Login</button>
            </form>
        </div>

        <div>
            <h3>Register</h3>
            <form method='post'>
                <input type='text' name='reg_username' placeholder='Username' required><br><br>
                <input type='password' name='reg_password' placeholder='Password' required><br><br>
                <button type='submit' name='register'>Register</button>
            </form>
        </div>
    </div>";
    exit;
}

// Logged in, now process order
$items = implode(",", $_SESSION['cart'] ?? []);
if (empty($items)) {
    echo "🛒 Your cart is empty.";
} else {
    $user = $_SESSION['username'];
    $sql = "INSERT INTO orders (username, items) VALUES ('$user', '$items')";
    if ($conn->query($sql)) {
        echo "<br><br>✅ Order placed successfully!";
        $_SESSION['cart'] = []; // Clear cart after placing order
    } else {
        echo "❌ Error placing order: " . $conn->error;
    }
}
?>

<br><br><a href='products.php'>← Back to Products</a>
</div>
</body>
</html>

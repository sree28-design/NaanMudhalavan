
<?php include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $res = $conn->query("SELECT * FROM users WHERE username='$u' AND password='$p'");
    if ($res->num_rows == 1) {
        $_SESSION['username'] = $u;
        echo "Login successful. <a href='products.php'>Go to Products</a>";
    } else {
        echo "Invalid credentials.";
    }
    exit;
}
?>
<!DOCTYPE html><html><head><link rel='stylesheet' href='style.css'></head><body>
<div class='container'>
<h2>Login</h2>
<form method='post'>
Username: <input name='username'><br><br>
Password: <input name='password' type='password'><br><br>
<button type='submit'>Login</button>
</form>
</div></body></html>

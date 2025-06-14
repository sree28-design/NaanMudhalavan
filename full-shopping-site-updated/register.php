
<?php include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $exists = $conn->query("SELECT * FROM users WHERE username='$u'");
    if ($exists->num_rows > 0) {
        echo "⚠️ Username already exists. Please choose another. <a href='register.php'>Try again</a>";
    } else {
        $conn->query("INSERT INTO users (username, password) VALUES ('$u', '$p')");
        echo "✅ Registered successfully. <a href='login.php'>Login here</a>";
    }
    exit;
}
?>
<!DOCTYPE html><html><head><link rel='stylesheet' href='style.css'></head><body>
<div class='container'>
<h2>Register</h2>
<form method='post'>
<input name='username' placeholder='Username'>
<input name='password' type='password' placeholder='Password'>
<button type='submit'>Register</button>
</form>
</div></body></html>

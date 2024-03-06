<?php
session_start(); 

define('DB_USER', 'bgrewal1');
define('DB_PASS', 'bgrewal1');
define('DB_NAME', 'bgrewal1');
define('DB_HOST', 'localhost');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, username, password FROM innov8tors";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    while ($row = $result->fetch_assoc()) {
        if ($username == $row['username'] && $password == $row['password']) {
            $userid = $row['id'];

            // Stores user info 
            $_SESSION['userid'] = $userid;

            header("Location: ToDo.php");
            exit();
        }
    }

    echo "Username and password are not correct.";
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innov8tors</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="login-page">
    <div class="form-box">
        <div class="button-box">
            <div id="button-color"></div>
                <button type="submit" class="toggle-btn" onclick="login()">Login</button>
                <button type="submit" class="toggle-btn" onclick="register()">Register</button>
        </div>
        <form id="login" class="input-fields" method="POST" action="">
            <input type="text" class="input-box" placeholder="Enter Username" name="username" required>
             <input type="password" class="input-box" placeholder="Enter Password" name="password" required>
             <input type="checkbox" class="check-box"><span class="remember">Remember Password</span>
             <button type="submit" class="submit-button">Log In</button>
            </form>

        <form id="register" class="input-fields" method="POST" action="ToDo.php">
            <input type="text" class="input-box" placeholder="Enter Full Name" name="fullname" required>
            <input type="email" class="input-box" placeholder="Enter Email" name="email" required>
            <input type="text" class="input-box" placeholder="Choose Username" name= "username" required>
            <input type="text" class="input-box" placeholder="Enter Password" name= "password" required>
            <input type="text" class="input-box" placeholder="Re-enter Password" name="confirm" required>
            <input type="checkbox" class="check-box"><span class="remember">I agree to the terms & conditions</span>
            <button type="submit" class="submit-button">Register</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>

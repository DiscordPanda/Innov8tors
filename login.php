<?php
session_start(); 

// Remember to change to your own database
define('DB_USER', 'bgrewal1');
define('DB_PASS', 'bgrewal1');
define('DB_NAME', 'bgrewal1');
define('DB_HOST', 'localhost');

$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm'];
$email = $_POST['email'];
$fullname = $_POST['fullname'];
$reg_user = $_POST['reg_username']; 
$reg_pass = $_POST['reg_password'];

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, username, password FROM innov8tors";
$result = $conn->query($sql);
// logging in
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logging'])) {


    while ($row = $result->fetch_assoc()) {
        if ($username == $row['username'] && $password == $row['password']) {
            $userid = $row['id'];

            // Stores user info 
            $_SESSION['userid'] = $userid;

            header("Location: ToDo.php");
            exit();
        }
    }
    echo "<script>alert('Username and password are not correct.');</script>";
}
// registering
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registering'])) {

    if (strcmp($reg_pass, $confirm_password) != 0) {
        echo "<script>alert('Password does not match'); window.location.href = 'login.php' </script>"; // pop up alert & redirects to login.php
        exit();
    }
    $sql = "INSERT INTO innov8tors (email,confirmpass,fullname,username,password) VALUES ('$email','$confirm_password','$fullname','$reg_user', '$reg_pass')";
    echo "Successfully added";


    // Insert new user 
    $confirmpass = $_POST['confirmpass'];


    if ($conn->query($sql) === TRUE) {

        $userid = $conn->insert_id;
        $_SESSION['userid'] = $userid;
        header("Location: ToDo.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Innov8tors</title>
        <link rel="stylesheet" href="style1.css">
    </head>


    <body class="login-page">
    <div class="logo-container">
        <img src="./Images/logo4.png" alt="Innov8tors Logo" class="logo">
    </div>
        <div class="form-box">
            <div class="button-box">
                <div id="button-color"></div>
                    <button type="submit" class="toggle-btn" onclick="login()">Login</button>
                    <button type="submit" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <form id="login" class="input-fields" method="POST" action="">
                <!-- TODO: Make password not visible for the user -->
                <input type="text" class="input-box" placeholder="Enter Username" name="username" required>
                <input type="password" class="input-box" placeholder="Enter Password" name="password" required>
                <input type="checkbox" class="check-box"><span class="remember">Remember Username</span>
                <button id="logging" name="logging" type="submit" class="submit-button">Log In</button>
            </form>

            <form id="register" class="input-fields" method="POST" action="login.php">
                <!-- TODO: Make password and confirm password invisible -->
                <input id="fullname" name="fullname" type="text" class="input-box" placeholder="Enter Full Name" required>
                <input id="email" name="email" type="email" class="input-box" placeholder="Enter Email" required>
                <input id="reg_username" name="reg_username" type="text" class="input-box" placeholder="Choose Username" required>
                <input id="reg_password" name="reg_password" type="password" class="input-box" placeholder="Enter Password" required>
                <input id="confirm" name="confirm" type="password" class="input-box" placeholder="Re-enter Password" required>
                <input type="checkbox" class="check-box" required><span class="remember">I agree to the terms & conditions</span> <!-- TODO: Make this required, somehow this isnt required  -->
                <button id="registering" name="registering" type="submit" class="submit-button">Register</button>
            </form>
        </div>
        <script src="script.js"></script>
    </body>
</html>
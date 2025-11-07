<?php
session_start();
include 'config.php';

$message = [];

if(isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password']; // no encriptamos aquí

    // Primero verificamos si es usuario normal
    $selectUser = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('query failed');
    if(mysqli_num_rows($selectUser) > 0) {
        $row = mysqli_fetch_assoc($selectUser);
        if(password_verify($pass, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
            exit;
        }
    }

    // Luego verificamos si es admin
    $selectAdmin = mysqli_query($conn, "SELECT * FROM `admin` WHERE admin_email = '$email'") or die('query failed');
    if(mysqli_num_rows($selectAdmin) > 0) {
        $row = mysqli_fetch_assoc($selectAdmin);
        if(password_verify($pass, $row['admin_password'])) {
            $_SESSION['admin_id'] = $row['admin_id'];
            header('location:adminside/dashboard.php');
            exit;
        }
    }

    // Si no coincide con ninguno
    $message[] = 'Incorrect email or password!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="css/images/logo.png">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3 class="headertext" style="font-size:23px; word-spacing:3px; background-color:#333; border-radius: 5px; color: #30E3CA; box-shadow:0 10px 10px rgba(0,0,0,.1);">
                <i class="fas fa-music"></i> WELCOME TO THE MUSIVERSE
            </h3>
            <a href="index.php" class="back-button"><i class="fas fa-arrow-left"></i> Back</a>

            <img src="css/images/logo.png" style="width: 300px;" class="concertlogo">
            <h3 style="text-decoration:underline; text-decoration-thickness: 5px; text-decoration-color: #0D7377;">Login</h3>

            <?php
            if(!empty($message)) {
                foreach($message as $msg) {
                    echo '<div class="message">'.$msg.'</div>';
                }
            }
            ?>

            <div class="input-container">
                <img src="css/images/mail.png" class="icon" style="width: 45px; vertical-align: middle;">
                <input type="email" name="email" placeholder="Enter email" class="box" required>
            </div>

            <div class="input-container">
                <img src="css/images/padlock.png" class="icon" style="width: 45px; vertical-align: middle;">
                <input type="password" name="password" placeholder="Enter password" class="box" required>
            </div>

            <input type="submit" name="submit" value="Login now" class="btn">
            <input type="button" name="forgot" value="Forgot Password?" class="btn" style="background-color:#0D7377" onclick="redirectToForgotPage()">
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        </form>
    </div>

<script>
function redirectToForgotPage() {
    window.location.href = "forgot.php";
}
</script>
</body>
</html>

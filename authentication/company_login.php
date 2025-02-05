<?php
include "../config/db.php";

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/login.css">
</head>

<body>
    <div class="login-container">
        <?php
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $email = mysqli_real_escape_string($con, $email);

            $sql = "SELECT id, password FROM company WHERE email='$email'";
            $result = mysqli_query($con, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $company = mysqli_fetch_assoc($result);
                if (password_verify($password, $company['password'])) {
                    $_SESSION['company_id'] = $company['id'];
                    header('Location: ../company/dashboard.php');
                } else {
                    echo "Password doesn't match!";
                }
            } else {
                echo "Email doesn't exist!";
            }
        }
        ?>
        <form action="company_login.php" method="post">
            <h1 style="margin: 10px;">Login as Company</h1>
            <div class="input-container">
                <input type="email" name="email" placeholder=" " required>
                <label for="email">Email</label>
            </div>
            <div class="input-container">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">Password</label>
            </div>
            <input type="submit" value="Login" name="login">
            <a href="#">Forgot Password?</a>
            <div class="separator">
                <hr>
                <p>or</p>
                <hr>
            </div>
            <p>Don't have account?<a href="../authentication/company_sign_up.php">Create one</a></p>
        </form>
    </div>
</body>

</html>
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
        
            $sql = "SELECT id, password FROM candidate WHERE email='$email'";
            $result = mysqli_query($con, $sql);
        
            if ($result && mysqli_num_rows($result) > 0) {
                $candidate = mysqli_fetch_assoc($result);
                if (password_verify($password, $candidate['password'])) {
                    $_SESSION['candidate_id'] = $candidate['id'];
                    header('Location: ../candidate/dashboard.php');
                } else {
                    echo "Password doesn't match!";
                }
            } else {
                echo "Email doesn't exist!";
            }
        }
        ?>
        <form action="candidate_login.php" method="post">
            <h1 style="margin: 10px;">Login as Candidate</h1>
            <div class="input-container">
                <input type="email" name="email" placeholder=" "  required>
                <label for="email">Email</label>
            </div>
            <div class="input-container">
                <input type="password" name="password" id="password" placeholder=" ">
                <label for="password">Password</label>
            </div>
            <input type="submit" value="Login" name="login" placeholder=" ">
            <a href="#">Forgot Password?</a>
            <div class="separator">
                <hr> <p>or</p> <hr>
            </div>
            <p>Don't have account?<a href="../authentication/candidate_sign_up.php">Create one</a></p>
        </form>
       </div>
</body>
</html>
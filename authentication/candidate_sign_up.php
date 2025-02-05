<?php
include "../config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up as Candidate</title>
    <link rel="stylesheet" href="../public/css/form.css">
</head>
<body>
   <section id="sign-up-section">
    <div class="description">
        <h1>Looking for Job</h1>
        <h2>Find your dream work on Online Job Portal.</h2> 
        <h2>Create an account for free</h2>
    </div>
    <div class="form-container">
        <?php
          if(isset($_POST['submit'])){
            $fullname=$_POST['fullname'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $passwordHash=password_hash($password,PASSWORD_DEFAULT);
            $confirmPassword=$_POST['confirm-password'];
            $errors=array();
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                array_push($errors,"Invalid Email");
            }
            else if(strlen($password)<8){
                array_push($errors,"Password must more than 8 character");
            }
            else if($password!==$confirmPassword){
                array_push($errors,"Password doesn't match");
            }
            $sql = "SELECT * FROM candidate WHERE email='$email'";
            $result = mysqli_query($con, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, 'Email already exists!');
            }
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "$error";
                }
            } else {
                $sql="INSERT INTO candidate(name,email,password) VALUES('$fullname','$email','$passwordHash')";
                $result=mysqli_query($con,$sql);
                if($result){
                    $candidate_id=mysqli_insert_id($con);

                    $query="INSERT INTO profile(candidate_id) VALUES ($candidate_id)";
                    mysqli_query($con,$query);

                    header("Location: ../authentication/candidate_login.php");
                }else{
                    echo "Error occured try again";
                }
            }     
        }
        ?>
        <form action="candidate_sign_up.php" method="post" autocomplete="on" class="form">
            <h2>Register as Candidate</h2>
            <p id="alerts"></p>
            <div class="input-container">
                <input type="text" name="fullname" id="company-name" placeholder=" " required>
                <label for="company-name">Full Name</label>
            </div>
            <div class="input-container">
                <input type="email" name="email" id="email" placeholder=" " required>
                <label for="email">Email</label>
            </div>
            <div class="input-container">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">Password</label>
            </div>
            <div class="input-container">
                <input type="password" name="confirm-password" id="confirm-password" placeholder=" " required>
                <label for="confirm-password">Confirm Password</label>
            </div>
            <input type="submit" value="Register" name="submit" class="button">
            <div></div>
            <div class="separator">
                <hr> <p>or</p> <hr>
            </div>
            <div class="external-link">
                <a href="#"><img src="../images/Google-removebg-preview.png" alt="" width="30px" height="30px">Continue with Google</a>
                <a href="#"><img src="../images/Linkedin-removebg-preview.png" alt="" width="30" height="30px">Continue with Linkedln</a>
            </div>
            <h3>Already have an account? <a href="../authentication/candidate_login.php">Login here</a></h3>
        </form>
    </div>
   </section>
   <script src="../public/js/header.js"></script>
   <script src="../public/js/form.js"></script>
</body>
</html>
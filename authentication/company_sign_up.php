<?php
include "../config/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up as Company</title>
    <link rel="stylesheet" href="../public/css/form.css">
</head>
<body>
   <section id="sign-up-section">
    <div class="description">
        <h1>Looking for Job Seeker?</h1>
        <h2>The talent you need is one click away.</h2> 
        <h2>Create an account for free</h2>
    </div>
    <div class="form-container">
    <?php
        if(isset($_POST['submit'])){
            $companyName=$_POST['company-name'];
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
            $sql = "SELECT * FROM company WHERE email='$email'";
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
                $sql="INSERT INTO company(company_name,email,password) VALUES('$companyName','$email','$passwordHash')";
                $result=mysqli_query($con,$sql);
                if($result){

                    $company_id=mysqli_insert_id($con);

                    $query="INSERT INTO company_profile(company_id) VALUES ($company_id)";
                    mysqli_query($con,$query);

                    header("Location: ../authentication/company_login.php");
                }else{
                    echo "Error occured try again";
                }
            }     
        }
        ?>
        <form action="company_sign_up.php" method="post" autocomplete="on" class="form">
            <h2>Register as Company</h2>
            <p id="alerts"></p>
            <div class="input-container">
                <input type="text" name="company-name" id="company-name" placeholder=" " required>
                <label for="company-name">Company Name</label>
            </div>
            <div class="input-container">
                <input type="text" name="email" id="email" placeholder=" " required>
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
            <h3>Already have an account? <a href="../authentication/company_login.php">Login here</a></h3>
        </form>
    </div>
   </section>
</body>
</html>
<?php include "../admin/utilities/header.php" ?>
    <div class="right-panel">
        <div class="panel-header">
            <h1>Welcome to Admin Dashboard</h1>
        </div>

        <?php 
        if(isset($_POST['update'])){
            if (isset($_FILES['profile-pic'])) {
                $target_dir = "../images/";
                $file = basename($_FILES['profile-pic']['name']);
                $target_file = $target_dir . $file;
                if (!move_uploaded_file($_FILES['profile-pic']['tmp_name'], $target_file)) {
                    echo 'There is a problem uploading the picture';
                }
            }else{
                echo "Please choose a picture";
            }
            $name=$_POST['name'];
            $email=$_POST['email'];
            $password=$_POST['password'];

            $sql="UPDATE admin SET profile='$file',name='$name',email='$email',password='$password'";
            $result=mysqli_query($con,$sql);
            if($result){
                header("Location: profile.php");
            }
        }
        ?>
        <div class="form-container">
        <form action="update_profile.php" method="post" enctype="multipart/form-data">
            <label for="profile-pic">Profile Picture</label>
            <input type="file" name="profile-pic" id="profile-pic">
            <label for="name">Full name</label>
            <input type="text" name="name">
            <label for="email">Email</label>
            <input type="email" name="email">
            <label for="password">Reset Password</label>
            <input type="password" name="password" required>
            <input type="submit" name="update" value="Update">
        </form>
        </div>
    </div>
</section> 
<script src="../public/js/script.js"></script> 
</body>
</html>
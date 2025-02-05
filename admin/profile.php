<?php include "../admin/utilities/header.php" ?>
    <div class="right-panel">
        <div class="panel-header">
            <h1>Welcome to Admin Dashboard</h1>
        </div>
        <div class="profile-container">
        <div class="profile-info">
            <?php
            $sql="SELECT * FROM admin";
            $result=mysqli_query($con,$sql);
            if($result&&mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $picture=$row['profile'];
                $name=$row['name'];
                $email=$row['email'];
            }
            echo '
            <img src="../images/' . $picture . '" alt="Profile Picture" width="200px" height="200">
            <h1>' . $name . '</h1>
            <p>Email : <a href="mailto:' . $email . '">' . $email . '</a></p>';
            ?>
        </div>
        <a href="update_profile.php" class="btn">Update Profile</a>
    </div>
    </div>
</section> 
<script src="../public/js/script.js"></script> 
</body>
</html>
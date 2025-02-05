<?php
include "../company/utilities/header.php";
?>
<div class="right-panel">
    <?php
    $query="SELECT * FROM company INNER JOIN company_profile ON company.id=company_profile.company_id WHERE company.id='$id'";
    $result=mysqli_query($con,$query);
    if($result){
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            $logo=$row['company_logo'];
            $name=$row['company_name'];
            $email=$row['email'];
            $location=$row['location'];
            $contact=$row['contact'];
            $website=$row['website'];
            $about=$row['description'];

            echo '
            <div class="panel-header">
                <h1>Welcome to Company Dashboard</h1>
            </div>
            <div class="profile-container">
                <div class="profile-info">
                    <img src="../images/'.$logo.'" alt="Profile Picture" width="200px" height="200" style="border: none;">
            <h1>'.$name.'</h1>
        </div>
        <div class="profile-detail">
            <p><b>Contact Email : </b><a href="mailto:'.$email.'">'.$email.'</a></p>
            <p><b>Company Location : </b> '.$location.'</p>
            <p><b>Company Tel : </b>'.$contact.'</p>
            <p><b>Company Website : </b> <a href="'.$website.'">'.$website.'</a></p>
            <h1>About</h1>
            <p>'.$about.'</p>
        </div>
        <a href="../company/update_profile.php?c_id='.$id.'" class="btn">Edit Profile</a>
    </div>
            ';
        }
    }
    ?>
</div>
</section>
<?php include "../company/utilities/footer.php"; ?>
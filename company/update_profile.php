<?php
include "../company/utilities/header.php";
?>
<div class="right-panel">
    <?php

    if(isset($_POST['update'])){
        if(isset($_FILES)){
            $target_dir="../images/";
            $file=basename($_FILES['logo']['name']);
            $target_file=$target_dir.$file;
            if(!move_uploaded_file($_FILES['logo']['tmp_name'], $target_file)){
                echo "Can't upload the file";
            }
        }

        $contact=$_POST['contact'];
        $location=$_POST['location'];
        $website=$_POST['website'];
        $description=$_POST['about'];

        $query="UPDATE company_profile SET company_logo='$file',contact='$contact',location='$location',website='$website',description='$description' WHERE company_id='$id'";
        $updated=mysqli_query($con,$query);
        if($updated){
            header("Location: ../company/profile.php");
        }else{
            echo "Can't update try again";
        }

    }

    ?>
    <div class="panel-header">
        <h1>Wel come to Company Dashboard</h1>
    </div>
    <div class="form-container">
        <?php
        $sql="SELECT * FROM company INNER JOIN company_profile ON company.id=company_profile.company_id WHERE company.id='$id'";
        $result=mysqli_query($con,$sql);
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
            }
        }
        ?>
        <h1 style="margin: 20px;">Edit Company Profile</h1>
        <form action="update_profile.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="c_id" value="<?php echo $c_id; ?>">
            <div class="profile-picture">
                <img src="../images/<?php echo $logo ?>" alt="Profile Picture" width="200px" height="200px">
            </div>
            <label>Upload Logo:</label>
            <input type="file" name="logo" value="<?php echo $logo;?>">
            <label>Company Name:</label>
            <input type="text" name="company-name" value="<?php echo $name;?>" readonly>
            <label>Contact Email:</label>
            <input type="email" name="email" value="<?php echo $email;?>" readonly>
            <label>Phone Number:</label>
            <input type="text" name="contact" value="<?php echo $contact;?>">
            <label>Location:</label>
            <input type="text" name="location" value="<?php echo $location;?>">
            <label>Company Website:</label>
            <input type="text" name="website" value="<?php echo $website;?>">
            <label>Company Description :</label>
            <textarea name="about" cols="10" rows="4"><?php echo $about; ?></textarea>
            <button type="submit" name="update">Update Profile</button>
        </form>
    </div>
</div>
</section>
<?php include "../company/utilities/footer.php";?>
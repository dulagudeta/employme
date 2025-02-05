<?php
include "../candidate/utilities/header.php";

if (isset($_POST['update'])) {
    if (isset($_FILES['profile-pic'])) {
        $target_dir = "../images/";
        $file = basename($_FILES['profile-pic']['name']);
        $target_file = $target_dir . $file;
        if (!move_uploaded_file($_FILES['profile-pic']['tmp_name'], $target_file)) {
            echo 'There is a problem uploading the picture';
        }
    }
    $address = $_POST['address'];
    $field = $_POST['field'];
    $gender = $_POST['gender'];
    $experience = $_POST['experience'];
    $education_level = $_POST['education-level'];
    $about = $_POST['about'];
    $nationality = $_POST['nationality'];

    $query = "UPDATE profile SET
     profile_pic='$file',
     nationality='$nationality',
     address='$address',
     field='$field',
     gender='$gender',
     experience='$experience',
     education='$education_level',
     about='$about' WHERE candidate_id='$id'";

    $updated = mysqli_query($con, $query);
    if ($updated) {
        header("Location: ../candidate/profile.php");
    } else {
        $success = "Error occured try again!";
    }
}

?>

<div class="right-panel">
    <div class="panel-header">
        <h1>Wal como to Candidate Dashboard</h1>
    </div>
    <div class="form-container">
        <?php
        $retrieve = "SELECT c.name,
               c.email,
               p.profile_pic,
               p.field,
               p.nationality,
               p.address,
               p.gender,
               p.experience,
               p.education,
               p.about 
        FROM candidate c 
        INNER JOIN profile p ON p.candidate_id = c.id 
        WHERE c.id = '$id'";

        $result = mysqli_query($con, $retrieve);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $picture = $row['profile_pic'];
                $name = $row['name'];
                $field = $row['field'];
                $email = $row['email'];
                $nationality = $row['nationality'];
                $address = $row['address'];
                $gender = $row['gender'];
                $experience = $row['experience'];
                $education = $row['education'];
                $about = $row['about'];
            }
        }
        ?>
        <h1 style="margin: 20px;">Update your prifile</h1>
        <form action="update_profile.php" method="post" enctype="multipart/form-data">
            <label for="profile-pic">Profile Picture</label>
            <input type="file" name="profile-pic" id="profile-pic">
            <label for="name">Full name</label>
            <input type="text" name="name" value="<?php echo $name ?>" readonly>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $email ?>" readonly>
            <label for="field">Field</label>
            <input type="text" name="field" value="<?php echo $field ?>">
            <label for="Location">Country</label>
            <select name="nationality" id="nationality">
                <?php
                $countries = ["Burundi", "Djibouti", "Eritrea", "Ethiopia", "Kenya", "Rwanda", "South Sudan", "Tanzania", "Uganda", "Somalia"];
                foreach ($countries as $country) {
                    $selected = ($country == $nationality) ? "selected" : "";
                    echo "<option value='$country' $selected>$country</option>";
                }
                ?>
            </select>
            <label for="Location">Address</label>
            <input type="text" name="address" value="<?php echo $address ?>">
            <label for="gender">Gender</label>
            <div class="radio-input">
                <label for="male">
                    <input type="radio" name="gender" id="male" value="Male" <?php echo ($gender == "Male") ? "checked" : "" ?>> Male
                </label>
                <label for="female">
                    <input type="radio" name="gender" id="female" value="Female" <?php echo ($gender == "Female") ? "checked" : "" ?>> Female
                </label>
            </div>
            <label for="experience">Experience</label>
            <input type="text" name="experience" value="<?php echo $experience ?>">
            <label for="education">Level of Education</label>
            <input type="text" name="education-level" value="<?php echo $education ?>">
            <label for="description">Describe your self</label>
            <textarea name="about" id="about" rows="5" cols="40"><?php echo $about ?></textarea>
            <button type="submit" name="update">Set Profile</button>
        </form>
    </div>
</div>
</section>
<footer>
    <div class="ul">
        <ul>
            <h1>Follow Us</h1>
            <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
            <li><a href="#"><i class="fab fa-telegram"></i> Telegram</a></li>
            <li><a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
            <li><a href="#"><i class="fab fa-youtube"></i> YouTube</a></li>
        </ul>
    </div>
    <div>
        <h1>Follow Us on</h1>
        <div class="icon-linked">
            <a href="#"><img src="../images/telegram.png" alt="Telegram" width="50px" height="50px" style="border-radius: 50%;"></a>
            <a href="#"><img src="../images/Linkedin-removebg-preview.png" alt="LinkedIn" width="50px" height="50px"></a>
            <a href="#"><img src="../images/facebook.webp" alt="Facebook" width="50px" height="50px"></a>
            <a href="#"><img src="../images/youtube.jpeg" alt="YouTube" width="50px" height="50px" style="border-radius: 50%;"></a>
        </div>
    </div>
    <div>
        <ul>
            <h1>Contact Us</h1>
            <li><a href="mailto:job@example.com"><i class="fas fa-envelope"></i> job@example.com</a></li>
            <li><a href="#"><i class="fas fa-comment"></i> Feedback</a></li>
            <li><a href="../authentication/login.html"><i class="fas fa-sign-in-alt"></i> Login</a></li>
            <li><a href="../authentication/candidate_sign_up.html"><i class="fas fa-user-plus"></i> Sign Up</a></li>
        </ul>
    </div>
    <div class="copyright">
        <p>&copy; 2024 Third-Year Student Group <sup>TM</sup>. All Rights Reserved.</p>
    </div>
</footer>

</body>

</html>
</body>

</html>
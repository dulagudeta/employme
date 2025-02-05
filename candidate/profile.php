<?php
include "../candidate/utilities/header.php";

$sql = "SELECT c.name,
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

$result = mysqli_query($con, $sql);
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




<div class="right-panel">
    <div class="panel-header">
        <h1>Wal como to Candidate Dashboard</h1>
    </div>
    <div class="profile-container">
        <div class="profile-info">
            <?php
            echo '
            <img src="../images/' . $picture . '" alt="Profile Picture" width="200px" height="200">
            <h1>' . $name . '</h1>
            <p>Email : <a href="mailto:' . $email . '">' . $email . '</a></p>
            <p>' . $field . '</p>';
            ?>
        </div>
        <div class="profile-detail">
            <?php
            echo '
            <p><b>Country : </b>' . $nationality . '</p>
            <p><b>Address : </b>' . $address . '</p>
            <p><b>Gender : </b>' . $gender . '</p>
            <p><b>Experience : </b>' . $experience . '</p>
            <p><b>Education : </b>' . $education . '</p>
            <p><b>About my self : </b>' . $about . '</p>
            ';
            ?>
        </div>
        <a href="../candidate/update_profile.php" class="btn">Update Profile</a>

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
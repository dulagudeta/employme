<?php
include "../company/utilities/header.php";
?>

<div class="right-panel">
    <div class="panel-header">
        <h1>Welcome to Company Dashboard</h1>
    </div>
    <section style="margin: 20px; padding:20px; border:1px solid black;">
        <?php
        if (isset($_GET['id'])) {
            $job_id = $_GET['id'];
        }

        $applicants = "SELECT p.profile_pic,a.email,a.name,a.contact,a.resume,a.applied_date FROM profile p INNER JOIN applicants a ON p.candidate_id=a.candidate_id WHERE a.job_id='$job_id'";
        $retrieve = mysqli_query($con, $applicants);
        if ($retrieve) {
            if (mysqli_num_rows($retrieve) > 0) {
                while ($row = mysqli_fetch_assoc($retrieve)) {
                    $name = $row['name'];
                    $email = $row['email'];
                    $profile = $row['profile_pic'];
                    $contact = $row['contact'];
                    $resume = $row['resume'];
                    $applied_at = $row['applied_date'];

                    echo '
                   <div class="applicants">
                        <div class="applicant">
                        <img src="../images/'.$profile.'" alt="Profile">
                        <h1>'.$name.'</h1>
                        <p>Email: <a href="mailto:'.$email.'">'.$email.'</a></p>
                        <p>Contact: '.$contact.'</p>
                        <p>Applied on: '.$applied_at.'</p>
                        <p><a href="../uploads/resume/'.$resume.'" target="_blank">View Resume</a></p>
                        <p><a href="../uploads/resume/'.$resume.'" download>Download Resume</a></p>
                        </div>
                    </div> 
                    ';
                }
            }
        }
        ?>
    </section>
</div>
</section>
<?php include "../company/utilities/footer.php"; ?>
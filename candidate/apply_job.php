<?php
include "../candidate/utilities/header.php";
if (isset($_GET['id'])) {
    $job_id = mysqli_real_escape_string($con, $_GET['id']);
} else {
    echo "Job ID is not provided!";
    exit;
}

$job_check_query = "SELECT id FROM jobs WHERE id = '$job_id'";
$job_check = mysqli_query($con, $job_check_query);

if (mysqli_num_rows($job_check) == 0) {
    echo "Invalid Job ID. The job does not exist!";
    exit;
}
?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Welcome to Candidate Dashboard</h1>
    </div>
    <div class="profile-container">
        <?php
        $candidate_check_query = "SELECT name, email FROM candidate WHERE id = '$id'";
        $candidate_check = mysqli_query($con, $candidate_check_query);

        if ($candidate_check && mysqli_num_rows($candidate_check) > 0) {
            $row = mysqli_fetch_assoc($candidate_check);
            $name = $row['name'];
            $email = $row['email'];
        } else {
            echo "Candidate not found!";
            exit;
        }


        $is_applied_query = "SELECT candidate_id FROM applicants WHERE candidate_id = '$id' AND job_id = '$job_id'";
        $check = mysqli_query($con, $is_applied_query);

        if ($check && mysqli_num_rows($check) > 0) {
            echo '<div class="alert">You have already applied for this job. Please wait for a response.</div>';
        } else {
            if (isset($_POST['apply'])) {

                if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
                    $target_dir = "../uploads/resume/";
                    $file = basename($_FILES['resume']['name']);
                    $target_file = $target_dir . $file;
                    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    if (!in_array($file_type, ["pdf", "doc", "docx"])) {
                        echo "Only PDF, DOC, and DOCX files are allowed.";
                        exit;
                    }

                    if (!move_uploaded_file($_FILES['resume']['tmp_name'], $target_file)) {
                        echo "Error uploading file.";
                        exit;
                    }
                } else {
                    echo "Please upload a valid resume.";
                    exit;
                }

                $contact = mysqli_real_escape_string($con, $_POST['contact']);
                $query = "INSERT INTO applicants (job_id, candidate_id, name, email, contact, resume) 
                  VALUES ('$job_id', '$id', '$name', '$email', '$contact', '$file')";

                $applied = mysqli_query($con, $query);
                if ($applied) {
                    $_SESSION['success_message'] = "Application submitted successfully!";
                    header("Location: ../candidate/dashboard.php");
                    exit;
                } else {
                    $_SESSION['error_message'] = "Application failed. Please try again. Error: " . mysqli_error($con);
                    header("Location: ../candidate/dashboard.php");
                    exit;
                }
            }

            echo '
            <div class="form-container">
    <form action="apply_job.php?id=' . $job_id . '" method="post" enctype="multipart/form-data">
        <h2>Apply for Job</h2>
        <label>Upload your Resume</label>
        <input type="file" name="resume" required>
        <label>Contact Number</label>
        <input type="text" placeholder="e.g., +2510000000" name="contact" required>
        <input type="submit" name="apply" value="Apply Job">
    </form>
    </div>
    ';
        }
        ?>
    </div>
</div>
</section>
<?php include "../candidate/utilities/footer.php"; ?>
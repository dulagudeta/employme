<?php
include "../company/utilities/header.php";
include "../functions/retrieve_job_detail.php";

if (isset($_GET['id'])) {
    $job_id = $_GET['id'];
}
?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Welcome to Company Dashboard</h1>
    </div>
    <?php
    if (isset($_POST['remove'])) {
        $remove = "DELETE FROM jobs WHERE id='$job_id'";
        $deleted = mysqli_query($con, $remove);
        if ($deleted) {
            header("Location: ../company/dashboard.php");
        } else {
            echo "Can't remove job";
        }
    }

    $job_details = retrieve_job_detail($con, $id, $job_id);

    if ($job_details) {
        foreach ($job_details as $job) {
            echo '
            <div class="job-body">
                <h1>' . $job['title'] . '</h1>
                <p><b>Industry:</b> ' . $job['industry'] . '</p>
                <p><b>Location:</b> ' . $job['location'] . '</p>
                <p><b>Salary:</b> ' . $job['salary'] . '</p>
                <p><b>Employment type:</b> ' . $job['type'] . '</p>
                    <p><b>Required skills:</b></p>
                    <p>' . $job['skill'] . '.</p>
                    <p><b>Description:</b></p>
                    <p>' . $job['description'] . '.</p>
                    <p><b>Posted date:</b> ' . $job['posted_date'] . '</p>
                    <p><b>Application Deadline:</b> ' . $job['deadline'] . '</p>
                <div class="job-btn">
                    <a href="../company/view_applicants.php?id='.$job_id.'">View Applicants</a>
                    <a href="../company/update_job.php?id='.$job_id.'">Update Job</a>
                    <form method="post">
                        <button class="remove-btn" name="remove" value="' . $job_id . '">Remove Job</button>
                    </form>
                </div>
            </div>
            ';
        }
    } else {
        echo '<p>No job found or deleted.</p>';
    }
    ?>
    </section>
    <?php include "../company/utilities/footer.php";?>
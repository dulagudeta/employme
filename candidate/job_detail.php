<?php
include "../candidate/utilities/header.php";

if (isset($_GET['id'])) {
    $job_id = $_GET['id'];
}
?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Welcome to Company Dashboard</h1>
    </div>
    <?php
    $retrieve_job = "
    SELECT 
        c.company_name, 
        cp.company_logo, 
        j.title, 
        j.place, 
        j.industry, 
        j.salary, 
        j.description, 
        j.posted_date, 
        j.skill, 
        j.deadline, 
        j.company_id, 
        j.type
    FROM 
        company c 
    INNER JOIN 
        company_profile cp 
    ON 
        c.id = cp.company_id 
    INNER JOIN 
        jobs j 
    ON 
        c.id = j.company_id 
    WHERE 
        j.id = '$job_id'";
    $retrieved = mysqli_query($con, $retrieve_job);
    if ($retrieved) {
        if (mysqli_num_rows($retrieved)) {
            while ($job = mysqli_fetch_assoc($retrieved)) {
                echo '
            <div class="job-body">
                <h1>' . $job['title'] . '</h1>
                <p><b>Industry:</b> ' . $job['industry'] . '</p>
                <p><b>Location:</b> ' . $job['place'] . '</p>
                <p><b>Salary:</b> ' . $job['salary'] . '</p>
                <p><b>Employment type:</b> ' . $job['type'] . '</p>
                    <p><b>Required skills:</b></p>
                    <p>' . $job['skill'] . '.</p>
                    <p><b>Description:</b></p>
                    <p>' . $job['description'] . '.</p>
                    <p><b>Posted date:</b> ' . $job['posted_date'] . '</p>
                    <p><b>Application Deadline:</b> ' . $job['deadline'] . '</p>
                <div class="apply-link">
                    <a href="../candidate/apply_job.php?id=' . $job_id . '"><i class="fas fa-paper-plane"></i>Apply</a>
                </div>
            </div>
            ';
            }
        }
    } else {
        echo '<p>No job detail found.</p>';
    }
    ?>
    </section>
    <?php include "../candidate/utilities/footer.php"; ?>
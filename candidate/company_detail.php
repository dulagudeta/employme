<?php
include "../candidate/utilities/header.php";
if (isset($_GET['id'])) {
    $c_id = $_GET['id'];
}
?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Welcome to Candidate Dashboard</h1>
    </div>
    <div class="profile-container">
        <?php
        $company = "SELECT * FROM company INNER JOIN company_profile ON company.id=company_profile.company_id WHERE company.id='$c_id'";
        $retrieved = mysqli_query($con, $company);
        if ($retrieved) {
            if (mysqli_num_rows($retrieved) > 0) {
                while ($row = mysqli_fetch_assoc($retrieved)) {
                    $company_id = $row['id'];
                    $logo = $row['company_logo'];
                    $name = $row['company_name'];
                    $location = $row['location'];
                    $email = $row['email'];
                    $contact = $row['contact'];
                    $website = $row['website'];
                    $about = $row['description'];

                    echo '
                    <div class="profile-info">
                        <img src="../images/' . $logo . '" alt="Profile Picture" width="200px" height="200" style="border: none;">
                        <h1>' . $name . '</h1>
                    </div>
                    <div class="profile-detail">
                        <p><b>Contact Email : </b><a href="mailto:' . $email . '">' . $email . '</a></p>
                        <p><b>Company Location : </b> ' . $location . '</p>
                        <p><b>Company Tel : </b>' . $contact . '</p>
                        <p><b>Company Website : </b> <a href="' . $website . '">' . $website . '</a></p>
                        <h1>About</h1>
                        <p>' . $about . '</p>
                    </div>';
                }
            } else {
                echo "Error fetching company detail!";
            }
        }
        ?>
    </div>
    <div class="job-list-container">
        <?php
        $retrieve_job = "SELECT 
            c.company_name,
            cp.company_logo,
            j.title,
            j.description ,
            j.posted_date,
            j.deadline,
            j.place,
            j.id
        FROM jobs j
        INNER JOIN company c ON j.company_id = c.id
        INNER JOIN company_profile cp ON c.id = cp.company_id WHERE c.id='$c_id' ORDER BY posted_date DESC";
        $retrieved = mysqli_query($con, $retrieve_job);
        if ($retrieved) {
            if (mysqli_num_rows($retrieved) > 0) {
                while ($row = mysqli_fetch_assoc($retrieved)) {
                    $logo = $row['company_logo'];
                    $name = $row['company_name'];
                    $title = $row['title'];
                    $location = $row['place'];
                    $description = $row['description'];
                    $posted_at = $row['posted_date'];
                    $deadline = $row['deadline'];
                    $job_id = $row['id'];
                    echo '
                        <h1>Jobs Posted by ' . $name . '</h1>
                <div class="jobs">
                    <div class="company-name">
                        <img src="../images/' . $logo . '" alt="Company Logo" width="50px" height="50px">
                        <h1>' . $name . '</h1>
                    </div>
                    <div class="jobs-description">
                        <h2>' . $title . '</h2>
                        <p><i class="fas fa-map-marker-alt"></i> <b> Location: </b>' . $location . '</p>
                        <p>' . $description . '.</p>
                        <div>
                            <p><b>Posted date :</b>' . $posted_at . '</p>
                            <p><b>Deadline date :</b>' . $deadline . '</p>
                        </div>
                    </div>
                    <div class="apply-link">
                        <a href="../candidate/apply_job.php?id=' . $job_id . '"><i class="fas fa-paper-plane"></i>Apply</a>
                        <a href="../candidate/job_detail.php?id=' . $job_id . '" class="details-btn">See More</a>
                    </div>
                </div>
                ';
                }
            } else {
                echo "$name haven't posted a job yet!";
            }
        }
        ?>
    </div>
</div>
</section>
<?php include "../candidate/utilities/footer.php"; ?>
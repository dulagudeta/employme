<?php
include "../candidate/utilities/header.php";
?>

<div class="right-panel">
    <div class="panel-header">
        <h1>Welcome to Candidate Dashboard</h1>
    </div>
    <?php include "../functions/search_job.php"; ?>
    <section>
        <div class="section-2">
            <h1>Find Your Dream Job</h1>
            <p>Start your journey towards a brighter future today.</p>
        </div>
        <div class="job-list-container">
            <h1 id="jobs-header">Jobs you applied for</h1>
            <?php
            $jobs_applied = "SELECT 
            j.title,
            j.place,
            j.salary,
            j.posted_date,
            j.deadline,
            j.description,
            j.id,
            a.applied_date,
            c.company_name,
            cp.company_logo
        FROM 
            applicants a
        JOIN 
            jobs j 
        ON 
            a.job_id = j.id
        JOIN 
            company c 
        ON 
            j.company_id = c.id
        JOIN 
            company_profile cp 
        ON 
            c.id = cp.company_id
        WHERE 
            a.candidate_id = '$id' ORDER BY a.applied_date DESC";

            $retrieved = mysqli_query($con, $jobs_applied);
            if ($retrieved) {
                if (mysqli_num_rows($retrieved) > 0) {
                    while ($row = mysqli_fetch_assoc($retrieved)) {
                        $title = $row['title'];
                        $location = $row['place'];
                        $description = $row['description'];
                        $posted_at = $row['posted_date'];
                        $applied_at = $row['applied_date'];
                        $job_id = $row['id'];
                        $logo = $row['company_logo'];
                        $name = $row['company_name'];
                        echo '
                <div class="jobs">
                    <div class="company-name">
                        <img src="../images/' . $logo . '" alt="Company Logo" width="50px" height="50px">
                        <h1>' . $name . '</h1>
                    </div>
                    <div class="jobs-description">
                        <h2>' . $title . '</h2>
                        <p><i class="fas fa-map-marker-alt"></i> <b> Location: </b>' . $location . '</p>
                        <p>' . $description . '.</p>
                        
                            <p><b>Posted date :</b>' . $posted_at . '</p>
                            <p><b>Applied date :</b>' . $applied_at . '</p>
                        
                    </div>
                    <div class="apply-link">
                        <a href="../candidate/withdraw_application.php?id=' . $job_id . '"><i class="fas fa-paper-plane"></i>Withdraw</a>
                        <a href="../candidate/job_detail.php?id=' . $job_id . '" class="details-btn">See More</a>
                    </div>
                </div>
                ';
                    }
                    echo '
                    <div class="view-more">
                <a href="../candidate/view_company.html">View All</a>
            </div>';
                } else {
                    echo "You haven't applied a job yet!";
                }
            }
            ?>
        </div>
        <div class="job-list-container">
            <h1 id="jobs-header">Recent Posted Jobs</h1>
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
        INNER JOIN company_profile cp ON c.id = cp.company_id ORDER BY posted_date DESC";
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
                <div class="jobs">
                    <div class="company-name">
                        <img src="../images/' . $logo . '" alt="Company Logo" width="50px" height="50px">
                        <h1>' . $name . '</h1>
                    </div>
                    <div class="jobs-description">
                        <h2>' . $title . '</h2>
                        <p><i class="fas fa-map-marker-alt"></i> <b> Location: </b>' . $location . '</p>
                        <p>' . $description . '.</p>
                            <p><b>Posted date :</b>' . $posted_at . '</p>
                            <p><b>Deadline date :</b>' . $deadline . '</p>
                    </div>
                    <div class="apply-link">
                        <a href="../candidate/apply_job.php?id=' . $job_id . '"><i class="fas fa-paper-plane"></i>Apply</a>
                        <a href="../candidate/job_detail.php?id=' . $job_id . '" class="details-btn">See More</a>
                    </div>
                </div>
                ';
                    }
                } else {
                    echo "You haven't posted a job yet!";
                }
            }
            ?>
            <div class="company-container">
                <h1 class="company-h1">Companies you may find</h1>
                <?php
                $companies = "SELECT c.id,cp.company_logo,c.company_name,cp.location FROM company c INNER JOIN company_profile cp ON c.id=cp.company_id";
                $query = mysqli_query($con, $companies);
                if ($query) {
                    if (mysqli_num_rows($query)) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $company_id = $row['id'];
                            $logo = $row['company_logo'];
                            $name = $row['company_name'];
                            $location = $row['location'];

                            echo '
                        <div class="companies">
                            <div class="company-header">
                                <img src="../images/' . $logo . '" alt="Company Logo" width="50px" height="50px">
                                <h1>' . $name . '</h1>
                            </div>
                            <p>Location : ' . $location . '</p>
                            <div class="apply-link">
                                <a href="../candidate/company_detail.php?id=' . $company_id . '">See More</a>
                            </div>
                        </div>';
                        }

                        echo '<div class="view-more">
                        <a href="../candidate/view_company.php">View All</a>
                     </div>';
                    } else {
                        echo "Companies may appier soon";
                    }
                }
                ?>
            </div>
    </section>
</div>
</section>

<?php
include "../candidate/utilities/footer.php";
?>
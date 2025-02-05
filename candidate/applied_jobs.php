<?php
include "../candidate/utilities/header.php";
?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Wal como to Candidate Dashboard</h1>
    </div>
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
                        <div>
                            <p><b>Posted date :</b>' . $posted_at . '</p>
                            <p><b>Applied date :</b>' . $applied_at . '</p>
                        </div>
                    </div>
                    <div class="apply-link">
                        <a href="../candiadte/withdraw_application.php?id=' . $job_id . '"><i class="fas fa-paper-plane"></i>Withdraw</a>
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
        </div>
    </section>
</div>
</section>
<?php
include "../candidate/utilities/footer.php";
?>
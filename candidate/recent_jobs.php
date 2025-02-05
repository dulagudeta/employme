<?php
include "../candidate/utilities/header.php";
?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Wal como to Candidate Dashboard</h1>
    </div>
    <div class="search-container">
        <h2>Search jobs you may need</h2>
        <?php include "../functions/search_job.php"?>
    </div>
    <section>
        <div class="section-2">
            <h1>Find Your Dream Job</h1>
            <p>Start your journey towards a brighter future today.</p>
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
                    echo "You haven't posted a job yet!";
                }
            }
            ?>
            <div class="counters">
                <ul>
                    <li><a href="#"><i class="fas fa-angle-left"></i></a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li>...</li>
                    <li><a href="#">20</a></li>
                    <li><a href="#"><i class="fas fa-angle-right"></i></a></li>
                </ul>
            </div>
        </div>
    </section>
</div>
</section>
<?php
include "../candidate/utilities/footer.php";
?>
<?php
include "../candidate/utilities/header.php";
?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Wal como to Candidate Dashboard</h1>
    </div>
    <?php include "../functions/search_job.php"; ?>
    <section>
        <div class="section-2">
            <?php
            if (isset($_GET['search'])) {
                $search_key = $_GET['search'];

                $query = "SELECT 
                  j.title, j.place, j.salary, j.posted_date, j.deadline, 
                  c.company_name, cp.company_logo,j.description,j.id,j.industry
              FROM 
                  jobs j
              JOIN 
                  company c ON j.company_id = c.id
              JOIN 
                  company_profile cp ON c.id = cp.company_id
              WHERE 
                  j.title LIKE '%$search_key%' OR 
                  j.place LIKE '%$search_key%' OR
                  j.industry LIKE '%$search_key%'
              ORDER BY j.posted_date DESC";

                $result = mysqli_query($con, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    echo "<p>Your search <b>$search_key</b> matchs</p>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <div class="job-list-container">
                            <div class="jobs">
                                <div class="company-name">
                                <img src="../images/'.$row['company_logo'].'" alt="Google">
                                <h1>'.$row['company_name'].'</h1>
                            </div>
                            <div class="jobs-description">
                                <h2>'.$row['title'].'</h2>
                                <p><i class="fas fa-map-marker-alt"></i> Location: '.$row['place'].'</p>
                                <p>'.$row['description'].'.</p>
                                <p><b>Industry </b>'.$row['industry'].'</p>
                                <p><b>Posted at : </b>'.$row['posted_date'].'</p>
                                <p><b>Deadline </b>'.$row['deadline'].'</p>
                            </div>
                            <div class="apply-link">
                                <a href="../candidate/apply_job.php?id=' . $row['id'] . '"><i class="fas fa-paper-plane"></i>Apply</button>
                                <a href="../candidate/job_detail.php?id=' . $row['id'] . '" class="details-btn">See More</a>
                            </div>
                        </div>';
                    }
                }
            }
            ?>
        </div>
    </section>
</div>
</section>
<?php include "../candidate/utilities/footer.php" ?>
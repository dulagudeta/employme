<?php
function retrieve_job($con, $id)
{
    $retrieve_job = "SELECT * FROM jobs WHERE company_id='$id' ORDER BY posted_date DESC";
    $retrieved = mysqli_query($con, $retrieve_job);
    if ($retrieved) {
        if (mysqli_num_rows($retrieved) > 0) {
            while ($row = mysqli_fetch_assoc($retrieved)) {
                $title = $row['title'];
                $location = $row['place'];
                $description = $row['description'];
                $posted_at=$row['posted_date'];
                $deadline=$row['deadline'];
                $job_id=$row['id'];
                echo '
                <div class="jobs">
                    <div class="jobs-description">
                        <h2>' . $title . '</h2>
                        <p><i class="fas fa-map-marker-alt"></i> <b> Location: </b>' . $location . '</p>
                        <p>' . $description . '.</p>
                        <p><b>Posted date :</b>'.$posted_at.'</p>
                        <p><b>Deadline date :</b>'.$deadline.'</p> 
                    </div>
                    <div class="apply-link">
                        <a href="../company/view_applicants.php?id='.$job_id.'" class="details-btn">View applicants</a>
                        <a href="../company/job_detail.php?id='.$job_id.'" class="details-btn">See More</a>
                    </div>
                </div>
                ';
            }
        }else{
            echo "You haven't posted a job yet!";
        }
    }
}


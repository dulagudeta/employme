<?php

use function PHPSTORM_META\type;

function retrieve_job_detail($con, $id, $job_id)
{
    $retrieve_job_detail = "SELECT * FROM jobs WHERE company_id='$id' AND id='$job_id'";
    $retrieved = mysqli_query($con, $retrieve_job_detail);

    if ($retrieved && mysqli_num_rows($retrieved) > 0) {
        $job_details = [];
        while ($row = mysqli_fetch_assoc($retrieved)) {
            $job_details[] = [
                'title' => $row['title'],
                'salary' => $row['salary'],
                'type' => $row['type'],
                'industry' => $row['industry'],
                'description' => $row['description'],
                'posted_date' => $row['posted_date'],
                'location' => $row['place'],
                'deadline' => $row['deadline'],
                'skill' => $row['skill'],
            ];
        }
        return $job_details;
    }
    return null;
}

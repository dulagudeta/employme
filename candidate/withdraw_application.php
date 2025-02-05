<?php
include "../candidate/utilities/header.php";
if (isset($_GET['id'])) {
    $j_id = mysqli_real_escape_string($con, $_GET['id']);
    if (isset($id)) {
        $sql = "DELETE FROM applicants WHERE candidate_id='$id' AND job_id='$j_id'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['success_message'] = "Application withdrawal is successfully completed.";
            header("Location: ../candidate/dashboard.php");
            exit(); 
        } else {
            echo "Something went wrong. Please try again! Error: " . mysqli_error($con);
        }
    } else {
        echo "Candidate ID is not defined.";
    }
} else {
    echo "Application ID (a_id) is not provided.";
}
?>
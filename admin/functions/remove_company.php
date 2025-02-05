<?php
include "../../config/db.php";

if (isset($_GET['confirm']) && $_GET['confirm'] == "true" && isset($_GET['id'])) {
    $company_id = mysqli_real_escape_string($con, $_GET['id']);
    
    $sql = "DELETE FROM company WHERE id='$company_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("Location: ../manage_companies.php?message=deleted");
        exit();
    } else {
        echo "Something went wrong. Please try again! Error: " . mysqli_error($con);
    }
} else {
    echo "Candidate ID is not defined.";
}
?>

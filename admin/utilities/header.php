<?php include "../config/db.php" ;
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/admin_login.php");
}
$id = $_SESSION['admin_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../public/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body>
    <section id="section">
        <div class="menu">
            <button onclick="openQuickMenu();">Menu</button>
        </div>
        <div class="left-panel" id="leftPanel">
            <div class="profile">
                <?php
                $sql = "SELECT * FROM admin ";
                $result = mysqli_query($con, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($profile = mysqli_fetch_assoc($result)) {
                        $name = $profile['name'];
                        $picture = $profile['profile'];
                    }
                } else {
                    echo "No data exist";
                }

                echo '
                    <img src="../images/' . $picture . '" alt="User Profile" width="100px" height="100px">
                    <h1><a href="../candidate/profile.html">' . $name . '</a></h1>';
                ?>
            </div>
            <ul>
                <li><a href="../admin/dashboard.php">Dashboard</a></li>
                <li><a href="../admin/manage_candidate.php">Manage Candidate</a></li>
                <li><a href="../admin/manage_companies.php">Manage Companies </a></li>
                <li><a href="../admin/manage_jobs.php">Manage Jobs</a></li>
                <li><a href="../admin/profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="../admin/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
        <div class="left-panel" id="quickMenu">
            <img src="../public/icons/close_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg" alt="Close" onclick="closeQuickMenu();" id="close-left-panel">
            <div class="profile">
                <?php
                echo '
                    <img src="../images/' . $picture . '" alt="User Profile" width="100px" height="100px">
                    <h1><a href="../candidate/profile.html">' . $name . '</a></h1>';
                ?>
            </div>
            <ul>
                <li><a href="../admin/dashboard.php">Dashboard</a></li>
                <li><a href="../admin/manage_candidate.php">Manage Candidate</a></li>
                <li><a href="../admin/manage_companies.php">Manage Companies </a></li>
                <li><a href="../admin/manage_jobs.php">Manage Jobs</a></li>
                <li><a href="../candidate/profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="../authentication/candidate_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
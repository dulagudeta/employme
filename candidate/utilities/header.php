<?php
include "../config/db.php";
session_start();

if (!isset($_SESSION['candidate_id'])) {
    header("Location: ../authentication/candidate_login.php");
}

$id = $_SESSION['candidate_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate</title>
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/footer.css">
    <link rel="stylesheet" href="../public/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <header id="header">
        <h1 class="logo"><i class="fas fa-briefcase"></i> Online Job Portal</h1>
        <ul class="horizontal-bar">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../authentication/candidate_login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
            <li><a href="../authentication/candidate_sign_up.php"><i class="fas fa-user-plus"></i> Sign Up</a></li>
            <li><img src="../public/icons/menu_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg" alt="Menu" onclick="showNavBar();"></li>
        </ul>
        <ul class="vertical-bar">
            <li><img src="../public/icons/close_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg" alt="Close" onclick="hideNavBar();"></li>
            <li><a href="../authentication/login.html"><i class="fas fa-sign-in-alt"></i> Login</a></li>
            <li><a href="../authentication/candidate_sign_up.html"><i class="fas fa-user-plus"></i> Sign Up</a></li>
        </ul>
    </header>
    <section id="section">
        <div class="menu">
            <button onclick="openQuickMenu();">Menu</button>
        </div>
        <div class="left-panel" id="leftPanel">
            <div class="profile">
                <?php
                $sql = "SELECT candidate.name, profile.profile_pic FROM candidate INNER JOIN profile ON profile.candidate_id = candidate.id WHERE candidate.id = '$id'";
                $result = mysqli_query($con, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($profile = mysqli_fetch_assoc($result)) {
                        $name = $profile['name'];
                        $picture=$profile['profile_pic'];
                    }
                } else {
                    echo "No data exist";
                }

                echo '
                    <img src="../images/' . $picture . '" alt="User Profile" width="100px" height="100px">
                    <h1><a href="../candidate/profile.php">' . $name . '</a></h1>';
                ?>
            </div>
            <ul>
                <li><a href="../candidate/dashboard.php">Dashboard</a></li>
                <li><a href="../candidate/search_jobs.php">Search Jobs</a></li>
                <li><a href="../candidate/applied_jobs.php">Jobs Applied</a></li>
                <li><a href="../candidate/recent_jobs.php">Recent Jobs</a></li>
                <li><a href="../candidate/view_company.php">View companies</a></li>
                <li><a href="../candidate/profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="../authentication/candidate_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
        <div class="left-panel" id="quickMenu">
            <img src="../public/icons/close_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg" alt="Close" onclick="closeQuickMenu();" id="close-left-panel">
            <div class="profile">
                <?php
                echo '
                    <img src="../images/' . $picture . '" alt="User Profile" width="100px" height="100px">
                    <h1><a href="../candidate/profile.php">' . $name . '</a></h1>';
                ?>
            </div>
            <ul>
                <li><a href="../candidate/dashboard.php">Dashboard</a></li>
                <li><a href="../candidate/search_jobs.php">Search Jobs</a></li>
                <li><a href="../candidate/applied_jobs.php">Jobs Applied</a></li>
                <li><a href="../candidate/recent_jobs.php">Recent Jobs</a></li>
                <li><a href="../candidate/feedback.php">Notification</a></li>
                <li><a href="../candidate/profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="../authentication/candidate_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
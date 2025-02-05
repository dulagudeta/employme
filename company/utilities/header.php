<?php
include "../config/db.php";
session_start();

if (!isset($_SESSION['company_id'])) {
    header("Location: ../authentication/company_login.php");
}

$id = $_SESSION['company_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company</title>
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
                $sql = "SELECT company.company_name,
                 company_profile.company_logo 
                 FROM 
                 company INNER JOIN company_profile ON company_profile.company_id = company.id WHERE company.id = '$id'";
                $result = mysqli_query($con, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($company = mysqli_fetch_assoc($result)) {
                        $name = $company['company_name'];
                        $logo = $company['company_logo'];
                    }
                } else {
                    echo "No data exist";
                }

                echo '
                    <img src="../images/' . $logo . '" alt="User Profile" width="100px" height="100px">
                    <h1><a href="../candidate/profile.php">' . $name . '</a></h1>';
                ?>
            </div>
            <ul>
                <li><a href="../company/dashboard.php">Dashboard</a></li>
                <li><a href="../company/jobs_posted.php">Jobs you posted</a></li>
                <li><a href="../company/post_jobs.php">Post new job</a></li>
                <li><a href="../company/profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="../company/update_profile.php"><i class="fas fa-user"></i> Update Profile</a></li>
                <li><a href="../authentication/company_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
        <div class="left-panel" id="quickMenu">
            <img src="../public/icons/close_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg" alt="Close" onclick="closeQuickMenu();" id="close-left-panel">
            <div class="profile">
                <?php
                echo '
                    <img src="../images/' . $logo . '" alt="User Profile" width="100px" height="100px">
                    <h1><a href="../candidate/profile.php">' . $name . '</a></h1>';
                ?>
            </div>
            <ul>
                <li><a href="../company/dashboard.php">Dashboard</a></li>
                <li><a href="../company/jobs_posted.php">Jobs you posted</a></li>
                <li><a href="../company/post_jobs.php">Post new job</a></li>
                <li><a href="../company/profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="../company/update_profile.php"><i class="fas fa-user"></i> Update Profile</a></li>
                <li><a href="../authentication/candidate_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
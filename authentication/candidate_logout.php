<?php
session_start();
if (isset($_SESSION['candidate_id'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: ../authentication/candidate_login.php");
    exit();
} else {
    header("Location: ../authentication/candidate_login.php");
    exit();
}
?>
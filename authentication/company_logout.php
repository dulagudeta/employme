<?php
session_start();
if (isset($_SESSION['company_id'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: ../authentication/company_login.php");
    exit();
} else {
    header("Location: ../authentication/company_login.php");
    exit();
}
?>

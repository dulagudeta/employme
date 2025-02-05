<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: ../admin/admin_login.php");
    exit();
} else {
    header("Location: ../admin/admin_login.php");
    exit();
}
?>
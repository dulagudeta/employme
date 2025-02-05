<?php
$server='localhost';
$user='root';
$password='';
$db='online_job_portal';
$con=mysqli_connect($server,$user,$password,$db);
if(!$con){
    echo "Something went wrong!";
}
?>
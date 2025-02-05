<?php include "../admin/utilities/header.php" ;
$candidate="SELECT COUNT(*) AS total_candidate FROM candidate ";
$query_candidate=mysqli_query($con,$candidate);
if($query_candidate){
    $row=mysqli_fetch_assoc($query_candidate);
    $total_candidate=$row['total_candidate'];
}
$company="SELECT COUNT(*) AS total_company FROM company ";
$query_company=mysqli_query($con,$company);
if($query_company){
    $row=mysqli_fetch_assoc($query_company);
    $total_company=$row['total_company'];
}
$jobs="SELECT COUNT(*) AS total_jobs FROM jobs ";
$query_jobs=mysqli_query($con,$jobs);
if($query_jobs){
    $row=mysqli_fetch_assoc($query_jobs);
    $total_jobs=$row['total_jobs'];
}
?>
    <div class="right-panel">
        <div class="panel-header">
            <h1>Welcome to Admin Dashboard</h1>
        </div>
        <div class="section">
            <a href="../admin/manage_candidate.php"><i class="fa-solid fa-users-line"></i>Total Registered Candidates<?php echo " (".$total_candidate.") " ?></a>
            <a href="../admin/manage_companies.php"><i class="fa-solid fa-table-list"></i>Total Registered Companies<?php echo " (".$total_company.") " ?></a>
            <a href="../admin/manage_jobs.php"><i class="fa-brands fa-readme"></i>Total Posted Jobs<?php echo " (".$total_jobs.") " ?></a>
        </div>
    </div>
</section> 
<script src="../public/js/script.js"></script> 
</body>
</html>
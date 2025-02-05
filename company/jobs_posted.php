<?php
include "../company/utilities/header.php";
include "../functions/retrieve_job.php";
?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Welcome to Company Dashboard</h1>
    </div>
    <section>
        <div class="job-list-container">
            <h1 id="jobs-header">Jobs you posted</h1>
            <?php retrieve_job($con,$id);?> 
        </div>
    </section>
</div>
</section>
<?php include "../company/utilities/footer.php";?>
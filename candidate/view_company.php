<?php include "../candidate/utilities/header.php" ?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Wal como to Candidate Dashboard</h1>
    </div>
    <div class="company-container">
        <h1 class="company-h1">Companies you may find</h1>

        <?php
        $companies = "SELECT c.id,cp.company_logo,c.company_name,cp.location FROM company c INNER JOIN company_profile cp ON c.id=cp.company_id";
        $query = mysqli_query($con, $companies);
        if ($query) {
            if (mysqli_num_rows($query)) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $company_id = $row['id'];
                    $logo = $row['company_logo'];
                    $name = $row['company_name'];
                    $location = $row['location'];

                    echo '
                    <div class="companies">
                        <div class="company-header">
                            <img src="../images/' . $logo . '" alt="Company Logo" width="50px" height="50px">
                            <h1>' . $name . '</h1>
                        </div>
                        <p>Location : ' . $location . '</p>
                        <div class="apply-link">
                            <a href="../candidate/company_detail.php?id=' . $company_id . '">See More</a>
                        </div>
                    </div>';
                }
            }
        }
        ?>
        <div class="counters">
            <ul>
                <li><a href="#"><i class="fas fa-angle-left"></i></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li>...</li>
                <li><a href="#">20</a></li>
                <li><a href="#"><i class="fas fa-angle-right"></i></a></li>
            </ul>
        </div>
    </div>
</div>
</section>
<?php include "../candidate/utilities/footer.php" ?>
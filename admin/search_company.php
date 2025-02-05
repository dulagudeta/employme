<?php include "../admin/utilities/header.php"; ?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Search</h1>
    </div>
    <?php
    if(isset($_GET['search_company'])){
        $company_key=$_GET['search_company'];

        $search_c="SELECT * FROM company c INNER JOIN company_profile cp ON c.id=cp.company_id WHERE company_name LIKE '%$company_key%' OR website LIKE '%$company_key%'";
        $search_query=mysqli_query($con,$search_c);
        if($search_query){
            if(mysqli_num_rows($search_query)>0){
                $row =mysqli_fetch_assoc($search_query);
                echo '
                <table>
                <tr>
                <th>ID.</th>
                <th>Company Logo</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Location</th>
                <th>Website</th>
                <th>Contact Tel</th>
                <th>Operation</th>
                </tr>
                <tr>
                    <td>'.$row['id'].'</td>
                    <td><img src="../images/'.$row['company_logo'].'" alt="Profile Picture"></td>
                    <td>'.$row['company_name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['location'].'</td>
                    <td>'.$row['website'].'</td>
                    <td>'.$row['contact'].'</td>
                    <td><a href="#" onclick="confirmDelete('.$row['id'].')">Remove</a></td>
                    </tr>
                </table?
                ';
            }
        }
    }
    ?>
</div>
</section>
<script src="../public/js/script.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this candidate?")) {
            window.location.href = "functions/remove_candidate.php?confirm=true&id=" + id;
        }
    }
</script>
</body>

</html>
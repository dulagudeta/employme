<?php include "../admin/utilities/header.php";?>
    <div class="right-panel">
        <div class="panel-header">
            <h1>Company Detail</h1>
        </div>
        <table>
            <tr>
                <th>ID.</th>
                <th>Job Title</th>
                <th>Posted Company</th>
                <th>Industry</th>
                <th>Place</th>
                <th>Job Type</th>
                <th>Salary</th>
                <th>Posted Date</th>
                <th>Deadline</th>
                <th>Operation</th>
            </tr>
            
            <?php 
            $sql="SELECT j.id,j.title,j.industry,j.place,j.type,j.salary,j.posted_date,j.deadline,c.company_name FROM jobs j INNER JOIN company c ON c.id=j.company_id";
            $query =mysqli_query($con,$sql);
            if($query){
                if(mysqli_num_rows($query)>0){
                    while($row=mysqli_fetch_assoc($query)){
                        echo '
                        <tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['title'].'</td>
                        <td>'.$row['company_name'].'</td>
                        <td>'.$row['industry'].'</td>
                        <td>'.$row['place'].'</td>
                        <td>'.$row['type'].'</td>
                        <td>'.$row['salary'].'</td>
                        <td>'.$row['posted_date'].'</td>
                        <td>'.$row['deadline'].'</td>
                        <td><a href="#" onclick="confirmDelete('.$row['id'].')">Remove</a></td>
                        </tr>
                        ';
                    }
                }
            }
            ?>
        </table>
    </div>
</section> 
<script src="../public/js/script.js"></script> 
<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this candidate?")) {
            window.location.href = "functions/remove_job.php?confirm=true&id=" + id;
        }
    }
</script>
</body>
</html>
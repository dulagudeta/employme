<?php include "../admin/utilities/header.php"; ?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Search</h1>
    </div>
    <?php
    if(isset($_GET['search_candidate'])){
        $candidate_key=$_GET['search_candidate'];
        $search="SELECT * FROM candidate ca INNER JOIN profile p ON ca.id=p.candidate_id WHERE name LIKE '%$candidate_key%' OR email LIKE '%$candidate_key%'";
        $search_query=mysqli_query($con,$search);
        if($search_query){
            if(mysqli_num_rows($search_query)>0){
                $row =mysqli_fetch_assoc($search_query);
                echo '
                <table>
                <tr>
                <th>ID.</th>
                <th>Profile Picture</th>
                <th>Name</th>
                <th>Email</th>
                <th>Nationality</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Education Level</th>
                <th>Operation</th>
                </tr>
                <tr>
                    <td>'.$row['id'].'</td>
                    <td><img src="../images/'.$row['profile_pic'].'" alt="Profile Picture"></td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['nationality'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['gender'].'</td>
                    <td>'.$row['education'].'</td>
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
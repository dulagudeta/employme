<?php include "../admin/utilities/header.php"; ?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Candidates Detail</h1>
    </div>
    <div id="candidate">
        <div class="search-container">
            <h2>Search Candidate</h2>
            <form action="../admin/search_candidate.php" method="get">
                <input type="search" placeholder="Search by name, email..." name="search_candidate" required>
                <button type="submit" class="search-btn"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </div>
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

        <?php
        $sql = "SELECT c.id,c.name,c.email,p.profile_pic,p.nationality,p.address,p.gender,p.education FROM candidate c INNER JOIN profile p ON c.id=p.candidate_id";
        $query = mysqli_query($con, $sql);
        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '
                        <tr>
                        <td>' . $row['id'] . '</td>
                        <td><img src="../images/' . $row['profile_pic'] . '" alt="Profile Picture"></td>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['nationality'] . '</td>
                        <td>' . $row['address'] . '</td>
                        <td>' . $row['gender'] . '</td>
                        <td>' . $row['education'] . '</td>
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
            window.location.href = "functions/remove_candidate.php?confirm=true&id=" + id;
        }
    }
</script>
</body>
</html>
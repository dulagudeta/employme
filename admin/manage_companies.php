<?php include "../admin/utilities/header.php"; ?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Company Detail</h1>
    </div>
    <div id="company">
        <div class="search-container">
            <h2>Search Company</h2>
            <form action="../admin/search_company.php" method="get">
                <input type="search" placeholder="Search by Company name, Company website..." name="search_company" required>
                <button type="submit" class="search-btn"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </div>
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

        <?php
        $sql = "SELECT c.id,c.company_name,c.email,cp.company_logo,cp.location,cp.website,cp.contact FROM company c INNER JOIN company_profile cp ON c.id=cp.company_id";
        $query = mysqli_query($con, $sql);
        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '
                        <tr>
                        <td>' . $row['id'] . '</td>
                        <td><img src="../images/' . $row['company_logo'] . '" alt="Profile Picture"></td>
                        <td>' . $row['company_name'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['location'] . '</td>
                        <td>' . $row['website'] . '</td>
                        <td>' . $row['contact'] . '</td>
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
            window.location.href = "functions/remove_company.php?confirm=true&id=" + id;
        }
    }
</script>
</body>

</html>
<?php
include "../company/utilities/header.php";
include "../functions/retrieve_job_detail.php";
?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Welcome to Company Dashboard</h1>
    </div>
    <div class="form-container">
        <?php
        if (isset($_GET['id'])) {
            $job_id = $_GET['id'];
        } else {
            echo "<p>Job ID not provided. Cannot update job details.</p>";
            exit;
        }
        
        $job_details = retrieve_job_detail($con, $id, $job_id);
        if ($job_details) {
            foreach ($job_details as $jobs) {
                $title = $jobs['title'];
                $location = $jobs['location'];
                $salary = $jobs['salary'];
                $type = $jobs['type'];
                $industry = $jobs['industry'];
                $description = $jobs['description'];
                $skill = $jobs['skill'];
                $deadline = $jobs['deadline'];
            }
        } else {
            echo "<p>No job details found for the provided ID.</p>";
            exit;
        }

        if (isset($_POST['update'])) {
            $title = $_POST['title'];
            $location = $_POST['location'];
            $salary = $_POST['salary'];
            $type = $_POST['type'];
            $industry = $_POST['industry'];
            $skill = $_POST['skill'];
            $description = $_POST['description'];
            $deadline = $_POST['deadline'];

            $update_job = "UPDATE jobs SET 
                title = '$title',
                place = '$location',
                salary = '$salary',
                type = '$type',
                industry = '$industry',
                skill = '$skill',
                description = '$description',
                deadline = '$deadline'
                WHERE company_id = '$id' AND id = '$job_id'";

            $job_updated = mysqli_query($con, $update_job);

            if ($job_updated) {
                header("Location: ../company/dashboard.php");
                exit;
            } else {
                echo "<p>Can't update job. Please try again.</p>";
            }
        }
        ?>
        <form action="" method="post">
            <h2>Update Job</h2>
            <label>Job Title:</label>
            <input type="text" name="title" value="<?php echo $title; ?>" required>
            <label>Location:</label>
            <input type="text" name="location" value="<?php echo $location; ?>" required>
            <label>Salary:</label>
            <input type="text" name="salary" value="<?php echo $salary; ?>" required>
            <label>Employment Type:</label>
            <select name="type" required>
                <option disabled>--Select Job type--</option>
                <option value="fulltime" <?php if ($type === "fulltime") echo "selected"; ?>>Full-time</option>
                <option value="part-time" <?php if ($type === "part-time") echo "selected"; ?>>Part-time</option>
                <option value="freelance" <?php if ($type === "freelance") echo "selected"; ?>>Freelance</option>
                <option value="contract" <?php if ($type === "contract") echo "selected"; ?>>Contract</option>
                <option value="internship" <?php if ($type === "internship") echo "selected"; ?>>Internship</option>
            </select>
            <label>Industry:</label>
            <input type="text" name="industry" value="<?php echo $industry; ?>" required>
            <label>Required Skills:</label>
            <input type="text" name="skill" value="<?php echo $skill; ?>" required>
            <label>Job Description:</label>
            <textarea name="description" required><?php echo $description; ?></textarea>
            <label>Application Deadline:</label>
            <input type="date" name="deadline" value="<?php echo $deadline; ?>" required>
            <input type="submit" name="update" value="Update Job">
        </form>
    </div>        
</div>
</section>
<?php include "../company/utilities/footer.php"; ?>

<?php
include "../company/utilities/header.php";
?>
<div class="right-panel">
    <div class="panel-header">
        <h1>Welcome to Company Dashboard</h1>
    </div>
    <div class="form-container">
        <?php
        if(isset($_POST['post'])){
            $title=$_POST['title'];
            $place=$_POST['place'];
            $salary=$_POST['salary'];
            $type=$_POST['type'];
            $industry=$_POST['industry'];
            $skill=$_POST['skill'];
            $description=$_POST['description'];
            $deadline=$_POST['deadline'];

            $query="INSERT INTO jobs(
            company_id,
            title,
            salary,
            type,
            industry,
            skill,
            description,
            deadline,
            place) VALUES(
            '$id',
            '$title',
            '$salary',
            '$type',
            '$industry',
            '$skill',
            '$description',
            '$deadline',
            '$place')
            ";

            $posted=mysqli_query($con,$query);
            if($posted){
                header("Location: ../company/dashboard.php");
            }else{
                echo "Can't post the job try again!";
            }
        }

        ?>
        <form action="post_jobs.php" method="post" enctype="multipart/form-data">
            <h2>Post a New Job</h2>
            <label>Job Title:</label>
            <input type="text" placeholder="e.g., Software Developer" name="title">
            <label>Location:</label>
            <input type="text" placeholder="e.g., Addis Ababa" name="place">
            <label>Salary:</label>
            <input type="text" placeholder="e.g., 15000" name="salary">
            <label>Employment Type:</label>
            <select name="type">
                <option disabled selected>--Select Job type--</option>
                <option value="fulltime">Full-time</option>
                <option value="part-time">Part-time</option>
                <option value="freelance">Freelance</option>
                <option value="contract">Contract</option>
                <option value="internship">Internship</option>
            </select>
            <label>Industry:</label>
            <input type="text" placeholder="e.g., Agriculture,IT,Healthcare," name="industry">
            <label>Required Skills:</label>
            <input type="text" placeholder="e.g., Python, JavaScript" name="skill">
            <label>Job Description:</label>
            <textarea placeholder="e.g., Looking for a skilled developer..." name="description"></textarea>
            <label>Application Deadline:</label>
            <input type="date" name="deadline">
            <input type="submit" name="post" value="Post Job">
        </form>
    </div>
</div>
</section>
<?php include "../company/utilities/footer.php";?>
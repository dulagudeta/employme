<?php include "config/db.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Job Portal</title>
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="stylesheet" href="public/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <header id="header">
        <h1 class="logo"><i class="fas fa-briefcase"></i> Online Job Portal</h1>
        <ul class="horizontal-bar">
            <li><a href="index.php">Home</a></li>
            <li><button onclick="showPopUp();"><i class="fas fa-user-plus"></i>Login</button></li>
            <li><button onclick="showPopUp();"><i class="fas fa-user-plus"></i> Sign Up</button></li>
            <li><img src="public/icons/menu_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg" alt="Menu" onclick="showNavBar();"></li>
        </ul>
        <ul class="vertical-bar">
            <li><img src="public/icons/close_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg" alt="Close" onclick="hideNavBar();"></li>
            <li><a href="index.php">Home</a></li>
            <li><button onclick="showPopUp();"><i class="fas fa-user-plus"></i>Login</button></li>
            <li><button onclick="showPopUp();"><i class="fas fa-user-plus"></i> Sign Up</button></li>
        </ul>
    </header>
    <div class="popup-container">
        <div class="pop-up">
            <img src="public/icons/close_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg" alt="Close" onclick="exitPopUp();">
            <div class="pop-up-description">
                <p>Whether you're a candidate to explore new opportunities, or a company to hire the talented candidate just create an acount for free. </p>
                <div class="pop-up-links">
                    <a href="authentication/candidate_sign_up.php">Candidate</a>
                    <a href="authentication/company_sign_up.php">Company</a>
                </div>
            </div>
        </div>
    </div>
    <section class="section-1">
        <div class="section-1-content">
            <h1>Your Gateway to Exciting Career Opportunities</h1>
            <div class="get-started">
                <p>Start your journey towards a brighter future today.</p>
                <button id="get-started" onclick="showPopUp();">Get started</button>
            </div>
        </div>
    </section>
    <section class="section-2">
        <div class="description-part">
            <h1>Online Job portal</h1>
            <p style="text-align: start;"> Whether you're looking to kickstart your career, explore new opportunities, or find the perfect candidate to join your team, we make the process easy, efficient, and tailored to your needs. Start your journey with us and unlock endless possibilities.</p>
        </div>
        <div class="img-part">
            <img src="images/woman_worker.jpeg" alt="Image">
        </div>
    </section>
    <section class="section-3">
        <div class="left-panel-container">
            <div class="left-panel">
                <?php
                $sql = "SELECT c.company_name,cp.company_logo FROM company c INNER JOIN company_profile cp ON c.id=cp.company_id";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<h1>Trend Companies</h1>';
                        while ($row = mysqli_fetch_assoc($result)) {
                            $name = $row['company_name'];
                            $logo = $row['company_logo'];

                            echo '
                        <div class="company">
                            <img src="images/' . $logo . '" alt="Company Logo">
                            <h4>' . $name . '</h4>
                        </div>
                        ';
                        }
                    }
                }
                ?>
            </div>
            <div class="left-panel" id="Industry">
                <h1>Industry Catagories</h1>
                <div class="Industry">
                    <p>Agriculture</p>
                </div>
                <div class="Industry">
                    <p>Constuction</p>
                </div>
                <div class="Industry">
                    <p>Consulting</p>
                </div>
                <div class="Industry">
                    <p>Energy and utility</p>
                </div>
                <div class="Industry">
                    <p>Education</p>
                </div>
                <div class="Industry">
                    <p>Engineering</p>
                </div>
                <div class="Industry">
                    <p>Finance</p>
                </div>
                <div class="Industry">
                    <p>Healthcare</p>
                </div>
                <div class="Industry">
                    <p>Tourism</p>
                </div>
                <div class="Industry">
                    <p>Legal</p>
                </div>
                <div class="Industry">
                    <p>Marketing and Advertising</p>
                </div>
                <div class="Industry">
                    <p>Media and Entertinment</p>
                </div>
                <div class="Industry">
                    <p>Social service</p>
                </div>
                <div class="Industry">
                    <p>Real Estate</p>
                </div>
                <div class="Industry">
                    <p>Telecomunication</p>
                </div>
                <div class="Industry">
                    <p>Transportation</p>
                </div>
            </div>
        </div>
        </div>
        <div class="right-panel">
            <h1>Recently posted jobs</h1>
            <?php
            $retrieve_job = "SELECT 
            c.company_name,
            cp.company_logo,
            j.title,
            j.description ,
            j.posted_date,
            j.deadline,
            j.place,
            j.id
        FROM jobs j
        INNER JOIN company c ON j.company_id = c.id
        INNER JOIN company_profile cp ON c.id = cp.company_id ORDER BY posted_date DESC";
            $retrieved = mysqli_query($con, $retrieve_job);
            if ($retrieved) {
                if (mysqli_num_rows($retrieved) > 0) {
                    while ($row = mysqli_fetch_assoc($retrieved)) {
                        $logo = $row['company_logo'];
                        $name = $row['company_name'];
                        $title = $row['title'];
                        $location = $row['place'];
                        $description = $row['description'];
                        $posted_at = $row['posted_date'];
                        $deadline = $row['deadline'];
                        $job_id = $row['id'];
                        echo '
                        <div class="jobs">
                            <div class="company-name">
                                <img src="images/' . $logo . '" alt="Company Logo" width="50px" height="50px">
                                <h1>' . $name . '</h1>
                            </div>
                        <div class="jobs-description">
                            <h2>' . $title . '</h2>
                            <p><i class="fas fa-map-marker-alt"></i> <b> Location: </b>' . $location . '</p>
                            <p>' . $description . '.</p>
                            <div>
                                <p><b>Posted date :</b>' . $posted_at . '</p>
                                <p><b>Deadline date :</b>' . $deadline . '</p>
                            </div>
                        </div>
                            <div class="apply-link">
                                <a href="candidate/candidate_sign_up.php" class="details-btn"><i class="fas fa-paper-plane"></i>Apply</a>
                            </div>
                        </div>
                        ';
                    }
                } else {
                    echo "Jobs posted soon";
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
    </section>
    <section class="section-4">
        <h1>How it works</h1>
        <div class="quick-list">
            <h1>For Candidate</h1>
            <ol style="list-style-type: decimal;">
                <li>Create an account for free</li>
                <li>Search for jobs based on your skills</li>
                <li>Create and upload your CV or resume</li>
                <li>Connect your email with Companies</li>
            </ol>
        </div>
        <div class="quick-list">
            <h1>For Candidate</h1>
            <ol style="list-style-type: decimal;">
                <li>Create an account for free</li>
                <li>Post a job and manage listings</li>
                <li>Access a pool of qualified canidate</li>
                <li>Utilize hiring tools to streamline the recruitment process.</li>
            </ol>
        </div>
    </section>
    <footer>
        <div class="quick-list">
            <h1>Quick links</h1>
            <ul>
                <li><a href="../authentication/login.html">Search Jobs</a></li>
                <li><a href="../authentication/login.html">Post Jobs</a></li>
                <li><a href="../authentication/login.html">Company Trends</a></li>
                <li><a href="#Industry">Industry categories</a></li>
                <li><a href="../authentication/login.html">View Jobs</a></li>
                <li><a href="../authentication/login.html">Apply jobs</a></li>
            </ul>
        </div>
        <div class="ul">
            <h1>Follow Us</h1>
            <ul>
                <li><a href="www.facebook.com"><i class="fab fa-facebook"></i> Facebook</a></li>
                <li><a href="www.telegram.org"><i class="fab fa-telegram"></i> Telegram</a></li>
                <li><a href="www.linkedln.com"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
                <li><a href="www.youtube.com"><i class="fab fa-youtube"></i> YouTube</a></li>
            </ul>
        </div>
        <div class="external-link">
            <h1>Connect with us</h1>
            <div class="icon-linked">
                <a href="www.telegram.org"><img src="images/telegram.png" alt="Telegram" width="50px" height="50px" style="border-radius: 50%;"></a>
                <a href="www.linkedln.com"><img src="images/Linkedin-removebg-preview.png" alt="LinkedIn" width="50px" height="50px"></a>
                <a href="www.facebook.com"><img src="images/facebook.webp" alt="Facebook" width="50px" height="50px"></a>
                <a href="www.youtube.com"><img src="images/youtube.jpeg" alt="YouTube" width="50px" height="50px" style="border-radius: 50%;"></a>
            </div>
        </div>
        <div>
            <h1>Contact Us</h1>
            <ul>
                <li><a href="mailto:job@example.com"><i class="fas fa-envelope"></i> job@example.com</a></li>
                <li><a href="mailto:job&example.com"><i class="fas fa-comment"></i> Feedback</a></li>
                <li><a href="../authentication/login.html"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <li><a href="../authentication/login.html"><i class="fas fa-user-plus"></i> Sign Up</a></li>
            </ul>
        </div>
        <div class="copyright">
            <p>&copy; 2024 Third-Year Student Group <sup>TM</sup>. All Rights Reserved.</p>
        </div>
    </footer>
    <script src="public/js/header.js"></script>
    <script src="public/js/script.js"></script>
</body>

</html>
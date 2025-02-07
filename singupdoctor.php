<?php
if (isset($_POST['submit'])) {
    ob_start();

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "care");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Form inputs (with security measures)
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hashing the password before storing
    $hashed_password = ($password);

    // Handling file upload
    $picture = $_FILES['picture']['name'];
    $temp_name = $_FILES['picture']['tmp_name'];
    $upload_dir = "doctorImage/";

    // Allow only image files
    $allowed_types = ['jpg', 'jpeg', 'png'];
    $file_ext = strtolower(pathinfo($picture, PATHINFO_EXTENSION));

    if (!in_array($file_ext, $allowed_types)) {
        die("Invalid file type. Only JPG, JPEG, and PNG files are allowed.");
    }

    // Move file to directory
    if (move_uploaded_file($temp_name, $upload_dir . $picture)) {

        // Create table if it doesn't exist
        $createTableSQL = "CREATE TABLE IF NOT EXISTS doctor (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            department VARCHAR(255) NOT NULL,
            experience VARCHAR(100) NOT NULL,
            city VARCHAR(100) NOT NULL,
            time VARCHAR(100) NOT NULL,
            bio TEXT NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            picture VARCHAR(255) NOT NULL
        )";

        if (!mysqli_query($conn, $createTableSQL)) {
            die("Error creating table: " . mysqli_error($conn));
        }

        // Insert data into doctor table
        $sql = "INSERT INTO doctor (name, department, experience, city, time, bio, email, password, picture) 
                VALUES ('$name', '$department', '$experience', '$city', '$time', '$bio', '$email', '$hashed_password', '$picture')";

        if (mysqli_query($conn, $sql)) {
            echo "Doctor successfully registered";
        } else {
            echo "<h2>Error registering doctor: " . mysqli_error($conn) . "</h2>";
        }
    } else {
        die("Error uploading the picture.");
    }

    // Close the database connection
    mysqli_close($conn);

    // Redirect
    header("Location: doctorRequest.php");
    exit;
    ob_end_flush();
}
?>

<!-- -------------------------php------------------------------- -->

<!DOCTYPE html>
<html lang="en">
<!-- Meta Tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="Site keywords here">
<meta name="description" content="">
<meta name='copyright' content=''>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Title -->
<title>CARE - Online Consultation Web</title>

<!-- Favicon -->
<link rel="icon" href="img/favicon.png">

<!-- Google Fonts -->
<link
    href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
    rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Nice Select CSS -->
<link rel="stylesheet" href="css/nice-select.css">
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- icofont CSS -->
<link rel="stylesheet" href="css/icofont.css">
<!-- Slicknav -->
<link rel="stylesheet" href="css/slicknav.min.css">
<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="css/owl-carousel.css">
<!-- Datepicker CSS -->
<link rel="stylesheet" href="css/datepicker.css">
<!-- Animate CSS -->
<link rel="stylesheet" href="css/animate.min.css">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="css/magnific-popup.css">

<!-- Medipro CSS -->
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="css/responsive.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-color: #f4f4f9;
        width: 100%;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .signup {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 180vh;

    }


    .signup-form {
        background-color: white;
        width: 100%;
        max-width: 500px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .signup-form h1 {
        font-size: 26px;
        margin-bottom: 20px;
        text-align: center;
        color: #1a76d1;
        font-family: "Poppins", sans-serif;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        color: #000000;
    }

    select {
        font-weight: 300;
    }

    .form-group select {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid gray;
        border-radius: 4px;
        outline: none;
        transition: border-color 0.3s;
        font-family: "Poppins", sans-serif;
        font-weight: 300;
        appearance: auto;
        -webkit-appearance: auto;
        -moz-appearance: auto;
        background-color: white;
    }

    .form-group select:focus {
        border-color: #1a76d1;
    }

    .form-group select option {
        font-family: "Poppins", sans-serif;
        font-weight: 300;
        padding: 10px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid gray;
        border-radius: 4px;
        outline: none;
        transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: none;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-group input[type="file"] {
        padding: 5px;
    }

    .submit-btn {
        width: 100%;
        padding: 12px;
        background-color: #1a76d1;
        color: white;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-btn:hover {
        background-color: #155a9a;
    }

    @media (max-width: 600px) {
        .signup {
            height: 200vh;
            width: 90%;
            margin: 0px 20px;

        }

        .signup-form {
            padding: 15px;
        }

        .signup-form h1 {
            font-size: 20px;
        }
    }
</style>
</head>

<body>


    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>

            <div class="indicator">
                <svg width="16px" height="12px">
                    <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                </svg>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header Area -->
    <header class="header">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-5 col-12">
                    </div>
                    <div class="col-lg-6 col-md-7 col-12">
                        <!-- Top Contact -->
                        <ul class="top-contact">
                            <li><i class="fa fa-envelope"></i><a
                                    href="mailto:eprojectcare.2@gmail.com">eprojectcare.2@gmail.com</a></li>
                        </ul>
                        <!-- End Top Contact -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <!-- Header Inner -->
        <div class="header-inner">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12">
                            <!-- Start Logo -->
                            <div class="logo">
                                <a href="index.php">
                                    <h1>CA<span>RE</span></h1>
                                </a>
                            </div>
                            <!-- End Logo -->
                            <!-- Mobile Nav -->
                            <div class="mobile-nav"></div>
                            <!-- End Mobile Nav -->
                        </div>
                        <div class="col-lg-7 col-md-9 col-12">
                            <!-- Main Menu -->
                            <div class="main-menu">
                                <nav class="navigation">
                                    <ul class="nav menu">
                                        <li><a href="index.php">Home</i></a>
                                        </li>
                                        <li><a href="alldoc.php">Doctors </a></li>
                                        <li><a href="services.php">Services </a></li>
                                        <li><a href="login.php">Login </i></a>

                                        </li>
                                        <li><a href="signup.php">Sign Up <i class="icofont-rounded-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="singupdoctor.php">Register as Doctor</a></li>
                                                <li><a href="patientsignup.php">Register as Patient</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.php">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <!--/ End Main Menu -->
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="get-quote">
                                <a href="appsignup.php" class="btn">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
    <!-- End Header Area -->
    <div class="signup">
        <form class="signup-form" method="POST" enctype="multipart/form-data" onsubmit="return validateAndRedirect()">
            <h1>DOCTOR SIGNUP IN CARE</h1>

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="department">Department</label>
                <select id="department" name="department" required>
                    <option value="">Select Department</option>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Dermatology">Dermatology</option>
                    <option value="Neurology">Neurology</option>
                </select>
            </div>

            <div class="form-group">
                <input type="text" id="experience" name="experience" placeholder="Enter your years of experience"
                    required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" placeholder="Enter your City Name" required>
            </div>
            <div class="form-group">
                <label for="time">Availablity</label>
                <input type="text" id="time" name="time" placeholder="For example 5 PM/AM to 6 PM/AM" required>
            </div>

            <div class="form-group">
                <label for="bio">Short Bio</label>
                <textarea id="bio" name="bio" placeholder="Write a short bio about yourself" required></textarea>
            </div>

            <div class="form-group">
                <label for="cv">Upload Picture</label>
                <input type="file" id="cv" name="picture" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a password" required>
            </div>

            <button type="submit" class="submit-btn" name="submit">Sign Up</button>
        </form>
    </div>
    <!-- -------------------------php------------------------------- -->

    <!-- Footer Area -->
    <footer id="footer" class="footer">
        <!-- Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer">
                            <h2>About Us</h2>
                            <p>We are dedicated to providing compassionate care and medical excellence for all our
                                patients. Our expert team works tirelessly to ensure your health and well-being are in
                                the best hands.</p>
                            <!-- Social -->

                            <!-- End Social -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer f-link">
                            <h2>Quick Links</h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <ul>
                                        <li><a href="index.php"><i class="fa fa-caret-right"
                                                    aria-hidden="true"></i>Home</a></li>
                                        <li><a href="alldoc.php"><i class="fa fa-caret-right"
                                                    aria-hidden="true"></i>Doctors</a></li>
                                        <li><a href="services.php"><i class="fa fa-caret-right"
                                                    aria-hidden="true"></i>Services</a></li>
                                        <li><a href="login.php"><i class="fa fa-caret-right"
                                                    aria-hidden="true"></i>Login</a></li>
                                        <li><a href="contact.php"><i class="fa fa-caret-right"
                                                    aria-hidden="true"></i>Contact Us</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <ul>
                                        <li><a href="singupdoctor.php"><i class="fa fa-caret-right"
                                                    aria-hidden="true"></i>Register as Doctor</a></li>
                                        <li><a href="patientsignup.php"><i class="fa fa-caret-right"
                                                    aria-hidden="true"></i>Register as Patient</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer">
                            <h2>Open Hours</h2>
                            <p>We are available during the following hours to assist with your health needs:</p>
                            <ul class="time-sidual">
                                <li class="day">Monday - Friday <span>24 Hours</span></li>
                                <li class="day">Saturday <span>24 Hours</span></li>
                                <li class="day">Sunday <span>Closed</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer">
                            <h2>Newsletter</h2>
                            <p>Subscribe to our newsletter to receive updates, medical news, and tips directly in your
                                inbox.</p>
                            <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                                <input name="email" placeholder="Email Address" class="common-input"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your email address'"
                                    required="" type="email">
                                <button class="button"><i class="icofont icofont-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->
        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="copyright-content">
                            <p>© Copyright 2025 | All Rights Reserved by <a href="mailto:eprojectcare.2@gmail.com"
                                    target="_blank">eprojectcare.2@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Copyright -->
    </footer>
    <!-- End Footer Area -->


    <!-- jquery Min JS -->
    <script src="js/jquery.min.js"></script>
    <!-- jquery Migrate JS -->
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <!-- jquery Ui JS -->
    <script src="js/jquery-ui.min.js"></script>
    <!-- Easing JS -->
    <script src="js/easing.js"></script>
    <!-- Color JS -->
    <script src="js/colors.js"></script>
    <!-- Popper JS -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="js/bootstrap-datepicker.js"></script>
    <!-- Jquery Nav JS -->
    <script src="js/jquery.nav.js"></script>
    <!-- Slicknav JS -->
    <script src="js/slicknav.min.js"></script>
    <!-- ScrollUp JS -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Niceselect JS -->
    <script src="js/niceselect.js"></script>
    <!-- Tilt Jquery JS -->
    <script src="js/tilt.jquery.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="js/owl-carousel.js"></script>
    <!-- counterup JS -->
    <script src="js/jquery.counterup.min.js"></script>
    <!-- Steller JS -->
    <script src="js/steller.js"></script>
    <!-- Wow JS -->
    <script src="js/wow.min.js"></script>
    <!-- Magnific Popup JS -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!-- Counter Up CDN JS -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>
    <!-- <script>
    function validateAndRedirect() {
        // Get form elements
        var name = document.getElementById('name').value;
        var department = document.getElementById('department').value;
        var experience = document.getElementById('experience').value;
        var bio = document.getElementById('bio').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var picture = document.getElementById('cv').files.length;

        // Regular expressions for validation
        var namePattern = /^[a-zA-Z\s]+$/; // Only letters and spaces
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        var passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/; // Minimum 6 characters, letters and numbers

        // Validate Name
        if (name == "" || !name.match(namePattern)) {
            alert("Please enter a valid name (letters only).");
            return false;
        }

        // Validate department
        if (department == "") {
            alert("Please enter your department.");
            return false;
        }

       

        // Validate Bio
        if (bio == "") {
            alert("Please write a short bio.");
            return false;
        }

        // Validate Email
        if (email == "" || !email.match(emailPattern)) {
            alert("Please enter a valid email.");
            return false;
        }

        // Validate Password
        if (password == "" || !password.match(passwordPattern)) {
            alert("Password must be at least 6 characters and contain letters and numbers.");
            return false;
        }

        // Validate Picture Upload
        if (picture == 0) {
            alert("Please upload your picture.");
            return false;
        }

        // If all fields are valid, redirect to doctorRequest.php
        window.location.href = "doctorRequest.php?name=" + encodeURIComponent(name) +
                              "&department=" + encodeURIComponent(department) +
                              "&experience=" + encodeURIComponent(experience) +
                              "&bio=" + encodeURIComponent(bio) +
                              "&email=" + encodeURIComponent(email) +
                              "&password=" + encodeURIComponent(password) +
                              "&picture=" + encodeURIComponent(picture);
        return false; // Prevent form submission
    }
</script> -->




    <!-- ============================php==================================== -->
</body>

</html>
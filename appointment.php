<?php
$conn = mysqli_connect("localhost", "root", "", "care");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$doctorQuery = "SELECT name, department FROM doctor ORDER BY name ASC";
$doctorResult = $conn->query($doctorQuery);
$doctors = [];
if ($doctorResult) {
    while ($row = $doctorResult->fetch_assoc()) {
        $doctors[] = $row;
    }
}

// Create table if not exists
$tableQuery = "CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    department VARCHAR(255) NOT NULL,
    doctor VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($tableQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $doctor = $_POST['doctor'];  // This will now come from the select
    $date = $_POST['date'];
    $message = $_POST['message'];

    // Your existing prepared statement code remains the same
    $stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, department, doctor, date, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $phone, $department, $doctor, $date, $message);

    if ($stmt->execute()) {
        header("Location: appointmentDone.php");
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .appointment {
            padding-top: 20px;
        }

        .form-group select {
            width: 100%;
            height: 50px;
            padding: 0 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 400;
            background: #fff;
        }

        .form-group select:focus {
            outline: none;
            border-color: #1A76D1;
        }
    </style>
</head>

<body>
    <!-- Header Area -->
    <header class="header">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-5 col-12">
                    </div>
                    <div class="col-lg-6 col-md-7 col-12">
                        <ul class="top-contact">
                            <li><i class="fa fa-envelope"></i><a
                                    href="mailto:eprojectcare.2@gmail.com">eprojectcare.2@gmail.com</a></li>
                        </ul>
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
                            <div class="logo">
                                <a href="index.php">
                                    <h1>CA<span>RE</span></h1>
                                </a>
                            </div>
                            <div class="mobile-nav"></div>
                        </div>
                        <div class="col-lg-7 col-md-9 col-12">
                            <div class="main-menu">
                                <nav class="navigation">
                                    <ul class="nav menu">
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="alldoc.php">Doctors</a></li>
                                        <li><a href="services.php">Services</a></li>
                                        <li><a href="login.php">Login</a></li>
                                        <li>
                                            <a href="signup.php">Sign Up</a>
                                            <ul class="dropdown">
                                                <li><a href="singupdoctor.php">Register as Doctor</a></li>
                                                <li><a href="patientsignup.php">Register as Patient</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.php">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="get-quote">
                                <a href="appointment.php" class="btn">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Start Appointment -->
    <section class="appointment">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>We Are Always Ready to Help You. Book An Appointment</h2>
                        <img src="img/section-img.png" alt="#">
                        <p>Our Team is Always Here to Assist You—Schedule Your Appointment Today!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
                        onsubmit="return validateForm()">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input name="name" id="name" type="text" placeholder="Name">
                                    <span class="error" id="nameError"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input name="email" id="email" type="email" placeholder="Email">
                                    <span class="error" id="emailError"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input name="phone" id="phone" type="text" placeholder="Phone">
                                    <span class="error" id="phoneError"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <select name="department" id="department" class="form-control">
                                        <option value="">Select Department</option>
                                        <option value="Cardiology">Cardiology</option>
                                        <option value="Neurology">Neurology</option>
                                        <option value="Dermatology">Dermatology</option>
                                    </select>
                                    <span class="error" id="departmentError"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <select name="doctor" id="doctor" class="form-control">
                                        <option value="">Select Doctor</option>
                                        <?php foreach ($doctors as $doctor): ?>
                                            <option value="<?php echo htmlspecialchars($doctor['name']); ?>"
                                                data-department="<?php echo htmlspecialchars($doctor['department']); ?>">
                                                <?php echo htmlspecialchars($doctor['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="error" id="doctorError"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input type="date" name="date" placeholder="Date" id="datepicker">
                                    <span class="error" id="dateError"></span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <textarea name="message" id="message"
                                        placeholder="Write Your Message Here....."></textarea>
                                    <span class="error" id="messageError"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-4 col-12">
                                <div class="form-group">
                                    <div class="button">
                                        <button type="submit" class="btn">Book An Appointment</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-8 col-12">
                                <p>( We will confirm by a Text Message )</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="appointment-image">
                        <img src="img/contact-img.png" alt="#">
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                patients.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer f-link">
                            <h2>Quick Links</h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <ul>
                                        <li><a href="index.php"><i class="fa fa-caret-right"></i>Home</a></li>
                                        <li><a href="alldoc.php"><i class="fa fa-caret-right"></i>Doctors</a></li>
                                        <li><a href="services.php"><i class="fa fa-caret-right"></i>Services</a></li>
                                        <li><a href="login.php"><i class="fa fa-caret-right"></i>Login</a></li>
                                        <li><a href="contact.php"><i class="fa fa-caret-right"></i>Contact Us</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <ul>
                                        <li><a href="singupdoctor.php"><i class="fa fa-caret-right"></i>Register as
                                                Doctor</a></li>
                                        <li><a href="patientsignup.php"><i class="fa fa-caret-right"></i>Register as
                                                Patient</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer">
                            <h2>Open Hours</h2>
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
                            <p>Subscribe for updates and news.</p>
                            <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                                <input name="email" placeholder="Email Address" class="common-input" type="email"
                                    required="">
                                <button class="button"><i class="icofont icofont-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="copyright-content">
                            <p>© Copyright 2025 | All Rights Reserved by <a
                                    href="mailto:eprojectcare.2@gmail.com">eprojectcare.2@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/easing.js"></script>
    <script src="js/colors.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>

    <script>
document.getElementById('department').addEventListener('change', function() {
    const selectedDepartment = this.value;
    const doctorSelect = document.getElementById('doctor');
    const doctorOptions = doctorSelect.getElementsByTagName('option');
    
    // Reset doctor selection
    doctorSelect.value = '';
    
    // Show/hide doctors based on department
    for(let option of doctorOptions) {
        if(option.value === '') { // Skip the "Select Doctor" option
            option.style.display = '';
            continue;
        }
        
        if(selectedDepartment === '' || option.getAttribute('data-department') === selectedDepartment) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    }
});
</script>
    <script>
        function validateForm() {
            let isValid = true;

            // Clear previous error messages
            document.querySelectorAll('.error').forEach(error => error.textContent = '');

            // Validate name
            const name = document.getElementById('name').value.trim();
            if (name === '') {
                document.getElementById('nameError').textContent = 'Name is required.';
                isValid = false;
            }

            // Validate email
            const email = document.getElementById('email').value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '' || !emailPattern.test(email)) {
                document.getElementById('emailError').textContent = 'Valid email is required.';
                isValid = false;
            }

            const doctor = document.getElementById('doctor').value;
            if (doctor === '') {
                document.getElementById('doctorError').textContent = 'Please select a doctor.';
                isValid = false;
            }
            // Validate phone
            const phone = document.getElementById('phone').value.trim();
            const phonePattern = /^[0-9]{10}$/;
            if (phone === '' || !phonePattern.test(phone)) {
                document.getElementById('phoneError').textContent = 'Valid 10-digit phone number is required.';
                isValid = false;
            }

            // Validate department
            const department = document.getElementById('department').value;
            if (department === '') {
                document.getElementById('departmentError').textContent = 'Please select a department.';
                isValid = false;
            }

            // Validate doctor
            const doctor = document.getElementById('doctor').value.trim();
            if (doctor === '') {
                document.getElementById('doctorError').textContent = 'Doctor name is required.';
                isValid = false;
            }

            // Validate date
            const date = document.getElementById('datepicker').value.trim();
            if (date === '') {
                document.getElementById('dateError').textContent = 'Date is required.';
                isValid = false;
            }

            // Validate message
            const message = document.getElementById('message').value.trim();
            if (message === '') {
                document.getElementById('messageError').textContent = 'Message is required.';
                isValid = false;
            }

            return isValid;
        }
        
    </script>

</body>

</html>
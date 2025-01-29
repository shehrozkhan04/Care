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
        margin: 0%;
        padding: 0%;
        font-family: "poppins", sans-serif;
    }

    .doctor-main {
        width: 100%;
        height: 60vh;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    .d-card1 {

        width: 20%;
        height: 85%;
        border-radius: 6px;
        border: 1px solid rgba(128, 128, 128, 0.121);
        /* box-shadow: 14px 14px 20px #cbced1 , -14px -14px 20px #ffffff; */

    }

    .d-card1:hover {

        box-shadow: 0 0 16px rgba(0, 0, 0, 0.15);
        transition: 0.2s ease-in-out;
        background-color: #fff;
    }

    .city {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .c-img {
        width: 100%;
        height: 60%;
        display: flex;
        align-items: center;
        justify-self: center;
        background-color: #eaefff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .c-img img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .c-text {
        width: 100%;
        height: 40%;
        padding-left: 10px;
    }

    .c-text p {
        font-size: 1vw;
        padding-top: 10px;
        color: rgb(20, 177, 20);
    }

    .c-text h1 {
        font-size: 1.5vw;
        font-weight: 500;
    }

    .c-text h6 {
        margin-top: -1px;
        font-size: 1vw;
        font-weight: 500;
    }

    .line {
        width: 100%;
        height: 2px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .line1 {
        width: 10%;
        height: 2px;
        background-color: rgb(0, 0, 0);
    }

    .city-info {
        width: 100%;
        height: 20vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .city {
        width: 100%;
        text-align: center;
    }

    .city-info h1 {
        font-size: 1.8vw;
        font-weight: 400;
        padding-bottom: 20px;
    }

    .city-info select {
        width: 20%;
        padding: 10px;
    }

    @media screen and (max-width: 768px) {
        .doctor-main {
            flex-wrap: wrap;
            gap: 10px;
            height: auto;
            /* Remove fixed height */
            justify-content: center;
        }

        .d-card1 {
            width: 45%;
            height: auto;
            margin-bottom: 10px;
        }

        .c-text {
            padding: 10px 20px;
        }

        .c-text h1 {
            font-size: 4vw;
        }

        .c-text h6 {
            font-size: 15px;
            font-weight: 400;
        }

        .c-text p {
            font-size: 12px;
        }

        .city select {
            width: 80%;
            outline: none;
            border: 1px solid #000;
        }

        .city h1 {
            font-size: 25px;
        }
    }

    @media screen and (max-width: 480px) {
        .doctor-main {
            flex-wrap: wrap;
            gap: 15px;
            /* Adjust gap between cards */
            height: auto;
            /* Remove fixed height */
            justify-content: center;
            /* Center align cards */
            flex-direction: column;
            margin-bottom: 20px;
            /* Stack cards vertically */
        }

        .c-img {
            width: 100%;
            height: 70%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .c-img img {
            width: 50%;
        }

        .d-card1 {
            width: 80%;
            /* Full width with some margin */
            height: auto;
            /* Let height adjust dynamically */
            margin: 0 auto;
            /* Center cards horizontally */
        }

        .c-text h1 {
            font-size: 5vw;
            /* Smaller font size for smaller screens */
        }

        .c-text h6 {
            font-size: 4vw;
            /* Adjust for readability */
        }

        .c-text p {
            font-size: 4vw;
        }

        .line {
            margin-bottom: 20px;
        }
    }
</style>
</head>


<!-- Preloader -->
<!-- <div class="preloader">
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
    </div> -->
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
                    <div class="col-lg-2 col-12"
                        style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 10px;">
                        <input style="border-radius: 30px; padding-left: 20px;  font-size: 12px; " type="search" name=""
                            id="" placeholder="Search">
                        <button style="background-color: transparent; border: none;">
                            <i class="ri-search-line" style="font-size: 1.7vw; cursor: pointer;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!-- End Header Area -->
<div class="city-info">
    <div class="city">
        <h1>Browse through the city</h1>
        <select name="city" id="city" onchange="loadCityContent()">
            <option value="">Select City</option>
            <option value="karachi">Karachi</option>
            <option value="lahore">Lahore</option>
            <option value="islamabad">Islamabad</option>
            <option value="peshawar">Peshawar</option>
            <option value="multan">Multan</option>
        </select>
    </div>
</div>

<h1 style="text-align: center; padding-top: 20px; font-weight: 500; ">Karachi</h1>
<div class="line">
    <div class="line1"></div>
</div>
<div class="doctor-main">
    <!-- Cardiologists -->
    <a href="confirmApp.php?doctor=Dr. Ali Raza&specialty=Cardiology" class="d-card1">
        <div class="c-img">
            <img src="img/doc1.png" alt="Doctor 1">
        </div>
        <div class="c-text">
            <p>Available</p>
            <h1>Dr. Ali Raza</h1>
            <h6>Cardiologist</h6>
        </div>
    </a>

    <a href="confirmApp.php?doctor=Dr. Ayesha Malik&specialty=Cardiology" class="d-card1">
        <div class="c-img">
            <img src="img/doc2.png" alt="Doctor 2">
        </div>
        <div class="c-text">
            <p>Available</p>
            <h1>Dr. Fatima Javed</h1>
            <h6>Neurologist</h6>
        </div>
    </a>

    <a href="confirmApp.php?doctor=Dr. Hammad Hussain&specialty=Cardiology" class="d-card1">
        <div class="c-img">
            <img src="img/doc3.png" alt="Doctor 3">
        </div>
        <div class="c-text">
            <p>Available</p>
            <h1>Dr. Bilal Ahmed</h1>
            <h6>Dermatologist</h6>
        </div>
    </a>

    <a href="confirmApp.php?doctor=Dr. Zafar Ahmed&specialty=Cardiology" class="d-card1">
        <div class="c-img">
            <img src="img/doc4.png" alt="Doctor 4">
        </div>
        <div class="c-text">
            <p>Available</p>
            <h1>Dr. Zafar Ahmed</h1>
            <h6>Cardiologist</h6>
        </div>
    </a>

</div>
</div>
</div>

<!-- Footer Area -->
<footer id="footer" class="footer">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>About Us</h2>
                        <p>We are dedicated to providing compassionate care and medical excellence for all our patients.
                            Our expert team works tirelessly to ensure your health and well-being are in the best hands.
                        </p>
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
                                    <li><a href="index.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a>
                                    </li>
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

<script>
    // Function to load content based on the selected city
    function loadCityContent() {
        let city = document.getElementById('city').value;
        if (city === 'karachi') {
            window.location.href = 'karachi.php';
        }
        else if (city === 'multan') {
            window.location.href = 'multan.php';
        }
        else if (city === 'lahore') {
            window.location.href = 'lahore.php';
        }
        else if (city === 'islamabad') {
            window.location.href = 'islamabad.php';
        }
        else if (city === 'peshawar') {
            window.location.href = 'peshawar.php';
        }
    }

</script>

</body>

</html>
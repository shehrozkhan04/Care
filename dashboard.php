<?php
// Add your database connection and queries here to get actual counts
$conn = mysqli_connect("localhost", "root", "", "care");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get counts for dashboard boxes
$doctorCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM doctor WHERE status='accepted'"))['count'];
$patientCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM patient"))['count'];
$appointmentCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM appointments"))['count'];
$requestCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM doctor WHERE status='pending'"))['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
        }

        .main {
            display: flex;
            min-height: 100vh;
        }

        .left {
            background-color: #1A76D1;
            width: 17%;
            padding: 20px;
            position: fixed;
            height: 100vh;
        }

        .logo h1 {
            color: white;
            font-size: 35px;
            margin-bottom: 30px;
        }

        .logo span {
            color: black;
        }

        .menu-item {
            padding: 10px;
            margin: 5px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .menu-item a {
            color: white;
            text-decoration: none;
            display: block;
            font-size: 16px;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .right {
            flex: 1;
            padding: 20px;
            margin-left: 250px;
            background: #f0f2f5;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding-top: 20px;
        }

        .stat-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .stat-box:hover {
            transform: translateY(-5px);
        }

        .stat-box h3 {
            color: #1A76D1;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .stat-box p {
            font-size: 32px;
            font-weight: 600;
            color: #333;
        }

        .content-area {
            width: 96%;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .active-menu {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Add icons using Unicode characters or you can use Font Awesome */
        .stat-box::before {
            font-size: 24px;
            float: right;
            opacity: 0.3;
        }

        .doctors-box::before {
            content: "👨‍⚕️";
        }

        .patients-box::before {
            content: "🏥";
        }

        .appointments-box::before {
            content: "📅";
        }

        .requests-box::before {
            content: "📫";
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="left">
            <div class="logo">
                <h1>CA<span>RE</span></h1>
            </div>
            <div class="menu-item active-menu">
                <a href="dashboard.php">Dashboard</a>
            </div>
            <div class="menu-item">
                <a href="doctorReqAdmin.php">Doctor Requests</a>
            </div>
            <div class="menu-item">
                <a href="DoctorDB.php">Accepted Doctors</a>
            </div>
        </div>
        <div class="right">
            <div class="content-area">
                <h2>Welcome to Dashboard</h2>
                <!-- Add more content here -->
            </div>
            <div class="stats-container">
                <div class="stat-box doctors-box">
                    <h3>Total Doctors</h3>
                    <p><?php echo $doctorCount; ?></p>
                </div>
                <div class="stat-box patients-box">
                    <h3>Total Patients</h3>
                    <p><?php echo $patientCount; ?></p>
                </div>
                <div class="stat-box appointments-box">
                    <h3>Appointments</h3>
                    <p><?php echo $appointmentCount; ?></p>
                </div>
                <div class="stat-box requests-box">
                    <h3>Pending Requests</h3>
                    <p><?php echo $requestCount; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
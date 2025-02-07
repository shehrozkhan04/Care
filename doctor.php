<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "care");

if (!$conn) {
    die("<div class='alert alert-danger'>Connection failed: " . mysqli_connect_error() . "</div>");
}

// Check if doctor is logged in
if (!isset($_SESSION['employee'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit;
}

// Retrieve doctor data using the session
$doctor_email = $_SESSION['employee'];
$queryDoctor = "SELECT * FROM doctor WHERE email = '$doctor_email'";
$resultDoctor = mysqli_query($conn, $queryDoctor);

if ($resultDoctor && mysqli_num_rows($resultDoctor) > 0) {
    $doctor = mysqli_fetch_assoc($resultDoctor);
    // Display doctor's specific data (e.g., name, specialties, etc.)
} else {
    echo "<div class='alert alert-danger'>Doctor not found!</div>";
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #1A76D1;
            padding: 20px;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .logo h1{
            font-family: "Poppins",sans-serif;
            color: white;
            font-size: 40px;
        }
        .logo h1 span{
            color: black;
        }
        .header{
            text-align: center;
            font-size: 50px;
            margin-bottom: 50px;
        }
        
        .menu-items {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .menu-items a {
            color: white;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .menu-items a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 300px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #1A76D1;
        }

        .card p {
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>CA<span>RE</span></h1>
        </div>
        <div class="menu-items">
            <a href="#" class="active">Dashboard</a>
            <a href="#">Profile</a>
            <a href="#">Appointments</a>
            <a href="#">Log Out</a>
        </div>
    </div>
    
    <div class="main-content">
        <h1 class="header">Welcome, Dr. <?php echo htmlspecialchars($doctor['name']); ?>!</h1>

        
        <div class="cards-container">
            <a href="viewProfile.php" class="card">
                <h2>View Profile</h2>
                <p>View and manage your professional profile</p>
            </a>
            
            <a href="veiwApp.php" class="card">
                <h2>View Appointments</h2>
                <p>Check and manage your appointments</p>
            </a>

        </div>
    </div>
</body>
</html>


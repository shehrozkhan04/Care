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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <!-- Include your stylesheets and other meta tags here -->
</head>
<body>
    <div class="doctor-dashboard">
        <h1>Welcome, <?php echo htmlspecialchars($doctor['name']); ?>!</h1>
        <p>Specialty: <?php echo htmlspecialchars($doctor['speciality']); ?></p>
        <p>Experience: <?php echo htmlspecialchars($doctor['experience']); ?> years</p>
        <p>Email: <?php echo htmlspecialchars($doctor['email']); ?></p>

        <!-- You can display other specific details here -->
    </div>
</body>
</html>

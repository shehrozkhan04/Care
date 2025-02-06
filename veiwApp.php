<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "care");

if (!$conn) {
    die("<div class='alert alert-danger'>Connection failed: " . mysqli_connect_error() . "</div>");
}

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['email'];

$query = "SELECT * FROM appointments WHERE email = '$user_email'";
$result = mysqli_query($conn, $query);

echo "<h1>Your Appointments</h1>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>Appointment: " . $row['appointment_details'] . "</p>";
}
?>
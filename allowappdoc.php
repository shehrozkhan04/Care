<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "care");

if (!$conn) {
    die("<div class='alert alert-danger'>Connection failed: " . mysqli_connect_error() . "</div>");
}

// Check if doctor is logged in
if (!isset($_SESSION['employee'])) {
    header("Location: login.php");
    exit;
}

// Retrieve doctor data using session
$doctor_email = $_SESSION['employee'];
$queryDoctor = "SELECT * FROM doctor WHERE email = ?";
$stmt = mysqli_prepare($conn, $queryDoctor);
mysqli_stmt_bind_param($stmt, "s", $doctor_email);
mysqli_stmt_execute($stmt);
$resultDoctor = mysqli_stmt_get_result($stmt);

if ($resultDoctor && mysqli_num_rows($resultDoctor) > 0) {
    $doctor = mysqli_fetch_assoc($resultDoctor);
    $doctor_id = $doctor['id'];
} else {
    die("<div class='alert alert-danger'>Doctor not found!</div>");
}

// Fetch appointments for logged-in doctor
$queryAppointments = "SELECT * FROM appointment WHERE doctor_id = ? ORDER BY date ASC";
$stmt = mysqli_prepare($conn, $queryAppointments);
mysqli_stmt_bind_param($stmt, "i", $doctor_id);
mysqli_stmt_execute($stmt);
$resultAppointments = mysqli_stmt_get_result($stmt);

// Handle Accept and Decline
if (isset($_POST['action']) && isset($_POST['appointment_id'])) {
    $appointment_id = intval($_POST['appointment_id']);
    if ($_POST['action'] === 'accept') {
        $updateQuery = "UPDATE appointment SET status = 'Accepted' WHERE id = ?";
    } elseif ($_POST['action'] === 'decline') {
        $updateQuery = "UPDATE appointment SET status = 'Declined' WHERE id = ?";
    }

    if (isset($updateQuery)) {
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, "i", $appointment_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Appointment updated successfully!'); window.location.href='AllowApp.php';</script>";
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointments</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-4">
        <h1 class="text-center">Appointments for Dr. <?php echo htmlspecialchars($doctor['name']); ?></h1>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($appointment = mysqli_fetch_assoc($resultAppointments)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($appointment['patient_name']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['date']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['time']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['status']); ?></td>
                    <td>
                        <?php if ($appointment['status'] === 'Pending') { ?>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                <button type="submit" name="action" value="accept" class="btn btn-success btn-sm">Accept</button>
                            </form>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                <button type="submit" name="action" value="decline" class="btn btn-danger btn-sm">Decline</button>
                            </form>
                        <?php } else { ?>
                            <span class="badge badge-secondary"><?php echo htmlspecialchars($appointment['status']); ?></span>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

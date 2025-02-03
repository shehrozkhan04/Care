<?php
$conn = mysqli_connect("localhost", "root", "", "care");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch appointments
$sql = "SELECT * FROM appointments ORDER BY date ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='appointment-item'>";
        echo "<p><strong>Name:</strong> " . $row["name"] . "</p>";
        echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
        echo "<p><strong>Phone:</strong> " . $row["phone"] . "</p>";
        echo "<p><strong>Department:</strong> " . $row["department"] . "</p>";
        echo "<p><strong>Doctor:</strong> " . $row["doctor"] . "</p>";
        echo "<p><strong>Date:</strong> " . $row["date"] . "</p>";
        echo "<p><strong>Message:</strong> " . $row["message"] . "</p>";
        echo "<hr>";  // Line to separate each appointment
        echo "</div>";
    }
} else {
    echo "<p>No appointments found.</p>";
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>CARE - Appointments</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        .sidebar {
            width: 250px;
            background-color: #2196F3;
            color: white;
            padding: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .menu-item {
            padding: 10px 0;
            cursor: pointer;
            color: white;
            text-decoration: none;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .content-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .appointment-form {
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #444;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .submit-btn {
            background-color: #2196F3;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-btn:hover {
            background-color: #1976D2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #2196F3;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            margin: 0 4px;
        }

        .edit-btn {
            background-color: #4CAF50;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .status-pending {
            background-color: #FFC107;
            color: black;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }

        .status-confirmed {
            background-color: #4CAF50;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }

        .tab-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tab-btn {
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        @media screen and (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 10px;
            }

            .main-content {
                padding: 10px;
            }

            table {
                display: block;
                overflow-x: auto;
            }

            td, th {
                min-width: 120px;
            }
        }
    </style>
</head>
<body>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database";

    $conn = mysqli_connect("localhost","root","","care");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $patient_name = $_POST['patient_name'];
        $doctor_name = $_POST['doctor_name'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];
        $reason = $_POST['reason'];

        $sql = "INSERT INTO appointments (patient_name, doctor_name, appointment_date, appointment_time, reason)
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $patient_name, $doctor_name, $appointment_date, $appointment_time, $reason);
        
        if ($stmt->execute()) {
            echo "<script>alert('Appointment scheduled successfully!');</script>";
        } else {
            echo "<script>alert('Error scheduling appointment.');</script>";
        }
    }

    // Fetch appointments
    $sql = "SELECT * FROM appointments ORDER BY date, time";
    $result = $conn->query($sql);
    ?>

    <div class="sidebar">
        <div class="logo">CARE</div>
        <div class="menu-item">Dashboard</div>
        <div class="menu-item">Appointments</div>
        <div class="menu-item">Patients</div>
        <div class="menu-item">Doctors</div>
    </div>

    <div class="main-content">
        <div class="tab-buttons">
            <button class="tab-btn">Schedule Appointment</button>
            <button class="tab-btn">View Appointments</button>
        </div>

        <div class="content-card">
            <h2>Schedule New Appointment</h2>
            <form class="appointment-form" method="POST">
                <div class="form-group">
                    <label for="patient_name">Patient Name</label>
                    <input type="text" id="patient_name" name="patient_name" required>
                </div>

                <div class="form-group">
                    <label for="doctor_name">Doctor Name</label>
                    <select id="doctor_name" name="doctor_name" required>
                        <?php
                        // Fetch doctors from database
                        $doctor_sql = "SELECT name FROM doctors";
                        $doctor_result = $conn->query($doctor_sql);
                        while($row = $doctor_result->fetch_assoc()) {
                            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="appointment_date">Appointment Date</label>
                    <input type="date" id="appointment_date" name="appointment_date" required>
                </div>

                <div class="form-group">
                    <label for="appointment_time">Appointment Time</label>
                    <input type="time" id="appointment_time" name="appointment_time" required>
                </div>

                <div class="form-group">
                    <label for="reason">Reason for Visit</label>
                    <textarea id="reason" name="reason" required></textarea>
                </div>

                <button type="submit" name="submit" class="submit-btn">Schedule Appointment</button>
            </form>
        </div>

        <div class="content-card">
            <h2>Upcoming Appointments</h2>
            <table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Department</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // SQL query to fetch appointments
        $sql = "SELECT * FROM appointments ORDER BY date ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["department"] . "</td>";
                echo "<td>" . $row["doctor"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["message"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No appointments found</td></tr>";
        }
        ?>
    </tbody>
</table>

        </div>
    </div>

    <?php
    $conn->close();
    ?>
</body>
</html>
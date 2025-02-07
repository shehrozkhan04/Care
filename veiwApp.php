<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "care");

// Check if doctor is logged in
if (!isset($_SESSION['employee'])) {
    header("Location: login.php");
    exit;
}

// Get the logged-in doctor's email
$doctor_email = $_SESSION['employee'];

// Get doctor's name from the database
$query = "SELECT name FROM doctor WHERE email = '$doctor_email'";
$result = mysqli_query($conn, $query);
$doctor = mysqli_fetch_assoc($result);
$doctor_name = $doctor['name'];

// Handle the delete logic
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $deleteQuery = "DELETE FROM appointments WHERE id = $deleteId AND doctor = '" . mysqli_real_escape_string($conn, $doctor_name) . "'";
    
    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - Appointments</title>
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

        .logo h1 {
            font-family: "Poppins",sans-serif;
            color: white;
            font-size: 40px;
        }
        
        .logo h1 span {
            color: black;
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

        .header {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #1A76D1;
            color: white;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .delete-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>CA<span>RE</span></h1>
        </div>
        <div class="menu-items">
            <a href="doctor.php">Dashboard</a>
            <a href="#">Profile</a>
            <a href="viewapp.php" class="active">Appointments</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>

    <div class="main-content">
        <h1 class="header">Your Appointments</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query to get only this doctor's appointments
                    $sql = "SELECT * FROM appointments WHERE doctor = '" . mysqli_real_escape_string($conn, $doctor_name) . "' ORDER BY date ASC";
                    $result = $conn->query($sql);
                    
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row["id"]) . "</td>
                                    <td>" . htmlspecialchars($row["name"]) . "</td>
                                    <td>" . htmlspecialchars($row["email"]) . "</td>
                                    <td>" . htmlspecialchars($row["phone"]) . "</td>
                                    <td>" . htmlspecialchars($row["department"]) . "</td>
                                    <td>" . htmlspecialchars($row["date"]) . "</td>
                                    <td>" . htmlspecialchars($row["message"]) . "</td>
                                    <td>
                                        <a href='?delete_id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this appointment?\")'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' style='text-align: center;'>No appointments found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
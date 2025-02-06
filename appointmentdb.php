<?php
// Include the database configuration file
$conn = mysqli_connect("localhost", "root", "", "care");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle the delete logic (if a delete request is made)
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // SQL to delete the appointment record from the database
    $deleteQuery = "DELETE FROM appointments WHERE id = $deleteId";

    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh page after deletion
        exit(); // Exit to avoid further code execution
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
    <title>CARE - Appointments List</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            text-decoration: none;
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
            text-align: center;
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
            margin-left: 270px;
            background: #f0f2f5;
        }

        .content-area {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .table-container {
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

        @media (max-width: 1024px) {
            .main {
                flex-direction: column;
            }

            .left {
                width: 100%;
                height: auto;
                position: relative;
                padding: 0;
            }

            .right {
                margin-left: 0;
            }

            .menu-item {
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .table-container {
                overflow-x: auto;
            }

            .delete-btn {
                padding: 5px 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="left">
            <div class="logo">
                <h1>CA<span>RE</span></h1>
            </div>
            <div class="menu-item">
                <a href="admin.php">Dashboard</a>
            </div>
            <div class="menu-item">
                <a href="doctorReqAdmin.php">Doctor Requests</a>
            </div>
            <div class="menu-item">
                <a href="DoctorDB.php">Doctors</a>
            </div>
            <div class="menu-item">
                <a href="patientdb.php">Patients</a>
            </div>
            <div class="menu-item">
                <a href="appointmentdb.php">Appointments</a>
            </div>
        </div>

        <div class="right">
            <div class="content-area">
                <h2>Appointments List</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Department</th>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM appointments";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . htmlspecialchars($row["id"]) . "</td>
                                            <td>" . htmlspecialchars($row["name"]) . "</td>
                                            <td>" . htmlspecialchars($row["email"]) . "</td>
                                            <td>" . htmlspecialchars($row["phone"]) . "</td>
                                            <td>" . htmlspecialchars($row["department"]) . "</td>
                                            <td>" . htmlspecialchars($row["doctor"]) . "</td>
                                            <td>" . htmlspecialchars($row["date"]) . "</td>
                                            <td>" . htmlspecialchars($row["message"]) . "</td>
                                            <td><div class='action-buttons'>
                                            <a href='?delete_id=" . $row['id'] . "' class='action-btn delete-btn' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                        </div></td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9' style='text-align: center;'>No appointments found</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
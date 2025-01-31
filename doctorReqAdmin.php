<?php
$conn = mysqli_connect("localhost", "root", "", "care");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check for status column
$statusCheckQuery = "SHOW COLUMNS FROM doctor LIKE 'status'";
$statusCheckResult = mysqli_query($conn, $statusCheckQuery);

if (mysqli_num_rows($statusCheckResult) == 0) {
    $addStatusColumnQuery = "ALTER TABLE doctor ADD COLUMN status VARCHAR(20) DEFAULT 'pending'";
    mysqli_query($conn, $addStatusColumnQuery);
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $deleteQuery = "DELETE FROM doctor WHERE id = $deleteId";
    mysqli_query($conn, $deleteQuery);
    header("Location: doctorReqAdmin.php");
    exit;
}

// Handle accept request
if (isset($_GET['accept_id'])) {
    $acceptId = $_GET['accept_id'];
    $acceptQuery = "UPDATE doctor SET status='accepted' WHERE id = $acceptId";
    mysqli_query($conn, $acceptQuery);
    header("Location: alldoc.php");
    exit;
}

$sql = "SELECT * FROM doctor ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Requests</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
         * {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
        }
        body{
            width: 100%;
            overflow: hidden;
        }
        .main {
            display: flex;
            min-height: 100vh;
        }

        .left {
            background-color: #1A76D1;
            width: 25%;
            padding: 20px;
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
        }

        .menu-item a {
            color: white;
            text-decoration: none;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .right {
            width: 75%;
            padding: 20px;
            background: #f0f2f5;
        }

        .content-area {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            max-height: 600px;
        }

        .content-header {
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .content-header h2 {
            font-size: 24px;
        }

        .table-container {
            overflow-x: auto; /* Horizontal scroll for wide tables */
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
            font-weight: 500;
        }

        td img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        .edit-btn {
            background: #2ecc71;
        }

        .delete-btn {
            background: #e74c3c;
        }

        .accepted-btn {
            background: #95a5a6;
            cursor: default;
        }

        @media (max-width: 768px) {
            .main {
                flex-direction: column;
            }

            .left {
                width: 100%;
                padding: 10px;
            }

            .right {
                padding: 10px;
            }

            .content-area {
                padding: 10px;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                font-size: 14px;
            }

            .action-btn {
                padding: 4px 8px;
                font-size: 12px;
            }

            th, td {
                padding: 8px;
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
                <a href="doctorReqAdmin.php">Doctor Requests</a>
            </div>
            <div class="menu-item">
                <a href="DoctorDB.php">Accepted Doctors</a>
            </div>
        </div>
        
        <div class="right">
            <div class="content-area">
                <div class="content-header">
                    <h2>Doctor Registration Requests</h2>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Specialization</th>
                                <th>Experience</th>
                                <th>Picture</th>
                                <th>Email</th>
                                <th>Time</th> <!-- New column -->
                                <th>City</th> <!-- New column -->
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['specialization']); ?></td>
                                        <td><?php echo htmlspecialchars($row['experience']); ?></td>
                                        <td>
                                            <img src="doctorImage/<?php echo htmlspecialchars($row['picture']); ?>" 
                                                 alt="Doctor">
                                        </td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['time']); ?></td> <!-- Display Time -->
                                        <td><?php echo htmlspecialchars($row['city']); ?></td> <!-- Display City -->
                                        <td>
                                            <?php if (isset($row['status']) && $row['status'] !== 'accepted') { ?>
                                                <a href="?accept_id=<?php echo $row['id']; ?>" 
                                                   class="action-btn edit-btn">Accept</a>
                                            <?php } else { ?>
                                                <span class="action-btn accepted-btn">Accepted</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="?delete_id=<?php echo $row['id']; ?>" 
                                               class="action-btn delete-btn" 
                                               onclick="return confirm('Are you sure you want to delete this doctor?')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='11' style='text-align: center;'>No doctor registration requests found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
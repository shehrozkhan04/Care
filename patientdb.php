<?php
// Include the database configuration file
$conn = mysqli_connect("localhost", "root", "", "care");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle the delete logic (if a delete request is made)
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // SQL to delete the patient record from the database
    $deleteQuery = "DELETE FROM patient WHERE id = $deleteId";

    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh page after deletion
        exit(); // Exit to avoid further code execution
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Handle the update logic (if the form is submitted)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $medical_history = $_POST['medical_history'];
    $email = $_POST['email'];

    $updateQuery = "UPDATE patient SET name='$name', age='$age', gender='$gender', medical_history='$medical_history', email='$email' WHERE id=$id";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh page after update
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient List</title>
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
    background-color: #f0f2f5;
    flex-direction: column;
}

.left {
    background-color: #1A76D1;
    width: 17%;
    padding: 20px;
    position: fixed;
    height: 100vh;
    top: 0;
    left: 0;
    overflow-y: auto;
}

.logo h1 {
    color: white;
    font-size: 35px;
    margin-bottom: 35px;
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
    width: 83%;
    padding: 20px;
    margin-left: 17%;
    background: #f0f2f5;
    overflow-x: auto;
}

.content-area {
    background: white;
    border-radius: 10px;
    width: 80%;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

table {
    width: 100%;
    border-collapse: collapse;
    overflow-x: auto;
    display: block;
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

.action-btn {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    color: white;
    text-decoration: none;
}

.edit-btn {
    background: #2ecc71;
}

.delete-btn {
    background: #e74c3c;
}

.action-buttons {
    display: flex;
    gap: 10px;
}
        /* Modal Styles */
        #editModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 500px;
            max-width: 90%;
        }

        .modal-content h3 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .modal-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .save-btn {
            background: #1A76D1;
            color: white;
        }

        .cancel-btn {
            background: #ddd;
        }

@media (max-width: 1024px) {
    .left {
        width: 100%;
        height: auto;
        position: relative;
        padding: 0;
        margin: 0;
    }

    .right {
        margin-left: 0;
        width: 100%;
        padding: 10px;
    }

    table {
        display: block;
        overflow-x: auto;
    }

    .logo h1 {
        font-size: 28px;
    }

    .menu-item a {
        font-size: 14px;
    }
}

@media (max-width: 768px) {
    body {
        flex-direction: column;
    }

    .left {
        width: 100%;
        height: auto;
        padding: 15px;
    }

    .menu-item {
        padding: 12px;
        margin: 8px 0;
    }

    .logo h1 {
        font-size: 26px;
    }

    .menu-item a {
        font-size: 14px;
    }

    .right {
        margin-left: 0;
        width: 100%;
        padding: 15px;
    }

    .content-area {
        padding: 15px;
    }

    table {
        display: block;
        overflow-x: auto;
        font-size: 14px;
    }

    th, td {
        padding: 10px;
    }
}

@media (max-width: 480px) {
    .logo h1 {
        font-size: 22px;
    }

    .menu-item a {
        font-size: 12px;
    }

    .action-btn {
        padding: 5px 10px;
        font-size: 12px;
    }

    .action-buttons {
        flex-direction: column;
        gap: 5px;
    }

    .content-area {
        padding: 10px;
    }
}

    </style>
</head>
<body>
    <div class="main">
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
                <div class="content-header">
                    <h2>Patients List</h2>
                </div>
                <table>
    <thead>
        <tr>
        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Medical History</th>
                        <th>Email</th>
                        <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
                    // Fetching patients data from the database
                    $sql = "SELECT * FROM patient";  // Replace 'patients' with your table name
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["id"] . "</td>
                                    <td>" . $row["name"] . "</td>
                                    <td>" . $row["age"] . "</td>
                                    <td>" . $row["gender"] . "</td>
                                    <td>" . $row["medical_history"] . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td>
                                        <div class='action-buttons'> 
                                            <a href='?delete_id=" . $row['id'] . "' class='action-btn delete-btn' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                        </div>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No patients found</td></tr>";
                    }

                    // Close the connection
                    $conn->close();
                    ?>
</tbody>

</table>

            </div>
        </div>
    </div>

  <!-- Edit Modal -->
  <div id="editModal" class="modal">
        <div class="modal-content">
            <h3>Edit Patient Details</h3>
            <form id="editForm" method="POST">
                <input type="hidden" name="id" id="patientId">
                <div class="form-group">
                    <label for="patientName">Name:</label>
                    <input type="text" name="name" id="patientName">
                </div>
                <div class="form-group">
                    <label for="patientAge">Age:</label>
                    <input type="number" name="age" id="patientAge">
                </div>
                <div class="form-group">
                    <label for="patientGender">Gender:</label>
                    <input type="text" name="gender" id="patientGender">
                </div>
                <div class="form-group">
                    <label for="patientMedicalHistory">Medical History:</label>
                    <textarea name="medical_history" id="patientMedicalHistory" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="patientEmail">Email:</label>
                    <input type="email" name="email" id="patientEmail">
                </div>
                <div class="button-group">
                    <button type="button" class="modal-btn cancel-btn" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="modal-btn save-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(patient) {
            document.getElementById("patientId").value = patient.id;
            document.getElementById("patientName").value = patient.name;
            document.getElementById("patientAge").value = patient.age;
            document.getElementById("patientGender").value = patient.gender;
            document.getElementById("patientMedicalHistory").value = patient.medical_history;
            document.getElementById("patientEmail").value = patient.email;
            document.getElementById("editModal").classList.add("active");
        }

        function closeEditModal() {
            document.getElementById("editModal").classList.remove("active");
        }
    </script>
</body>
</html>

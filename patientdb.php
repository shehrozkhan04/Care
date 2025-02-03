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
<html>
<head>
    <title>CARE - Patient List</title>
    <style>
        /* Basic CSS for styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            justify-content: center;
            align-items: flex-start;
            background-color: #f5f5f5;
        }

        .sidebar {
            width: 250px;
            background-color: #2196F3;
            color: white;
            padding: 20px;
            height: 100vh;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .menu-item {
            padding: 10px 0;
            cursor: pointer;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .content-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .content-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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
            text-decoration: none;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        /* Modal Styles */
        #editModal {
            display: none; 
            position: fixed; 
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 500px;
            max-width: 90%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-content h3 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .modal-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .cancel-btn {
            background-color: #f44336;
            color: white;
        }

        .save-btn {
            background-color: #4CAF50;
            color: white;
        }

        /* Close the modal when clicking outside */
        #editModal.active {
            display: flex;
        }

        @media screen and (max-width: 768px) {
            .modal-content {
                width: 90%;
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">CARE</div>
        <div class="menu-item">Patient Requests</div>
        <div class="menu-item">Accepted Patients</div>
    </div>

    <div class="main-content">
        <div class="content-card">
            <h1 class="content-title">Accepted Patients List</h1>
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
                                            <button onclick=\"openEditModal(" . htmlspecialchars(json_encode($row)) . ")\" class='action-btn edit-btn'>Edit</button>
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
                    <button type="button" class="modal-btn cancel-btn" onclick="closeModal()">Close</button>
                    <button type="submit" class="modal-btn save-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(patient) {
            // Show the modal
            document.getElementById('editModal').classList.add('active');
            
            // Fill the form with the patient data
            document.getElementById('patientId').value = patient.id;
            document.getElementById('patientName').value = patient.name;
            document.getElementById('patientAge').value = patient.age;
            document.getElementById('patientGender').value = patient.gender;
            document.getElementById('patientMedicalHistory').value = patient.medical_history;
            document.getElementById('patientEmail').value = patient.email;
        }

        function closeModal() {
            // Close the modal
            document.getElementById('editModal').classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeModal();
            }
        });
    </script>
</body>
</html>

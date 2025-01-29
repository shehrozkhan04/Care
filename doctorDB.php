<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = mysqli_connect("localhost", "root", "", "care");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id = $_POST['id'];
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $experience = $_POST['experience'];
    $bio = $_POST['bio'];

    $query = "UPDATE doctor SET name='$name', specialization='$specialization', experience='$experience', bio='$bio' WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: alldoc.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}

$conn = mysqli_connect("localhost", "root", "", "care");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $deleteQuery = "DELETE FROM doctor WHERE id = $deleteId";
    mysqli_query($conn, $deleteQuery);
    header("Location: alldoc.php");
    exit;
}

$sql = "SELECT * FROM doctor WHERE status='accepted' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
        }

        .main {
            display: flex;
            min-height: 100vh;
        }

        .left {
            background-color: #1A76D1;
            width: 250px;
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
            flex: 1;
            padding: 20px;
            background: #f0f2f5;
        }

        .content-area {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .content-header {
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .content-header h2 {
            font-size: 24px;
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

        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            text-decoration: none;
            margin-right: 5px;
        }

        .edit-btn {
            background: #2ecc71;
        }

        .delete-btn {
            background: #e74c3c;
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
                    <h2>Accepted Doctors List</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Specialization</th>
                            <th>Experience</th>
                            <th>Bio</th>
                            <th>Email</th>
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
                                    <td><?php echo htmlspecialchars($row['bio']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <button onclick="openEditModal(<?php echo htmlspecialchars(json_encode($row)); ?>)" class="action-btn edit-btn">Edit</button>
                                        <a href="?delete_id=<?php echo $row['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='7'>No doctors found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal">
        <div class="modal-content">
            <h3>Edit Doctor Details</h3>
            <form id="editForm" method="POST">
                <input type="hidden" name="id" id="doctorId">
                <div class="form-group">
                    <label for="doctorName">Name:</label>
                    <input type="text" name="name" id="doctorName">
                </div>
                <div class="form-group">
                    <label for="doctorSpecialization">Specialization:</label>
                    <input type="text" name="specialization" id="doctorSpecialization">
                </div>
                <div class="form-group">
                    <label for="doctorExperience">Experience:</label>
                    <input type="number" name="experience" id="doctorExperience">
                </div>
                <div class="form-group">
                    <label for="doctorBio">Bio:</label>
                    <textarea name="bio" id="doctorBio" rows="4"></textarea>
                </div>
                <div class="button-group">
                    <button type="button" class="modal-btn cancel-btn" onclick="closeModal()">Close</button>
                    <button type="submit" class="modal-btn save-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(doctor) {
            document.getElementById('editModal').style.display = 'flex';
            document.getElementById('doctorId').value = doctor.id;
            document.getElementById('doctorName').value = doctor.name;
            document.getElementById('doctorSpecialization').value = doctor.specialization;
            document.getElementById('doctorExperience').value = doctor.experience;
            document.getElementById('doctorBio').value = doctor.bio;
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
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
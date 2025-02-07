<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "care");

// Check if doctor is logged in
if (!isset($_SESSION['employee'])) {
    header("Location: login.php");
    exit;
}

$doctor_email = $_SESSION['employee'];

// Handle form submission for profile update
if (isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $departmenttion = mysqli_real_escape_string($conn, $_POST['departmenttion']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $updateQuery = "UPDATE doctor SET 
                    name = '$name',
                    phone = '$phone',
                    department = '$department',
                    departmenttion = '$departmenttion'";
    
    // Only update password if a new one is provided
    if (!empty($password)) {
        $updateQuery .= ", password = '$password'";
    }
    
    $updateQuery .= " WHERE email = '$doctor_email'";

    if (mysqli_query($conn, $updateQuery)) {
        $success_message = "Profile updated successfully!";
    } else {
        $error_message = "Error updating profile: " . mysqli_error($conn);
    }
}

// Fetch doctor's current information
$query = "SELECT * FROM doctor WHERE email = '$doctor_email'";
$result = mysqli_query($conn, $query);
$doctor = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
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

        .header{
            text-align: center;
            font-size: 50px;
            margin-bottom: 50px;
        }

        .profile-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .save-btn {
            background: #1A76D1;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
        }

        .save-btn:hover {
            background: #1557a0;
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .read-only {
            background-color: #f5f5f5;
            cursor: not-allowed;
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
            <a href="doctor_profile.php" class="active">Profile</a>
            <a href="viewapp.php">Appointments</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>

    <div class="main-content">
        <h1 class="header">Doctor Profile</h1>
        
        <div class="profile-container">
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($doctor['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="<?php echo htmlspecialchars($doctor['email']); ?>" class="read-only" readonly>
                </div>

                <div class="form-group">
                    <label>Availability</label>
                    <input type="text" name="time" value="<?php echo htmlspecialchars($doctor['time']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Department</label>
                    <input type="text" name="department" value="<?php echo htmlspecialchars($doctor['department']); ?>" required>
                </div>


                <div class="form-group">
                    <label>New Password (leave blank to keep current password)</label>
                    <input type="password" name="password" placeholder="Enter new password">
                </div>

                <button type="submit" name="update_profile" class="save-btn">Save Changes</button>
            </form>
        </div>
    </div>
</body>
</html>
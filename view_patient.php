<?php
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "doctor";

// Create connection
$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the patient ID from the URL parameter
if (isset($_GET['id'])) {
    $patientId = $_GET['id'];

    // Retrieve the patient information from the database
    $selectQuery = "SELECT * FROM patient WHERE id = '$patientId'";
    $result = mysqli_query($conn, $selectQuery);

    if (mysqli_num_rows($result) > 0) {
        $patient = mysqli_fetch_assoc($result);
    } else {
        echo "Patient not found";
        exit(); // Stop further execution of the script
    }
} else {
    echo "Invalid patient ID";
    exit(); // Stop further execution of the script
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient</title>
    <style>

header {
          background-color: #94D4E3;
          padding: 6px;
          display: flex;
          align-items: center;
        }

        .icon img {
          width: 80px; /* Adjust the width as needed */
          height: 80px; /* Adjust the height as needed */
          margin-left: 30px;
        }

        .header-left,
        .header-right {
          display: flex;
          align-items: center;
          margin-right: 30px; /* Adjust the margin as needed */
          flex-grow: 1; /* Fill remaining space */
        }

        .header-left a,
        .header-right a {
          color: black;
          text-decoration: underline; /* Add underline */
          display: flex;
          align-items: center;
        }

        .header-left i,
        .header-right i {
          margin-right: 6px; /* Adjust the margin as needed */
        }


        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            text-align: left;
        }


        .back-button {
        display: flex;
        justify-content: center;
    }

    .back-button button {
        font-size: 18px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
    }
    
    </style>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<body>
<header>
        <div class="icon">
            <a href="#"><img src="ager.PNG" alt="icon"></a>
        </div>
        <div class="header-left">
          <i class="fas fa-home"></i>
          <a href="agentLog.html">Home</a> <!-- Update the href attribute with the relative path to the patient management system page -->
        </div>
        <div class="header-left">
          <i class="fas fa-users"></i>
          <a href="patient_info.php">Patients</a>
        </div>
        <div class="header-right">
          <i class="fas fa-cog"></i>
          <a href="settings.php">Settings</a>
        </div>
        <div class="header-right">
          <i class="fas fa-sign-out-alt"></i>
          <a href="responsable.html">Logout</a> <!-- Update the href attribute with the relative path to the first login form page -->
        </div>
    </header>

    <div class="container">
        <h2>Patient Information</h2>
        <table>
            <tr>
                <th>ID</th>
                <td><?php echo $patient['id']; ?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?php echo $patient['first_name']; ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?php echo $patient['last_name']; ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo $patient['gender']; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo $patient['statuts']; ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo $patient['address']; ?></td>
            </tr>
        </table>
    </div>

    <div class="back-button">
    <button onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
</div>


    <script>
function goBack() {
        window.history.back();
    }
    </script>
</body>
</html>
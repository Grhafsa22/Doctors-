<?php
// edit_patient.php


// Establish a database connection
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "doctor";

// Create connection
$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Rest of your code...
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve the patient ID from the URL parameter
    $patientId = $_GET['id'];

    // Fetch the patient information from the database using the patient ID
    $selectQuery = "SELECT * FROM patient WHERE id = '$patientId'";
    $result = mysqli_query($conn, $selectQuery);

    // Check if the patient exists
    if (mysqli_num_rows($result) > 0) {
        $patient = mysqli_fetch_assoc($result);
    } else {
        // Patient not found, handle the error appropriately
        echo "Patient not found";
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated patient data from the form
    $patientId = $_POST['patient_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $gender = $_POST['gender'];
    $statuts = $_POST['statuts'];
    $address = $_POST['address'];

    // Update the patient information in the database
    $updateQuery = "UPDATE patient SET first_name = '$firstName', last_name = '$lastName', gender = '$gender', statuts = '$statuts', address = '$address' WHERE id = '$patientId'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // The patient data was successfully updated
        // Redirect the user back to the patient_info.php page
        header('Location: patient_info.php');
        exit();
    } else {
        // An error occurred while updating the patient data
        // You can display an error message or handle the error in a way that is appropriate for your application
        echo "Error: " . mysqli_error($conn);
        exit();
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            max-width: 400px;
            margin: 30px auto;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f5f5f5;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: 4CAF50;
        }

        form div {
            margin-bottom: 10px;
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form select,
        form textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: 4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }


        .radio-group {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
            align-items: center;
        }

        .radio-group label {
            display: inline-block;
            margin-right: 10px;
        }

        .radio-group input[type="radio"] {
            margin-right: 5px;
        }

        form .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        form button[type="submit"] {
            display: block;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        </style>
</head>
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
    <h2>Edit Patient</h2>
    <form method="post" action="edit_patient.php">
        <input type="hidden" name="patient_id" value="<?php echo $patient['id']; ?>">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $patient['first_name']; ?>">
        <label for="last_name">Last Name:</label>




        
        <input type="text" name="last_name" id="last_name" value="<?php echo $patient['last_name']; ?>">
        <label for="gender">Gender:</label>
        <input type="text" name="gender" id="gender" value="<?php echo $patient['gender']; ?>">
        <label for="address">Status:</label>
        <input type="text" name="statuts" id="statuts" value="<?php echo $patient['statuts']; ?>">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="<?php echo $patient['address']; ?>">
        <br><br>
        <button type="submit">Update</button>
    </form>
    </div>
</body>
</html>
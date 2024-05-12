<?php
// save_to_folder.php

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

$message = ""; // Initialize the message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the patient ID from the POST data
    $patientId = $_POST['id'];

    // Fetch the patient information from the database using the patient ID
    $selectQuery = "SELECT * FROM patient WHERE id = '$patientId'";
    $result = mysqli_query($conn, $selectQuery);

    // Check if the patient exists
    if (mysqli_num_rows($result) > 0) {
        $patient = mysqli_fetch_assoc($result);

        // Create a unique filename for the patient's information
        $filename = 'patient_' . $patientId . '.txt';

        // Compose the content of the file
        $fileContent = "Patient ID: " . $patient['id'] . "\n";
        $fileContent .= "First Name: " . $patient['first_name'] . "\n";
        $fileContent .= "Last Name: " . $patient['last_name'] . "\n";
        $fileContent .= "Gender: " . $patient['gender'] . "\n";
        $fileContent .= "Status: " . $patient['statuts'] . "\n";
        $fileContent .= "Address: " . $patient['address'] . "\n";

        // Specify the path where the file will be saved
        $filePath = 'C:\xampp\htdocs\doctor\save\\' . $filename;

        // Save the patient's information to the file
        file_put_contents($filePath, $fileContent);

        // Set the success message
        $message = "Patient information saved to file";
    } else {
        // Patient not found, handle the error appropriately
        $message = "Patient not found";
    }
} else {
    // Invalid request method, handle the error appropriately
    $message = "Invalid request method";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Save to Folder</title>
</head>
<body>
    <!-- Display the message indicating the status of the file saving -->
    <p><?php echo $message; ?></p>
    
    <!-- Your HTML content goes here -->
</body>
</html>
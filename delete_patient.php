<?php
// delete_patient.php

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $patientId = $_POST['delete_id'];

    // Implement the logic to delete the patient with the given ID from the database
    $deleteQuery = "DELETE FROM patient WHERE id = '$patientId'";
    $result = mysqli_query($conn, $deleteQuery);

    if ($result) {
        // Patient deleted successfully
        
        // Get the maximum ID from the 'patient' table
        $selectQuery = "SELECT MAX(id) AS max_id FROM patient";
        $selectResult = mysqli_query($conn, $selectQuery);
        $row = mysqli_fetch_assoc($selectResult);
        $maxId = $row['max_id'];

        // Reset the AUTO_INCREMENT value of the 'id' column
        $resetQuery = "ALTER TABLE patient AUTO_INCREMENT = " . ($maxId + 1);
        mysqli_query($conn, $resetQuery);

        echo "Patient deleted";
        exit(); // Stop further execution of the script
    }
}

mysqli_close($conn);
?>
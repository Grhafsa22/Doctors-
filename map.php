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

// // Access form data
// $address = $_POST['address'];
// $latitude = $_POST['latitude'];
// $longitude = $_POST['longitude'];

// // Combine address components
// $fullAddress = $address;
$searchRadius = 3000; // Example radius: 3 km

// ... (Optional) Use geocoding API to convert address to coordinates (latitude, longitude)

// ... (Rest of your map display logic using the coordinates)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);

  if (isset($data['address']) && isset($data['latitude']) && isset($data['longitude'])) {
    $address = $data['address'];
    $latitude = $data['latitude'];
    $longitude = $data['longitude'];
    // Prepare SQL query to find a doctor at the specified address (consider partial matching)
    // $sql = "SELECT d.full_name, d.address, d.latitude, d.longitude, d.available
    // FROM doctors d
    // WHERE d.address LIKE '%$address%'
    // LIMIT 1;  -- Limit to one doctor (optional)";

    $sql = "SELECT d.full_name, d.address, d.latitude, d.longitude, d.available
            FROM doctors d
            WHERE ST_Distance_Sphere(Point($longitude, $latitude), Point(d.longitude, d.latitude)) <= $searchRadius
            LIMIT 10;"; // Limit to 10 doctors (optional)

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $doctor = $result->fetch_assoc();
      $markerColor = $doctor['available'] === 'available' ? 'available' : 'not available';
      $markerMessage = $doctor['available'] === 'available' ? '' : 'Confirm doctor availability?';

      echo json_encode(["doctor" => $doctor, "markerColor" => $markerColor, "markerMessage" => $markerMessage]);
    } else {
      // ... (Handle case where no doctor is found)
      echo json_encode([]);  // Send empty response if no doctor found
    }
  }
}

if (isset($_POST['back'])) {
  header('Location: patient_info.php');
}

$conn->close();

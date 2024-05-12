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

// Step 1: Retrieve the maximum ID from the 'patient' table
$selectQuery = "SELECT MAX(id) AS max_id FROM patient";
$selectResult = mysqli_query($conn, $selectQuery);
$row = mysqli_fetch_assoc($selectResult);
$maxId = $row['max_id'];

// Fetch patient information from the database
$selectQuery = "SELECT * FROM patient";
$result = mysqli_query($conn, $selectQuery);

// Store the retrieved patient information as an array
$patients = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $patients[] = $row;
    }
}

// Handle form submission to insert patient information into the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the patient data from the form
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $gender = $_POST['gender'];
    $statuts = $_POST['statuts'];
    $address = $_POST['address'];


    // Step 2: Delete the patient from the table using the patient's ID
    $patientId = $_POST['patient_id'];
    $deleteQuery = "DELETE FROM patient WHERE id = '$patientId'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    // Step 3: Update the IDs of the remaining patients
    $updateQuery = "SET @counter = 0";
    mysqli_query($conn, $updateQuery);

    $updateQuery = "UPDATE patient SET id = @counter := @counter + 1";
    mysqli_query($conn, $updateQuery);

    $updateQuery = "ALTER TABLE patient AUTO_INCREMENT = $maxId + 1";
    mysqli_query($conn, $updateQuery);

    // Insert the patient data into the database without specifying the 'id' column
    $insertQuery = "INSERT INTO patient (first_name, last_name, gender, statuts , address) VALUES ('$firstName', '$lastName', '$gender', '$statuts', '$address')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        // The patient data was successfully inserted into the database
        // Redirect the user to the patient_info.php page
  header("Location: patient_info.php?address=" . urlencode($address));
  exit();


        
    } else {
        // An error occurred while inserting the patient data
        // You can display an error message or handle the error in a way that is appropriate for your application
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient_info</title>
    <style>
        /* CSS for patient_info.php */

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
          max-width: 1100px;
          margin: 0 auto;
          padding: 20px;
        }

        h2 {
          margin-bottom: 20px;
        }

        table {
          width: 100%;
          border-collapse: collapse;
        }

        th, td {
          padding: 10px;
          text-align: left;
        }

        th {
          background-color: #f2f2f2;
        }

        tr:nth-child(even) {
          background-color: #f9f9f9;
        }

        button {
  padding: 5px 10px;
  margin-right: 5px;
  border: none;
  color: #fff;
  cursor: pointer;
}

button.view {
  background-color:#007bff; /* Change to your desired color */
}

button.edit {
  background-color: #F7BB07; /* Change to red */
}

button.delete {
  background-color: #ff0000; /* Change to red */
}

button.save {
  background-color: #4CAF50; /* Change to green */
}
        button:hover {
          background-color: #0056b3;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
          <i class="fas fa-map"></i>
          <a href="combined_page.html">Map</a> 
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
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient) : ?>
                    <tr>
                        <td><?php echo $patient['id']; ?></td>
                        <td><?php echo $patient['first_name']; ?></td>
                        <td><?php echo $patient['last_name']; ?></td>
                        <td><?php echo $patient['gender']; ?></td>
                        <td><?php echo $patient['statuts']; ?></td>
                        <td><?php echo $patient['address']; ?></td>
                        <td>
                            <button class="view" onclick="viewPatient(<?php echo $patient['id']; ?>)"><i class="far fa-eye"></i> View</button>
                            <button class="edit" onclick="editPatient(<?php echo $patient['id']; ?>)"><i class="far fa-edit"></i> Edit</button>
                            <button class="delete" onclick="deletePatient(<?php echo $patient['id']; ?>)"><i class="far fa-trash-alt"></i> Delete</button>
                            <button class="save" onclick="saveToFolder(<?php echo $patient['id']; ?>)"><i class="far fa-save"></i> Save</button>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editPatient(patientId) {
    // Redirect the user to the edit_patient.php page with the patientId as a parameter
    window.location.href = 'edit_patient.php?id=' + patientId;
}
        function deletePatient(patientId) {
        if (confirm("Are you sure you want to delete this patient?")) {
            // Send an AJAX request to delete_patient.php
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_patient.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                // Handle the response from the server
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // The patient was deleted successfully
                    // You can display a success message or perform any other necessary actions
                    console.log('Patient deleted');
                    location.reload(); // Refresh the page to update the patient list
                }
            };
            xhr.send('delete_id=' + patientId);
        }
    }

    function saveToFolder(patientId) {
    // Implement the logic to save the patient information to a folder
    // You can use AJAX to send a request to the server to perform the saving operation
    // For example:
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_to_folder.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        // Handle the response from the server
        if (xhr.readyState === 4 && xhr.status === 200) {
            // The patient information was successfully saved to the folder
            // You can display a success message or perform any other necessary actions
            alert('Patient information saved to folder');
        }
    };
    xhr.send('id=' + patientId);
}



// JavaScript code for the view_patient.php page


function viewPatient(patientId) {
        // Redirect the user to the view_patient.php page with the patientId as a parameter
        window.location.href = 'view_patient.php?id=' + patientId;
    }


        // Retrieve the patient ID from the URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const patientId = urlParams.get('id');

        // Fetch patient information using AJAX
        fetch(`get_patient.php?id=${patientId}`)
            .then(response => response.json())
            .then(data => {
                // Update the patient information in the HTML elements
                document.getElementById('patient-id').textContent = data.id;
                document.getElementById('patient-firstname').textContent = data.first_name;
                document.getElementById('patient-lastname').textContent = data.last_name;
                document.getElementById('patient-gender').textContent = data.gender;
                document.getElementById('patient-statuts').textContent = data.statuts;
                document.getElementById('patient-address').textContent = data.address;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    </script>
</body>
</html>
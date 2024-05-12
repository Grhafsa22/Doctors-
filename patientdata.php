<?php
	$name = $_POST['name'];
	$address = $_POST['address'];
	$healthCondition = $_POST['healthCondition'];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "doctor";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "INSERT INTO patient VALUES ('$name', '$address', '$healthCondition')";

	if (mysqli_query($conn, $sql)) {
        echo "<script>window.open('hold.html', '_blank');</script>"; // Open new window
    
    echo "Request Submitted!"; // This line won't be reached due to exit;
	} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
	
?>
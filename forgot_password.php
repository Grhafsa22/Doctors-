<?php
// forgot_password.php

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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the username from the form
    $username = $_POST['username'];

    // Validate and sanitize the input as needed

    // Check if the username exists in the database
    $query = "SELECT * FROM agent WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        // Username exists, proceed with password reset
        if (!empty($_POST['new_password'])) {
            // Retrieve the new password from the form
            $newPassword = $_POST['new_password'];

            // Update the password in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE agent SET password = '$hashedPassword' WHERE username = '$username'";

            if (mysqli_query($conn, $updateQuery)) {
                $message = "Password reset successful!";
                $showNewPasswordField = false; // Added variable to control new password field visibility
            } else {
                $message = "Error updating password: " . mysqli_error($conn);
            }
        } else {
            $message = "New password field is missing or empty!";
        }
    } else {
        $message = "Username not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOSPatients - Forgot Password</title>
    <link rel="stylesheet" href="resp.css">
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="ager.PNG" alt="SOSPatients Agent Icon" class="logo">
        </div>
        <h2>SOSPatients - Forgot Password</h2>
        <form action="forgot_password.php" method="post">
            <div class="input-group">
                <label for="username">Username: </label>
                <input type="text" placeholder="Enter your Username" id="username" name="username" required>
            </div>
            <?php if (isset($message) && !isset($showNewPasswordField)) { ?>
                <p><?php echo $message; ?></p>
                <button type="submit">Reset Password</button><br><br>
            <?php } elseif (isset($message) && isset($showNewPasswordField)) { ?>
                <p><?php echo $message; ?></p>
                <div class="input-group">
                    <label for="new_password">New Password: </label>
                    <input type="password" placeholder="Enter your New Password" name="new_password" required>
                </div>
                <button type="submit">Submit New Password</button><br><br>
            <?php } else { ?>
                <button type="submit">Reset Password</button><br><br>
            <?php } ?>
        </form>
    </div>
</body>
</html>
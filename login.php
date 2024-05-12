<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    $expectedUsername = "admin";
    $expectedPassword = "admin_66";

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


   // Check if the entered username and password match the expected values
  if ($username != $expectedUsername || $password != $expectedPassword) {
    // Display error message within the page (not an alert)
    $errorMessage = "Incorrect username or password.";
  } else {
    // Successful Login - Assuming you have a separate login logic after validation
    // You can redirect to the desired page after successful login
    header("Location: agentLog.html");
    exit; // Terminate the script after the redirect
  }

  mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="resp.css">

  <title>Login Page</title>
</head>
<body>

<div class="login-container">
        <div class="logo-container">
        <img src="ager.PNG" alt="SOSPatients Agent Icon" class="logo">
        </div>
        <h2>SOSPatients</h2>

  
  <?php if (isset($errorMessage)) : ?>
    <p style="color: red;"><?php echo $errorMessage; ?></p>
  <?php endif; ?>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <div class="input-group">
                <label for="username">Username: </label>
                <input type="text" placeholder="Enter your Username" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password: </label>
                <input type="password" placeholder="Enter your Password" name="password" required>
                
            </div>
            
            
            <button type="submit">Login</button><br><br>
            <div class="input-group1">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>
  </form>

</body>
</html>

    
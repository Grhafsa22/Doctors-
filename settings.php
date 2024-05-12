

<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>
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
      max-width: 600px;
      margin: 0 auto;
      padding: 10px;
    }

    h2 span {
      text-decoration: underline;
    }
    
    h3 {
      margin-top: 30px;
    }


    
    form {
      margin-top: 20px;
    }
    
    label {
      display: block;
      margin-bottom: 5px;
    }
    
    input[type="password"],
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    
    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      cursor: pointer;
    }
    
    

    .message {
      margin-top: 20px;
      padding: 10px;
      background-color: #f2f2f2;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    
    .error {
      color: red;
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
    <h2><span>Settings</span></h2>

    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if (isset($errorMessage)) : ?>
        <p><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <h3>Change Password</h3>
    <form method="POST" action="">
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>

        <input type="submit" name="change_password" value="Change Password">
    </form>

    <h3>Delete Account</h3>
    <form method="POST" action="" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
        <input  type="submit" name="delete_account" value="Delete Account">
    
    </form>
</body>
</html>
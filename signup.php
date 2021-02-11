<?php

$ini_array = parse_ini_file('../../config.ini');

if (isset($_POST['name']) && isset($_POST['email']) && 
isset($_POST['phone-number']) && isset($_POST['pswd'])) 
{
  // hash password with max size of 64 characters
  $hash = password_hash(substr($_POST['pswd'], 0, 64), PASSWORD_DEFAULT);

  // Sanitise and encrypt patient name and email address
  $ini_array = parse_ini_file('C:\\config.ini');
  $cipher = $ini_array["cipher"];
  $key = $ini_array["key"];
  $iv = random_bytes(16);

  include 'db.inc.php'; 

  $escaped_patient_name = $con -> real_escape_string($_POST['name']);
  $encrypted_patient_name = openssl_encrypt($escaped_patient_name, $cipher, $key, OPENSSL_RAW_DATA, $iv);

  $escaped_email = $con -> real_escape_string($_POST['email']);
  $encrypted_email = openssl_encrypt($escaped_email, $cipher, $key, OPENSSL_RAW_DATA, $iv);

  // create and execute sql query to insert new patient
  $sql = 'INSERT INTO `Patients` (`name`, `email`, `phoneNumber`, `password`, `testSlotID`, `iv`)
  VALUES ("' . bin2hex($encrypted_patient_name) . '", "' . bin2hex($encrypted_email) . '", "' . $_POST['phone-number'] . '", 
  "' . bin2hex($hash) . '", NULL, "' . bin2hex($iv) . '");';

  if (!$con->query($sql) === TRUE) {
    die('Error creating table: ' . $con->error);
  }
  mysqli_close($con);

  header("Location: ./login.php"); 
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Sign up</title>
    <style>
      * 
      {
          font-family: 'Roboto', sans-serif;
      }

      a 
      {
          color: #715aa1;
      }

      form 
      {
          max-width: 300px;
          margin-top: 100px;
          margin-left: auto;
          margin-right: auto;
      }

      label 
      {
          font-size: 1.25rem;
      }

      #signup_bttn 
      {
          cursor: pointer;
          border-radius: 3px;
          font-size: 1rem;
          color: white;
          background-color: #9370DB;
          border-color: transparent;
          border-bottom: 5px solid #715aa1;
          padding: 15px 15px;
      }

      .input_box_style 
      {
          margin-top: 5px;
          border: 1px solid black;
          height: 2.5rem;
          width: 90%;
          color: grey;
          font-size: 1.2rem;
          font-weight: bold;
          padding: 0 1rem;
      }

      .input_box_style:focus 
      {
          outline-color: #715aa1;
      }

      @media screen and (max-width: 480px) {
          form 
          {
              margin-top: 25px;
          }
      }
    </style>
</head>
<body>
    <form method="post">
        <h1>Sign Up</h1>
        <hr>

        <br />
        
        <label for="name"><strong>Name</strong></label>
        <br />
        <input type="text" class="input_box_style" name="name" required>

        <br />
        <br />
        
        <label for="email"><strong>Email</strong></label>
        <br />
        <input type="email" class="input_box_style" name="email" required>

        <br />
        <br />
        
        <label for="phone-number"><strong>Phone number</strong></label>
        <br />
        <input type="tel" class="input_box_style" name="phone-number" pattern="[0-9]{10}" required>
        <br />
        <small>Format: 0831011390</small>

        <br />
        <br />
    
        <label for="psw"><strong>Password</strong></label>
        <br />
        <input type="password" class="input_box_style" name="pswd" pattern="[a-z]{0,64}" required>
        <br />
        <small>Maximum of 64 characters</small>

        <br />
        <br />
    
        <button type="submit" id="signup_bttn"><strong>Sign Up</strong></button>
        <br />
        <p>Already have an account? <a href="login.php">Log in here</a>.</p>
      </form>
</body>
</html>
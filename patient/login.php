<?php 
if (isset($_POST['phone-number']) && isset($_POST['pswd'])) 
{
    $ini_array = parse_ini_file('C:\\config.ini');
    $cipher = $ini_array["cipher"];
    $key = $ini_array["key"];

    // create and execute sql query to search for patient record
    include '../db.inc.php'; 
    $phone_num = $con -> real_escape_string(substr($_POST['phone-number'], 0, 64));
    $sql = 'SELECT `patientID`, `name`, `email`, `password`, `iv` FROM `Patients` WHERE phoneNumber="' . $phone_num . '";';
    $result = $con->query($sql);
    mysqli_close($con);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $patientID = $row['patientID'];
        $patientName = hex2bin($row['name']);
        $patientEmail = hex2bin($row['email']);
        $patientPassword = hex2bin($row['password']);
        $patientIV = hex2bin($row['iv']);
        
        if (password_verify($_POST['pswd'], $patientPassword))
        {
            echo "logged in <br>";
            
            session_start();
            $_SESSION['patientID'] = $patientID;
            $_SESSION['patientName'] = openssl_decrypt($patientName, $cipher, $key, OPENSSL_RAW_DATA, $patientIV);
            $_SESSION['patientPhone'] = $phone_num;
            $_SESSION['patientEmail'] = openssl_decrypt($patientEmail, $cipher, $key, OPENSSL_RAW_DATA, $patientIV);
            $_SESSION['patientIV'] = $patientIV;
            
            header("Location: ./dashboard.php"); 
            exit();
        }
        else 
        {
            echo "Incorrect password";
        }
    } 
    else 
    {
        echo '<p>This user does not exist!</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Log in</title>
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
            margin: 150px auto;
        }

        label 
        {
            font-size: 1.25rem;
        }

        #login_bttn 
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
        <h1>Log in</h1>
        <hr>

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
        <input type="password" class="input_box_style" name="pswd" required>

        <br />
        <br />
    
        <button type="submit" id="login_bttn"><strong>Log in</strong></button>
        <br />
        <p>No account? <a href="signup.php">Sign up here</a>.</p>
      </form>
</body>
</html>
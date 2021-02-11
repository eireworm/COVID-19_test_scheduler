<?php 
if (isset($_POST['email']) && isset($_POST['pswd'])) 
{
    $ini_array = parse_ini_file('C:\\config.ini');
    $cipher = $ini_array["cipher"];
    $key = $ini_array["key"];

    // create and execute sql query to search for admin record
    include 'db.inc.php'; 
    $email = $con -> real_escape_string(substr($_POST['email'], 0, 64));
    $sql = "SELECT `adminID`, `name`, `password`, `iv` FROM `administrators` WHERE email=\"$email\";";
    $result = $con->query($sql);
    mysqli_close($con);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $adminID = $row['adminID'];
        $adminName = hex2bin($row['name']);
        $adminPassword = hex2bin($row['password']);
        $adminIV = hex2bin($row['iv']);
        
        if (password_verify($_POST['pswd'], $adminPassword))
        {
            echo "logged in <br>";
            
            session_start();
            $_SESSION['adminName'] = openssl_decrypt($adminName, $cipher, $key, OPENSSL_RAW_DATA, $adminIV);
            
            header("Location: ./admindashboard.php"); 
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
        
        <label for="email"><strong>Email</strong></label>
        <br />
        <input type="email" class="input_box_style" name="email" required>

        <br />
        <br />
    
        <label for="psw"><strong>Password</strong></label>
        <br />
        <input type="password" class="input_box_style" name="pswd" required>

        <br />
        <br />
    
        <button type="submit" id="login_bttn"><strong>Log in</strong></button>
        <br />
        <p>No account? <a href="./adminsignup.php">Sign up here</a>.</p>
      </form>
</body>
</html>